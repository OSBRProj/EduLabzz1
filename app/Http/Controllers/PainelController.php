<?php

namespace App\Http\Controllers;

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

class PainelController extends Controller
{
    public function index()
    {
        $concluidos = CursoCompleto::with('curso')->has('curso')->where([['user_id', '=', Auth::user()->id]])->get();

        $ultimos = ConteudoCompleto::with('curso')->has('curso')->where([['user_id', '=', Auth::user()->id]])->orderBy('created_at', 'desc')->get();

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
                $ultimo->progresso = number_format((ConteudoCompleto::where([['user_id', '=', Auth::user()->id], ['curso_id', '=', $ultimo->curso->id]])->count() * 100) / $total_conteudos, 2);
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
                if(ConteudoCompleto::where([['user_id', '=', Auth::user()->id], ['curso_id', '=', $ultimo->curso->id], ['aula_id', '=', $aula->id]])->count() >= ConteudoAula::where([['curso_id', '=', $ultimo->curso->id], ['obrigatorio', '=', '1'], ['aula_id', '=', $aula->id]])->count())
                {
                    continue;
                }
                else
                {
                    $ultimo->ultimaAula = ($key + 1);

                    foreach (ConteudoAula::where([['curso_id', '=', $ultimo->curso->id], ['aula_id', '=', $aula->id]])->orderBy('ordem', 'asc')->get() as $key2 => $conteudo)
                    {
                        if(ConteudoCompleto::where([['user_id', '=', Auth::user()->id], ['curso_id', '=', $ultimo->curso->id], ['aula_id', '=', $aula->id], ['conteudo_id', '=', $conteudo->id]])->first() != null)
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

        if(count($ultimos) > 5)
        {
            $ultimos = $ultimos->splice(0, 5);
        }

        // dd($ultimos);

        return view('painel')->with(compact('continuar', 'ultimos', 'concluidos'));
    }

    public function badges()
    {
        $badges = Badge::where([['visibilidade', '=' , '1']])->get();

        foreach(BadgeUsuario::with('badge')->where('user_id', '=', Auth::user()->id)->get() as $minha)
        {
            if($badges->contains(function ($value, $key) use ($minha) { return $value->id == $minha->badge->id; }))
            {
                $badges->first(function ($value, $key) use ($minha) { return $value->id == $minha->badge->id; })->desbloqueada = true;
            }
            else
            {
                $minha = $minha->badge;

                $minha->desbloqueada = true;

                $badges->push($minha);
            }
        }

        // dd($badges);

        return view('badges')->with( compact('badges') );
    }

    public function getCertificado($idCurso)
    {
        if(Curso::find($idCurso) == null)
        {
            return response()->view('errors.404');
        }

        // if(ConteudoCompleto::where([['user_id', '=', Auth::user()->id], ['curso_id', '=', $idCurso]])->count() < Conteudo::where([['curso_id', '=', $idCurso], ['obrigatorio', '=', 1]])->count())
        if(CursoCompleto::where([['user_id', '=', Auth::user()->id], ['curso_id', '=', $idCurso]])->first() == null)
        {
            return response()->view('errors.404');
        }

        $curso = Curso::find($idCurso);

        $user = Auth::user();

        $dataConclusao = CursoCompleto::where([['user_id', '=', Auth::user()->id], ['curso_id', '=', $idCurso]])->first()->created_at->format('d/m/Y');

        return view('painel-certificado')->with(compact('curso', 'user', 'dataConclusao'));
    }

}


