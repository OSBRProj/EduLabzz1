@extends('layouts.master')

@section('title', 'J. PIAGET - Relatórios')

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

        .capa-curso
        {
            min-height: 160px;
            border-radius: 10px 10px 0px 0px;
            background-image: url('{{ env('APP_LOCAL') }}/images/default-cover.jpg');
            background-size: cover;
            background-position: 50% 50%;
            background-repeat: no-repeat;
        }

        .input-group input.text-secondary::placeholder
        {
            color: #989EB4;
        }

        .form-group label
        {
            color: #213245;
            font-weight: bold;
            font-size: 18px;
        }


        .form-control
        {
            color: #525870;
            font-weight: bold;
            font-size: 16px;
            border: 0px;
            border-radius: 5px;
            box-shadow: 0px 1px 3px rgba(0,0,0,0.16);
        }

        .form-control::placeholder
        {
            color: #B7B7B7;
        }

        .custom-select option:first-child
        {
            color: #B7B7B7;
        }

        input[type=range]::-webkit-slider-thumb
        {
            -webkit-appearance: none;
            border: 0px;
            height: 20px;
            width: 20px;
            border-radius: 50%;
            background: #525870;
            cursor: pointer;
            margin-top: 0px; /* You need to specify a margin in Chrome, but in Firefox and IE it is automatic */
        }

        input[type=range]::-webkit-slider-runnable-track
        {
            width: 100%;
            height: 36px;
            cursor: pointer;
            box-shadow: 0px 1px 3px rgba(0,0,0,0.16);
            background: #5678ef;
            border-radius: 90px;
            border: 8px solid #E3E5F0;
        }

        @media (min-width: 576px)
        {
            .side-menu
            {
                min-height: calc(100vh - 162px);
            }
        }

        .nav-tabs
        {
            border-bottom: 0px;
        }

        .nav-tabs .nav-item
        {
            margin-bottom: 0px;
        }

        .nav-tabs .nav-link
        {
            border: 0px;
            font-size: 18px;
            border-bottom: 4px solid transparent;
            color: #525870;
            font-weight: bold;
            background: transparent;
            padding: 10px;
            padding-bottom: 20px;
        }

        .nav-tabs .nav-link.active
        {
            background: transparent;
            color: #207adc;
            border-bottom: 4px solid #207adc;

        }

        .summernote-holder
        {
            padding: .375rem .75rem;
            border-radius: 0px;
            /*border: 1px solid #B7B7B7;*/
            border: 2px solid #207adc;
            box-shadow: 0px 1px 3px rgba(0,0,0,0.16);
            font-size: initial;
            text-align: initial;
            color: initial;
        }

        main.darkmode .table thead th, main.darkmode .table td, main.darkmode .table th
        {
            border: 0px !important;
        }

        main:not(.darkmode) thead tr
        {
            background-color: #F8F8F8;
        }

        main.darkmode thead tr
        {
            background-color: #1F212E;
        }

        main.darkmode .bg-white.bg-darkmode
        {
            background-color: transparent !important;
        }

        main.darkmode .text-dark
        {
            color: white !important;
        }

        /* Badge Icon style */

        .badge-icon
        {
            width: 45px;
            height: 45px;
            min-height: none;
            background-size: cover;
            background-position: 50% 50%;
            background-repeat: no-repeat;
            margin: 10px;
            border-radius: 8px;
            background-color: #207adc;
            border: 1px solid #989AC1;
        }

    </style>

@endsection

@section('content')

