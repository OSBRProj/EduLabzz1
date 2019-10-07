<?php
namespace App\Http\Controllers\Exportacao;

use App\Conteudo;

class AulaConteudoController extends ExportacaoController
{

    public function aulaConteudo($idCurso, $idAula, $idConteudo)
    {
        $aulaConteudo = Conteudo::find($idConteudo);
        $aulaConteudo->makeHidden(['id', 'user_id', 'created_at', 'updated_at']); //LISTA DE CAMPOS QUE NÃO PRECISAMOS CAPTURAR.
       
        $res['aula_conteudo'] = $aulaConteudo;

        $res = json_encode($res);        

        $fileName = $this->generateFileName('aula_conteudo', $aulaConteudo->titulo, 'tz');

        return $this->callDownloadFromStream($res, $fileName, '');
    }

}