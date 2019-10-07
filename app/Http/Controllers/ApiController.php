<?php

namespace App\Http\Controllers;

use App\ResetToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

use Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Redirect;
use Session;
use Carbon\Carbon;

use App\Escola;
use App\Categoria;
use App\Aplicacao;
use App\Conteudo;
use App\AvaliacaoInstrutor;
use App\Matricula;
use App\Metrica;

use App\AvaliacaoConteudo;
use App\ProgressoConteudo;
use App\CodigoTransmissao;

use App\User;
use App\Turma;
use App\AlunoTurma;
use App\PostagemTurma;
use App\Badge;
use App\BadgeUsuario;

use App\DuvidaProfessor;
use App\ComentarioDuvidaProfessor;

use App\Entities\Glossario\Repository;

class ApiController extends Controller
{
    public function index()
    {
        return response()->json(["success" => "Api para comunicação das aplicações Jean Piaget, para mais informações leia a documentação."], 200, [], JSON_UNESCAPED_UNICODE);
    }




    public function userStore(Request $request)
    {
        $customMessages = [
            'name.required'               => "O campo Nome é obrigatório.",
            'email.required'              => "O campo E-mail é obrigatório.",
            'email.unique'                => "E-mail já foi utilizado.",
            'email.email'                 => "O campo E-mail deve ser um endereço de e-mail válido.",
            "data_nascimento.required"    => "O campo Data de nascimento é obrigatório.",
            "data_nascimento.date_format" => "Data de nascimento é inválida.",
            "password.required"           => "O campo Senha é obrigatório.",
            "password.min"                => "O campo Senha deve ter no mínimo :min caracteres.",
            "password.confirmed"          => "A confirmação de Senha não está correta",
        ];
        $validate = Validator::make($request->all(), [
            'name'            => ['required', 'string', 'max:255'],
            'email'           => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'data_nascimento' => ['required', 'string', 'date_format:d/m/Y'],
            'password'        => ['required', 'string', 'min:6', 'confirmed']
        ], $customMessages);

        if ($validate->fails()) {
            return response()->json(['error' => true, 'errorMessage' => $validate->errors()]);
        }

        $dateInput = str_replace("/", '-', $request->get('data_nascimento'));

        try {
            User::create(
                ['name'             => $request->get('name'),
                 'email'            => $request->get('email'),
                 'data_nascimento'  => date('Y-m-d', strtotime($dateInput)),
                 'password'         => Hash::make($request->get('password')),
                 'ultima_atividade' => date("Y-m-d H:i:s")
                ]);
            return response()->json(['success' => 'Cadastro realizado com sucesso!']);
        } catch (\Exception $exception) {
            return response()->json(['error' => 'Erro ao realizar cadastro. ' . $exception->getMessage()]);
        }
    }




    public function userUpdate(Request $request)
    {
        $userId = Auth::user()->id;

        /**
         * Update profile
         */
        if ($request->get('password') === null) {
            $validate = Validator::make($request->all(), [
                'name'            => ['required', 'string', 'max:255'],
                'data_nascimento' => ['required', 'string']
            ]);
            if ($validate->fails()) {
                return response()->json(['error' => true, 'errorMessage' => $validate->errors()]);
            }
            try {
                User::find($userId)->update([
                    'name'             => $request->get('name'),
                    'data_nascimento'  => date('Y-m-d', strtotime($request->get('data_nascimento'))),
                    'ultima_atividade' => date("Y-m-d H:i:s")
                ]);
                return response()->json(['success' => 'Perfil alterado com sucesso!']);
            } catch (\Exception $exception) {
                return response()->json(['error' => 'Erro ao atualizar perfil. ' . $exception->getMessage()]);
            }
        }


        /**
         * Update password
         */

        $validate = Validator::make($request->all(), [
            'name'            => ['required', 'string', 'max:255'],
            'data_nascimento' => ['required', 'string'],
            'password'        => ['required', 'string', 'min:6', 'confirmed']
        ]);

        if ($validate->fails()) {
            return response()->json(['error' => true, 'errorMessage' => $validate->errors()]);
        }

        try {
            User::find($userId)->update([
                'name'             => $request->get('name'),
                'data_nascimento'  => date('Y-m-d', strtotime($request->get('data_nascimento'))),
                'password'         => Hash::make($request->get('password')),
                'ultima_atividade' => date("Y-m-d H:i:s")
            ]);
            return response()->json(['success' => 'Perfil realizado com sucesso!']);
        } catch (\Exception $exception) {
            return response()->json(['error' => 'Erro ao atualizar perfil. ' . $exception->getMessage()]);
        }


    }




