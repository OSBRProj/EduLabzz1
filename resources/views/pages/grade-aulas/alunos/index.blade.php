@extends('layouts.master')
@section('title', 'J. PIAGET - Grade de aula')
@section('headend')

    <!-- Custom styles for this template -->
    <style>
        .title-date {
            overflow: hidden;
            font-weight: 100;
        }

        .bar-date-min {
            width: 100%;
            height: 12px;
        }

        .ball-date-blue {
            cursor: pointer;
            padding: 15px;
            border-radius: 20px;
            border: 2px solid #FFF;
            background-color: #207adc;
        }

        .ball-date-white {
            cursor: pointer;
            padding: 15px;
            border-radius: 20px;
            border: 2px solid #207adc;
            background-color: #FFF;
        }

        .ball-date-disable {
            cursor: pointer;
            padding: 15px;
            border-radius: 20px;
            border: 2px solid #E3E5F0;
            background-color: #FFF;
        }
    </style>
@endsection

@section('content')

    <main role="main">

        <div class="container">

            <div class="row">

                <div class="col-12 col-md-11 mx-auto">

                    <!-- <div class="text-center text-md-right">
                        <a class="text-right text-blue" href="#"><i class="fas fa-angle-left mr-3"></i>Voltar ao painel</a>
                    </div> -->


                    <div class="col-12 title pl-0">
                        <h2>Grade de Aula</h2>
                    </div>


                    <div>
                        @if($turmas->count() > 1)

                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownTurmas"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Filtrar por turma
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownTurmas">
                                    @if(Request::segment(5) !== "todas")
                                        <a class="dropdown-item"
                                           href="{{  route('grade-aula.index', ['data' => date('Y-m-d'), 'turma' => 'todas']) }}">
                                            Todas
                                        </a>
                                    @endif
                                    @foreach($turmas as $turma)
                                        <a class="dropdown-item"
                                           href="{{  route('grade-aula.index', ['data' => date('Y-m-d'), 'turma' => $turma->turma->id]) }}">
                                            {{ $turma->turma->titulo }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>

                        @endif
                    </div>


                <section class="my-4">

                    <!-- title dates -->
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="font-weight-bold text-primary mb-2">{{ ucwords(\Carbon\Carbon::now()->subDays(4)->formatLocalized('%d/%m (%a)')) }}</small>
                        <small class="font-weight-bold text-primary mb-2">{{ ucwords(\Carbon\Carbon::now()->subDays(3)->formatLocalized('%d/%m (%a)')) }}</small>
                        <small class="font-weight-bold text-primary mb-2">{{ ucwords(\Carbon\Carbon::now()->subDays(2)->formatLocalized('%d/%m (%a)')) }}</small>
                        <small class="font-weight-bold text-primary mb-2">{{ ucwords(\Carbon\Carbon::now()->subDays(1)->formatLocalized('%d/%m (%a)')) }}</small>
                        <small class="font-weight-bold text-primary mb-2">{{ ucwords(\Carbon\Carbon::now()->formatLocalized('%d/%m (%a)')) }}</small>
                        <small class="font-weight-bold text-primary mb-2">{{ ucwords(\Carbon\Carbon::now()->addDays(1)->formatLocalized('%d/%m (%a)')) }}</small>
                        <small class="font-weight-bold text-primary mb-2">{{ ucwords(\Carbon\Carbon::now()->addDays(2)->formatLocalized('%d/%m (%a)')) }}</small>
                        <small class="font-weight-bold text-primary mb-2">{{ ucwords(\Carbon\Carbon::now()->addDays(3)->formatLocalized('%d/%m (%a)')) }}</small>
                        <small class="font-weight-bold text-primary mb-2">{{ ucwords(\Carbon\Carbon::now()->addDays(4)->formatLocalized('%d/%m (%a)')) }}</small>
                    </div>


                    <!-- bar date -->
                    <div class="d-flex justify-content-between align-items-center">

                        <a href="{{ route('grade-aula.index',['data' => \Carbon\Carbon::now()->subDays(4)->format('Y-m-d'), 'turma' => $turmaUrl]) }}">
                            <div class="{{ (Request::segment(3) === \Carbon\Carbon::now()->subDays(4)->format('Y-m-d') ? 'ball-date-white' : 'ball-date-blue') }}"></div>
                        </a>
                        <div class="bar-date-min {{ (Request::segment(3) <= \Carbon\Carbon::now()->subDays(4)->format('Y-m-d') ? 'bg-white' : 'bg-primary') }}"></div>

                        <a href="{{ route('grade-aula.index', ['data' => \Carbon\Carbon::now()->subDays(3)->format('Y-m-d'), 'turma' => $turmaUrl]) }}">
                            <div class="{{ (Request::segment(3) === \Carbon\Carbon::now()->subDays(3)->format('Y-m-d') ? 'ball-date-white' : 'ball-date-blue') }}"></div>
                        </a>
                        <div class="bar-date-min {{ (Request::segment(3) <= \Carbon\Carbon::now()->subDays(3)->format('Y-m-d') ? 'bg-white' : 'bg-primary') }}"></div>

                        <a href="{{ route('grade-aula.index', ['data' => \Carbon\Carbon::now()->subDays(2)->format('Y-m-d'), 'turma' => $turmaUrl]) }}">
                            <div class="{{ (Request::segment(3) === \Carbon\Carbon::now()->subDays(2)->format('Y-m-d') ? 'ball-date-white' : 'ball-date-blue') }}"></div>
                        </a>
                        <div class="bar-date-min {{ (Request::segment(3) <= \Carbon\Carbon::now()->subDays(2)->format('Y-m-d') ? 'bg-white' : 'bg-primary') }}"></div>

                        <a href="{{ route('grade-aula.index', ['data' => \Carbon\Carbon::now()->subDays(1)->format('Y-m-d'), 'turma' => $turmaUrl]) }}">
                            <div class="{{ (Request::segment(3) === \Carbon\Carbon::now()->subDays(1)->format('Y-m-d') ? 'ball-date-white' : 'ball-date-blue') }}"></div>
                        </a>
                        <div class="bar-date-min {{ (Request::segment(3) <= \Carbon\Carbon::now()->subDays(1)->format('Y-m-d') ? 'bg-white' : 'bg-primary') }}"></div>


                        <!-- dia atual -->
                        <a href="{{  route('grade-aula.index', ['data' => date('Y-m-d'), 'turma' => $turmaUrl]) }}">
                            <div class="{{ (Request::segment(3) === \Carbon\Carbon::now()->format('Y-m-d') ? 'ball-date-white' : 'ball-date-blue') }}"></div>
                        </a>
                        <div class="bar-date-min {{ (Request::segment(3) <= \Carbon\Carbon::now()->format('Y-m-d') ? 'bg-white' : 'bg-primary')  }}"></div>


                        <a href="{{ route('grade-aula.index', ['data' => \Carbon\Carbon::now()->addDays(1)->format('Y-m-d'), 'turma' => $turmaUrl]) }}">
                            <div class="{{ (Request::segment(3) === \Carbon\Carbon::now()->addDays(1)->format('Y-m-d') ? 'ball-date-white' : 'ball-date-disable') }}"></div>
                        </a>
                        <div class="bar-date-min {{ (Request::segment(3) <= \Carbon\Carbon::now()->addDays(1)->format('Y-m-d') ? 'bg-white' : 'bg-primary') }}"></div>


                        <a href="{{ route('grade-aula.index', ['data' => \Carbon\Carbon::now()->addDays(2)->format('Y-m-d'), 'turma' => $turmaUrl]) }}">
                            <div class="{{ (Request::segment(3) === \Carbon\Carbon::now()->addDays(2)->format('Y-m-d') ? 'ball-date-white' : 'ball-date-disable') }}"></div>
                        </a>
                        <div class="bar-date-min {{ (Request::segment(3) <= \Carbon\Carbon::now()->addDays(2)->format('Y-m-d') ? 'bg-white' : 'bg-primary') }}"></div>


                        <a href="{{ route('grade-aula.index', ['data' => \Carbon\Carbon::now()->addDays(3)->format('Y-m-d'), 'turma' => $turmaUrl]) }}">
                            <div class="{{ (Request::segment(3) === \Carbon\Carbon::now()->addDays(3)->format('Y-m-d') ? 'ball-date-white' : 'ball-date-disable') }}"></div>
                        </a>
                        <div class="bar-date-min {{ (Request::segment(3) <= \Carbon\Carbon::now()->addDays(3)->format('Y-m-d') ? 'bg-white' : 'bg-primary') }}"></div>


                        <a href="{{ route('grade-aula.index', ['data' => \Carbon\Carbon::now()->addDays(4)->format('Y-m-d'), 'turma' => $turmaUrl]) }}">
                            <div class="{{ (Request::segment(3) === \Carbon\Carbon::now()->addDays(4)->format('Y-m-d') ? 'ball-date-white' : 'ball-date-disable') }}"></div>
                        </a>


                    </div>

                </section>

                <section>

                    @forelse ($aulas as $aula)
                        <div class="col-md-6 col-lg-4 col-12">
                            <div class="bg-white shadow-sm rounded-10 p-4 mb-3">
                                <h4 class="text-center text-primary">{{ $aula->titulo }}</h4>
                                <div class="d-lg-flex justify-content-between mb-4 pt-2">

                                    <p class="text-primary font-weight-bold">Data</p>

                                    <div class="text-right">
                                        <p class="text-primary font-weight-bold mb-0">
                                            {{ date('H:i', strtotime($aula->hora_inicial)) }}
                                            as {{ date('H:i', strtotime($aula->hora_final)) }}
                                        </p>
                                        {{ strftime('%e de %h de %Y', strtotime($aula->data)) }}
                                    </div>
                                </div>

                                <div class="d-lg-flex justify-content-between border-top mb-4 pt-2">
                                    <p class="text-primary font-weight-bold">Professor(a)</p>
                                    <p class="text-primary text-right">{{ $aula->professor->name }}</p>
                                </div>

                                @forelse($aula->planos->where('data', $date) as $plano)

                                    <div class="d-lg-flex justify-content-between border-top mb-4 pt-2">
                                        <div>
                                            <p class="text-primary font-weight-bold">Matéria</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-primary font-weight-bold mb-0">
                                                <span class="badge badge-info px-3 py-1 rounded-10">GEOGRAFIA</span>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="d-lg-flex d-md-flex justify-content-between border-top mb-4 pt-2">
                                        <p class="text-primary font-weight-bold">Assunto</p>
                                        <p class="text-primary text-right">{{ $plano->assunto }}</p>
                                    </div>
                                    <div class="d-lg-flex justify-content-between border-top mb-4 pt-2">
                                        <p class="text-primary font-weight-bold">Tarefa de classe</p>
                                        <p class="text-blue text-right">{{ $plano->tarefa_classe }}</p>
                                    </div>
                                    <div class="d-lg-flex justify-content-between border-top mb-4 pt-2">
                                        <p class="text-primary font-weight-bold">Tarefa de casa</p>
                                        <p class="text-primary text-right">{{ $plano->tarefa_casa }}</p>
                                    </div>
                                    <div
                                        class="d-lg-flex justify-content-center align-items-center mb-4 pt-2">
                                        <a href="{{ route('plano.aulas.index', $plano->id) }}" class="text-link">
                                            Ver mais
                                        </a>
                                    </div>
                                @empty
                                @endforelse

                            </div>
                        </div>
                    @empty
                        <p>Não há aulas agendadas para esta data.</p>
                    @endforelse

                </section>

                </div>

            </div>

        </div>

    </main>
@endsection

@section('bodyend')
@endsection
