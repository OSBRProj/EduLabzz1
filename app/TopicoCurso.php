<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

class TopicoCurso extends Model
{
    protected $table = 'topico_curso';

    //Preenchiveis
    protected $fillable = [
        'curso_id',
        'user_id',
        'titulo',
        'descricao',
        'status'
    ];

    // Protegidos
    protected $hidden = [
    ];

    //Padrões
    protected $attributes = [
        'descricao' => '',
        'status' => 0
    ];

    public function comentarios()
    {
        return $this->hasMany('App\ComentarioTopicoCurso', 'topico_curso_id');
    }

    public function getUltimoComentarioAttribute()
    {
        return \App\ComentarioTopicoCurso::where([['topico_curso_id', '=', $this->id]])->with('user')->first();
    }

    public function getVisualizacoesAttribute()
    {
        return \App\Metrica::where('titulo', '=', 'Visualização tópico - ' . $this->id)->pluck('user_id')->unique('user_id')->count();
    }

    public function curso()
    {
        return $this->belongsTo('App\Curso', 'curso_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

}
