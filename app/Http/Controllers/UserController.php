<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use Redirect;
use Session;
use Auth;
use Mail;

use App\User;
use App\ResetToken;
use App\EnderecoUser;
use App\Escola;

class UserController extends Controller
{
    public function postNovo(Request $request)
    {
        if (User::where('email', '=', $request->email)->first() != null)
        {
            \Session::flash('warning', 'Este email já está cadastrado!');
        }
        else
        {
            // dd($request->all());

            $user = User::create([
                'name'             => $request->name,
                'email'            => $request->email,
                'password'         => \Hash::make('123456'),
                'ultima_atividade' => date("Y-m-d H:i:s"),
            ]);

            if($request->has('escola_id'))
            {
                if(Escola::find($request->escola_id))
                {
                    $user->update([
                        'escola_id' => $request->escola_id
                    ]);
                }
            }

            if($request->has('permissao'))
            {
                if(strtoupper($request->permissao) == "Z")
                {
                    $user->update([
                        'permissao' => "Z"
                    ]);
                }
                else if(strtoupper($request->permissao) == "E")
                {
                    $user->update([
                        'permissao' => "E"
                    ]);
                }
                else if(strtoupper($request->permissao) == "G")
                {
                    $user->update([
                        'permissao' => "G"
                    ]);
                }
                else if(strtoupper($request->permissao) == "P")
                {
                    $user->update([
                        'permissao' => "P"
                    ]);
                }
                else
                {
                    $user->update([
                        'permissao' => "A"
                    ]);
                }
            }

            \Session::flash('success', 'Usuário criada com sucesso, a senha será enviada para o endereço de email!');
        }

        // return redirect()->route('dashboard.usuarios');
        return redirect()->back();
    }

    public function perfilIncompleto()
    {
        $user = Auth::user();

        if (EnderecoUser::find($user->id) != null && $user->telefone != '' && $user->cpf != '' && $user->rg != '' && $user->nome_completo != '') {
            return redirect()->route('catalogo');
        }

        $endereco = EnderecoUser::find($user->id);

        return view('auth.perfil-incompleto')->with(compact('endereco'));
    }

    public function postPerfilIncompleto(Request $request)
    {
        $request->data_nascimento = str_replace("/", "-", $request->data_nascimento);

        $user = Auth::user()->update([
            "nome_completo"   => $request->nome_completo,
            "data_nascimento" => date("Y-m-d", strtotime($request->data_nascimento)),
            "cpf"             => $request->cpf,
            "rg"              => $request->rg,
            "telefone"        => $request->telefone,
            "genero"          => $request->genero,
            "completo"        => true,
        ]);

        if ($request->numero_complemento == null)
            $request->numero_complemento = "";

        $endereco = EnderecoUser::updateOrCreate(
            ['user_id' => Auth::user()->id],
            [
                'user_id'            => Auth::user()->id,
                "cep"                => $request->cep,
                "uf"                 => $request->uf,
                "cidade"             => $request->cidade,
                "bairro"             => $request->bairro,
                "logradouro"         => $request->logradouro,
                "numero_complemento" => $request->numero_complemento,
            ]
        );

        return redirect()->route('catalogo');
    }

    public function getUsuario($idUsuario)
    {

        if (User::find($idUsuario) != null) {
            $usuario = User::find($idUsuario);

            return response()->json(['success' => 'Usuário encontrado.', 'user' => json_encode($usuario)]);
        } else {
            return response()->json(['error' => 'Usuário não encontrado!']);
        }

    }

    public function update(Request $request)
    {
        if (User::find($request->id) != null) {
            $usuario = User::find($request->id);

            $usuario->name = $request->name;
            $usuario->email = $request->email;

            if (strrpos(mb_strtoupper(\Auth::user()->permissao, 'UTF-8'), "Z") !== false) {
                $usuario->permissao = $request->permissao;
            }

            $usuario->save();

            return Redirect::back()->with('message', 'Usuario atualizado com sucesso!');
        } else {
            return Redirect::back()->withErrors(['Usuario atualizado não encontrada!']);
        }

        // return redirect()->route('dashboard.usuarios');
        return redirect()->back();

    }

    public function delete($idUsuario)
    {
        if (strrpos(mb_strtoupper(\Auth::user()->permissao, 'UTF-8'), "Z") === false) {
            return response()->json(['error' => 'Você não tem permissão para deletar este item, consulte o administrador!']);
        }

        if ($idUsuario == \Auth::id()) {
            return response()->json(['error' => 'Você não pode deletar a si mesmo!']);
        }

        if (User::find($idUsuario) != null) {
            $user = User::find($idUsuario);

            $user->delete();

            return response()->json(['success' => 'Usuário deletado com sucesso!']);
        } else {
            return response()->json(['error' => 'Usuário não encontrado!']);
        }

    }

