<?php

namespace App\Http\Controllers\API;

use App\User;
use App\Lib\Format;
use App\Entities\GamificacaoUsuario\GamificacaoUsuario;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        try {
            $credentials = array(
                "email"    => $request->data["email"],
                "password" => $request->data["password"],
            );

            try {
                $token = JWTAuth::attempt($credentials);
            } catch (JWTException $ex) {
                return response()->json(["error" => Lang::get("messages.error_generate_token")], 500);
            }

            if (!$token) {
                return response()->json(["error" => Lang::get("messages.invalid_credentials")], 401);
            }

            $user = JWTAuth::toUser($token);

            $GamificacaoUsuario = new GamificacaoUsuario();
            $xp = GamificacaoUsuario::select('xp')->where('user_id', $user->id)->first()["xp"];

            $user["xp"] = $xp;
            $user["level"] = $GamificacaoUsuario->getLevel($xp);

            return [
                "access_token" => $token,
                "token_type" => "bearer",
                "expires" => config("jwt.ttl"),
                "user" => $user,
            ];
        } catch (\Exception $e) {
            return response(["message" => $e->getMessage()], 500);
        }
    }

    public function refresh()
    {
        try {
            if ($token = JWTAuth::getToken()) {
                return [
                    "access_token" => JWTAuth::refresh($token),
                    "token_type" => "bearer",
                    "expires" => config("jwt.ttl")
                ];
            }
        } catch (JWTException $e) {
            return response(["message" => $e->getMessage()], 500);
        }

        return response(Lang::get("messages.request_without_token"), 401);
    }

    public function forgotPassword(Request $request){

      $data = collect($request->data);

      if (!$data->has("email"))
        return response(["message" => "Email não informado"], 500);

      $user = User::where("email", $data["email"])->get();

      if (!count($user))
       return response(["message" => "Email não encontrado"], 500);

      try
      {
        $user = $user->first();
        $user->remember_token = Hash::make(env("APP_KEY"));
        $user->save();

        $data = [
          "email" => $data["email"],
          "name"  => $user->name,
          "token" => md5(uniqid(time(), true))
        ];


        Mail::send("mail.reset-email", $data, function ($message) use ($data) {
          $message->from("contato@edulabzz.com.br", "Suporte Jean Piaget");

          $message->to($data["email"], $data["name"])->subject("Jean Piaget - Link para resetar senha");
        });



        return response(["message" => "Email enviado com sucesso. Verifique seu email para resetar sua senha"], 200);
      }
      catch (\Exception $e)
      {
        return response(["message" => $e->getMessage()], 500);
      }


    }

    public function logout(Request $request)
    {
        try {
            $token = $request->get("token");
            JWTAuth::invalidate($token);
            return ["message" => Lang::get("messages.logout_success")];
        } catch (JWTException $e) {
            return response(["message" => Lang::get("messages.logout_error")], 500);
        }
    }
}
