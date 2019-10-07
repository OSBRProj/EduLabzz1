<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\Storage;

use Auth;
use Redirect;
use Session;
use Carbon\Carbon;

use App\Badge;
use App\BadgeUsuario;
use App\Categoria;
use App\Conteudo;
use App\AvaliacaoInstrutor;
use App\Metrica;

use App\Curso;
use App\CursoCompleto;
use App\ConteudoCompleto;
use App\Aula;
use App\ConteudoAula;

use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class PanelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $user = JWTAuth::toUser();
      $concluidos = CursoCompleto::with('curso')->has('curso')->where([['user_id', '=', $user->id]])->get();

      $ultimos = ConteudoCompleto::with('curso')->has('curso')->where([['user_id', '=', $user->id]])->orderBy('created_at', 'desc')->get();

      $ultimos = $ultimos->unique(function ($item) {
          return $item->curso->id;
      });

      $continuar = null;

      foreach ($ultimos as $key => $ultimo)
      {
          $total_conteudos = Conteudo::whereHas('conteudo_aula', function ($query) use ($ultimo) {
              $query->where([['curso_id', '=', $ultimo->curso->id], ['obrigatorio', '=', '1']]);
          })->count();

          // if(Conteudo::where([['curso_id', '=', $ultimo->curso->id], ['obrigatorio', '=', '1']])->count() > 0)
          if($total_conteudos > 0)
          {
              $ultimo->progresso = number_format((ConteudoCompleto::where([['user_id', '=', $user->id], ['curso_id', '=', $ultimo->curso->id]])->count() * 100) / $total_conteudos, 2);
          }
          else
          {
              $ultimo->progresso = 0;
          }

          if($ultimo->progresso > 100)
              $ultimo->progresso = 100;

          if($ultimo->progresso < 100 && $continuar == null)
          {
              $continuar = $ultimo;
          }
      }

      if($continuar != null)
      {
          $ultimo->qtAulas = Aula::where('curso_id', '=', $ultimo->curso->id)->count();

          foreach (Aula::where('curso_id', '=', $ultimo->curso->id)->orderBy('id', 'asc')->get() as $key => $aula)
          {
              if(ConteudoCompleto::where([['user_id', '=', $user->id], ['curso_id', '=', $ultimo->curso->id], ['aula_id', '=', $aula->id]])->count() >= ConteudoAula::where([['curso_id', '=', $ultimo->curso->id], ['obrigatorio', '=', '1'], ['aula_id', '=', $aula->id]])->count())
              {
                  continue;
              }
              else
              {
                  $ultimo->ultimaAula = ($key + 1);

                  foreach (ConteudoAula::where([['curso_id', '=', $ultimo->curso->id], ['aula_id', '=', $aula->id]])->orderBy('ordem', 'asc')->get() as $key2 => $conteudo)
                  {
                      if(ConteudoCompleto::where([['user_id', '=', $user->id], ['curso_id', '=', $ultimo->curso->id], ['aula_id', '=', $aula->id], ['conteudo_id', '=', $conteudo->id]])->first() != null)
                      {
                          continue;
                      }
                      else
                      {
                          $ultimo->ultimoConteudo = ($key2 + 1);
                          $ultimo->qtConteudos = ConteudoAula::where([['curso_id', '=', $ultimo->curso->id], ['aula_id', '=', $aula->id]])->orderBy('ordem', 'asc')->count();

                          break;
                      }
                  }

                  break;
              }
          }
      }

      return response()->json( array("ultimos" => $ultimos, "continuar" => $continuar, "concluidos" => $concluidos) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
