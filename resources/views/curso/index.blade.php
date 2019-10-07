@extends('layouts.master')

{{--  @section('title', 'J. PIAGET - Curso')  --}}
@section('title', ucfirst($curso->titulo))

@section('headend')

    <meta property="og:url"                content="{{ \URL::current() }}" />
    <meta property="og:type"               content="course" />
    <meta property="og:title"              content="{{ ucfirst($curso->titulo) . ' - Prof ' . ucwords($curso->user->name) }}" />
    <meta property="og:description"        content="{{ ucwords($curso->descricao_curta) }}" />
    <meta property="og:image"              content="{{ env('APP_LOCAL') . '/uploads/cursos/capas/' .  $curso->capa }}" />

    <!-- Custom styles for this template -->
    <style>

        header
        {
            padding: 154px 0 100px;
        }

        main
        {
            padding-top: 0px !important;
        }

        @media (min-width: 992px)
        {
            header
            {
                padding: 156px 0 100px;
            }
        }

        @media (max-width: 768px)
        {
            .h1, h1 {
                font-size: 1.6rem;
            }
        }

        .list-group
        {
            font-size: 16px;
        }

        .list-group-item
        {
            border: 0px;
        }

        #listAulas .list-group-item
        {
            border-left: 8px solid #ddd;
        }

        #listAulas .list-group-item:first-child
        {
            border-radius: 0px;
            @if(isset($escola->caracteristicas) ? (isset($escola->caracteristicas->cor1) ? $escola->caracteristicas->cor1 != null : false) : false)
                border-left: 8px solid {{ $escola->caracteristicas->cor1 }};
            @else
                border-left: 8px solid #008CC8;
            @endif
        }

        .list-group-item:first-child, .list-group-item:last-child
        {
            border-radius: 0px;
        }

    </style>

@endsection

@section('content')


