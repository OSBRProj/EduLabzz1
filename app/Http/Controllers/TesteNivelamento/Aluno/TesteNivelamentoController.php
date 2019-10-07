<?php

namespace App\Http\Controllers\TesteNivelamento\Aluno;

use App\Entities\Questoes\Questoes;
use App\Entities\TesteNivelamento\TesteNivelamento;
use App\Entities\TesteNivelamento\TesteNivelamentoQuestao;
use App\Entities\TesteNivelamento\TesteNivelamentoRespostaQuestao;
use App\Entities\TesteNivelamento\TesteNivelamentoResultado;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TesteNivelamentoController extends Controller
{


    private $teste;
    private $testeQuestao;
    private $testeResultado;
    private $testeRespostaQuestao;
    private $questao;

    public function __construct(
        TesteNivelamento $teste,
        TesteNivelamentoQuestao $testeQuestao,
        TesteNivelamentoResultado $testeResultado,
        TesteNivelamentoRespostaQuestao $testeRespostaQuestao,
        Questoes $questao)
    {
        $this->teste = $teste;
        $this->testeQuestao = $testeQuestao;
        $this->testeResultado = $testeResultado;
        $this->testeRespostaQuestao = $testeRespostaQuestao;
        $this->questao = $questao;
    }


    public function index()
    {
        $testes = $this->teste->orderBy('id', 'DESC')->get();
        $finalizados = $this->testeResultado
            ->where('user_id', Auth::user()->id)
            ->where('status', 0)
            ->orWhere('status', 2)
            ->get();

        $abertos = $this->testeResultado
            ->where('user_id', Auth::user()->id)
            ->where('status', 1)
            ->get();
        return view('pages.teste.aluno.index', compact('testes', 'finalizados', 'abertos'));
    }


    public function show($idTeste)
    {
        // verifica se o status do teste esta em aberto
        $check = $this->testeResultado
            ->where('user_id', '=', Auth::user()->id)
            ->where('teste_id', '=', $idTeste)
            ->where('status', '=', 1)
            ->first();
        if ($check) {
            $teste = $this->teste->find($idTeste);

            $getQuestoesRespondidas = $this->testeRespostaQuestao
                ->where('teste_nivelamento_resultado_id', '=', $check->id)
                ->select('questao_id')
                ->get()
                ->toArray();
            $questoesRespondidas = array_pluck($getQuestoesRespondidas, 'questao_id');


            if ($teste->questoes->whereNotIn('questao_id', $questoesRespondidas)->count() <= 0) {
                return redirect()->route('teste.finalizado', $check->id);
            }

            Session::flash('msgTeste', 'Teste em aberto, finalize o teste para concluir.');
            return redirect()->route('teste.questao.exibe', [
                'idTeste'     => $teste->id,
                'idQuestao'   => $teste->questoes->whereNotIn('questao_id', $questoesRespondidas)->first()->questao_id,
                'resultadoId' => $check->id
            ]);
        }


        /*
         * grava um novo teste na tabela teste_nivelamento_resultados
         * Status
         * 0 = finalizado, todas multipla escolha
         * 1 = aberto, teste em andamento
         * 2 = aguardando correção, questão dissertativa encontrada
         */
        $resultado = $this->testeResultado->create([
            'user_id'  => Auth::user()->id,
            'teste_id' => $idTeste,
            'status'   => 1
        ]);

        $teste = $this->teste->find($idTeste);
        return redirect()->route('teste.questao.exibe', ['idTeste' => $teste->id, 'idQuestao' => $teste->questoes[0]->questao_id, 'resultadoId' => $resultado->id]);
    }

    public function getQuestao($idTeste, $idQuestao, $resultadoId)
    {
        $getQuestoesRespondidas = $this->testeRespostaQuestao
            ->where('teste_nivelamento_resultado_id', '=', $resultadoId)
            ->select('questao_id')
            ->get()
            ->toArray();
        $questoesRespondidas = array_pluck($getQuestoesRespondidas, 'questao_id');

        $teste = $this->teste->find($idTeste);
        $testeQuestao = $this->questao->find($idQuestao);
        $pesoQuestao = $this->testeQuestao
            ->where('teste_id', $idTeste)
            ->where('questao_id', $idQuestao)
            ->select('peso')
            ->first();


        $testeResultado = $this->testeResultado->find($resultadoId);
        $expired = $testeResultado->status;

        //$now = Carbon::now();
        $final_date = $testeResultado->created_at->addMinutes($teste->tempo);
        //$remainingMinutes = $now->diffInMinutes($final_date);
        //$tempoRestante = date('H:i', mktime(0, $remainingMinutes));


        if ($expired == 0 || $expired == 2) {
            Session::flash('msgExpirado', 'O tempo para responder o teste já foi expirado.');
        }

        return view('pages.teste.aluno.show', compact('teste', 'testeQuestao', 'pesoQuestao', 'resultadoId', 'expired', 'questoesRespondidas', 'final_date'));
    }


    public function cadastroQuestoes(Request $request)
    {
        // Verifica se a questão enviada é multipla escolha
        if ($request->get('alternativa')) {
            $respostaAluno = $request->get('alternativa');
            $respostaCorreta = $this->questao->find($request->get('questao_id'))->resposta_correta;


            $this->testeRespostaQuestao->create([
                'teste_nivelamento_resultado_id' => $request->get('teste_nivelamento_resultado_id'),
                'questao_id'                     => $request->get('questao_id'),
                'user_id'                        => Auth::user()->id,
                'resposta'                       => $respostaAluno,
                'correta'                        => $respostaCorreta
            ]);


            // verifica se a resposta esta correta e atualiza a soma da pontuação
            if ($respostaAluno == $respostaCorreta) {
                $resultado = $this->testeResultado->find($request->get('teste_nivelamento_resultado_id'));
                $pontuacaoAtual = $resultado->pontuacao;
                $peso = $this->testeQuestao
                    ->where('teste_id', $request->get('teste_id'))
                    ->where('questao_id', $request->get('questao_id'))
                    ->first()->peso;
                $pontuacaoFinal = $pontuacaoAtual + $peso;
                $resultado->update(['pontuacao' => $pontuacaoFinal]);
            }


        }

        // Verifica se a questão enviada é dissertativa
        if ($request->get('resposta')) {
            $this->testeRespostaQuestao->create([
                'teste_nivelamento_resultado_id' => $request->get('teste_nivelamento_resultado_id'),
                'questao_id'                     => $request->get('questao_id'),
                'user_id'                        => Auth::user()->id,
                'resposta'                       => $request->get('resposta'),
            ]);
        }


        Session::flash('msgAddQuestao', 'Cadastro realizado com successo!');


        // verifica se existe mais alguma questão relacionado ao teste para ser respondida
        $getQuestoesRespondidas = $this->testeRespostaQuestao
            ->where('teste_nivelamento_resultado_id', '=', $request->get('teste_nivelamento_resultado_id'))
            ->where('user_id', Auth::user()->id)
            ->select('questao_id')
            ->get()
            ->toArray();
        $questoesRespondidas = array_pluck($getQuestoesRespondidas, 'questao_id');
        $teste = $this->teste->find($request->get('teste_id'));

        // verifica se alguma das questões é dissertativa
        // se existir alguma dissertativa, grava o status como 2 = aguardando correção
        $checkType = $this->questao->whereIn('id', $questoesRespondidas)->where('tipo', 1)->get();
        if ($checkType->count() >= 1) {
            $status = 2;
        } else {
            $status = 0;
        }

        // Se não existir, redireciona para finalizar o teste
        if ($teste->questoes->whereNotIn('questao_id', $questoesRespondidas)->count() <= 0) {
            $this->testeResultado->find($request->get('teste_nivelamento_resultado_id'))->update(['status' => $status, 'finalizado' => Carbon::now()]);
            return redirect()->route('teste.finalizado', $request->get('teste_nivelamento_resultado_id'));
        }


        // Se existir mais alguma questão, redireciona para a próxima
        return redirect()->route('teste.questao.exibe', [
            'idTeste'     => $request->get('teste_id'),
            'idQuestao'   => $teste->questoes->whereNotIn('questao_id', $questoesRespondidas)->first()->questao_id,
            'resultadoId' => $request->get('teste_nivelamento_resultado_id')
        ]);
    }


    public function expiraUpdateAjax($id)
    {

        $getQuestoesRespondidas = $this->testeRespostaQuestao
            ->where('teste_nivelamento_resultado_id', '=', $id)
            ->where('user_id', Auth::user()->id)
            ->select('questao_id')
            ->get()
            ->toArray();
        $questoesRespondidas = array_pluck($getQuestoesRespondidas, 'questao_id');

        // verifica se alguma das questões é dissertativa
        // se existir alguma dissertativa, grava o status como 2 = aguardando correção
        $checkType = $this->questao->whereIn('id', $questoesRespondidas)->where('tipo', 1)->get();
        if ($checkType->count() >= 1) {
            $status = 2;
        } else {
            $status = 0;
        }

        $this->testeResultado->find($id)->update(['status' => $status, 'finalizado' => Carbon::now()]);
        return 'ok';
    }


    public function finalizado($id)
    {
        $resultado = $this->testeResultado->find($id);
        $questoes = $this->testeRespostaQuestao
            ->where('teste_nivelamento_resultado_id', $id)
            ->with('testeQuestao')
            ->whereHas('testeQuestao')
            ->get();

        if ($resultado->status == 2)
        {
            Session::flash('msgDissertativa', 'Aguardando correção');
        }

        return view('pages.teste.aluno.show_final', compact('resultado', 'questoes'));
    }


}
