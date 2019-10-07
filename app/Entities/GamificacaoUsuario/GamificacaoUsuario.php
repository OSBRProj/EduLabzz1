<?php

namespace App\Entities\GamificacaoUsuario;

use App\User;
use Illuminate\Database\Eloquent\Model;

class GamificacaoUsuario extends Model
{
    protected $table = "gamificacao_usuario";

    //Preenchiveis
    protected $fillable = [
        'user_id',
        'xp',
        'notificado_level_up',
    ];

    protected $attributes = [
        'notificado_level_up' => true,
    ];

    protected $casts = [
        'notificado_level_up' => 'boolean',
    ];

    //
    // Relationships
    //
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function user_escola()
    {
        return $this->belongsTo(User::class, 'user_id')->with('escola');
    }

    //
    // Mutators
    //
    public function getXpResetedAttribute()
    {
        $xp = $this->xp - $this->level_xp( $this->level_atual() );

        return $xp;
    }

    // Game & Level Design functions

    // Ajustar de acordo com a dificuldade para passar de nível
    protected $xp_variable = 50;

    public function level_atual()
    {
        return $this->getLevel($this->xp) ;
    }

    public function level_xp($lvl)
    {
        $level_xp = $this->xp_variable * $lvl * $lvl - $this->xp_variable * $lvl;

        return $level_xp;
    }


    public function next_level_xp($reseted = false)
    {
        if(!$reseted)
        {
            $next_level = $this->getLevel($this->xp) + 1;

            $next_level_xp = $this->xp_variable * $next_level * $next_level - $this->xp_variable * $next_level;

        }
        else
        {
            $previous_level_xp = $this->level_xp( $this->level_atual() );

            $next_level_xp = $this->next_level_xp() - $previous_level_xp;
        }

        return $next_level_xp;
    }

    public function next_level_progress($reseted = false)
    {
        if($this->xp == 0)
        {
            return 0;
        }

        if(!$reseted)
        {
            $percentual = (($this->xp * 100) / $this->next_level_xp());
        }
        else
        {
            $percentual = (($this->xp_reseted * 100) / $this->next_level_xp(true));
        }

        return $percentual;
    }

    public function getLevel($amount_xp)
    {
        $level = ($this->xp_variable + sqrt($this->xp_variable * $this->xp_variable - 4 * $this->xp_variable * (- $amount_xp ) ))/ (2 * $this->xp_variable);
        // $level = (25 + sqrt(625 + 100 * $this->xp)) / 50;

        // return ($level);
        return floor($level);
    }

}
