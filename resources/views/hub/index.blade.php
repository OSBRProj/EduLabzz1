@extends('layouts.master')

@section('title', 'Piaget + Digital')

@section('headend')

    <!-- Custom styles for this template -->
    <style>

        .card .tag
        {
            border-radius: 10px;
            padding: 3px 15px;
            color: white;
            font-weight: bold;
            {{-- background-color: #2FB8E6; --}}
            background-color: #F26F22;
            font-size: 13px;
            margin: 0px 8px 8px 8px;
            display: inline-block;
            text-transform: uppercase;
        }

        .text-primary
        {
            color: #F26F22 !important;
        }

        .carousel
        {
            height: 42vh;
            width: calc(100% - 40px);
            margin-bottom: 30px !important;
        }

        .carousel-inner, .carousel-item, .carousel-item > div
        {
            height: 100%;
        }

        .carousel-control-prev
        {
            max-width: 65px;
        }

        .carousel-indicators
        {
            bottom: -35px;
        }

        .carousel-indicators li
        {
            width: 70px;
            height: 8px;
            border-radius: 0px;
            background: transparent;
            border: 1px solid #fff;
        }

        .carousel-indicators li.active
        {
            background: #F26F22 !important;
            border: 1px solid #F26F22 !important;
        }

        .carousel-control-prev
        {
            left: -50px;
        }
        .carousel-control-next
        {
            right: -50px;
        }

        .carousel-control-holder
        {
            color: #F26F22;
        }

    </style>

@endsection

@section('content')

<main role="main" class="darkmode mr-0">

    <div class="container-fluid px-3">

        <div class="row justify-content-center">

            <div class="col-11 px-2 px-lg-0 mx-auto">

                <!-- SECTION APLICACOES -->
                <section>

                        <!-- CAROUSEL DESTAQUES -->
                        <div id="carouselCatalogo" class="carousel slide mx-auto my-auto" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselCatalogo" data-slide-to="0" class="active"></li>
                                @for ($i = 1; $i <= count($destaques); $i++)
                                    <li data-target="#carouselCatalogo" data-slide-to="{{ $i }}"></li>
                                @endfor
                            </ol>
                            <!-- CAROUSEL ITEMS -->
                            <div class="carousel-inner">
                                <div class="carousel-item active text-center">
                                    <img class="my-5" src="{{ env('APP_LOCAL') }}/images/gamer-icons.png" width="400px" alt="">

                                    <h3 class="text-white mx-auto text-center">
                                        Nada melhor do que aprender por meio de jogos!
                                        <small class="d-block mt-4">
                                            Além de prender a atenção dos pequenos os ajudarão a assimilar o conteúdo que precisa ser transmitido.
                                        </small>
                                    </h3>
                                </div>

                                @foreach ($destaques as $index => $destaque)

                                    <div class="carousel-item">
                                        <div class="card rounded mx-auto" style="background-image: url('{{ env('APP_LOCAL') . '/uploads/aplicacoes/capas/' .  $destaque->capa }}');background-size: cover; background-position: 50% 50%; background-repeat: no-repeat; border: 0px;">
                                            <div class="d-inline h-100 align-middle mt-auto" style="background: rgba(0, 0, 0, 0);z-index: 1;">
                                                <a class="text-decoration-none" href="{{ route('hub.aplicacao', ['idAplicacao' => $destaque->id]) }}">
                                                    <h4 class="w-100 text-white text-left p-4 m-0" style="position: absolute; bottom: 0px;background: rgba(0, 0, 0, 0.8);">
                                                        {{ ucfirst($destaque->titulo) }}
                                                        <p class="small mt-4 mb-0" style="font-size: 65%;">
                                                            {{ ucfirst(strlen($destaque->descricao) > 200 ? substr($destaque->descricao, 0, 200) . '.' : $destaque->descricao) }}
                                                        </p>
                                                    </h4>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                            </div>

                            <!-- CAROUSEL BUTTONS -->
                            <a class="carousel-control-prev" href="#carouselCatalogo" role="button" data-slide="prev">
                                <div class="carousel-control-holder mr-auto">
                                    <i class="fas fa-chevron-left fa-fw fa-2x"></i>
                                </div>
                            </a>
                            <a class="carousel-control-next" href="#carouselCatalogo" role="button" data-slide="next">
                                <div class="carousel-control-holder ml-auto" style="right: 0px; position: absolute;">
                                    <i class="fas fa-chevron-right fa-fw fa-2x"></i>
                                </div>
                            </a>
                        </div>
                        <!-- END CAROUSEL -->

                        <div class="py-2">
                            <div class="row">

                                <div class="col-12 col-md-10 mx-auto text-center">

                                    <h3 class="text-white mx-auto text-center">
                                        <small class="d-block font-weight-bold">
                                            Filtre os jogos por ano ou disciplina e divirta-se!
                                        </small>
                                    </h3>

                                    <div class="mt-5">
                                        <form action="" method="get">

                                            <div class="dropdown d-inline-block">
                                                <button class="btn dropdown-toggle w-auto border-0 text-uppercase bg-dark box-shadow font-weight-bold text-lighter" type="button" id="cmbLimite" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="    display: inline-block;
                                                width: auto !important;
                                                min-width: 280px;
                                                background-color: transparent !important;
                                                border: 2px solid #989AC1 !important;
                                                color: white;
                                                font-size: 18px;">
                                                    {{ \Request::has('categoria') && \Request::get('categoria') != "" ? \Request::get('categoria') : "Selecione uma categoria"  }}
                                                </button>
                                                <div class="dropdown-menu bg-dark" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item font-weight-bold text-lighter" href="{{ HelperClass::appendToUrl(['categoria' => '']) }}">Geral</a>
                                                    @foreach ($categorias as $categoria)
                                                        <a class="dropdown-item font-weight-bold text-lighter" href="{{ HelperClass::appendToUrl(['categoria' => $categoria->titulo]) }}">{{ ucfirst($categoria->titulo) }}</a>
                                                    @endforeach
                                                </div>
                                            </div>

                                            <div class="dropdown d-inline-block ml-2">
                                                <button class="btn dropdown-toggle w-auto border-0 text-uppercase bg-dark box-shadow font-weight-bold text-lighter" type="button" id="cmbLimite" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="    display: inline-block;
                                                width: auto !important;
                                                min-width: 280px;
                                                background-color: transparent !important;
                                                border: 2px solid #989AC1 !important;
                                                color: white;
                                                font-size: 18px;">
                                                    {{ \Request::has('marcador') && \Request::get('marcador') != "" ? \Request::get('marcador') : "Selecione um marcador"  }}
                                                </button>
                                                <div class="dropdown-menu bg-dark" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item font-weight-bold text-lighter" href="{{ HelperClass::appendToUrl(['marcador' => '']) }}">Nenhum</a>
                                                    @foreach ($marcadores as $marcador)
                                                        <a class="dropdown-item font-weight-bold text-lighter" href="{{ HelperClass::appendToUrl(['marcador' => $marcador]) }}">{{ ucfirst($marcador) }}</a>
                                                    @endforeach
                                                </div>
                                            </div>

                                            {{-- <select id="cmbCategoriaNovaAplicacao" name="categoria" required class="custom-select form-control-lg font-weight-bold border-0 mr-3 rounded" style="display: inline-block;
                                            width: auto;
                                            min-width: 280px;
                                            background: transparent;
                                            border: 2px solid #989AC1 !important;
                                            color: white;
                                            font-size: 16px;">
                                                <option selected value="1">Selecione uma categoria</option>
                                                <option value="1">Geral</option>
                                                @foreach ($categorias as $categoria)
                                                    <option value="{{ $categoria->id }}">{{ ucfirst($categoria->titulo) }}</option>
                                                @endforeach
                                            </select>

                                            <select id="cmbCategoriaNovaAplicacao" name="categoria" required class="custom-select form-control-lg font-weight-bold border-0 rounded" style="display: inline-block;
                                            width: auto;
                                            min-width: 280px;
                                            background: transparent;
                                            border: 2px solid #989AC1 !important;
                                            color: white;
                                            font-size: 16px;">
                                                <option selected value="1">Selecione uma categoria</option>
                                                <option value="1">Geral</option>
                                                @foreach ($marcadores as $marcardor)
                                                    <option value="{{ $marcardor }}">{{ ucfirst($marcardor) }}</option>
                                                @endforeach
                                            </select> --}}

                                            <button type="submit" class="btn btn-primary px-4 py-2 ml-3 text-uppercase font-weight-bold text-white rounded">
                                                Filtrar
                                            </button>

                                        </form>
                                    </div>

                                </div>

                            </div>
                        </div>

                    <!-- HEADER APLICACOES -->
                    <div class="row my-4">

                        <!-- RESULTADO DE BUSCAS/CATEGORIAS -->
                        <div class="col-12 col-md-10 col-lg-8 col-xl-6 text-center text-md-left mb-3 mb-md-0">
                            @if(Request::has('categoria'))
                                <h4 class="my-2">
                                    <i class="fas fa-folder-open text-primary small-2 align-middle text-shadow mr-2"></i>
                                    <span class="font-weight-bold text-bluegray align-middle">
                                            Principais atividades em "{{ ucfirst(Request::get('categoria')) }}"
                                    </span>
                                </h4>
                            @elseif(Request::has('marcador') && Request::get('marcador') != "")
                                <h4 class="my-2">
                                    <i class="fas fa-folder-open text-primary small-2 align-middle text-shadow mr-2"></i>
                                    <span class="font-weight-bold text-bluegray align-middle">
                                            Principais atividades marcadas em "{{ ucfirst(Request::get('marcador')) }}"
                                    </span>
                                </h4>
                            @elseif(Request::has('pesquisa'))
                                <h5 class="my-2">
                                    <span class="font-weight-bold text-bluegray align-middle">Buscando por:</span>
                                    <span class="font-weight-bold text-bluegray bg-primary align-middle" style="color:  white;border-radius:  25px;padding:  8px 30px;margin:  0px 10px;">
                                        "{{ ucfirst(Request::get('pesquisa')) }}"
                                        <a href="?" class="text-white ml-2">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    </span>
                                </h5>
                            @endif
                        </div>
                        <!-- END RESULTADO DE BUSCAS/CATEGORIAS -->

                        @if(Request::has('categoria') || Request::has('pesquisa'))
                            <div class="col-md-6 mb-2 text-center text-md-right">
                                <div class="dropdown">
                                    <label for="cmbLimite" class="h6 mr-2 font-weight-bold text-lighter">Mostrar</label>
                                    <button class="btn dropdown-toggle w-auto border-0 bg-dark box-shadow font-weight-bold text-lighter" type="button" id="cmbLimite" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ $amount }}
                                    </button>
                                    <div class="dropdown-menu bg-dark" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item font-weight-bold text-lighter" href="{{ HelperClass::appendToUrl(['qt' => '10']) }}">10</a>
                                        <a class="dropdown-item font-weight-bold text-lighter" href="{{ HelperClass::appendToUrl(['qt' => '15']) }}">15</a>
                                        <a class="dropdown-item font-weight-bold text-lighter" href="{{ HelperClass::appendToUrl(['qt' => '20']) }}">20</a>
                                        <a class="dropdown-item font-weight-bold text-lighter" href="{{ HelperClass::appendToUrl(['qt' => '35']) }}">35</a>
                                    </div>
                                    <label for="cmbLimite" class="h6 ml-2 font-weight-bold text-lighter">por página</label>
                                </div>
                            </div>
                        @endif

                        <div class="col-md-6 text-right" hidden>
                            <button class="btn btn-classic active text-uppercase m-1">
                                Categoria
                            </button>
                            <button class="btn btn-classic text-uppercase m-1">
                                Instrutor
                            </button>
                            <button class="btn btn-classic text-uppercase m-1">
                                Carreira
                            </button>
                        </div>
                    </div>
                    <!-- END HEADER -->

                    <div class="py-2">
                        <div class="row">
                            @foreach ($aplicacoes as $aplicacao)

                                <div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-3">
                                    <a href="{{ route('hub.aplicacao', ['idAplicacao' => $aplicacao->id]) }}" class="card rounded-10 text-decoration-none h-100 bg-transparent border-0" style="display: flex;flex-direction: column;">
                                        <div class="card-img-auto bg-dark" style="background-image: url('{{ env('APP_LOCAL') . '/uploads/aplicacoes/capas/' .  $aplicacao->capa }}');background-size: cover;background-position: 50% 50%;background-repeat: no-repeat;box-shadow: none;border-radius: 10px 10px 0px 0px;flex: 1;min-height: 192px;">
                                        </div>
                                        <div class="pt-2 pb-3 px-4 font-weight-bold" style="background-color: #0D0D0D;color: white;font-size: 16px;box-shadow: none;border-radius: 0px 0px 10px 10px;flex: 0.3;">
                                            <span class="d-block my-2" style="color: #C8CEDF;">
                                                {{ ucfirst($aplicacao->titulo) }}
                                            </span>
                                            @if($aplicacao->categoria != null)
                                                <span class="text-uppercase" style="color: #828BAB;">
                                                    {{ $aplicacao->categoria->titulo }}
                                                </span>
                                            @endif
                                            @if($aplicacao->tags != null && count($aplicacao->tags) > 0)
                                            @foreach ($aplicacao->tags as $marcador)
                                                @if($marcador != "")
                                                    <span class="tag">
                                                        {{ ucfirst($marcador) }}
                                                    </span>
                                                @endif
                                            @endforeach
                                            @endif
                                        </div>
                                    </a>
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

                </section>

                <div class="py-2">
                    <div class="row text-center">

                        {{-- <button onclick="carregarMaisAplicacoes();" class="btn btn-link mx-auto text-primary font-weight-bold text-uppercase">Carregar mais</button> --}}

                    </div>
                </div>


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

    </script>

@endsection
