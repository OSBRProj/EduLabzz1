<?php


namespace App\Entities\TesteNivelamento;


class Repository
{
    private $teste;
    private $testeQuestao;
    private $testeDirecionamento;
    
    public function __construct(TesteNivelamento $teste, TesteNivelamentoQuestao $testeQuestao, TesteNivelamentoDirecionamento $testeDirecionamento)
    {
        $this->teste = $teste;
        $this->testeQuestao = $testeQuestao;
        $this->testeDirecionamento = $testeDirecionamento;
    }
    
    // teste
    public function all()
    {
        return $this->teste->orderBy('id', 'DESC')->get();
    }
    
    public function find($id)
    {
        return $this->teste->find($id);
    }
    
    public function store($values)
    {
        return $this->teste->create($values);
    }
    
    public function update($id, $values)
    {
        return $this->teste->find($id)->update($values);
    }
    
    public function delete($id)
    {
        return $this->teste->find($id)->delete();
    }
    
    
    // Questão
    public function storeTesteQuestao($values)
    {
        return $this->testeQuestao->create($values);
    }
    
    public function updateTesteQuestao($id, $values)
    {
        return $this->testeQuestao->find($id)->update($values);
    }
    
    public function deleteTesteQuestao($id)
    {
        return $this->testeQuestao->find($id)->delete();
    }
    
    
    // Direcionamento
    public function storeTesteDirecionamento($values)
    {
        return $this->testeDirecionamento->create($values);
    }
    
    public function updateTesteDirecionamento($id, $values)
    {
        return $this->testeDirecionamento->find($id)->update($values);
    }
    
    public function deleteDirecionamentoQuestao($id)
    {
        return $this->testeDirecionamento->find($id)->delete();
    }
    
}
