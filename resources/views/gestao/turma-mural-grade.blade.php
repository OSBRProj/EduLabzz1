@extends('layouts.master')

@section('title', 'J. PIAGET - Turma ' . $turma->titulo)

@section('headend')

    <!-- Bootstrap Select CSS -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css">

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


        .input-group input.text-secondary::placeholder {
            color: #989EB4;
        }

        .form-group label {
            color: #c3c5d2;
            font-weight: bold;
            font-size: 18px;
        }


        .form-control {
            color: #525870;
            font-weight: bold;
            font-size: 16px;
            border: 0px;
            border-radius: 5px;
            box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.16);
        }

        .form-control::placeholder {
            color: #B7B7B7;
        }

        .custom-select option:first-child {
            color: #B7B7B7;
        }

        input[type=range]::-webkit-slider-thumb {
            -webkit-appearance: none;
            border: 0px;
            height: 20px;
            width: 20px;
            border-radius: 50%;
            background: #c3c5d2;
            cursor: pointer;
            margin-top: 0px; /* You need to specify a margin in Chrome, but in Firefox and IE it is automatic */
        }

        input[type=range]::-webkit-slider-runnable-track {
            width: 100%;
            height: 36px;
            cursor: pointer;
            box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.16);
            background: #5678ef;
            border-radius: 90px;
            border: 8px solid #E3E5F0;
        }

        @media (min-width: 576px) {
            .side-menu {
                min-height: calc(100vh - 162px);
            }
        }

        .nav-tabs {
            border-bottom: 0;
        }

        .nav-tabs .nav-item {
            margin-bottom: 0px;
        }

        .nav-tabs .nav-link {
            border: 0px;
            font-size: 20px;
            border-bottom: 4px solid transparent;
            color: #525870;
            font-weight: bold;
            padding-bottom: 20px;
            background: transparent;
        }

        .nav-tabs .nav-link.active {
            background: transparent;
            color: #207adc;
            border-bottom: 4px solid #207adc;

        }

        .summernote-holder {
            /*padding: .375rem .75rem;*/
            padding: 0px;
            border-radius: 0px;
            border: 0px;
            box-shadow: none;
            font-size: initial;
            text-align: initial;
            color: initial;
            margin-bottom: 30px;
        }

        .table thead th {
            border: 0px;
        }

        .bg-postar {
            background-color: transparent !important;
        }

        .bg-postagem, .bg-card {
            background-color: white !important;
        }

        main.darkmode .bg-card, main.darkmode .bg-postagem, main.darkmode .bg-postar {
            background-color: #13141D !important;
        }

        main:not(.darkmode) .text-white.text-darkmode {
            color: #13141D !important;
        }

        main:not(.darkmode) .bg-light {
            background-color: white !important;
        }

        main.darkmode .bg-light {
            background-color: #272A3B !important;
        }

    </style>

@endsection

@section('content')

    <main role="main">

            <div class="container-fluid pt-4">

                <div class="row p-5 text-center">

                    @if(app('router')->getRoutes()->match(app('request')->create( str_replace(env('APP_URL'), "", URL::previous())  ))->getName() == 'gestao.escola-painel')
                        <div class="float-none float-md-left text-truncate mb-3 mb-md-0">
                            <a href="{{ route('gestao.escola-painel', ['idEscola' => $turma->escola->id]) }}#turmas"
                               class="btn bg-transparent btn-outline w-100 text-primary text-truncate box-shadow rounded px-4 py-2">
                                <i class="fas fa-chevron-left fa-fw fa-lg mr-2"></i>
                                Voltar à todas as turmas
                            </a>
                        </div>
                    @endif

                    <h4 class="text-primary mx-auto">
                        {{ ucfirst($turma->titulo) }}
                        <small class="d-block my-3">
                            <a href="{{ route('gestao.escola-painel', ['idEscola' => $turma->escola->id]) }}" class=""
                               style="color: #989AC1;">
                                {{ ucfirst($turma->escola->titulo) }}
                            </a>
                            <a href="{{ route('professor.avaliacoes', ['idProfessor' => $turma->professor->id]) }}"
                               class="d-block small mt-2" style="color: #989AC1;">
                                Professor: {{ ucwords($turma->professor->name) }}
                            </a>
                        </small>
                    </h4>

                </div>

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item ml-auto mr-md-3 pr-md-3">
                        <a class="nav-link" href="{{ url("/turma/$turma->id/mural") }}">Mural</a>
                    </li>

                    @if(Request::is('gestao/turma/*') && ($turma->user_id == Auth::user()->id || Auth::user()->permissao == "Z"))
                        <li class="nav-item mx-md-3 px-md-3">
                            <a class="nav-link" href="{{ url("/turma/$turma->id/mural/#aplicacao") }}">Liberar
                                aplicação</a>
                        </li>
                        <li class="nav-item mx-md-3 px-md-3">
                            <a class="nav-link" href="{{ url("/turma/$turma->id/mural/#transmissao") }}">Transmissão</a>
                        </li>
                    @endif


                    <li class="nav-item ml-auto ml-md-3 pl-md-3">
                        <a class="nav-link" href="{{ url("/turma/$turma->id/mural/#alunos") }}">Alunos</a>
                    </li>

                    <li class="nav-item mr-auto ml-md-3 pl-md-3">
                        <a class="nav-link active" href="#">Grade de Aulas</a>
                    </li>

                </ul>

                <div class="container">

                    <div class="justify-content-center">

                        <div class="px-2 px-lg-0 mx-auto">

                            <section class="mb-5">

                                <div class="bg-light p-4 mt-2">

                                    <div id="calendar">
                                        {!! $calendar->calendar() !!}
                                    </div>

                                </div>

                            </section>

                        </div>

                    </div>

                </div>


            </div>

        </main>

@endsection

@section('bodyend')

    {!! $calendar->script() !!}

@endsection
