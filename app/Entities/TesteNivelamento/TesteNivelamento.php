<?php

namespace App\Entities\TesteNivelamento;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class TesteNivelamento extends Model
{
    protected $table = "teste_nivelamentos";
    
    //Preenchiveis
    protected $fillable = [
        'user_id',
        'titulo',
        'descricao',
        'tempo',
        'recomendacoes'
    ];
    
    public function questoes()
    {
        return $this->hasMany(TesteNivelamentoQuestao::class, 'teste_id')->oldest('created_at');
    }
    
    public function direcionamentos()
    {
        return $this->hasMany(TesteNivelamentoDirecionamento::class, 'teste_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function resultados()
    {
        return $this->hasMany(TesteNivelamentoResultado::class, 'teste_id')
            ->where('user_id', Auth::user()->id)
            ->where('status', 0);
    }
    
}
