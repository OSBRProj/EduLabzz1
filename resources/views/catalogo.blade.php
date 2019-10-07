@extends('layouts.master')

@section('title', 'J. PIAGET - Catálogo')

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
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: transparent;
            border: 1px solid #fff;
        }

        .carousel-indicators li.active
        {
            background: #207adc;
            border: 1px solid #207adc;
        }

    </style>

    <link rel="stylesheet" href="{{ env('APP_LOCAL') }}/assets/css/custom-carousel.css">

@endsection

@section('content')

<main role="main" class="mr-0">

    <div class="container">


        <div class="row">


        <div class="col-12 col-md-11 mx-auto">

            {{-- <!-- BOTAO FILTRO -->
            <div class="text-right my-4">
                <button class="btn btn-classic">
                    <i class="fas fa-filter px-2"></i>
                    <i class="fas fa-chevron-down"></i>
                </button>
            </div> --}}

            @if(!Request::has('categoria') && !Request::has('pesquisa'))

                <!-- SECTION DESTAQUES -->

                    <!-- HEADER DESTAQUES -->

                    <div class="col-12 mb-3 title pl-0">
                        <h2 class="text-left"><i class="fas fa-star small align-middle mr-2"></i> Destaques</h2>
                    </div>

                    <div class="col-md-6 text-right" hidden>
                        <button class="btn btn-classic active text-uppercase m-1">
                            Mais vendidos
                        </button>
                        <button class="btn btn-classic text-uppercase m-1">
                            Do mês
                        </button>
                        <button class="btn btn-classic text-uppercase m-1">
                            Da semana
                        </button>
                    </div>
                    <!-- END HEADER -->

                    <!-- CAROUSEL DESTAQUES -->
                    <div id="carouselCatalogo" class="carousel slide mx-auto my-auto" data-ride="carousel">
                        <ol class="carousel-indicators">
                            @for ($i = 0; $i < count($destaques); $i++)
                                <li data-target="#carouselCatalogo" data-slide-to="{{ $i }}"></li>
                            @endfor
                        </ol>
                        <!-- CAROUSEL ITEMS -->
                        <div class="carousel-inner">
                            @foreach ($destaques as $index => $destaque)

                                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                    <div class="d-block text-center">

                                        <div class="card rounded mx-auto" style="background-image: url('{{ env('APP_LOCAL') . '/uploads/aplicacoes/capas/' .  $destaque->capa }}');background-size: cover; background-position: 50% 50%; background-repeat: no-repeat; border: 0px;">
                                            {{--  <div class="" style="background: linear-gradient(rgba(55, 62, 70, 0.1), rgba(0, 3, 19, 0.5)); margin: 0px; border-radius: 10px 10px 0px 0px; height: 100%;position: absolute; width: 100%; border-radius: 10px;">
                                            </div>  --}}
                                            <div class="d-inline align-middle mt-auto" style="background: rgba(0, 0, 0, .8);z-index: 1;">
                                                    <a class="text-decoration-none" href="{{ route('hub.aplicacao', ['idAplicacao' => $destaque->id]) }}">
                                                        <h4 class="text-white text-left p-4 m-0 mx-3">
                                                            {{ ucfirst($destaque->titulo) }}
                                                            <p class="small mt-4 mb-0" style="font-size: 65%;">
                                                                {{ strlen(ucfirst($destaque->descricao)) > 50 ? substr(ucfirst($destaque->descricao), 0, 50) . "." : ucfirst($destaque->descricao) }}
                                                            </p>
                                                        </h4>
                                                    </a>
                                                </div>
                                        </div>

                                    </div>
                                </div>

                            @endforeach
                        </div>

                        <!-- CAROUSEL BUTTONS -->
                        <a class="carousel-control-prev" href="#carouselCatalogo" role="button" data-slide="prev">
                            <div class="carousel-control-holder mr-auto">
                                <i class="fas fa-chevron-left"></i>
                            </div>
                        </a>
                        <a class="carousel-control-next" href="#carouselCatalogo" role="button" data-slide="next">
                            <div class="carousel-control-holder ml-auto" style="right: 0px; position: absolute;">
                                <i class="fas fa-chevron-right"></i>
                            </div>
                        </a>
                    </div>
                    <!-- END CAROUSEL -->

                    <!-- BARRA VER TODOS - SEPARADOR -->
                    {{--  <div class="text-center text-uppercase my-4 mx-auto">
                        <div class="row mx-auto">
                            <div class="separator-bar bar-left"></div>
                            <a href="#" class="font-weight-bold"> Ver todos </a>
                            <div class="separator-bar bar-right"></div>
                        </div>
                    </div>  --}}

                <!-- END SECTION DESTAQUES -->

                {{--  <!-- SECTION CATEGORIAS -->
                <section class="pb-4">

                    <!-- HEADER CATEGORIAS -->
                    <div class="row my-4">
                        <div class="col-md-12">
                            <h4 class="my-2">
                                <i class="fas fa-folder-open text-primary small-2 align-middle text-shadow mr-2"></i>
                                <span class="font-weight-bold text-bluegray align-middle">Categorias</span>
                            </h4>
                        </div>
                    </div>
                    <!-- END HEADER -->

                    <div class="py-6">
                        <div class="row">
                            @foreach ($categorias as $categoria)

                                <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-2">
                                    <a href="{{ route('catalogo', ['categoria' => $categoria->titulo]) }}" class="btn btn-classic btn-block">
                                        <h5 class="font-weight-bold my-2 text-truncate">{{ ucfirst($categoria->titulo) }}</h5>
                                    </a>
                                </div>

                            @endforeach
                        </div>
                    </div>

                </section>
                <!-- END SECTION CATEGORIAS -->  --}}

            @endif

            <!-- SECTION APLICACOES -->
            <section>

                <!-- HEADER APLICACOES -->
                <div class="row my-4">

                    <!-- RESULTADO DE BUSCAS/CATEGORIAS -->
                    <div class="col-12 text-center text-md-left mb-3 mb-md-0">
                        @if(Request::has('categoria'))
                            <h3 class="my-2">
                                <i class="fas fa-folder-open text-primary small-2 align-middle text-shadow mr-2"></i>
                                <span class="font-weight-bold text-bluegray align-middle">
                                        Principais aplicações em "{{ ucfirst(Request::get('categoria')) }}"
                                </span>
                            </h3>
                        @elseif(Request::has('pesquisa'))
                            <h5 class="my-2">
                                <span class="font-weight-bold text-bluegray align-middle">Buscando por:</span>
                                <span class="font-weight-bold text-bluegray align-middle" style="background-color: #207adc;color:  white;border-radius:  25px;padding:  8px 30px;margin:  0px 10px;">
                                    "{{ ucfirst(Request::get('pesquisa')) }}"
                                    <a href="{{ route('catalogo') }}" class="text-white ml-2">
                                        <i class="fas fa-times"></i>
                                    </a>
                                </span>
                            </h5>
                        @else



                            <div class="col-12 title pl-0 mt-4">
                                <h2><i class="fas fa-th-large align-middle mr-2"></i> Aplicações</h2>
                            </div>
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

                            <div class="col-12 col-sm-6 col-lg-4 mb-3">
                                <a href="{{ route('hub.aplicacao', ['idAplicacao' => $aplicacao->id]) }}" class="card rounded-10 text-decoration-none h-100 border-0">
                                    <div class="card-img-auto bg-dark h-100 rounded-0" style="background-image: url('{{ env('APP_LOCAL') . '/uploads/aplicacoes/capas/' .  $aplicacao->capa }}');background-size: cover; background-position: 50% 50%; background-repeat: no-repeat;">
                                        <div class="d-block h-75 align-middle my-auto">
                                            <h5 class="text-white font-weight-bold text-center h-100" style="background: linear-gradient(rgba(55, 62, 70, 0.1), rgba(0, 3, 19, 0.5));margin:  0px;padding: 90px 48px;">

                                            </h5>
                                        </div>
                                        <div class="py-3 px-4 font-weight-bold h-25" style="background-color: rgba(0, 0, 0, .8);color: white;font-size: 16px;">
                                            <span class="">
                                                {{ ucfirst($aplicacao->titulo) }}
                                            </span>
                                        </div>
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
            <!-- END SECTION APLICACOES -->

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
