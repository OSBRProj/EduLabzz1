<?php

namespace App;

use App\Entities\Album\Album;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Carbon;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'ra',
        'img_perfil',
        'nome_completo',
        'data_nascimento',
        'genero',
        'descricao',
        'escola_id',
        'permissao',
        'ultima_atividade',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $attributes = [
        'ra'               => null,
        'img_perfil'       => '',
        'nome_completo'    => '',
        'data_nascimento'  => '',
        'genero'           => '',
        'descricao'        => '',
        'escola_id'        => 1,
        'permissao'        => 'A',
        'ultima_atividade' => '0000-00-00 00:00:00',
    ];

    protected static $permissoes = [
        'Aluno',
        'Professor',
        'Gestor',
        'Administrador',
        'Sem acesso à plataforma',
    ];




    public function albuns()
    {
        return $this->hasMany(Album::class, 'user_id')->orderBy('id', 'DESC');
    }




    // Mutators
    public function getNameAttribute($value)
    {
        return ucwords($value);
    }


    public function getBornDateAttribute($value)
    {
        return date('d/m/Y', strtotime($this->attributes['born_date']));
    }



    public function getAvatarAttribute()
    {
        $path = route('usuario.perfil.image', [ $this->id ]);

        return $path;

        // $path = env("APP_URL") . '/uploads/usuarios/perfil/' . $this->attributes['avatar'];

        // if($this->attributes['avatar'] == ''){
        //     return null;
        // }

        // return $path;
    }




    public function getPermissaoNameAttribute()
    {
        return $this->PermissaoName($this->permissao);
    }




    public function turmas_aluno()
    {
        return $this->hasMany('App\AlunoTurma', 'user_id')->with('turma_professor');
    }




    public function turmas_instrutor()
    {
        return $this->hasMany('App\Turma', 'user_id');
    }




    public function escola()
    {
        return $this->belongsTo('App\Escola', 'escola_id');
    }




    public function badges_user()
    {
        return $this->hasMany('App\BadgeUsuario', 'user_id')->with('Badge');
    }




    public function progressos()
    {
        return $this->hasMany('App\ProgressoConteudo', 'user_id');
    }




    public function endereco()
    {
        return $this->hasOne('App\EnderecoUser', 'user_id')
            ->withDefault([
                'user_id'     => null,
                'cep'         => null,
                'uf'          => null,
                'cidade'      => null,
                'bairro'      => null,
                'logradouro'  => null,
                'numero'      => null,
                'complemento' => null,
            ]);
    }



    public function notificacoes()
    {
        return $this->hasOne('App\ConfiguracoesNotificacoesUser', 'user_id')
            ->withDefault([
                'user_id'     => 1,
                'rcb_notif_resp_professor'  => 1,
                'rcb_notif_resp_aluno'      => 1,
                'rcb_notif'                 => 1,
            ]);
    }



    public function gamificacao()
    {
        return $this->hasOne('App\Entities\GamificacaoUsuario\GamificacaoUsuario', 'user_id')
            ->withDefault([
                'xp' => 0
            ]);
    }




    public static function PermissaoNamed($usuarios)
    {
        foreach ($usuarios as $usuario) {
            if (strrpos(mb_strtoupper($usuario->permissao, 'UTF-8'), "Z") !== false) {
                $usuario->permissao_name = self::$permissoes[3];
            } elseif (strrpos(mb_strtoupper($usuario->permissao, 'UTF-8'), "G") !== false) {
                $usuario->permissao_name = self::$permissoes[2];
            } elseif (strrpos(mb_strtoupper($usuario->permissao, 'UTF-8'), "P") !== false) {
                $usuario->permissao_name = self::$permissoes[1];
            } elseif (strrpos(mb_strtoupper($usuario->permissao, 'UTF-8'), "") !== false) {
                $usuario->permissao_name = self::$permissoes[4];
            } else {
                $usuario->permissao_name = self::$permissoes[0];
            }
        }

        return $usuarios;
    }




    public static function PermissaoName($permissao)
    {
        if (strtoupper($permissao) == "Z") {
            return self::$permissoes[3];
        }
        if (strtoupper($permissao) == "G") {
            return self::$permissoes[2];
        }
        if (strtoupper($permissao) == "P") {
            return self::$permissoes[1];
        } else {
            return self::$permissoes[0];
        }

    }
}
