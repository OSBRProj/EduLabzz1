<?php

namespace App\Entities\Habilidade;

class Repository
{
    private $habilidade;

    public function __construct(Habilidade $habilidade)
    {
        $this->habilidade = $habilidade;
    }

    public function all()
    {
        return $this->habilidade->orderBy('id', 'DESC')->get();
    }

    public function categorias()
    {
        return $this->habilidade->all()->pluck('categoria')->unique()->toArray();
    }

    public function store($values)
    {
        return $this->habilidade->create($values);
    }

    public function update($id, $values)
    {
        return $this->habilidade->find($id)->update($values);
    }

    public function delete($id)
    {
        return $this->habilidade->find($id)->delete();
    }

}
