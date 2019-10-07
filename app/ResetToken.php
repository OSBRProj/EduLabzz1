<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResetToken extends Model
{
    protected $table = 'reset_token';

    protected $primaryKey = 'email';

    public $incrementing = false;

    public $timestamps = false;

    //Preenchiveis
    protected $fillable = [        
        'email',
        'token',
        'created_at',
    ];

    // Protegidos
    protected $hidden = [
    ];

    //Padrões
    protected $attributes = [

    ];
    
}
