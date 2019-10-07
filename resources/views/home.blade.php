@extends('layouts.master')

@section('title', 'J. PIAGET - Início')

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

        .card-destino
        {
            background-color: #F9F9F9;
            height: 112px;
            width: 112px;
            justify-content: center;
            align-items: center;
            display: flex;
            color: #207adc;
            border-radius: 10px;
            border: 1px solid #CECECE;
        }

    </style>

@endsection

@section('content')

<main role="main" class="mr-0">

    <div class="row justify-content-center">

        <div class="col-11 px-2 px-lg-0 mx-auto">

            <section>

                <div class="row my-4">
                    <div class="col-12 col-md-8 col-lg-6 mx-auto">
                        <form action="{{ route('glossario.search') }}" method="post">
                            @csrf
                            <div class="search-glossario">
                                <input type="text" placeholder="Digite aqui o que está procurando." value="" name="word" class="text-truncate" required="">
                                <button type="submit"><i class="fas fa-search"></i></button>
                            </div>
                        </form>

                        @if($idUltimaAplicacao > 0)
                            <a href="{{ route('aplicacao-ultima') }}" class="btn btn-primary btn-block text-white font-weight-bold py-3 my-5 text-wrap">
                                CONTINUAR DO ÚLTIMO JOGO QUE PAREI
                            </a>
                        @endif

                        <div class="container-fluid">
                            <div class="row">

                                <div class="col-12 col-md-6 col-lg-4 text-center mb-4">
                                    <a href="{{ route('catalogo') }}" class="text-center text-decoration-none">
                                        <div class="card-destino mb-3 mx-auto">
                                            <i class="fas fa-gamepad fa-fw fa-3x"></i>
                                        </div>
                                        <p>Todos os jogos</p>
                                    </a>
                                </div>

                                <div class="col-12 col-md-6 col-lg-4 text-center mb-4">
                                    <a href="{{ route('biblioteca') }}" class="text-center text-decoration-none">
                                        <div class="card-destino mb-3 mx-auto">
                                            <i class="fas fa-book fa-fw fa-3x"></i>
                                        </div>
                                        <p>Biblioteca</p>
                                    </a>
                                </div>

                                <div class="col-12 col-md-6 col-lg-4 text-center mb-4">
                                    <a href="{{ route('glossario.index') }}" class="text-center text-decoration-none">
                                        <div class="card-destino mb-3 mx-auto">
                                            <i class="fas fa-align-left fa-fw fa-3x"></i>
                                        </div>
                                        <p>Glossário</p>
                                    </a>
                                </div>

                                <div class="col-12 col-md-6 col-lg-4 text-center mb-4">
                                    <a href="{{ route('perfil.recompensas') }}" class="text-center text-decoration-none">
                                        <div class="card-destino mb-3 mx-auto">
                                            <i class="fas fa-medal fa-fw fa-3x"></i>
                                        </div>
                                        <p>Recompensas</p>
                                    </a>
                                </div>

                                <div class="col-12 col-md-6 col-lg-4 text-center mb-4">
                                    @if($idTurma > 0)
                                        <a href="{{ route('turma-mural', ['idTurma' => $idTurma]) }}" class="text-center text-decoration-none">
                                            <div class="card-destino mb-3 mx-auto">
                                                <i class="fas fa-comments fa-fw fa-3x"></i>
                                            </div>
                                            <p>Mural</p>
                                        </a>
                                    @endif
                                </div>

                                <div class="col-12 col-md-6 col-lg-4 text-center mb-4">
                                    @if($idProfessor > 0)
                                        <a href="{{ route('professor.duvidas', ['idProfessor' => $idProfessor]) }}" class="text-center text-decoration-none">
                                            <div class="card-destino mb-3 mx-auto">
                                                <i class="fas fa-question fa-fw fa-3x"></i>
                                            </div>
                                            <p>Dúvidas</p>
                                        </a>
                                    @endif
                                </div>

                            </div>
                        </div>

                    </div>

                </div>

            </section>

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
