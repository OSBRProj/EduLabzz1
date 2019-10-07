@extends('layouts.master')

@section('title', 'J. PIAGET - Gestão de conteúdo')

@section('headend')

    <!-- Custom styles for this template -->
    <style>

        header
        {
            padding: 154px 0 100px;
        }

        @media (min-width: 992px)
        {
            header
            {
                padding: 156px 0 100px;
            }
        }

        .card
        {
            display: flex;
            flex-direction: row;
            padding: 6px;
            border-radius: 5px;
            shadow: 0px 1px 3px rgba(0, 0, 0, 0.16);
            background-color: #FFFFFF;
        }

        body.dark-mode .card
        {
            background-color: #1F212E;
        }

    </style>

@endsection

@section('content')

<main role="main" class="">

    <div class="container">

        <div class="col-12 col-md-11 mx-auto">

        <div class="row">

            <div class="col-12 mb-3 title pl-0">
                <h2>Biblioteca</h2>
            </div>

            <div class="col-12 px-0 mb-4">

                @if(count($conteudos) > 0)
                    <div class="row">
                        <div class="col-sm-12 col-md-8 col-xl-9 my-auto">
                            <form action="" method="get">
                            <div class="input-group input-group mb-3">

                                    <input name="pesquisa" type="text" value="{{ Request::has('pesquisa') ? Request::get('pesquisa') : '' }}" required class="form-control py-2 width-100 shadow-sm border-0 px-3"
                                        placeholder="Procurar conteúdo."
                                        aria-label="Recipient's username" aria-describedby="button-addon2">

                                    <div class="input-group-append">
                                        <button class="btn bg-primary border-0 text-light shadow-sm" type="submit" id="button-addon2">
                                            <i class="fas fa-search fa-lg fa-fw text-light"></i>
                                        </button>
                                    </div>
                                </div>
                                </form>

                        </div>

                        <div class="col-sm-12 col-md-4 col-xl-3 mb-3">
                            <button type="button" data-toggle="modal" data-target="#divModalTiposConteudo" class="btn btn-block btn-primary text-truncate text-uppercase d-flex align-items-center justify-content-center font-weight-bold mr-3 mb-2 mb-sm-0 h-100">
                                <i class="fas fa-plus mr-2"></i>
                                Novo conteúdo
                            </button>
                        </div>

                    </div>
                @else
                    <button type="button" data-toggle="modal" data-target="#divModalTiposConteudo" class="btn btn-primary text-truncate text-uppercase font-weight-bold mr-3 mb-2 mb-sm-0">
                        <i class="fas fa-plus mr-2"></i>
                        Novo conteúdo
                    </button>
                @endif

                @if(Request::has('pesquisa'))
                    <div class="col-sm-12 col-md-6 text-center text-md-left mb-md-0 my-3">
                        <h5 class="my-2">
                            <span class="font-weight-bold text-bluegray align-middle">Buscando por:</span>
                            <span class="font-weight-bold text-bluegray align-middle" style="background-color: #207adc;color:  white;border-radius:  25px;padding:  8px 30px;margin:  0px 10px;">
                                "{{ ucfirst(Request::get('pesquisa')) }}"
                                <a href="{{ url()->current() }}" class="text-white ml-2">
                                    <i class="fas fa-times"></i>
                                </a>
                            </span>
                        </h5>
                    </div>
                @endif

            </div>

            <div class="w-100">

                <div class="row my-4">

                    <div class="col-12 mb-3 mb-md-0">
                        <h4 class="my-2 w-100 title">
                            <i class="fas fa-gamepad small-2 align-middle mr-2"></i>
                            <span class="font-weight-bold align-middle">Jogos</span>
                        </h4>
                    </div>

                    @if(Request::has('categoria') || Request::has('pesquisa'))
                        <div class="col-md-6 mb-2 text-center text-md-right mx-auto mx-md-1 ml-md-auto">
                            <div class="dropdown">
                                <label for="cmbLimite" class="h6 mr-2 font-weight-bold text-lighter">Mostrar</label>
                                <button class="btn dropdown-toggle w-auto border-0 bg-white shadow-sm font-weight-bold text-lighter" type="button" id="cmbLimite" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Request::has('amount') ? Request::get('amount') : 10 }}
                                </button>
                                <div class="dropdown-menu bg-white" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item font-weight-bold text-lighter" href="{{ HelperClass::appendToUrl(['qt' => '10']) }}">10</a>
                                    <a class="dropdown-item font-weight-bold text-lighter" href="{{ HelperClass::appendToUrl(['qt' => '15']) }}">15</a>
                                    <a class="dropdown-item font-weight-bold text-lighter" href="{{ HelperClass::appendToUrl(['qt' => '20']) }}">20</a>
                                    <a class="dropdown-item font-weight-bold text-lighter" href="{{ HelperClass::appendToUrl(['qt' => '35']) }}">35</a>
                                </div>
                                <label for="cmbLimite" class="h6 ml-2 font-weight-bold text-lighter">por página</label>
                            </div>
                        </div>
                    @endif

                </div>
                <!-- END HEADER -->

                <div class="py-2">
                    <div class="row">
                        @foreach ($aplicacoes as $aplicacao)

                            <div id="divAplicacao{{ $aplicacao->id }}" class="col-12 col-sm-6 col-lg-4 mb-3">
                                <div class="card rounded text-decoration-none h-100 border-0 shadow-sm">

                                    <div class="card-img-auto bg-dark h-100 rounded-0" style="flex: 0.6;background-image: url('{{ env('APP_LOCAL') . '/uploads/aplicacoes/capas/' .  $aplicacao->capa }}');background-size: cover;background-position: 50% 50%;background-repeat: no-repeat;min-height: 115px;">
                                    </div>
                                    <div class="py-3 px-4 h-100" style="color: #525870;font-size: 16px;flex: 1;">
                                        <span class="d-block mb-2">
                                            {{ ucfirst($aplicacao->titulo) }}
                                        </span>
                                        <span class="d-block font-weight-bold" style="color: #207ADC;">
                                            <i class="fas fa-gamepad fa-fw mr-1"></i>
                                            Jogo
                                        </span>
                                    </div>

                                    <button class="btn btn-link text-gray float-right p-2" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="position: absolute;right: 0px;margin-right: 15px;">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a target="_blank" href="{{ route('hub.aplicacao', ['idAplicacao' => $aplicacao->id]) }}" class="btn btn-link dropdown-item">
                                            Abrir aplicação
                                        </a>
                                        <button type="button" onclick="editarAplicacao({{ $aplicacao->id }})" class="btn btn-link dropdown-item">
                                            Editar aplicação
                                        </button>
                                        <button type="button" onclick="excluirAplicacao({{ $aplicacao->id }});" class="btn btn-link text-danger dropdown-item">
                                            Excluir aplicação
                                        </button>
                                    </div>
                                </div>
                            </div>

                        @endforeach

                        @if(Request::has('pesquisa') && count($aplicacoes) == 0)

                            <div class="col-12 col-lg-6">
                                <h4 class="my-2">
                                    <span class="font-weight-bold text-bluegray align-middle">Infelizmente não encontramos resultados para sua busca.</span>
                                </h4>
                                <div class="my-3">
                                    <h5 class="my-2">
                                        <span class="font-weight-normal text-bluegray align-middle">Recomendamos ajustar sua busca. Aqui estão algumas ideias:</span>
                                    </h5>
                                    <ul class="no-result-page--idea-list--3YX3z">
                                        <li>Verifique se todas as palavras estão com a ortografia correta.</li>
                                        <li>Tente usar termos de pesquisa diferentes.</li>
                                        <li>Tente usar termos de pesquisa mais genéricos.</li>
                                    </ul>
                                </div>
                            </div>

                        @endif


                    </div>
                </div>

            </div>

            </div>

            <!-- END SECTION APLICACOES -->

            @if(count($videos) > 0)
                <section class="row">

                    <div class="w-100 title pb-1 mb-4">
                        <h4 class="my-2">
                            <i class="fas fa-video small-2 mr-2"></i>
                            <span class="font-weight-bold">Vídeos</span>
                        </h4>
                    </div>

                    <div class="col-12 py-2 px-0">

                        <div class="row">
                            @foreach ($videos as $conteudo)

                                <div id="divConteudo{{ $conteudo->id }}" class="col-sm-12 col-md-6 col-lg-4 mb-3">
                                    <div class="card rounded-sm text-decoration-none h-100 shadow-sm border-0">
                                        <div class="py-3 px-4 h-100" style="color: #525870;font-size: 16px;flex: 1;">
                                            <span class="d-block mb-2">
                                                {{ ucfirst($conteudo->titulo) }}
                                            </span>
                                            <span class="d-block font-weight-bold" style="color: #207ADC;">
                                                <i class="fas fa-video fa-fw mr-1"></i>
                                                Vídeo
                                            </span>
                                        </div>

                                        <button class="btn btn-link text-gray float-right p-2" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="position: absolute;right: 0px;margin-right: 15px;">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a target="_blank" href="{{ route('conteudo.play', ['idConteudo' => $conteudo->id]) }}" class="btn btn-link dropdown-item">
                                                Abrir conteúdo
                                            </a>
                                            <button type="button" onclick="editarConteudo({{ $conteudo->id }})" class="btn btn-link dropdown-item">
                                                Editar conteúdo
                                            </button>
                                            <button type="button" onclick="excluirConteudo({{ $conteudo->id }});" class="btn btn-link text-danger dropdown-item">
                                                Excluir conteúdo
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                        </div>
                    </div>
                </section>
            @endif

            @if(count($slides) > 0)
                <section class="row">

                    <div class="col-12 my-4 px-0">

                        <div class="col-12 mb-3 px-0 title">
                            <h4 class="my-2">
                                <i class="fas fa-file-powerpoint small-2 align-middle mr-2"></i>
                                <span class="font-weight-bold align-middle">Slides</span>
                            </h4>
                        </div>

                        <div class="py-2">
                            <div class="row">
                                @foreach ($slides as $conteudo)

                                    <div id="divConteudo{{ $conteudo->id }}" class="col-12 col-sm-6 col-lg-4 mb-3">
                                        <div class="card rounded shadow-sm text-decoration-none h-100 border-0">
                                            <div class="py-3 px-4 h-100" style="color: #525870;font-size: 16px;flex: 1;">
                                                <span class="d-block mb-2">
                                                    {{ ucfirst($conteudo->titulo) }}
                                                </span>
                                                <span class="d-block font-weight-bold" style="color: #207ADC;">
                                                    <i class="fas fa-file-powerpoint fa-fw mr-1"></i>
                                                    Slide
                                                </span>
                                            </div>

                                            <button class="btn btn-link text-gray float-right p-2" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="position: absolute;right: 0px;margin-right: 15px;">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a target="_blank" href="{{ route('conteudo.play', ['idConteudo' => $conteudo->id]) }}" class="btn btn-link dropdown-item">
                                                    Abrir conteúdo
                                                </a>
                                                <button type="button" onclick="editarConteudo({{ $conteudo->id }})" class="btn btn-link dropdown-item">
                                                    Editar conteúdo
                                                </button>
                                                <button type="button" onclick="excluirConteudo({{ $conteudo->id }});" class="btn btn-link text-danger dropdown-item">
                                                    Excluir conteúdo
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                            </div>
                        </div>

                    </div>

                </section>
            @endif

            @if(count($apostilas) > 0)
                <section class="row">

                    <div class="col-12 px-0">
                        <div class="col-12 mb-3 px-0 title">

                            <h4 class="my-2">
                                <i class="fas fa-file-alt small-2 align-middle mr-2"></i>
                                <span class="font-weight-bold align-middle">Livros digitais</span>
                            </h4>

                        </div>
                    </div>

                    <div class="w-100 py-2">
                        <div class="row">
                            @foreach ($apostilas as $conteudo)

                                <div id="divConteudo{{ $conteudo->id }}" class="col-12 col-sm-6 col-lg-4 mb-3">
                                    <div class="card rounded shadow-sm text-decoration-none h-100 border-0">
                                        <div class="py-3 px-4 h-100" style="color: #525870;font-size: 16px;flex: 1;">
                                            <span class="d-block mb-2">
                                                {{ ucfirst($conteudo->titulo) }}
                                            </span>
                                            <span class="d-block font-weight-bold" style="color: #207ADC;">
                                                <i class="fas fa-file-alt fa-fw mr-1"></i>
                                                Livro digital
                                            </span>
                                        </div>

                                        <button class="btn btn-link text-gray float-right p-2" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="position: absolute;right: 0px;margin-right: 15px;">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a target="_blank" href="{{ route('conteudo.play', ['idConteudo' => $conteudo->id]) }}" class="btn btn-link dropdown-item">
                                                Abrir conteúdo
                                            </a>
                                            <button type="button" onclick="editarConteudo({{ $conteudo->id }})" class="btn btn-link dropdown-item">
                                                Editar conteúdo
                                            </button>
                                            <button type="button" onclick="excluirConteudo({{ $conteudo->id }});" class="btn btn-link text-danger dropdown-item">
                                                Excluir conteúdo
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                        </div>
                    </div>
                </section>
            @endif

            @if(count($documentos) > 0)
                <section class="row">

                    <div class="col-12 px-0">
                        <div class="col-12 mb-3 px-0 title">

                            <h4 class="my-2">
                                <i class="fas fa-file-pdf small-2 align-middle mr-2"></i>
                                <span class="font-weight-bold align-middle">Documentos</span>
                            </h4>

                        </div>
                    </div>

                    <div class="py-2">
                        <div class="row">
                            @foreach ($documentos as $conteudo)

                                <div id="divConteudo{{ $conteudo->id }}" class="col-12 col-sm-6 col-lg-4 mb-3">
                                    <div class="card rounded shadow-sm text-decoration-none h-100 border-0">
                                        <div class="py-3 px-4 h-100" style="color: #525870;font-size: 16px;flex: 1;">
                                            <span class="d-block mb-2">
                                                {{ ucfirst($conteudo->titulo) }}
                                            </span>
                                            <span class="d-block font-weight-bold" style="color: #207ADC;">
                                                <i class="fas fa-file-pdf fa-fw mr-1"></i>
                                                Documento
                                            </span>
                                        </div>

                                        <button class="btn btn-link text-gray float-right p-2" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="position: absolute;right: 0px;margin-right: 15px;">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a target="_blank" href="{{ route('conteudo.play', ['idConteudo' => $conteudo->id]) }}" class="btn btn-link dropdown-item">
                                                Abrir conteúdo
                                            </a>
                                            <button type="button" onclick="editarConteudo({{ $conteudo->id }})" class="btn btn-link dropdown-item">
                                                Editar conteúdo
                                            </button>
                                            <button type="button" onclick="excluirConteudo({{ $conteudo->id }});" class="btn btn-link text-danger dropdown-item">
                                                Excluir conteúdo
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                        </div>
                    </div>
                </section>
            @endif

        </div>

        <!-- Modal Tipo de Conteudo -->
        <div class="modal fade" id="divModalTiposConteudo" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg px-1 px-md-5 text-center" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>

                        <h4 class="mb-3 pt-3">
                            Criação de conteúdo
                        </h4>
                        <p>Escolha abaixo um tipo de conteúdo</p>

                        <div class="container-fluid">

                            <h5 class="mb-2 title text-left">
                                <i class="fas fa-book fa-lg fa-fw text-primary" style=""></i>
                                Conteúdo
                            </h5>

                            <div class="row mb-4">

                                <button onclick="showNovoConteudo(1)" class="btn btn-link text-decoration-none col-4">
                                    <div class="shadow-sm rounded text-primary text-center py-3  px-2 text-truncate" style="">
                                        <i class="fas fa-font fa-fw fa-2x"></i>
                                        <br>
                                        Livre
                                    </div>
                                </button>
                                <button onclick="showNovoConteudo(2)" class="btn btn-link text-decoration-none col-4">
                                    <div class="shadow-sm rounded text-primary text-center py-3  px-2 text-truncate" style="">
                                        <i class="fas fa-podcast fa-fw fa-2x"></i>
                                        <br>
                                        Áudio
                                    </div>
                                </button>
                                <button onclick="showNovoConteudo(3)" class="btn btn-link text-decoration-none col-4">
                                    <div class="shadow-sm rounded text-primary text-center py-3  px-2 text-truncate" style="">
                                        <i class="fas fa-video fa-fw fa-2x"></i>
                                        <br>
                                        Vídeo
                                    </div>
                                </button>
                                <button onclick="showNovoConteudo(4)" class="btn btn-link text-decoration-none col-4">
                                    <div class="shadow-sm rounded text-primary text-center py-3  px-2 text-truncate" style="">
                                        <i class="fas fa-file-powerpoint fa-fw fa-2x"></i>
                                        <br>
                                        Slide ou Documento
                                    </div>
                                </button>
                                <button onclick="showNovoConteudo(4)" class="btn btn-link text-decoration-none col-4">
                                    <div class="shadow-sm rounded text-primary text-center py-3  px-2 text-truncate" style="">
                                        <i class="fas fa-broadcast-tower fa-fw fa-2x"></i>
                                        <br>
                                        Transmissão
                                    </div>
                                </button>

                            </div>

                            <h5 class="mb-2 title text-left">
                                <i class="fas fa-file-archive fa-lg fa-fw text-primary" style=""></i>
                                Arquivos
                            </h5>

                            <div class="row mb-4">

                                <button onclick="showNovoConteudo(6)" class="btn btn-link text-decoration-none col-4">
                                    <div class="shadow-sm rounded text-primary text-center py-3  px-2 text-truncate px-2 text-truncate" style="">
                                        <i class="fas fa-upload fa-fw fa-2x"></i>
                                        <br>
                                        Enviar arquivo próprio  (Até 20Mb PDF, DOC, PNG, JPG)
                                    </div>
                                </button>

                            </div>

                            <h5 class="mb-2 title text-left">
                                <i class="fas fa-gamepad fa-lg fa-fw text-primary" style=""></i>
                                Atividades
                            </h5>

                            <div class="row mb-4">

                                <button onclick="showNovoConteudo(7)" class="btn btn-link text-decoration-none col-4">
                                    <div class="shadow-sm rounded text-primary text-center py-3  px-2 text-truncate" style="">
                                        <i class="fas fa-comment-alt fa-fw fa-2x"></i>
                                        <br>
                                        Dissertativa
                                    </div>
                                </button>

                                <button onclick="showNovoConteudo(8)" class="btn btn-link text-decoration-none col-4">
                                    <div class="shadow-sm rounded text-primary text-center py-3  px-2 text-truncate" style="">
                                        <i class="fas fa-list-ul fa-fw fa-2x"></i>
                                        <br>
                                        Quiz
                                    </div>
                                </button>

                                <button onclick="showNovoConteudo(9)" class="btn btn-link text-decoration-none col-4">
                                    <div class="shadow-sm rounded text-primary text-center py-3  px-2 text-truncate" style="">
                                        <i class="fas fa-stopwatch fa-fw fa-2x"></i>
                                        <br>
                                        Prova
                                    </div>
                                </button>

                                <button onclick="showNovoConteudo(11)" class="btn btn-link text-decoration-none col-4">
                                    <div class="shadow-sm rounded text-primary text-center py-3  px-2 text-truncate" style="">
                                        <i class="fas fa-file-alt fa-fw fa-2x"></i>
                                        <br>
                                        Livro digital
                                    </div>
                                </button>

                            </div>

                            <h5 class="mb-2 title text-left">
                                <i class="fas fa-arrow-circle-up fa-lg fa-fw text-primary" style=""></i>
                                Entregável
                            </h5>

                            <div class="row mb-4">

                                <button onclick="showNovoConteudo(10)" class="btn btn-link text-decoration-none col-4">
                                    <div class="shadow-sm rounded text-primary text-center py-3  px-2 text-truncate" style="">
                                        <i class="fas fa-arrow-circle-up fa-fw fa-2x"></i>
                                        <br>
                                        Receber arquivo do aluno  (Até 20Mb PDF, DOC, PNG, JPG)</small>
                                    </div>
                                </button>

                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>
        <!-- Fim modal Tipo de Conteudo -->

        <!-- Modal Novo Conteudo -->
        @include('gestao.conteudo.modal-novo-conteudo')
        <!-- Fim modal novo conteudo -->

        <!-- Modal Editar Conteudo -->
        @include('gestao.conteudo.modal-editar-conteudo')
        <!-- Fim modal editar conteudo -->

        {{-- <!-- Modal Novo Conteudo -->
        <div class="modal fade" id="divModalNovoConteudo" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md px-1 px-md-5" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                        <form id="formNovoConteudo" method="POST" action="{{ route('gestao.conteudo-novo') }}" enctype="multipart/form-data" class="text-center px-3 shadow-none border-0">

                            @csrf

                            <input name="tipo" required hidden>

                            <div id="divLoading" class="text-center">
                                <i class="fas fa-spinner fa-pulse fa-3x text-primary"></i>
                            </div>

                            <div id="divEnviando" class="text-center d-none">
                                <i class="fas fa-spinner fa-pulse fa-3x text-primary mb-3"></i>
                                <h4>Enviando</h4>
                            </div>

                            <div id="divEditar" class="form-page d-none">

                                <div id="page1" class="form-page">

                                    <h5 id="lblTipoNovoConteudo" class="my-3">Tipo de conteudo</h5>

                                    <div class="form-group mb-3 text-left">
                                        <label class="font-weight-bold" for="txtTituloNovoConteudo">Título do conteúdo</label>
                                        <input type="text" class="form-control" name="titulo" id="txtTituloNovoConteudo" placeholder="Clique para digitar." required>
                                    </div>

                                    <div class="form-group mb-3 text-left">
                                        <label class="font-weight-bold" for="txtDescricaoNovoConteudo">Descrição do conteúdo <small>(opcional)</small></label>
                                        <textarea class="form-control" name="descricao" id="txtDescricaoNovoConteudo" rows="3" placeholder="Clique para digitar."></textarea>
                                    </div>

                                    <div class="tipos-conteudo text-left">

                                        <div id="conteudoTipo1" class="tipo">
                                            <div class="form-group mb-3">
                                                <label class="font-weight-bold" for="txtConteudo">Conteúdo</label>
                                                <hr>
                                                <div class="summernote-holder">
                                                    <textarea name="conteudo" id="txtConteudo" class="summernote summernote-airmode">
                                                        <div style="color: #525870;font-weight: bold;font-size: 16px;">
                                                            <p>Esta é a área de edição de conteúdo misto, clique aqui para começar a editar.</p>
                                                            <ul>
                                                                <li>Aqui você pode escrever artigos.</li>
                                                                <li>Colocar imagens, vídeos, tabelas.</li>
                                                                <li>Personalizar o texto da forma como desejar.</li>
                                                                <li>E muito mais.</li>
                                                            </ul>
                                                        </div>
                                                    </textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="conteudoTipo2" class="tipo">
                                            <div class="form-group mb-3 text-left">
                                                <label class="" for="inputAudioNovoConteudo">Clique para fazer upload do aúdio</label>
                                                <br>
                                                <div class="upload-btn-wrapper">
                                                    <button class="btn btn-lg bg-bluelight text-dark file-name">Selecionar arquivo</button>
                                                    <input type="file" name="arquivoAudio" id="inputAudioNovoConteudo" onchange="mudouArquivoInput(this);"  accept="audio/*" />
                                                </div>
                                            </div>
                                            <div class="form-group mb-3 text-left">
                                                <label class="font-weight-bold" for="txtAudioNovoConteudo">Ou digite o link</label>
                                                <input type="text" class="form-control" name="conteudoAudio" id="txtAudioNovoConteudo" placeholder="Clique para digitar.">
                                            </div>
                                        </div>
                                        <div id="conteudoTipo3" class="tipo">
                                            <div class="form-group mb-3 text-left">
                                                <label class="" for="inputVideoNovoConteudo">Clique para fazer upload do vídeo</label>
                                                <br>
                                                <div class="upload-btn-wrapper">
                                                    <button class="btn bg-bluelight text-dark file-name">Selecionar arquivo</button>
                                                    <input type="file" name="arquivoVideo" id="inputVideoNovoConteudo" onchange="mudouArquivoInput(this);"  accept="video/*" />
                                                </div>
                                            </div>
                                            <div class="form-group mb-3 text-left">
                                                <label class="font-weight-bold" for="txtVideoNovoConteudo">Ou digite o link</label>
                                                <input type="text" class="form-control" name="conteudoVideo" id="txtVideoNovoConteudo" placeholder="Clique para digitar.">
                                            </div>
                                            <div class="form-group mb-3 text-left" hidden>
                                                <label class="">Preview:</label>
                                                <iframe class="d-block" src="https://www.youtube.com/embed/NpEaa2P7qZI" frameborder="0" allow="encrypted-media" style="width: 40vw;height: 25vw;max-width: 1040px;max-height: 586px;"></iframe>
                                            </div>
                                        </div>
                                        <div id="conteudoTipo4" class="tipo">
                                            <div class="form-group mb-3 text-left">
                                                <label class="" for="inputSlideNovoConteudo">Clique para fazer upload do slide (Powerpoint, PDF)</label>
                                                <br>
                                                <div class="upload-btn-wrapper">
                                                    <button class="btn bg-bluelight text-dark file-name">Selecionar arquivo</button>
                                                    <input type="file" name="arquivoSlide" id="inputSlideNovoConteudo" onchange="mudouArquivoInput(this);"  accept="application/vnd.ms-powerpoint, application/vnd.openxmlformats-officedocument.presentationml.slideshow, application/vnd.openxmlformats-officedocument.presentationml.presentation, .pps, .pptx, .pdf" />
                                                </div>
                                            </div>
                                            <div class="form-group mb-3 text-left">
                                                <label class="font-weight-bold" for="txtSlideNovoConteudo">Ou digite o link</label>
                                                <input type="text" class="form-control" name="conteudoSlide" id="txtSlideNovoConteudo" placeholder="Clique para digitar.">
                                            </div>
                                        </div>

                                    </div>
                                    <hr>

                                    <div class="form-group mb-3 text-left">
                                        <label class="font-weight-bold" for="cmbVisibilidadeNovoConteudo">Visibilidade do conteúdo</label>
                                        <select id="cmbVisibilidadeNovoConteudo" name="visibilidade" required class="custom-select rounded">
                                            <option selected value="1">Selecione uma visibilidade</option>
                                            <option value="0">Não listado</option>
                                            <option value="1">Listado</option>
                                        </select>
                                    </div>

                                    <div class="form-group mb-3 text-left">
                                        <label class="font-weight-bold" for="cmbStatusNovoConteudo">Status do conteúdo</label>
                                        <select id="cmbStatusNovoConteudo" name="status" required class="custom-select rounded">
                                            <option selected value="0">Selecione um status</option>
                                            <option value="0">Não publicado</option>
                                            <option value="1">Publicado</option>
                                        </select>
                                    </div>

                                    <div class="form-group mb-3 text-left" hidden>
                                        <label class="" for="txtFonteNovoConteudo">Fonte do conteúdo <small>(opcional)</small></label>
                                        <textarea class="form-control" name="fonte" id="txtFonteNovoConteudo" rows="2" placeholder="Clique para digitar."></textarea>
                                    </div>

                                    <div class="form-group mb-3 text-left" hidden>
                                        <label class="" for="txtAutoresNovoConteudo">Autores do conteúdo <small>(opcional)</small></label>
                                        <textarea class="form-control" name="autores" id="txtAutoresNovoConteudo" rows="2" placeholder="Clique para digitar."></textarea>
                                    </div>

                                    <div class="row mb-3">
                                        <button type="button" data-dismiss="modal" class="btn btn-danger mt-4 mb-0 col-4 ml-auto mr-4 font-weight-bold">Cancelar</button>
                                        <button type="button" onclick="salvarConteudo();" class="btn btn-primary signin-button mt-4 mb-0 col-4 ml-4 mr-auto font-weight-bold">Salvar</button>
                                    </div>

                                </div>



                            </div>

                        </form>

                    </div>

                </div>
            </div>
        </div>
        <!-- Fim modal novo conteudo -->

        <!-- Modal Editar Conteudo -->
        <div class="modal fade" id="divModalEditarConteudo" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md px-1 px-md-5" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                        <form id="formEditarConteudo" method="POST" action="{{ route('gestao.conteudos-salvar') }}" enctype="multipart/form-data" class="text-center px-3 shadow-none border-0">

                            @csrf

                            <input name="idConteudo" required hidden>

                            <input name="tipo" required hidden>

                            <div id="divLoading" class="text-center">
                                <i class="fas fa-spinner fa-pulse fa-3x text-primary"></i>
                            </div>

                            <div id="divEnviando" class="text-center d-none">
                                <i class="fas fa-spinner fa-pulse fa-3x text-primary mb-3"></i>
                                <h4>Enviando</h4>
                            </div>

                            <div id="divEditar" class="form-page d-none">

                                <div id="page1" class="form-page">

                                    <h5 id="lblTipoConteudo">Tipo de conteudo</h5>

                                    <div class="form-group mb-3 text-left">
                                        <label class="" for="txtTituloNovoConteudo">Título do conteúdo</label>
                                        <input type="text" class="form-control" name="titulo" id="txtTituloNovoConteudo" placeholder="Clique para digitar." required>
                                    </div>

                                    <div class="form-group mb-3 text-left">
                                        <label class="" for="txtDescricaoNovoConteudo">Descrição do conteúdo <small>(opcional)</small></label>
                                        <textarea class="form-control" name="descricao" id="txtDescricaoNovoConteudo" rows="3" placeholder="Clique para digitar."></textarea>
                                    </div>

                                    <div id="divVerArquivoAtual" class="form-group mb-3 text-left d-none">
                                        <a id="btnVerArquivoAtual" target="_blank" class="btn btn-lg bg-bluelight text-dark">Ver arquivo atual</a>
                                    </div>

                                    <div class="tipos-conteudo text-left">

                                        <div id="conteudoTipo1" class="tipo">
                                            <div class="form-group mb-3">
                                                <label class="" for="txtConteudo">Conteúdo</label>
                                                <div class="summernote-holder">
                                                    <textarea name="conteudo" id="txtConteudo" class="summernote summernote-airmode">
                                                        <div style="color: #525870;font-weight: bold;font-size: 16px;">
                                                            <p>Esta é a área de edição de conteúdo misto, clique aqui para começar a editar.</p>
                                                            <ul>
                                                                <li>Aqui você pode escrever artigos.</li>
                                                                <li>Colocar imagens, vídeos, tabelas.</li>
                                                                <li>Personalizar o texto da forma como desejar.</li>
                                                                <li>E muito mais.</li>
                                                            </ul>
                                                        </div>
                                                    </textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="conteudoTipo2" class="tipo">
                                            <div class="form-group mb-3 text-left">
                                                <label class="" for="inputAudioNovoConteudo">Clique para fazer upload de um novo aúdio</label>
                                                <br>
                                                <div class="upload-btn-wrapper">
                                                    <button class="btn btn-lg bg-bluelight text-dark file-name">Selecionar arquivo</button>
                                                    <input type="file" name="arquivoAudio" id="inputAudioNovoConteudo" onchange="mudouArquivoInput(this);"  accept="audio/*" />
                                                </div>
                                            </div>
                                            <div class="form-group mb-3 text-left">
                                                <label class="font-weight-bold" for="txtAudioNovoConteudo">Ou digite o link</label>
                                                <input type="text" class="form-control" name="conteudoAudio" id="txtAudioNovoConteudo" placeholder="Clique para digitar.">
                                            </div>
                                        </div>
                                        <div id="conteudoTipo3" class="tipo">
                                            <div class="form-group mb-3 text-left">
                                                <label class="font-weight-bold" for="inputVideoNovoConteudo">Clique para fazer upload de um novo vídeo</label>
                                                <br>
                                                <div class="upload-btn-wrapper">
                                                    <button class="btn btn-lg bg-bluelight text-dark file-name">Selecionar arquivo</button>
                                                    <input type="file" name="arquivoVideo" id="inputVideoNovoConteudo" onchange="mudouArquivoInput(this);"  accept="video/*" />
                                                </div>
                                            </div>
                                            <div class="form-group mb-3 text-left">
                                                <label class="font-weight-bold" for="txtVideoNovoConteudo">Ou digite o link</label>
                                                <input type="text" class="form-control" name="conteudoVideo" id="txtVideoNovoConteudo" placeholder="Clique para digitar.">
                                            </div>
                                            <div class="form-group mb-3 text-left" hidden>
                                                <label class="">Preview:</label>
                                                <iframe class="d-block" src="https://www.youtube.com/embed/NpEaa2P7qZI" frameborder="0" allow="encrypted-media" style="width: 40vw;height: 25vw;max-width: 1040px;max-height: 586px;"></iframe>
                                            </div>
                                        </div>
                                        <div id="conteudoTipo4" class="tipo">
                                            <div class="form-group mb-3 text-left">
                                                <label class="" for="inputSlideNovoConteudo">Clique para fazer upload de um novo slide (Powerpoint, PDF)</label>
                                                <br>
                                                <div class="upload-btn-wrapper">
                                                    <button class="btn btn-lg bg-bluelight text-dark file-name">Selecionar arquivo</button>
                                                    <input type="file" name="arquivoSlide" id="inputSlideNovoConteudo" onchange="mudouArquivoInput(this);"  accept="application/vnd.ms-powerpoint, application/vnd.openxmlformats-officedocument.presentationml.slideshow, application/vnd.openxmlformats-officedocument.presentationml.presentation, .pps, .pptx, .pdf" />
                                                </div>
                                            </div>
                                            <div class="form-group mb-3 text-left">
                                                <label class="font-weight-bold" for="txtSlideNovoConteudo">Ou digite o link</label>
                                                <input type="text" class="form-control" name="conteudoSlide" id="txtSlideNovoConteudo" placeholder="Clique para digitar.">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mb-3 text-left">
                                        <label class="" for="cmbVisibilidadeNovoConteudo">Visibilidade do conteúdo</label>
                                        <select id="cmbVisibilidadeNovoConteudo" name="visibilidade" required class="custom-select rounded">
                                            <option disabled selected>Selecione uma visibilidade</option>
                                            <option value="0">Não listado</option>
                                            <option value="1">Listado</option>
                                        </select>
                                    </div>

                                    <div class="form-group mb-3 text-left">
                                        <label class="" for="cmbStatusNovoConteudo">Status do conteúdo</label>
                                        <select id="cmbStatusNovoConteudo" name="status" required class="custom-select rounded">
                                            <option disabled selected>Selecione um status</option>
                                            <option value="0">Não publicado</option>
                                            <option value="1">Publicado</option>
                                        </select>
                                    </div>

                                    <div class="form-group mb-3 text-left">
                                        <label class="" for="cmbLiberadaNovoConteudo">Aplicação liberada</label>
                                        <select id="cmbLiberadaNovoConteudo" name="liberada" required class="custom-select rounded">
                                            <option disabled selected>Selecione o acesso</option>
                                            <option value="0">Acesso mediante permissão</option>
                                            <option value="1">Acesso liberado à todos</option>
                                        </select>
                                    </div>

                                    <div class="form-group mb-3 text-left" hidden>
                                        <label class="" for="txtFonteNovoConteudo">Fonte do conteúdo <small>(opcional)</small></label>
                                        <textarea class="form-control" name="fonte" id="txtFonteNovoConteudo" rows="2" placeholder="Clique para digitar."></textarea>
                                    </div>

                                    <div class="form-group mb-3 text-left" hidden>
                                        <label class="" for="txtAutoresNovoConteudo">Autores do conteúdo <small>(opcional)</small></label>
                                        <textarea class="form-control" name="autores" id="txtAutoresNovoConteudo" rows="2" placeholder="Clique para digitar."></textarea>
                                    </div>

                                    <div class="row">
                                        <button type="button" data-dismiss="modal" class="btn btn-lg btn-block outline-button mt-4 mb-0 col-4 ml-auto mr-4 font-weight-bold">Cancelar</button>
                                        <button type="button" onclick="salvarEdicaoConteudo();" class="btn btn-lg bg-bluelight btn-block signin-button mt-4 mb-0 col-4 ml-4 mr-auto text-dark font-weight-bold">Salvar</button>
                                    </div>

                                </div>

                            </div>

                        </form>

                    </div>

                </div>
            </div>
        </div>
        <!-- Fim modal editar conteudo --> --}}

        <!-- Modal Instruçoes aplicação -->
        <div class="modal fade" id="divModalInstrucoesAplicacao" tabindex="-1" role="dialog" aria-labelledby="divModalInstrucoesAplicacao" aria-hidden="true" style="z-index: 99999999; background: #000000c4;">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <button type="button" class="close ml-auto mr-2" onclick="$('#divModalInstrucoesAplicacao').modal('hide');">
                        <span aria-hidden="true">&times;</span>
                    </button>

                    <div class="modal-body border-0">
                        <h5 class="modal-title text-center mb-4">
                            Instruções para enviar aplicação
                        </h5>
                        <p class="text-justify">
                            Para enviar uma nova aplicação à plataforma você deve exportar a aplicação desenvolvida em unity para WebGL,
                            para facilitar o processo realize uma build dentro de uma pasta nomeada 'aplicacao',
                            desta maneira ao fim do processo de build a unity você devera conter uma pasta chamada 'aplicacao' e dentro dela uma pasta chamda 'Build'.
                            Você deve anexar um .zip dos arquivos que estão dentro da pasta 'Build'.
                        </p>
                        <p class="text-justify">
                            Os arquivos dentro da pasta 'Build', que estarão dentro do .zip anexado deverão se parecer com esta imagem:
                        </p>
                        <img src="{{ env('APP_LOCAL') }}/images/unity-arquivos-exemplo.jpg" width="100%" height="auto" alt="" style="max-width: 230px;">
                        <p class="text-justify">
                            E o arquivo 'aplicacao.json' deve ter seu conteúdo parecido com a imagem a seguir:
                        </p>
                        <img src="{{ env('APP_LOCAL') }}/images/unity-json-exemplo.jpg" width="100%" height="auto" alt="" style="max-width: 420px;">
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" onclick="$('#divModalInstrucoesAplicacao').modal('hide');" class="btn btn-primary">
                            Entendi
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fim modal Instruçoes aplicação -->

        <!-- Modal Editar Aplicacao -->
        <div class="modal fade" id="divModalEditarAplicacao" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog modal-dialog-centered modal-md px-1 px-md-5" role="document">
                <div class="modal-content bg-card">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                        <form id="formEditarAplicacao" method="POST" action="{{ route('gestao.aplicacao-salvar') }}" enctype="multipart/form-data" class="text-center px-3 shadow-none border-0">

                            @csrf

                            <div id="divEnviando" class="text-center d-none">
                                <i class="fas fa-spinner fa-pulse fa-3x text-primary mb-3"></i>
                                <h4>Enviando</h4>
                            </div>

                            <div id="divEditar" class="form-page">

                                <div id="page1" class="form-page">

                                    <h4 class="mb-4">Editar aplicação</h4>

                                    <input type="hidden" name="idAplicacao" value="">

                                    <label for="capa" id="divFileInputCapa" class="file-input-area input-capa bg-dark text-primary border border-primary mt-3 mb-5 w-100 text-center" style="">
                                        <input type="file" class="custom-file-input" id="capa" name="capa" style="top: 0px;height:  100%;position:  absolute;left:  0px;" accept="image/jpg, image/jpeg, image/png" oninput="mudouArquivoCapa(this);">

                                        <h6 id="placeholder" class="">
                                            <i class="far fa-image fa-2x text-primary d-block mb-2 w-100" style="vertical-align: sub;"></i>
                                            CAPA DA APLICAÇÃO
                                            <small class="text-uppercase text-primary d-block small mt-2 mx-auto w-50" style="font-size:  70%;">
                                                (Arraste o arquivo para esta área ou clique para alterar)
                                            </small>
                                            <small class="text-uppercase text-primary d-block small mt-2 mx-auto w-50" style="font-size:  70%;">
                                                Opcional
                                            </small>
                                        </h6>
                                        <h5 id="file-name" class="float-left text-primary d-none font-weight-bold" style="margin-top: 145px;margin-left:  10px;margin-bottom:  20px;">
                                        </h5>
                                    </label>

                                    <div class="form-group mb-3 text-left">
                                        <label class="" for="txtTituloEditarAplicacao">Título da aplicação</label>
                                        <input type="text" class="form-control" name="titulo" id="txtTituloEditarAplicacao" placeholder="Clique para digitar." required>
                                    </div>

                                    <div class="form-group mb-3 text-left">
                                        <label class="" for="txtDescricaoEditarAplicacao">Descrição da aplicação <small>(opcional)</small></label>
                                        <textarea class="form-control" name="descricao" id="txtDescricaoEditarAplicacao" rows="3" placeholder="Clique para digitar."></textarea>
                                    </div>

                                    <button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#divModalInstrucoesAplicacao">
                                        Instruções para envio de aplicação
                                    </button>

                                    <label for="file" class="custom-file-area btn btn-outline border-thin text-primary bg-transparent d-block py-2 mt-4 mb-3 text-center text-truncate" style="">
                                        <input type="file" class="custom-file-input" id="arquivo" name="arquivo" accept="application/zip" oninput="enviouArquivo(this);">
                                        <h6 class="m-0 text-truncate" id="placeholder">
                                            <i class="fas fa-plus fa-fw mr-2"></i>
                                            CLIQUE PARA ANEXAR A APLICAÇÃO
                                        </h6>
                                        <h6 class="m-0 file-name text-truncate d-none">
                                            nome-do-arquivo.zip
                                        </h6>
                                    </label>

                                    <div class="form-group mb-3 text-left">
                                        <label class="" for="cmbVisibilidadeEditarAplicacao">Visibilidade da aplicação</label>
                                        <select id="cmbVisibilidadeEditarAplicacao" name="visibilidade" required class="custom-select rounded">
                                            <option disabled>Selecione uma visibilidade</option>
                                            <option value="0">Não listado</option>
                                            <option value="1">Listado</option>
                                        </select>
                                    </div>

                                    <div class="form-group mb-3 text-left">
                                        <label class="" for="cmbStatusEditarAplicacao">Status da aplicação</label>
                                        <select id="cmbStatusEditarAplicacao" name="status" required class="custom-select rounded">
                                            <option disabled>Selecione um status</option>
                                            <option value="0">Não publicado</option>
                                            <option value="1">Publicado</option>
                                        </select>
                                    </div>

                                    <div class="form-group mb-3 text-left">
                                        <label class="" for="cmbLiberadaEditarAplicacao">Acesso da aplicação</label>
                                        <select id="cmbLiberadaEditarAplicacao" name="liberada" required class="custom-select rounded">
                                            <option disabled>Selecione o acesso</option>
                                            <option value="0">Acesso mediante permissão</option>
                                            <option value="1">Acesso liberado à todos</option>
                                        </select>
                                    </div>

                                    <div class="row mb-2">
                                        <button type="button" data-dismiss="modal" class="btn btn-danger mt-4 mb-0 col-4 ml-auto mr-4 font-weight-bold">Cancelar</button>
                                        <button type="button" onclick="salvarEdicaoAplicacao();" class="btn btn-primary mt-4 mb-0 col-4 ml-4 mr-auto font-weight-bold">Salvar</button>
                                    </div>

                                </div>

                            </div>

                        </form>

                    </div>

                </div>
            </div>
        </div>
        <!-- Fim modal editar aplicação -->

    </div>

