<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

class Curso extends Model
{
    //Preenchiveis
    protected $fillable = [
        'escola_id',
        'user_id',
        'titulo',
        'descricao_curta',
        'descricao',
        'capa',
        'categoria',
        'tipo',
        'visibilidade',
        'senha',
        'status',
        'preco',
        'periodo',
        'vagas',
        'data_publicacao',
    ];

    // Protegidos
    protected $hidden = [
    ];

    //Padrões
    protected $attributes = [
        'escola_id' => 1,
        'capa' => '',
        'categoria' => 1,
        'tipo' => 1,
        'visibilidade' => 1,
        'senha' => '',
        'status' => 0,
        'preco' => 0,
        'periodo' => 0,
        'vagas' => 0,
    ];

    //
    // Tipos
    //
    // 1 = Curso padrão / Para alunos
    // 2 = Curso para professores / gestores (oculto do catalogo)
    //

    //
    // Mutators
    //
    public function getMatriculadosAttribute()
    {
        return Matricula::where('curso_id', '=', $this->id)->count();
    }

    public function getStatusNameAttribute()
    {
        switch ($this->status)
        {
            case 0:
                return 'Rascunho';
                break;
            case 1:
                return 'Publicado';
                break;

            default:
                return 'Rascunho';
                break;
        }
    }

    //
    // Relationships
    //

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function matriculas()
    {
        return $this->hasMany('App\Matricula', 'curso_id');
    }

    public function aulas()
    {
        return $this->hasMany('App\Aula', 'curso_id')->orderBy('id', 'asc');
    }

    public function conteudos()
    {
        return $this->hasMany('App\Conteudo', 'curso_id');
    }

    public function avaliacoes()
    {
        return $this->hasMany('App\AvaliacaoCurso', 'curso_id');
    }

    public function avaliacoes_user()
    {
        return $this->hasMany('App\AvaliacaoCurso', 'curso_id')->with('user');
    }

    public function topicos()
    {
        // return $this->hasMany('App\TopicoCurso', 'curso_id')->withCount('comentarios')->withCount('visualizacoes');
        return $this->hasMany('App\TopicoCurso', 'curso_id')->withCount('comentarios');
    }

    public static function TituloUrl($cursos)
    {
        foreach ($cursos as $curso)
        {
            $curso->titulo_url = $curso->titulo;

            if(Curso::where('titulo', '=', $curso->titulo)->count() > 1)
            {
                $curso->titulo_url = $curso->titulo_url . '-' . $curso->id;
            }

            // $curso->titulo_url = urlencode($curso->titulo_url);

            // $curso->titulo_url = preg_replace('/[ ]/', '+', $curso->titulo_url);

            $curso->titulo_url = mb_strtolower($curso->titulo_url, 'UTF-8');
        }

        return $cursos;
    }

}
