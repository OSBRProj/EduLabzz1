<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use Image;
use Auth;
use Session;

use App\User;
use App\AvaliacaoInstrutor;

use App\Transacao;
use App\ProdutoTransacao;

// use App\EnderecoUser;
use App\EnderecoUser;
use App\ConfiguracoesNotificacoesUser;


class ConfiguracaoController extends Controller
{
    public function index()
    {
        $user = User::with('escola', 'endereco', 'notificacoes')->find(\Auth::user()->id);

        $transacoes = Transacao::where('user_id', '=', Auth::user()->id)->orderBy('created_at', 'desc')->get();

        foreach ($transacoes as $transacao)
        {
            $transacao->produtos = ProdutoTransacao::where([['transacao_id', '=', $transacao->referencia_id], ['user_id', '=', Auth::user()->id]])->get();
        }

        $totalGasto = Transacao::where('user_id', '=', Auth::user()->id)->sum('total');

        foreach ($transacoes as $transacao)
        {
            switch ($transacao->status)
            {
                case 2:
                    $transacao->status_name = "Processando pagamento";
                    break;
                case 3:
                    $transacao->status_name = "Paga";
                    break;
                case 4:
                    $transacao->status_name = "Concluída";
                    break;
                case 5:
                    $transacao->status_name = "Em disputa";
                    break;
                case 6:
                    $transacao->status_name = "Devolvida";
                    break;
                case 7:
                    $transacao->status_name = "Cancelada";
                    break;
                case 8:
                    $transacao->status_name = "Debitado";
                    break;
                case 9:
                    $transacao->status_name = "Retenção temporária";
                    break;

                default:
                    $transacao->status_name = "Aguardando pagamento";
                    break;
            }
        }

        return view('pages.configuracoes-conta.index')->with(compact('user', 'transacoes', 'totalGasto'));
    }

    public function avaliacoes()
    {
        $professor = User::with('escola')->find(Auth::user()->id);

        if ($professor == null) {
            return redirect()->back()->withErrors("Professor não encontrado!");
        } else if (strtoupper($professor->permissao) != "P" && strtoupper($professor->permissao) != "G" && strtoupper($professor->permissao) != "Z") {
            return redirect()->back()->withErrors("Professor não encontrado!");
        }

        //Relatorios avaliacoes instrutor

        if (AvaliacaoInstrutor::where('instrutor_id', '=', $professor->id)->avg('avaliacao') > 0)
            $avaliacaoInstrutor = AvaliacaoInstrutor::where('instrutor_id', '=', $professor->id)->avg('avaliacao');
        else
            $avaliacaoInstrutor = '-';

        $avaliacoes = AvaliacaoInstrutor::with('user')->where('instrutor_id', '=', $professor->id)->orderBy('created_at', 'desc')->get();

        return view('professor.avaliacoes')->with(compact('professor', 'avaliacoes', 'avaliacaoInstrutor'));
    }

    public function trocarEmail(Request $request)
    {
        Auth::user()->update([
            'email' => $request->email
        ]);

        Session::flash('success', 'Dados alterados com sucesso!');

        return redirect()->back();
    }

    public function salvarDados(Request $request)
    {
        // dd($request->all());

        if ($request->instituicao == null)
            $request->instituicao = "";

        if ($request->descricao == null)
            $request->descricao = "";

        $user = Auth::user();

        $dataNascimento = $request->data_nascimento != null ? $request->data_nascimento : $user->data_nascimento;
        $dataNascimento = str_replace('/', '-', $dataNascimento);
        $dataNascimento = date('Y-m-d', strtotime($dataNascimento));        

        $user->update([
            'name'          => $request->name != null ? $request->name : $user->name,
            'nome_completo' => $request->nome_completo != null ? $request->nome_completo : $user->nome_completo,
            'telefone'      => $request->telefone != null ? $request->telefone : $user->telefone,
            'instituicao'   => $request->instituicao != null ? $request->name : $user->instituicao,
            'descricao'     => $request->descricao != null ? $request->descricao : $user->descricao,
            'genero'          => $request->genero != null ? $request->genero : $user->genero,
            'data_nascimento' => $dataNascimento,
        ]);

        EnderecoUser::updateOrCreate([
            'user_id' => Auth::user()->id
        ], [
            'user_id'     => Auth::user()->id,
            "cep"         => $request->cep,
            "uf"          => $request->uf,
            "cidade"      => $request->cidade,
            "bairro"      => $request->bairro,
            "logradouro"  => $request->logradouro,
            "numero"      => $request->numero,
            "complemento" => $request->complemento,
        ]);

        Session::flash('success', 'Dados alterados com sucesso!');

        return redirect()->back();
        
    }

