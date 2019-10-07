<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

use Request;

class HelperClass extends Model
{
    public static function AppendToUrl($newQueries)
    {
        //Retrieve current query strings:
        $currentQueries = Request::query();

        //Merge together current and new query strings:
        $allQueries = array_merge($currentQueries, $newQueries);

        //Generate the URL with all the queries:
        return Request::fullUrlWithQuery($allQueries);
    }

    /**
     * Gera a paginação dos itens de um array ou collection.
     *
     * @param array|Collection $items
     * @param int $perPage
     * @param int $page
     * @param array $options
     *
     * @return LengthAwarePaginator
     */
    public static function paginate($items, $perPage = 15, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);

        $pagination = new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);

        return $pagination;
    }

    public static function RandomString($length)
    {
        $char = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $char = str_shuffle($char);
        for ($i = 0, $rand = '', $l = strlen($char) - 1; $i < $length; $i++) {
            $rand .= $char{mt_rand(0, $l)};
        }

        return $rand;
    }

    public static function needSideBar()
    {
        if (Request::is('home') || \Request::is('playlists') || \Request::is('plano-de-estudos') || \Request::is('canal-do-professor/*/*') || Request::is('grade-de-aula/data/*') || Request::is('catalogo') || Request::is('historico') || Request::is('historico/*') || Request::is('favoritos') || Request::is('favoritos/*') || Request::is('ranking') || Request::is('plano-de-aulas/*') || Request::is('estatisticas') || Request::is('catalogo') || Request::is('catalogo/*') || Request::is('biblioteca') || Request::is('play/*') ||
            Request::is('aplicacao/*') || Request::is('glossario') || Request::is('glossario/*') || Request::is('perfil/*') ||
            Request::is('turmas') || Request::is('turma/*') || Request::is('habilidades') || Request::is('habilidades/*') || Request::is('agenda') || Request::is('agenda/*') || Request::is('teste-nivelamento') || Request::is('teste-nivelamento/*') ||
            Request::is('professor/*') ||
            Request::is('artigos') ||            Request::is('artigos/*') ||
            Request::is('escola/*/mural') ) {
            return true;
        } else {
            return false;
        }
    }

    public static function needGestaoSideBar()
    {
        if (Request::is('gestao/*') || Request::is('dashboard/*')) {
            return true;
        } else {
            return false;
        }
    }

    public static function getAplicacaoAtual()
    {
        if(Request::is('dashboard/*') || Request::is('gestao/escolas') || Request::is('gestao/usuarios'))
        {
            return "manager";
        }
        else if(Request::is('gestao/escola/*'))
        {
            return "school";
        }
        else if (Request::is('gestao/*'))
        {
            return "master";
        }
        else if (Request::is('home') || \Request::is('playlists') || \Request::is('plano-de-estudos') || \Request::is('canal-do-professor/*/*') || Request::is('grade-de-aula/data/*') || Request::is('catalogo') || Request::is('historico') || Request::is('historico/*') || Request::is('favoritos') || Request::is('favoritos/*') || Request::is('ranking') || Request::is('plano-de-aulas/*') || Request::is('estatisticas') || Request::is('catalogo') || Request::is('catalogo/*') || Request::is('biblioteca') || Request::is('play/*') ||
            Request::is('aplicacao/*') || Request::is('glossario') || Request::is('glossario/*') || Request::is('perfil/*') ||
            Request::is('turmas') || Request::is('turma/*') || Request::is('habilidades') || Request::is('habilidades/*') || Request::is('agenda') || Request::is('agenda/*') || Request::is('teste-nivelamento') || Request::is('teste-nivelamento/*') ||
            Request::is('professor/*') ||
            Request::is('artigos') ||            Request::is('artigos/*') ||
            Request::is('escola/*/mural') ) {
            return "play";
        }
        else
        {
            return false;
        }
    }

    public static function needDocSideBar()
    {
        if (Request::is('dashboard/documentacao/*')) {
            return true;
        }
        return false;
    }

    public static function needSideBarButton()
    {
        if (Request::is('home') || \Request::is('plano-de-estudos') || \Request::is('canal-do-professor/*/*') || Request::is('grade-de-aula/data/*') || Request::is('teste-nivelamento') || Request::is('playlists') || Request::is('catalogo') || Request::is('historico') || Request::is('historico/*') || Request::is('favoritos') || Request::is('favoritos/*') || Request::is('ranking') || Request::is('plano-de-aulas/*') || Request::is('estatisticas') || Request::is('catalogo') || Request::is('catalogo/*') || Request::is('biblioteca') || Request::is('play/*') ||
            Request::is('aplicacao/*') || Request::is('glossario') || Request::is('glossario/*') || Request::is('perfil/*') ||
            Request::is('turmas') || Request::is('turma/*') || Request::is('habilidades') || Request::is('habilidades/*') || Request::is('agenda') ||
            Request::is('professor/*') || Request::is('gestao/*') || Request::is('dashboard/*') ||
            Request::is('artigos') || Request::is('artigos/*') ||
            Request::is('escola/*/mural') ) {
            return true;
        } else {
            return false;
        }
    }

    public static function previousRoute()
    {
        try
        {
            if(\URL::previous())
            {
                return app('router')->getRoutes()->match(app('request')->create( str_replace(env('APP_URL'), "", \URL::previous())  ))->getName();
            }
            else
            {
                return null;
            }
        }
        catch (\Throwable $th)
        {
            return null;
        }
    }

    public static function comparePreviousRoute($routeName)
    {
        if(\URL::previous())
        {
            if($routeName == self::previousRoute())
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return null;
        }
    }

    public static function drawCarrinho()
    {
        $html = "";

        if(\Session::has('carrinho') ? count(\Session::get('carrinho')) > 0 : false)
        {
            $total = 0;

            foreach(\Session::get('carrinho') as $produto)
            {
                $total += $produto->preco;

                $html = $html . '<div class="dropdown-item px-3 py-1 mb-1" style="border-bottom:  1px solid #f8f8f8;width: auto;clear: both;font-weight: 400;color: #212529;text-align: inherit;white-space: nowrap;background-color: transparent;border: 0;flex-direction: row;display: flex; max-height: 90px; align-items: center;">';

                if($produto->tipo == 2 && $produto->curso != null)
                {
                    $html = $html . '<div class="" style="background-image: url(' . env('APP_LOCAL') . '/uploads/cursos/capas/' .  $produto->curso->capa . ');background-size: cover; background-position: 50% 50%; background-repeat: no-repeat; width: 60px; height: 60px; margin-right: 10px; display: inline-block; vertical-align: middle;">
                    </div>';
                }

                $html = $html . '
                        <div>
                            <b style="max-width: 200px;white-space: normal; overflow: hidden;" class="pl-2 mb-0">
                                ' . ucfirst($produto->titulo) . '
                            </b>

                            <p class="small pl-2 mb-0">' . ucfirst($produto->descricao) . '</p>

                            <p style="" class="pl-2 mb-0">
                                R$ ' . number_format($produto->preco, 2, ',', '.') . ($produto->quantidade >= 2 ? ' (' . $produto->quantidade . 'x)' : '')  . '
                            </p>
                        </div>
                        <a class="text-primary ml-auto" href="' . route('carrinho.remover', ['idProduto' => $produto->id, 'return' => Request::url()]) .'" style="align-self: flex-start; justify-self: flex-end;"><i class="fa fa-times fa-fw fa-sm" aria-hidden="true"></i></a>
                    ';

                $html = $html . '</div>';
            }

            $html = $html . '<div class="dropdown-item px-3 py-3" style="color: #60748A;min-width:  340px;border-bottom:  2px solid #E3E5F0;">
                <h5>
                    <span class="text-lightgray">Total: </span>
                    R$ ' . number_format($total, 2, ',', '.') . '
                </h5>
                ' . (Request::is('carrinho') == false ? '<a href="' . route('carrinho.index') . '" class="btn btn-primary btn-block text-center">Ir para o carrinho</a>' : '') . '
            </div>';
        }
        else
        {
            $html = '
                <div class="dropdown-item px-4 py-3" style="color: #60748A;min-width:  340px;border-bottom:  2px solid #E3E5F0;">
                    Seu carrinho está vazio.
                </div>
            ';
        }

        return $html;
    }

    public static function linkfy($text)
    {
        $url = '~(?:(https?)://([^\s<]+)|(www\.[^\s<]+?\.[^\s<]+))(?<![\.,:])~i';

        $string = preg_replace($url, '<a href="$0" target="_blank" title="$0">$0</a>', $text);

        return  $string;
    }
}
