<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

class Categoria extends Model
{
    //Preenchiveis
    protected $fillable = [
        'id',
        'user_id',
        'titulo',
        'tipo',
    ];

    // Tipos de categorias
    // 0 = Geral
    // 1 = Cursos
    // 2 = Conteudos
    // 3 = Aplicacoes
    // 4 = Artigos
    // 5 = Audios

    // Protegidos
    protected $hidden = [
    ];

    //Padrões
    protected $attributes = [

    ];

    // Mutators
    public function getTipoNameAttribute()
    {
        switch ($this->tipo) {
            case 0:
                return "Geral";
                break;
            case 1:
                return "Cursos";
                break;
            case 2:
                return "Conteudos";
                break;
            case 3:
                return "Aplicacoes";
                break;
            case 4:
                return "Artigos";
                break;
            case 5:
                return "Áudios";
                break;

            default:
                return "Geral";
                break;
        }
    }

    //
    // Relationship
    //

    public function conteudo()
    {
        return $this->belongsToMany('App\Conteudo', 'categoria_id');
    }

    public function aplicacao()
    {
        return $this->belongsToMany('App\Aplicacao', 'categoria_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

}
