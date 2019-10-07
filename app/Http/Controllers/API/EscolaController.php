<?php

namespace App\Http\Controllers\API;

use App\Escola;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EscolaController extends Controller
{

    public function index(Request $request)
    {
        try {
            $escola = Escola::orderBy('id', 'DESC')->get(); 

            if(!empty($request->get('aluno')))
            {
                $escola = Escola::where('user_id', $request->get('aluno'))->orderBy('id', 'DESC')->get(); 

                if($escola->isEmpty())
                {
                    return response()->json(['error' => 'Nenhuma escola foi encontrada com esse aluno.']);
                }
            }

            return response()->json($escola);
        } 
        catch (\Exception $exception) 
        {
            return response()->json(["error" => "Erro ao listar.", "message:" => $exception->getMessage()]);
        }
    }



    public function show($id)
    {
        try {
            $escola = Escola::where('id', $id)->orderBy('id', 'DESC')->get(); 

            if ($escola->isEmpty()) {
                return response()->json(['error' => 'Nenhuma escola foi encontrada']);
            }

            return response()->json($escola);
        } 
        catch (\Exception $exception) 
        {
            return response()->json(["error" => "Erro ao listar.", "message:" => $exception->getMessage()]);
        }
    }

}