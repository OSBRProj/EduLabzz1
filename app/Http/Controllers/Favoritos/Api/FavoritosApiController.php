<?php

namespace App\Http\Controllers\Favoritos\Api;

use App\Entities\Favorito\Favorito;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FavoritosApiController extends Controller
{


    public function listar($field)
    {
        try {
            // if ($field === 'albuns')
            {
                $favoritos = Favorito::where('user_id', Auth::user()->id)
                    ->where('album_id', '!=', null)
                    ->with(['albums' => function ($query) {
                        $query->select('albums.id', 'albums.titulo', 'albums.capa as url', 'albums.descricao', 'albums.categoria', 'albums.user_id as artist', 'albums.user_id');
                    }])
                    ->select('favoritos.id', 'favoritos.user_id', 'favoritos.album_id')
                    ->get();
            }
            return response()->json($favoritos);
        } catch (\Exception $exception) {
            return response()->json(["error" => "Erro ao lista os favoritos", "message:" => $exception->getMessage()]);
        }
    }




    public function store(Request $request)
    {
        try {
            $field = $request->get('field');
            $check = Favorito::where([[$field, $request->get('value')], ['user_id', Auth::user()->id]])->exists();
            $name = ($field === 'album_id' ? 'álbum' : 'áudio');
            if ($check) {
                return response()->json(['error' => "Este $name já está adicionado em seus favoritos!"]);
            }
            Favorito::create([
                'user_id' => Auth::user()->id,
                $field    => $request->get('value'),
            ]);
            return response()->json("$name adicionado aos favoritos com sucesso!");

        } catch (\Exception $exception) {
            return response()->json(["error" => "Erro ao adicionar o $name aos favoritos", "message:" => $exception->getMessage()]);
        }
    }




    public function destroy($id)
    {
        try {
            $favorito = Favorito::find($id);
            $favorito->delete();
            return response()->json('Removido com sucesso!');
        } catch (\Exception $exception) {
            return response()->json(["error" => "Erro ao adicionar aos favoritos", "message:" => $exception->getMessage()]);
        }
    }

}
