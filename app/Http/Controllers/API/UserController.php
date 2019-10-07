<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Entities\GamificacaoUsuario\GamificacaoUsuario;
use App\Http\Controllers\Controller;
use App\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    public function __construct()
    {
        $user = new User();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      try {
        $users = User::all();

        return response()->json(["data" => $users]);
      } catch (\Exception $exception) {
          return response()->json(["error" => true, "message" => $exception->getMessage()], 500);
      }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      try {
        $validate = Validator::make($request->data, [
          'name'            => ['required', 'string', 'max:255'],
          'email'           => ['required', 'string', 'email', 'max:255', 'unique:users'],
          'data_nascimento' => ['required', 'string'],
          'password'        => ['required', 'string', 'min:6', 'confirmed']
        ]);

        if ($validate->fails())
          return response()->json(["error" => true, "message" => $validate->errors()], 500);

        $dateInput = str_replace("/", '-', $request->data['data_nascimento']);

        $user = User::create([
          'name'             => $request->data['name'],
          'email'            => $request->data['email'],
          'data_nascimento'  => date('Y-m-d', strtotime($dateInput)),
          'password'         => Hash::make($request->data['password']),
          'ultima_atividade' => date("Y-m-d H:i:s")
        ]);

        $GamificacaoUsuario = new GamificacaoUsuario();
        $gamificacao = GamificacaoUsuario::create([
          'xp'      => 0,
          'user_id' => $user->id
        ]);

        $user["xp"] = $gamificacao->xp;
        $user["level"] = $GamificacaoUsuario->getLevel($gamificacao->xp);

        $message = Lang::get("messages.mensagem_cadastro", ["nome" => "Usuário", "artigo" => "o"]);

        return response()->json(["message" => $message, "data" => $user]);
      } catch (\Exception $exception) {
        return response()->json(["error" => true, "message" => $exception->getMessage()], 500);
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      try {
        $user = User::findOrFail($id);
        $GamificacaoUsuario = new GamificacaoUsuario();

        $xp = GamificacaoUsuario::select('xp')->where('user_id', $user->id)->first()["xp"];

        $user["xp"] = $xp;
        $user["level"] = $GamificacaoUsuario->getLevel($xp);

        return response()->json(["data" => $user]);
      } catch (\Exception $exception) {
          return response()->json(["error" => true, "message" => $exception->getMessage()], 500);
      }
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
      try {
        $user = User::findOrFail($id);

        DB::beginTransaction();
        $user->update($request->data);
        $message = Lang::get("messages.mensagem_atualizado", ["nome" => "Usuário", "artigo" => "o"]);
        DB::commit();

        return response()->json(["message" => $message]);
      } catch (\Exception $exception) {
        return response()->json(["error" => true, "message" => $exception->getMessage()], 500);
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      try {
        $gamificacao = GamificacaoUsuario::where('user_id', $id);
        $gamificacao->delete();

        $user = User::findOrFail($id);
        $user->delete();

        $message = Lang::get("messages.mensagem_removido", ["nome" => "Usuário", "artigo" => "o"]);

        return response()->json(["message" => $message, "data" => $user]);
      } catch (\Exception $exception) {
        return response()->json(["error" => true, "message" => $exception->getMessage()], 500);
      }
    }
}
