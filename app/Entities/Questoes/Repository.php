<?php

namespace App\Entities\Questoes;


class Repository
{
    private $questoes;
    
    public function __construct(Questoes $questoes)
    {
        $this->questoes = $questoes;
    }
    
    public function all()
    {
        return $this->questoes->orderBy('id', 'DESC')->get();
    }
    
    public function store($values)
    {
        return $this->questoes->create($values);
    }
    
    public function update($id, $values)
    {
        return $this->questoes->find($id)->update($values);
    }
    
    public function delete($id)
    {
        return $this->questoes->find($id)->delete();
    }
    
    public function select()
    {
        return $this->questoes->select('titulo', 'id')->get();
    }
    
    public function find($id)
    {
        return $this->questoes->find($id);
    }
    
}
