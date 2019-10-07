<?php

namespace App\Http\Controllers\Album\Api;

use App\Entities\Album\Album;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AlbumApiController extends Controller
{

    public function destaques($idEscola = '')
    {
        try
        {
            if(isset($idEscola) && !empty($idEscola))
            {
                $albums = Album::select(
                'albums.id',
                'albums.titulo',
                'albums.capa as url',
                'albums.descricao',
                'albums.categoria',
                'albums.user_id as artist',
                'albums.user_id')
                ->join('users', 'albums.user_id', '=', 'users.id')
                ->join('escolas', 'users.escola_id', '=', DB::raw($idEscola))
                ->with(['audios' => function ($query)
                {
                    $query->select(
                    'audios.id',
                    'audios.titulo as title',
                    'audios.user_id as artist',
                    'audios.file as url',
                    'audios.descricao',
                    'audios.duracao as duration');
                }])
                ->distinct()
                ->orderBy('albums.id', 'DESC')
                ->limit(5)
                ->get();
            }
            else
            {
                $albums = Album::select(
                'albums.id',
                'albums.titulo',
                'albums.capa as url',
                'albums.descricao',
                'albums.categoria',
                'albums.user_id as artist',
                'albums.user_id')
                ->with(['audios' => function ($query)
                {
                    $query->select(
                    'audios.id',
                    'audios.titulo as title',
                    'audios.user_id as artist',
                    'audios.file as url',
                    'audios.descricao',
                    'audios.duracao as duration');
                }])
                ->distinct()
                ->orderBy('albums.id', 'DESC')
                ->limit(5)
                ->get();
            }

            if (!$albums)
            {
                return response()->json(['error' => 'Nenhum álbum foi encontrado']);
            }

            return response()->json($albums);
        }
        catch (\Exception $exception)
        {
            return response()->json(["error" => "Erro ao listar.", "message:" => $exception->getMessage()]);
        }
    }




    public function listar($idEscola, $filter = null)
    {

        if($filter == null)
        {
            $filter = $idEscola;

            $idEscola = null;
        }

        try
        {
            if ($filter !== null)
            {
                if(isset($idEscola))
                {
                    $albums = Album::select(
                    'albums.id',
                    'albums.titulo',
                    'albums.capa as url',
                    'albums.descricao',
                    'albums.categoria',
                    'albums.user_id as artist',
                    'albums.user_id')
                    ->join('users', 'albums.user_id', '=', 'users.id')
                    ->join('escolas', 'users.escola_id', '=', DB::raw($idEscola))
                    ->where('categoria', $filter)
                    ->orWhereHas('categoria', function ($q) use ($filter)
                    {
                        $q->where('titulo', '=', $filter);
                    })
                    ->with(['audios' => function ($query)
                    {
                        $query->select(
                        'audios.id',
                        'audios.titulo as title',
                        'audios.user_id as artist',
                        'audios.file as url',
                        'audios.descricao',
                        'audios.duracao as duration');
                    }])
                    ->distinct()
                    ->orderBy('albums.id', 'DESC')
                    ->paginate(10);
                }
                else
                {
                    $albums = Album::select(
                    'albums.id',
                    'albums.titulo',
                    'albums.capa as url',
                    'albums.descricao',
                    'albums.categoria',
                    'albums.user_id as artist',
                    'albums.user_id')
                    ->where('categoria', $filter)
                    ->orWhereHas('categoria', function ($q) use ($filter)
                    {
                        $q->where('titulo', '=', $filter);
                    })
                    ->with(['audios' => function ($query)
                    {
                        $query->select(
                        'audios.id',
                        'audios.titulo as title',
                        'audios.user_id as artist',
                        'audios.file as url',
                        'audios.descricao',
                        'audios.duracao as duration');
                    }])
                    ->distinct()
                    ->orderBy('albums.id', 'DESC')
                    ->paginate(10);
                }

                return response()->json($albums);
            }

            if(isset($idEscola))
            {
                $albums = Album::select(
                'albums.id',
                'albums.titulo',
                'albums.capa as url',
                'albums.descricao',
                'albums.categoria',
                'albums.user_id as artist',
                'albums.user_id')
                ->join('users', 'albums.user_id', '=', 'users.id')
                ->join('escolas', 'users.escola_id', '=', DB::raw($idEscola))
                ->with(['audios' => function ($query)
                {
                    $query->select(
                    'audios.id',
                    'audios.titulo as title',
                    'audios.user_id as artist',
                    'audios.file as url',
                    'audios.descricao',
                    'audios.duracao as duration'
                    );
                }])
                ->distinct()
                ->orderBy('id', 'DESC')
                ->paginate(10);
            }
            else
            {
                $albums = Album::select(
                'albums.id',
                'albums.titulo',
                'albums.capa as url',
                'albums.descricao',
                'albums.categoria',
                'albums.user_id as artist',
                'albums.user_id')
                ->with(['audios' => function ($query)
                {
                    $query->select(
                    'audios.id',
                    'audios.titulo as title',
                    'audios.user_id as artist',
                    'audios.file as url',
                    'audios.descricao',
                    'audios.duracao as duration'
                    );
                }])
                ->distinct()
                ->orderBy('id', 'DESC')
                ->paginate(10);
            }

            if ($albums->isEmpty())
            {
                return response()->json(['error' => 'Nenhum álbum foi encontrado']);
            }

            return response()->json($albums);
        }
        catch (\Exception $exception)
        {
            return response()->json(["error" => "Erro ao listar.", "message:" => $exception->getMessage()]);
        }
    }




    public function show($idAlbum)
    {
        try {
            $album = Album::with(['audios' => function ($query) {
                $query->select(
                'audios.id',
                'audios.titulo as title',
                'audios.user_id as artist',
                'audios.file as url',
                'audios.descricao',
                'audios.duracao as duration');
            }])
            ->select(
            'albums.id',
            'albums.titulo',
            'albums.capa as url',
            'albums.descricao',
            'albums.categoria',
            'albums.user_id as artist',
            'albums.user_id')
            ->find($idAlbum);

            if (!$album)
            {
                return response()->json(['error' => 'Nenhum álbum foi encontrado']);
            }

            return response()->json($album);
        }
        catch (\Exception $exception)
        {
            return response()->json(["error" => "Erro ao encontrar", "message:" => $exception->getMessage()]);
        }
    }
}

