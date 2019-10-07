<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use Auth;
use Redirect;
use Session;
use Carbon\Carbon;

use App\ImagemBanco;

class BancoImagensController extends Controller
{
    public function index ()
    {
        $imagens = ImagemBanco::query();

        $tem_pesquisa = Input::has('pesquisa') ? (Input::get('pesquisa') != null && Input::get('pesquisa') != "") : false;

        $imagens = ImagemBanco::when($tem_pesquisa, function ($query) {
            return $query
            ->where('titulo', 'like', '%' . Input::get('pesquisa') . '%')
            ->orWhere('descricao', 'like', '%' . Input::get('pesquisa') . '%');
        })
        ->get();

        return view('gestao.banco-imagens')->with( compact('imagens') );
    }

    public function store(Request $request)
    {
        // dd($request);

        if(isset($request->arquivo_imagem))
        {
            $originalName = mb_strtolower( $request->arquivo_imagem->getClientOriginalName(), 'utf-8' );

            $fileExtension = \File::extension($request->arquivo_imagem->getClientOriginalName());
            $newFileNameArquivo =  md5( $request->arquivo_imagem->getClientOriginalName() . date("Y-m-d H:i:s") . time() ) . '.' . $fileExtension;

            $pathArquivo = $request->arquivo_imagem->storeAs('uploads/banco-imagens', $newFileNameArquivo, 'local');

            if(!\Storage::disk('local')->put($pathArquivo, file_get_contents($request->arquivo_imagem)))
            {
                return redirect()->back()->with('error', 'Não foi possível fazer upload da imagem, por favor tente novamente!');
            }
        }
        // else if(isset($request->url_imagem))
        // {
        //     $conteudo = $request->url_imagem;
        // }
        else
        {
            return redirect()->back()->with('error', 'Você deve anexar a imagem que deseja fazer upload!');
        }

        ImagemBanco::create([
            'user_id' => \Auth::user()->id,
            'escola_id' => \Auth::user()->escola_id,
            'titulo' => $request->titulo,
            'descricao' => $request->descricao,
            'original_name' => $originalName,
            'file_name' => $newFileNameArquivo,
            'visibilidade' => $request->visibilidade == null ? 0 : $request->visibilidade,
        ]);

        return redirect()->back()->with('message', 'Imagem criada com sucesso!');
    }

    public function update(Request $request)
    {
        // dd($request);

        if(ImagemBanco::find($request->imagem_id) != null)
        {
            $imagem = ImagemBanco::find($request->imagem_id);

            if(isset($request->arquivo_imagem))
            {
                $originalName = mb_strtolower( $request->arquivo_imagem->getClientOriginalName(), 'utf-8' );

                $fileExtension = \File::extension($request->arquivo_imagem->getClientOriginalName());
                $newFileNameArquivo =  md5( $request->arquivo_imagem->getClientOriginalName() . date("Y-m-d H:i:s") . time() ) . '.' . $fileExtension;

                $pathArquivo = $request->arquivo_imagem->storeAs('uploads/banco-imagens', $newFileNameArquivo, 'local');

                if(!\Storage::disk('local')->put($pathArquivo, file_get_contents($request->arquivo_imagem)))
                {
                    \Session::flash('error', 'Não foi possível fazer upload de seu conteúdo!');
                }
                else
                {
                    if(\Storage::disk('local')->has('uploads/banco-imagens/' . $imagem->file_name))
                    {
                        \Storage::disk('local')->delete('uploads/banco-imagens/' . $imagem->file_name);
                    }

                    $imagem->update([
                        'original_name' => $originalName,
                        'file_name' => $newFileNameArquivo,
                    ]);
                }
            }

            $imagem->update([
                'titulo' => $request->titulo,
                'descricao' => $request->descricao,
                'visibilidade' => $request->visibilidade
            ]);

            return redirect()->back()->with('message', 'Imagem atualizada com sucesso!');
        }
        else
        {
            return response()->json(["response" => false, "data" => "Imagem não encontrada!", 404]);
        }
    }

    public function getImagem($imagem_id)
    {
        if(ImagemBanco::find($imagem_id) != null)
        {
            $imagem = ImagemBanco::find($imagem_id);

            return response()->json(["response" => true, "data" => "Imagem carregada com sucesso!", 'imagem' => $imagem ]);
        }
        else
        {
            return response()->json(["response" => false, "data" => "Imagem não encontrada!", 404]);
        }
    }

    public function getVisualizar($imagem_id)
    {
        if(ImagemBanco::find($imagem_id) != null)
        {
            $imagem = ImagemBanco::find($imagem_id);

            if (\Storage::disk('local')->has('uploads/banco-imagens/' . $imagem->file_name))
            {
                // return \Storage::disk('local')->response('uploads/banco-imagens/' . $imagem->file_name, $imagem->original_name);

                $path = \Storage::disk('local')->path('uploads/banco-imagens/' . $imagem->file_name, $imagem->original_name);



                if (!\File::exists($path)) {

                    abort(404);

                }



                $file = \File::get($path);

                $type = \File::mimeType($path);



                $response = \Response::make($file, 200);

                $response->header("Content-Type", $type);



                return $response;



                // return response()->file( \Storage::disk('local')->get('uploads/banco-imagens/' . $imagem->file_name, $imagem->original_name) );
            }
        }
        else
        {
            // return response()->view('errors.404');
            return redirect('404');
        }
    }

    public function getArquivo($imagem_id)
    {
        if(ImagemBanco::find($imagem_id) != null)
        {
            $imagem = ImagemBanco::find($imagem_id);

            if (\Storage::disk('local')->has('uploads/banco-imagens/' . $imagem->file_name))
            {
                return \Storage::disk('local')->response('uploads/banco-imagens/' . $imagem->file_name, $imagem->original_name);
            }
        }
        else
        {
            // return response()->view('errors.404');
            return redirect('404');
        }
    }

    public function delete(Request $request)
    {
        // dd($request);

        if(ImagemBanco::find($request->imagem_id) != null)
        {
            $imagem = ImagemBanco::find($request->imagem_id);

            if(\Storage::disk('local')->has('uploads/banco-imagens/' . $imagem->file_name))
            {
                \Storage::disk('local')->delete('uploads/banco-imagens/' . $imagem->file_name);
            }

            $imagem->delete();

            return response()->json(["response" => true, "data" => "Imagem excluída com sucesso!", 200]);
        }
        else
        {
            return response()->json(["response" => false, "data" => "Imagem não encontrada!", 404]);
        }
    }

}
