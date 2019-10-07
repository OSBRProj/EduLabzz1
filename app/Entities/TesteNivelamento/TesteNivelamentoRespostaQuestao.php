<?php

namespace App\Entities\TesteNivelamento;

use App\Entities\Questoes\Questoes;
use Illuminate\Database\Eloquent\Model;

class TesteNivelamentoRespostaQuestao extends Model
{
    protected $table = "teste_nivelamento_resposta_questao";
    
    //Preenchiveis
    protected $fillable = [
        'teste_nivelamento_resultado_id',
        'questao_id',
        'user_id',
        'resposta',
        'correta'
    ];
    
    public function questao()
    {
        return $this->belongsTo(Questoes::class, 'questao_id');
    }
    
    public function testeQuestao()
    {
        return $this->belongsTo(TesteNivelamentoQuestao::class, 'questao_id', 'questao_id');
    }
    
}
