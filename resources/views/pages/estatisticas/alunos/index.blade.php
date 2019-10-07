@extends('layouts.master')

@section('title', 'J. PIAGET - Estatísticas')

@section('headend')

    <!-- Custom styles for this template -->
    <style>

        .text-nivel {
            font-size: 1.5rem;
        }

        .text-completed {
            color: #2AC869;
        }

        .bg-completed {
            background: #2AC869;
        }

        .nav-tabs {
            border-bottom: 0;
        }

        .nav-tabs .nav-item {
            margin-bottom: 0;
        }

        .nav-tabs .nav-link {
            border: 0;
            font-size: 16px;
            border-bottom: 4px solid transparent;
            color: #60748A;
            font-weight: bold;
            padding-bottom: 20px;
            background: transparent;
        }

        .nav-tabs .nav-link.active {
            background: transparent;
            color: #207adc;
            border-bottom: 4px solid #207adc;

        }

        .bg-icon-cards {
            width: 80px;
            height: 80px;
            border-radius: 40px;
            background-color: #60748A;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #E3E5F0;
            font-size: 28px;
        }

        .bg-icon-cards-m {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #207adc;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            font-size: 28px;
        }

        .icon-missoes {
            font-size: 3.0rem;
        }

        @media (max-width: 720px) {
            .bg-icon-cards {
                margin-bottom: 20px;
            }
        }


    </style>

@endsection



