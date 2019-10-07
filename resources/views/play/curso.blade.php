<!DOCTYPE html>
{{-- <html lang="pt-br"> --}}
<html lang="{{ app()->getLocale() }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Descrição aqui">
    <meta name="author" content="Jean Piaget - Edulabzz">
    <link rel="icon" href="{{ env('APP_URL') }}/images/favicon.ico">

    {{-- <title>J. PIAGET - Play Curso</title> --}}
    <title>{{ isset($escola) ? $escola->titulo : 'Jean Piaget' }} - {{ ucfirst($curso->titulo) }}</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- Font Body -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>

    <!-- Animations -->
    {{-- <link href="{{ env('APP_URL') }}/assets/css/animated.css" rel="stylesheet"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" />

    <!--  Video JS  -->
    <link href="https://vjs.zencdn.net/7.1.0/video-js.css" rel="stylesheet">

    <!-- (for Video.js versions prior to v7) -->
    <script src="https://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>


    <!-- Font Edulabzz -->

    <!-- Custom styles main -->
    <link rel="stylesheet" href="{{ env('APP_URL') }}/assets/css/main.css">

    <!-- Plyr Video Player -->
    <link rel="stylesheet" href="https://cdn.plyr.io/3.5.2/plyr.css" />

    <style>

        body, main
        {
            margin-top: 0px;
            padding-bottom: 0px !important;
        }

        .custom-radio .custom-control-label::before, .custom-radio .custom-control-label::after
        {
            top: 0px;
            width: 2rem;
            height: 2rem;
        }

        .aula-incompleta
        {
            background-color: transparent;
        }

        .btn-aula:hover, .btn-conteudo:hover
        {
            background-color: #e3e3e3;
        }

        .aula-completa
        {
            background-color: transparent;
        }

        .aula-ativa
        {
            background-color: transparent;
        }

        .conteudo-incompleto
        {
            background-color: #F9F9F9;
        }

        .conteudo-incorreto
        {
            background-color: transparent;
        }

        .conteudo-completo
        {
            background-color: transparent;
        }

        .conteudo-ativo
        {
            background-color: #e6ecf5;
        }

        .alternativa-desativada
        {
            opacity: 0.5;
            pointer-events: none;
        }

        .alternativa-incorreta
        {
            opacity: 1;
            pointer-events: none;
            border: 4px solid #ee9164;
        }

        .alternativa-incorreta .custom-control-input:checked~.custom-control-label::before
        {
            background-color: #ee9165 !important;
        }

        .alternativa-correta
        {
            opacity: 1;
            pointer-events: none;
            border: 4px solid #64eaff;
        }

        .alternativa-correta .custom-control-input:checked~.custom-control-label::before
        {
            background-color: #64eaff !important;
        }

        .btn-avaliar
        {
            background: transparent;
            border: 0px;
            color: #ffc107;
        }

        .btn-avaliar.checked::before
        {
            color: #ffc107;
            font-weight: 900;
        }

        .btn-avaliar::before
        {
            content: '\f005';
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            color: #e3e3e3;
        }

        .avaliacao
        {
            direction: rtl;
        }

        .avaliacao > .btn-avaliar:hover:before,
        .avaliacao > .btn-avaliar:hover ~ .btn-avaliar:before {
            content: "\f005";
            font-weight: 900;
            color: #ffc107;
        }

        /* Nav tabs */
        .nav-tabs
        {
            border-bottom: 1px solid #EEEEEE;
        }
        .nav-tabs .nav-item
        {
            margin-bottom: 0px;
        }
        .nav-tabs .nav-link
        {
            border: 0px;
            font-size: 20px;
            border-bottom: 4px solid transparent;
            color: #525870;
            font-weight: bold;
            padding-bottom: 20px;
        }
        .nav-tabs .nav-link.active
        {
            color: #207adc;
            border-bottom: 4px solid #207adc;
        }

        .nav-tabs .nav-link.disabled
        {
            color: #dcdcdc !important;
            cursor: default;
        }

        .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active
        {
            background-color: transparent;
        }

        /* PLYR CSS */
        .plyr--full-ui
        {
            box-shadow: 0px 3px 6px rgba(0,0,0,0.16);
        }

        .minimizado .minimizado-sumir
        {
            display: none !important;
        }

        .minimizado #divInfosAulasConteudos
        {
            text-align: center;
        }

    </style>

    @if(isset($escola))
        <!-- Custom styles for school -->
        <style>

            @if(isset($escola->caracteristicas))

                @if(isset($escola->caracteristicas->cor1) ? $escola->caracteristicas->cor1 != null : false)
                    .bg-primary, .btn-primary
                    {
                        background-color: {{ $escola->caracteristicas->cor1 }} !important;
                    }
                    .nav-tabs .nav-link.active
                    {
                        border-bottom-color: {{ $escola->caracteristicas->cor1 }} !important;
                    }

                    .avatar-img
                    {
                        border: 1px solid {{ $escola->caracteristicas->cor1 }} !important;
                    }

                    <!-- Cursos page escola style -->
                    #listAulas .list-group-item:first-child
                    {
                        border-left: 8px solid {{ $escola->caracteristicas->cor1 }} !important;
                    }

                    .btn-primary
                    {
                        background-color: {{ $escola->caracteristicas->cor1 }} !important;
                    }
                @endif

                {{--  @if($escola->caracteristicas->cor2 != null)
                .bg-primary
                {
                    background-color: {{ $escola->caracteristicas->cor2 }} !important;
                }
                @endif  --}}

                {{--  @if(isset($escola->caracteristicas->cor3) ? $escola->caracteristicas->cor3 != null : false)
                    .btn-primary
                    {
                        background-color: {{ $escola->caracteristicas->cor3 }} !important;
                    }
                @endif  --}}

                @if(isset($escola->caracteristicas->cor4) ? $escola->caracteristicas->cor4 != null : false)
                    .text-primary, p, a, .btn-link, .nav-link
                    {
                        color: {{ $escola->caracteristicas->cor4 }} !important;
                    }
                @endif

            @endif

            @if(isset($escola->css))
                {{ $escola->css }}
            @endif

        </style>
    @endif

</head>

<body id="page-top">

    <div id="divDeitarCelular" class="d-none" style="color:  white;padding:  10px;font-size: 25px;text-align:  -webkit-center;width:  100%;height:  100%;background-color: rgba(0,0,0,0.6);position: fixed;z-index: 999;overflow: hidden;">
        <i class="fas fa-mobile-alt fa-rotate-270" style="margin-top: calc(50vh - 100px);font-size:  300%;"></i>
        <br>
        Por favor, deite o celular para melhor visualização.
        <br>
        <button hidden class="btn mt-3" id="btnTrocarOrientacao" onclick="deitarTela();" style="text-transform: uppercase; font-size: 16px; padding: 3px 10px; width: auto; height: auto;background-color: white;color: #444;">
            deitar por mim
        </button>
    </div>

    @if(Session::has('previewMode'))
        <div class="text-center p-3 text-white" style="background-color: #f3aa3d;position: sticky;left: 0px;top: 0px;z-index: 1;">
            <h3 class="d-inline-block align-middle my-auto">
                Curso não publicado (Preview)
                <a href="{{ route('gestao.curso-conteudo', ['curso_id' => $curso->id]) }}" class="ml-2 text-white small">Voltar</a>
            </h3>
            <button type="button" class="btn btn-light bg-transparent border-0 p-1 float-right mr-5 my-auto align-middle" onclick="$(this).parent().remove();">
                <i class="far fa-times-circle fa-2x text-white"></i>
            </button>
        </div>
    @endif


    <main role="main">

        <div class="container-fluid">

            <div class="row">

                <div class="side-menu col-12 col-sm-4 col-lg-3 p-0 mr-0 text-left" style="background-color: #F9F9F9 !important; min-height: 100vh; transition: 0.3s all ease-in-out;">

                    <div id="divInfosAulasConteudos" class="p-3 bg-primary">

                        <a href="{{ isset($escola) ? route('painel', ['escola_id' => $escola->url]) : route('painel') }}" class="text-white">
                            <i class="fas fa-chevron-left mr-2"></i>
                            <span class="minimizado-sumir">Painel</span>
                        </a>

                        <h5 class="my-4 font-weight-bold text-wrap text-white">
                            <span class="name-label">
                                <p class="font-weight-normal text-white">
                                    AULA
                                    <span class="lblSideMenuNumeroAulaAtual">-</span>
                                     de {{ count($curso->aulas) }}
                                </p>
                                <span id="lblSideMenuAulaAtual" class="text-white">Selecione um conteúdo para começar</span>
                            </span>
                            <div id="divSideMenuIndicadorAula" class="text-center d-none">
                                {{-- <small class="font-weight-bold text-white">AULA</small> --}}
                                <span class="d-block h4 lblSideMenuNumeroAulaAtual font-weight-bold m-0 text-white">-</span>
                                <small class="font-weight-bold text-white">de {{ count($curso->aulas) }}</small>
                            </div>
                        </h5>

                    </div>

                    <div class="p-0" style="max-height: calc(100vh - 192px); overflow-y: auto;">
                        <div class="accordion text-left" id="divAulas">
                            @foreach ($curso->aulas as $aula)
                                <div class="">
                                    <button id="btnAula{{ $aula->id }}" class="btn-aula btn btn-block rounded-0 text-truncate {{ $aula->completa ? 'aula-completa' : 'aula-incompleta' }} py-3 text-secondary font-weight-bold text-left" type="button" data-toggle="collapse" data-target="#divConteudosAula{{ $aula->id }}" aria-expanded="true" aria-controls="collapseOne">
                                        <i class="fas fa-sitemap fa-sm fa-fw mr-2 handle"></i>
                                        <span class="name-label d-inline-block w-75 text-truncate align-middle">{{ ucfirst($aula->titulo) }}</span>
                                        @if($aula->completa)
                                            <i class="fas fa-check-circle fa-fw ml-2 text-success"></i>
                                        @endif
                                    </button>

                                    <div id="divConteudosAula{{ $aula->id }}" class="collapse" aria-labelledby="headingOne" data-parent="#divAulas">
                                        <div class="" style="/*background-color: #40ADB1;*/">
                                            @foreach ($aula->conteudos as $conteudo)

                                                <button id="btnConteudo{{ $conteudo->id }}" class="btn-conteudo btn btn-block text-secondary text-truncate m-0 p-0 pl-3 py-3 {{ $conteudo->conteudo_completo != null ? ($conteudo->correto === false ? 'conteudo-incorreto' : 'conteudo-completo') : 'conteudo-incompleto' }} font-weight-bold text-left text-wrap" type="button" onclick="showConteudo({{ $aula->id }}, {{ $conteudo->id }})">
                                                    <i class="{{ $conteudo->tipo_icon }} fa-lg fa-fw mr-2 handle"></i>
                                                    <span class="name-label d-inline-block w-75 text-truncate align-middle">{{ ucfirst($conteudo->titulo) }}</span>
                                                    @if($conteudo->conteudo_completo != null)
                                                        @if($conteudo->correto === false)
                                                            <i class="fas fa-times-circle fa-fw ml-2 text-danger"></i>
                                                        @else
                                                            <i class="fas fa-check-circle fa-fw ml-2 text-success"></i>
                                                        @endif
                                                    @endif
                                                </button>

                                            @endforeach
                                            @if(count($aula->conteudos) == 0)
                                                <div class="btn btn-block text-white m-0 p-0 pl-3 py-3 font-weight-bold text-left text-truncate" style="background-color: #207adc;">
                                                    <i class="fas fa-times-circle fa-lg fa-fw mr-2 handle"></i>
                                                    <span class="name-label">Esta aula não possui conteúdo</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            @if(count($curso->aulas) == 0)
                                <div class="">
                                    <div class="px-3 rounded-0 py-3 text-white font-weight-bold text-left text-truncate">
                                        <i class="fas fa-circle fa-sm fa-fw mr-2 handle"></i>
                                        <span class="name-label">Este curso não possui nenhuma aula</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>


                </div>


                <div class="main-menu col-12 col-sm-8 col-lg-9 p-0" style="transition: 0.3s all ease-in-out; max-height: 100vh; overflow-y: auto;">

                    <div class="container-fluid">

                        <div class="row">

                            {{-- <div class="col-12 p-2 d-flex" style="background-color: #EDEEF5; border-bottom: 3px solid #ddd;"> --}}
                            <div id="divBarraNavegacaoSuperior" class="col-12 col-sm-8 col-lg-9 p-2 d-flex" style="background-color: #EDEEF5;border-bottom: 3px solid #ddd;position: fixed;z-index: 1;width: 100%;">

                                <button id="btnExpandirMenu" onclick="expandirMenu();" class="btn btn-primary text-uppercase text-center mx-2 p-0 my-auto align-middle d-flex justify-content-center" style="width: 32px; height: 32px; flex: none;">
                                    <i class="fas fa-chevron-left fa-sm text-white"></i>
                                </button>

                                @if(count($curso->aulas) > 0)
                                    @if(count($curso->aulas[0]->conteudos) > 0)
                                        <h3 class="d-inline-block mx-3 my-auto align-middle">
                                            {{-- <span id="lblNumeroAulaAtual" class="d-inline-block mr-1" style="font-size: 16px;">01</span> --}}
                                            {{-- <span id="lblAulaAtual">{{ ucfirst($curso->aulas[0]->titulo) . ' > ' }}</span> --}}
                                            <span id="lblConteudoAtual">{{ ucfirst($curso->aulas[0]->conteudos[0]->titulo) }}</span>
                                        </h3>
                                    @else
                                        <h3 class="d-inline-block mx-3 my-auto align-middle">
                                            {{-- <span id="lblNumeroAulaAtual" class="d-inline-block mr-1" style="font-size: 16px;">-</span> --}}
                                            <span id="lblAulaAtual">Este curso não tem aulas</span>
                                            {{-- <span id="lblConteudoAtual"></span> --}}
                                        </h3>
                                    @endif
                                @else
                                    <h3 class="d-inline-block mx-3 my-auto align-middle">
                                        {{-- <span id="lblNumeroAulaAtual" class="d-inline-block mr-1" style="font-size: 16px;">-</span> --}}
                                        <span id="lblAulaAtual">Este curso não tem aulas</span>
                                        {{-- <span id="lblConteudoAtual"></span> --}}
                                    </h3>
                                @endif

                                <button id="btnProximoConteudo" type="button" onclick="showProximoConteudo();" class="btn btn-primary d-inline-block ml-auto py-2 px-4 rounded-10 text-uppercase font-weight-bold text-truncate">
                                    Próximo conteúdo
                                    <i class="fas fa-chevron-right fa-lg ml-3"></i>
                                </button>

                            </div>

                        </div>

                        <div class="row">

                            <div id="divConteudo" class="col-12 p-0" style="min-height: calc(100vh - 70px); margin-top: 60px;">

                                <div id="divLoading" class="text-center animated fadeIn">
                                    <i class="fas fa-spinner fa-pulse fa-3x text-primary" style="position:  absolute;transform: translate(-50%, -50%);top: 50%;left: 50%;"></i>
                                </div>

                                <div id="divInicio" class="col-12 p-0 {{ count($curso->aulas) > 0 ? '' : 'd-none' }}" hidden style="min-height: calc(100vh - 70px);">
                                    <div class="py-5 text-center" style="color: #525870;font-weight: bold;font-size: 16px;">
                                        <h3>
                                            Seja bem-vindo ao curso {{ ucfirst($curso->titulo) }}
                                            <small class="d-block my-4 px-5 mx-3">
                                                Para começar, seleciona uma aula no menu ao lado. Ou clique em próximo conteúdo na barra superior.
                                            </small>
                                        </h3>
                                    </div>
                                </div>

                                {{-- <div id="divCont" class="p-3 animated fadeIn {{ count($curso->aulas) > 0 ? 'd-none' : '' }}"> --}}
                                <div id="divCont" class="p-3 animated fadeIn">
                                    @if(count($curso->aulas) > 0)
                                        @if(count($curso->aulas[0]->conteudos) > 0)
                                            {{--  {!! $curso->aulas[0]->conteudos[0]->conteudo !!}  --}}
                                        @else
                                            <h3 class="d-block mx-auto my-auto align-middle text-center py-5">
                                                Este curso não possui nenhum conteúdo.
                                            </h3>
                                        @endif
                                    @else
                                        <h3 class="d-block mx-auto my-auto align-middle text-center py-5">
                                            Este curso não possui nenhuma aula.
                                        </h3>
                                    @endif
                                </div>

                                <div id="divAboutConteudo" class="container mt-4 d-none">

                                    <div class="row">

                                        <div class="col-12 p-3">

                                            <div class="text-right">
                                                <div id="divAvaliacaoNegativa" class="d-inline-block">
                                                    <span class="quantidade my-auto d-inline-block mr-1">0</span>
                                                    <button id="btnNegativo" type="button" onclick="enviarAvaliacaoConteudo(0);" class="btn btn-link p-1">
                                                        <i class="far fa-thumbs-down fa-fw fa-lg text-lightgray"></i>
                                                    </button>
                                                </div>

                                                <div id="divAvaliacaoPositiva" class="d-inline-block mr-2">
                                                    <span class="quantidade my-auto d-inline-block mr-1">0</span>
                                                    <button id="btnPositivo" type="button" onclick="enviarAvaliacaoConteudo(1);" class="btn btn-link p-1">
                                                        <i class="far fa-thumbs-up fa-fw fa-lg text-lightgray"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            <hr class="">
                                        </div>

                                        <ul class="nav nav-tabs mx-auto border-0" id="tabConteudo" role="tablist">
                                            <li class="nav-item ml-auto mr-auto mr-md-5 pr-md-5">
                                                <a class="nav-link active" id="instrutor-tab" data-toggle="tab" href="#instrutor" role="tab" aria-controls="instrutor" aria-selected="true">Instrutor</a>
                                            </li>
                                            <li class="nav-item mx-md-5 px-md-5">
                                                <a class="nav-link" id="apoio-tab" data-toggle="tab" href="#apoio" role="tab" aria-controls="apoio" aria-selected="false">Material de apoio</a>
                                            </li>
                                            <li class="nav-item mx-md-5 px-md-5">
                                                <a class="nav-link" id="fontes-tab" data-toggle="tab" href="#fontes" role="tab" aria-controls="fontes" aria-selected="false">Fontes</a>
                                            </li>
                                            <li class="nav-item mr-auto ml-auto ml-md-5 pl-md-5">
                                                <a class="nav-link" id="autores-tab" data-toggle="tab" href="#autores" role="tab" aria-controls="autores" aria-selected="false">Autores</a>
                                            </li>
                                        </ul>

                                        <div class="tab-content py-3 w-100" id="contentConteudo">

                                            <div class="tab-pane fade show active" id="instrutor" role="tabpanel" aria-labelledby="instrutor-tab">

                                                <div class="col-12 p-3">

                                                    @if($curso->user != null)
                                                        <div class="text-left px-4">
                                                            <div class="d-inline-block px-0">
                                                                <div class="avatar-img my-0 d-inline-block" style="width: 54px;height: 54px; background: url({{ route('usuario.perfil.image', [$curso->user->id]) }}); background-size: cover; background-position: 50% 50%; background-repeat: no-repeat;"></div>
                                                            </div>
                                                            <div class="d-inline-block align-middle pl-2">
                                                                <h5>
                                                                    <span class="text-bluegray font-weight-bold">Professor: {{ ucwords($curso->user->name) }} </span>
                                                                </h5>
                                                            </div>
                                                            <p class="text-bluegray font-weight-bold px-1 pt-3" style="font-size 15px;">
                                                                {{ $curso->user->descricao }}
                                                            </p>
                                                        </div>
                                                    @endif

                                                </div>

                                            </div>

                                            <div class="tab-pane fade px-md-5" id="apoio" role="tabpanel" aria-labelledby="apoio-tab">

                                                <div class="col-12 p-3">

                                                    <h5>
                                                        <span class="text-bluegray font-weight-bold">Material de apoio</span>
                                                    </h5>

                                                    <p id="txtApoio" class="text-bluegray font-weight-bold px-1 pt-3" style="font-size: 15px; white-space: pre;">
                                                    </p>

                                                </div>

                                            </div>

                                            <div class="tab-pane fade px-md-5" id="fontes" role="tabpanel" aria-labelledby="fontes-tab">

                                                <div class="col-12 p-3">

                                                    <h5>
                                                        <span class="text-bluegray font-weight-bold">Fontes</span>
                                                    </h5>

                                                    <p id="txtFontes" class="text-bluegray font-weight-bold px-1 pt-3" style="font-size: 15px; white-space: pre;">
                                                    </p>

                                                </div>

                                            </div>

                                            <div class="tab-pane fade px-md-5" id="autores" role="tabpanel" aria-labelledby="autores-tab">

                                                <div class="col-12 p-3">

                                                    <h5>
                                                        <span class="text-bluegray font-weight-bold">Autores</span>
                                                    </h5>

                                                    <p id="txtAutores" class="text-bluegray font-weight-bold px-1 pt-3" style="font-size: 15px; white-space: pre;">
                                                    </p>

                                                </div>

                                            </div>

                                        </div>

                                        <div id="divComentariosPanel" class="col-12 p-0">

                                            <form id="formEnviarComentarioConteudo">
                                                <div class="px-5 py-4 mb-5" style="background-color: #E5E5E5;text-align: -webkit-center;">
                                                    <div class="input-group" style="font-size:  18px;margin-top:  10px;margin-bottom: -50px;max-width:  700px;">
                                                        <input type="text" id="txtComentarioConteudo" class="form-control box-shadow rounded-10 text-secondary mx-auto p-3" name="comentarioConteudo" aria-describedby="helpId" placeholder="Escreva um comentário" style="border-right: 0px;">
                                                        <div class="input-group-append box-shadow rounded-10 text-secondary m-0" style="border: 1px solid #ced4da; border-left: 0px; box-shadow: -3px 3px 6px rgba(0,0,0,0.16);">
                                                            <button type="button" onclick="enviarComentarioConteudo();" class="btn bg-white btn-block" style="color: #798ac4; border-radius: 0px 10px 10px 0px;">
                                                                <i class="fas fa-paper-plane"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>

                                            <div class="p-3">
                                                <p class="mx-3 px-5 font-weight-bold" style="color: #B7B7B7;">
                                                    <i class="fas fa-comment-alt mr-2"></i>
                                                    <span id="lblQtComentariosConteudo">53 Comentários</span>
                                                </p>

                                                <hr>

                                                <div id="divComentarios" class="container">

                                                </div>

                                            </div>
                                        </div>

                                    </div>

                                </div>

                                <div id="divCursoCompleto" class="col-12 p-0 d-none" style="min-height: calc(100vh - 70px);">
                                    <div class="py-5 text-center" style="color: #525870;font-weight: bold;font-size: 16px;">
                                        <h3 class="my-4">
                                            <i class="fas fa-trophy fa-fw fa-3x mb-3 text-primary"></i>
                                            <br>
                                            Parabéns, você concluiu o curso {{ ucfirst($curso->titulo) }}
                                        </h3>

                                        <hr>

                                        <div id="divAvaliarCurso" class="text-center mx-auto {{ $avaliouCurso ? 'd-none' : '' }}" style="width: auto; max-width: 400px;">
                                            <h3>
                                                <small>
                                                    Avalie o curso e deixe um comentário:
                                                </small>
                                            </h3>
                                            <div class="avaliacao my-3">
                                                <button type="button" onclick="selecionarAvaliacaoCurso(5);" class="btn btn-avaliar border-none p-1 mr-1">
                                                </button>
                                                <button type="button" onclick="selecionarAvaliacaoCurso(4);" class="btn btn-avaliar border-none p-1 mr-1">
                                                </button>
                                                <button type="button" onclick="selecionarAvaliacaoCurso(3);" class="btn btn-avaliar border-none p-1 mr-1">
                                                </button>
                                                <button type="button" onclick="selecionarAvaliacaoCurso(2);" class="btn btn-avaliar border-none p-1 mr-1">
                                                </button>
                                                <button type="button" onclick="selecionarAvaliacaoCurso(1);" class="btn btn-avaliar border-none p-1 mr-1">
                                                </button>
                                            </div>
                                            <div class="form-group mb-3">
                                                <textarea class="form-control" name="comentario_avalicao" id="comentario_avalicao" rows="3" placeholder="Escreva aqui seu comentário sobre o curso." required></textarea>
                                            </div>
                                            <button onclick="enviarAvaliacaoCurso();" class="btn btn-primary text-center mx-3 my-auto align-middle rounded-10">
                                                Enviar avaliação do curso
                                            </button>
                                        </div>
                                        <div id="divAvaliouCurso" class="text-center my-3 mx-auto {{ !$avaliouCurso ? 'd-none' : '' }}" style="width: auto; max-width: 400px;">
                                            <h3>
                                                <small>
                                                    Obrigado por avaliar o curso!
                                                </small>
                                            </h3>
                                        </div>

                                        <hr>

                                        <div id="divAvaliarProfessor" class="text-center mt-3 mx-auto {{ $avaliouProfessor ? 'd-none' : '' }}" style="width: auto; max-width: 400px;">
                                            <h3>
                                                <small>
                                                    Avalie o instrutor e deixe um comentário:
                                                </small>
                                            </h3>
                                            <div class="avaliacao my-3">
                                                <button type="button" onclick="selecionarAvaliacaoProfessor(5);" class="btn btn-avaliar border-none p-1 mr-1">
                                                </button>
                                                <button type="button" onclick="selecionarAvaliacaoProfessor(4);" class="btn btn-avaliar border-none p-1 mr-1">
                                                </button>
                                                <button type="button" onclick="selecionarAvaliacaoProfessor(3);" class="btn btn-avaliar border-none p-1 mr-1">
                                                </button>
                                                <button type="button" onclick="selecionarAvaliacaoProfessor(2);" class="btn btn-avaliar border-none p-1 mr-1">
                                                </button>
                                                <button type="button" onclick="selecionarAvaliacaoProfessor(1);" class="btn btn-avaliar border-none p-1 mr-1">
                                                </button>
                                            </div>
                                            <div class="form-group mb-3">
                                                <textarea class="form-control" name="comentario_avalicao_professor" id="comentario_avalicao_professor" rows="3" placeholder="Escreva aqui seu comentário sobre o curso." required></textarea>
                                            </div>
                                            <button onclick="enviarAvaliacaoProfessor();" class="btn btn-primary text-center mx-3 my-auto align-middle rounded-10">
                                                Enviar avaliação do professor
                                            </button>
                                        </div>
                                        <div id="divAvaliouProfessor" class="text-center my-3 mx-auto {{ !$avaliouProfessor ? 'd-none' : '' }}" style="width: auto; max-width: 400px;">
                                            <h3>
                                                <small>
                                                    Obrigado por avaliar o professor!
                                                </small>
                                            </h3>
                                        </div>

                                        <hr>

                                        <div id="divAvaliarEscola" class="text-center mx-auto {{ $avaliouEscola ? 'd-none' : '' }}" style="width: auto; max-width: 400px;">
                                            <h3>
                                                <small>
                                                    Avalie a escola e deixe um comentário:
                                                </small>
                                            </h3>
                                            <div class="avaliacao my-3">
                                                <button type="button" onclick="selecionarAvaliacaoEscola(5);" class="btn btn-avaliar border-none p-1 mr-1">
                                                </button>
                                                <button type="button" onclick="selecionarAvaliacaoEscola(4);" class="btn btn-avaliar border-none p-1 mr-1">
                                                </button>
                                                <button type="button" onclick="selecionarAvaliacaoEscola(3);" class="btn btn-avaliar border-none p-1 mr-1">
                                                </button>
                                                <button type="button" onclick="selecionarAvaliacaoEscola(2);" class="btn btn-avaliar border-none p-1 mr-1">
                                                </button>
                                                <button type="button" onclick="selecionarAvaliacaoEscola(1);" class="btn btn-avaliar border-none p-1 mr-1">
                                                </button>
                                            </div>
                                            <div class="form-group mb-3">
                                                <textarea class="form-control" name="comentario_avalicao" id="comentario_avalicao" rows="3" placeholder="Escreva aqui seu comentário sobre a escola." required></textarea>
                                            </div>
                                            <button onclick="enviarAvaliacaoEscola();" class="btn btn-primary text-center mx-3 my-auto align-middle rounded-10">
                                                Enviar avaliação da escola
                                            </button>
                                        </div>
                                        <div id="divAvaliouEscola" class="text-center my-3 mx-auto {{ !$avaliouEscola ? 'd-none' : '' }}" style="width: auto; max-width: 400px;">
                                            <h3>
                                                <small>
                                                    Obrigado por avaliar a escola!
                                                </small>
                                            </h3>
                                        </div>
                                        <a href="{{ isset($escola) ? route('painel.certificado', ['escola_id' => $escola->url, 'idCurso' => $curso->id]) : route('painel.certificado', ['idCurso' => $curso->id]) }}" class="btn btn-primary text-center mx-3 my-3 align-middle text-white rounded-10">
                                            Ver meu certificado
                                        </a>
                                        <iframe class="my-3" src="{{ route('curso.certificado', ['idCurso' => $curso->id]) }}" style="overflow: hidden;border: none;width: 50vw;height: 28vw;" hidden>
                                        </iframe>
                                        <div class="row mx-auto py-5">
                                            <div class="separator-bar bar-left ml-auto" style="width: calc(40% - (96px / 2));"></div>
                                            <a href="{{ isset($escola) ? route('painel', ['escola_id' => $escola->url]) : route('painel') }}" class="font-weight-bold">Meu Painel</a>
                                            <div class="separator-bar bar-right mr-auto" style="width: calc(40% - (96px / 2));"></div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>

    </main>

    <!-- Bootstrap core JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

    {!! \App\Services\GamificacaoService::showLevelUpNotification(); !!}

    <!-- Jquery UI -->
    <script src="{{ env('APP_URL') }}/assets/js/jquery-ui.min.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

    <!-- Sweet Alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- Moment JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js" integrity="sha256-4iQZ6BVL4qNKlQ27TExEhBN1HFPvAvAMbFavKKosSWQ=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/locale/pt-br.js" integrity="sha256-aIToY7VLU5x+toAJcyINV0WEogFBCIVeeWhyUbCaYiQ=" crossorigin="anonymous"></scrip


    <!-- Jquery Easing -->
    <script src="{{ env('APP_URL') }}/assets/js/jquery.easing.compatibility.min.js"></script>

    <!-- Custom Scrolling Nav -->
    <script src="{{ env('APP_URL') }}/assets/js/scrolling-nav.js"></script>

    <!-- Custom Smooth Scrolling -->
    <script src="{{ env('APP_URL') }}/assets/js/smooth-scrolling.js"></script>

    <!-- Declare App URL -->
    <script>var appurl = '{{ env("APP_URL") }}';</script>

    <!-- Custom JavaScript -->
    <script src="{{ env('APP_URL') }}/assets/js/main.js"></script>

    <!-- VideoJS -->
    <script src="https://vjs.zencdn.net/7.1.0/video.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/videojs-contrib-hls/5.14.1/videojs-contrib-hls.min.js"></script>


    <!-- Plyr Video Player -->
    <script src="https://cdn.plyr.io/3.5.2/plyr.js"></script>

    <script>

        $( document ).ready(function(){

            @if($errors->any())
            {{-- @if(session()->has('error')) --}}
                swal("Ops!", '{{ $errors->first() }}', 'error');
            @elseif(session()->has('message'))
                swal("Yeah!", '{{ session()->get('message') }}', 'success');
            @endif

            $('[data-toggle="tooltip"]').tooltip();

            @if(isset($ultimaAula) ? (($ultimaAula > 1 && $ultimoConteudo >= 1) || ($ultimaAula == 1 && $ultimoConteudo > 1)) : false && $curso->completo == false)
                showConteudo({{ $ultimaAula }}, {{ $ultimoConteudo }});
            @else
                showProximoConteudo();
            @endif

            $("#formEnviarComentarioConteudo").submit(function( event ) {
                enviarComentarioConteudo();
                event.preventDefault();
            });

            if(window.innerHeight > window.innerWidth)
            {
                $("#divDeitarCelular").removeClass('d-none');
            }
            else
            {
                $("#divDeitarCelular").addClass('d-none');
            }
        });

        window.onresize = function(event) {

            if(window.innerHeight > window.innerWidth)
            {
                $("#divDeitarCelular").removeClass('d-none');
            }
            else
            {
                $("#divDeitarCelular").addClass('d-none');
            }

        };

        function deitarTela()
        {
            screen.orientation.lock("landscape-primary").catch((res) =>
            {
                $("#btnTrocarOrientacao").html("<span>Não deu :/</span>");
                $("#btnTrocarOrientacao").attr("disabled", "");
            });
        }


        function expandirMenu()
        {
            if($(".side-menu").hasClass('col-1'))
            {
                $(".side-menu").removeClass('minimizado');

                $(".side-menu").removeClass('col-1');
                $(".side-menu").addClass('col-12 col-sm-4 col-lg-3');

                $(".side-menu button").removeClass('text-center');

                $(".side-menu .name-label").removeClass('d-none');
                $(".side-menu .name-label").addClass('d-inline-block');

                $("#divSideMenuIndicadorAula").addClass('d-none');

                $("#btnExpandirMenu i").removeClass('fa-chevron-right');
                $("#btnExpandirMenu i").addClass('fa-chevron-left');

                $(".main-menu").addClass('col-12 col-sm-8 col-lg-9');
                $(".main-menu").removeClass('col-11');

                $("#divBarraNavegacaoSuperior").addClass('col-12 col-sm-8 col-lg-9');
                $("#divBarraNavegacaoSuperior").removeClass('col-11');
            }
            else
            {
                $(".side-menu").addClass('minimizado');

                $(".side-menu").removeClass('col-12 col-sm-4 col-lg-3');
                $(".side-menu").addClass('col-1');

                $(".side-menu button").addClass('text-center');

                $(".side-menu .name-label").addClass('d-none');
                $(".side-menu .name-label").removeClass('d-inline-block');

                $("#divSideMenuIndicadorAula").removeClass('d-none');

                $("#btnExpandirMenu i").removeClass('fa-chevron-left');
                $("#btnExpandirMenu i").addClass('fa-chevron-right');

                $(".main-menu").removeClass('col-12 col-sm-8 col-lg-9');
                $(".main-menu").addClass('col-11');

                $("#divBarraNavegacaoSuperior").removeClass('col-12 col-sm-8 col-lg-9');
                $("#divBarraNavegacaoSuperior").addClass('col-11');

            }


        }

        var idAulas = null;

        var idConteudos = null;

        var aulaAtual = 0;

        var conteudoAtual = 0;

        var tipoConteudoAtual = 0;

        var alternativaAtual = 0;

        function showConteudo(idAula, idConteudo)
        {
            $("#divConteudo #divLoading").removeClass('d-none');
            $("#divConteudo #divInicio").addClass('d-none');
            $("#divConteudo #divCont").addClass('d-none');
            $("#divConteudo #divAboutConteudo").addClass('d-none');

            $("#btnProximoConteudo").addClass("disabled")

            $('#tabConteudo a[href="#instrutor"]').tab('show');

            $.ajax({
                url: '{{ env('APP_LOCAL') }}/play/{{ $curso->id }}/conteudo/' + idAula + '/' + idConteudo,
                type: 'get',
                dataType: 'json',
                success: function( _response )
                {
                    console.log( _response );

                    if(_response.success)
                    {
                        _response.aula = JSON.parse(_response.aula);

                        aulaAtual = _response.aula.id;
                        conteudoAtual = _response.aula.conteudo.id;
                        tipoConteudoAtual = _response.aula.conteudo.tipo;

                        carregarComentarios(_response.aula.conteudo.comentarios);

                        $("#divAboutConteudo #divAvaliacaoPositiva .quantidade").text(_response.aula.conteudo.qtAvaliacoesPositivas);
                        $("#divAboutConteudo #divAvaliacaoNegativa .quantidade").text(_response.aula.conteudo.qtAvaliacoesNegativas);

                        if(_response.aula.conteudo.minhaAvaliacao != null)
                        {
                            if(_response.aula.conteudo.minhaAvaliacao.avaliacao == 1)
                            {
                                $("#divAboutConteudo #divAvaliacaoPositiva button i").addClass('text-success');
                                $("#divAboutConteudo #divAvaliacaoNegativa button i").removeClass('text-danger');
                            }
                            else
                            {
                                $("#divAboutConteudo #divAvaliacaoPositiva button i").removeClass('text-success');
                                $("#divAboutConteudo #divAvaliacaoNegativa button i").addClass('text-danger');
                            }
                        }
                        else
                        {
                            $("#divAboutConteudo #divAvaliacaoPositiva button i").removeClass('text-success');
                            $("#divAboutConteudo #divAvaliacaoNegativa button i").removeClass('text-danger');
                        }

                        //$("#divAulas .collapse:not(#divConteudosAula" + _response.aula.id + ")").collapse('hide');
                        $("#divAulas #divConteudosAula" + _response.aula.id).collapse('show');

                        $("#divAulas .btn-aula").removeClass("aula-ativa");

                        $("#divAulas .btn-conteudo").removeClass('conteudo-ativo');

                        $("#divAulas #btnAula" + _response.aula.id + ".btn-aula").addClass('aula-ativa');

                        $("#divAulas #divConteudosAula" + _response.aula.id + " #btnConteudo" + _response.aula.conteudo.id + ".btn-conteudo").addClass('conteudo-ativo');

                        $(".lblSideMenuNumeroAulaAtual").text(aulaAtual);
                        $("#lblSideMenuAulaAtual").text(_response.aula.titulo.charAt(0).toUpperCase() + _response.aula.titulo.slice(1));

                        //$("#lblNumeroAulaAtual").text(aulaAtual);
                        //$("#lblAulaAtual").text(_response.aula.titulo.charAt(0).toUpperCase() + _response.aula.titulo.slice(1) + " > ");
                        $("#lblNumeroAulaAtual").text('');
                        $("#lblAulaAtual").text('');
                        $("#lblConteudoAtual").text(_response.aula.conteudo.titulo.charAt(0).toUpperCase() + _response.aula.conteudo.titulo.slice(1));

                        $("#divConteudo #divCont").html(_response.aula.conteudo.conteudo);

                        if(tipoConteudoAtual == 5)
                        {
                            carregarMensagensTransmissao();
                        }
                        else if(tipoConteudoAtual == 9)
                        {
                            respostas = [];
                        }

                        if(_response.aula.conteudo.apoio != null && _response.aula.conteudo.fonte != "")
                        {
                            $("#txtApoio").html(_response.aula.conteudo.apoio);
                            $('#tabConteudo a[href="#apoio"]').removeClass('disabled');
                        }
                        else
                        {
                            $('#tabConteudo a[href="#apoio"]').addClass('disabled');
                        }

                        if(_response.aula.conteudo.fonte != null && _response.aula.conteudo.fonte != "")
                        {
                            $("#txtFontes").html(_response.aula.conteudo.fonte);
                            $('#tabConteudo a[href="#fontes"]').removeClass('disabled');
                        }
                        else
                        {
                            $('#tabConteudo a[href="#fontes"]').addClass('disabled');
                        }

                        if(_response.aula.conteudo.autores != null && _response.aula.conteudo.autores != "")
                        {
                            $("#txtAutores").html(_response.aula.conteudo.autores);
                            $('#tabConteudo a[href="#autores"]').removeClass('disabled');
                        }
                        else
                        {
                            $('#tabConteudo a[href="#autores"]').addClass('disabled');
                        }
                    }
                    else
                    {
                        swal("Ops!", _response.error, "error");
                    }

                    $("#divConteudo #divLoading").addClass('d-none');
                    $("#divConteudo #divCont").removeClass('d-none');
                    $("#divConteudo #divAboutConteudo").removeClass('d-none');
                    $("#btnProximoConteudo").removeClass("disabled");
                    $("#divConteudo #divCursoCompleto").addClass('d-none');

                    if(_response.aula != null)
                    {
                        if(_response.aula.conteudo.tipo == 7 || _response.aula.conteudo.tipo == 8)
                        {
                            $("#btnProximoConteudo").addClass("disabled");

                            if(_response.aula.conteudo.correto != null ? _response.aula.conteudo.correto : false)
                            {
                                $("#btnProximoConteudo").removeClass("disabled");
                            }
                        }
                    }

                },
                error: function( _response )
                {
                    console.log( _response );
                }
            });
        }

        function showProximoConteudo()
        {
            if($("#btnProximoConteudo").hasClass("disabled"))
                return;

            $("#divConteudo #divLoading").removeClass('d-none');
            $("#divConteudo #divInicio").addClass('d-none');
            $("#divConteudo #divCont").addClass('d-none');
            $("#divConteudo #divAboutConteudo").addClass('d-none');

            $("#btnProximoConteudo").addClass("disabled");

            $('#tabConteudo a[href="#instrutor"]').tab('show');

            var urlProximoConteudo = '{{ env('APP_LOCAL') }}/play/{{ $curso->id }}/conteudo/' + aulaAtual + '/' + conteudoAtual + '/proximo';

            console.log(urlProximoConteudo);

            $.ajax({
                url: urlProximoConteudo,
                type: 'get',
                dataType: 'json',
                success: function( _response )
                {
                    console.log( _response );

                    if(_response.success)
                    {
                        _response.aula = JSON.parse(_response.aula);

                        $("#divAulas #divConteudosAula" + aulaAtual + " #btnConteudo" + conteudoAtual + ".btn-conteudo").removeClass('conteudo-incompleto');
                        $("#divAulas #divConteudosAula" + aulaAtual + " #btnConteudo" + conteudoAtual + ".btn-conteudo").addClass('conteudo-completo');

                        if($("#divAulas #divConteudosAula" + aulaAtual + " #btnConteudo" + conteudoAtual + ".btn-conteudo .fa-check-circle").length == 0)
                        {
                            $("#divAulas #divConteudosAula" + aulaAtual + " #btnConteudo" + conteudoAtual + ".btn-conteudo").append('<i class="fas fa-check-circle fa-fw ml-2 text-success"></i>');
                        }

                        aulaAtual = _response.aula.id;
                        conteudoAtual = _response.aula.conteudo.id;
                        tipoConteudoAtual = _response.aula.conteudo.tipo;

                        carregarComentarios(_response.aula.conteudo.comentarios);

                        $("#divAbout #btnPositivo .quantidade").text(_response.aula.conteudo.qtAvaliacoesPositivas)
                        $("#divAbout #btnNegativo .quantidade").text(_response.aula.conteudo.qtAvaliacoesNegativas)

                        $("#divAulas #divConteudosAula" + _response.aula.id).collapse('show');

                        $("#divAulas .btn-aula").removeClass('aula-ativa');

                        $("#divAulas .btn-conteudo").removeClass('conteudo-ativo');

                        $("#divAulas #btnAula" + _response.aula.id + ".btn-aula").addClass('aula-ativa');

                        $("#divAulas #divConteudosAula" + _response.aula.id + " #btnConteudo" + _response.aula.conteudo.id + ".btn-conteudo").addClass('conteudo-ativo');

                        $(".lblSideMenuNumeroAulaAtual").text(aulaAtual);
                        $("#lblSideMenuAulaAtual").text(_response.aula.titulo.charAt(0).toUpperCase() + _response.aula.titulo.slice(1));

                        $("#lblNumeroAulaAtual").text(aulaAtual);
                        $("#lblAulaAtual").text(_response.aula.titulo.charAt(0).toUpperCase() + _response.aula.titulo.slice(1) + " > ");
                        $("#lblConteudoAtual").text(_response.aula.conteudo.titulo.charAt(0).toUpperCase() + _response.aula.conteudo.titulo.slice(1));

                        $("#divConteudo #divCont").html(_response.aula.conteudo.conteudo);

                        if(tipoConteudoAtual == 5)
                        {
                            carregarMensagensTransmissao();
                        }
                        else if(tipoConteudoAtual == 9)
                        {
                            respostas = [];
                        }

                        if(_response.aula.conteudo.apoio != null && _response.aula.conteudo.apoio != "")
                        {
                            $("#txtApoio").text(_response.aula.conteudo.apoio);
                            $('#tabConteudo a[href="#apoio"]').removeClass('disabled');
                        }
                        else
                        {
                            $('#tabConteudo a[href="#apoio"]').addClass('disabled');
                        }

                        if(_response.aula.conteudo.fonte != null && _response.aula.conteudo.fonte != "")
                        {
                            $("#txtFontes").text(_response.aula.conteudo.fonte);
                            $('#tabConteudo a[href="#fontes"]').removeClass('disabled');
                        }
                        else
                        {
                            $('#tabConteudo a[href="#fontes"]').addClass('disabled');
                        }

                        if(_response.aula.conteudo.autores != null)
                        {
                            $("#txtAutores").text(_response.aula.conteudo.autores);
                            $('#tabConteudo a[href="#autores"]').removeClass('disabled');
                        }
                        else
                        {
                            $('#tabConteudo a[href="#autores"]').addClass('disabled');
                        }

                    }
                    else
                    {
                        if(_response.cursoCompleto == null)
                        {
                            swal("Ops!", _response.error, "error");
                        }
                    }

                    if(_response.cursoCompleto != null)
                    {
                        $("#divConteudo #divLoading").addClass('d-none');
                        $("#divConteudo #divInicio").addClass('d-none');
                        $("#divConteudo #divCont").addClass('d-none');
                        $("#divConteudo #divAboutConteudo").addClass('d-none');
                        $("#btnProximoConteudo").addClass("disabled");

                        $("#divConteudo #divCursoCompleto").removeClass('d-none');
                    }
                    else
                    {
                        $("#divConteudo #divLoading").addClass('d-none');
                        $("#divConteudo #divCursoCompleto").addClass('d-none');
                        $("#divConteudo #divCont").removeClass('d-none');
                        $("#divConteudo #divAboutConteudo").removeClass('d-none');
                        $("#btnProximoConteudo").removeClass("disabled");
                    }

                    if(_response.aula != null)
                    {
                        if(_response.aula.conteudo.tipo == 7 || _response.aula.conteudo.tipo == 8)
                        {
                            $("#btnProximoConteudo").addClass("disabled");

                            if(_response.aula.conteudo.correto != null ? _response.aula.conteudo.correto : false)
                            {
                                $("#btnProximoConteudo").removeClass("disabled");
                            }
                        }
                    }


                },
                error: function( _response )
                {
                    console.log( _response );
                }
            });
        }

        function selecionarAlternativa(alternativa)
        {
            {{--  console.log("Selecionou alternativa: " + alternativa);  --}}

            alternativaAtual = alternativa.replace("alternativa", '');
        }

        function confirmarResposta()
        {
            if(tipoConteudoAtual == 7 && ($("#txtRespostaDissertativa").val() == null || $("#txtRespostaDissertativa").val() == ''))
                return;
            else if(tipoConteudoAtual == 8 && alternativaAtual == 0)
                return;

            if(tipoConteudoAtual == 7)
                var formData = { '_token' : '{{ csrf_token() }}', 'resposta': $("#txtRespostaDissertativa").val() };
            else if(tipoConteudoAtual == 8)
                var formData = { '_token' : '{{ csrf_token() }}', 'alternativa': alternativaAtual };
            else
                return;

            $.ajax({
                url: '{{ env('APP_LOCAL') }}/play/{{ $curso->id }}/' + aulaAtual + '/' + conteudoAtual + "/enviar/resposta",
                type: 'post',
                dataType: 'json',
                data: formData,
                success: function( _response )
                {
                    console.log( _response );

                    if(tipoConteudoAtual == 7)
                    {
                        $("#divCont #divAguardandoCorrecao").removeClass('d-none');
                        $("#btnProximoConteudo").removeClass('disabled');
                        $("#divCont #btnConfirmarResposta").addClass('d-none');
                        $("#divCont #btnTentarNovamente").addClass('d-none');
                        $("#txtRespostaDissertativa").attr('readonly', 'true');
                    }
                    else
                    {
                        if(_response.correta)
                        {
                            $("#divCont #boxAlternativa" + alternativaAtual).addClass("alternativa-correta");
                            $("#divCont .box-alternativa:not(#boxAlternativa" + alternativaAtual + ")").addClass("alternativa-desativada");
                            $("#divCont #divRespostaCorreta").removeClass('d-none');

                            $("#btnProximoConteudo").removeClass('disabled');
                            $("#divCont #btnConfirmarResposta").addClass('d-none');
                            $("#divCont #btnTentarNovamente").addClass('d-none');

                            $("#divAulas #divConteudosAula" + aulaAtual + " #btnConteudo" + conteudoAtual + ".btn-conteudo").removeClass('conteudo-incorreto');
                            $("#divAulas #divConteudosAula" + aulaAtual + " #btnConteudo" + conteudoAtual + ".btn-conteudo").addClass('conteudo-completo');
                        }
                        else
                        {
                            $("#divCont #boxAlternativa" + alternativaAtual).addClass("alternativa-incorreta");
                            $("#divCont .box-alternativa:not(#boxAlternativa" + alternativaAtual + ")").addClass("alternativa-desativada");
                            $("#divCont #divRespostaIncorreta").removeClass('d-none');
                            $("#divCont #btnConfirmarResposta").addClass('d-none');
                            $("#divCont #btnTentarNovamente").removeClass('d-none');

                            $("#divAulas #divConteudosAula" + aulaAtual + " #btnConteudo" + conteudoAtual + ".btn-conteudo").addClass('conteudo-incorreto');
                        }
                    }
                },
                error: function( _response )
                {
                    console.log( _response );
                }
            });
        }

        function tentarNovamente()
        {
            alternativaAtual = 0;

            $("#divCont #divAguardandoCorrecao").addClass('d-none');
            $("#divCont #divRespostaCorreta").addClass('d-none');
            $("#divCont #divRespostaIncorreta").addClass('d-none');

            $("#divCont .box-alternativa").removeClass("alternativa-correta");
            $("#divCont .box-alternativa").removeClass("alternativa-incorreta");
            $("#divCont .box-alternativa").removeClass("alternativa-desativada");

            $("#divCont #txtRespostaDissertativa").removeAttr("readonly")
            $("#divCont #txtRespostaDissertativa").val("");

            $("#divCont input").prop('checked', false);

            $("#divCont #btnConfirmarResposta").removeClass('d-none');
            $("#divCont #formEnviarEntregavel").removeClass('d-none');

            if(tipoConteudoAtual == 10)
            {
                $("#divCont #boxResposta").removeClass('d-inline-block');
                $("#divCont #boxResposta").addClass('d-none');
            }

            $("#divCont #btnTentarNovamente").addClass('d-none');
        }

        var respostas = [];

        function confirmarRespostaProva()
        {
            var perguntaAtual = $("#divCont #divPerguntas > div:not(.d-none)").attr("id").replace("divPergunta", "");
            var totalPerguntas = $("#divCont #divPerguntas > div").length;

            if($("#divCont #divPerguntas #divPergunta" + perguntaAtual).data("tipo") == 1)
            {
                if($("#divCont #divPerguntas #divPergunta" + perguntaAtual).find("#txtRespostaDissertativa").val() != "")
                {
                    //respostas.push($("#divCont #divPerguntas #divPergunta" + perguntaAtual).find("#txtRespostaDissertativa").val());
                    respostas[perguntaAtual - 1] = $("#divCont #divPerguntas #divPergunta" + perguntaAtual).find("#txtRespostaDissertativa").val();
                }
                else
                {
                    return;
                }
            }
            else
            {
                if($("#divCont #divPerguntas #divPergunta" + perguntaAtual).find("#alternativa" + perguntaAtual + "-1").prop("checked"))
                {
                    respostas[perguntaAtual - 1] = 1;
                }
                else if($("#divCont #divPerguntas #divPergunta" + perguntaAtual).find("#alternativa" + perguntaAtual + "-2").prop("checked"))
                {
                    respostas[perguntaAtual - 1] = 2;
                }
                else if($("#divCont #divPerguntas #divPergunta" + perguntaAtual).find("#alternativa" + perguntaAtual + "-3").prop("checked"))
                {
                    respostas[perguntaAtual - 1] = 3;
                }
                else
                {
                    return;
                }
            }

            if(perguntaAtual == totalPerguntas)
            {
                console.log("enviar respostas", respostas);

                var formData = { '_token' : '{{ csrf_token() }}', 'resposta': JSON.stringify(respostas) };

                $.ajax({
                    url: '{{ env('APP_LOCAL') }}/play/{{ $curso->id }}/' + aulaAtual + '/' + conteudoAtual + "/enviar/resposta",
                    type: 'post',
                    dataType: 'json',
                    data: formData,
                    success: function( _response )
                    {
                        console.log( _response );

                        $("#divCont #divAguardandoCorrecao").removeClass('d-none');
                        $("#btnProximoConteudo").removeClass('disabled');
                        $("#divCont #btnConfirmarResposta").addClass('d-none');
                        $("#divCont #btnTentarNovamente").addClass('d-none');
                        $("#divCont #divPerguntas textarea").attr('readonly', 'true');
                        $("#divCont #divPerguntas .box-alternativa").addClass("alternativa-desativada");

                    },
                    error: function( _response )
                    {
                        console.log( _response );
                    }
                });
            }
            else
            {
                $("#divCont #divPerguntas #divPergunta" + perguntaAtual).addClass("d-none");
                $("#divCont #divPerguntas #divPergunta" + (parseInt(perguntaAtual) + 1)).removeClass("d-none");

                $("#divCont #cmbQuestaoAtual").val((parseInt(perguntaAtual) + 1));
            }
        }

        function mudouPerguntaProvaAtual()
        {
            $("#divCont #divPerguntas > div").addClass("d-none");
            $("#divCont #divPerguntas #divPergunta" + $("#divCont #cmbQuestaoAtual").val()).removeClass("d-none");
        }

        function anexouArquivo(input)
        {
            if(input.value != null && input.value != "")
            {
                $("#lblNomeArquivo").text(input.value.split(/(\\|\/)/g).pop());
            }
            else
            {
                $("#lblNomeArquivo").text("Anexar arquivo");
            }
        }

        function carregarComentarios(comentarios)
        {
            if(comentarios != null)
            {
                if(comentarios.length == 1)
                {
                    $('#lblQtComentariosConteudo').text('1 comentário');
                }
                else
                {
                    $('#lblQtComentariosConteudo').text( comentarios.length + ' comentários');
                }

                $("#divComentarios").html("");

                comentarios.forEach(function(comentario, index){

                    console.log(comentario);

                    if(comentario.user_id == '{{ $curso->user_id }}')
                    {
                        var div = `<div id="divComentario${comentario.id}" class="p-3 row" style="background-color: #E4FBFF;">
                            <div class="col-auto align-top mr-3" style="background-image: url('{{ env('APP_LOCAL') }}/usuarios/${comentario.user_id}/perfil/image'); width: 66px;height: 66px;background-size: cover;background-position:  50% 50%;background-repeat: no-repeat;border-radius: 100px;">
                            </div>
                            <div class="col align-top">
                                <span class="d-block" style="color: #B7B7B7;">
                                    ${comentario.user.name}
                                    <i class="fas fa-check-circle ml-2" style="color: #798AC4;"></i>
                                </span>
                                <span class="d-block text-bluegray" style="">
                                    ${comentario.comentario}
                                </span>
                            </div>
                            <div class="col-auto text-right align-top">
                                <i class="fas fa-thumbtack fa-fw fa-lg align-middle" style="color: #798AC4;"></i>
                                ${ '{{ Auth::user()->id }}' == comentario.user_id || '{{ Auth::user()->id }}' == '{{ $curso->user_id }}' ? '<button type="button" onclick="excluirComentarioConteudo(' + comentario.id + ');" class="btn btn-light align-middle ml-2 p-1"><i class="fas fa-trash fa-fw text-danger" style="color: #798AC4;"></i></button>' : '' }
                                <span class="d-block text-lighter">
                                    ${comentario.created_at}
                                </span>
                            </div>
                        </div>`;
                    }
                    else
                    {
                        var div = `<div id="divComentario${comentario.id}" class="p-3 row">
                            <div class="col-auto align-top mr-3" style="background-image: url('{{ env('APP_LOCAL') }}/usuarios/${comentario.user_id}/perfil/image'); width: 66px;height: 66px;background-size: cover;background-position:  50% 50%;background-repeat: no-repeat;border-radius: 100px;">
                            </div>
                            <div class="col align-top">
                                <span class="d-block" style="color: #B7B7B7;">
                                    ${comentario.user.name}
                                </span>
                                <span class="d-block text-bluegray" style="">
                                    ${comentario.comentario}
                                </span>
                            </div>
                            <div class="col-auto text-right align-top">
                                ${ '{{ Auth::user()->id }}' == comentario.user_id || '{{ Auth::user()->id }}' == '{{ $curso->user_id }}' ? '<button type="button" onclick="excluirComentarioConteudo(' + comentario.id + ');" class="btn btn-light align-middle ml-2 p-1"><i class="fas fa-trash fa-fw text-danger" style="color: #798AC4;"></i></button>' : '' }
                                <span class="d-block text-lighter">
                                    ${moment(comentario.created_at).format("DD/MM/YYYY [às] HH:mm")}
                                </span>
                            </div>
                        </div>`;
                    }


                    $("#divComentarios").append(div);

                });

            }
            else
            {
                $('#lblQtComentariosConteudo').text('0 comentários');
            }
        }

        function enviarComentarioConteudo()
        {
            var comentario = $("#txtComentarioConteudo").val();

            if(comentario == null || comentario == "")
            {
                $("#txtComentarioConteudo").focus();

                return;
            }

            var formData = { '_token' : '{{ csrf_token() }}', 'comentario': comentario };

            $.ajax({
                url: '{{ env('APP_LOCAL') }}/play/{{ $curso->id }}/' + aulaAtual + '/' + conteudoAtual + "/comentario/enviar",
                type: 'post',
                dataType: 'json',
                data: formData,
                success: function( _response )
                {
                    console.log( _response );

                    $("#txtComentarioConteudo").val("");

                    if(_response.comentario != null)
                    {
                        var comentario = _response.comentario;

                        if(comentario.user_id == '{{ $curso->user_id }}')
                        {
                            var div = `<div id="divComentario${comentario.id}" class="p-3 row" style="background-color: #E4FBFF;">
                                <div class="col-auto align-top mr-3" style="background-image: url('{{ env('APP_LOCAL') }}/usuarios/${comentario.user_id}/perfil/image'); width: 66px;height: 66px;background-size: cover;background-position:  50% 50%;background-repeat: no-repeat;border-radius: 100px;">
                                </div>
                                <div class="col align-top">
                                    <span class="d-block" style="color: #B7B7B7;">
                                        ${comentario.user.name}
                                        <i class="fas fa-check-circle ml-2" style="color: #798AC4;"></i>
                                    </span>
                                    <span class="d-block text-bluegray" style="">
                                        ${comentario.comentario}
                                    </span>
                                </div>
                                <div class="col-auto text-right align-top">
                                    <i class="fas fa-thumbtack fa-fw fa-lg align-middle" style="color: #798AC4;"></i>
                                    <button type="button" onclick="excluirComentarioConteudo(${comentario.id});" class="btn btn-light align-middle ml-2 p-1"><i class="fas fa-trash fa-fw text-danger" style="color: #798AC4;"></i></button>
                                    <span class="d-block text-lighter">
                                        ${comentario.created_at}
                                    </span>
                                </div>
                            </div>`;
                        }
                        else
                        {
                            var div = `<div id="divComentario${comentario.id}" class="p-3 row">
                                <div class="col-auto align-top mr-3" style="background-image: url('{{ env('APP_LOCAL') }}/usuarios/${comentario.user_id}/perfil/image'); width: 66px;height: 66px;background-size: cover;background-position:  50% 50%;background-repeat: no-repeat;border-radius: 100px;">
                                </div>
                                <div class="col align-top">
                                    <span class="d-block" style="color: #B7B7B7;">
                                        ${comentario.user.name}
                                    </span>
                                    <span class="d-block text-bluegray" style="">
                                        ${comentario.comentario}
                                    </span>
                                </div>
                                <div class="col-auto text-right align-top">
                                    <button type="button" onclick="excluirComentarioConteudo(${comentario.id});" class="btn btn-light align-middle ml-2 p-1"><i class="fas fa-trash fa-fw text-danger" style="color: #798AC4;"></i></button>
                                    <span class="d-block text-lighter">
                                        ${comentario.created_at}
                                    </span>
                                </div>
                            </div>`;
                        }

                        $("#divComentarios").prepend(div);

                        $('#lblQtComentariosConteudo').text( $("#divComentarios > div").length + ' comentários');

                        $('html, body').animate({
                            scrollTop: $("#divComentario" + comentario.id).offset().top
                        }, 2000);
                    }
                },
                error: function( _response )
                {
                    console.log( _response );
                }
            });
        }

        function excluirComentarioConteudo(idComentario)
        {
            if(idComentario <= 0)
            {
                return;
            }

            swal({
                title: 'Excluir comentário?',
                text: "Você deseja mesmo excluir este comentário?",
                icon: "warning",
                buttons: ['Não', 'Sim, excluir!'],
                dangerMode: true,
            }).then((result) => {
                if (result == true)
                {
                    $.ajax({
                        url: '{{ env('APP_LOCAL') }}/play/{{ $curso->id }}/' + aulaAtual + '/' + conteudoAtual + "/comentario/" + idComentario + "/excluir",
                        type: 'get',
                        dataType: 'json',
                        success: function( _response )
                        {
                            console.log( _response );

                            if(_response.success != null)
                            {
                                $("#divComentarios #divComentario" + idComentario).remove();

                                $('#lblQtComentariosConteudo').text( $("#divComentarios > div").length + ' comentários');
                            }
                        },
                        error: function( _response )
                        {
                            console.log( _response );
                        }
                    });
                }
            });


        }

        function enviarAvaliacaoConteudo(avaliacao)
        {
            if(avaliacao == 1 && $('#btnPositivo i.text-success').length > 0)
            {
                return;
            }
            else if(avaliacao == 0 && $('#btnNegativo i.text-danger').length > 0)
            {
                return;
            }

            var formData = { '_token' : '{{ csrf_token() }}', 'avaliacao': avaliacao };


            $.ajax({
                url: '{{ env('APP_LOCAL') }}/play/{{ $curso->id }}/' + aulaAtual + '/' + conteudoAtual + "/avaliacao/enviar",
                type: 'post',
                dataType: 'json',
                data: formData,
                success: function( _response )
                {
                    console.log( _response );

                    if(_response.success != null)
                    {
                        if(avaliacao == 1)
                        {
                            $("#divAboutConteudo #divAvaliacaoPositiva .quantidade").text( parseInt($("#divAboutConteudo #divAvaliacaoPositiva .quantidade").text()) + 1 );

                            if($("#divAboutConteudo #divAvaliacaoNegativa button i").hasClass('text-danger'))
                            {
                                $("#divAboutConteudo #divAvaliacaoNegativa .quantidade").text( parseInt($("#divAboutConteudo #divAvaliacaoNegativa .quantidade").text()) - 1 );
                            }

                            $("#divAboutConteudo #divAvaliacaoPositiva button i").addClass('text-success');
                            $("#divAboutConteudo #divAvaliacaoNegativa button i").removeClass('text-danger');
                        }
                        else
                        {
                            $("#divAboutConteudo #divAvaliacaoNegativa .quantidade").text( parseInt($("#divAboutConteudo #divAvaliacaoNegativa .quantidade").text()) + 1 );

                            if($("#divAboutConteudo #divAvaliacaoPositiva button i").hasClass('text-success'))
                            {
                                $("#divAboutConteudo #divAvaliacaoPositiva .quantidade").text( parseInt($("#divAboutConteudo #divAvaliacaoPositiva .quantidade").text()) - 1 );
                            }

                            $("#divAboutConteudo #divAvaliacaoPositiva button i").removeClass('text-success');
                            $("#divAboutConteudo #divAvaliacaoNegativa button i").addClass('text-danger');
                        }
                    }
                },
                error: function( _response )
                {
                    console.log( _response );
                }
            });
        }

        var avaliacaoCurso = 0;

        function selecionarAvaliacaoCurso(qt)
        {
            avaliacaoCurso = qt;

            $("#divAvaliarCurso .avaliacao .btn-avaliar").each(function( index ) {
                if((5-index) <= qt)
                {
                    $(this).addClass("checked");
                }
                else
                {
                    $(this).removeClass("checked");
                }
            });
        }

        function enviarAvaliacaoCurso()
        {
            var formData = { '_token' : '{{ csrf_token() }}', 'avaliacao': avaliacaoCurso, 'comentario' : $("#comentario_avalicao").val() };

            $.ajax({
                url: "{{ route('curso.play.enviar-avaliacao-curso', ['idCurso' => $curso->id]) }}",
                type: 'post',
                dataType: 'json',
                data: formData,
                success: function( _response )
                {
                    console.log( _response );

                    if(_response.success != null)
                    {
                        $("#divAvaliarCurso").addClass("d-none");
                        $("#divAvaliouCurso").removeClass("d-none");
                    }
                },
                error: function( _response )
                {
                    console.log( _response );
                }
            });
        }

        var avaliacaoProfessor = 0;

        function selecionarAvaliacaoProfessor(qt)
        {
            avaliacaoProfessor = qt;

            $("#divAvaliarProfessor .avaliacao .btn-avaliar").each(function( index ) {
                if((5-index) <= qt)
                {
                    $(this).addClass("checked");
                }
                else
                {
                    $(this).removeClass("checked");
                }
            });
        }

        function enviarAvaliacaoProfessor()
        {
            var formData = { '_token' : '{{ csrf_token() }}', 'avaliacao': avaliacaoProfessor, 'comentario' : $("#comentario_avalicao_professor").val() };

            $.ajax({
                url: "{{ route('curso.play.enviar-avaliacao-professor', ['idCurso' => $curso->id]) }}",
                type: 'post',
                dataType: 'json',
                data: formData,
                success: function( _response )
                {
                    console.log( _response );

                    if(_response.success != null)
                    {
                        $("#divAvaliarProfessor").addClass("d-none");
                        $("#divAvaliouProfessor").removeClass("d-none");
                    }
                },
                error: function( _response )
                {
                    console.log( _response );
                }
            });
        }

        var avaliacaoEscola = 0;

        function selecionarAvaliacaoEscola(qt)
        {
            avaliacaoEscola = qt;

            $("#divAvaliarEscola .avaliacao .btn-avaliar").each(function( index ) {
                if((5-index) <= qt)
                {
                    $(this).addClass("checked");
                }
                else
                {
                    $(this).removeClass("checked");
                }
            });
        }

        function enviarAvaliacaoEscola()
        {
            var formData = { '_token' : '{{ csrf_token() }}', 'avaliacao': avaliacaoEscola, 'comentario' : $("#comentario_avalicao").val() };

            $.ajax({
                url: "{{ route('curso.play.enviar-avaliacao-escola', ['escola_id' => $curso->escola_id]) }}",
                type: 'post',
                dataType: 'json',
                data: formData,
                success: function( _response )
                {
                    console.log( _response );

                    if(_response.success != null)
                    {
                        $("#divAvaliarEscola").addClass("d-none");
                        $("#divAvaliouEscola").removeClass("d-none");
                    }
                },
                error: function( _response )
                {
                    console.log( _response );
                }
            });
        }

        function enviarMensagemChatTransmissao()
        {
            if(tipoConteudoAtual != 5)
                return;

            var contMsg = $("#txtConteudoMensagem").val();
            $("#txtConteudoMensagem").val("");

            var formData = { '_token' : '{{ csrf_token() }}', 'mensagem' : contMsg };

            $.ajax({
                url: '{{ env('APP_LOCAL') }}/play/{{ $curso->id }}/' + aulaAtual + '/' + conteudoAtual + "/mensagem/enviar",
                type: 'post',
                dataType: 'json',
                data: formData,
                success: function( _response )
                {
                    console.log( _response );

                    if(_response.success != null)
                    {
                        var msg = `<div id="divMensagem${_response.mensagem.id}" style="font-size: 1vw/*18px*/;color:  #BCBCBC;max-width: 100%;padding:  12px 8px;">
                            <div style="display: inline-block;border: 2px solid #207adc;vertical-align: middle;margin: 0px;background: url({{ env('APP_LOCAL') }}/usuarios/${_response.mensagem.user.id}/perfil/image);width: 45px;height: 45px;background-size: cover !important;background-repeat: no-repeat !important;background-position: 50% 50% !important;border-radius: 50%;margin-right:  8px;">
                            </div>
                            <div style="vertical-align:  middle;display:  inline-block;max-width: calc(100% - 58px);text-align:  -webkit-left;color: #207adc;font-weight: bold;">
                                ${_response.mensagem.user.name}:
                                <span style="color: #354353;">
                                    ${_response.mensagem.mensagem}
                                </span>
                            </div>
                        </div>`;

                        $("#divConteudoMensagens").append(msg);

                        $("#divConteudoMensagens").animate({ scrollTop: $('#divConteudoMensagens').prop("scrollHeight")}, 1000);
                    }
                    else
                    {
                        $("#txtConteudoMensagem").val(contMsg);
                    }
                },
                error: function( _response )
                {
                    console.log( _response );

                    $("#txtConteudoMensagem").val(contMsg);
                }
            });
        }

        var timestamp = null;

        function carregarMensagensTransmissao()
        {
            console.log("Iniciando leitura das mensagens.");

            $("#divConteudoMensagens").animate({ scrollTop: $('#divConteudoMensagens').prop("scrollHeight")}, 1000);

            var formData = { 'timestamp' : timestamp };

            if(aulaAtual == 0 || conteudoAtual == 0 || tipoConteudoAtual != 5)
            {
                return;
            }

            $.ajax({
                url: '{{ env('APP_LOCAL') }}/play/{{ $curso->id }}/' + aulaAtual + '/' + conteudoAtual + "/mensagens",
                type : 'get',
                dataType: 'json',
                data: formData,
                async : true,
                cache : false,
                success : function(data) {

                        console.log("Leitura concluida!");

                        console.log(data);

                        timestamp  = data.timestamp;

                        if(data.mensagens != null)
                        {
                            if(data.mensagens.length > 0)
                            {
                                var msgs = "";

                                data.mensagens.forEach( (item) => {

                                    if($("#divMensagem" + item.id).length == 0)
                                    msgs = msgs + `<div id="divMensagem${item.id}" style="font-size: 1vw/*18px*/;color:  #BCBCBC;max-width: 100%;padding:  12px 8px;">
                                        <div style="display: inline-block;border: 2px solid #207adc;vertical-align: middle;margin: 0px;background: url({{ env('APP_LOCAL') }}/usuarios/${item.user.id}/perfil/image);width: 45px;height: 45px;background-size: cover !important;background-repeat: no-repeat !important;background-position: 50% 50% !important;border-radius: 50%;margin-right:  8px;">
                                        </div>
                                        <div style="vertical-align:  middle;display:  inline-block;max-width: calc(100% - 58px);text-align:  -webkit-left;color: #207adc;font-weight: bold;">
                                            ${item.user.name}:
                                            <span style="color: #354353;">
                                                ${item.mensagem}
                                            </span>
                                        </div>
                                    </div>`;

                                });

                                $("#divConteudoMensagens").append(msgs);

                                $("#divConteudoMensagens").animate({ scrollTop: $('#divConteudoMensagens').prop("scrollHeight")}, 1000);
                            }
                        }

                        setTimeout('carregarMensagensTransmissao()', 1000);
                },
                error : function(XMLHttpRequest, textstatus, error)
                {
                    console.log(error);
                    //setTimeout('carregarMensagensTransmissao()', 15000);
                }
            });
        }

    </script>

</body>

</html>
