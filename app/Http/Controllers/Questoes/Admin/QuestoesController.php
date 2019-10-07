<?php

namespace App\Http\Controllers\Questoes\Admin;

use App\Entities\Questoes\Repository as Questoes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Entities\TesteNivelamento\TesteNivelamento;

class QuestoesController extends Controller
{
    private $questoes;
    
    public function __construct(Questoes $questoes)
    {
        $this->questoes = $questoes;
    }
    
    public function index()
    {
        $questoes = $this->questoes->all();
        return view('pages.questoes.admin.index', compact('questoes'));
    }
    
    public function indexAjaxAll()
    {
        $questoes = $this->questoes->all();
        return response()->json($questoes);
    }
    
    /*public function indexAjax($id)
    {
        $questao = $this->questoes->find($id);
        return response()->json($questao);
    }*/
    
    
    public function store(Request $request)
    {
        $this->validate($request, ['titulo' => 'required']);
        
        if ($request->get('tipo') == 2) {
            $alternativas = json_encode($request->except('_token', 'titulo', 'descricao', 'tipo', 'alternativa_correta'));
            $this->questoes->store([
                'user_id'          => Auth::user()->id,
                'titulo'           => $request->get('titulo'),
                'descricao'        => $request->get('descricao'),
                'tipo'             => $request->get('tipo'),
                'alternativas'     => $alternativas,
                'resposta_correta' => $request->get('alternativa_correta')
            ]);
        } else {
            $this->questoes->store([
                'user_id'   => Auth::user()->id,
                'titulo'    => $request->get('titulo'),
                'descricao' => $request->get('descricao'),
                'tipo'      => $request->get('tipo')
            ]);
        }
        return redirect()->route('gestao.questoes.listar')->with('message', 'Cadastro realizado com sucesso!');
    }
    
    public function storeAjax(Request $request)
    {
        $this->validate($request, ['titulo' => 'required']);
        
        if ($request->get('tipo') == 2) {
            $alternativas = json_encode($request->except('_token', 'titulo', 'descricao', 'tipo', 'alternativa_correta'));
            $store = $this->questoes->store([
                'user_id'          => Auth::user()->id,
                'titulo'           => $request->get('titulo'),
                'descricao'        => $request->get('descricao'),
                'tipo'             => $request->get('tipo'),
                'alternativas'     => $alternativas,
                'resposta_correta' => $request->get('alternativa_correta')
            ]);
            return $store->id;
        } else {
            $store = $this->questoes->store([
                'user_id'   => Auth::user()->id,
                'titulo'    => $request->get('titulo'),
                'descricao' => $request->get('descricao'),
                'tipo'      => $request->get('tipo')
            ]);
            return $store->id;
        }
        //return "Questão cadastrada com sucesso!";
    }
    
    
    public function update($idQuestao, Request $request)
    {
        $this->validate($request, ['titulo' => 'required']);
        
        if ($request->get('tipo') == 2) {
            $alternativas = json_encode($request->except('_token', 'titulo', 'descricao', 'tipo', 'alternativa_correta'));
            $this->questoes->update($idQuestao, [
                'titulo'           => $request->get('titulo'),
                'descricao'        => $request->get('descricao'),
                'tipo'             => $request->get('tipo'),
                'alternativas'     => $alternativas,
                'resposta_correta' => $request->get('alternativa_correta')
            ]);
        } else {
            $this->questoes->update($idQuestao, [
                'titulo'           => $request->get('titulo'),
                'descricao'        => $request->get('descricao'),
                'tipo'             => $request->get('tipo'),
                'alternativas'     => null,
                'resposta_correta' => null
            ]);
        }
        return redirect()->route('gestao.questoes.listar')->with('message', 'Questão atualizada com sucesso!');
    }
    
    
    public function delete(Request $request)
    {
        $questao = $this->questoes->find($request->idQuestao);
        $TesteNivelamento = TesteNivelamento::get($questao->teste_id);

        if(!$TesteNivelamento->isEmpty()) 
        {
            return redirect()->back()->withErrors("Questão não pode ser excluída, está associada a um teste de nivelamento!");            
        }

        $this->questoes->delete($request->idQuestao);
        return redirect()->route('gestao.questoes.listar')->with('message', 'Questão excluída com sucesso!');
    }
    
    
}