@section('content')

    <main role="main">

        <div class="d-flex justify-content-center">
            <div class="container mx-2 mx-lg-5">
                <div class="row">
                    <div class="col-sm-12 col-lg-12 col-xl-8">

                        <div class="row">
                        <!-- card 01 -->

                            <div class="col-12">
                                <div class="bg-white box-shadow rounded-10 p-3 mb-3 text-mobile-center">
                                    <div class="d-md-flex d-lg-flex justify-content-md-between flex-wrap">
                                        <div class="d-md-flex d-lg-flex flex-wrap">
                                            <div class="mr-3 rounded-circle">

                                                <div class="avatar-img avatar-lg mr-2 shadow-none"
                                                    style="background: url({{ route('usuario.perfil.image', [Auth::user()->id]) }}); background-size: cover; background-position: 50% 50%; background-repeat: no-repeat;">
                                                </div>

                                            </div>

                                            {{-- <p hidden>{!! \App\Services\GamificacaoService::incrementUserXP(2000); !!}</p> --}}

                                            <div>
                                                <h4 class="text-primary">{{ Auth::user()->name }}</h4>
                                                <h6>{{ \App\Escola::find(Auth::user()->escola_id) != null ? \App\Escola::find(Auth::user()->escola_id)->titulo : "Escola Jean Piaget2" }}</h6>

                                                <small class="text-primary font-weight-bold">
                                                    {{
                                                        Auth::user()->gamificacao->xp_reseted
                                                        . " / " .
                                                        Auth::user()->gamificacao->next_level_xp(true)
                                                    }}
                                                </small>
                                                <br>
                                                <div class="progress">
                                                    <div class="progress-bar bg-primary" role="progressbar" style="width: {{ Auth::user()->gamificacao->next_level_progress(true) }}%" aria-valuenow="{{ Auth::user()->gamificacao->next_level_progress() }}" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>

                                            </div>
                                        </div>
                                        <div>
                                            <i class="fas fa-star fa-lg text-blue"></i> <span class="text-primary">Nível</span>
                                            <span class="text-primary text-nivel">{{ Auth::user()->gamificacao->level_atual() }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /card 01 -->
                        </div>

                    <div class="row">

                        <div class="col-12">

                        <!-- card 02 -->
                        <div class="bg-white box-shadow rounded-10 p-3 text-mobile-center h-100" style="min-height: 380px; ">
                            <ul class="nav nav-tabs border-bottom ml-4 mr-4" id="myTab" role="tablist">
                                <li class="nav-item col-lg-3 col-sm-12 pl-0">
                                    <a class="nav-link active font-weight-bold text-center" id="hoje-tab" data-toggle="tab"
                                       href="#hoje" role="tab" aria-controls="hoje"
                                       aria-selected="false">Hoje</a>
                                </li>
                                <li class="nav-item col-lg-3 col-sm-12 pl-0">
                                    <a class="nav-link font-weight-bold text-center" id="missoes-tab" data-toggle="tab"
                                       href="#missoes" role="tab" aria-controls="missoes"
                                       aria-selected="false">Missões</a>
                                </li>
                                <li class="nav-item col-lg-3 col-sm-12 pl-0">
                                    <a class="nav-link font-weight-bold text-center" id="materias-tab" data-toggle="tab"
                                       href="#materias" role="tab" aria-controls="materias"
                                       aria-selected="false">Trilhas</a>
                                </li>
                                <li class="nav-item col-lg-3 col-sm-12 pl-0 pr-0">
                                    <a class="nav-link text-center" id="carreira-tab" data-toggle="tab" href="#carreira" role="tab"
                                       aria-controls="carreira" aria-selected="true">Carreira</a>
                                </li>
                            </ul>


                            <div class="tab-content" id="myTabContent">

                                <!-- hoje -->
                                <div class="tab-pane fade show active pt-4 px-1 px-md-4" id="hoje" role="tabpanel"
                                     aria-labelledby="hoje-tab">
                                    <div class="row" style="overflow-y: auto;">

                                        @forelse ($aulas as $aula)
                                            <div class="col-lg-3 col-sm-12 col-lg-12 col-xl-6 pb-3">
                                                <h6 class="text-dark">{{ date("H:i", strtotime($aula->hora_inicial)) }} às {{ date('H:i', strtotime($aula->hora_final)) }}</h6>
                                                <a href="#plano">
                                                    <div
                                                        class="bg-white box-shadow rounded-10 p-3 mt-3 text-mobile-center">
                                                        <p class="text-primary font-weight-normal">
                                                            {{ ucfirst($aula->titulo) }}
                                                        </p>
                                                        <div
                                                            class="d-md-flex d-lg-flex justify-content-between align-items-center flex-wrap">
                                                            @foreach($aula->planos as $plano)
                                                                <div>
                                                                    <span class="badge badge-info pt-1 pb-1 pl-3 pr-3 l-2 pr-2 rounded-10">{{ $plano->materia }}</span>
                                                                </div>
                                                                <small class="font-weight-bold text-bluegray text-uppercase">{{ $plano->nivel_ensino }} {{ $plano->ano_serie }}
                                                                </small>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>

                                        @empty
                                            <p>Não há aulas agendadas hoje.</p>
                                        @endforelse
                                            {{-- @forelse ($aulas as $aula)
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

                                                    @forelse($aula->planos->where('data', date("Y-m-d")) as $plano)

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
                                        @endforelse --}}

                                        {{-- <div class="col-lg-3 col-sm-12 col-lg-12 col-xl-6 pb-3">
                                            <h6 class="text-dark">07:30</h6>
                                            <a href="#plano">
                                                <div
                                                    class="bg-white box-shadow rounded-10 p-3 mt-3 text-mobile-center">
                                                    <p class="text-primary font-weight-normal">
                                                        Módulo 10 <br>
                                                        Meio ambiente
                                                    </p>
                                                    <div
                                                        class="d-md-flex d-lg-flex justify-content-between align-items-center flex-wrap">
                                                        <div>
                                                        <span
                                                            class="badge badge-info pt-1 pb-1 pl-3 pr-3 l-2 pr-2 rounded-10">Geografia</span>
                                                        </div>
                                                        <small class="font-weight-bold text-bluegray">1° ANO 2° BI
                                                        </small>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>

                                        <div class="col-lg-3 col-sm-12 col-lg-12 col-xl-6 pb-3">
                                            <h6 class="text-dark">08:20</h6>
                                            <div
                                                class="bg-white box-shadow rounded-10 p-3 mt-3 text-mobile-center">
                                                <p class="text-primary font-weight-normal">
                                                    Módulo 10 <br>
                                                    Equação
                                                </p>
                                                <div
                                                    class="d-md-flex d-lg-flex justify-content-between align-items-center flex-wrap">
                                                    <div>
                                                    <span
                                                        class="badge badge-primary badge-info pt-1 pb-1 pl-3 pr-3 pl-2 pr-2 rounded-10">Matemática</span>
                                                    </div>
                                                    <small class="font-weight-bold text-bluegray">1° ANO 2° BI</small>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-3 col-sm-12 col-lg-12 col-xl-6 pb-3">
                                            <h6 class="text-dark">09:10</h6>
                                            <div
                                                class="bg-white box-shadow rounded-10 p-3 mt-3 text-mobile-center">
                                                <p class="text-primary font-weight-normal">
                                                    Módulo 10 <br>
                                                    Mitocondria
                                                </p>
                                                <div
                                                    class="d-md-flex d-lg-flex justify-content-between align-items-center flex-wrap">
                                                    <div>
                                                    <span
                                                        class="badge badge-success badge-info pt-1 pb-1 pl-3 pr-3 pl-2 pr-2 rounded-10">Ciências</span>
                                                    </div>
                                                    <small class="font-weight-bold text-bluegray">1° ANO 2° BI</small>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-3 col-sm-12 col-lg-12 col-xl-6 pb-3">
                                            <h6 class="text-dark">Qualquer hora</h6>
                                            <div
                                                class="bg-white box-shadow rounded-10 p-3 mt-3 text-mobile-center">
                                                <p class="text-primary font-weight-normal">
                                                    Simulado ENEM <br>
                                                    Exatas Parte 2/5
                                                </p>
                                                <div
                                                    class="d-md-flex d-lg-flex justify-content-between align-items-center flex-wrap">
                                                    <div>
                                                    <span
                                                        class="badge bg-primary text-white badge-info pt-1 pb-1 pl-3 pr-3 pl-2 pr-2 rounded-10">ENEM</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}


                                    </div>

                                    <div
                                        class="d-flex justify-content-lg-end justify-content-sm-center align-items-center flex-wrap pt-3 pb-3 border-top">
                                        <small class="text-default mr-3">{{ \Carbon\Carbon::now()->formatLocalized('%d de %B de %Y') }}</small>
                                        <a href="{{ route('grade-aula.index', ['date' => date('Y-m-d'), 'turma' => 'todas']) }}" class="text-link font-weight-bold text-primary">AGENDA ESCOLAR</a>
                                    </div>

                                </div>

                                <!-- missoes -->
                                <div class="tab-pane fade show pt-4 px-1 px-md-4" id="missoes" role="tabpanel"
                                     aria-labelledby="missoes-tab">

                                    <!-- Desafios da trilha -->
                                    <div class="mb-5">
                                        <div class="row d-lg-flex justify-content-center align-items-center mb-4">
                                            <div class="col-lg-3 col-md-3">Desafios da trilha</div>
                                            <div class="col-lg-9 col-md-9 border-top"></div>
                                        </div>

                                        <!-- list -->
                                        <div class="row mb-4">
                                            <div class="col-auto">
                                                <div class="d-lg-flex justify-content-between">
                                                    <div class="d-lg-flex justify-content-start">
                                                        <div class="text-muted">
                                                            Você não possui nenhum desafio de trilha em andamento.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- @include('pages.badges.alunos._desafios_card-concluido') --}}

                                        {{-- @include('pages.badges.alunos._desafios_card') --}}

                                    </div>


                                    <!-- Desafios do plano -->
                                    <div class="mb-5">
                                        <div class="row d-lg-flex justify-content-center align-items-center mb-4">
                                            <div class="col-lg-3 col-md-3">Desafios do plano</div>
                                            <div class="col-lg-9 col-md-9 border-top"></div>
                                        </div>

                                        <!-- list -->
                                        <div class="row mb-4">
                                            <div class="col-auto">
                                                <div class="d-lg-flex justify-content-between">
                                                    <div class="d-lg-flex justify-content-start">
                                                        <div class="text-muted">
                                                            Você não possui nenhum desafio de plano em andamento.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="row mb-4">
                                            <div class="col-md-4 col-lg-4">
                                                <div class="d-lg-flex justify-content-between">
                                                    <div class="d-lg-flex justify-content-start">
                                                        <div class="mr-lg-3">
                                                            <i class="fas fa-circle icon-missoes text-primary"></i>
                                                        </div>
                                                        <div class="text-primary">Consiga uma nota de 7 ou maior no
                                                            simulado
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-8 col-lg-8">
                                                <div class="row d-lg-flex justify-content-center align-items-center">
                                                    <div class="col-md-2 col-lg-2 text-center"><b
                                                            class="text-primary">0/10</b></div>
                                                    <div class="col-md-2 col-lg-2 text-center">
                                                        <i class="fas fa-angle-double-right fa-2x"></i>
                                                    </div>
                                                    <div class="col-md-8 col-lg-8 text-center">
                                                        <i class="fas fa-star text-blue mr-2"></i>
                                                        <span class="text-primary">500XP</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}

                                    </div>


                                </div>

                                <!-- Materias -->
                                <div class="tab-pane fade show pt-4 px-1 px-md-4" id="materias" role="tabpanel"
                                     aria-labelledby="materias-tab">

                                    <div class="row">
                                        <div class="col mb-5">
                                            <div class="p-3 mt-3 text-mobile-center">
                                                <p class="text-muted mb-0">
                                                    Você não possui nenhuma trilha em andamento.
                                                </p>
                                            </div>
                                            {{-- <div
                                                class="bg-white box-shadow rounded-10 p-3 mt-3 text-mobile-center">
                                                <p class="text-warning font-weight-bold mb-0">
                                                    PORTUGUÊS
                                                </p>
                                                <small>Média 6,5</small>
                                                <div
                                                    class="d-md-flex d-lg-flex justify-content-end flex-wrap">

                                                    <span class="badge badge-danger rounded-circle">2</span>
                                                </div>
                                            </div> --}}
                                        </div>
                                    </div>

                                </div>

                                <!-- Carreira -->
                                <div class="tab-pane fade show pt-4 px-1 px-md-4" id="carreira" role="tabpanel"
                                     aria-labelledby="carreira-tab">

                                    {{-- <p>Minhas carreiras:</p> --}}

                                    <div class="row">

                                        <div class="col-md-12 col-lg-12 border-bottom pb-4 mt-4">
                                            <div class="d-lg-flex justify-content-between">
                                                <div>
                                                    <span class="text-muted mr-lg-2">
                                                        Você ainda não possui nenhuma carreira em andamento.
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- <div class="col-md-12 col-lg-12 border-bottom pb-4 mt-4">
                                            <div class="d-lg-flex justify-content-between">
                                                <div>
                                                    <b class="text-primary mr-lg-2">ENEM</b> 2/10
                                                </div>

                                                <div>
                                                    <a href="#" class="text-primary font-weight-bold mr-lg-5">
                                                        DETALHES
                                                    </a>
                                                    <a href="#" class="text-danger font-weight-bold">
                                                        DEIXAR DE SEGUIR
                                                    </a>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-md-12 col-lg-12 border-bottom pb-4 mt-4">
                                            <div class="d-lg-flex justify-content-between">

                                                <div>
                                                    <b class="text-primary mr-lg-2">FUVEST</b> 0/10
                                                </div>

                                                <div>
                                                    <a href="#" class="text-primary font-weight-bold mr-lg-5">
                                                        DETALHES
                                                    </a>
                                                    <a href="#" class="text-danger font-weight-bold">
                                                        SEGUIR
                                                    </a>
                                                </div>

                                            </div>
                                        </div> --}}
                                    </div>

                                    {{-- <div class="text-center mt-5">
                                        <a href="#" class="text-primary font-weight-bold">
                                            ADICIONAR NOVO PLANO DE ESTUDOS
                                        </a>
                                    </div> --}}

                                </div>

                            </div>


                            </div>

                        </div>

                        <!-- /card 02 -->
                    </div>

                    </div>


                    <div class="col-sm-12 col-lg-12 col-xl-4">

                        <div class="bg-white box-shadow rounded-10 p-4 text-mobile-center h-100">
                            <p>Última trilha feita</p>
                            <div class="border-bottom mb-3 pb-3">
                                {{-- <div class="d-md-flex d-lg-flex justify-content-md-between mb-5 flex-wrap">
                                    <div class="d-md-flex d-lg-flex flex-wrap">
                                        <div class="mr-3 rounded-circle bg-icon-cards-m">
                                            <i class="fas fa-book"></i>
                                            <!-- <img
                                                src="https://image.winudf.com/v2/image/YnIuY29tLmFjYWljb21jb2RpZ28ubWF0ZW1hdGljYV9pY29uXzE1MjU5MDcxMDRfMDQx/icon.png?w=170&fakeurl=1&type=.png"
                                                alt="Matem[atica" width="50"> -->
                                        </div>
                                        <div>
                                            <span class="text-primary font-weight-bold">Matemática</span> <br>
                                            <span class="text-primary">1° ano 2 Bimestre</span>
                                        </div>
                                    </div>
                                    <div>
                                        <span class="text-primary">15/15</span>
                                    </div>
                                </div>
                                <a href="#" class="btn btn-block font-weight-bold btn-primary text-truncate rounded-10 py-2">CONTINUAR DE ONDE PAREI</a> --}}
                                <div class="d-md-flex d-lg-flex justify-content-md-between mb-3 flex-wrap">
                                    <div class="d-md-flex d-lg-flex flex-wrap">
                                        <div>
                                            <span class="text-muted">
                                                Você não possui nenhuma trilha em andamento.
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <p>Planos atuais</p>
                            <div class="border-bottom mb-3 pb-4">
                                <div class="d-md-flex d-lg-flex justify-content-md-between mb-3 flex-wrap">
                                    <div class="d-md-flex d-lg-flex flex-wrap">
                                        <div>
                                            <span class="text-muted">
                                                Você ainda não começou nenhum plano de estudo.
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="border-bottom mb-3 pb-4">
                                <div class="d-md-flex d-lg-flex justify-content-md-between mb-5 flex-wrap">
                                    <div class="d-md-flex d-lg-flex flex-wrap">
                                        <div class="mr-3 rounded-circle bg-icon-cards-m">
                                            <i class="fas fa-book"></i>
                                        </div>
                                        <div>
                                            <span class="text-primary font-weight-bold">ENEM</span> <br>
                                        </div>
                                    </div>
                                    <div>
                                        <span class="text-primary">2/10</span>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <a href="#" class="font-weight-bold text-truncate text-warning mt-3">CONTINUAR</a>
                                </div>
                            </div>

                            <div class="border-bottom mb-3 pb-4">
                                <div class="d-md-flex d-lg-flex justify-content-md-between mb-5 flex-wrap">
                                    <div class="d-md-flex d-lg-flex flex-wrap">
                                        <div class="mr-3 rounded-circle bg-icon-cards-m">
                                            <i class="fas fa-book"></i>
                                        </div>
                                        <div>
                                            <span class="text-primary font-weight-bold">FUVEST</span> <br>
                                        </div>
                                    </div>
                                    <div>
                                        <span class="text-primary">0/10</span>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <a href="#" class="font-weight-bold text-primary mt-3">INICIAR</a>
                                </div>
                            </div> --}}
                            {{-- <a href="#" class="btn btn-block font-weight-bold btn-outline-primary text-truncate mt-3">INSERIR NOVO PLANO DE ESTUDO</a> --}}
                        </div>

                    </div>
                </div>

                <div class="row">

                    <div class="col-lg-12 mt-3">
                        <div class="row">

                            <!-- card ranking -->
                            <div class="col-sm-12 col-md-12 col-lg-4">
                                <div class="bg-white box-shadow rounded-10 p-3 mb-3 text-mobile-center">
                                    <div class="d-md-flex d-lg-flex flex-column justify-content-md-between flex-wrap">
                                        <div class="d-md-flex d-lg-flex flex-wrap">
                                            <div class="d-flex justify-content-center">
                                                <div class="mr-lg-3 mr-md-3 bg-icon-cards">
                                                    <i class="fas fa-trophy"></i>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-column align-items-start">
                                                @if($turmaIndex != null)
                                                <p class="mb-0 text-right">
                                                    <span class="h3 text-primary mr-1 d-inline-block font-weight-bold">
                                                        {{ $turmaIndex }}°
                                                    </span>
                                                    Ranking da turma
                                                </p>
                                                @endif
                                                <p class="mb-0 text-right">
                                                    <span class="h3 text-primary mr-1 d-inline-block font-weight-bold">
                                                        {{ ($userLogged === null || $userIndex > 500 ? "-" : "$userIndex") }}°
                                                    </span>
                                                    Ranking global
                                                </p>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column justify-content-end align-self-end mt-3">
                                            <a href="{{ route('ranking.index') }}"
                                               class="font-weight-bold text-primary">IR PARA RANKING</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /card ranking -->

                            <!-- card favoritos -->
                            <div class="col-sm-12 col-md-12 col-lg-4">
                                <div class="bg-white box-shadow min-h250 rounded-10 p-3 mb-3 text-mobile-center">
                                    <div class="d-md-flex d-lg-flex flex-column justify-content-md-between flex-wrap">
                                        <div class="d-md-flex d-lg-flex flex-wrap">
                                            <div class="d-flex justify-content-center">
                                                <div class="mr-lg-3 mr-md-3 bg-icon-cards">
                                                    <i class="fas fa-star"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <h3 class="font-weight-bold text-primary">0</h3>
                                                <span>Lista de favoritos</span>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column justify-content-end align-self-end mt-3">
                                            <a href="{{ route('favoritos.index') }}"
                                               class="font-weight-bold text-primary">VER LISTA</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /card favoritos -->

                            <!-- card habilidades -->
                            <div class="col-sm-12 col-md-12 col-lg-4">
                                <div class="bg-white min-h250 box-shadow rounded-10 p-3 mb-3 text-mobile-center">
                                    <div class="d-md-flex d-lg-flex flex-column justify-content-md-between flex-wrap">
                                        <div class="d-md-flex d-lg-flex flex-wrap">
                                            <div class="d-flex justify-content-center">
                                                <div class="mr-lg-3 mr-md-3 bg-icon-cards">
                                                    <i class="fas fa-check-square"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <h3 class="font-weight-bold text-primary">{{ $habilidades }}</h3>
                                                <span>Habilidade{{ $habilidades != 1 ? 's' : '' }} trabalhada{{ $habilidades != 1 ? 's' : '' }}</span>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column justify-content-end align-self-end mt-3">
                                            <a href="{{ route('habilidades.listar') }}"
                                               class="font-weight-bold  text-primary">VER TODAS</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /card habilidades -->

                        </div>
                    </div>

                </div>
            </div>
        </div>


    </main>

@endsection

@section('bodyend')


@endsection

