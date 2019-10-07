@extends('layouts.master')

@section('title', 'J. PIAGET - Plano de Aulas')

@section('headend')

    <!-- Custom styles for this template -->
    <style>

        /* Botão - pagina de plano de aulas "Guilherme" */
        .btn-plano {
            background-color: #25ACA3;
            color: #fff;
            font-weight: 700;
            border-radius: 20px
        }

        .btn-plano:hover {
            background-color: rgb(18, 133, 125)
        }

        .plan-text-color {
            color: #0D1033
        }

        .active-color {
            color: #207adc
        }

        .nav-link.active {
            border: none;
            color: #207adc !important;
            /* border-bottom: 3px #207adc solid !important; */
        }

        .nav-link.active::after {
            content: '';
            width: 35%;
            margin: 15px auto auto;
            display: block;
            border-bottom: 3px #207adc solid !important;
            color: #207adc !important;
        }
    </style>

@endsection



@section('content')

    <main role="main">

        <div class="container-fluid pt-4">

            <div class="pt-3 px-3 px-md-5 w-100">

                <div class="text-center text-md-right float-left">
                    <a class="text-right text-primary" href="#">
                        <i class="fas fa-angle-left"></i>
                        Voltar ao painel
                    </a>
                </div>

                <div class="row my-4">
                    <div class="col-12 col-sm-10 col-lg-6 mx-auto rounded-10 box-shadow bg-white">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <h4 class="my-4 mb-5 text-center plan-text-color font-weight-normal">
                                        Plano de aula
                                    </h4>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col mb-4">
                                    <ul class="nav nav-tabs nav-fill border-0" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active font-weight-bold" id="home-tab" data-toggle="tab"
                                               href="#home" role="tab" aria-controls="home" aria-selected="true">
                                                Sobre o plano
                                            </a>

                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link font-weight-bold" id="profile-tab" data-toggle="tab"
                                               href="#profile" role="tab" aria-controls="profile" aria-selected="false">Atividades</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link font-weight-bold" id="contact-tab" data-toggle="tab"
                                               href="#contact" role="tab" aria-controls="contact" aria-selected="false">Materiais</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="home" role="tabpanel"
                                             aria-labelledby="home-tab">
                                            <div class="d-flex flex-row justify-content-between px-md-1 mb-5 mt-2">
                                                <div>
                                                    <p class="plan-text-color">{{ $plano->grade->titulo }}</p>
                                                    <button class="btn btn-plano rounded-10 px-5 py-1">
                                                        HISTÓRIA
                                                    </button>
                                                </div>
                                                <div>
                                                    <p class="text-md-right">
                                                        <b class="plan-text-color">{{ date('H:i', strtotime($plano->grade->hora_inicial)) }}</b>
                                                        as
                                                        <b class="plan-text-color">{{ date('H:i', strtotime($plano->grade->hora_final)) }}</b>
                                                        <br>
                                                        {{ strftime('%e de %h de %Y', strtotime($plano->grade->data)) }}
                                                    </p>

                                                </div>
                                            </div>

                                            <div
                                                class="d-flex flex-row justify-content-between px-md-1 border-top pt-2 mb-5 mt-2">
                                                <p class="font-weight-bold plan-text-color">Professor(a)</p>
                                                <div>
                                                    <p class="plan-text-color">{{$plano->grade->professor->name}}</p>
                                                </div>
                                            </div>

                                            <div
                                                class="d-flex flex-row justify-content-between px-md-1 border-top pt-2 mb-5 mt-2">
                                                <p class="font-weight-bold plan-text-color">Assunto</p>
                                                <div>
                                                    <p class="plan-text-color">{{ $plano->assunto }}</p>
                                                </div>
                                            </div>

                                            <div
                                                class="d-flex flex-row justify-content-between px-md-1 border-top pt-2 mb-5 mt-2">
                                                <p class="font-weight-bold plan-text-color">Tarefa de classe</p>
                                                <div>
                                                    <p class="plan-text-color">{{ $plano->tarefa_classe }}</p>
                                                </div>
                                            </div>

                                            <div
                                                class="d-flex flex-row justify-content-between px-md-1 border-top pt-2 mb-5 mt-2">
                                                <p class="font-weight-bold plan-text-color">Tarefa de casa</p>
                                                <div>
                                                    <p class="plan-text-color">{{ $plano->tarefa_casa }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="profile" role="tabpanel"
                                             aria-labelledby="profile-tab">

                                            @forelse($plano->anexosAtividades as $atividade)
                                                <div class="d-flex flex-row justify-content-between px-md-1 mb-5 mt-2">
                                                    <div class="d-flex flex-row">
                                                        <i class="fas fa-list fa-lg my-auto mr-5"></i>
                                                        <div>
                                                            <b>{{ $atividade->conteudo->titulo }}</b>
                                                            <p class="plan-text-color">
                                                                {{ $atividade->conteudo->descricao }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <a href="{{ route('conteudo.play', ['idConteudo' => $atividade->conteudo->id]) }}" class="active-color font-weight-bold">VER ATIVIDADE</a>
                                                    </div>
                                                </div>
                                            @empty
                                                Nenhuma atividade adicionada para este plano de aula
                                            @endforelse

                                            {{--<div--}}
                                            {{--class="d-flex flex-row justify-content-between px-md-1 mb-5 mt-2 border-top pt-2">--}}
                                            {{--<div class="d-flex flex-row">--}}
                                            {{--<i class="fas fa-gamepad fa-lg my-auto mr-5"></i>--}}
                                            {{--<div>--}}
                                            {{--<b>JOGO</b>--}}
                                            {{--<p class="plan-text-color">--}}
                                            {{--Jogo de História--}}
                                            {{--</p>--}}
                                            {{--</div>--}}
                                            {{--</div>--}}
                                            {{--<div class="d-flex align-items-center">--}}
                                            {{--<a href="#" class="active-color font-weight-bold">JOGAR</a>--}}
                                            {{--</div>--}}
                                            {{--</div>--}}
                                        </div>
                                        <div class="tab-pane fade" id="contact" role="tabpanel"
                                             aria-labelledby="contact-tab">
                                            @forelse($plano->anexosAtividades as $atividade)
                                                <div class="d-flex flex-row justify-content-between px-md-1 mb-5 mt-2">
                                                    <div class="d-flex flex-row">
                                                        <i class="fas fa-file fa-lg my-auto mr-5"></i>
                                                        <div>
                                                            <b>{{ $atividade->conteudo->titulo }}</b>
                                                            <p class="plan-text-color">
                                                                {{ $atividade->conteudo->descricao }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <a href="{{ route('conteudo.play', ['idConteudo' => $atividade->conteudo->id]) }}" class="active-color font-weight-bold">VER MATERIAL</a>
                                                    </div>
                                                </div>
                                            @empty
                                                Nenhum material adicionado para este plano de aula
                                            @endforelse

                                            {{--<div--}}
                                            {{--class="d-flex flex-row justify-content-between px-md-1 mb-5 mt-2 border-top pt-2">--}}
                                            {{--<div class="d-flex flex-row">--}}
                                            {{--<i class="fas fa-video fa-lg my-auto mr-5"></i>--}}
                                            {{--<div>--}}
                                            {{--<b>VÍDEO</b>--}}
                                            {{--<p class="plan-text-color">--}}
                                            {{--Conteúdo de vídeo--}}
                                            {{--</p>--}}
                                            {{--</div>--}}
                                            {{--</div>--}}
                                            {{--<div class="d-flex align-items-center">--}}
                                            {{--<a href="#" class="active-color font-weight-bold">ASSISTIR</a>--}}
                                            {{--</div>--}}
                                            {{--</div>--}}

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>


            </div>


        </div>

    </main>

@endsection

@section('bodyend')


@endsection

