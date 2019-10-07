<?php

namespace App;

use App\Entities\Favorito\Favorito;
use App\Generals\Presenter\Conteudos\ConteudoPresenter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

use Carbon\Carbon;
use Laracasts\Presenter\PresentableTrait;

class Conteudo extends Model
{
    use PresentableTrait;
    protected $presenter = ConteudoPresenter::class;

    //Preenchiveis
    protected $fillable = [
        'id',
        'user_id',
        'titulo',
        'descricao',
        'status',
        'tipo',
        'conteudo',
        'tempo',
        'duracao',
        'apoio',
        'fonte',
        'autores',
        'categoria_id',
    ];

    // Protegidos
    protected $hidden = [
    ];

    //Padrões
    protected $attributes = [
        'descricao'    => '',
        'status'       => 0,
        'tipo'         => 1,
        'duracao' => 0,
        'apoio'        => '',
        'fonte'        => '',
        'autores'      => '',
        'categoria_id' => 1,
    ];

    public function conteudos_aula()
    {
        return $this->hasMany('App\ConteudoAula', 'conteudo_id');
    }

    public function conteudo_aula()
    {
        return $this->belongsTo('App\ConteudoAula', 'id', 'conteudo_id');
    }

    public function progressos()
    {
        return $this->hasMany('App\ProgressoConteudo', 'conteudo_id')->where('tipo', '=', 2);
    }

    public function progressos_user()
    {
        return $this->hasMany('App\ProgressoConteudo', 'conteudo_id')->with('user')->where('tipo', '=', 2);
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public static function detalhado($conteudos)
    {
        foreach ($conteudos as $key => $conteudo) {
            switch ($conteudo->tipo) {
                case 1:
                    $conteudo->tipo_nome = 'Misto';
                    $conteudo->tipo_icon = 'fas fa-font';
                    break;
                case 2:
                    $conteudo->tipo_nome = 'Áudio';
                    $conteudo->tipo_icon = 'fas fa-podcast';
                    break;
                case 3:
                    $conteudo->tipo_nome = 'Vídeo';
                    $conteudo->tipo_icon = 'fa fa-video';
                    break;
                case 4:
                    $conteudo->tipo_nome = 'Slide';
                    $conteudo->tipo_icon = 'fa fa-file-powerpoint';
                    break;
                case 5:
                    $conteudo->tipo_nome = 'Transmissão';
                    $conteudo->tipo_icon = 'fa fa-broadcast-tower';
                    break;
                case 6:
                    $conteudo->tipo_nome = 'Upload';
                    $conteudo->tipo_icon = 'fa fa-upload';
                    break;
                case 7:
                    $conteudo->tipo_nome = 'Dissertativa';
                    $conteudo->tipo_icon = 'fa fa-comment-alt';
                    break;
                case 8:
                    $conteudo->tipo_nome = 'Quiz';
                    $conteudo->tipo_icon = 'fa fa-list-ul';
                    break;
                case 9:
                    $conteudo->tipo_nome = 'Prova';
                    $conteudo->tipo_icon = 'fa fa-stopwatch';
                    break;
                case 10:
                    $conteudo->tipo_nome = 'Entregável';
                    $conteudo->tipo_icon = 'fa fa-arrow-circle-up';
                    break;
                case 11:
                    $conteudo->tipo_nome = 'Livro digital';
                    $conteudo->tipo_icon = 'fa fa-file-alt';
                    break;

                default:
                    $conteudo->tipo_nome = 'Misto';
                    $conteudo->tipo_icon = 'fas fa-font';
                    break;
            }

            Carbon::setLocale('pt-BR');
            $conteudo->date = $conteudo->created_at->formatLocalized('%d de %B de %Y às %H:%M');
        }

        return $conteudos;
    }

    public function favorito($idUser, $idRef)
    {
        return $this->hasOne(Favorito::class, 'referencia_id')
            ->where([['user_id', $idUser], ['referencia_id', $idRef], ['tipo', 2]])->first();
    }

    public function getTipoNomeAttribute()
    {
        switch ($this->tipo) {
            case 1:
                return 'Misto';

                break;
            case 2:
                return 'Áudio';

                break;
            case 3:
                return 'Vídeo';

                break;
            case 4:
                return 'Slide';

                break;
            case 5:
                return 'Transmissão';

                break;
            case 6:
                return 'Upload';

                break;
            case 7:
                return 'Dissertativa';

                break;
            case 8:
                return 'Quiz';

                break;
            case 9:
                return 'Prova';

                break;
            case 10:
                return 'Entregável';

                break;
            case 11:
                return 'Livro digital';

                break;

            default:
                return 'Misto';

                break;
        }
    }

    public function getTipoIconAttribute()
    {
        switch ($this->tipo) {
            case 1:
                return 'fas fa-font';

                break;
            case 2:
                return 'fas fa-podcast';

                break;
            case 3:
                return 'fa fa-video';

                break;
            case 4:
                return 'fa fa-file-powerpoint';

                break;
            case 5:
                return 'fa fa-broadcast-tower';

                break;
            case 6:
                return 'fa fa-upload';

                break;
            case 7:
                return 'fa fa-comment-alt';

                break;
            case 8:
                return 'fa fa-list-ul';

                break;
            case 9:
                return 'fa fa-stopwatch';

                break;
            case 10:
                return 'fa fa-arrow-circle-up';

                break;
            case 11:
                return 'fa fa-file-alt';

                break;

            default:
                return 'fas fa-font';

                break;
        }
    }

}
