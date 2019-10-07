@extends('layouts.master')

@section('title', 'J. PIAGET - ' . (Request::is('home') ? 'Home' : ' Biblioteca'))

@section('headend')

    <!-- Custom styles for this template -->
    <style>

        header {
            padding: 154px 0 100px;
        }

        @media (min-width: 992px) {
            header {
                padding: 156px 0 100px;
            }
        }

        .card {
            background-color: #FFFFFF;
            display: flex;
            flex-direction: row;
            padding: 6px;
            border-radius: 5px;
        }

    </style>

@endsection

@section('content')

    <main role="main" class="mr-0">

        <div class="container-fluid">

            <div class="row">

                <div class="col-12 col-md-11 mx-auto">

                    <!-- SECTION APLICACOES -->

                    <!-- HEADER APLICACOES -->
                    <div class="d-block">

                        <div class="row mb-3">

                            <div class="col-md-6 text-center text-md-left mb-3 mb-md-0">
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
                                        <span class="font-weight-bold text-bluegray align-middle"
                                            style="background-color: #207adc;color:  white;border-radius:  25px;padding:  8px 30px;margin:  0px 10px;">
                                        "{{ ucfirst(Request::get('pesquisa')) }}"
                                        <a href="{{ route(\Route::currentRouteName()) }}" class="text-white ml-2">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    </span>
                                    </h5>
                                @endif
                            </div>



                            @if(Request::has('categoria') || Request::has('pesquisa'))
                                <div class="col-md-6 mb-2 text-center text-md-right">
                                    <div class="dropdown">
                                        <label for="cmbLimite" class="h6 mr-2 font-weight-bold">
                                            Mostrar
                                        </label>
                                        <button class="btn dropdown-toggle bg-white w-auto border-0 box-shadow font-weight-bold" type="button" id="cmbLimite" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{ $amount }}
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item font-weight-bold" href="{{ HelperClass::appendToUrl(['qt' => '10']) }}">
                                                10
                                            </a>
                                            <a class="dropdown-item font-weight-bold" href="{{ HelperClass::appendToUrl(['qt' => '15']) }}">
                                                15
                                            </a>
                                            <a class="dropdown-item font-weight-bold" href="{{ HelperClass::appendToUrl(['qt' => '20']) }}">
                                                20
                                            </a>
                                            <a class="dropdown-item font-weight-bold" href="{{ HelperClass::appendToUrl(['qt' => '35']) }}">
                                                35
                                            </a>
                                        </div>
                                        <label for="cmbLimite" class="h6 ml-2 font-weight-bold">
                                            por página
                                        </label>
                                    </div>
                                </div>
                            @endif

                        </div>

                        <div class="col-12 title pl-0 mb-4">
                            <h2><i class="fas fa-gamepad small-2 mr-2"></i> Jogos</h2>
                        </div>
                    </div>
                    <!-- END HEADER -->

                    <div class="py-2">
                        <div class="row">
                            @foreach ($aplicacoes as $aplicacao)

                                <div class="col-12 col-sm-6 col-lg-4 mb-3">

                                    <a href="{{ route('hub.aplicacao', ['idAplicacao' => $aplicacao->id]) }}" class="card rounded-10 text-decoration-none h-100 border-0">
                                        <div class="card-img-auto bg-dark h-100 rounded-0" style="flex: 0.6;background-image: url('{{ env('APP_LOCAL') . '/uploads/aplicacoes/capas/' .  $aplicacao->capa }}');background-size: cover;background-position: 50% 50%;background-repeat: no-repeat;min-height: 115px;">
                                        </div>
                                        <div class="py-3 px-4 h-100" style="color: #60748A;font-size: 16px;flex: 1;">
                                            <span class="d-block mb-2">
                                                {{ ucfirst($aplicacao->titulo) }}
                                            </span>

                                            <span class="d-block font-weight-bold" style="color: #207ADC;">
                                                <i class="fas fa-gamepad fa-fw mr-1"></i>
                                                Jogo
                                            </span>

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

                    <!-- END SECTION APLICACOES -->

                    @if(count($videos) > 0)
                        <section>
                            <div class="d-block my-4">
                                <div class="col-12 title pl-0">
                                    <h2><i class="fas fa-video small-2 mr-2"></i> Vídeos</h2>
                                </div>
                            </div>

                            <div class="py-2">
                                <div class="row">
                                    @foreach ($videos as $conteudo)

                                        <div class="col-12 col-sm-6 col-lg-4 mb-3">
                                            <a href="{{ route('conteudo.play', ['idConteudo' => $conteudo->id]) }}" class="card rounded-10 text-decoration-none h-100 border-0">
                                                <div class="py-3 px-4 h-100" style="color: #60748A;font-size: 16px;flex: 1;">
                                                    <span class="d-block mb-2">
                                                        {{ ucfirst($conteudo->titulo) }}
                                                    </span>
                                                        <span class="d-block font-weight-bold" style="color: #207ADC;">
                                                        <i class="fas fa-video fa-fw mr-1"></i>
                                                        Vídeo
                                                    </span>
                                                </div>
                                            </a>
                                        </div>

                                    @endforeach
                                </div>
                            </div>
                        </section>
                    @endif

                    @if(count($slides) > 0)
                        <section>
                            <div class="d-block my-4">
                                <div class="col-12 title pl-0">
                                    <h2><i class="fas fa-file-powerpoint small-2 mr-2"></i> Slides</h2>
                                </div>
                            </div>

                            <div class="py-2">
                                <div class="row">
                                    @foreach ($slides as $conteudo)

                                        <div class="col-12 col-sm-6 col-lg-4 mb-3">
                                            <a href="{{ route('conteudo.play', ['idConteudo' => $conteudo->id]) }}" class="card rounded-10 text-decoration-none h-100 border-0">
                                                <div class="py-3 px-4 h-100" style="color: #60748A;font-size: 16px;flex: 1;">
                                                    <span class="d-block mb-2">
                                                        {{ ucfirst($conteudo->titulo) }}
                                                    </span>
                                                        <span class="d-block font-weight-bold" style="color: #207ADC;">
                                                        <i class="fas fa-file-powerpoint fa-fw mr-1"></i>
                                                        Slide
                                                    </span>
                                                </div>
                                            </a>
                                        </div>

                                    @endforeach
                                </div>
                            </div>
                        </section>
                    @endif

                    @if(count($apostilas) > 0)
                        <section>

                            <div class="d-block my-4">
                                <div class="col-12 title pl-0">
                                    <h2><i class="fas fa-file-alt small-2 mr-2"></i> Livros digitais</h2>
                                </div>
                            </div>

                            <div class="py-2">
                                <div class="row">
                                    @foreach ($apostilas as $conteudo)

                                        <div class="col-12 col-sm-6 col-lg-4 mb-3">
                                            <a href="{{ route('conteudo.play', ['idConteudo' => $conteudo->id]) }}" class="card rounded-10 text-decoration-none h-100 border-0">
                                                <div class="py-3 px-4 h-100" style="color: #60748A;font-size: 16px;flex: 1;">
                                                    <span class="d-block mb-2">
                                                        {{ ucfirst($conteudo->titulo) }}
                                                    </span>
                                                        <span class="d-block font-weight-bold" style="color: #207ADC;">
                                                        <i class="fas fa-file-alt fa-fw mr-1"></i>
                                                        Livro digital
                                                    </span>
                                                </div>
                                            </a>
                                        </div>

                                    @endforeach
                                </div>
                            </div>
                        </section>
                    @endif

                    @if(count($documentos) > 0)
                        <section>

                            <div class="d-block my-4">
                                <div class="col-12 title pl-0">
                                    <h2><i class="fas fa-file-pdf small-2 mr-2"></i> Documentos</h2>
                                </div>
                            </div>

                            <div class="py-2">
                                <div class="row">
                                    @foreach ($documentos as $conteudo)

                                        <div class="col-12 col-sm-6 col-lg-4 mb-3">
                                            <a href="{{ route('conteudo.play', ['idConteudo' => $conteudo->id]) }}" class="card rounded-10 text-decoration-none h-100 border-0">
                                                <div class="py-3 px-4 h-100" style="color: #60748A;font-size: 16px;flex: 1;">
                                                    <span class="d-block mb-2">
                                                        {{ ucfirst($conteudo->titulo) }}
                                                    </span>
                                                        <span class="d-block font-weight-bold" style="color: #207ADC;">
                                                        <i class="fas fa-file-pdf fa-fw mr-1"></i>
                                                        Documento
                                                    </span>
                                                </div>
                                            </a>
                                        </div>

                                    @endforeach
                                </div>
                            </div>
                        </section>
                    @endif

                </div>

            </div>

        </div>

    </main>

@endsection

@section('bodyend')

    <script>

        $(document).ready(function () {

        });

    </script>

@endsection
