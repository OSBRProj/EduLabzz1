@extends('layouts.master')

@section('title', 'J. PIAGET - ' . ucfirst($artigo->titulo))

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
            box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.16);
            background-color: #FFFFFF;
        }

        body.dark-mode .card
        {
            background-color: #1F212E;
        }

        body
        {
            background-color: #fff !important;
        }

    </style>

@endsection

@section('content')

<main role="main" class="">

    <div class="container">

        <div class="row">

            <div class="col-12 col-md-11 mx-auto">

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb p-0 pb-3 mb-3 bg-transparent border-bottom">
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="{{ route('artigos.index') }}" >
                                <i class="fas fa-chevron-left mr-2"></i>
                                <span>Artigos</span>
                            </a>
                        </li>
                        <li class="breadcrumb-item active text-truncate" aria-current="page">{{ $artigo->titulo }}</li>
                    </ol>
                </nav>

                <div class="col-12 title pl-0">
                    <h2>{{ $artigo->titulo }}</h2>
                    <h4 class="text-muted">
                        {{ $artigo->subtitulo }}
                    </h4>
                </div>

                <div class="row my-2">

                    <div class="col-12 col-md-8 small">
                        <p class="">
                            Por:
                            <br>
                            <b>{{ ucwords($artigo->user->name) }}</b>
                            <br>
                            <span>{{ $artigo->created_at->formatLocalized("%d de %B de %Y") }}</span>
                            @if($artigo->created_at != $artigo->updated_at)
                                <br>
                                <span>Atualizado em: {{ $artigo->updated_at->formatLocalized("%d de %B de %Y") }}</span>
                            @endif
                        </p>
                    </div>

                </div>

                <div class="py-2">
                    <div class="row">

                        <div class="col-12 col-md-10">
                            {!! $artigo->conteudo !!}
                        </div>

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
            toggleSideMenu();
        });

    </script>

@endsection