    public function userUpdateImage(Request $request)
    {

        try {
            $userAuth = User::find(Auth::user()->id);
            if ($request->hasFile('image_name') && $request->file('image_name')->isValid()) {

                $name = uniqid($userAuth->id) . kebab_case(uniqid(date('HisYmd')));
                $extension = pathinfo($request->image_name->getClientOriginalName())['extension'];

                if ($name && $extension) {
                    $nameImage = "{$name}.{$extension}";
                } else {
                    $nameImage = "";
                }

                if (Storage::disk('local')->has('uploads/usuarios/perfil/' . $userAuth->img_perfil)) {
                    Storage::disk('local')->delete('uploads/usuarios/perfil/' . $userAuth->img_perfil);
                }
                $upload = $request->image_name->storeAs('uploads/usuarios/perfil', $nameImage);

                if (!$upload) {
                    return response()->json(array('response' => false, 'data' => 'Falha no upload da imagem'), 500);
                }
                $userAuth->update(['img_perfil' => $nameImage]);
                return response()->json('Imagem atualizada com succeso!');
            }

            return response()->json(array('response' => false, 'data' => 'Falha no upload da imagem'), 500);

        } catch (\Exception $exception) {
            return response()->json(['error' => 'Erro ao atualizar imagem. ' . $exception->getMessage()]);
        }
    }




    public function userForgetPass(Request $request)
    {
        $emailInput = $request->get('email');

        $validate = Validator::make($request->all(), ['email' => ['required', 'string', 'email', 'max:255'],]);
        if ($validate->fails()) {
            return response()->json(['error' => true, 'errorMessage' => $validate->errors()]);
        }

        if (User::where('email', $emailInput)->exists() === false) {
            return response()->json(['error' => true, 'errorMessage' => 'E-mail não cadastrado.']);
        }

        $token = md5(uniqid(time(), true));

        if (ResetToken::where('email', '=', $emailInput)->first() != null) {
            $resetToken = ResetToken::where('email', '=', $emailInput)->first();
            $resetToken->delete();

            /*$resetToken->token = $token;
            $resetToken->created_at = date('Y-m-d H:i:s');

            ResetToken::find($resetToken->id)->update([
                'token'      => $token,
                'created_at' => date('Y-m-d H:i:s')
            ]);

            $resetToken->save();*/
        }

        ResetToken::create(['email' => $emailInput, 'token' => $token, 'created_at' => date('Y-m-d H:i:s')]);

        $userEmail = $request->email;
        $userName = ucwords(User::where('email', '=', $request->email)->first()->name);

        $data = ['email' => $userEmail, 'name' => $userName, 'token' => $token];

        Mail::send('mail.reset-email', $data, function ($message) use ($data) {
            $message->from('contato@edulabzz.com.br', 'Suporte J Piaget');
            $message->to($data['email'], $data['name'])->subject('Link para resetar sua senha');
        });

        return response()->json(['success' => 'Enviamos para seu email um link para resetar sua senha, verifique em sua caixa de entrada!']);

    }




    public function aplicacao($idAplicacao)
    {
        if (App\Aplicacao::find($idAplicacao) != null) {
            $aplicacao = App\Aplicacao::find($idAplicacao);
        } else {
            \Session::flash('warning', 'Aplicação não encontrada!');
            return redirect()->route('catalogo');
        }

        Metrica::create([
            'user_id' => Auth::check() ? Auth::user()->id : 0,
            'titulo'  => 'Jogar aplicação - ' . $aplicacao->id
        ]);

        return view('play.aplicacao-fullscreen')->with(compact('aplicacao'));

    }




