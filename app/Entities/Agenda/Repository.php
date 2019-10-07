<?php

namespace App\Entities\Agenda;


class Repository
{
    
    private $agenda;
    
    public function __construct(Agenda $agenda)
    {
        $this->agenda = $agenda;
    }
    
    public function all($idUser)
    {
        return $this->agenda->where('user_id', $idUser)->get();
    }
    
    public function find($id)
    {
        return $this->agenda->find($id);
    }
    
    public function store($values)
    {
        return $this->agenda->create($values);
    }
    
    
    public function update($id, $values)
    {
        return $this->agenda->find($id)->update($values);
    }
    
    
    public function delete($id)
    {
        return $this->agenda->find($id)->delete();
    }
    
}