</main>

@endsection

@section('bodyend')

    <!-- Bootstrap Datepicker JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/locales/bootstrap-datepicker.pt-BR.min.js"></script>

    <!-- Summernote css/js -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/lang/summernote-pt-BR.min.js" crossorigin="anonymous"></script>


    <script>

        $('#txtDatePicker').datepicker({
            weekStart: 0,
            language: "pt-BR",
            daysOfWeekHighlighted: "0,6",
            autoclose: true,
            todayHighlight: true
        });

        $( document ).ready(function()
        {
            $('.summernote').summernote({
                placeholder: "Clique para digitar.",
                lang: 'pt-BR',
                airMode: false,
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['fontsize', 'color']],
                    ['font', ['fontname']],
                    ['para', ['paragraph']],
                    ['insert', ['hr', 'picture', 'video', 'link', 'table', 'image', 'doc']],
                    ['misc', ['undo', 'redo', 'codeview', 'fullscreen', 'help']],
                ],
                popover: {
                    image: [
                        ['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],
                        ['float', ['floatLeft', 'floatRight', 'floatNone']],
                        ['remove', ['removeMedia']]
                    ],
                    link: [
                        ['link', ['linkDialogShow', 'unlink']]
                    ],
                    air: [
                        ['style', ['style']],
                        ['font', ['bold', 'italic', 'underline', 'clear']],
                        ['font', ['fontsize', 'color']],
                        ['font', ['fontname']],
                        ['para', ['paragraph']],
                        ['table', ['table']],
                        ['insert', ['hr', 'picture', 'video', 'link', 'table', 'image', 'doc']],
                        ['misc', ['undo', 'redo']],
                    ],
                },
            });

            $('.summernote-airmode').summernote({
                placeholder: "Clique para digitar.",
                lang: 'pt-BR',
                airMode: true,
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['fontsize', 'color']],
                    ['font', ['fontname']],
                    ['para', ['paragraph']],
                    ['insert', ['hr', 'picture', 'video', 'link', 'table', 'image', 'doc']],
                    ['misc', ['undo', 'redo', 'codeview', 'fullscreen', 'help']],
                ],
                popover: {
                    image: [
                        ['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],
                        ['float', ['floatLeft', 'floatRight', 'floatNone']],
                        ['remove', ['removeMedia']]
                    ],
                    link: [
                        ['link', ['linkDialogShow', 'unlink']]
                    ],
                    air: [
                        ['style', ['style']],
                        ['font', ['bold', 'italic', 'underline', 'clear']],
                        ['font', ['fontsize', 'color']],
                        ['font', ['fontname']],
                        ['para', ['paragraph']],
                        ['table', ['table']],
                        ['insert', ['hr', 'picture', 'video', 'link', 'table', 'image', 'doc']],
                        ['misc', ['undo', 'redo']],
                    ],
                },
            });
        });

        function showNovoConteudo(tipo)
        {
            $("#divModalNovoConteudo").modal({ keyboard: false, backdrop: 'static' });
            $("#divModalNovoConteudo #divLoading").addClass('d-none');
            $("#divModalNovoConteudo #divEnviando").addClass('d-none');
            $("#divModalNovoConteudo #divEditar").removeClass('d-none');

            $("#divModalNovoConteudo .tipos-conteudo .tipo").addClass('d-none');

            $("#divModalNovoConteudo .tipos-conteudo").find('#conteudoTipo' + tipo).removeClass('d-none');

            $("#divModalNovoConteudo [name='tipo']").val(tipo);

            $("#divModalNovoConteudo [name='titulo']").val('');
            $("#divModalNovoConteudo [name='descricao']").val('');
            $("#divModalNovoConteudo [name='obrigatorio']").prop('checked', true);
            $("#divModalNovoConteudo [name='tempo']").val('');

            switch(tipo)
            {
                case 1:
                    $("#lblTipoNovoConteudo").text("Novo conteúdo livre");
                    $("#formNovoConteudo #txtConteudo").summernote('code',`<div style="color: #525870;font-weight: bold;font-size: 16px;">
                        <p>Esta é a área de edição de conteúdo misto, clique aqui para começar a editar.</p>
                        <ul>
                            <li>Aqui você pode escrever artigos.</li>
                            <li>Colocar imagens, vídeos, tabelas.</li>
                            <li>Personalizar o texto da forma como desejar.</li>
                            <li>E muito mais.</li>
                        </ul>
                    </div>`);
                break;
                case 2:
                    $("#lblTipoNovoConteudo").text("Novo conteúdo de aúdio");
                break;
                case 3:
                    $("#lblTipoNovoConteudo").text("Novo conteúdo de vídeo");
                break;
                case 4:
                    $("#lblTipoNovoConteudo").text("Novo conteúdo de slide");
                break;
                case 5:
                    $("#lblTipoNovoConteudo").text("Novo conteúdo de transmissão ao vivo");
                break;
                case 6:
                    $("#lblTipoNovoConteudo").text("Novo conteúdo de upload");
                break;
                case 7:
                    $("#lblTipoNovoConteudo").text("Novo conteúdo de questão dissertativa");
                break;
                case 8:
                    $("#lblTipoNovoConteudo").text("Novo conteúdo de multipla escolha");
                break;
                case 9:
                    $("#lblTipoNovoConteudo").text("Novo conteúdo de prova");
                break;
                case 10:
                    $("#lblTipoNovoConteudo").text("Novo conteúdo entregável");
                break;
                case 11:
                    $("#lblTipoNovoConteudo").text("Novo conteúdo livro digital");
                break;
                default:
                    $("#lblTipoNovoConteudo").text("Novo conteúdo livre");
                break;
            }

            $("#divModalNovoConteudo [name='titulo']").focus();
        }


        function salvarConteudo()
        {
            console.log("Salvar novo conteudo");

            var isValid = true;

            $('#divModalNovoConteudo input').each(function() {
                if ( $(this).val() === '' && $(this).attr('required') )
                {
                    console.log("Campo obrigatório: ", this);

                    $(this).focus();

                    isValid = false;
                }
            });

            //if($('#divModalNovoConteudo .summernote').summernote('code') == '' && $("#divModalNovoConteudo .tipos-conteudo").find('#conteudoTipo1').hasClass('d-none') == false)
                //return;

            if(!isValid)// || $("#divModalNovoConteudo textarea").html() == '')
                return;

            $("#formNovoConteudo").submit();

            $("#divModalNovoConteudo #divLoading").addClass('d-none');
            $("#divModalNovoConteudo #divEditar").addClass('d-none');
            $("#divModalNovoConteudo #divEnviando").removeClass('d-none');

            $("#divModalNovoConteudo #divLoading").addClass('d-none');
            $("#divModalNovoConteudo #divEditar").addClass('d-none');
            $("#divModalNovoConteudo #divEnviando").removeClass('d-none');
        }

        function editarConteudo(idConteudo)
        {
            $("#divModalEditarConteudo").modal({ keyboard: false, backdrop: 'static' });
            $("#divModalEditarConteudo #divLoading").removeClass('d-none');
            $("#divModalEditarConteudo #divEditar").addClass('d-none');
            $("#divModalEditarConteudo #divEnviando").addClass('d-none');

            $("#divModalEditarConteudo .form-page").addClass('d-none');
            $("#divModalEditarConteudo #page1").removeClass('d-none');

            $.ajax({
                url: appurl + '/gestao/conteudos/' + idConteudo + '/editar',
                type: 'get',
                dataType: 'json',
                success: function( _response )
                {
                    console.log( _response );

                    if(_response.success)
                    {
                        _response.conteudo = JSON.parse(_response.conteudo);

                        $("#divModalEditarConteudo .tipos-conteudo .tipo").addClass('d-none');

                        $("#divModalEditarConteudo .tipos-conteudo").find('#conteudoTipo' + _response.conteudo.tipo).removeClass('d-none');

                        var tipo = parseInt(_response.conteudo.tipo);

                        switch(tipo)
                        {
                            case 1:
                                $("#divModalEditarConteudo #lblTipoConteudo").text("Editando conteúdo livre");
                                $("#formEditarConteudo #txtConteudo").summernote('code',_response.conteudo.conteudo);
                            break;

                            case 2:
                                $("#divModalEditarConteudo #lblTipoConteudo").text("Editando conteúdo de aúdio");
                                if(_response.conteudo.temArquivo)
                                {
                                    $("#divVerArquivoAtual").removeClass('d-none');
                                    $("#btnVerArquivoAtual").attr('href', '{{ env("APP_LOCAL") }}/play/' + _response.conteudo.id + '/arquivo');
                                    $("#divModalEditarConteudo [name='conteudoAudio']").val();
                                }
                                else
                                {
                                    $("#divVerArquivoAtual").addClass('d-none');
                                    $("#btnVerArquivoAtual").attr('href', '#');
                                    $("#divModalEditarConteudo [name='conteudoAudio']").val(_response.conteudo.conteudo);
                                }
                                console.log($("#divModalEditarConteudo [name='conteudoAudio']").length)
                                console.log($("#divModalEditarConteudo [name='conteudoAudio']").val())
                            break;

                            case 3:
                                $("#divModalEditarConteudo #lblTipoConteudo").text("Editando conteúdo de vídeo");
                                if(_response.conteudo.temArquivo)
                                {
                                    $("#divVerArquivoAtual").removeClass('d-none');
                                    $("#btnVerArquivoAtual").attr('href', '{{ env("APP_LOCAL") }}/play/' + _response.conteudo.id + '/arquivo');
                                    $("#divModalEditarConteudo [name='conteudoVideo']").val();
                                }
                                else
                                {
                                    $("#divVerArquivoAtual").addClass('d-none');
                                    $("#btnVerArquivoAtual").attr('href', '#');
                                    $("#divModalEditarConteudo [name='conteudoVideo']").val(_response.conteudo.conteudo);
                                }
                            break;

                            case 4:
                                $("#divModalEditarConteudo #lblTipoConteudo").text("Editando conteúdo de slide");
                                if(_response.conteudo.temArquivo)
                                {
                                    $("#divVerArquivoAtual").removeClass('d-none');
                                    $("#btnVerArquivoAtual").attr('href', '{{ env("APP_LOCAL") }}/play/' + _response.conteudo.id + '/arquivo');
                                    $("#divModalEditarConteudo [name='conteudoSlide']").val();
                                }
                                else
                                {
                                    $("#divVerArquivoAtual").addClass('d-none');
                                    $("#btnVerArquivoAtual").attr('href', '#');
                                    $("#divModalEditarConteudo [name='conteudoSlide']").val(_response.conteudo.conteudo);
                                }
                            break;

                            case 5:
                                $("#divModalEditarConteudo #lblTipoConteudo").text("Editando conteúdo de transmissão ao vivo");
                                $("#divModalEditarConteudo [name='conteudoTransmissao']").val(_response.conteudo.conteudo);
                            break;

                            case 6:
                                $("#divModalEditarConteudo #lblTipoConteudo").text("Editando conteúdo de upload");
                                if(_response.conteudo.temArquivo)
                                {
                                    $("#divVerArquivoAtual").removeClass('d-none');
                                    $("#btnVerArquivoAtual").attr('href', '{{ env("APP_LOCAL") }}/play/' + _response.conteudo.id + '/arquivo');
                                    $("#divModalEditarConteudo [name='conteudoArquivo']").val();
                                }
                                else
                                {
                                    $("#divVerArquivoAtual").addClass('d-none');
                                    $("#btnVerArquivoAtual").attr('href', '#');
                                    $("#divModalEditarConteudo [name='conteudoArquivo']").val(_response.conteudo.conteudo);
                                }
                            break;

                            case 7:
                                $("#divModalEditarConteudo #lblTipoConteudo").text("Editando conteúdo de questão dissertativa");
                                _response.conteudo.conteudo = JSON.parse(_response.conteudo.conteudo);
                                $("#divModalEditarConteudo [name='conteudoDissertativa']").val(_response.conteudo.conteudo.pergunta);
                                $("#divModalEditarConteudo [name='conteudoDissertativaDica']").val(_response.conteudo.conteudo.dica);
                                $("#divModalEditarConteudo [name='conteudoDissertativaExplicacao']").val(_response.conteudo.conteudo.explicacao);
                            break;

                            case 8:
                                $("#divModalEditarConteudo #lblTipoConteudo").text("Editando conteúdo de multipla escolha");
                                _response.conteudo.conteudo = JSON.parse(_response.conteudo.conteudo);
                                $("#divModalEditarConteudo [name='conteudoQuiz']").val(_response.conteudo.conteudo.pergunta);
                                $("#divModalEditarConteudo #rdoAlternativa" + _response.conteudo.conteudo.correta).prop("checked", true);
                                $("#divModalEditarConteudo [name='conteudoQuizAlternativa1']").val(_response.conteudo.conteudo.alternativas[0]);
                                $("#divModalEditarConteudo [name='conteudoQuizAlternativa2']").val(_response.conteudo.conteudo.alternativas[1]);
                                $("#divModalEditarConteudo [name='conteudoQuizAlternativa3']").val(_response.conteudo.conteudo.alternativas[2]);
                                $("#divModalEditarConteudo [name='conteudoQuizDica']").val(_response.conteudo.conteudo.dica);
                                $("#divModalEditarConteudo [name='conteudoQuizExplicacao']").val(_response.conteudo.conteudo.explicacao);
                            break;

                            case 9:
                                $("#divModalEditarConteudo #lblTipoConteudo").text("Editando conteúdo de prova");
                            break;

                            case 10:
                                $("#divModalEditarConteudo #lblTipoConteudo").text("Editando conteúdo entregável");
                                $("#formEditarConteudo #txtConteudoEntregavel").summernote('code',_response.conteudo.conteudo);
                            break;

                            case 11:
                                $("#divModalEditarConteudo #lblTipoConteudo").text("Editando conteúdo livro digital");
                                $("#formEditarConteudo #txtConteudoApostila").summernote('code',_response.conteudo.conteudo);
                            break;

                            default:
                                $("#divModalEditarConteudo #lblTipoConteudo").text("Editando conteúdo livre2");
                                $("#formEditarConteudo #txtConteudo").summernote('code',_response.conteudo.conteudo);
                            break;
                        }

                        $("#divModalEditarConteudo [name='idConteudo']").val(_response.conteudo.id);
                        $("#divModalEditarConteudo [name='tipo']").val(_response.conteudo.tipo);
                        $("#divModalEditarConteudo [name='titulo']").val(_response.conteudo.titulo);
                        $("#divModalEditarConteudo [name='obrigatorio']").prop("checked", _response.conteudo.obrigatorio);
                        if(_response.conteudo.tempo > 0)
                            $("#divModalEditarConteudo [name='tempo']").val(_response.conteudo.tempo);
                        else
                            $("#divModalEditarConteudo [name='tempo']").val("");

                        {{--  $("#divModalEditarConteudo [name='visibilidade']").val(_response.conteudo.visibilidade);  --}}
                        $("#divModalEditarConteudo [name='status']").val(_response.conteudo.status);

                        $("#divModalEditarConteudo [name='apoio']").val(_response.conteudo.apoio);
                        $("#divModalEditarConteudo [name='fonte']").val(_response.conteudo.fonte);
                        $("#divModalEditarConteudo [name='autores']").val(_response.conteudo.autores);

                        $("#divModalEditarConteudo #divLoading").addClass('d-none');
                        $("#divModalEditarConteudo #divEditar").removeClass('d-none');
                    }
                    else
                    {
                        swal("Ops!", _response.error, "error");

                        $("#divModalEditarConteudo").modal({ keyboard: false, backdrop: 'static' });
                    }
                },
                error: function( _response )
                {
                    console.log( _response );
                }
            });
        }

        function salvarEdicaoConteudo()
        {
            console.log("Salvar conteudo");

            var isValid = true;

            $('#divModalEditarConteudo input').each(function() {
                if ( $(this).val() === '' && $(this).attr('required') )
                {
                    console.log("Campo obrigatório: ", this);

                    $(this).focus();

                    isValid = false;
                }
            });

            {{-- if($('#divModalNovoConteudo .summernote').summernote('code') == '' && $("#divModalNovoConteudo .tipos-conteudo").find('#conteudoTipo1').hasClass('d-none') == false)
                return; --}}

            if(!isValid)// || $("#divModalNovoConteudo textarea").html() == '')
                return;

            {{-- if(!isValid || $("#divModalEditarConteudo textarea").html() == '')
            {
                return;
            } --}}

            $("#formEditarConteudo").submit();

            $("#divModalEditarConteudo #divLoading").addClass('d-none');
            $("#divModalEditarConteudo #divEditar").addClass('d-none');
            $("#divModalEditarConteudo #divEnviando").removeClass('d-none');

            $("#divModalEditarConteudo #divLoading").addClass('d-none');
            $("#divModalEditarConteudo #divEditar").addClass('d-none');
            $("#divModalEditarConteudo #divEnviando").removeClass('d-none');
        }

        function duplicarConteudo(id)
        {
            $("#formDuplicarConteudo #idConteudo").val(id);

            swal({
                title: 'Deseja mesmo duplicar?',
                text: "Você deseja mesmo duplicar este conteúdo?",
                icon: "warning",
                buttons: ['Não', 'Sim, duplicar!'],
            }).then((result) => {
                if (result == true)
                {
                  $("#formDuplicarConteudo").submit();
                }
            });
        }

        function excluirConteudo(idConteudo)
        {
            swal({
                title: "Excluir conteúdo",
                text: "Você deseja mesmo excluir esta conteúdo?",
                icon: "warning",
                buttons: ["Não", "Sim"],
                dangerMode: true,
            })
            .then((deletar) =>
            {
                if (deletar)
                {
                    $.ajax({
                        url: '{{ env('APP_LOCAL') }}' + '/gestao/conteudo/' + idConteudo + '/excluir',
                        type: 'post',
                        data: { '_token' : '{{ csrf_token() }}' },
                        dataType: 'json',
                        success: function( _response )
                        {
                            console.log( _response );

                            if(_response.success)
                            {
                                swal("Yeah!", _response.success, "success");

                                $( "#divConteudo" + idConteudo ).remove();
                            }
                            else
                            {
                                swal("Ops!", _response.error, "error");
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

        function editarAplicacao(idAplicacao)
        {
            $("#divModalEditarAplicacao").modal({ keyboard: false, backdrop: 'static' });
            $("#divModalEditarAplicacao #divLoading").removeClass('d-none');
            $("#divModalEditarAplicacao #divEditar").addClass('d-none');
            $("#divModalEditarAplicacao #divEnviando").addClass('d-none');

            $("#divModalEditarAplicacao .form-page").addClass('d-none');
            $("#divModalEditarAplicacao #page1").removeClass('d-none');

            $.ajax({
                url: appurl + '/gestao/aplicacao/' + idAplicacao + '/editar',
                type: 'get',
                dataType: 'json',
                success: function( _response )
                {
                    console.log( _response );

                    if(_response.success)
                    {
                        $("#divModalEditarAplicacao [name='idAplicacao']").val(_response.aplicacao.id);

                        if(_response.aplicacao.capa != "")
                        {
                            $("#divModalEditarAplicacao [id='divFileInputCapa']").attr('style', 'background-image: url(\'' + appurl + "/uploads/aplicacoes/capas/" + _response.aplicacao.capa + '\');background-size: contain;background-position: 50% 50%;background-repeat: no-repeat;');
                            $("#divModalEditarAplicacao [id='divFileInputCapa'] #placeholder").addClass('d-none');
                            $("#divModalEditarAplicacao [id='divFileInputCapa'] #file-name").removeClass('d-none');
                            $("#divModalEditarAplicacao [id='divFileInputCapa'] #file-name").text("Clique para alterar a foto de capa");
                        }
                        else
                        {
                            $("#divModalEditarAplicacao [id='divFileInputCapa']").attr('style', 'background-image: none;');
                            $("#divModalEditarAplicacao [id='divFileInputCapa'] #placeholder").removeClass('d-none');
                            $("#divModalEditarAplicacao [id='divFileInputCapa'] #file-name").addClass('d-none');
                        }

                        $("#divModalEditarAplicacao [name='titulo']").val(_response.aplicacao.titulo);
                        $("#divModalEditarAplicacao [name='descricao']").val(_response.aplicacao.descricao);
                        $("#divModalEditarAplicacao [name='visibilidade']").val(_response.aplicacao.visibilidade);
                        $("#divModalEditarAplicacao [name='status']").val(_response.aplicacao.status);
                        $("#divModalEditarAplicacao [name='liberada']").val(_response.aplicacao.liberada);

                        $("#divModalEditarAplicacao #divLoading").addClass('d-none');
                        $("#divModalEditarAplicacao #divEditar").removeClass('d-none');
                    }
                    else
                    {
                        swal("Ops!", _response.error, "error");

                        $("#divModalEditarAplicacao").modal({ keyboard: false, backdrop: 'static' });
                    }
                },
                error: function( _response )
                {
                    console.log( _response );
                }
            });
        }

        function salvarEdicaoAplicacao()
        {
            var isValid = true;

            $('#divModalEditarAplicacao input').each(function() {
                if ( $(this).val() === '' && $(this).attr('required') )
                {
                    $(this).focus();

                    isValid = false;
                }
            });

            if(!isValid || $("#divModalEditarAplicacao textarea").html() == '')
                return;

            $("#formEditarAplicacao").submit();

            $("#divModalEditarAplicacao #divLoading").addClass('d-none');
            $("#divModalEditarAplicacao #divEditar").addClass('d-none');
            $("#divModalEditarAplicacao #divEnviando").removeClass('d-none');

            $("#divModalEditarAplicacao #divLoading").addClass('d-none');
            $("#divModalEditarAplicacao #divEditar").addClass('d-none');
            $("#divModalEditarAplicacao #divEnviando").removeClass('d-none');
        }

        function excluirAplicacao(idAplicacao)
        {
            swal({
                title: "Excluir aplicação",
                text: "Você deseja mesmo excluir esta aplicação?",
                icon: "warning",
                buttons: ["Não", "Sim"],
                dangerMode: true,
            })
            .then((deletar) =>
            {
                if (deletar)
                {
                    $.ajax({
                        url: '{{ env('APP_LOCAL') }}' + '/gestao/aplicacao/' + idAplicacao + '/excluir',
                        type: 'post',
                        data: { '_token' : '{{ csrf_token() }}' },
                        dataType: 'json',
                        success: function( _response )
                        {
                            console.log( _response );

                            if(_response.success)
                            {
                                swal("Yeah!", _response.success, "success");

                                $( "#divAplicacao" + idAplicacao ).remove();
                            }
                            else
                            {
                                swal("Ops!", _response.error, "error");
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

    </script>

@endsection
