<?php

namespace App\Entities\TesteNivelamento;

use App\Entities\Questoes\Questoes;
use Illuminate\Database\Eloquent\Model;

class TesteNivelamentoQuestao extends Model
{
    protected $table = "teste_nivelamento_questao";
    
    //Preenchiveis
    protected $fillable = [
        'teste_id',
        'questao_id',
        'peso'
    ];
    
    public function questao()
    {
        return $this->belongsTo(Questoes::class, 'questao_id');
    }
}