    public function trocarFotoPerfil(Request $request)
    {

        $fileExtension = \File::extension($request->foto->getClientOriginalName());

        $newFileName = md5($request->foto->getClientOriginalName() . date("Y-m-d H:i:s") . time()) . '.' . $fileExtension;

        $pathFoto = $request->foto->storeAs('uploads/usuarios/perfil', $newFileName, 'local');

        if ($img = Image::make(file_get_contents($request->foto))) {
            $img->resize(250, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $img->encode('jpg', 85);
            // // $img->save($path);
        }

        // if(!\Storage::disk('local')->put($pathFoto, file_get_contents($request->foto)))
        if (!\Storage::disk('local')->put($pathFoto, $img)) {
            \Session::flash('middle_popup', 'Ops! Algo deu errado.');
            \Session::flash('popup_style', 'danger');
        } else {
            $user = User::find(\Auth::user()->id);

            if ($user->img_perfil != null && $user->img_perfil != "") {
                if (\Storage::disk('local')->has('uploads/usuarios/perfil/' . $user->img_perfil)) {
                    \Storage::disk('local')->delete('uploads/usuarios/perfil/' . $user->img_perfil);
                }
            }

            $user->img_perfil = $newFileName;
            $user->save();
        }

        return redirect()->back();

    }

    public function trocarSenha(Request $request)
    {
        // dd($request);

        $user = \Auth::user();

        if (strlen($request->senha_nova) < 6) {
            \Session::flash('middle_popup', 'A sua nova senha deve ter no mínimo 6 caracteres!');
            \Session::flash('popup_style', 'warning');

            return redirect()->back();
        }

        if (\Hash::check($request->senha_nova, $user->password)) {
            \Session::flash('middle_popup', 'A sua nova senha deve ser diferente da anterior!');
            \Session::flash('popup_style', 'warning');

            return redirect()->back();
        }

        if ($request->senha_nova != $request->senha_confirmacao) {
            \Session::flash('middle_popup', 'A senha de confirmação deve ser idêntica a sua nova senha!');
            \Session::flash('popup_style', 'warning');

            return redirect()->back();
        }

        if (\Hash::check($request->senha_atual, $user->password) == false) {
            \Session::flash('middle_popup', 'A sua antiga senha está incorreta!');
            \Session::flash('popup_style', 'danger');

            return redirect()->back();
        }

        $user->update([
            'password' => \Hash::make($request->senha_nova)
        ]);

        \Session::flash('success', 'Senha alterada com sucesso!');

        return redirect()->back();

    }


    public function notificacoes(Request $request)
    {
        //dd($request->all());
        foreach ($request->all() as $key => $value) {
            if($value == 'on')
            {
                $request[$key] = true;
            }
        }        

        if($request->has('rcb_notif_resp_professor') == false)
        {
            $request->request->add(['rcb_notif_resp_professor' => false]);
        }
        if($request->has('rcb_notif_resp_aluno') == false)
        {
            $request->request->add(['rcb_notif_resp_aluno' => false]);
        }
        if($request->has('rcb_notif') == false)
        {
            $request->request->add(['rcb_notif' => false]);
        }

        ConfiguracoesNotificacoesUser::updateOrCreate(['user_id' => Auth::user()->id], $request->all());

        return redirect()->back()->with('success', 'Configurações de Notificações Salvas com Sucesso!');
        //return redirect()->back();
    }

}
