<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

class ConfiguracoesNotificacoesUser extends Model
{
    protected $table = "configuracoes_notificacoes_user";

    //Preenchiveis
    protected $fillable = [
        'user_id',
        'rcb_notif_resp_professor',
        'rcb_notif_resp_aluno',
        'rcb_notif',
    ];

    protected $attributes = [
        'rcb_notif_resp_professor' => true,
        'rcb_notif_resp_aluno' => true,
        'rcb_notif' => true,
    ];

    protected $casts = [
        'rcb_notif_resp_professor' => 'boolean',
        'rcb_notif_resp_aluno' => 'boolean',
        'rcb_notif' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