    public function postLogin(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], ($request->get('remember') ? true : false))) {
            return response()->json([
                "success" => "Autenticado com sucesso!",
                "logado"  => Auth::check(),
                "user"    => Auth::user(),
            ]);
        } else {
            return response()->json(["error" => "Usuário ou senha incorretos."]);
        }
    }




    public function logout()
    {
        Auth::logout();

        return response()->json(["success" => "Deslogado com sucesso."]);
    }




    public function getUser()
    {
        if (Auth::check()) {
            $user = User::where('id', Auth::user()->id)
                ->select('id', 'name', 'email', 'img_perfil as avatar', 'nome_completo', 'data_nascimento as born_date', 'ultima_atividade')
                ->first();
            return response()->json(["success" => "Você está autenticado!", "user" => $user]);
            //return response()->json(["success" => "Você está autenticado!", "user" => Auth::user()]);
        } else {
            return response()->json(["error" => "Não autenticado", "auth" => false]);
        }

    }




    public function getAplicacoes(Request $request)
    {
        // dd($request);

        if ($request->categoria != null) {
            if (Categoria::where('titulo', '=', $request->categoria)->first() != null) {
                $categoria = Categoria::where('titulo', 'like', $request->categoria)->first();
            } else {
                $categoria = null;
            }
        } else {
            $categoria = null;
        }

        if ($categoria != null) {
            $aplicacoes = Aplicacao::with('categoria')->where([['status', '=', '1'], ['categoria_id', '=', $categoria->id]]);

            $aplicacoes = $aplicacoes->orWhere([['status', '=', '1'], ['tags', 'like', '%' . $categoria->titulo . '%']]);
        } elseif ($request->marcador != null && $request->marcador != "" && $request->marcador != "0") {
            $aplicacoes = Aplicacao::with('categoria')->where([['status', '=', '1'], ['categoria_id', '=', $request->marcador]]);

            $aplicacoes = $aplicacoes->orWhere([['status', '=', '1'], ['tags', 'like', '%' . $request->marcador . '%']]);
        } else {
            $aplicacoes = Aplicacao::with('categoria')->where([['status', '=', '1']]);
        }

        $aplicacoes = $aplicacoes->get();

        foreach ($aplicacoes as $aplicacao) {
            // $aplicacao->marcadores = json_decode($aplicacao->tags);
            $aplicacao->marcadores = $aplicacao->tags;
        }

        $categorias = Categoria::where([['tipo', '=', 0]])
            ->orWhere([['tipo', '=', 3]])
            // ->take(12)
            // ->distinct()
            ->orderBy('titulo', 'asc')
            ->get()
            ->unique('titulo');

        $marcadores = [];

        foreach (Aplicacao::groupBy('tags')->pluck('tags') as $tags) {
            if ($tags != null) {
                foreach ($tags as $tag) {
                    if (!in_array($tag, $marcadores) && !$categorias->contains('titulo', $tag) && $tag != "") {
                        array_push($marcadores, $tag);
                    }
                }
            }
        }

        return response()->json(["success" => "Aplicações carregadas com sucesso!", "aplicacoes" => $aplicacoes, "categorias" => $categorias, "marcadores" => $marcadores]);
    }




    public function getAplicacao($idAplicacao)
    {
        if (Aplicacao::with('categoria')->find($idAplicacao) != null) {
            $aplicacao = Aplicacao::with('categoria')->find($idAplicacao);

            // $aplicacao->marcadores = json_decode($aplicacao->tags);
            $aplicacao->marcadores = $aplicacao->tags;

            $aplicacao->relacionados = Aplicacao::with('categoria')->where([['id', '!=', $aplicacao->id], ['categoria_id', '=', $aplicacao->categoria_id]])->get();
        } else {
            return response()->json(["error" => "Aplicação não encontrada!"]);
        }

        return response()->json(["success" => "Aplicação encontrada com sucesso!", "aplicacao" => $aplicacao]);
    }




    public function getAplicacaoPlay($idAplicacao)
    {
        if (Aplicacao::find($idAplicacao) != null) {
            $aplicacao = Aplicacao::find($idAplicacao);
        } else {
            return response()->json(["error" => "Aplicação não encontrada!"]);
            // \Session::flash('warning', 'Aplicação não encontrada!');
            // return redirect()->route('catalogo');
        }

        Metrica::create([
            'user_id' => Auth::check() ? Auth::user()->id : 0,
            'titulo'  => 'Jogar aplicação - ' . $aplicacao->id
        ]);

        return redirect(env('APP_URL') . "/uploads/aplicacoes/" . $idAplicacao . "/");

        // return view('play.aplicacao-fullscreen')->with( compact('aplicacao') );
    }




    public function postNovaMetrica(Request $request)
    {
        if ($request->titulo == null) {
            return response()->json(["error" => "Você precisa preencher o título da métrica!"]);
        }

        // if($request->descricao == null)
        // {
        //     return response()->json([ "error" => "Você precisa preencher a descrição da métrica!" ]);
        // }

        Metrica::create([
            'user_id'   => Auth::check() ? Auth::user()->id : 0,
            'titulo'    => $request->titulo,
            'descricao' => $request->descricao
        ]);

        return response()->json(["success" => "Métrica cadastrada com sucesso!"]);
    }




    public function getConteudos()
    {
        if (Input::get('qt') == null)
            $amount = 100;
        else
            $amount = Input::get('qt');

        if (Input::get('ordem') == null)
            $ordem = "recentes";
        else
            $ordem = Input::get('ordem');

        if (Input::get('categoria') == null)
            $categoria = "";
        elseif (Input::get('categoria') == "geral")
            $categoria = "";
        else
            $categoria = Input::get('categoria');

        if ($categoria != null) {
            if (Categoria::where('titulo', '=', $categoria)->first() != null) {
                $categoria = Categoria::where('titulo', '=', $categoria)->first()->id;
            }
        }

        // Carregar aplicacoes

        if (Input::get('pesquisa') == null || Input::get('pesquisa') == "") {
            $pesquisa = null;

            if ($categoria != null)
                $aplicacoes = Aplicacao::take($amount)->where([['status', '=', '1'], ['categoria', '=', $categoria]]);
            else
                $aplicacoes = Aplicacao::take($amount)->where([['status', '=', '1']]);

            if ($categoria != null)
                $conteudos = Conteudo::take($amount)->where([['status', '=', '1'], ['categoria', '=', $categoria]]);
            else
                $conteudos = Conteudo::take($amount)->where([['status', '=', '1']]);
        } else {
            $aplicacoes = Aplicacao::take($amount)->where([['status', '=', '1'], ['titulo', 'like', '%' . Input::get('pesquisa') . '%']])
                ->orWhere('descricao', 'like', '%' . Input::get('pesquisa') . '%');

            $conteudos = Conteudo::take($amount)->where([['status', '=', '1'], ['titulo', 'like', '%' . Input::get('pesquisa') . '%']])
                ->orWhere('descricao', 'like', '%' . Input::get('pesquisa') . '%');
        }

        if ($ordem == 'recentes') {
            $aplicacoes = $aplicacoes->orderBy('created_at', 'desc');

            $conteudos = $conteudos->orderBy('created_at', 'desc');

            $ordem = "Mais recentes";
        } elseif ($ordem == 'antigos') {
            $aplicacoes = $aplicacoes->orderBy('created_at', 'asc');

            $conteudos = $conteudos->orderBy('created_at', 'asc');

            $ordem = "Mais antigos";
        } elseif ($ordem == 'alfabetica') {
            $aplicacoes = $aplicacoes->orderBy('titulo', 'asc');

            $conteudos = $conteudos->orderBy('titulo', 'asc');

            $ordem = "Ordem Alfabética";
        }

        $aplicacoes = $aplicacoes->get();

        $conteudos = $conteudos->get();

        $categorias = Categoria::take(8)->get();

        $videos = $conteudos->filter(function ($c) {
            return $c->tipo == 3;
        });
        $slides = $conteudos->filter(function ($c) {
            return ($c->tipo == 4 && (strpos($conteudo->conteudo, ".ppt") !== false || strpos($conteudo->conteudo, ".pptx") !== false));
        });
        $documentos = $conteudos->filter(function ($c) {
            return $c->tipo == 1 || ($c->tipo == 4 && (strpos($conteudo->conteudo, ".ppt") == false && strpos($conteudo->conteudo, ".pptx") == false));
        });

        $apostilas = $conteudos->filter(function ($c) {
            return $c->tipo == 11;
        });

        $success = "Conteúdos carregados com sucesso!";

        return response()->json(compact('success', 'conteudos', 'pesquisa', 'amount', 'ordem', 'categorias'));
        // return response()->json( compact('success', 'conteudos', 'videos', 'slides', 'documentos', 'aplicacoes', 'pesquisa', 'amount', 'ordem', 'categorias') );
    }




    public function getConteudo($idConteudo)
    {
        if (Conteudo::find($idConteudo) != null) {
            $conteudo = Conteudo::find($idConteudo);
        } else {
            return response()->json(["error" => "Conteúdo não encontrado!"]);
        }

        return response()->json(["success" => "Conteúdo encontrado com sucesso!", "conteudo" => $conteudo]);
    }




    public function getConteudoPlay($idConteudo)
    {
        if (Conteudo::find($idConteudo)) {
            $conteudo = Conteudo::find($idConteudo);
        } else {
            return response()->json(["error" => "Conteúdo não encontrado!"]);
        }

        if ($conteudo->status != 1) {
            if (Auth::check() ? (strtolower(Auth::user()->permissao) != "z" && $conteudo->user_id != Auth::user()->id) : true) {
                return response()->json(["error" => "Conteúdo não encontrado!"]);
            }
        }

        if ($conteudo->tipo == 2) {
            if (strpos($conteudo->conteudo, "soundcloud.com") !== false) {
                $conteudo->conteudo = '<iframe width="100%" height="166" scrolling="no" frameborder="no" allow="autoplay" src="https://w.soundcloud.com/player/?url=' . $conteudo->conteudo . '&color=%236766a6&auto_play=false&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true"></iframe>';
            } elseif (strpos($conteudo->conteudo, "http") !== false || strpos($conteudo->conteudo, "www") !== false) {
                $conteudo->conteudo = '<audio controls style="width: 100%;">
                    <source src="' . $conteudo->conteudo . '" type="audio/mp3">
                    Your browser does not support the audio element.
                </audio>';
            } else {
                $conteudo->conteudo = '<audio controls style="width: 100%;">
                    <source src="' . route('conteudo.play.get-arquivo', ['idConteudo' => $idConteudo]) . '" type="audio/mp3">
                    Your browser does not support the audio element.
                </audio>';
            }
        } else if ($conteudo->tipo == 3) {
            if (strpos($conteudo->conteudo, "youtube") !== false || strpos($conteudo->conteudo, "youtu.be") !== false) {
                if (strpos($conteudo->conteudo, "youtu.be") !== false) {
                    $conteudo->conteudo = str_replace("youtu.be", "youtube.com", $conteudo->conteudo);
                }

                $conteudo->conteudo = str_replace("/watch?v=", "/embed/", $conteudo->conteudo);

                if (strpos($conteudo->conteudo, "&") !== false) {
                    $conteudo->conteudo = substr($conteudo->conteudo, 0, strpos($conteudo->conteudo, "&"));
                }

                $conteudo->conteudo = '<iframe src="' . $conteudo->conteudo . '" style="width: 100%; height: 41vw;" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen>
                </iframe>';

            } elseif (strpos($conteudo->conteudo, "vimeo") !== false) {
                if (strpos($conteudo->conteudo, "player.vimeo.com") === false)
                    $conteudo->conteudo = str_replace("vimeo.com/", "player.vimeo.com/video/", $conteudo->conteudo);

                $conteudo->conteudo = '<iframe src="' . $conteudo->conteudo . '" style="width: 100%; height: 41vw;" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen>
                </iframe>';
            } else {
                $conteudo->conteudo = '<video controls style="width: 100%; height: 41vw;">
                    <source src="' . route('conteudo.play.get-arquivo', ['idConteudo' => $idConteudo]) . '" type="video/mp4">
                    Your browser does not support the audio element.
                </video>';
            }
        } else if ($conteudo->tipo == 4) {
            if (strpos($conteudo->conteudo, ".ppt") !== false || strpos($conteudo->conteudo, ".pptx") !== false) {
                $conteudo->conteudo = '<iframe src="https://view.officeapps.live.com/op/view.aspx?src=' . route('conteudo.play.get-arquivo', ['idConteudo' => $idConteudo]) . '" style="width: 100%; height: 41vw;" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen>
                </iframe>';
            } elseif (strpos($conteudo->conteudo, ".html") !== false) {
                $conteudo->conteudo = '<iframe src="' . route('conteudo.play.get-arquivo', ['idConteudo' => $idConteudo]) . '" style="width: 100%; height: 41vw;" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen>
                </iframe>';
            } else {
                $conteudo->conteudo = '<object data="' . route('conteudo.play.get-arquivo', ['idConteudo' => $idConteudo]) . '" type="application/pdf" style="width: 100%; height: 41vw;">
                </object>';
            }

        }

        $conteudo->qtAvaliacoesPositivas = AvaliacaoConteudo::where([['avaliacao', '=', '1'], ['conteudo_id', '=', $idConteudo]])->count();

        $conteudo->qtAvaliacoesNegativas = AvaliacaoConteudo::where([['avaliacao', '=', '0'], ['conteudo_id', '=', $idConteudo]])->count();

        $conteudo->minhaAvaliacao = AvaliacaoConteudo::where([['user_id', '=', Auth::user()->id], ['conteudo_id', '=', $idConteudo]])->first();

        if (!ProgressoConteudo::where([['conteudo_id', '=', $idConteudo], ['tipo', '=', 2], ['user_id', '=', Auth::user()->id]])->exists()) {
            ProgressoConteudo::create([
                'conteudo_id' => $idConteudo,
                'tipo'        => 2,
                'user_id'     => Auth::user()->id
            ]);
        }

        return view('play.conteudo-fullscreen')->with(compact('conteudo'));
    }




    public function getCodigoTransmissao($idTransmissao)
    {
        $transmissao = CodigoTransmissao::where([['id', '=', $idTransmissao], ['status', '=', 1]])->orWhere([['token', '=', $idTransmissao], ['status', '=', 1]])->first();

        if ($transmissao == null) {
            return response()->json(["error" => "Transmissão não encontrada!"]);
        } else {
            if ($transmissao->tipo == 1 || $transmissao->tipo == 2) {
                return response()->json(["success" => "Código de transmissão encontrado!", 'transmissao' => $transmissao]);
            } else {
                return response()->json(["error" => "Transmissão não encontrada!"]);
            }
        }

        return response()->json(["error" => "Transmissão não encontrada!"]);
    }




    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }




    public function getGlossario($letra = 'A')
    {
        if (strlen($letra) == 1) {
            $glossarios = $this->repository->all($letra);
        } else {
            $glossarios = $this->repository->search($letra);
        }

        return response()->json(["success" => "Palavras encontradas!", 'glossarios' => $glossarios, 'letra' => $letra]);
    }




    public function getBadges()
    {
        $badges = Badge::where([['visibilidade', '=', '1']])->get();

        foreach (BadgeUsuario::with('badge')->where('user_id', '=', Auth::user()->id)->get() as $minha) {
            if ($badges->contains(function ($value, $key) use ($minha) {
                return $value->id == $minha->badge->id;
            })) {
                $badges->first(function ($value, $key) use ($minha) {
                    return $value->id == $minha->badge->id;
                })->desbloqueada = true;
            } else {
                $minha = $minha->badge;

                $minha->desbloqueada = true;

                $badges->push($minha);
            }
        }

        return response()->json(["success" => "Medalhas carregadas com sucesso!", 'badges' => $badges]);
    }




    public function getMuralTurma($idTurma)
    {
        if (Input::get('qt') == null)
            $amount = 10;
        else
            $amount = Input::get('qt');

        if (Turma::find($idTurma) == null) {
            return response()->json(["error" => "Turma não encontrada!"]);
        } else {
            $turma = Turma::with('professor', 'postagens_comentarios', 'escola')->find($idTurma);

            if (strpos(Auth::user()->permissao, "G") === false && strpos(Auth::user()->permissao, "Z") === false && $turma->user_id != Auth::user()->id && (AlunoTurma::where([['turma_id', '=', $idTurma], ['user_id', '=', Auth::user()->id]])->first() == null)) {
                return response()->json(["error" => "Você não faz parte desta turma!"]);
            }

            if (strpos(Auth::user()->permissao, "Z") !== false || $turma->user_id == Auth::user()->id) {
                if (md5($turma->id . $turma->created_at) != $turma->codigo_convite) {
                    $newCodigo = md5($turma->id . $turma->created_at);

                    $turma->update([
                        'codigo_convite' => $newCodigo
                    ]);
                }
            }

            $alunos = AlunoTurma::with('user')->where('turma_id', '=', $idTurma)->paginate($amount);

            $success = "Mural carregado com sucesso!";

            return response()->json(compact('success', 'turma', 'alunos', 'amount'));

        }
    }




    public function postMuralTurma($idTurma, Request $request)
    {
        if (Turma::find($idTurma) == null) {
            return response()->json(["error" => "Turma não encontrada!"]);
        } else {
            $turma = Turma::find($idTurma);

            if (strpos(Auth::user()->permissao, "G") === false && strpos(Auth::user()->permissao, "Z") === false && $turma->user_id != Auth::user()->id && (AlunoTurma::where([['turma_id', '=', $idTurma], ['user_id', '=', Auth::user()->id]])->first() == null)) {
                return response()->json(["error" => "Você não faz parte desta turma!"]);
            }

            $postagem = PostagemTurma::create([
                'turma_id' => $idTurma,
                'user_id'  => Auth::user()->id,
                'conteudo' => $request->conteudo
            ]);

            // if($request->arquivo != null)
            // {
            //     $originalName = mb_strtolower( $request->arquivo->getClientOriginalName(), 'utf-8' );

            //     $fileExtension = \File::extension($request->arquivo->getClientOriginalName());
            //     $newFileNameArquivo =  md5( $request->arquivo->getClientOriginalName() . date("Y-m-d H:i:s") . time() ) . '.' . $fileExtension;

            //     $pathArquivo = $request->arquivo->storeAs('uploads/turmas/' . $idTurma . '/arquivos', $newFileNameArquivo, 'local');

            //     if(!\Storage::disk('local')->put($pathArquivo, file_get_contents($request->arquivo)))
            //     {
            //         \Session::flash('error', 'Não foi possível fazer upload de seu anexo!');
            //     }
            //     else
            //     {
            //         $postagem->update([
            //             'arquivo' => $newFileNameArquivo
            //         ]);
            //     }
            // }

            return response()->json(["success" => "Postagem enviada com sucesso!"]);
        }
    }




    public function getDuvidasProfessor($idProfessor)
    {
        $professor = User::with('escola')->find($idProfessor);

        if ($professor == null) {
            return response()->json(["error" => "Professor não encontrado!"]);
        } else if (strtoupper($professor->permissao) != "P" && strtoupper($professor->permissao) != "G" && strtoupper($professor->permissao) != "Z") {
            return response()->json(["error" => "Professor não encontrado!"]);
        }

        if (AvaliacaoInstrutor::where('instrutor_id', '=', $idProfessor)->avg('avaliacao') > 0)
            $avaliacaoInstrutor = AvaliacaoInstrutor::where('instrutor_id', '=', $idProfessor)->avg('avaliacao');
        else
            $avaliacaoInstrutor = '-';

        $duvidas = DuvidaProfessor::where([['professor_id', '=', $idProfessor]])->get();

        foreach ($duvidas as $duvida) {
            $duvida->qt_comentarios = ComentarioDuvidaProfessor::where([['duvida_id', '=', $duvida->id]])->count();
        }

        // dd($duvidas);

        $success = "Duvidas do professor carregadas com sucesso!";

        return response()->json(compact('success', 'duvidas', 'professor', 'avaliacaoInstrutor'));
    }




    public function getDuvidaProfessor($idProfessor, $idDuvida)
    {
        $duvida = DuvidaProfessor::with('professor', 'user', 'comentarios')->has('professor')->has('user')->find($idDuvida);

        // dd($duvida);

        if ($duvida == null) {
            return response()->json(["error" => "Dúvida não encontrada!"]);
        }

        if (AvaliacaoInstrutor::where('instrutor_id', '=', $duvida->professor->id)->avg('avaliacao') > 0)
            $avaliacaoInstrutor = AvaliacaoInstrutor::where('instrutor_id', '=', $duvida->professor->id)->avg('avaliacao');
        else
            $avaliacaoInstrutor = '-';

        $success = "Duvida carregada com sucesso!";

        return response()->json(compact('success', 'duvida', 'avaliacaoInstrutor'));
    }




    public function getAvaliacoesProfessor($idProfessor)
    {
        $professor = User::with('escola')->find($idProfessor);

        if ($professor == null) {
            return response()->json(["error" => "Professor não encontrado!"]);
        } else if (strtoupper($professor->permissao) != "P" && strtoupper($professor->permissao) != "G" && strtoupper($professor->permissao) != "Z") {
            return response()->json(["error" => "Professor não encontrado!"]);
        }

        //Relatorios avaliacoes instrutor

        if (AvaliacaoInstrutor::where('instrutor_id', '=', $idProfessor)->avg('avaliacao') > 0)
            $avaliacaoInstrutor = AvaliacaoInstrutor::where('instrutor_id', '=', $idProfessor)->avg('avaliacao');
        else
            $avaliacaoInstrutor = '-';

        $avaliacoes = AvaliacaoInstrutor::with('user')->where('instrutor_id', '=', $idProfessor)->orderBy('created_at', 'desc')->get();

        $success = "Avaliações carregadas com sucesso!";

        return response()->json(compact('success', 'professor', 'avaliacoes', 'avaliacaoInstrutor'));
    }




    public function postProgressoConteudo($idConteudo, Request $request)
    {
        if ($request->tipo == null) {
            return response()->json(["error" => "Você deve informar o tipo de conteúdo!"]);
        } elseif ($request->tipo != 1 || $request->tipo != 2) {
            return response()->json(["error" => "Tipo de conteúdo inválido!"]);
        } elseif ($request->progresso == null) {
            return response()->json(["error" => "Você deve informar o progresso do usuário neste conteúdo!"]);
        }

        if (!ProgressoConteudo::where([['conteudo_id', '=', $idConteudo], ['tipo', '=', $request->tipo], ['user_id', '=', Auth::user()->id]])->exists()) {
            ProgressoConteudo::create([
                'conteudo_id' => $idConteudo,
                'tipo'        => $request->tipo,
                'user_id'     => Auth::user()->id,
                'progresso'   => $request->progresso
            ]);

            return response()->json(["success" => "Progresso atualizado com sucesso!"]);
        } else {
            ProgressoConteudo::where([['conteudo_id', '=', $idConteudo], ['tipo', '=', $request->tipo], ['user_id', '=', Auth::user()->id]])->first()->update([
                'progresso' => $request->progresso
            ]);

            return response()->json(["success" => "Progresso atualizado com sucesso!"]);
        }
    }

}