    public function imagemPerfil($idUsuario)
    {

        $user = User::find($idUsuario);

        if ($user == null) {
            return \Storage::disk('public_images')->response('default-user.jpg');
            // return env('APP_URL') . '/images/default-user.jpg';
        } elseif ($user->img_perfil == null || $user->img_perfil == "") {
            return \Storage::disk('public_images')->response('default-user.jpg');
            // return env('APP_URL') . '/images/default-user.jpg';
        } else {
            if (\Storage::disk('local')->has('uploads/usuarios/perfil/' . $user->img_perfil)) {
                return \Storage::disk('local')->response('uploads/usuarios/perfil/' . $user->img_perfil);
            } else {
                $user->img_perfil = '';
                $user->save();

                return \Storage::disk('public_images')->response('default-user.jpg');
            }
        }

    }

    public function esqueciSenha()
    {
        if (\Auth::check()) {
            return redirect()->route('catalogo');
        }

        return view('user.esqueci-senha');
    }

    public function postEsqueciSenha(Request $request)
    {
        // dd($request);

        $newToken = md5(uniqid(time(), true));

        if (ResetToken::where('email', '=', $request->email)->first() != null) {
            $resetToken = ResetToken::where('email', '=', $request->email)->first();

            $resetToken->token = $newToken;
            $resetToken->created_at = date('Y-m-d H:i:s');

            $resetToken->save();
        } else {
            ResetToken::create([
                "email"      => $request->email,
                "token"      => $newToken,
                "created_at" => date('Y-m-d H:i:s'),
            ]);
        }

        $userEmail = $request->email;
        $userName = ucwords(User::where('email', '=', $request->email)->first()->name);

        // dd($newToken);

        $data = [
            'email' => $userEmail,
            'name'  => $userName,
            'token' => $newToken
        ];

        Mail::send('mail.reset-email', $data, function ($message) use ($data) {
            $message->from('contato@edulabzz.com.br', 'Suporte Jean Piaget');

            $message->to($data['email'], $data['name'])->
            subject('Jean Piaget - Link para resetar senha');
        });

        \Session::flash('message', 'Enviamos para seu email um link para resetar sua senha, verifique em sua caixa de entrada!');

        return redirect()->route('home');

        // return redirect()->route('catalogo');

        // return view('user.esqueci-senha');
    }

    public function resetarSenha($token)
    {
        if (\Auth::check()) {

            Session::flush();
            // return redirect()->route('catalogo');
        }

        return view('user.resetar-senha')->with(compact('token'));
    }

    public function postResetarSenha(Request $request)
    {
        $validatedData = $request->validate([
            'email'    => 'required|string|email|max:255|exists:users',
            'password' => 'required|string|min:6|confirmed',
            // 'password_confirmation' => 'required|string|min:6',
        ]);

        if (strlen($request->password) < 6) {
            \Session::flash('warning', 'A sua nova senha deve ter no mínimo 6 caracteres!');

            return redirect()->back();
        }

        if ($request->password != $request->password_confirmation) {
            \Session::flash('warning', 'A senha de confirmação deve ser idêntica a sua nova senha!');

            return redirect()->back();
        }

        if (User::where('email', '=', $request->email)->first() == null) {
            \Session::flash('warning', 'O email inserido é inválido!');

            return redirect()->back();
        }

        if (ResetToken::where([['email', '=', $request->email], ['token', '=', $request->token]])->first() == null) {
            return redirect()->back()->withErrors('Link para troca de senha inválido, tente fazer uma nova solicitação!');
        }

        $resetToken = ResetToken::where([['email', '=', $request->email], ['token', '=', $request->token]])->first();

        $start_date = new \DateTime(date('Y-m-d H:i:s'));
        $since_start = $start_date->diff(new \DateTime($resetToken->created_at));

        if ($since_start->days === false || $since_start->y > 0 || $since_start->m > 0 || $since_start->d > 0 || $since_start->h > 0 || $since_start->i > 15) {
            ResetToken::where([['email', '=', $request->email], ['token', '=', $request->token]])->delete();

            return redirect()->back()->withErrors('Link para troca de senha expirado, tente fazer uma nova solicitação!');
        }

        $user = User::where('email', '=', $request->email)->first();

        $user->password = \Hash::make($request->password);

        $user->save();

        \Auth::loginUsingId($user->id);

        ResetToken::where([['email', '=', $request->email], ['token', '=', $request->token]])->delete();

        \Session::flash('message', 'Senha alterada com sucesso!');

        return redirect()->route('catalogo');

    }
}


