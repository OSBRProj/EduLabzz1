@extends('layouts.master')

@section('title', 'J. PIAGET - Ranking')

@section('headend')

    <!-- Custom styles for this template -->
    <style>
        .active-color { color: #207adc }
        .nav-link { color:#60748A; }

        .nav-link.active {
            border: none;
            color: #207adc !important;
            background-color: transparent !important;
        }

        .nav-link.active::after {
            content: '';
            width: 35%;
            margin: 15px auto auto;
            display: block;
            border-bottom: 3px #207adc solid !important;
            color: #207adc !important;
        }

        .text-number {
            color: #B2AC83;
            font-size: 2.2rem;
            font-weight: bold;
        }

        .header-card {
            background-color: #1B2065;
            margin: 0;
            width: 100%;
            overflow: hidden;
        }

        .header-card > div > b,
        .header-card > div > div > b { color: #FFFFFF !important; }

        .circle-card {
            float:right;
            width: 30px;
            height: 30px;
            border-radius: 15px;
        }

        .text-gold { color: #B2AC83; }

        .text-ranking { color: #60748A; }

        .text-players {
            font-size:17px;
            font-weight:600;
            color:#60748A;
        }

        .bg-gold { background-color: #B2AC83; }
        .bg-ranking { background-color: #60748A; }
        .bg-user { background-color: #00BDD4; }
        .nav-tabs .nav-link { font-size:25px; }

        .item-ranking-0 {
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .text-pos-ranking { line-height:30px; }
    </style>

@endsection



@section('content')

    <main role="main">

        <div class="container">

            <div class="my-4 row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-11 mx-auto">
                    <div class="col-12 title pl-0">
                        <h2>Ranking</h2>
                    </div>
                </div>
            </div>

            <div class="my-4 row justify-content-center">
                <div class="col-12 col-sm-12 col-md-12 col-lg-8 mx-auto">

                    <div class="row">
                        <div class="col mb-4">
                            <ul class="nav nav-tabs nav-fill border-0" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active font-weight-bold" id="geral-tab" data-toggle="tab"
                                        href="#geral" role="tab" aria-controls="geral" aria-selected="true">Geral
                                    </a>

                                </li>
                                <li class="nav-item">
                                    <a class="nav-link font-weight-bold" id="escola-tab" data-toggle="tab"
                                        href="#escola" role="tab" aria-controls="escola"
                                        aria-selected="false">Escola</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="tab-content" id="myTabContent">

                                <!-- geral -->
                                <div class="tab-pane fade show active" id="geral" role="tabpanel"
                                        aria-labelledby="geral-tab">

                                    <div class="row mb-5">
                                        <div class="mb-3 col-lg-6 col-md-6">
                                            <div class="border border-thin rounded-10 py-5 d-flex flex-column justify-content-center align-items-center">
                                                <p class="text-number">
                                                    {{ ($userLogged === null || $professorIndex > 500 ? "-" : "#$professorIndex") }}&deg
                                                </p>
                                                <p class="text-players">de {{$professoresGeral->count()}} professor{{ $professoresGeral->count() != 1 ? 'es' : '' }}</p>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-lg-6 col-md-6">
                                            <div class="border border-thin rounded-10 py-5 d-flex flex-column justify-content-center align-items-center">
                                                <p class="text-number">
                                                    {{ ($userLogged === null || $escolaIndex > 500 ? "-" : "#$escolaIndex") }}&deg
                                                </p>
                                                <p class="text-players">de {{$escolas->count()}} escola{{ $escolas->count() != 1 ? 's' : '' }}</p>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row-list-ranking border border-thin rounded-10">

                                        {{--@if($professorIndex === false || $professorIndex > 20)
                                            <div class="mb-3 header-card d-lg-flex justify-content-between align-items-center p-4">
                                                <div class="row">
                                                    <div class="ml-lg-4 mr-lg-4">
                                                        <b class="text-white">{{ ($professorIndex === false || $professorIndex > 500 ? "-" : "#$professorIndex") }}&deg</b>
                                                    </div>
                                                    <div class="mr-lg-4">
                                                        <div class="circle-card bg-user"></div>
                                                    </div>
                                                    <div>
                                                        <b class="text-white">Você</b>
                                                    </div>
                                                </div>
                                                <div>
                                                    <b class="text-white">
                                                        {{ ($userLogged === null || $professorIndex > 500 ? "-" : 'mp') }}
                                                        pts
                                                    </b>
                                                </div>
                                            </div>
                                        @endif--}}


                                        @forelse($professoresGeral as $key => $professor)
                                            <div class="item-ranking-{{ $key }} d-lg-flex justify-content-between align-items-center my-1 p-4 {{ ($professor->id === Auth::id() ? "header-card" : "") }}">
                                                <div class="w-100 row d-flex align-items-center">
                                                    <div class="col-4 col-sm-3 col-md-2 col-lg-2">
                                                        <b class="text-pos-ranking {{ ($key === 0 ? "text-warning" : ($key === 1 || $key === 2 ? "text-gold" : "text-ranking")) }}">#{{ $key + 1 }}&deg</b>
                                                        <div class="circle-card {{ ($key === 0 ? "bg-warning" : ($professor->id === Auth::id() ? "bg-user" : ($key === 1 || $key === 2 ? "bg-gold" : "bg-ranking"))) }}"></div>
                                                    </div>
                                                    <div class="col-5 col-sm-6 col-md-8 col-lg-8">
                                                        <b class="text-primary">{{ $professor->nome }}</b>
                                                    </div>
                                                    <div class="col-3 col-sm-3 col-md-2 col-lg-2 text-right">
                                                        <b class="text-primary">{{ ($professor->pontos > 0) ? $professor->pontos : '0' }} pts</b>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            Nenhum professor encontrado
                                        @endforelse
                                    </div>
                                </div>
                                <!-- -->



                                <!-- escola -->
                                <div class="tab-pane fade show" id="escola" role="tabpanel"
                                        aria-labelledby="escola-tab">

                                    <div class="row mb-5">
                                        <div class="mb-3 col-lg-6 col-md-6">
                                            <div class="border border-thin rounded-10 py-5 d-flex flex-column justify-content-center align-items-center">
                                                <p class="text-number">
                                                    {{ ($userLogged === null || $professorIndex > 500 ? "-" : "#$professorIndex") }}&deg
                                                </p>
                                                <p class="text-players">de {{$professoresGeral->count()}} professor{{ $professoresGeral->count() != 1 ? 'es' : '' }}</p>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-lg-6 col-md-6">
                                            <div class="border border-thin rounded-10 py-5 d-flex flex-column justify-content-center align-items-center">
                                                <p class="text-number">
                                                    {{ ($userLogged === null || $escolaIndex > 500 ? "-" : "#$escolaIndex") }}&deg
                                                </p>
                                                <p class="text-players">de {{$escolas->count()}} escola{{ $escolas->count() != 1 ? 's' : '' }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row-list-ranking border border-thin rounded-10">
                                        @forelse($escolas as $key => $escola)
                                            <div class="d-lg-flex item-ranking-{{ $key }} justify-content-between align-items-center mb-5 p-4 {{ ($escola->id === Auth::user()->escola_id ? "header-card" : "") }}">
                                                <div class="w-100 row d-flex align-items-center">
                                                    <div class="col-4 col-sm-3 col-md-2 col-lg-2">
                                                        <b class="text-pos-ranking {{ ($key === 0 ? "text-warning" : ($key === 1 || $key === 2 ? "text-gold" : "text-ranking")) }}">#{{ $key + 1 }}&deg</b>
                                                        <div class="circle-card {{ ($key === 0 ? "bg-warning" : ($escola->id === Auth::user()->escola_id ? "bg-user" : ($key === 1 || $key === 2 ? "bg-gold" : "bg-ranking"))) }}"></div>
                                                    </div>
                                                    <div class="col-5 col-sm-6 col-md-8 col-lg-8">
                                                        <b class="text-primary">{{ $escola->titulo }}</b>
                                                    </div>
                                                    <div class="col-3 col-sm-3 col-md-2 col-lg-2">
                                                        <b class="text-primary">{{ ($escola->pontos > 0) ? $escola->pontos : '0' }} pts</b>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            Nenhuma escola encontrada
                                        @endforelse
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

