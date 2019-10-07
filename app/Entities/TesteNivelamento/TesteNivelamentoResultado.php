<?php

namespace App\Entities\TesteNivelamento;

use App\User;
use Illuminate\Database\Eloquent\Model;

class TesteNivelamentoResultado extends Model
{
    protected $table = "teste_nivelamento_resultados";
    
    //Preenchiveis
    protected $fillable = [
        'user_id',
        'teste_id',
        'pontuacao',
        'finalizado',
        'status',
    ];
    
    
    public function teste()
    {
        return $this->belongsTo(TesteNivelamento::class, 'teste_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    
}
