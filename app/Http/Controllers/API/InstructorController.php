<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class InstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      try 
      {
        $users = User::where('permissao', 'P')
          ->with(['albuns' => function ($query) {
          $query->select('albums.id', 'albums.titulo', 'albums.capa as url', 'albums.descricao', 
            'albums.categoria', 'albums.user_id as artist', 'albums.user_id', 'albums.created_at');
        }])->select('users.id', 'users.name', 'users.email', 'users.img_perfil', 'users.descricao')
        ->get();

        return response()->json(["data" => $users]);
      }
      catch (\Exception $exception) 
      {
        return response()->json(['error' => true, 'message:' => $exception->getMessage()], 500);
      }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      try {
        $user = User::where('id', $id)->where('permissao', 'P')
            ->with(['albuns' => function ($query) {
                $query->select('albums.id', 'albums.titulo', 'albums.capa as url', 'albums.descricao',
                    'albums.categoria', 'albums.user_id as artist', 'albums.user_id', 'albums.created_at');
            }])
            ->select('users.id', 'users.name', 'users.email', 'users.img_perfil', 'users.descricao')
            ->first();
        if (!empty($user)) {
          return response()->json(["data" => $user]);
        } else {
          return response()->json(["error" => true, "message" => "Erro ao encontrar instrutor"], 404);
        }
      } catch (\Exception $exception) {
          return response()->json(['error' => true, 'message:' => $exception->getMessage()], 500);
      }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
