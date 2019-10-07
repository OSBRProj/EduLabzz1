<?php
namespace App\Http\Controllers\Exportacao;

use App\Curso;
use App\Aula;
use App\ConteudoAula;
use App\Conteudo;

class CursoController extends ExportacaoController
{

    public function curso($idCurso)
    {
        $curso = Curso::find($idCurso);
        $curso->makeHidden(['id', 'user_id', 'created_at', 'updated_at']); //LISTA DE CAMPOS QUE NÃO PRECISAMOS CAPTURAR.

        $aulas = Aula::where('curso_id', $idCurso)->get();
        $aulas->makeHidden(['id', 'curso_id', 'user_id', 'created_at', 'updated_at']); //LISTA DE CAMPOS QUE NÃO PRECISAMOS CAPTURAR.

        foreach($aulas as $index => $aula)
        {
            $aulaConteudos = ConteudoAula::where([['aula_id', '=', $aula->id], ['curso_id', '=', $idCurso]])->get();
            $aulaConteudos->makeHidden(['id', 'user_id', 'created_at', 'updated_at']); //LISTA DE CAMPOS QUE NÃO PRECISAMOS CAPTURAR.
            
            foreach($aulaConteudos as $aulaConteudo)
            {
                $aulaConteudo = Conteudo::find($aulaConteudo->conteudo_id);
                $aulaConteudo->makeHidden(['id', 'user_id', 'created_at', 'updated_at']); //LISTA DE CAMPOS QUE NÃO PRECISAMOS CAPTURAR.
    
                $resAulaConteudos[] = $aulaConteudo;
            }  

            $resAulas[$index] = $aula; 
            $resAulas[$index]['conteudos'] = $resAulaConteudos;
        }
        
        $res['curso'] = $curso;
        $res['curso']['aulas'] = $resAulas;

        $res = json_encode($res);

        $fileName = $this->generateFileName('curso', $curso->titulo, 'tz');

        return $this->callDownloadFromStream($res, $fileName, '');
    }

}