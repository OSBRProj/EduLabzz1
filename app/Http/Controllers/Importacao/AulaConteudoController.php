<?php
namespace App\Http\Controllers\Importacao;

use App\Conteudo;
use App\ConteudoAula;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage;

use Redirect;

class AulaConteudoController extends ImportacaoController
{

    public function aulaConteudo($idCurso, $idAula, Request $request)
    {
        if($request->hasFile('fileImportAulaConteudo'))
        {
            if($request->file('fileImportAulaConteudo')->getClientOriginalExtension() != 'tz')
            {
                return Redirect::back()->withErrors(['Arquivo de importação inválido!']);
            }

            $userId = Auth::user()->id;
            
            $fileContent = file_get_contents($request->file('fileImportAulaConteudo')->getPathName());
            $decodeAsArray = json_decode($fileContent, true);

            $arrAulaConteudo = (isset($decodeAsArray['aula_conteudo'])) ? $decodeAsArray['aula_conteudo'] : false;            

            if(!$arrAulaConteudo)
            {
                return Redirect::back()->withErrors(['Arquivo de importação não é do tipo aula_conteudo!']);
            }

  
            //Adiciona Conteúdo Importado
            $conteudo = new Conteudo();  
            $conteudo->user_id = $userId;
            $conteudo->forceFill($arrAulaConteudo);
            $conteudo->save();         
            $insertedConteudoId = $conteudo->id;
            
            //Cria Relacionamento do Conteúdo Importado com o Curso/Aula
            $conteudoAula = new ConteudoAula();
            $conteudoAula->ordem = 999;
            $conteudoAula->conteudo_id = $insertedConteudoId;
            $conteudoAula->curso_id = $idCurso;
            $conteudoAula->aula_id = $idAula;
            $conteudoAula->user_id = $userId;
            $conteudoAula->obrigatorio = 1;
            $conteudoAula->save();

            return Redirect::back()->with('message', 'Conteúdo importado com sucesso!');
        }
        else
        {
            return Redirect::back()->withErrors(['Arquivo de importação não existe!']);
        }
    }

}