@extends('layouts.master')

@section('title', 'J. PIAGET - Gestão do glossário')

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

        .search-glossario > input
        {
            color: #207adc;
        }

        .words-container > ul
        {
            justify-content: flex-start;
        }

        .words-container > ul > a
        {
            margin: 5px;
        }

        div.words-description-box > p.title
        {
            color: #000313;
        }

    </style>

@endsection

@section('content')

<main role="main" class="">

    <div class="container">

        <div class="row">

        <div class="col-12 col-md-11 mx-auto">

            <div class="col-12 mb-3 title pl-0">
                <h2>Glossário</h2>
            </div>

            <div class="col-12 px-0 mb-4">

                <div class="row">
                    <div class="col-sm-12 col-md-8 col-xl-9 my-auto">
                        <form action="" method="get">
                        <div class="input-group input-group mb-3">

                                <input name="pesquisa" type="text" value="{{ Request::has('pesquisa') ? Request::get('pesquisa') : '' }}" required class="form-control py-2 width-100 shadow-sm border-0 px-3"
                                    placeholder="Procurar palavra."
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
                        <button type="button" data-toggle="modal" data-target="#divModalNovaPalavra" class="btn btn-block btn-primary text-truncate text-uppercase d-flex align-items-center justify-content-center font-weight-bold mr-3 mb-2 mb-sm-0 h-100">
                            <i class="fas fa-plus mr-2"></i>
                            Nova palavra
                        </button>
                    </div>

                </div>

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

            <section class="words-container">
                <ul>
                    <a href="{{ route('gestao.glossario', 'A') }}">
                        <li class="{{ $word =='A' ? 'active' : '' }}">A</li>
                    </a>
                    <a href="{{ route('gestao.glossario', 'B') }}">
                        <li class="{{ $word =='B' ? 'active' : '' }}">B</li>
                    </a>
                    <a href="{{ route('gestao.glossario', 'C') }}">
                        <li class="{{ $word =='C' ? 'active' : '' }}">C</li>
                    </a>
                    <a href="{{ route('gestao.glossario', 'D') }}">
                        <li class="{{ $word =='D' ? 'active' : '' }}">D</li>
                    </a>
                    <a href="{{ route('gestao.glossario', 'E') }}">
                        <li class="{{ $word =='E' ? 'active' : '' }}">E</li>
                    </a>
                    <a href="{{ route('gestao.glossario', 'F') }}">
                        <li class="{{ $word =='F' ? 'active' : '' }}">F</li>
                    </a>
                    <a href="{{ route('gestao.glossario', 'G') }}">
                        <li class="{{ $word =='G' ? 'active' : '' }}">G</li>
                    </a>
                    <a href="{{ route('gestao.glossario', 'H') }}">
                        <li class="{{ $word =='H' ? 'active' : '' }}">H</li>
                    </a>
                    <a href="{{ route('gestao.glossario', 'I') }}">
                        <li class="{{ $word =='I' ? 'active' : '' }}">I</li>
                    </a>
                    <a href="{{ route('gestao.glossario', 'J') }}">
                        <li class="{{ $word =='J' ? 'active' : '' }}">J</li>
                    </a>
                    <a href="{{ route('gestao.glossario', 'L') }}">
                        <li class="{{ $word =='L' ? 'active' : '' }}">L</li>
                    </a>
                    <a href="{{ route('gestao.glossario', 'M') }}">
                        <li class="{{ $word =='M' ? 'active' : '' }}">M</li>
                    </a>
                    <a href="{{ route('gestao.glossario', 'N') }}">
                        <li class="{{ $word =='N' ? 'active' : '' }}">N</li>
                    </a>
                    <a href="{{ route('gestao.glossario', 'O') }}">
                        <li class="{{ $word =='O' ? 'active' : '' }}">O</li>
                    </a>
                    <a href="{{ route('gestao.glossario', 'P') }}">
                        <li class="{{ $word =='P' ? 'active' : '' }}">P</li>
                    </a>
                    <a href="{{ route('gestao.glossario', 'Q') }}">
                        <li class="{{ $word =='Q' ? 'active' : '' }}">Q</li>
                    </a>
                    <a href="{{ route('gestao.glossario', 'R') }}">
                        <li class="{{ $word =='R' ? 'active' : '' }}">R</li>
                    </a>
                    <a href="{{ route('gestao.glossario', 'S') }}">
                        <li class="{{ $word =='S' ? 'active' : '' }}">S</li>
                    </a>
                    <a href="{{ route('gestao.glossario', 'T') }}">
                        <li class="{{ $word =='T' ? 'active' : '' }}">T</li>
                    </a>
                    <a href="{{ route('gestao.glossario', 'U') }}">
                        <li class="{{ $word =='U' ? 'active' : '' }}">U</li>
                    </a>
                    <a href="{{ route('gestao.glossario', 'V') }}">
                        <li class="{{ $word =='V' ? 'active' : '' }}">V</li>
                    </a>
                    <a href="{{ route('gestao.glossario', 'W') }}">
                        <li class="{{ $word =='W' ? 'active' : '' }}">W</li>
                    </a>
                    <a href="{{ route('gestao.glossario', 'X') }}">
                        <li class="{{ $word =='X' ? 'active' : '' }}">X</li>
                    </a>
                    <a href="{{ route('gestao.glossario', 'Y') }}">
                        <li class="{{ $word =='Y' ? 'active' : '' }}">Y</li>
                    </a>
                    <a href="{{ route('gestao.glossario', 'Z') }}">
                        <li class="{{ $word =='Z' ? 'active' : '' }}">Z</li>
                    </a>
                </ul>
            </section>

            @if(\Request::has('word'))
                <section>
                    <h2 class="title-main">Resultados de busca por: "{{ \Request::get('word') }}"</h2>
                </section>
            @endif

            <section class="words-description-container">
                @forelse($glossarios as $glossario)
                    <div class="words-description-box">
                        <button onclick="excluirPalavra({{ $glossario->id }});" class="btn bg-transparent float-right align-top">
                            <i class="fas fa-trash text-danger"></i>
                        </button>
                        <p class="title">{{ ucwords($glossario->word) }}</p>
                        <p class="description">{{ ucfirst($glossario->description) }}</p>
                    </div>
                @empty
                    <p class="text-dark">Nenhuma palavra encontrada</p>
                @endforelse
            </section>

            <form id="formExcluirPalavra" action="{{ route('gestao.glossario-excluir') }}" method="post">@csrf <input id="idGlossario" name="idGlossario" hidden> </form>

            </div>


        </div>

        <!-- Modal nova palavra -->
        <div class="modal fade" id="divModalNovaPalavra" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal text-center px-1 px-md-5" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                        <h5 class="my-4">
                            Nova palavra
                        </h5>

                        <form action="{{ route('gestao.glossario.salvar') }}" method="post" class="">
                            @csrf

                            <div class="form-group">
                                <input type="text" name="word" value="{{ old('word') }}" class="form-control" placeholder="Palavra" autofocus required>
                            </div>

                            <div class="form-group">
                                <textarea name="description" class="form-control" rows="5" placeholder="Descrição" required></textarea>
                            </div>

                            <div class="row">
                                <button type="button" data-dismiss="modal" class="btn btn-danger btn-block mt-4 mb-0 col-4 ml-auto mr-4 font-weight-bold">Cancelar</button>
                                <button type="submit" class="btn btn-primary btn-block mt-4 mb-0 col-4 ml-4 mr-auto font-weight-bold">Cadastrar</button>
                            </div>

                        </form>

                    </div>

                </div>
            </div>
        </div>
        <!-- Fim modal nova palavra -->

    </div>

</main>

@endsection

@section('bodyend')

<script>

    $( document ).ready(function()
    {

    });

    function excluirPalavra(id)
    {
        $("#formExcluirPalavra #idGlossario").val(id);

        swal({
            title: 'Deseja mesmo excluir?',
            text: "Você deseja mesmo excluir esta palavra?",
            icon: "warning",
            buttons: ['Não', 'Sim, excluir!'],
            dangerMode: true,
        }).then((result) => {
            if (result == true)
            {
                $("#formExcluirPalavra").submit();
            }
        });
    }

</script>

@endsection
