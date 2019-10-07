@extends('layouts.master')

@section('title', 'J. PIAGET - Artigos')

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
            flex-direction: column;
            padding: 6px;
            border-radius: 5px;
            box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.16);
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

        <div class="row">

            <div class="col-12 col-md-11 mx-auto">

                <div class="row">
                    <div class="col-12 mb-3 title pl-0">
                        <h2>Artigos</h2>
                    </div>

                    <div class="col-12 px-0 mb-3">

                        @if(count($artigos) > 0)
                            <div class="row">
                                <div class="col-12 my-auto">
                                    <form action="" method="get">
                                    <div class="input-group input-group">

                                            <input name="pesquisa" type="text" value="{{ Request::has('pesquisa') ? Request::get('pesquisa') : '' }}" required class="form-control py-2 width-100 shadow-sm border-0 px-3"
                                                placeholder="Procurar artigo."
                                                aria-label="Recipient's username" aria-describedby="button-addon2">

                                            <div class="input-group-append">
                                                <button class="btn bg-primary border-0 text-light shadow-sm" type="submit" id="button-addon2">
                                                    <i class="fas fa-search fa-lg fa-fw text-light"></i>
                                                </button>
                                            </div>
                                        </div>
                                        </form>

                                </div>

                            </div>
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
                </div>

                <div class="row my-2">

                    @if(Request::has('pesquisa'))
                        <div class="col-md-6 mb-2 text-center text-md-right mx-auto mx-md-1 ml-md-auto">
                            <div class="dropdown">
                                <label for="cmbLimite" class="h6 mr-2 font-weight-bold text-lighter">Mostrar</label>
                                <button class="btn dropdown-toggle w-auto border-0 bg-white box-shadow font-weight-bold text-lighter" type="button" id="cmbLimite" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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

                <div class="py-2">
                    <div class="row">
                        @foreach ($artigos as $artigo)

                            <div id="divArtigo{{ $artigo->id }}" class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
                                <a href="{{ route('artigos.ler', ['artigo_id' => $artigo->id, 'sluged_title' => str_slug($artigo->titulo, '-') ]) }}" class="card rounded-10 text-decoration-none h-100 border-0">

                                    <div class="card-img-auto bg-dark h-100 rounded-0" style="flex: 0.8;background-image: url('{{ env("APP_LOCAL") . '/uploads/artigos/' . $artigo->capa }}');background-size: cover;background-position: 50% 50%;background-repeat: no-repeat;min-height: 185px;">
                                    </div>
                                    <div class="py-3 px-4 h-100" style="color: #525870;font-size: 16px;flex: 1;">
                                        <h5 class="text-dark d-block mb-2 text-truncate">
                                            {{ ucfirst($artigo->titulo) }}
                                        </h5>
                                        <p class="text-muted small text-truncate">
                                            {{ ucfirst($artigo->descricao) }}
                                        </p>
                                        <small class="">
                                            Por:
                                            <b>{{ ucwords($artigo->user->name) }}</b>
                                            <br>
                                            <span>{{ $artigo->created_at->formatLocalized("%d de %B de %Y") }}</span>
                                            {{--  @if($artigo->created_at != $artigo->updated_at)
                                                <br>
                                                <span>Atualizado em: {{ $artigo->updated_at->formatLocalized("%d de %B de %Y") }}</span>
                                            @endif  --}}
                                        </small>
                                    </div>
                                </a>
                            </div>

                        @endforeach

                        @if(count($artigos) == 0)
                            <div id="divSemArtigos" class="col-12 mb-3">
                                Ainda não há nada para ver por aqui.
                            </div>
                        @endif

                        @if(Request::has('pesquisa') && count($artigos) == 0)

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