<main role="main">

    @if(Session::has('previewMode'))
        <div class="text-center p-3 text-white" style="background-color: #f3aa3d; position: sticky; left: 0px; top: 0px; z-index: 1;">
            <h3 class="d-inline-block align-middle my-auto">
                Curso não publicado (Preview)
                <a href="{{ route('gestao.curso-conteudo', ['curso_id' => $curso->id]) }}" class="ml-2 text-white small">Voltar</a>
            </h3>
            <button type="button" class="btn btn-light bg-transparent border-0 p-1 float-right mr-5 my-auto align-middle" onclick="$(this).parent().remove();">
                <i class="far fa-times-circle fa-2x text-white"></i>
            </button>
        </div>
    @endif

    <div class="container-fluid">

        <div class="row">

            <div class="d-flex" style="background-image: url('{{ env('APP_LOCAL') . '/uploads/cursos/capas/' .  $curso->capa }}');background-size: cover; background-position: 50% 50%; background-repeat: no-repeat; border: 0px;width:  100%;height: 55vh;position:  relative;border-bottom:  2px solid #ddd;min-height: 450px;">
                <div class="mt-auto" style="background-color: rgba(0, 0, 0, .7);/*background: linear-gradient(rgba(55, 62, 70, 0.1),rgba(128, 156, 255, .5));*/ width:  100%;padding: 5% 12%;color: white;justify-content: flex-start;align-items: center;display: flex; max-height: 35%;">
                    <h1 class="font-weight-bold" style="max-width:  60%;">
                        {{ ucfirst($curso->titulo) }}
                        <small class="mt-3" style="display:  block;font-size:  45%;">
                            <span class="mr-3">
                                <i class="fas fa-eye mr-2"></i>
                                {{ $curso->visualizacoes }}
                            </span>
                            <span>
                                {{-- <span class="fa-stack">
                                    <i class="fas fa-star fa-stack-1x fa-fw" style="color: gold;"></i>
                                    <i class="fas fa-star-half fa-stack-1x fa-fw fa-flip-horizontal" style="margin-left: 5px;"></i>
                                </span> --}}
                                @for ($i = 0; $i < 5; $i++)
                                    @if($i < floor($curso->avaliacao))
                                        <i class="fas fa-star text-warning"></i>
                                    @elseif($i < $curso->avaliacao)
                                        <span class="fa-stack" style="width: 20px; height: 18px; line-height: 0.9rem;">
                                            <i class="fas fa-star fa-stack-1x fa-fw" style="color: gold;"></i>
                                            <i class="fas fa-star-half fa-stack-1x fa-fw fa-flip-horizontal" style="color: #e3e3e3; margin-left: 5px;"></i>
                                        </span>
                                    @else
                                        <i class="fas fa-star" style="color: #e3e3e3;"></i>
                                    @endif
                                @endfor
                                ({{ $curso->avaliacao > 0 ? number_format($curso->avaliacao, 1, ",", ".") : '-' }})
                            </span>
                        </small>
                    </h1>
                </div>
                {{--  <div class="bg-primary" style="position:  absolute;bottom: 0px;left:  50%;transform: translateX(-50%);color:  white;font-weight:  bold;font-size:  18px;padding: 2vh 5vw;width:  auto;border-radius: 20px 20px 0px 0px;">
                    <div class="container">
                        <div class="row" style="font-size:  75%;">
                            <div class="col">Nota</div>
                            <div class="col">Investimento</div>
                            <div class="col">Carga horária</div>
                        </div>
                        <div class="row">
                            <div class="col-4">-</div>
                            <div class="col-4">{{ $curso->preco > 0 ? 'R$ ' . $curso->preco : 'Gratuito' }}</div>
                            <div class="col-4">3 horas</div>
                        </div>
                    </div>
                </div>  --}}
            </div>

            <div class="col-10 col-md-10 col-lg-8 mx-auto">
                <div class="row my-4">
                    <div class="col-12 col-md-6 text-left">
                        @if($curso->user != null)
                            <h4>
                                <span class="font-weight-bold">Professor</span>
                            </h4>

                            <div class="avatar-img my-3 d-inline-block mr-2" style="width: 54px;height: 54px; background: url({{ route('usuario.perfil.image', [$curso->user->id]) }}); background-size: cover; background-position: 50% 50%; background-repeat: no-repeat;"></div>

                            <div class="d-inline-block align-middle pl-2">
                                <h6 class="font-weight-bold">
                                    {{ ucwords($curso->user->name) }}
                                    <span class="font-weight-normal">
                                        ({{ $curso->user->avaliacao > 0 ? number_format($curso->user->avaliacao, 1, ",", ".") : '-' }})
                                    </span>
                                </h6>
                                <h5 class="">

                                    {{-- <i class="fas fa-star" style="color: gold;"></i> --}}
                                </h5>
                            </div>
                        @endif
                    </div>
                    <div class="col-12 col-md-4 text-right ml-auto mt-auto mb-auto">
                        @if($matricula != null || Session::has('previewMode'))
                            <a href="{{ isset($escola) ? route('curso.play', ['escola_id' => $escola->url, 'idCurso' => $curso->titulo]) : route('curso.play', ['idCurso' => $curso->titulo]) }}" class="btn mx-1" style="background:  transparent;border:  0px;">
                                <div class="btn btn-light d-block mb-2" style="padding:  12px;box-shadow:  0px 3px 6px rgba(0,0,0,0.2);">
                                    <i class="fas fa-play fa-fw text-primary"></i>
                                </div>
                                Iniciar
                            </a>
                            <button class="btn mx-1 disabled" style="background:  transparent;border:  0px;" hidden>
                                <div class="btn btn-light d-block mb-2 disabled" style="padding:  12px;box-shadow:  0px 3px 6px rgba(0,0,0,0.2);">
                                    <i class="fas fa-pause fa-fw"></i>
                                </div>
                                Pausar
                            </button>
                            {{-- <button class="btn mx-1" style="background:  transparent;border:  0px;">
                                <div class="btn btn-light d-block mb-2" style="padding:  12px;box-shadow:  0px 3px 6px rgba(0,0,0,0.2);">
                                    <i class="fas fa-check fa-fw text-success"></i>
                                </div>
                                Concluir
                            </button> --}}
                            <button class="btn mx-1" style="background:  transparent;border:  0px;" hidden>
                                <div class="btn btn-light d-block mb-2" style="padding:  12px;box-shadow:  0px 3px 6px rgba(0,0,0,0.2);">
                                    <i class="fas fa-star fa-fw text-warning"></i>
                                </div>
                                Favoritar
                            </button>
                        @else
                            <div class="p-4 text-left" style="box-shadow: rgba(0, 0, 0, 0.2) 0px 3px 3px;border-radius: 10px;">
                                <h2 class="my-3">{{ $curso->preco > 0 ? 'R$ ' . number_format($curso->preco, 2, ',', '.') : 'Gratuito' }}</h2>

                                @if($curso->preco > 0)
                                    @if($curso->statusPagamento != null)
                                        @if($curso->statusPagamento == 3 || $curso->statusPagamento == 4)
                                            <a href="{{ route('curso.matricular', ['idCurso' => $curso->id]) }}" class="btn btn-primary btn-block text-wrap text-white">
                                                Iniciar
                                            </a>
                                        @elseif($curso->statusPagamento < 3)
                                            <div class="bg-primary text-white rounded text-center py-2 btn-block text-wrap">
                                                {{ $curso->statusPagamento == 2 ? 'Processando pagamento' : 'Aguardando pagamento' }}
                                            </div>
                                            <a href="{{ route('configuracao.index') }}#pagamentos" class="bg-transparent text-primary btn btn-block text-wrap text-white" style="border: 2px solid;">
                                                Minhas transações
                                            </a>
                                        @else
                                            <a href="{{ route('curso.checkout',['idCurso'=>$curso->id]) }}" class="btn btn-primary btn-block text-wrap text-white">
                                                Comprar agora
                                            </a>
                                            @if(Session::has('carrinho') ? (count( array_filter(Session::get('carrinho'), function($k) use ($curso) { return ($k->tipo == 2 && $k->id == $curso->id); }) ) == 0) : true)
                                                <a href="{{ route('curso.adicionar-carrinho', ['idCurso' => $curso->id, 'return' => Request::url()]) }}" class="btn btn-light btn-block text-wrap" style="border: 2px solid #ddd;">
                                                    Adicionar ao carrinho
                                                </a>
                                            @else
                                                <a href="{{ route('carrinho.remover', ['idProduto' => $curso->id, 'return' => Request::url()]) }}" class="btn btn-light btn-block text-wrap" style="border: 2px solid #ddd;">
                                                    Remover do carrinho
                                                </a>
                                            @endif
                                        @endif
                                    @else
                                        <a href="{{ route('curso.checkout',['idCurso'=>$curso->id]) }}" class="btn btn-primary btn-block text-wrap">
                                            Comprar agora
                                        </a>
                                        @if(Session::has('carrinho') ? (count( array_filter(Session::get('carrinho'), function($k) use ($curso) { return ($k->tipo == 2 && $k->id == $curso->id); }) ) == 0) : true)
                                            <a href="{{ route('curso.adicionar-carrinho', ['idCurso' => $curso->id, 'return' => Request::url()]) }}" class="btn btn-light btn-block text-wrap" style="border: 2px solid #ddd;">
                                                Adicionar ao carrinho
                                            </a>
                                        @else
                                            <a href="{{ route('carrinho.remover', ['idProduto' => $curso->id, 'return' => Request::url()]) }}" class="btn btn-light btn-block text-wrap" style="border: 2px solid #ddd;">
                                                Remover do carrinho
                                            </a>
                                        @endif
                                    @endif
                                @else
                                    <a href="{{ route('curso.matricular', ['idCurso' => $curso->id]) }}" class="btn bg-primary rounded-10 btn-block text-wrap text-white">
                                        Matricular-se agora
                                    </a>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
                <hr>

                <div class="row">
                    <div class="col-md-8">
                        <h4 class="font-weight-bold">Descrição</h4>
                        <p class="text-wrap" style="font-size: 18px;color: #525870;line-height: 1.6;font-weight: 600;">
                            {!! $curso->descricao !!}
                            {{--  {{ $curso->descricao }}  --}}
                        </p>
                    </div>

                    {{-- <div class="col-md-4" style="">
                        <div class="p-4" style="box-shadow: rgba(0, 0, 0, 0.2) 0px 3px 3px;border-radius: 10px;">
                            <h2 class="my-3">{{ $curso->preco > 0 ? 'R$ ' . $curso->preco : 'Gratuito' }}</h2>

                            <button class="btn btn-primary btn-block">
                                Matricular-se agora
                            </button>

                            <button class="btn btn-light btn-block disabled" style="border: 2px solid #ddd;">
                                Ir para carrinho
                            </button>

                            <div style="position: relative;">
                                <hr style="border: 0;height: 1px;background: #999;position: absolute;top: 3px;width: 100%;left:  0px;z-index:  0;">
                                <a class="btn d-block" href="#" style="text-align:  center;font-weight:  bold;position:  relative;">
                                    <span style="background:  white;padding:  0px 20px;">Tem cupom?</span>
                                </a>
                            </div>
                        </div>
                    </div> --}}
                </div>
                <hr>

                <div class="row my-4">
                    <div class="col-12">
                        <h5 class="">
                            Grade curricular deste curso
                            <div class="small font-weight-bold my-2 my-md-0 float-none float-md-right">
                                <a href="javascript:void(0)" onclick="$('#listAulas .collapse').collapse('toggle');" class="mr-3">Expandir tudo</a>
                                <span class="text-lighter mr-3">{{ count($curso->aulas) . ' aula' . (count($curso->aulas) == 1 ? '' : 's') }}</span>
                                <span class="text-lighter">{{ $curso->duracao }}</span>
                            </div>
                        </h5>
                        <ul id="listAulas" class="list-group py-2" style="font-size: 18px;width: 100%;">
                            @foreach ($curso->aulas as $index => $aula)

                                <li class="list-group-item font-weight-bold">
                                    <a class="text-secondary" data-toggle="collapse" href="#divCollapseAula{{ $index }}" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">
                                        <i class="fas fa-plus mr-2"></i>
                                        {{ ucfirst($aula->titulo) }}
                                        <span class="float-right">{{ $aula->duracao }}</span>
                                    </a>
                                </li>
                                <li class="list-group-item p-0 collapse multi-collapse" id="divCollapseAula{{ $index }}" style="background-color: #fcfcfc;">
                                    @if(count($aula->conteudos) == 0)
                                        <span class="py-2 px-5 d-block">Esta aula ainda não possui nenhum conteúdo.</span>
                                    @endif
                                    <ul class="px-0" style="">
                                        @foreach ($aula->conteudos as $indexCont => $conteudo)
                                            <li class="py-2 px-5 d-block" style="border-top: 1px solid #e8e9eb;">
                                                <a href="{{ isset($escola) ? route('curso.play', ['escola_id' => $escola->url, 'idCurso' => $curso->titulo, 'aula' => $aula->id, 'conteudo' => $conteudo->id]) : route('curso.play', ['idCurso' => $curso->titulo, 'aula' => $aula->id, 'conteudo' => $conteudo->id]) }}">
                                                    <i class="{{ $conteudo->tipo_icon }} mr-2"></i>
                                                    {{ ucfirst($conteudo->titulo) }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>

                            @endforeach
                            @if(count($curso->aulas) == 0)
                                <li class="list-group-item font-weight-bold">
                                    Este curso ainda não possui nenhuma aula.
                                </li>
                            @endif
                        </ul>

                    </div>

                </div>
                <hr>

                <div class="row my-4">
                    <div class="col-12">
                        <h4 class="font-weight-bold">Avaliações</h4>
                        <ul class="list-group py-3">

                            @foreach ($curso->avaliacoes_user as $avaliacao)
                                {{-- @if($avaliacao->descricao != '') --}}

                                    <span hidden>{!! $hasAvaliacao = true; !!}</span>

                                    <li class="list-group-item font-weight-bold mb-2 bg-transparent">

                                        <div class="row">
                                            <div class="col-auto text-left px-0">
                                                <div class="avatar-img my-0 d-inline-block" style="width: 54px;height: 54px; background: url({{ route('usuario.perfil.image', [$avaliacao->user['id']]) }}); background-size: cover; background-position: 50% 50%; background-repeat: no-repeat;"></div>
                                            </div>
                                            <div class="col text-left my-auto">
                                                <div class="d-inline-block align-middle">
                                                    <h6 class="font-weight-bold">

                                                        {{ ucwords($avaliacao->user['name']) }}
                                                        <small class="d-inline-block ml-2">
                                                            @for ($i = 0; $i < 5; $i++)
                                                                @if($i < floor($avaliacao->avaliacao))
                                                                    <i class="fas fa-star text-warning"></i>
                                                                @elseif($i < $avaliacao->avaliacao)
                                                                    <span class="fa-stack" style="width: 20px; height: 18px; line-height: 0.9rem;">
                                                                        <i class="fas fa-star fa-stack-1x fa-fw" style="color: gold;"></i>
                                                                        <i class="fas fa-star-half fa-stack-1x fa-fw fa-flip-horizontal" style="color: #e3e3e3; margin-left: 5px;"></i>
                                                                    </span>
                                                                @else
                                                                    <i class="fas fa-star" style="color: #e3e3e3;"></i>
                                                                @endif
                                                            @endfor
                                                        </small>
                                                    </h6>
                                                </div>
                                                @if($avaliacao->descricao != '')
                                                    <p class="text-secondary">
                                                        {{ ucfirst($avaliacao->descricao) }}
                                                    </p>
                                                @endif
                                            </div>
                                        </div>

                                    </li>

                                {{-- @endif --}}

                            @endforeach

                            @if(!isset($hasAvaliacao) || count($curso->avaliacoes_user) == 0)
                                <li class="list-group-item font-weight-bold">
                                    <div class="row">
                                        <div class="col text-left">
                                            <div class="d-inline-block align-middle pl-2">
                                                <h5 class="font-weight-bold">
                                                </h5>
                                            </div>
                                            <p class="text-muted">
                                                {{ count($curso->avaliacoes_user) > 0 ? "Este curso ainda não recebeu comentários." : "Este curso ainda não recebeu avaliações."}}
                                            </p>
                                        </div>
                                    </div>
                                </li>
                            @endif

                        </ul>
                    </div>
                </div>

                <hr style="border-color: #989AC1;">

                @if(Auth::user()->id == $curso->user_id)
                    <div class="row">
                        <div class="col-12 ml-auto align-middle my-auto text-right">
                            <button type="button" data-toggle="modal" data-target="#divModalNovoTopico" class="btn btn-primary py-2">
                                <i class="fas fa-plus fa-fw mr-2"></i>
                                Novo tópico
                            </button>
                        </div>
                    </div>
                @endif

                <div class="row">

                    <div class="col-12">

                        <h4 class="font-weight-bold">Fórum</h4>

                        <ul class="list-group py-3">

                            <li class="list-group-item font-weight-bold bg-transparent" style="border: 0px;">



                                @foreach ($curso->topicos as $topico)

                                    <div class="row py-4 px-3 mb-4 box-shadow bg-white rounded-10">
                                        <div class="col-auto my-auto text-left">
                                            @if($topico->status == 0)
                                                <i class="fas fa-unlock fa-fw fa-lg text-success"></i>
                                            @else
                                                <i class="fas fa-lock fa-fw fa-lg text-danger"></i>
                                            @endif
                                        </div>
                                        <div class="col-auto my-auto text-left">
                                            <h5 class="text-dark font-weight-bold">
                                                <span class="">{{ ucfirst($topico->titulo) }}</span>
                                            </h5>
                                            <div class="d-inline-block font-weight-bold align-middle mb-2">
                                                Por: {{ $topico->user['name'] }} - {{ $topico->created_at->format('d/m/Y \à\s H:i') }}
                                            </div>
                                        </div>
                                        <div class="col-auto my-auto text-right ml-auto border-right">
                                            <div class="d-inline-block align-middle mb-2">
                                                <p class="font-weight-normal text-dark mb-1">
                                                    {{ $topico->ultimo_comentario != null ? $topico->ultimo_comentario->user->name : '-' }}
                                                </p>
                                                <p class="font-weight-normal m-0">
                                                    {{ $topico->ultimo_comentario != null ? $topico->ultimo_comentario->created_at->format('d/m/Y \à\s H:i') : '-' }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-auto my-auto text-left border-left">
                                            <div class="d-inline-block align-middle mb-2">
                                                <p class="font-weight-bold text-dark mb-1">
                                                    {{ $topico->comentarios_count }} resposta{{ $topico->comentarios_count != 1 ? 's' : '' }}
                                                </p>
                                                <p class="font-weight-bold m-0">
                                                    {{ $topico->visualizacoes }} visualizaç{{ $topico->visualizacoes != 1 ? 'ões' : 'ão' }}
                                                </p>
                                            </div>
                                        </div>
                                        <a href="{{ route( (Request::is('gestao/*') ? 'gestao.' : '') . 'curso.topico-respostas', ['curso_id' => $topico->curso_id, 'topico_curso_id' => $topico->id]) }}" class="col-auto my-auto text-dark text-right">
                                            <div class="d-inline-block align-middle mb-2">
                                                <small class="btn btn-outline-primary btn-sm text-uppercase ml-2">
                                                    Visualizar tópico
                                                </small>
                                            </div>
                                        </a>
                                    </div>

                                @endforeach

                                @if(count($curso->topicos) == 0)

                                    <div class="row">
                                        <div class="col text-left">
                                            <p class="font-weight-normal">
                                                Este curso não possui nenhum tópico ainda.
                                            </p>
                                        </div>
                                    </div>

                                @endif

                            </li>

                        </ul>

                    </div>

                </div>


                <!-- Modal Novo Topico -->
                <div class="modal fade" id="divModalNovoTopico" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
                    <div class="modal-dialog modal-dialog-centered px-1 px-md-5" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>

                                <form id="formNovoTopico" method="POST" action="{{ route('curso.topico-enviar', ['curso_id' => $curso->id]) }}" class="text-center px-3 shadow-none border-0">

                                    @csrf

                                    <div id="divEnviando" class="text-center d-none">
                                        <i class="fas fa-spinner fa-pulse fa-3x text-primary mb-3"></i>
                                        <h4>Enviando</h4>
                                    </div>

                                    <div id="divEditar" class="form-page">

                                        <div id="page1" class="form-page">

                                            <h4 class="mb-4">Novo tópico</h4>

                                            <div class="form-group mb-4 text-left">
                                                <label class="" for="titulo">Título do tópico</label>
                                                <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Clique para digitar." required>
                                            </div>

                                            <div class="form-group mb-4 text-left">
                                                <label class="" for="descricao">Descrição do tópico</label>
                                                <textarea class="form-control" name="descricao" id="descricao" rows="3" placeholder="Clique para digitar." required></textarea>
                                            </div>

                                            <div class="row">
                                                <button type="button" data-dismiss="modal" class="btn btn-lg btn-block outline-button mt-4 mb-0 col-4 ml-auto mr-4 font-weight-bold">Cancelar</button>
                                                <button type="submit" onclick="$('#formNovoTopico')[0].checkValidity() ? enviarTopico() : event.preventDefault();" class="btn btn-lg bg-bluelight btn-block signin-button mt-4 mb-0 col-4 ml-4 mr-auto text-dark font-weight-bold">Criar</button>
                                            </div>

                                        </div>



                                    </div>

                                </form>

                            </div>

                        </div>
                    </div>
                </div>
                <!-- Fim modal nova topico -->

            </div>

        </div>
    </div>
</main>

@endsection

@section('bodyend')

    <script>

        $( document ).ready(function()
        {

        });

        @if(Auth::check() ? (Auth::user()->id == $curso->user_id || (strtoupper(Auth::user()->permissao) != "G" || strtoupper(Auth::user()->permissao) != "Z")) : false)
            function enviarTopico()
            {
                $("#formNovoTopico #divEnviando").removeClass('d-none');

                $("#formNovoTopico #divEditar").addClass('d-none');
            }
        @endif

    </script>

@endsection
