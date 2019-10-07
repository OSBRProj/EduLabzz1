<?php

namespace App\Http\Controllers\User\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserApiController extends controller
{
    public function getInstrutor($id)
    {
        try {
            $user = User::where('id', $id)
                //->with('albuns')
                ->with(['albuns' => function ($query) {
                    $query->select('albums.id', 'albums.titulo', 'albums.capa as url', 'albums.descricao',
                        'albums.categoria', 'albums.user_id as artist', 'albums.user_id', 'albums.created_at');
                }])
                ->select('users.id', 'users.name', 'users.email', 'users.img_perfil', 'users.descricao')
                ->first();
            return response()->json($user);
        } catch (\Exception $exception) {
            return response()->json(['error' => 'Erro ao listar Instrutor', 'message:' => $exception->getMessage()]);
        }
    }
}

