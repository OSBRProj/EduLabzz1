@extends('layouts.master')

@section('title', 'J. PIAGET - Lista de Favoritos')

@section('headend')

    <!-- Custom styles for this template -->
    <style>

    </style>

@endsection

@section('content')

    <main role="main">

        <div class="container">

            <div class="row">

                <section class="col-12 col-md-11 mx-auto">

                        <div class="col-12 title pl-0 border-0">
                            <h2><i class="far fa-heart"></i> Lista de favoritos</h2>
                        </div>

                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb p-0 pb-3 mb-3 bg-transparent border-bottom">
                                <li class="breadcrumb-item active" aria-current="page">
                                    <a href="{{ route('home') }}" >
                                        <i class="fas fa-chevron-left mr-2"></i>
                                        <span>Home</span>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active text-truncate" aria-current="page">Lista de favoritos</li>
                            </ol>
                        </nav>


                        <div class="d-flex flex-row-reverse">

                            <form action="{{ route('favoritos.search') }}" method="post" class="d-flex">
                                @csrf
                                <input type="text" name="search" class="input-search-favoritos"
                                       placeholder="Pesquisar conteúdo" required>
                                <button type="submit" class="icon-search-favoritos">
                                    <i class="fas fa-search"></i>
                                </button>
                            </form>
                        </div>


                        <div class="mt-5">
                            <h5>
                                <i class="fas fa-podcast fa-lg"></i> <span class="">Podcasts</span>
                            </h5>

                            <div class="row mt-4">
                                @foreach($favoritos as $favorito)
                                    @if($favorito->conteudo != null ? $favorito->conteudo->tipo === 2 : false)
                                        @include('pages.podcasts._all')
                                    @endif
                                @endforeach
                            </div>
                        </div>


                        <div class="mt-5">
                            <h5>
                                <i class="fas fa-book"></i> <span>Plano de estudo</span>
                            </h5>

                            <div class="row mt-4">

                                @include('pages.plano-aulas.alunos._all')

                            </div>
                        </div>

                </section>
            </div>
        </div>
    </main>

@endsection

@section('bodyend')


@endsection

