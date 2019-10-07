<?php

namespace App\Http\Controllers\TesteNivelamento\Admin;

use App\Entities\Questoes\Questoes;
use App\Entities\TesteNivelamento\TesteNivelamento;
use App\Entities\TesteNivelamento\TesteNivelamentoDirecionamento;
use App\Entities\TesteNivelamento\TesteNivelamentoQuestao;
use App\Entities\TesteNivelamento\TesteNivelamentoRespostaQuestao;
use App\Entities\TesteNivelamento\TesteNivelamentoResultado;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TesteNivelamentoController extends Controller
{
    private $teste;
    private $testeQuestao;
    private $testeDirecionamento;
    private $questao;
    private $resultado;
    
    public function __construct(
        TesteNivelamento $teste,
        TesteNivelamentoQuestao $testeQuestao,
        TesteNivelamentoDirecionamento $testeDirecionamento,
        TesteNivelamentoRespostaQuestao $testeRespostaQuestao,
        Questoes $questao,
        TesteNivelamentoResultado $resultado)
    {
        $this->teste = $teste;
        $this->testeQuestao = $testeQuestao;
        $this->testeDirecionamento = $testeDirecionamento;
        $this->testeRespostaQuestao = $testeRespostaQuestao;
        $this->questao = $questao;
        $this->resultado = $resultado;
    }
    
    public function index()
    {
        $testes = $this->teste->orderBy('id', 'DESC')->get();
        return view('pages.teste.admin.index', compact('testes'));
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'titulo' => 'required',
            'peso'   => 'required'
        ], [
            'peso.required' => 'Adicione pelo menos uma questão ao seu teste!'
        ]);
        
        // Grava o teste no banco e retorna o ID
        $testeId = $this->teste->create([
            'user_id'   => Auth::user()->id,
            'titulo'    => $request->get('titulo'),
            'descricao' => $request->get('descricao'),
            'tempo'     => $request->get('tempo')
        ])->id;
        
        
        // Grava as questões relacionadas ao teste
        foreach ($request->get('peso') as $key => $peso) {
            $this->testeQuestao->create(['teste_id' => $testeId, 'questao_id' => $key, 'peso' => $peso]);
        }
        
        // Verifica se existe um redirecionamento no request
        // Se existir grava os redirecionamentos relacionados ao teste
        if ($request->get('regra') !== null) {
            $direcionamentos = array_map(null, $request->get('regra'), $request->get('pontuacao'), $request->get('direcionamento'));
            foreach ($direcionamentos as $direc) {
                $this->testeDirecionamento->create([
                    'teste_id'       => $testeId,
                    'regra'          => $direc[0],
                    'pontuacao'      => $direc[1],
                    'direcionamento' => $direc[2]
                ]);
            }
        }
        
        return redirect()->route('gestao.teste.listar')->with('message', 'Cadastro realizado com sucesso!');
    }
    
    
    public function edit($idTeste)
    {
        $teste = $this->teste->find($idTeste);
        $questoes = $this->questao->select('titulo', 'id')->get();
        return view('pages.teste.admin.edit', compact('teste', 'questoes'));
    }
    
    
    public function update($idTeste, Request $request)
    {
        //dd($request->all());
        $this->validate($request, ['titulo' => 'required']);
        
        // atualiza o teste
        $this->teste->find($idTeste)->update([
            'titulo'    => $request->get('titulo'),
            'descricao' => $request->get('descricao'),
            'tempo'     => $request->get('tempo')
        ]);
        
        // atualiza o peso das questões
        if ($request->get('peso')) {
            foreach ($request->get('peso') as $key => $peso) {
                $this->testeQuestao->find($key)->update(['peso' => $peso]);
            }
        }
        
        // verifica se existe novas questões adicionadas
        // Adiciona questão
        if ($request->get('peso_new')) {
            foreach ($request->get('peso_new') as $key => $peso) {
                $this->testeQuestao->create([
                    'teste_id'   => $idTeste,
                    'questao_id' => $key,
                    'peso'       => $peso
                ]);
            }
        }
        
        
        // verifica se existe questões para ser excluidas
        // remove questões
        if ($request->get('questoesExcluidas')) {
            foreach ($request->get('questoesExcluidas') as $questao) {
                $this->testeQuestao->find($questao)->delete();
            }
        }
        
        
        // Atualiza os dados dos direcionamentos
        if ($request->get('regra') !== null) {
            $keys = array_keys($request->get('regra'));
            $direcionamentos = array_map(null, $keys, $request->get('regra'), $request->get('pontuacao'), $request->get('direcionamento'));
            foreach ($direcionamentos as $direc) {
                $this->testeDirecionamento->find($direc[0])->update([
                    'regra'          => $direc[1],
                    'pontuacao'      => $direc[2],
                    'direcionamento' => $direc[3]
                ]);
            }
        }
        
        // verifica se existe direcionamentos para ser excluidos
        // remove direcionamentos
        if ($request->get('direcExcluidos')) {
            foreach ($request->get('direcExcluidos') as $dirExc) {
                $this->testeDirecionamento->find($dirExc)->delete();
            }
        }
        
        // Verifica se existe um novo redirecionamento no request
        // Se existir grava os redirecionamentos relacionados ao teste
        if ($request->get('regra_new') !== null) {
            $direcionamentos = array_map(null, $request->get('regra_new'), $request->get('pontuacao_new'), $request->get('direcionamento_new'));
            foreach ($direcionamentos as $direc) {
                $this->testeDirecionamento->create([
                    'teste_id'       => $idTeste,
                    'regra'          => $direc[0],
                    'pontuacao'      => $direc[1],
                    'direcionamento' => $direc[2]
                ]);
            }
        }
        
        //return redirect()->route('gestao.teste.listar')->with('message', 'Teste atualizado com sucesso!');
        return redirect()->back()->with('message', 'Teste atualizado com sucesso!');
    }
    
    
    public function delete(Request $request)
    {
        $this->teste->find($request->idTeste)->delete;
        return redirect()->route('gestao.teste.listar')->with('message', 'Teste excluído com sucesso!');
    }
    
    
    public function listarResultados($idTeste)
    {
        $teste = $this->teste->find($idTeste);
        $finalizados = $this->resultado
            ->where('teste_id', $idTeste)
            ->where('status', 0)// apenas testes finalizados
            ->latest()
            ->get();
        
        $correcoes = $this->resultado
            ->where('teste_id', $idTeste)
            ->where('status', 2)// apenas testes aguardando correção
            ->latest()
            ->get();
        return view('pages.teste.admin.resultados', compact('finalizados', 'correcoes', 'teste'));
    }
    
    
    public function corrigeResultado($idResultado)
    {
        $resultado = $this->resultado->find($idResultado);
        $questoes = $this->testeRespostaQuestao
            ->where('teste_nivelamento_resultado_id', $idResultado)
            ->with('testeQuestao')
            ->get();
    
        $countRespostas = $this->testeRespostaQuestao
            ->where('teste_nivelamento_resultado_id', $resultado->id)
            ->where('correta', null)
            ->get()
            ->count();
        
        return view('pages.teste.admin.resultados_corrige', compact('resultado', 'questoes', 'countRespostas'));
    }
    
    public function correcaoResultado($idRespostaQuestao, $value)
    {
        $respostaQuestao = $this->testeRespostaQuestao->find($idRespostaQuestao);
        $resultado = $this->resultado->find($respostaQuestao->teste_nivelamento_resultado_id);
        
        if ($value == 'true') {
            $pontuacaoFinal = $resultado->pontuacao + $respostaQuestao->testeQuestao->peso;
            $resultado->update(['pontuacao' => $pontuacaoFinal]);
        }
        
        $respostaQuestao->update(['correta' => $value]);
        
        // verifica se existe mais alguma questão para ser corrigida
        $checkRespostas = $this->testeRespostaQuestao
            ->where('teste_nivelamento_resultado_id', $resultado->id)
            ->where('correta', null)
            ->get()
            ->count();
        
        //se não existir mais nenhuma questão, atualiza o teste como finalizado, status = 0
        if ($checkRespostas <= 0) {
            $resultado->update(['status' => 0]);
        }
        return redirect()->back()->with('')->with('message', 'Questão corrigida com sucesso!');
    }
    
    
    
    
}