<main role="main" class="">

    <div class="container">

        <div class="row">

            <div class="col-12 col-md-11 mx-auto">

                <div class="col-12 mb-3 title pl-0">
                    <h2>Relatórios</h2>
                </div>

                <ul class="nav nav-tabs mb-5" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="geral-tab" data-toggle="tab" href="#geral" role="tab" aria-controls="mural" aria-selected="true">Visão Geral</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="alunos-tab" data-toggle="tab" href="#cursos" role="tab" aria-controls="alunos" aria-selected="false">Cursos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="turmas-tab" data-toggle="tab" href="#turmas" role="tab" aria-controls="alunos" aria-selected="false">Turmas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="alunos-tab" data-toggle="tab" href="#alunos" role="tab" aria-controls="alunos" aria-selected="false">Alunos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="metricas-tab" data-toggle="tab" href="#metricas" role="tab" aria-controls="metricas" aria-selected="false">Métricas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="alunos-tab" data-toggle="tab" href="#avaliacao" role="tab" aria-controls="alunos" aria-selected="false">Minhas avaliações</a>
                    </li>
                </ul>


                <div class="tab-content" id="tabDadosUsuario">

                    <div class="tab-pane fade show active" id="geral" role="tabpanel" aria-labelledby="geral-tab">

                        <div class="container">

                            <div class="row mb-3">
                                <h4>Início</h4>
                            </div>

                            <div class="row mb-4">

                                <div class="mb-3 col-12">
                                    <div class="row">
                                        @if(strtoupper(Auth::user()->permissao) == 'Z')
                                            <div class="col-12 col-sm-4 mb-3 pl-0">
                                                <div class="bg-white shadow-sm rounded-10 py-5 px-1 text-dark text-center h-100">
                                                    <h3 class="font-weight-bold my-auto">
                                                        {{ $totalEscolas }}
                                                        <small class="d-block mb-2">
                                                            Escolas
                                                        </small>
                                                    </h3>
                                                </div>
                                            </div>
                                        @endif

                                        @if(strtoupper(Auth::user()->permissao) == 'Z')
                                            <div class="col-12 col-sm-4 mb-3  pl-0">
                                                <div class="bg-white shadow-sm rounded-10 py-5 px-1 text-dark text-center h-100">
                                                    <h3 class="font-weight-bold my-auto">
                                                        {{ $totalGestores }}
                                                        <small class="d-block mb-2">
                                                            Gestores
                                                        </small>
                                                    </h3>
                                                </div>
                                            </div>
                                        @endif

                                        @if(strtoupper(Auth::user()->permissao) == 'Z' || strtoupper(Auth::user()->permissao) == 'G')
                                            <div class="col-12 col-sm-4 mb-3  pl-0">
                                                <div class="bg-white shadow-sm rounded-10 py-5 px-1 text-dark text-center h-100">
                                                    <h3 class="font-weight-bold my-auto">
                                                        {{ $totalProfessores }}
                                                        <small class="d-block mb-2">
                                                            Professores
                                                        </small>
                                                    </h3>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="col-12 col-sm-4 pl-0 mb-3">
                                            <div class="bg-white shadow-sm rounded-10 py-5 px-1 text-dark text-center h-100">
                                                <h3 class="font-weight-bold my-auto">
                                                    {{ $totalAlunos }}
                                                    <small class="d-block mb-2">
                                                        Alunos
                                                    </small>
                                                </h3>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-4  pl-0 mb-3">
                                            <div class="bg-white shadow-sm rounded-10 py-5 px-1 text-dark text-center h-100">
                                                <h3 class="font-weight-bold my-auto">
                                                    {{ count($cursos) }}
                                                    <small class="d-block mb-2">
                                                        Cursos
                                                    </small>
                                                </h3>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-4 pl-0 mb-3">
                                            <div class="bg-white shadow-sm rounded-10 py-5 px-1 text-dark text-center h-100">
                                                <h3 class="font-weight-bold my-auto">
                                                    {{ count($conteudos) }}
                                                    <small class="d-block mb-2">
                                                        Conteúdos
                                                    </small>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                    <div class="col-sm-12 col-md-6 col-lg-6 pl-0">
                                        <div class="bg-white shadow-sm rounded-10 px-3 py-4 text-center bg-light">
                                            <h3 class="text-dark mb-2">
                                                <small class="d-block mb-2">
                                                    Média de atividades completas
                                                </small>
                                                {{ $mediaAtividadesCompletas }}%
                                            </h3>
                                            <div class="mt-3 mb-2" style="width: 100%;height: 15px;background-color:  #E3E5F0;border-radius: 5px;display:  inline-block;vertical-align:  -webkit-baseline-middle;">
                                                <div style="width: {{ $mediaAtividadesCompletas }}%;height:  100%;background-color:  #207adc;border-radius: 5px;transition:  0.3s all ease-in-out;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="bg-white shadow-sm rounded-10 px-3 py-4 text-center bg-light">
                                            <h3 class="text-dark mb-2">
                                                <small class="d-block mb-2">
                                                    Participação dos alunos
                                                </small>
                                                {{ number_format($participacao, 2, ',' , '.') }}%
                                            </h3>
                                            <div class="mt-3 mb-2" style="width: 100%;height: 15px;background-color:  #E3E5F0;border-radius: 5px;display:  inline-block;vertical-align:  -webkit-baseline-middle;">
                                                <div style="width: {{ $participacao }}%;height:  100%;background-color:  #207adc;border-radius: 5px;transition:  0.3s all ease-in-out;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>

                            <div class="row my-5">
                                <h4>
                                    Estatísticas
                                </h4>
                            </div>

                            <div class="row">

                                <div class="mb-3 col-12 col-sm-12 col-md-12 col-lg-4 pl-0">
                                    <div class="bg-white shadow-sm rounded-10 py-4 px-3 text-center">
                                        <h5 class="text-dark mb-4">
                                            Acessos à plataforma
                                        </h5>
                                        <div class="chart-container" style="position: relative; width: 100%;">
                                            <canvas id="chartMetricaAcessos"></canvas>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 col-12 col-sm-12 col-md-12 col-lg-4">
                                    <div class="bg-white shadow-sm rounded-10 py-4 px-3 text-center">
                                        <h5 class="text-dark mb-4">
                                            Média de alunos conectados
                                        </h5>
                                        <div class="chart-container" style="position: relative; width: 100%;">
                                            <canvas id="myChart"></canvas>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 col-12 col-sm-12 col-md-12 col-lg-4">
                                    <div class="bg-white shadow-sm rounded-10 py-4 px-3 text-center">
                                        <h5 class="text-dark mb-4">
                                            Nível de aprendizado
                                        </h5>
                                        <div class="chart-container" style="position: relative; width: 100%;">
                                            <canvas id="myChart2"></canvas>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="tab-pane fade" id="turmas" role="tabpanel" aria-labelledby="turmas-tab">

                        <div class="">

                            <div class="my-3">
                                <h4 class="w-100">
                                    <span>Turmas (<strong>{{ $totalTurmas }}</strong>) </span>

                                    <div class="dropdown float-right" hidden>
                                        <label for="cmbLimite" class="mr-2 font-weight-bold text-lightgray">Filtrar por:</label>
                                        <button class="btn dropdown-toggle w-auto border-0 bg-gray shadow-sm font-weight-bold" type="button" id="cmbLimite" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Todos
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            {{--  @foreach ($cursos as $curso)
                                                <a class="dropdown-item font-weight-bold text-lightgray" href="#">{{ ucfirst($curso->titulo) }}</a>
                                            @endforeach  --}}
                                        </div>
                                    </div>
                                </h4>
                            </div>

                            <div class="">

                                    <div class="mb-3">
                                        <div class="py-3 text-left">
                                            <div class="">

                                                @foreach ($turmas as $turma)

                                                    <div class="row py-3 rounded">
                                                        <div class="col-auto my-auto text-center">
                                                            <button type="button" data-toggle="collapse" data-target="#collapseTurma{{ $turma->id }}" aria-expanded="false" aria-controls="collapseExample" class="btn btn-sm btn-primary collapsed">
                                                                <i class="fas fa-plus fa-lg"></i>
                                                            </button>
                                                        </div>
                                                        <div class="col my-auto">
                                                            <a href="#" data-toggle="collapse" data-target="#collapseTurma{{ $turma->id }}" class="h5 font-weight-bold m-0">
                                                                {{ ucfirst($turma->titulo) }}
                                                            </a>
                                                        </div>
                                                        <div class="col my-auto ml-auto text-right">
                                                            <h5 class="m-0">
                                                                <strong>{{ $turma->qt_alunos }}</strong> Aluno{{ $turma->qt_alunos != 1 ? 's' : '' }}
                                                            </h5>
                                                            <a target="_blank" href="{{ Request::is('gestao/*') ? route('gestao.turma-mural', ['idTurma' => $turma->id]) : route('turma-mural', ['idTurma' => $turma->id]) }}" class="btn btn-outline-primary float-right">
                                                                Ver mural
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">

                                                        <div class="col-12 collapse" id="collapseTurma{{ $turma->id }}" style="">

                                                            <div class="mb-5">

                                                                <div class="row">
                                                                    <div class="col-12 col-sm-3 px-2 mb-3">
                                                                        <div class="bg-white shadow-sm rounded-10 py-5 px-1 text-center text-dark h-100">
                                                                            <h4 class="font-weight-bold my-auto">
                                                                                {{ $turma->participacaoAlunos }}%
                                                                                <small class="d-block mt-2">
                                                                                    Participação dos alunos
                                                                                </small>
                                                                            </h4>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-12 col-sm-3 px-2 mb-3">
                                                                        <div class="bg-white shadow-sm rounded-10 py-5 px-1 text-center text-dark h-100">
                                                                            <h4 class="font-weight-bold my-auto">
                                                                                {{ $turma->qt_alunos }}
                                                                                <small class="d-block mt-2">
                                                                                    Alunos
                                                                                </small>
                                                                            </h4>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-12 col-sm-3 px-2 mb-3">
                                                                        <div class="bg-white shadow-sm rounded-10 py-5 px-1 text-center text-dark h-100">
                                                                            <h4 class="font-weight-bold my-auto">
                                                                                {{ $turma->qt_postagens }}
                                                                                <small class="d-block mt-2">
                                                                                    Postagens
                                                                                </small>
                                                                            </h4>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-12 col-sm-3 px-2 mb-3">
                                                                        <div class="bg-white shadow-sm rounded-10 py-5 px-1 text-center text-dark h-100">
                                                                            <h4 class="font-weight-bold my-auto">
                                                                                {{ $turma->qt_comentarios }}
                                                                                <small class="d-block mt-2">
                                                                                    Comentários
                                                                                </small>
                                                                            </h4>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-12 col-sm-3 px-2 mb-3">
                                                                        <div class="bg-white shadow-sm rounded-10 py-5 px-1 text-center text-dark h-100">
                                                                            <h4 class="font-weight-bold my-auto">
                                                                                {{ $turma->qt_duvidas }}
                                                                                <small class="d-block mt-2">
                                                                                    Dúvidas
                                                                                </small>
                                                                            </h4>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <hr class="my-3" style="border-top: 1px solid rgb(87, 92, 119);">

                                                                <div class="mx-2 px-2">

                                                                    <h5>
                                                                        Alunos em risco ({{ count($turma->alunosRisco) }})
                                                                    </h5>

                                                                    <div class="table-responsive">
                                                                        <table class="table table-hover mb-0">
                                                                            <thead class="thead-default">
                                                                                <tr>
                                                                                    <th class="">Nome</th>
                                                                                    <th class="">E-mail</th>
                                                                                    <th class="">Última atividade</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody class="bg-white bg-darkmode">

                                                                            @if(count($turma->alunosRisco) > 0)
                                                                                @foreach ($turma->alunosRisco as $aluno)
                                                                                    <tr class="rounded-10 shadow-sm">
                                                                                        <td>{{ ucwords($aluno->user->name) }}</td>
                                                                                        <td> {{ $aluno->user->email }} </td>
                                                                                        <td class="d-none d-xl-table-cell">{{ (strftime("%d de %b de %G às %H:%M", strtotime($aluno->user->ultima_atividade))) }}</td>
                                                                                    </tr>
                                                                                @endforeach
                                                                            @else
                                                                                <tr class="rounded-10 shadow-sm">
                                                                                    <td colspan="4" class="align-middle">
                                                                                        Não há alunos em risco
                                                                                    </td>
                                                                                </tr>
                                                                            @endif

                                                                            </tbody>
                                                                        </table>
                                                                    </div>

                                                                </div>

                                                                <hr class="my-3" style="border-top: 1px solid rgb(87, 92, 119);">

                                                                <div class="mx-2 px-2">

                                                                    <h5>
                                                                        Alunos inativos em 30 dias ou mais ({{ count($turma->alunosInativos) }})
                                                                    </h5>

                                                                    <div class="table-responsive">
                                                                        <table class="table table-hover mb-0">
                                                                            <thead class="thead-default">
                                                                                <tr>
                                                                                    <th class="">Nome</th>
                                                                                    <th class="">E-mail</th>
                                                                                    <th class="">Última atividade</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody class="bg-white bg-darkmode">

                                                                            @if(count($turma->alunosInativos) > 0)
                                                                                @foreach ($turma->alunosInativos as $aluno)
                                                                                    <tr class="rounded-10 shadow-sm">
                                                                                        <td>{{ ucwords($aluno->user->name) }}</td>
                                                                                        <td> {{ $aluno->user->email }} </td>
                                                                                        <td class="d-none d-xl-table-cell">{{ (strftime("%d de %b de %G às %H:%M", strtotime($aluno->user->ultima_atividade))) }}</td>
                                                                                    </tr>
                                                                                @endforeach
                                                                            @else
                                                                                <tr class="rounded-10 shadow-sm">
                                                                                    <td colspan="4" class="align-middle">
                                                                                        Não há alunos inativos
                                                                                    </td>
                                                                                </tr>
                                                                            @endif

                                                                            </tbody>
                                                                        </table>
                                                                    </div>

                                                                </div>

                                                                <hr class="my-3" style="border-top: 1px solid rgb(87, 92, 119);">

                                                                <div class="mx-2 px-2">

                                                                    <h5>
                                                                        Métricas gerais de cada aluno
                                                                    </h5>

                                                                    <div class="table-responsive">
                                                                        <table class="table table-hover mb-0">
                                                                            <thead class="thead-default">
                                                                                <tr>
                                                                                    <th class="">Nome</th>
                                                                                    <th class="">E-mail</th>
                                                                                    <th class="">Postagens</th>
                                                                                    <th class="">Comentários</th>
                                                                                    <th class="">Dúvidas</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody class="bg-white bg-darkmode">

                                                                            @if(count($turma->alunos_user) > 0)
                                                                                @foreach ($turma->alunos_user as $aluno)
                                                                                    @if($aluno->user != null)
                                                                                    <tr class="rounded-10 shadow-sm">
                                                                                        <td>{{ ucwords($aluno->user->name) }}</td>
                                                                                        <td> {{ $aluno->user->email }} </td>
                                                                                        <td> {{ $aluno->qt_postagens }} </td>
                                                                                        <td> {{ $aluno->qt_comentarios }} </td>
                                                                                        <td> {{ $aluno->qt_duvidas }} </td>
                                                                                    </tr>
                                                                                    @endif
                                                                                @endforeach
                                                                            @else
                                                                                <tr class="rounded-10 shadow-sm">
                                                                                    <td colspan="4" class="align-middle">
                                                                                        Esta turma ainda não possui nenhum aluno.
                                                                                    </td>
                                                                                </tr>
                                                                            @endif

                                                                            </tbody>
                                                                        </table>
                                                                    </div>

                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                @endforeach

                                            </div>
                                        </div>
                                    </div>

                                </div>

                        </div>

                    </div>

                    <div class="tab-pane fade" id="cursos" role="tabpanel" aria-labelledby="cursos-tab">

                            <div>

                                <div class="my-3">
                                    <h4 class="w-100">
                                        <span>Matriculados (<strong>{{ $totalMatriculados }}</strong>) </span>

                                        <div class="dropdown float-right">
                                            <label for="cmbLimite" class="mr-2 font-weight-bold">Filtrar por:</label>
                                            <button class="btn dropdown-toggle w-auto border-0 bg-gray shadow-sm font-weight-bold" type="button" id="cmbLimite" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Todos
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                @foreach ($cursos as $curso)
                                                    <a class="dropdown-item font-weight-bold text-lightgray" href="#">{{ ucfirst($curso->titulo) }}</a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </h4>
                                </div>

                                <div class="row">

                                    <div class="col-12 mb-3">
                                        <div class="py-3 text-left" style="border-bottom:  1px solid #E3E5F0;">
                                            <div class="">

                                                @foreach ($cursos as $curso)

                                                    <div class="row my-3">
                                                        <div class="col-auto my-auto text-center">
                                                            <button type="button" data-toggle="collapse" data-target="#collapseCurso{{ $curso->id }}" aria-expanded="false" aria-controls="collapseExample" class="btn btn-sm btn-primary collapsed">
                                                                <i class="fas fa-plus fa-lg" ></i>
                                                            </button>
                                                        </div>
                                                        <div class="col my-auto">
                                                            <h5 class="font-weight-bold m-0">
                                                                {{ ucfirst($curso->titulo) }}
                                                            </h5>
                                                        </div>
                                                        <div class="col my-auto ml-auto text-right">
                                                            <h5 class="font-weight-bold m-0">
                                                                {{ count($curso->matriculas) }} matriculado{{ count($curso->matriculas) != 1 ? 's' : '' }}
                                                            </h5>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12 collapse" id="collapseCurso{{ $curso->id }}" style="">
                                                            <div class="container-fluid mb-5">
                                                                <div class="mx-2 px-2 pt-3 mt-3" style="border-top: 3px solid #F9F9F9;">

                                                                    @foreach ($curso->matriculas as $matricula)

                                                                        <div class="row mb-3">
                                                                            <div class="col my-auto">
                                                                                <h6 class="m-0 text-bluegray">
                                                                                    {{ ucfirst($matricula->user->name) }}
                                                                                </h6>
                                                                            </div>
                                                                            <div class="col ml-auto my-auto text-right">
                                                                                <h6 class="font-weight-bold text-uppercase {{ $matricula->progresso < 100 ? 'text-bluegray' : 'text-primary' }} m-0">
                                                                                    {{ $matricula->progresso }}%
                                                                                </h6>
                                                                            </div>
                                                                        </div>

                                                                    @endforeach

                                                                    @if(count($curso->matriculas) == 0)
                                                                        <div class="row mb-3">
                                                                            <div class="col my-auto">
                                                                                <h6 class="m-0 text-bluegray">
                                                                                    Este curso ainda não possui nenhum aluno matriculado.
                                                                                </h6>
                                                                            </div>
                                                                        </div>
                                                                    @endif

                                                                </div>
                                                            </div>
                                                            </div>
                                                    </div>

                                                @endforeach

                                            </div>
                                        </div>
                                    </div>

                                </div>

                        </div>

                    </div>

                    <div class="tab-pane fade" id="alunos" role="tabpanel" aria-labelledby="alunos-tab">

                        <div class="">

                            <div class="row mt-4 mb-3 ml-0">
                                <h4 class="w-100">
                                    <span>Alunos (<strong>{{ count($alunos) }}</strong>)</span>

                                    <div class="d-inline-block float-right mb-4 pr-0 text-right">
                                        <input type="text" name="pesquisa" value="" placeholder="Procurar usuário" oninput="filtrarUsuarios(this);" class="form-control text-truncate border-0 bg-gray d-inline-block">
                                    </div>

                                    <div class="dropdown float-right" hidden>
                                        <label for="cmbLimite" class="mr-2 font-weight-bold text-lightgray">Filtrar por:</label>
                                        <button class="btn dropdown-toggle w-auto border-0 bg-gray shadow-sm font-weight-bold" type="button" id="cmbLimite" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Todos
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            {{--  @foreach ($cursos as $curso)
                                                <a class="dropdown-item font-weight-bold text-lightgray" href="#">{{ ucfirst($curso->titulo) }}</a>
                                            @endforeach  --}}
                                        </div>
                                    </div>
                                </h4>
                            </div>

                            <div class="row">

                                    <div class="col-12 mb-3 pl-0">
                                        <div class="py-3 text-left text-bluegray">
                                            <div class="container-fluid">

                                                <div class="d-none">
                                                    <div class="row py-3 rounded">
                                                        <div class="col my-auto">
                                                            <h5 class="sem-resultado font-weight-bold m-0">
                                                                Nenhum aluno encontrado.
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>

                                                @foreach ($alunos as $aluno)

                                                    <div class="col-12 pl-0">
                                                        <div class="row py-3 rounded">
                                                            <div class="col my-auto">
                                                                <a href="#" data-toggle="collapse" data-target="#collapseAluno{{ $aluno->id }}" class="h5 aluno-name-label font-weight-bold m-0">
                                                                    {{ ucwords($aluno->name) }}
                                                                </a>
                                                            </div>
                                                            <div class="col-auto my-auto text-center">
                                                                <button type="button" data-toggle="collapse" data-target="#collapseAluno{{ $aluno->id }}" aria-expanded="false" aria-controls="collapseExample" class="btn btn-sm btn-primary bg-transparent collapsed">
                                                                    <i class="fas fa-caret-down fa-fw"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">

                                                            <div class="col-12 collapse" id="collapseAluno{{ $aluno->id }}" style="">

                                                                <div class="mb-5">

                                                                    <div class="row">
                                                                        <div class="col-12 col-sm-3 px-2 mb-3">
                                                                            <div class="bg-white shadow-sm rounded-10 py-5 px-1 text-center text-dark h-100">
                                                                                <h4 class="font-weight-bold my-auto">
                                                                                    {{ $aluno->qt_acessos }}
                                                                                    <small class="d-block mt-2">
                                                                                        Acessos na plataforma
                                                                                    </small>
                                                                                </h4>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-12 col-sm-3 px-2 mb-3">
                                                                            <div class="bg-white shadow-sm rounded-10 py-5 px-1 text-center text-dark h-100">
                                                                                <h4 class="font-weight-bold my-auto">
                                                                                    {{ $aluno->qt_postagens }}
                                                                                    <small class="d-block mt-2">
                                                                                        Postagens
                                                                                    </small>
                                                                                </h4>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-12 col-sm-3 px-2 mb-3">
                                                                            <div class="bg-white shadow-sm rounded-10 py-5 px-1 text-center text-dark h-100">
                                                                                <h4 class="font-weight-bold my-auto">
                                                                                    {{ $aluno->qt_comentarios }}
                                                                                    <small class="d-block mt-2">
                                                                                        Comentários
                                                                                    </small>
                                                                                </h4>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-12 col-sm-3 px-2 mb-3">
                                                                            <div class="bg-white shadow-sm rounded-10 py-5 px-1 text-center text-dark h-100">
                                                                                <h4 class="font-weight-bold my-auto">
                                                                                    {{ $aluno->qt_duvidas }}
                                                                                    <small class="d-block mt-2">
                                                                                        Dúvidas
                                                                                    </small>
                                                                                </h4>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <hr class="my-3" style="border-top: 1px solid rgb(87, 92, 119);">

                                                                    <div class="mx-2 px-2">

                                                                        <h5>
                                                                            Badges ({{ $aluno->badges_user != null ? count($aluno->badges_user) : 0 }})
                                                                        </h5>

                                                                        <div class="table-responsive">
                                                                            <table class="table table-hover mb-0">
                                                                                <thead class="thead-default">
                                                                                    <tr>
                                                                                        <th class="">Icone</th>
                                                                                        <th class="">Titulo</th>
                                                                                        <th class="">Descrição</th>
                                                                                        <th class="">Data de desbloqueio</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody class="bg-white bg-darkmode">
                                                                                @if($aluno->badges_user != null ? count($aluno->badges_user) > 0 : false)
                                                                                    @foreach ($aluno->badges_user as $badge_user)
                                                                                        <tr class="rounded-10 shadow-sm">
                                                                                            <td class="align-middle">
                                                                                                @if($badge_user->badge->icone != "")
                                                                                                <div class="badge-icon" style="background-image: url('{{ env('APP_LOCAL') . '/uploads/badges/' .  $badge_user->badge->icone }}');">
                                                                                                </div>
                                                                                                @endif
                                                                                            </td>
                                                                                            <td class="align-middle">
                                                                                                {{ ucfirst($badge_user->badge->titulo) }}
                                                                                            </td>
                                                                                            <td class="align-middle">
                                                                                                {{ ucfirst($badge_user->badge->descricao) }}
                                                                                            </td class="align-middle">
                                                                                            <td class="d-none d-xl-table-cell align-middle">{{ (strftime("%d de %b de %G às %H:%M", strtotime($badge_user->created_at))) }}</td>
                                                                                        </tr>
                                                                                    @endforeach
                                                                                @else
                                                                                    <tr class="rounded-10 shadow-sm">
                                                                                        <td colspan="4" class="align-middle">
                                                                                            Este aluno não possui badges
                                                                                        </td>
                                                                                    </tr>
                                                                                @endif

                                                                                </tbody>
                                                                            </table>
                                                                        </div>

                                                                    </div>

                                                                    <hr class="my-3" style="border-top: 1px solid rgb(87, 92, 119);">

                                                                    <div class="mx-2 px-2">

                                                                        <h5>
                                                                            Progresso nos conteúdos e atividades ({{ $aluno->progressos != null ? count($aluno->progressos) : 0 }})
                                                                        </h5>

                                                                        <div class="table-responsive">
                                                                            <table class="table table-hover mb-0">
                                                                                <thead class="thead-default">
                                                                                    <tr>
                                                                                        <th class="">Conteudo</th>
                                                                                        <th class="">Progresso</th>
                                                                                        <th class="">Última atualização</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody class="bg-white bg-darkmode">

                                                                                @if($aluno->progressos != null ? count($aluno->progressos) > 0 : false)
                                                                                    @foreach ($aluno->progressos as $progresso)
                                                                                        <tr class="rounded-10 shadow-sm">
                                                                                            {{--  <td>{{ ucfirst($progresso->titulo) }}</td>  --}}
                                                                                            @if($progresso->tipo == 1)
                                                                                                <td>
                                                                                                    <a target="_blank" href="{{ route('aplicacao', ['idAplicacao' => $progresso->conteudo_id]) }}">
                                                                                                        {{ ucfirst($progresso->titulo) }}
                                                                                                    </a>
                                                                                                </td>
                                                                                            @elseif($progresso->tipo == 2)
                                                                                                <td>
                                                                                                    <a target="_blank" href="{{ route('conteudo.play', ['idConteudo' => $progresso->conteudo_id]) }}">
                                                                                                        {{ ucfirst($progresso->titulo) }}
                                                                                                    </a>
                                                                                                </td>
                                                                                            @else
                                                                                                <td>{{ ucfirst($progresso->titulo) }}</td>
                                                                                            @endif
                                                                                            <td>{{ $progresso->progresso }}%</td>
                                                                                            <td class="d-none d-xl-table-cell">{{ (strftime("%d de %b de %G às %H:%M", strtotime($progresso->updated_at))) }}</td>
                                                                                        </tr>
                                                                                    @endforeach
                                                                                @else
                                                                                    <tr class="rounded-10 shadow-sm">
                                                                                        <td colspan="4" class="align-middle">
                                                                                            Este aluno não possui nenhum progresso
                                                                                        </td>
                                                                                    </tr>
                                                                                @endif

                                                                                </tbody>
                                                                            </table>
                                                                        </div>

                                                                    </div>

                                                                    <hr class="my-3" style="border-top: 1px solid rgb(87, 92, 119);">

                                                                    <div class="mx-2 px-2">

                                                                        <h5>
                                                                            Tempo de interação por conteúdo - Total 0 horas
                                                                        </h5>

                                                                        <div class="table-responsive">
                                                                            <table class="table table-hover mb-0">
                                                                                <thead class="thead-default">
                                                                                    <tr>
                                                                                        <th class="">Conteudo</th>
                                                                                        <th class="">Tempo médio</th>
                                                                                        <th class="">Tempo total</th>
                                                                                        <th class="">Última interação</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody class="bg-white bg-darkmode">

                                                                                @if($aluno->interacoes != null ? count($aluno->interacoes) > 0 : false)
                                                                                    @foreach ($aluno->interacoes as $interacao)
                                                                                        <tr class="rounded-10 shadow-sm">
                                                                                            @if($interacao["tipo"] == 1)
                                                                                                <td>
                                                                                                    <a target="_blank" href="{{ route('aplicacao', ['idAplicacao' => $interacao["conteudo_id"]]) }}">
                                                                                                        {{ ucfirst($interacao["titulo"]) }}
                                                                                                    </a>
                                                                                                </td>
                                                                                            @elseif($interacao["tipo"] == 2)
                                                                                                <td>
                                                                                                    <a target="_blank" href="{{ route('conteudo.play', ['idConteudo' => $interacao["conteudo_id"]]) }}">
                                                                                                        {{ ucfirst($interacao["titulo"]) }}
                                                                                                    </a>
                                                                                                </td>
                                                                                            @else
                                                                                                <td>{{ ucfirst($interacao["titulo"]) }}</td>
                                                                                            @endif
                                                                                            <td>{{ gmdate("H", $interacao["tempo_medio"]) . ' hora' . (gmdate("H", $interacao["tempo_medio"]) != 1 ? 's' : '') . ' e ' . gmdate("i", $interacao["tempo_medio"]) . ' minuto' . (gmdate("i", $interacao["tempo_medio"]) != 1 ? 's' : '') }}</td>
                                                                                            <td>{{ gmdate("H", $interacao["tempo_total"]) . ' hora' . (gmdate("H", $interacao["tempo_total"]) != 1 ? 's' : '') . ' e ' . gmdate("i", $interacao["tempo_total"]) . ' minuto' . (gmdate("i", $interacao["tempo_total"]) != 1 ? 's' : '') }}</td>
                                                                                            <td class="d-none d-xl-table-cell">{{ (strftime("%d de %b de %G às %H:%M", strtotime($interacao["ultima_interacao"]))) }}</td>
                                                                                        </tr>
                                                                                    @endforeach
                                                                                @else
                                                                                    <tr class="rounded-10 shadow-sm">
                                                                                        <td colspan="4" class="align-middle">
                                                                                            Este aluno não possui nenhum progresso
                                                                                        </td>
                                                                                    </tr>
                                                                                @endif

                                                                                </tbody>
                                                                            </table>
                                                                        </div>

                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                @endforeach

                                            </div>
                                        </div>
                                    </div>

                                </div>

                        </div>

                    </div>

                    <div class="tab-pane fade" id="metricas" role="tabpanel" aria-labelledby="metricas-tab">

                        <div class="col-12">

                            <div class="row mt-0 mb-3">

                                <h4 class="w-100 mb-2">
                                    <span>Métricas </span>
                                </h4>

                                <div class="col mt-auto form-group mb-3 pl-0">
                                    <label for="cmbMetrica" class="text-dark d-inline-block mr-3">Selecione uma métrica: </label>
                                    <select class="form-control d-inline-block w-auto text-primary" name="metrica" id="cmbMetrica" onchange="atualizarMetrica();">
                                        @foreach ($metricas as $metrica)
                                            <option value="{{ $metrica }}">{{ $metrica }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <h4 class="w-100 my-3">
                                    Filtros:
                                </h4>

                                @if(strtoupper(Auth::user()->permissao) == 'Z')
                                    <div class="col mt-auto form-group mb-3 pl-0">
                                        <label for="cmbEscola" class="text-dark d-inline-block mr-3">Selecione uma escola: </label>
                                        <select class="form-control d-inline-block w-auto text-primary" name="escola" id="cmbEscola" onchange="selecionouEscola(this.value);">
                                            <option value="">Todas escolas</option>
                                            @foreach ($escolas as $escola)
                                                <option value="{{ $escola->id }}">{{ ucwords($escola->titulo) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif

                                @if(strtoupper(Auth::user()->permissao) == 'Z' || strtoupper(Auth::user()->permissao) == 'G')
                                    <div class="col mt-auto form-group mb-3">
                                        <label for="cmbTurma" class="text-dark d-inline-block mr-3">Selecione uma turma: </label>
                                        <select class="form-control d-inline-block w-auto text-primary" name="turma" id="cmbTurma" onchange="selecionouTurma(this.value);">
                                            <option value="">Todas turmas</option>
                                            @foreach ($turmas as $turma)
                                                <option value="{{ $turma->id }}">{{ ucwords($turma->titulo) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif

                                <div class="col mt-auto form-group mb-3">
                                    <label for="cmbAluno" class="text-dark d-inline-block mr-3">Selecione um aluno: </label>
                                    <select class="form-control d-inline-block w-auto text-primary" name="aluno" id="cmbAluno" onchange="selecionouAluno(this.value);">
                                        <option value="">Todos alunos</option>
                                        @foreach ($alunos as $aluno)
                                            <option value="{{ $aluno->id }}">{{ "Id: " . $aluno->id  . " - " .  ucwords($aluno->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="w-100"></div>

                                <div class="col mt-2 form-group mb-3 pl-0">
                                    <label for="txtStartDateRange" class="text-dark d-inline-block mr-3">De: </label>
                                    <input type="date" value="{{ date("Y-m-01") }}" placeholder="dd/mm/yyyy" class="form-control d-inline-block w-auto text-primary" name="startDateRange" id="txtStartDateRange" onchange="atualizarMetrica();">
                                    <label for="txtEndDateRange" class="text-dark d-inline-block mx-3">até: </label>
                                    <input type="date" value="{{ date("Y-m-30") }}" placeholder="dd/mm/yyyy" class="form-control d-inline-block w-auto text-primary" name="endDateRange" id="txtEndDateRange" onchange="atualizarMetrica();">
                                </div>

                            </div>

                            <div class="row">

                                    <div class="col-12 mb-3 pl-0">
                                        <div class="text-center">
                                            <div class="bg-white p-3 rounded-10 shadow-sm chart-container" style="position: relative; width: auto; max-width: 50vh;">
                                                <canvas id="chartMetrica"></canvas>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                        </div>

                    </div>

                    <div class="tab-pane fade" id="avaliacao" role="tabpanel" aria-labelledby="avaliacao-tab">

                        <div class="container-fluid">
                            <div class="row mb-5 text-center">
                                <div class="col-12">
                                        <div class="avatar-img avatar-img-lg my-3 mx-auto shadow-sm" style="width: 54px;height: 54px; background: url({{ route('usuario.perfil.image', [Auth::user()->id]) }}); background-size: cover; background-position: 50% 50%; background-repeat: no-repeat; border: 0px;"></div>
                                        <h2>
                                            {{ ucfirst(Auth::user()->name) }}
                                            <small class="d-block mt-3">
                                                <span class="text-lightgray">({{ $avaliacaoInstrutor }}) </span>
                                                <span>
                                                    @for ($i = 0; $i < floor($avaliacaoInstrutor); $i++)
                                                        <i class="fas fa-star text-warning"></i>
                                                    @endfor
                                                    @for ($i = 0; $i < (5 - floor($avaliacaoInstrutor)); $i++)
                                                        <i class="far fa-star text-warning"></i>
                                                    @endfor
                                                </span>
                                            </small>
                                        </h2>
                                </div>
                            </div>

                            <div class="row mt-5 mb-3">
                                <h4>
                                    Avaliações
                                </h4>
                            </div>

                            <div class="row">

                                <div class="col-12">

                                    <ul class="list-group py-3">

                                        <li class="list-group-item font-weight-bold bg-transparent" style="border: 0px;">

                                            @foreach ($avaliacoes as $avaliacao)

                                                <div class="row">
                                                    <div class="col-auto text-left pl-0 pr-4">
                                                        <div class="avatar-img avatar-img-md my-0 d-inline-block" style="width: 54px;height: 54px; background: url({{ route('usuario.perfil.image', [$avaliacao->user['id']]) }}); background-size: cover; background-position: 50% 50%; background-repeat: no-repeat;"></div>
                                                    </div>
                                                    <div class="col text-left">
                                                        <div class="d-inline-block align-middle mb-2">
                                                            <h5 class="font-weight-bold">
                                                                {{ ucwords($avaliacao->user->name) }}
                                                                <small class="d-inline-block ml-2">
                                                                        @for ($i = 0; $i < floor($avaliacao->avaliacao); $i++)
                                                                        <i class="fas fa-star text-warning"></i>
                                                                        @endfor
                                                                        @for ($i = 0; $i < (5 - floor($avaliacao->avaliacao)); $i++)
                                                                            <i class="far fa-star text-warning"></i>
                                                                        @endfor
                                                                </small>
                                                            </h5>
                                                        </div>
                                                        @if($avaliacao->descricao != '')
                                                            <p class="font-weight-normal">
                                                                {{ $avaliacao->descricao }}
                                                            </p>
                                                        @endif
                                                    </div>
                                                </div>



                                            @endforeach

                                        </li>

                                    </ul>

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

    <!-- Chart JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <script src="{{ asset('/assets/js/Chart-rounded.min.js') }}"></script>

    <!-- Mask JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>

    <script>

        $( document ).ready(function()
        {

            if(window.location.hash)
            {
                $(".nav-link[href='" + window.location.hash + "']").tab('show');
            }

            atualizarMetrica();

        });

        $.expr[":"].contains = $.expr.createPseudo(function(arg) {
            return function( elem ) {
                return $(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
            };
        });

        function filtrarUsuarios(input)
        {
            $( ".aluno-name-label" ).parent().parent().parent().addClass('d-none');
            $( ".aluno-name-label:contains('" + input.value + "')" ).parent().parent().parent().removeClass('d-none');

            if($( ".aluno-name-label:contains('" + input.value + "')" ).length == 0)
            {
                $( ".sem-resultado" ).parent().parent().parent().removeClass('d-none');
            }
            else
            {
                $( ".sem-resultado" ).parent().parent().parent().addClass('d-none');
            }
        }

        function atualizarMetrica()
        {
            var metrica = $("#cmbMetrica").val();

            $.ajax({
                url: '{{ env('APP_URL') }}/gestao/metrica/' + metrica,
                data: {
                    escola: $("#cmbEscola").val(),
                    turma: $("#cmbTurma").val(),
                    aluno: $("#cmbAluno").val(),
                    startDateRange: $("#txtStartDateRange").val(),
                    endDateRange: $("#txtEndDateRange").val(),
                },
                success: function(data) {

                    console.log(data);

                    //console.log(Object.keys(data.metrica).length);

                    if(data.success != null && data.metrica != null)
                    {
                        console.log(data.metrica);

                        chartMetrica.data.labels = Object.keys(data.metrica);
                        chartMetrica.data.datasets[0].label = metrica
                        chartMetrica.data.datasets[0].data = Object.values(data.metrica);

                        chartMetrica.update();
                    }
                    else
                    {
                        swal("", "Algo deu errado, por favor atualize a página e tente novamente.", "warning");
                    }

                },

            }).fail(function(jqXHR, textStatus) {
                console.error( "Request failed: " + textStatus );
            });
        }

        function selecionouEscola(escola)
        {


            atualizarMetrica();
        }

        function selecionouTurma(turma)
        {


            atualizarMetrica();
        }

        function selecionouAluno(aluno)
        {


            atualizarMetrica();
        }

        var ctx = document.getElementById("myChart").getContext('2d');

        var myChart = new Chart(ctx, {
            type: 'horizontalBar',
            data: {
                labels: ["31 vezes ou mais", "16 a 30 vezes", "6 a 15 vezes", "1 a 5 vezes", "Nenhuma vez"],
                datasets: [{
                    label: '',
                    data: {{ json_encode($mediaAlunosConectados) }},
                    backgroundColor: [
                        '#207adc',
                        '#00E4B5',
                        '#FCE66F',
                        '#FFC748',
                        '#EA5275'
                    ],
                    borderColor: [
                        '#207adc',
                        '#00E4B5',
                        '#FCE66F',
                        '#FFC748',
                        '#EA5275'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                cornerRadius: 50,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        },
                        gridLines: {
                            display: false
                        },
                        barPercentage: 0.5,
                    }],
                    xAxes: [{
                        gridLines: {
                            display: false
                        }
                    }]
                },
                legend: {
                    display: false
                },
                tooltips: {
                    enabled: false
                }
            }
        });

        var ctx = document.getElementById("chartMetricaAcessos").getContext('2d');

        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode(array_keys($metricaAcessosPlataforma->toArray())) !!},
                datasets: [{
                    label: 'Acesso à plataforma',
                    data: {!! json_encode($metricaAcessosPlataforma->values()->toArray()) !!},
                    backgroundColor: 'rgba(32, 122, 220, 0.65)',
                    borderColor: '#207adc',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                cornerRadius: 50,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        },
                        gridLines: {
                            display: false
                        },
                    }],
                    xAxes: [{
                        gridLines: {
                            display: false
                        }
                    }]
                },
                legend: {
                    display: false
                },
                tooltips: {
                    enabled: true
                }
            }
        });

        var ctx = document.getElementById("myChart2").getContext('2d');

        var myChart = new Chart(ctx, {
            type: 'horizontalBar',
            data: {
                labels: ["Alto", "", "Médio", "", "Baixo", "Não avaliado"],
                datasets: [{
                    label: '',
                    data: {{ json_encode($nivelAprendizado) }},
                    backgroundColor: [
                        '#207adc',
                        '#00E4B5',
                        '#FCE66F',
                        '#FFC748',
                        '#EA5275'
                    ],
                    borderColor: [
                        '#207adc',
                        '#00E4B5',
                        '#FCE66F',
                        '#FFC748',
                        '#EA5275'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                cornerRadius: 50,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        },
                        gridLines: {
                            display: false
                        },
                        barPercentage: 0.5,
                    }],
                    xAxes: [{
                        gridLines: {
                            display: false
                        }
                    }]
                },
                legend: {
                    display: false
                },
                tooltips: {
                    enabled: false
                }
            }
        });

        var ctx = document.getElementById("chartMetrica").getContext('2d');

        var chartMetrica = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [],
                datasets: [{
                    label: '',
                    data: [],
                    backgroundColor: 'rgba(32, 122, 220, 0.65)',
                    borderColor: '#207adc',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                cornerRadius: 50,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: false,
                            fontColor: "#207adc",
                        },
                        gridLines: {
                            display: false
                        },
                    }],
                    xAxes: [{
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            fontColor: "#207adc",
                            beginAtZero: true
                        }
                    }]
                },
                legend: {
                    display: true,
                    labels: {
                        fontColor: "#207adc",
                    }
                },
                tooltips: {
                    enabled: true,
                    fontColor: "#207adc",
                }
            }
        });


    </script>

@endsection
