@extends('layouts.master')

@section('title', 'J. PIAGET - ' . $escola->titulo)

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

        .input-group input::placeholder
        {
            color: #207adc;
        }

        .form-group label
        {
            color: #213245;
            font-weight: bold;
            font-size: 18px;
        }

        main.darkmode .form-group label
        {
            color: #7E80A2;
        }

        .form-control::placeholder
        {
            color: #7E80A2 !important;
        }

        .form-control
        {
            font-weight: bold;
            font-size: 16px;
            border: 0px;
            border-radius: 5px;
            box-shadow: 0px 1px 3px rgba(0,0,0,0.16);
        }

        .form-control:focus
        {
            color: #207adc;
        }

        main.darkmode .form-control, main.darkmode .input-group-append
        {
            background-color: #02010C;
        }

        .input-group-append
        {
            border-radius: 0px 5px 5px 0px;
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

        .bg-postagem, .bg-card
        {
            background-color: white !important;
        }

        progress[value] {
            /* Reset the default appearance */
            -webkit-appearance: none;
            appearance: none;
        }

        progress[value]::-webkit-progress-bar, progress[value]::-moz-progress-bar, progress[value]::-ms-progress-bar {
            background-color: #eee;
            border-radius: 2px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.25) inset;
        }

        progress[value]::-webkit-progress-value, progress[value]::-moz-progress-value, progress[value]::-ms-progress-value {
            background-image:
                -webkit-linear-gradient(-45deg,
                                        transparent 33%, rgba(0, 0, 0, .1) 33%,
                                        rgba(0,0, 0, .1) 66%, transparent 66%),
                -webkit-linear-gradient(top,
                                        rgba(255, 255, 255, .25),
                                        rgba(0, 0, 0, .25)),
                -webkit-linear-gradient(left, #207adc, #207adc);

            border-radius: 2px;
            background-size: 35px 20px, 100% 100%, 100% 100%;
        }

        @media print
        {
            .col-6, .box-codigo
            {
                width: 33% !important;
            }

            .print-hide
            {
                display: none !important;
                opacity: 0 !important;
            }

            body, main, .darkmode, main.darkmode
            {
                background: white !important;
                background-color: white !important;
            }
        }

        @media not print
        {
            .box-codigo
            {
                display: none !important;
                opacity: 0 !important;
            }
        }

    </style>

@endsection

@section('content')

<main role="main" class="">

    <div class="container">


        <div class="row">

            <div class="col-12 col-md-11 mx-auto">


            <div class="col-12 mb-3 title pl-0 text-center border-0">
                <div class="avatar-img avatar-lg my-3 mx-auto shadow-sm d-block d-md-inline-block" style="width: 54px;height: 54px; background: url({{ $escola->capa != "" ? (env('APP_LOCAL') . '/uploads/escolas/capas/' . $escola->capa) : '' }}); background-size: cover; background-position: 50% 50%; background-repeat: no-repeat; border: 0px; background-color: #B2AC83;"></div>
                <h2 class="d-inline-block text-dark font-weight-normal ml-4 mb-0 align-middle">
                    {{ ucfirst($escola->titulo) }}
                </h2>
            </div>

            <ul class="nav nav-tabs border-bottom justify-content-center mb-4" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="geral-tab" data-toggle="tab" href="#geral" role="tab" aria-controls="mural" aria-selected="true">Resumo</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link" id="permissoes-tab" data-toggle="tab" href="#permissoes" role="tab" aria-controls="mural" aria-selected="true">Permissões</a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link" id="codigos-tab" data-toggle="tab" href="#codigos" role="tab" aria-controls="codigos" aria-selected="false">Códigos de acesso</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="aplicacoes-tab" data-toggle="tab" href="#aplicacoes" role="tab" aria-controls="alunos" aria-selected="false">Liberar aplicações</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="biblioteca-tab" data-toggle="tab" href="#biblioteca" role="tab" aria-controls="alunos" aria-selected="false">Biblioteca</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="turmas-tab" data-toggle="tab" href="#turmas" role="tab" aria-controls="alunos" aria-selected="false">Turmas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="professores-tab" data-toggle="tab" href="#professores" role="tab" aria-controls="alunos" aria-selected="false">Professores</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="alunos-tab" data-toggle="tab" href="#alunos" role="tab" aria-controls="alunos" aria-selected="false">Alunos</a>
                </li>
            </ul>

            <div class="tab-content" id="tabDadosUsuario">

                <div class="tab-pane fade show active" id="geral" role="tabpanel" aria-labelledby="geral-tab">

                    <div class="container-fluid">

                        <div class="row mb-3" hidden>
                            <h4>Inicio</h4>
                        </div>

                        <div class="row mb-4">

                            <div class="col-12 col-lg-6 mb-3 mb-lg-0">
                                <div class="container px-0">
                                    <div class="row">

                                        <div class="col-4 px-2 mb-3">
                                            <div class="bg-card shadow-sm rounded py-5 px-2 text-center h-100">
                                                <h4 class="font-weight-bold my-auto">
                                                    {{ $totalProfessores }}
                                                    <small class="d-block mb-2 text-truncate">
                                                        Professores
                                                    </small>
                                                </h4>
                                            </div>
                                        </div>

                                        <div class="col-4 px-2 mb-3">
                                            <div class="bg-card shadow-sm rounded py-5 px-1 text-center text-darkmode h-100">
                                                <h4 class="font-weight-bold my-auto">
                                                    {{ $totalAlunos }}
                                                    <small class="d-block mb-2 text-truncate">
                                                        Alunos
                                                    </small>
                                                </h4>
                                            </div>
                                        </div>

                                        <div class="col-4 px-2 mb-3">
                                            <div class="bg-card shadow-sm rounded py-5 px-1 text-center text-darkmode h-100">
                                                <h4 class="font-weight-bold my-auto">
                                                    {{ count($aplicacoes) }}
                                                    <small class="d-block mb-3 text-truncate">
                                                        Aplicações
                                                    </small>
                                                </h4>
                                            </div>
                                        </div>

                                        <div class="col-4 px-2 mb-3">
                                            <div class="bg-card shadow-sm rounded py-5 px-1 text-center text-darkmode h-100 text-truncate">
                                                <h4 class="font-weight-bold my-auto">
                                                    {{ count($conteudos) }}
                                                    <small class="d-block mb-3 text-truncate">
                                                            Conteudos
                                                    </small>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6 pr-0">
                                <div class="container px-0">
                                    <div class="row">

                                        <div class="col-6">
                                                <div class="bg-card shadow-sm rounded py-3 px-3 text-center h-100" style="display: flex; flex-direction: column; justify-content: space-between;">
                                                <h4>
                                                    <small class="d-block my-2">
                                                        Média de atividades completas
                                                    </small>
                                                </h4>
                                                <h4 class="text-darkmode my-2">
                                                    {{ $mediaAtividadesCompletas }}%
                                                </h4>
                                                <div class="mt-3 mb-2" style="width: 100%;height: 15px;background-color: #000313; border-radius: 5px; display: inline-block; vertical-align: -webkit-baseline-middle;">
                                                    <div style="width: {{ $mediaAtividadesCompletas }}%;height:  100%; background-color: #207adc; border-radius: 5px;transition:  0.3s all ease-in-out;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-5 px-2">
                                            <div class="bg-card shadow-sm rounded py-3 px-3 text-center h-100" style="display: flex; flex-direction: column; justify-content: space-between;">
                                                <h4>
                                                    <small class="d-block mb-2">
                                                        Participação
                                                    </small>
                                                </h4>
                                                <h4 class="text-darkmode mb-2">
                                                    {{ $participacao }}%
                                                </h4>
                                                <div class="mt-3 mb-2" style="width: 100%;height: 15px;background-color:  #000313;border-radius: 5px;display:  inline-block;vertical-align:  -webkit-baseline-middle;">
                                                    <div style="width: {{ $participacao }}%;height:  100%;background-color:  #207adc;border-radius: 5px;transition:  0.3s all ease-in-out;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                        <hr class="mb-4">

                        <div class="row mt-4 mb-3" hidden>
                            <h4>
                                Estatísticas
                            </h4>
                        </div>

                        <div class="row">

                            <div class="col-4 mb-auto">
                                <div class="bg-card shadow-sm rounded py-2 px-3 text-center">
                                    <h5 class="text-darkmode mb-2">
                                        Média de alunos conectados
                                    </h5>
                                    <div class="chart-container" style="position: relative; width: 100%;">
                                        <canvas id="myChart"></canvas>
                                    </div>
                                </div>
                            </div>

                            <div class="col-8 mb-auto">
                                <div class="bg-card shadow-sm rounded py-2 px-3 text-center">
                                    <h5 class="text-darkmode mb-2">
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

                <div class="tab-pane fade" id="codigos" role="tabpanel" aria-labelledby="codigos-tab">

                    <div class="container">

                        <div class="">
                            <div class="row">

                                <div class="w-100">

                                <h5 class="font-weight-bold">Gerar códigos:</h5>

                                @if(($escola->limite_alunos - count($alunos)) > 0)
                                <form id="formGerarCodigos" method="POST" action="{{ route('gestao.escola.codigos-gerar', ["idEscola" => $escola->id]) }}" class="">

                                    @csrf

                                    <div class="form-group mb-3 text-left">
                                        <p class="font-weight-bold" for="aplicacao_id">Vincular a uma turma</p>
                                        <select id="turma_id" name="turma_id" required onchange="mudouTipoLiberacaoAplicacao(this);" class="custom-select border-0 rounded">
                                            <option disabled selected>Selecione uma turma</option>
                                            @foreach ($turmas as $turma)
                                                <option value="{{ $turma->id }}">{{ ucfirst($turma->titulo) }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group mb-3 text-left">
                                        <h5 class="font-weight-bold mb-4" for="aplicacao_id">Quantidade de códigos a serem gerados:</h5>
                                        <input id="quantidade" name="quantidade" type="number" min="0" max="{{ ($escola->limite_alunos - count($alunos) - \App\CodigoAcessoEscola::where([['escola_id', $escola->id], ['aluno_id', null]])->count()) > 0 ? $escola->limite_alunos - count($alunos) : 0 }}" placeholder="Digitar." class="form-control rounded shadow-sm" required autofocus>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Gerar códigos</button>

                                </form>
                                @else
                                    <p class="">
                                        Você não pode gerar mais códigos
                                    </p>
                                @endif
                                </div>

                            </div>
                        </div>

                        <div class="row mt-4 mb-3">
                            <h5 class="w-100">
                                <span class="text-darkmode">Códigos gerados: ({{ count($codigosAcesso)  . '/' . $escola->limite_alunos }}) - Alunos vinculados: ({{ count($alunos) . '/' . $escola->limite_alunos }})</span>
                                @if(count($codigosAcesso) > 0)
                                <button type="button" onclick="$('.box-codigo, .box-codigo:not(.print-hide) span.codigo').printThis({ importCSS: true });" class="btn btn-success float-right">Imprimir códigos</button>
                                @endif
                            </h5>
                        </div>

                        <div class="row">

                                <div class="col-12 px-0 mb-3">

                                    @if(count($codigosAcesso) > 0)
                                        <div class="">
                                            <div id="divCodigosGerados" class="row">
                                                @foreach ($codigosAcesso as $codigo)

                                                    @if($codigo->aluno_id == null)
                                                        <div class="d-inline-block p-3 m-2 border-thin border-secondary box-codigo bg-white rounded text-center">
                                                            <h4>{{ ucwords($escola->titulo) }}</h4>
                                                            <span class="d-block mb-2 text-center">
                                                                Na hora de se cadastrar
                                                                <br>
                                                                utilize o código de acesso abaixo:
                                                            </span>
                                                            <h4>{{ mb_strtoupper($codigo->codigo, 'UTF-8') }}</h4>
                                                        </div>
                                                    @endif

                                                    <div id="divCodigoAcesso{{ $codigo->id }}" class="col-12 col-sm-6 col-lg-4 mb-3 {{ $codigo->aluno_id != null ? 'print-hide' : '' }}">
                                                        <div class="card shadow-sm rounded text-decoration-none h-100 border-0 shadow-sm">
                                                            <div class="py-3 px-4 h-100">
                                                                <span class="d-block mb-2">
                                                                    {{ mb_strtoupper($codigo->codigo, 'UTF-8') }}
                                                                </span>
                                                                <span class="d-block mb-2 print-hide">
                                                                    Turma vinculada: {{ $codigo->turma_id != null ? (\App\Turma::find($codigo->turma_id) != null ? ucwords(\App\Turma::find($codigo->turma_id)->titulo) : "Turma não encontrada") : "Não vinculado" }}
                                                                </span>
                                                                <span class="d-block mb-2 print-hide">
                                                                    Aluno: {{ $codigo->aluno_id != null ? \App\User::find($codigo->aluno_id) != null ? ucwords(\App\User::find($codigo->aluno_id)->name) : "Anônimo" : "Não utilizado" }}
                                                                </span>
                                                                @if($codigo->aluno_id != null)
                                                                <span class="d-block mb-2 print-hide">
                                                                    Data da utilização: {{ (strftime("%d de %b de %G às %H:%M", strtotime($codigo->updated_at))) }}
                                                                </span>
                                                                @endif
                                                            </div>

                                                            <button class="btn btn-link text-gray float-right p-2" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="position: absolute;right: 0px;margin-right: 15px;">
                                                                <i class="fas fa-ellipsis-v"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <button type="button" onclick="excluirCodigo({{ $codigo->id }});" class="btn btn-link text-danger dropdown-item">
                                                                    Excluir código
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                @endforeach
                                            </div>
                                        </div>
                                    @else
                                        <p class="">
                                            Você ainda não liberou nenhuma aplicação para esta escola.
                                        </p>
                                    @endif

                                </div>

                            </div>

                    </div>

                </div>

                <div class="tab-pane fade" id="aplicacoes" role="tabpanel" aria-labelledby="aplicacoes-tab">

                    <div class="container">

                        <div class="">
                            <div class="row">

                                <form id="formNovoConteudo" method="POST" action="{{ route('gestao.aplicacoes.liberacao.escola-nova') }}" class="w-100">

                                    @csrf

                                    <input type="hidden" name="escola_id" value="{{ $escola->id }}">

                                    <h5 id="lblTipoNovoConteudo" class="mb-4 font-weight-bold">Nova liberação:</h5>

                                    <div class="form-group mb-3 text-left">
                                        <p class="font-weight-bold text-gray" for="aplicacao_id">O que deseja liberar?</p>
                                        <select id="tipo_liberacao" name="tipo_liberacao" required onchange="mudouTipoLiberacaoAplicacao(this);" class="custom-select font-weight-bold border-0 rounded">
                                            <option value="1">Liberar por aplicação</option>
                                            <option value="2" selected>Liberar por coleção</option>
                                        </select>
                                    </div>

                                    <div id="divLiberarAplicacao" class="form-group mb-3 text-left d-none">
                                        <p class="font-weight-bold text-gray" for="aplicacao_id">Aplicação a ser liberada</p>
                                        <select id="aplicacao_id" name="aplicacao_id" required class="custom-select font-weight-bold border-0 rounded">
                                            <option disabled selected value="0">Selecione uma aplicação</option>
                                            @foreach ($aplicacoes as $aplicacao)
                                                <option value="{{ $aplicacao->id }}">{{ ucwords($aplicacao->titulo) }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Liberar aplicação</button>

                                </form>

                            </div>
                        </div>

                        <div class="row mt-4 mb-3">
                            <h5 class="w-100 font-weight-bold">
                                <span>Aplicações liberadas:</span>
                            </h5>
                        </div>

                        <div class="row">

                                <div class="col-12 px-0 mb-3">

                                    @if(count($liberacaoAplicacoesEscola) > 0)
                                        <div class="py-2">
                                            <div class="row">
                                                @foreach ($liberacaoAplicacoesEscola as $liberacao)

                                                    <div id="divLiberacaoAplicacao{{ $liberacao->id }}" class="col-12 col-sm-6 col-lg-4 mb-3">
                                                        <div class="card shadow-sm rounded text-decoration-none h-100 border-0">
                                                            <div class="py-3 px-4 h-100" style="font-size: 16px;flex: 1;">
                                                                <span class="d-block mb-2">
                                                                    {{ ucfirst($liberacao->titulo) }}
                                                                </span>
                                                                <span class="d-block mb-2">
                                                                    Coleção:
                                                                    {{--  {{ ucfirst($liberacao->colecao) }}  --}}
                                                                </span>
                                                            </div>

                                                            <button class="btn btn-link text-gray float-right p-2" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="position: absolute;right: 0px;margin-right: 15px;">
                                                                <i class="fas fa-ellipsis-v"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a target="_blank" href="{{ route('hub.aplicacao', ['idAplicacao' => $liberacao->aplicacao_id]) }}" class="btn btn-link dropdown-item">
                                                                    Abrir aplicação
                                                                </a>
                                                                <button type="button" onclick="excluirLiberacao({{ $liberacao->id }});" class="btn btn-link text-danger dropdown-item">
                                                                    Excluir liberaçao
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                @endforeach
                                            </div>
                                        </div>
                                    @else
                                        <p class="">
                                            Você ainda não liberou nenhuma aplicação para esta escola.
                                        </p>
                                    @endif

                                </div>

                            </div>

                    </div>

                </div>

                <div class="tab-pane fade" id="biblioteca" role="tabpanel" aria-labelledby="biblioteca-tab">

                    <div class="container-fluid">

                        <div class="row mt-4 mb-3">
                            <h5 class="w-100">
                                <span class="font-weight-bold">Biblioteca</span>
                            </h5>
                        </div>

                        <div class="row">

                                <div class="col-12 px-0 mb-3">

                                    @if(count($videos) > 0)
                                        <section>

                                            <h5 class="w-100 my-2">
                                                <i class="fas fa-video small-2 align-middle mr-2"></i>
                                                <span class="font-weight-bold align-middle">Vídeos</span>
                                            </h5>

                                            <div class="py-2">
                                                <div class="row">
                                                    @foreach ($videos as $conteudo)

                                                        <div class="col-12 col-sm-6 col-lg-4 mb-3">
                                                            <div class="card shadow-sm rounded text-decoration-none h-100 border-0">
                                                                <div class="py-3 px-4 h-100" style="font-size: 16px;flex: 1;">
                                                                    <span class="d-block mb-2">
                                                                        {{ ucfirst($conteudo->titulo) }}
                                                                    </span>
                                                                    <span class="d-block font-weight-bold mb-2">
                                                                        <i class="fas fa-video fa-fw mr-1"></i>
                                                                        Vídeo
                                                                    </span>
                                                                    <span class="d-block font-weight-bold mb-2 {{ $conteudo->status == 0 ? 'text-danger' : 'text-success' }}">
                                                                        <i class="fas fa-{{ $conteudo->status == 0 ? 'times' : 'check' }} fa-fw mr-1"></i>
                                                                        {{ $conteudo->status == 0 ? 'Não publicado' : 'Publicado' }}
                                                                    </span>
                                                                </div>

                                                                <button class="btn btn-link text-gray float-right p-2" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="position: absolute;right: 0px;margin-right: 15px;">
                                                                    <i class="fas fa-ellipsis-v"></i>
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    <a target="_blank" href="{{ route('conteudo.play', ['idConteudo' => $conteudo->id]) }}" class="btn btn-link dropdown-item">
                                                                        Abrir conteúdo
                                                                    </a>
                                                                    <button type="button" onclick="editarConteudo({{ $conteudo->id }})" class="btn btn-link dropdown-item">
                                                                        Editar conteúdo
                                                                    </button>
                                                                    <button type="button" onclick="excluirConteudo({{ $conteudo->id }});" class="btn btn-link text-danger dropdown-item">
                                                                        Excluir conteúdo
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    @endforeach
                                                </div>
                                            </div>
                                        </section>
                                    @endif

                                    @if(count($slides) > 0)
                                        <section>

                                            <h5 class="w-100 my-2">
                                                <i class="fas fa-file-powerpoint small-2 align-middle mr-2"></i>
                                                <span class="font-weight-bold align-middle">Slides</span>
                                            </h5>

                                            <div class="py-2">
                                                <div class="row">
                                                    @foreach ($slides as $conteudo)

                                                        <div class="col-12 col-sm-6 col-lg-4 mb-3">
                                                            <div class="card shadow-sm rounded text-decoration-none h-100 border-0">
                                                                <div class="py-3 px-4 h-100" style="font-size: 16px;flex: 1;">
                                                                    <span class="d-block mb-2">
                                                                        {{ ucfirst($conteudo->titulo) }}
                                                                    </span>
                                                                    <span class="d-block font-weight-bold mb-2">
                                                                        <i class="fas fa-file-powerpoint fa-fw mr-1"></i>
                                                                        Slide
                                                                    </span>
                                                                    <span class="d-block font-weight-bold mb-2 {{ $conteudo->status == 0 ? 'text-danger' : 'text-success' }}">
                                                                        <i class="fas fa-{{ $conteudo->status == 0 ? 'times' : 'check' }} fa-fw mr-1"></i>
                                                                        {{ $conteudo->status == 0 ? 'Não publicado' : 'Publicado' }}
                                                                    </span>
                                                                </div>

                                                                <button class="btn btn-link text-gray float-right p-2" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="position: absolute;right: 0px;margin-right: 15px;">
                                                                    <i class="fas fa-ellipsis-v"></i>
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    <a target="_blank" href="{{ route('conteudo.play', ['idConteudo' => $conteudo->id]) }}" class="btn btn-link dropdown-item">
                                                                        Abrir conteúdo
                                                                    </a>
                                                                    <button type="button" onclick="editarConteudo({{ $conteudo->id }})" class="btn btn-link dropdown-item">
                                                                        Editar conteúdo
                                                                    </button>
                                                                    <button type="button" onclick="excluirConteudo({{ $conteudo->id }});" class="btn btn-link text-danger dropdown-item">
                                                                        Excluir conteúdo
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    @endforeach
                                                </div>
                                            </div>
                                        </section>
                                    @endif

                                    @if(count($documentos) > 0)
                                        <section>
                                            <h5 class="w-100 my-2">
                                                <i class="fas fa-file-pdf small-2 align-middle mr-2"></i>
                                                <span class="font-weight-bold align-middle">Documentos</span>
                                            </h5>

                                            <div class="py-2">
                                                <div class="row">
                                                    @foreach ($documentos as $conteudo)

                                                        <div class="col-12 col-sm-6 col-lg-4 mb-3">
                                                            <div class="card shadow-sm rounded text-decoration-none h-100 border-0">
                                                                <div class="py-3 px-4 h-100" style="font-size: 16px;flex: 1;">
                                                                    <span class="d-block mb-2">
                                                                        {{ ucfirst($conteudo->titulo) }}
                                                                    </span>
                                                                    <span class="d-block font-weight-bold mb-2">
                                                                        <i class="fas fa-file-pdf fa-fw mr-1"></i>
                                                                        Documento
                                                                    </span>
                                                                    <span class="d-block font-weight-bold mb-2 {{ $conteudo->status == 0 ? 'text-danger' : 'text-success' }}">
                                                                        <i class="fas fa-{{ $conteudo->status == 0 ? 'times' : 'check' }} fa-fw mr-1"></i>
                                                                        {{ $conteudo->status == 0 ? 'Não publicado' : 'Publicado' }}
                                                                    </span>
                                                                </div>

                                                                <button class="btn btn-link text-gray float-right p-2" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="position: absolute;right: 0px;margin-right: 15px;">
                                                                    <i class="fas fa-ellipsis-v"></i>
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    <a target="_blank" href="{{ route('conteudo.play', ['idConteudo' => $conteudo->id]) }}" class="btn btn-link dropdown-item">
                                                                        Abrir conteúdo
                                                                    </a>
                                                                    <button type="button" onclick="editarConteudo({{ $conteudo->id }})" class="btn btn-link dropdown-item">
                                                                        Editar conteúdo
                                                                    </button>
                                                                    <button type="button" onclick="excluirConteudo({{ $conteudo->id }});" class="btn btn-link text-danger dropdown-item">
                                                                        Excluir conteúdo
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    @endforeach
                                                </div>
                                            </div>
                                        </section>
                                    @endif


                                </div>

                            </div>

                    </div>

                </div>

                <div class="tab-pane fade" id="turmas" role="tabpanel" aria-labelledby="turmas-tab">

                    <div class="container-fluid">

                        <div class="row my-4">
                            <h5 class="w-100 font-weight-bold">
                                Gestão de turmas
                            </h5>
                        </div>

                        <div class="row mt-4">
                            <div class="col pl-0 text-left">
                                <div class="dropdown">
                                    <label for="cmbLimite" class="h5 mr-2 font-weight-normal">Limite:</label>
                                    <button class="btn dropdown-toggle w-auto border-0 bg-white shadow-sm text-primary" type="button" id="cmbLimite" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ $amountTurmas }}
                                    </button>
                                    <div class="dropdown-menu bg-dark" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item text-white" href="?qtTurmas=10">10</a>
                                        <a class="dropdown-item text-white" href="?qtTurmas=15">15</a>
                                        <a class="dropdown-item text-white" href="?qtTurmas=20">20</a>
                                        <a class="dropdown-item text-white" href="?qtTurmas=35">35</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col pr-0">
                                <form action="" method="get" class="input-group mb-3">
                                    <input type="text" name="pesquisa" value="{{ Request::get('pesquisa') }}" required class="form-control text-truncate border-1 d-inline-block" placeholder="Procurar turma">
                                    <button type="submit" class="btn btn-primary px-3 m-0 border-0 input-group-append d-inline-block">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="row">
                            <hr class="w-100 mb-4">
                        </div>

                        <div class="row">
                            <div class="col-12 mb-3 text-md-left">
                                <label class="mr-2 font-weight-bold align-middle">
                                    <span id="lblSelecionados">1</span> / {{ $turmas->count() }} - {{ $turmas->total() }} no total
                                </label>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12 px-0">
                                <a href="{{ route('gestao.turmas') }}" class="btn btn-block btn-primary text-white font-weight-bold rounded shadow-none px-4 mb-2 mb-sm-0 text-truncate" data-keyboard="false" data-backdrop="static">
                                    <i class="fas fa-plus mr-3"></i>
                                    Cadastrar nova turma
                                </a>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-12 px-0 mb-3">

                                <div class="container-fluid pt-4">
                                    <div class="row">

                                        @foreach ($turmas as $turma)

                                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2 px-2 mb-3">
                                                <div class="px-3 pt-1 pb-0 bg-card rounded shadow-sm text-secondary h-100" style="display: flex;flex-direction: column;align-items: flex-start;justify-content: space-between;">

                                                    <button class="btn btn-link text-gray float-right p-2" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="position: absolute;right: 0px;margin-right: 15px;">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <button type="button" onclick="excluirTurma({{ $turma->id }});" class="btn btn-link text-danger dropdown-item">
                                                            Excluir turma
                                                        </button>
                                                    </div>

                                                    <h5 class="my-3"style="margin-right: 15px;">
                                                        {{ ucfirst($turma->titulo) }}

                                                        <small class="d-block mt-2">
                                                            Prof.: {{ ucfirst($turma->professor->name) }}
                                                            <i class="fas fa-check-circle fa-fw fa-sm ml-1" style="color: #798AC4;"></i>
                                                        </small>

                                                        <small class="d-block mt-2" style="color: #B2AC83">
                                                           <strong> {{ $turma->qt_alunos }}</strong> aluno{{ $turma->qt_alunos != 1 ? 's' : '' }}
                                                        </small>
                                                    </h5>

                                                    <a target="_blank" href="{{ route('gestao.turma-mural', ['idTurma' => $turma->id]) }}" class="btn btn-outline-primary btn-sm d-block my-3 text-center mx-auto text-uppercase small font-weight-bold" style="width: 100%;f">
                                                        VER MURAL
                                                    </a>

                                                </div>
                                            </div>

                                        @endforeach

                                        @if(count($turmas) == 0)
                                            <div class="col-12 px-2 mb-3">
                                                <div class="px-1 pt-1 pb-0 bg-white rounded shadow-sm text-secondary">
                                                    <div class="px-3">
                                                        <h5 class="my-3 pb-3">
                                                            Esta escola ainda não possui nenhuma turma.
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="tab-pane fade" id="professores" role="tabpanel" aria-labelledby="professores-tab">

                    <div class="container-fluid">

                        <div class="row my-4">
                            <h5 class="w-100">
                                <strong>Gestão de professores</strong>
                            </h5>
                        </div>

                        <div class="row mt-4">
                            <div class="col pl-0 text-left">
                                <div class="dropdown">
                                    <label for="cmbLimite" class="h5 mr-2 font-weight-normal">Limite:</label>
                                    <button class="btn dropdown-toggle w-auto border-0 bg-white shadow-sm text-primary" type="button" id="cmbLimite" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ $amountProfessores }}
                                    </button>
                                    <div class="dropdown-menu bg-dark" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item text-white" href="?qtProfessores=10">10</a>
                                        <a class="dropdown-item text-white" href="?qtProfessores=15">15</a>
                                        <a class="dropdown-item text-white" href="?qtProfessores=20">20</a>
                                        <a class="dropdown-item text-white" href="?qtProfessores=35">35</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col pr-0 text-right">
                                <form action="" method="get" class="input-group mb-3">
                                    <input type="text" name="pesquisa" value="{{ Request::get('pesquisa') }}" required class="form-control text-truncate border-1 d-inline-block" placeholder="Procurar professor">
                                    <button type="submit" class="btn btn-primary p-0 m-0 border-0 input-group-append d-inline-block">
                                        <span class="input-group-text border-0 bg-transparent" id="basic-addon2">
                                            <i class="fas fa-search text-light"></i>
                                        </span>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="row">
                            <hr class="w-100 mb-4" style="border-color: #02010C;">
                        </div>

                        <div class="row">
                            <div class="col-12 mb-3 text-white text-md-left">
                                <label class="text-primary mr-2 font-weight-normal align-middle">
                                    <span id="lblSelecionados">1</span> / {{ $professores->count() }} - {{ $professores->total() }} no total
                                </label>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12 px-0">
                                <button type="button" data-toggle="modal" data-target="#divModalNovoProfessor" class="btn btn-block btn-primary text-white font-weight-bold rounded shadow-none px-4 mb-2 mb-sm-0 text-truncate" data-keyboard="false" data-backdrop="static">
                                    <i class="fas fa-plus mr-3"></i>
                                    Cadastrar novo professor
                                </button>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-12 px-0 mb-3">

                                <!-- Inicio tabela de professores -->
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead class="thead-default">
                                            <tr>
                                                <th class="">Nome</th>
                                                <th class="">E-mail</th>
                                                <th class="d-none d-xl-table-cell">Turmas</th>
                                                <th class="">Avaliação</th>
                                                <th class="d-none d-xl-table-cell">Última Atividade</th>
                                                <th class="w-25">Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white bg-darkmode">

                                        @if(count($professores) > 0)
                                            @foreach ($professores as $professor)

                                                <tr class="rounded shadow-sm">
                                                    <td>{{ ucwords($professor->name) }}</td>
                                                    <td>{{ $professor->email }}</td>
                                                    <td class="d-none d-xl-table-cell">
                                                        @foreach ($professor->turmas_instrutor as $turma)
                                                            <span>{{ $turma->titulo }}; </span>
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        <span>
                                                            @for ($i = 0; $i < floor($professor->avaliacao); $i++)
                                                                <i class="fas fa-star text-warning"></i>
                                                            @endfor
                                                            @for ($i = 0; $i < (5 - floor($professor->avaliacao)); $i++)
                                                                <i class="far fa-star text-warning"></i>
                                                            @endfor
                                                        </span>
                                                    </td>
                                                    <td class="d-none d-xl-table-cell">{{ (strftime("%d de %b de %G às %H:%M", strtotime($professor->ultima_atividade))) }}</td>
                                                    <td>
                                                        <button type="button" onclick="editarUsuario({{ $professor->id }})" class="btn btn-sm text-white btn-accept mr-2">
                                                                <i class="fas fa-pencil-alt"></i>
                                                            </button>
                                                        <button type="button" onclick="deletarUsuario({{ $professor->id }}, this);" class="btn btn-sm text-white btn-decline">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                {{--  <tr class="spacer" style="height: 10px;"></tr>  --}}

                                            @endforeach
                                        @else

                                            <tr class="rounded shadow-sm">
                                                <td colspan="6" class="align-middle">Não há professores cadastrados ainda.</td>
                                            </tr>

                                        @endif

                                        </tbody>
                                    </table>
                                </div>
                                <!-- Fim tabela de professores -->

                                <!-- Paginação -->
                                @if(count($professores) > 0)
                                    <nav class="px-auto small mt-2 mx-auto text-center py-1 pb-0" aria-label="Page navigation example" style="margin: 0px -32px;">
                                        <ul class="pagination mb-0 d-inline-flex">
                                            @if($professores->currentPage() > 2)
                                                <li class="page-item ml-auto"><a href="{{ $professores->url(0) }}&qtProfessores={{ $amountProfessores }}" class="page-link">Primeira</a></li>
                                            @endif
                                            @if($professores->currentPage() > 1)
                                                <li class="page-item ml-auto"><a href="{{ $professores->previousPageUrl() }}&qtProfessores={{ $amountProfessores }}" class="page-link">Anterior</a></li>
                                            @endif
                                            @for($i = 0; $i < $professores->lastPage(); $i ++)
                                                <li class="page-item {{ $professores->currentPage() != $i + 1 ?: 'active' }}"><a href="{{ $professores->url($i+1) }}&qtProfessores={{ $amountProfessores }}" class="page-link">{{ $i + 1 }}</a></li>
                                            @endfor
                                            @if($professores->currentPage() < $professores->lastPage())
                                                <li class="page-item mr-auto"><a href="{{ $professores->nextPageUrl() }}&qtProfessores={{ $amountProfessores }}" class="page-link">Próxima</a></li>
                                            @endif
                                            @if($professores->currentPage() < $professores->lastPage() - 1)
                                                <li class="page-item mr-auto"><a href="{{ $professores->url( $professores->lastPage() ) }}&qtProfessores={{ $amountProfessores }}" class="page-link">Última</a></li>
                                            @endif
                                        </ul>
                                    </nav>
                                @endif
                                <!-- Fim paginação -->

                            </div>

                        </div>

                    </div>

                </div>

                <div class="tab-pane fade" id="alunos" role="tabpanel" aria-labelledby="alunos-tab">

                    <div class="container-fluid">

                        <div class="row my-4">
                            <h5 class="w-100">
                                <strong>Gestão de alunos</strong>
                            </h5>
                        </div>

                        <div class="row mt-4">
                            <div class="col pl-0 text-left">
                                <div class="dropdown">
                                    <label for="cmbLimite" class="h5 mr-2 font-weight-normal">Limite:</label>
                                    <button class="btn dropdown-toggle w-auto border-0 bg-white shadow-sm text-primary" type="button" id="cmbLimite" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ $amountAlunos }}
                                    </button>
                                    <div class="dropdown-menu bg-dark" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item text-white" href="?qtAlunos=10">10</a>
                                        <a class="dropdown-item text-white" href="?qtAlunos=15">15</a>
                                        <a class="dropdown-item text-white" href="?qtAlunos=20">20</a>
                                        <a class="dropdown-item text-white" href="?qtAlunos=35">35</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col pr-0 text-right">
                                <form action="" method="get" class="input-group mb-3">
                                    <input type="text" name="pesquisa" value="{{ Request::get('pesquisa') }}" required class="form-control text-truncate border-1 d-inline-block" placeholder="Procurar aluno">
                                    <button type="submit" class="btn btn-primary p-0 m-0 border-0 input-group-append d-inline-block">
                                        <span class="input-group-text border-0 bg-transparent" id="basic-addon2">
                                            <i class="fas fa-search text-light"></i>
                                        </span>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="row">
                            <hr class="w-100 mb-4" style="border-color: #02010C;">
                        </div>

                        <div class="row">
                            <div class="col-12 mb-3 text-white text-md-left">
                                <label class="text-primary mr-2 font-weight-normal align-middle">
                                    <span id="lblSelecionados">1</span> / {{ $alunos->count() }} - {{ $alunos->total() }} no total
                                </label>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12 px-0">
                                <button type="button" data-toggle="modal" data-target="#divModalNovoAluno" class="btn btn-block btn-primary text-white font-weight-bold rounded shadow-none px-4 mb-2 mb-sm-0 text-truncate" data-keyboard="false" data-backdrop="static">
                                    <i class="fas fa-plus mr-3"></i>
                                    Cadastrar novo aluno
                                </button>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-12 px-0 mb-3">

                                <!-- Inicio tabela de alunos -->
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead class="thead-default">
                                            <tr>
                                                <th class="">Nome</th>
                                                @if(Auth::user()->permissao != "A")
                                                    <th class="">E-mail</th>
                                                @endif
                                                <th class="d-none d-xl-table-cell">Professor</th>
                                                <th class="d-none d-xl-table-cell">Turma</th>
                                                <th class="">Desempenho</th>
                                                <th class="d-none d-xl-table-cell">Última Atividade</th>
                                                <th class="w-25 text-center">Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white bg-darkmode">

                                        @if(count($alunos) > 0)
                                            @foreach ($alunos as $aluno)

                                                <tr class="rounded shadow-sm">
                                                    <td>{{ ucwords($aluno->name) }}</td>
                                                    @if(Auth::user()->permissao != "A")
                                                        <td>{{ $aluno->email }}</td>
                                                    @endif
                                                    <td class="d-none d-xl-table-cell">
                                                        @if(count($aluno->turmas_aluno) > 0)
                                                            {{ $aluno->turmas_aluno[0]->turma->professor->name }}
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td class="d-none d-xl-table-cell">
                                                        @if(count($aluno->turmas_aluno) > 0)
                                                            {{ $aluno->turmas_aluno[0]->turma->titulo }}
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td class="text-center">{{ $aluno->desempenho }}%</td>
                                                    <td class="d-none d-xl-table-cell">{{ (strftime("%d de %b de %G às %H:%M", strtotime($aluno->ultima_atividade))) }}</td>
                                                    <td class="text-center align-middle">
                                                        <button type="button" onclick="editarUsuario({{ $aluno->id }})" class="btn btn-sm text-white btn-accept mr-2">
                                                                <i class="fas fa-pencil-alt"></i>
                                                            </button>
                                                        <button type="button" onclick="deletarUsuario({{ $aluno->id }}, this);" class="btn btn-sm text-white btn-decline">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                {{--  <tr class="spacer" style="height: 10px;"></tr>  --}}

                                            @endforeach
                                        @else

                                            <tr class="rounded shadow-sm">
                                                <td colspan="4" class="align-middle">Não há alunos cadastrados ainda.</td>
                                            </tr>

                                        @endif

                                        </tbody>
                                    </table>
                                </div>
                                <!-- Fim tabela de alunos -->

                                <!-- Paginação -->
                                @if(count($alunos) > 0)
                                    <nav class="px-auto small mt-2 mx-auto text-center py-1 pb-0" aria-label="Page navigation example" style="margin: 0px -32px;">
                                        <ul class="pagination mb-0 d-inline-flex">
                                            @if($alunos->currentPage() > 2)
                                                <li class="page-item ml-auto"><a href="{{ $alunos->url(0) }}&qtAlunos={{ $amountAlunos }}" class="page-link">Primeira</a></li>
                                            @endif
                                            @if($alunos->currentPage() > 1)
                                                <li class="page-item ml-auto"><a href="{{ $alunos->previousPageUrl() }}&qtAlunos={{ $amountAlunos }}" class="page-link">Anterior</a></li>
                                            @endif
                                            @for($i = 0; $i < $alunos->lastPage(); $i ++)
                                                <li class="page-item {{ $alunos->currentPage() != $i + 1 ?: 'active' }}"><a href="{{ $alunos->url($i+1) }}&qtAlunos={{ $amountAlunos }}" class="page-link">{{ $i + 1 }}</a></li>
                                            @endfor
                                            @if($alunos->currentPage() < $alunos->lastPage())
                                                <li class="page-item mr-auto"><a href="{{ $alunos->nextPageUrl() }}&qtAlunos={{ $amountAlunos }}" class="page-link">Próxima</a></li>
                                            @endif
                                            @if($alunos->currentPage() < $alunos->lastPage() - 1)
                                                <li class="page-item mr-auto"><a href="{{ $alunos->url( $alunos->lastPage() ) }}&qtAlunos={{ $amountAlunos }}" class="page-link">Última</a></li>
                                            @endif
                                        </ul>
                                    </nav>
                                @endif
                                <!-- Fim paginação -->

                            </div>

                        </div>

                    </div>

                </div>

                <div class="tab-pane fade px-md-5" id="aplicacoes-relatorios" role="tabpanel" aria-labelledby="aplicacoes-tab">

                    <div class="container-fluid">

                        <div class="row mt-4 mb-3">
                            <h5 class="w-100">
                                <span class="text-darkmode">Progressos </span>
                                {{ $totalProgressos }}

                                <div class="dropdown float-right">
                                    <label for="cmbLimite" class="mr-2 font-weight-bold text-darkmode">Filtrar por:</label>
                                    <button class="btn dropdown-toggle w-auto border-0 bg-gray shadow-sm font-weight-bold" type="button" id="cmbLimite" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Todos
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        @foreach ($aplicacoes as $aplicacao)
                                            <a class="dropdown-item font-weight-bold text-darkmode" href="#">{{ ucfirst($aplicacao->titulo) }}</a>
                                        @endforeach
                                    </div>
                                </div>
                            </h5>
                        </div>

                        <div class="row">

                                <div class="col-12 mb-3">
                                    <div class="py-3 text-left text-bluegray" style="border-bottom:  1px solid #E3E5F0;">
                                        <div class="container-fluid">

                                            @foreach ($aplicacoes as $aplicacao)

                                                <div class="row my-3">
                                                    <div class="col-auto my-auto text-center">
                                                        <button type="button" data-toggle="collapse" data-target="#collapseCurso{{ $aplicacao->id }}" aria-expanded="false" aria-controls="collapseExample" class="btn btn-xl btn-primary collapsed" style="border-radius:  50%; padding:  0px 5px; ">
                                                            <i class="fas fa-plus fa-lg" style="padding: 6px 0px;"></i>
                                                        </button>
                                                    </div>
                                                    <div class="col my-auto">
                                                        <h5 class="font-weight-bold m-0">
                                                            {{ ucfirst($aplicacao->titulo) }}
                                                        </h5>
                                                    </div>
                                                    <div class="col my-auto ml-auto text-right">
                                                        <h5 class="font-weight-bold m-0">
                                                            {{ count($aplicacao->progressos) }} matriculado{{ count($aplicacao->progressos) != 1 ? 's' : '' }}
                                                        </h5>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 collapse" id="collapseCurso{{ $aplicacao->id }}" style="">
                                                        <div class="container-fluid mb-5">
                                                            <div class="mx-2 px-2 pt-3 mt-3" style="border-top: 3px solid #F9F9F9;">

                                                                @foreach ($aplicacao->progressos as $progresso)@if($progresso->user != null)

                                                                    <div class="row mb-3">
                                                                        <div class="col my-auto">
                                                                            <h6 class="m-0 text-bluegray">
                                                                                {{ ucfirst($progresso->user->name) }}
                                                                            </h6>
                                                                        </div>
                                                                        <div class="col ml-auto my-auto text-right">
                                                                            <h6 class="font-weight-bold text-uppercase {{ $progresso->progresso < 100 ? 'text-bluegray' : 'text-primary' }} m-0">
                                                                                {{ $progresso->progresso }}%
                                                                            </h6>
                                                                        </div>
                                                                    </div>

                                                                @endif
                                                                @endforeach

                                                                @if(count($aplicacao->progressos) == 0)
                                                                    <div class="row mb-3">
                                                                        <div class="col my-auto">
                                                                            <h6 class="m-0 text-bluegray">
                                                                                Esta aplicação ainda não possui nenhum aluno com progresso.
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

                </div>

            </div>

            <!-- Modal Novo Professor -->
            <div class="modal fade" id="divModalNovoProfessor" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>

                            <form id="formNovoProfessor" method="POST" action="{{ route('gestao.usuarios.novo') }}" class="text-center px-3 shadow-none border-0" style="max-width: none;">

                                    @csrf

                                    <div id="page1" class="form-page mx-0">

                                        <h5 class="mt-4 mb-5 font-weight-bold col-10 ml-auto mr-auto">
                                            Cadastro de novo professor
                                        </h5>

                                        <input type="hidden" name="escola_id" value="{{ $escola->id }}">

                                        <div class="input-group mb-4">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-transparent rounded-0" id="basic-addon1">
                                                    <i class="fas fa-user fa-fw"></i>
                                                </span>
                                            </div>

                                            <input id="name" type="text" placeholder="Nome e sobrenome" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }} rounded-0" name="name" value="{{ old('name') }}" required autofocus>

                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="input-group mb-4">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-transparent rounded-0" id="basic-addon1">
                                                    <i class="fas fa-envelope fa-fw"></i>
                                                </span>
                                            </div>

                                            <input id="email" type="email" placeholder="E-mail" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} rounded-0" name="email" value="{{ old('email') }}" required>

                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <input type="hidden" name="permissao" value="P">

                                        <div class="row">
                                            <button type="button" data-dismiss="modal" class="btn btn-lg btn-block outline-button my-4 col-4 ml-auto mr-4 font-weight-bold text-secondary">Voltar</button>
                                            <button type="button" onclick="$('#page1').addClass('d-none'); $('#page2').removeClass('d-none'); setTimeout(function(){ document.getElementById('formNovoProfessor').submit(); }, 500);" class="btn btn-lg btn-block bg-blue my-4 col-4 ml-4 mr-auto text-white font-weight-bold">Cadastrar</button>
                                        </div>

                                    </div>

                                    <div id="page2" class="form-page mx-0 d-none py-3">

                                        <i class="fas fa-spinner fa-pulse fa-3x text-primary"></i>

                                        <h5 class="mt-4 font-weight-bold col-10 ml-auto mr-auto">
                                            Cadastro de novo usuário

                                            <span class="small d-block mt-3 text-dark font-weight-normal">
                                                Você será redirecionado para o Painel do usuário em instantes.
                                            </span>
                                        </h5>

                                    </div>

                                </form>

                        </div>

                    </div>
                </div>
            </div>
            <!-- Fim modal novo usuario -->

            <!-- Modal Novo Aluno -->
            <div class="modal fade" id="divModalNovoAluno" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>

                            <form id="formNovoAluno" method="POST" action="{{ route('gestao.usuarios.novo') }}" class="text-center px-3 shadow-none border-0" style="max-width: none;">

                                    @csrf

                                    <div id="page1" class="form-page mx-0">

                                        <h5 class="mt-4 mb-5 font-weight-bold col-10 ml-auto mr-auto">
                                            Cadastro de novo aluno
                                        </h5>

                                        <input type="hidden" name="escola_id" value="{{ $escola->id }}">

                                        <div class="input-group mb-4">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-transparent rounded-0" id="basic-addon1">
                                                    <i class="fas fa-user fa-fw"></i>
                                                </span>
                                            </div>

                                            <input id="name" type="text" placeholder="Nome e sobrenome" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }} rounded-0" name="name" value="{{ old('name') }}" required autofocus>

                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="input-group mb-4">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-transparent rounded-0" id="basic-addon1">
                                                    <i class="fas fa-envelope fa-fw"></i>
                                                </span>
                                            </div>

                                            <input id="email" type="email" placeholder="E-mail" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} rounded-0" name="email" value="{{ old('email') }}" required>

                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <input type="hidden" name="permissao" value="A">

                                        <div class="row">
                                            <button type="button" data-dismiss="modal" class="btn btn-lg btn-block outline-button my-4 col-4 ml-auto mr-4 font-weight-bold text-secondary">Voltar</button>
                                            <button type="button" onclick="$('#page1').addClass('d-none'); $('#page2').removeClass('d-none'); setTimeout(function(){ document.getElementById('formNovoAluno').submit(); }, 500);" class="btn btn-lg btn-block bg-blue my-4 col-4 ml-4 mr-auto text-white font-weight-bold">Cadastrar</button>
                                        </div>

                                    </div>

                                    <div id="page2" class="form-page mx-0 d-none py-3">

                                        <i class="fas fa-spinner fa-pulse fa-3x text-primary"></i>

                                        <h5 class="mt-4 font-weight-bold col-10 ml-auto mr-auto">
                                            Cadastro de aluno

                                            <span class="small d-block mt-3 text-dark font-weight-normal">
                                                Você será redirecionado para o Painel do usuário em instantes.
                                            </span>
                                        </h5>

                                    </div>

                                </form>

                        </div>

                    </div>
                </div>
            </div>
            <!-- Fim modal novo usuario -->

            <!-- Modal editar usuario -->
            <div class="modal fade" id="divModalEditarUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>

                            <form id="formEditarUsuario" method="POST" action="{{ route('gestao.usuarios.salvar') }}" class="text-center px-3 shadow-none border-0">

                                @csrf

                                <div id="divLoading">
                                    <i class="fas fa-spinner fa-pulse fa-3x text-primary"></i>
                                </div>

                                <div id="divEditar" class="form-page mx-0 d-none">

                                    <h5 class="my-4 col-10 ml-auto mr-auto">
                                        Editar usuário
                                    </h5>

                                    <input name="id" type="text" hidden required>

                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-transparent rounded-0" id="basic-addon1">
                                                <i class="fas fa-user fa-fw"></i>
                                            </span>
                                        </div>

                                        <input id="name" type="text" placeholder="Nome e sobrenome" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }} rounded-0" name="name" value="{{ old('name') }}" required autofocus>

                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-transparent rounded-0" id="basic-addon1">
                                                <i class="fas fa-envelope fa-fw"></i>
                                            </span>
                                        </div>

                                        <input id="email" type="email" placeholder="E-mail" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} rounded-0" name="email" value="{{ old('email') }}" required>

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    @if( strrpos(mb_strtoupper(\Auth::user()->permissao, 'UTF-8'), "Z") === false)
                                        <input type="text" name="permissao" readonly class="form-control rounded-0 my-3">
                                    @else
                                        <select name="permissao" required class="custom-select rounded-0 my-3">
                                            <option value="">Selecione uma permissão</option>
                                            <option value="A">Aluno</option>
                                            <option value="P">Professor / Instrutor</option>
                                            <option value="G">Gestor de Escola</option>
                                            <option value="Z">Administrador</option>
                                        </select>
                                    @endif


                                    <div class="row">
                                        <button type="button" data-dismiss="modal" class="btn btn-secondary my-4 col-4 ml-auto mr-4 font-weight-bold">Voltar</button>
                                        <button type="submit" class="btn btn-primary my-4 col-4 ml-4 mr-auto font-weight-bold">Salvar</button>
                                    </div>

                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Tipo de Conteudo -->
            <div class="modal fade" id="divModalTiposConteudo" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg px-1 px-md-5 text-center" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>

                            <h4 class="mb-3">
                                Criação de conteúdo
                            </h4>

                            <p>Escolha abaixo um tipo de conteúdo</p>

                            <div class="container-fluid">
                                <div class="row">

                                    <button onclick="showNovoConteudo(1)" class="btn btn-link text-decoration-none col-4">
                                        <div class="shadow-sm rounded text-primary text-center py-3" style="">
                                            <i class="fas fa-file-alt fa-fw fa-2x"></i>
                                            <br>
                                            Livre
                                        </div>
                                    </button>
                                    <button onclick="showNovoConteudo(3)" class="btn btn-link text-decoration-none col-4">
                                        <div class="shadow-sm rounded text-primary text-center py-3" style="">
                                            <i class="fas fa-video fa-fw fa-2x"></i>
                                            <br>
                                            Vídeo
                                        </div>
                                    </button>
                                    <button onclick="showNovoConteudo(4)" class="btn btn-link text-decoration-none col-4">
                                        <div class="shadow-sm rounded text-primary text-center py-3" style="">
                                            <i class="fas fa-file-pdf fa-fw fa-2x"></i>
                                            <br>
                                            Slide ou Documento
                                        </div>
                                    </button>

                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <!-- Fim modal Tipo de Conteudo -->

            <!-- Modal Novo Conteudo -->
            <div class="modal fade" id="divModalNovoConteudo" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-md px-1 px-md-5" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>

                            <form id="formNovoConteudo" method="POST" action="{{ route('gestao.conteudo-novo') }}" enctype="multipart/form-data" class="text-center px-3 shadow-none border-0">

                                @csrf

                                <input name="tipo" required hidden>

                                <div id="divLoading" class="text-center">
                                    <i class="fas fa-spinner fa-pulse fa-3x text-primary"></i>
                                </div>

                                <div id="divEnviando" class="text-center d-none">
                                    <i class="fas fa-spinner fa-pulse fa-3x text-primary mb-3"></i>
                                    <h4>Enviando</h4>
                                </div>

                                <div id="divEditar" class="form-page d-none">

                                    <div id="page1" class="form-page">

                                        <h4 id="lblTipoNovoConteudo">Tipo de conteudo</h4>

                                        <div class="form-group mb-3 text-left">
                                            <label class="" for="txtTituloNovoConteudo">Título do conteúdo</label>
                                            <input type="text" class="form-control" name="titulo" id="txtTituloNovoConteudo" placeholder="Clique para digitar." required>
                                        </div>

                                        <div class="form-group mb-3 text-left">
                                            <label class="" for="txtDescricaoNovoConteudo">Descrição do conteúdo <small>(opcional)</small></label>
                                            <textarea class="form-control" name="descricao" id="txtDescricaoNovoConteudo" rows="3" placeholder="Clique para digitar."></textarea>
                                        </div>

                                        <div class="tipos-conteudo text-left">

                                            <div id="conteudoTipo1" class="tipo">
                                                <div class="form-group mb-3">
                                                    <label class="" for="txtConteudo">Conteúdo</label>
                                                    <div class="summernote-holder">
                                                        <textarea name="conteudo" id="txtConteudo" class="summernote-airmode">
                                                            <div style="color: #525870;font-weight: bold;font-size: 16px;">
                                                                <p>Esta é a área de edição de conteúdo misto, clique aqui para começar a editar.</p>
                                                                <ul>
                                                                    <li>Aqui você pode escrever artigos.</li>
                                                                    <li>Colocar imagens, vídeos, tabelas.</li>
                                                                    <li>Personalizar o texto da forma como desejar.</li>
                                                                    <li>E muito mais.</li>
                                                                </ul>
                                                            </div>
                                                        </textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="conteudoTipo2" class="tipo">
                                                <div class="form-group mb-3 text-left">
                                                    <label class="" for="inputAudioNovoConteudo">Clique para fazer upload do aúdio</label>
                                                    <br>
                                                    <div class="upload-btn-wrapper">
                                                        <button class="btn btn-primary file-name">Selecionar arquivo</button>
                                                        <input type="file" name="arquivoAudio" id="inputAudioNovoConteudo" onchange="mudouArquivoInput(this);"  accept="audio/*" />
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3 text-left">
                                                    <label class="" for="txtAudioNovoConteudo">Ou digite o link</label>
                                                    <input type="text" class="form-control" name="conteudoAudio" id="txtAudioNovoConteudo" placeholder="Clique para digitar.">
                                                </div>
                                            </div>
                                            <div id="conteudoTipo3" class="tipo">
                                                <div class="form-group mb-3 text-left">
                                                    <label class="" for="inputVideoNovoConteudo">Clique para fazer upload do vídeo</label>
                                                    <br>
                                                    <div class="upload-btn-wrapper">
                                                        <button class="btn btn-primary file-name">Selecionar arquivo</button>
                                                        <input type="file" name="arquivoVideo" id="inputVideoNovoConteudo" onchange="mudouArquivoInput(this);"  accept="video/*" />
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3 text-left">
                                                    <label class="" for="txtVideoNovoConteudo">Ou digite o link</label>
                                                    <input type="text" class="form-control" name="conteudoVideo" id="txtVideoNovoConteudo" placeholder="Clique para digitar.">
                                                </div>
                                                <div class="form-group mb-3 text-left" hidden>
                                                    <label class="">Preview:</label>
                                                    <iframe class="d-block" src="https://www.youtube.com/embed/NpEaa2P7qZI" frameborder="0" allow="encrypted-media" style="width: 40vw;height: 25vw;max-width: 1040px;max-height: 586px;"></iframe>
                                                </div>
                                            </div>
                                            <div id="conteudoTipo4" class="tipo">
                                                <div class="form-group mb-3 text-left">
                                                    <label class="" for="inputSlideNovoConteudo">Clique para fazer upload do slide (Powerpoint)</label>
                                                    <br>
                                                    <div class="upload-btn-wrapper">
                                                        <button class="btn btn-primary file-name">Selecionar arquivo</button>
                                                        <input type="file" name="arquivoSlide" id="inputSlideNovoConteudo" onchange="mudouArquivoInput(this);"  accept="application/vnd.ms-powerpoint, application/vnd.openxmlformats-officedocument.presentationml.slideshow, application/vnd.openxmlformats-officedocument.presentationml.presentation, .pps, .pptx" />
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3 text-left">
                                                    <label class="" for="txtSlideNovoConteudo">Ou digite o link</label>
                                                    <input type="text" class="form-control" name="conteudoSlide" id="txtSlideNovoConteudo" placeholder="Clique para digitar.">
                                                </div>
                                            </div>

                                        </div>

                                        <div class="form-group mb-3 text-left">
                                            <label class="" for="cmbStatusNovoConteudo">Status do conteúdo</label>
                                            <select id="cmbStatusNovoConteudo" name="status" required class="custom-select font-weight-bold border-0 rounded">
                                                <option disabled selected value="0">Selecione um status</option>
                                                <option value="0">Não publicado</option>
                                                <option value="1">Publicado</option>
                                                <option value="2">Oculto</option>
                                            </select>
                                        </div>

                                        <div class="form-group mb-3 text-left" hidden>
                                            <label class="" for="txtFonteNovoConteudo">Fonte do conteúdo <small>(opcional)</small></label>
                                            <textarea class="form-control" name="fonte" id="txtFonteNovoConteudo" rows="2" placeholder="Clique para digitar."></textarea>
                                        </div>

                                        <div class="form-group mb-3 text-left" hidden>
                                            <label class="" for="txtAutoresNovoConteudo">Autores do conteúdo <small>(opcional)</small></label>
                                            <textarea class="form-control" name="autores" id="txtAutoresNovoConteudo" rows="2" placeholder="Clique para digitar."></textarea>
                                        </div>

                                        <div class="row">
                                            <button type="button" data-dismiss="modal" class="btn btn-lg btn-block outline-button mt-4 mb-0 col-4 ml-auto mr-4 font-weight-bold">Cancelar</button>
                                            <button type="button" onclick="salvarConteudo();" class="btn btn-lg bg-bluelight btn-block bg-blue mt-4 mb-0 col-4 ml-4 mr-auto text-white font-weight-bold">Salvar</button>
                                        </div>

                                    </div>



                                </div>

                            </form>

                        </div>

                    </div>
                </div>
            </div>
            <!-- Fim modal novo conteudo -->

            <!-- Modal Editar Conteudo -->
            <div class="modal fade" id="divModalEditarConteudo" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-md px-1 px-md-5" role="document">
                    <div class="modal-content pt-4">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>

                            <form id="formEditarConteudo" method="POST" action="{{ route('gestao.conteudos-salvar') }}" enctype="multipart/form-data" class="text-center px-3 shadow-none border-0">

                                @csrf

                                <input name="idConteudo" required hidden>

                                <input name="tipo" required hidden>

                                <div id="divLoading" class="text-center">
                                    <i class="fas fa-spinner fa-pulse fa-3x text-primary"></i>
                                </div>

                                <div id="divEnviando" class="text-center d-none">
                                    <i class="fas fa-spinner fa-pulse fa-3x text-primary mb-3"></i>
                                    <h4>Enviando</h4>
                                </div>

                                <div id="divEditar" class="form-page d-none">

                                    <div id="page1" class="form-page">

                                        <br>
                                        <h4 id="lblTipoConteudo">Tipo de conteudo</h4>
                                        <br>

                                        <div class="form-group mb-3 text-left">
                                            <label class="" for="txtTituloNovoConteudo">Título do conteúdo</label>
                                            <input type="text" class="form-control" name="titulo" id="txtTituloNovoConteudo" placeholder="Clique para digitar." required>
                                        </div>

                                        <div class="form-group mb-3 text-left">
                                            <label class="" for="txtDescricaoNovoConteudo">Descrição do conteúdo <small>(opcional)</small></label>
                                            <textarea class="form-control" name="descricao" id="txtDescricaoNovoConteudo" rows="3" placeholder="Clique para digitar."></textarea>
                                        </div>

                                        <div id="divVerArquivoAtual" class="form-group mb-3 text-left d-none">
                                            <a id="btnVerArquivoAtual" target="_blank" class="btn btn-lg bg-bluelight text-dark">Ver arquivo atual</a>
                                        </div>

                                        <div class="tipos-conteudo text-left">

                                            <div id="conteudoTipo1" class="tipo">
                                                <div class="form-group mb-3">
                                                    <label class="" for="txtConteudo">Conteúdo</label>
                                                    <div class="summernote-holder">
                                                        <textarea name="conteudo" id="txtConteudo" class="summernote-airmode">
                                                            <div style="color: #525870;font-weight: bold;font-size: 16px;">
                                                                <p>Esta é a área de edição de conteúdo misto, clique aqui para começar a editar.</p>
                                                                <ul>
                                                                    <li>Aqui você pode escrever artigos.</li>
                                                                    <li>Colocar imagens, vídeos, tabelas.</li>
                                                                    <li>Personalizar o texto da forma como desejar.</li>
                                                                    <li>E muito mais.</li>
                                                                </ul>
                                                            </div>
                                                        </textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="conteudoTipo2" class="tipo">
                                                <div class="form-group mb-3 text-left">
                                                    <label class="" for="inputAudioNovoConteudo">Clique para fazer upload de um novo aúdio</label>
                                                    <br>
                                                    <div class="upload-btn-wrapper">
                                                        <button class="btn btn-primary file-name">Selecionar arquivo</button>
                                                        <input type="file" name="arquivoAudio" id="inputAudioNovoConteudo" onchange="mudouArquivoInput(this);"  accept="audio/*" />
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3 text-left">
                                                    <label class="" for="txtAudioNovoConteudo">Ou digite o link</label>
                                                    <input type="text" class="form-control" name="conteudoAudio" id="txtAudioNovoConteudo" placeholder="Clique para digitar.">
                                                </div>
                                            </div>
                                            <div id="conteudoTipo3" class="tipo">
                                                <div class="form-group mb-3 text-left">
                                                    <label class="" for="inputVideoNovoConteudo">Clique para fazer upload de um novo vídeo</label>
                                                    <br>
                                                    <div class="upload-btn-wrapper">
                                                        <button class="btn btn-primary file-name">Selecionar arquivo</button>
                                                        <input type="file" name="arquivoVideo" id="inputVideoNovoConteudo" onchange="mudouArquivoInput(this);"  accept="video/*" />
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3 text-left">
                                                    <label class="" for="txtVideoNovoConteudo">Ou digite o link</label>
                                                    <input type="text" class="form-control" name="conteudoVideo" id="txtVideoNovoConteudo" placeholder="Clique para digitar.">
                                                </div>
                                                <div class="form-group mb-3 text-left" hidden>
                                                    <label class="">Preview:</label>
                                                    <iframe class="d-block" src="https://www.youtube.com/embed/NpEaa2P7qZI" frameborder="0" allow="encrypted-media" style="width: 40vw;height: 25vw;max-width: 1040px;max-height: 586px;"></iframe>
                                                </div>
                                            </div>
                                            <div id="conteudoTipo4" class="tipo">
                                                <div class="form-group mb-3 text-left">
                                                    <label class="" for="inputSlideNovoConteudo">Clique para fazer upload de um novo slide (Powerpoint)</label>
                                                    <br>
                                                    <div class="upload-btn-wrapper">
                                                        <button class="btn btn-primary file-name">Selecionar arquivo</button>
                                                        <input type="file" name="arquivoSlide" id="inputSlideNovoConteudo" onchange="mudouArquivoInput(this);"  accept="application/vnd.ms-powerpoint, application/vnd.openxmlformats-officedocument.presentationml.slideshow, application/vnd.openxmlformats-officedocument.presentationml.presentation, .pps, .pptx" />
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3 text-left">
                                                    <label class="" for="txtSlideNovoConteudo">Ou digite o link</label>
                                                    <input type="text" class="form-control" name="conteudoSlide" id="txtSlideNovoConteudo" placeholder="Clique para digitar.">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group mb-3 text-left">
                                            <label class="" for="cmbStatusNovoConteudo">Status do conteúdo</label>
                                            <select id="cmbStatusNovoConteudo" name="status" required class="custom-select bg-lightgray font-weight-bold rounded">
                                                <option disabled selected>Selecione um status</option>
                                                <option value="0">Não publicado</option>
                                                <option value="1">Publicado</option>
                                                <option value="2">Oculto</option>
                                            </select>
                                        </div>

                                        <div class="form-group mb-3 text-left" hidden>
                                            <label class="" for="txtFonteNovoConteudo">Fonte do conteúdo <small>(opcional)</small></label>
                                            <textarea class="form-control" name="fonte" id="txtFonteNovoConteudo" rows="2" placeholder="Clique para digitar."></textarea>
                                        </div>

                                        <div class="form-group mb-3 text-left" hidden>
                                            <label class="" for="txtAutoresNovoConteudo">Autores do conteúdo <small>(opcional)</small></label>
                                            <textarea class="form-control" name="autores" id="txtAutoresNovoConteudo" rows="2" placeholder="Clique para digitar."></textarea>
                                        </div>

                                        <div class="row pb-3">
                                            <button type="button" data-dismiss="modal" class="btn btn-danger mt-4 mb-0 col-4 ml-auto mr-4 font-weight-bold">Cancelar</button>
                                            <button type="button" onclick="salvarEdicaoConteudo();" class="btn btn-primary mt-4 mb-0 col-4 ml-4 mr-auto font-weight-bold">Salvar</button>
                                        </div>

                                    </div>



                                </div>

                            </form>

                        </div>

                    </div>
                </div>
            </div>
            <!-- Fim modal editar conteudo -->

            </div>

        </div>


    </div>

</main>

@endsection

@section('bodyend')

    <!-- Chart JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <script src="{{ env('APP_LOCAL') }}/assets/js/Chart-rounded.min.js"></script>

    <!-- Summernote css/js -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/lang/summernote-pt-BR.min.js" crossorigin="anonymous"></script>

    <!-- PrintThis JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/printThis/1.14.0/printThis.min.js"></script>

    <script>

        $( document ).ready(function()
        {
            $('.summernote').summernote({
                placeholder: "Clique para digitar.",
                lang: 'pt-BR',
                airMode: false,
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['fontsize', 'color']],
                    ['font', ['fontname']],
                    ['para', ['paragraph']],
                    ['insert', ['hr', 'picture', 'video', 'link', 'table', 'image', 'doc']],
                    ['misc', ['undo', 'redo', 'codeview', 'fullscreen', 'help']],
                ],
                popover: {
                    image: [
                        ['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],
                        ['float', ['floatLeft', 'floatRight', 'floatNone']],
                        ['remove', ['removeMedia']]
                    ],
                    link: [
                        ['link', ['linkDialogShow', 'unlink']]
                    ],
                    air: [
                        ['style', ['style']],
                        ['font', ['bold', 'italic', 'underline', 'clear']],
                        ['font', ['fontsize', 'color']],
                        ['font', ['fontname']],
                        ['para', ['paragraph']],
                        ['table', ['table']],
                        ['insert', ['hr', 'picture', 'video', 'link', 'table', 'image', 'doc']],
                        ['misc', ['undo', 'redo']],
                    ],
                },
            });

            $('.summernote-airmode').summernote({
                placeholder: "Clique para digitar.",
                lang: 'pt-BR',
                airMode: true,
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['fontsize', 'color']],
                    ['font', ['fontname']],
                    ['para', ['paragraph']],
                    ['insert', ['hr', 'picture', 'video', 'link', 'table', 'image', 'doc']],
                    ['misc', ['undo', 'redo', 'codeview', 'fullscreen', 'help']],
                ],
                popover: {
                    image: [
                        ['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],
                        ['float', ['floatLeft', 'floatRight', 'floatNone']],
                        ['remove', ['removeMedia']]
                    ],
                    link: [
                        ['link', ['linkDialogShow', 'unlink']]
                    ],
                    air: [
                        ['style', ['style']],
                        ['font', ['bold', 'italic', 'underline', 'clear']],
                        ['font', ['fontsize', 'color']],
                        ['font', ['fontname']],
                        ['para', ['paragraph']],
                        ['table', ['table']],
                        ['insert', ['hr', 'picture', 'video', 'link', 'table', 'image', 'doc']],
                        ['misc', ['undo', 'redo']],
                    ],
                },
            });

            if(window.location.hash)
            {
                $(".nav-link[href='" + window.location.hash + "']").tab('show');
            }
        });

        Chart.defaults.global.defaultFontColor = "#7E80A2";

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
                    enabled: true
                }
            }
        });

        function showNovoConteudo(tipo)
        {
            $("#divModalNovoConteudo").modal({ keyboard: false, backdrop: 'static' });
            $("#divModalNovoConteudo #divLoading").addClass('d-none');
            $("#divModalNovoConteudo #divEnviando").addClass('d-none');
            $("#divModalNovoConteudo #divEditar").removeClass('d-none');

            $("#divModalNovoConteudo .tipos-conteudo .tipo").addClass('d-none');

            $("#divModalNovoConteudo .tipos-conteudo").find('#conteudoTipo' + tipo).removeClass('d-none');

            $("#divModalNovoConteudo [name='tipo']").val(tipo);

            $("#divModalNovoConteudo [name='titulo']").val('');
            $("#divModalNovoConteudo [name='descricao']").val('');

            switch(tipo)
            {
                case 1:
                    $("#lblTipoNovoConteudo").text("Novo conteúdo livre");
                    $("#formNovoConteudo #txtConteudo").summernote('code',`<div style="color: #525870;font-weight: bold;font-size: 16px;">
                        <p>Esta é a área de edição de conteúdo misto, clique aqui para começar a editar.</p>
                        <ul>
                            <li>Aqui você pode escrever artigos.</li>
                            <li>Colocar imagens, vídeos, tabelas.</li>
                            <li>Personalizar o texto da forma como desejar.</li>
                            <li>E muito mais.</li>
                        </ul>
                    </div>`);
                break;
                case 2:
                    $("#lblTipoNovoConteudo").text("Novo conteúdo de aúdio");
                break;
                case 3:
                    $("#lblTipoNovoConteudo").text("Novo conteúdo de vídeo");
                break;
                case 4:
                    $("#lblTipoNovoConteudo").text("Novo conteúdo de slide");
                break;
                default:
                    $("#lblTipoNovoConteudo").text("Novo conteúdo livre");
                break;
            }

            $("#divModalNovoConteudo [name='titulo']").focus();
        }


        function salvarConteudo()
        {
            var isValid = true;

            $('#divModalNovoConteudo input').each(function() {
                if ( $(this).val() === '' && $(this).attr('required') )
                {
                    $(this).focus();

                    isValid = false;
                }
            });

            if(!isValid || $("#divModalNovoConteudo textarea").html() == '')
                return;

            $("#formNovoConteudo").submit();

            $("#divModalNovoConteudo #divLoading").addClass('d-none');
            $("#divModalNovoConteudo #divEditar").addClass('d-none');
            $("#divModalNovoConteudo #divEnviando").removeClass('d-none');

            $("#divModalNovoConteudo #divLoading").addClass('d-none');
            $("#divModalNovoConteudo #divEditar").addClass('d-none');
            $("#divModalNovoConteudo #divEnviando").removeClass('d-none');
        }

        function editarConteudo(idConteudo)
        {
            $("#divModalEditarConteudo").modal({ keyboard: false, backdrop: 'static' });
            $("#divModalEditarConteudo #divLoading").removeClass('d-none');
            $("#divModalEditarConteudo #divEditar").addClass('d-none');
            $("#divModalEditarConteudo #divEnviando").addClass('d-none');

            $("#divModalEditarConteudo .form-page").addClass('d-none');
            $("#divModalEditarConteudo #page1").removeClass('d-none');

            $.ajax({
                url: appurl + '/gestao/conteudos/' + idConteudo + '/editar',
                type: 'get',
                dataType: 'json',
                success: function( _response )
                {
                    console.log( _response );

                    if(_response.success)
                    {
                        _response.conteudo = JSON.parse(_response.conteudo);

                        $("#divModalEditarConteudo .tipos-conteudo .tipo").addClass('d-none');

                        $("#divModalEditarConteudo .tipos-conteudo").find('#conteudoTipo' + _response.conteudo.tipo).removeClass('d-none');

                        var tipo = parseInt(_response.conteudo.tipo);

                        switch(tipo)
                        {
                            case 1:
                                $("#divModalEditarConteudo #lblTipoConteudo").text("Editando conteúdo livre");
                                $("#formEditarConteudo #txtConteudo").summernote('code',_response.conteudo.conteudo);
                            break;

                            case 2:
                                $("#divModalEditarConteudo #lblTipoConteudo").text("Editando conteúdo de aúdio");
                                if(_response.conteudo.temArquivo)
                                {
                                    $("#divVerArquivoAtual").removeClass('d-none');
                                    $("#btnVerArquivoAtual").attr('href', '{{ env("APP_LOCAL") }}/play/' + _response.conteudo.id + '/arquivo');
                                    $("#divModalEditarConteudo [name='conteudoAudio']").val();
                                }
                                else
                                {
                                    $("#divVerArquivoAtual").addClass('d-none');
                                    $("#btnVerArquivoAtual").attr('href', '#');
                                    $("#divModalEditarConteudo [name='conteudoAudio']").val(_response.conteudo.conteudo);
                                }
                                console.log($("#divModalEditarConteudo [name='conteudoAudio']").length)
                                console.log($("#divModalEditarConteudo [name='conteudoAudio']").val())
                            break;

                            case 3:
                                $("#divModalEditarConteudo #lblTipoConteudo").text("Editando conteúdo de vídeo");
                                if(_response.conteudo.temArquivo)
                                {
                                    $("#divVerArquivoAtual").removeClass('d-none');
                                    $("#btnVerArquivoAtual").attr('href', '{{ env("APP_LOCAL") }}/play/' + _response.conteudo.id + '/arquivo');
                                    $("#divModalEditarConteudo [name='conteudoVideo']").val();
                                }
                                else
                                {
                                    $("#divVerArquivoAtual").addClass('d-none');
                                    $("#btnVerArquivoAtual").attr('href', '#');
                                    $("#divModalEditarConteudo [name='conteudoVideo']").val(_response.conteudo.conteudo);
                                }
                            break;

                            case 4:
                                $("#divModalEditarConteudo #lblTipoConteudo").text("Editando conteúdo de slide");
                                if(_response.conteudo.temArquivo)
                                {
                                    $("#divVerArquivoAtual").removeClass('d-none');
                                    $("#btnVerArquivoAtual").attr('href', '{{ env("APP_LOCAL") }}/play/' + _response.conteudo.id + '/arquivo');
                                    $("#divModalEditarConteudo [name='conteudoSlide']").val();
                                }
                                else
                                {
                                    $("#divVerArquivoAtual").addClass('d-none');
                                    $("#btnVerArquivoAtual").attr('href', '#');
                                    $("#divModalEditarConteudo [name='conteudoSlide']").val(_response.conteudo.conteudo);
                                }
                            break;

                            default:
                                $("#divModalEditarConteudo #lblTipoConteudo").text("Editando conteúdo livre2");
                                $("#formEditarConteudo #txtConteudo").summernote('code',_response.conteudo.conteudo);
                            break;
                        }

                        $("#divModalEditarConteudo [name='idConteudo']").val(_response.conteudo.id);
                        $("#divModalEditarConteudo [name='tipo']").val(_response.conteudo.tipo);
                        $("#divModalEditarConteudo [name='titulo']").val(_response.conteudo.titulo);

                        {{--  $("#divModalEditarConteudo [name='fonte']").val(_response.conteudo.fonte);
                        $("#divModalEditarConteudo [name='autores']").val(_response.conteudo.autores);  --}}

                        $("#divModalEditarConteudo [name='status']").val(_response.conteudo.status);

                        $("#divModalEditarConteudo #divLoading").addClass('d-none');
                        $("#divModalEditarConteudo #divEditar").removeClass('d-none');
                    }
                    else
                    {
                        swal("Ops!", _response.error, "error");

                        $("#divModalEditarConteudo").modal({ keyboard: false, backdrop: 'static' });
                    }
                },
                error: function( _response )
                {
                    console.log( _response );
                }
            });
        }

        function salvarEdicaoConteudo()
        {
            var isValid = true;

            $('#divModalEditarConteudo input').each(function() {
                if ( $(this).val() === '' && $(this).attr('required') )
                {
                    $(this).focus();

                    isValid = false;
                }
            });

            if(!isValid || $("#divModalEditarConteudo textarea").html() == '')
                return;

            $("#formEditarConteudo").submit();

            $("#divModalEditarConteudo #divLoading").addClass('d-none');
            $("#divModalEditarConteudo #divEditar").addClass('d-none');
            $("#divModalEditarConteudo #divEnviando").removeClass('d-none');

            $("#divModalEditarConteudo #divLoading").addClass('d-none');
            $("#divModalEditarConteudo #divEditar").addClass('d-none');
            $("#divModalEditarConteudo #divEnviando").removeClass('d-none');
        }

        function duplicarConteudo(id)
        {
            $("#formDuplicarConteudo #idConteudo").val(id);

            swal({
                title: 'Deseja mesmo duplicar?',
                text: "Você deseja mesmo duplicar este conteúdo?",
                icon: "warning",
                buttons: ['Não', 'Sim, duplicar!'],
            }).then((result) => {
                if (result == true)
                {
                    $("#formDuplicarConteudo").submit();
                }
            });
        }

        function excluirConteudo(idConteudo)
        {
            swal({
                title: "Excluir conteúdo",
                text: "Você deseja mesmo excluir esta conteúdo?",
                icon: "warning",
                buttons: ["Não", "Sim"],
                dangerMode: true,
            })
            .then((deletar) =>
            {
                if (deletar)
                {
                    $.ajax({
                        url: '{{ env('APP_LOCAL') }}' + '/gestao/conteudo/' + idConteudo + '/excluir',
                        type: 'post',
                        data: { '_token' : '{{ csrf_token() }}' },
                        dataType: 'json',
                        success: function( _response )
                        {
                            console.log( _response );

                            if(_response.success)
                            {
                                swal("Yeah!", _response.success, "success");

                                $( "#divConteudo" + idConteudo ).remove();
                            }
                            else
                            {
                                swal("Ops!", _response.error, "error");
                            }
                        },
                        error: function( _response )
                        {
                            console.log( _response );
                        }
                    });
                }
            });
        }

        function excluirLiberacao(idLiberacao)
        {
            swal({
                title: "Excluir liberação",
                text: "Você deseja mesmo excluir a liberação desta aplicação?",
                icon: "warning",
                buttons: ["Não", "Sim"],
                dangerMode: true,
            })
            .then((deletar) =>
            {
                if (deletar)
                {
                    $.ajax({
                        url: '{{ env('APP_LOCAL') }}' + '/gestao/aplicacoes/liberacao/escola/' + idLiberacao + '/excluir',
                        type: 'post',
                        data: { '_token' : '{{ csrf_token() }}' },
                        dataType: 'json',
                        success: function( _response )
                        {
                            console.log( _response );

                            if(_response.success)
                            {
                                swal("Yeah!", _response.success, "success");

                                $( "#divLiberacaoAplicacao" + idLiberacao ).remove();
                            }
                            else
                            {
                                swal("Ops!", _response.error, "error");
                            }
                        },
                        error: function( _response )
                        {
                            console.log( _response );
                        }
                    });
                }
            });
        }

        function mudouTipoLiberacaoAplicacao(select)
        {
            if(select.value == 2)
            {
                $("#divLiberarColecao").removeClass('d-none');
                $("#divLiberarAplicacao").addClass('d-none');
            }
            else
            {
                $("#divLiberarAplicacao").removeClass('d-none');
                $("#divLiberarColecao").addClass('d-none');
            }
        }

        function excluirCodigo(idCodigoAcesso)
        {
            swal({
                title: "Excluir código",
                text: "Você deseja mesmo excluir este código de acesso?",
                icon: "warning",
                buttons: ["Não", "Sim"],
                dangerMode: true,
            })
            .then((deletar) =>
            {
                if (deletar)
                {
                    $.ajax({
                        url: '{{ env('APP_LOCAL') }}' + '/gestao/escola/{{ $escola->id }}/codigo/' + idCodigoAcesso + '/excluir',
                        type: 'post',
                        data: { '_token' : '{{ csrf_token() }}' },
                        dataType: 'json',
                        success: function( _response )
                        {
                            console.log( _response );

                            if(_response.success)
                            {
                                swal("Yeah!", _response.success, "success");

                                $( "#divCodigoAcesso" + idCodigoAcesso ).remove();
                            }
                            else
                            {
                                swal("Ops!", _response.error, "error");
                            }
                        },
                        error: function( _response )
                        {
                            console.log( _response );
                        }
                    });
                }
            });
        }

        function editarUsuario(user)
        {
            $("#divModalEditarUsuario").modal('toggle');
            $("#divModalEditarUsuario #divLoading").removeClass('d-none');
            $("#divModalEditarUsuario #divEditar").addClass('d-none');

            $.ajax({
                url: appurl + '/gestao/usuarios/' + user + '/editar',
                type: 'get',
                dataType: 'json',
                success: function( _response )
                {
                    console.log( _response );

                    if(_response.success)
                    {
                        _response.user = JSON.parse(_response.user);
                        $("#divModalEditarUsuario [name='id']").val(_response.user.id);
                        $("#divModalEditarUsuario [name='name']").val(_response.user.name);
                        $("#divModalEditarUsuario [name='email']").val(_response.user.email);
                        $("#divModalEditarUsuario [name='permissao']").val(_response.user.permissao);

                        $("#divModalEditarUsuario #divLoading").addClass('d-none');
                        $("#divModalEditarUsuario #divEditar").removeClass('d-none');
                    }
                    else
                    {
                        swal("Ops!", _response.error, "error");

                        $("#divModalEditarUsuario").modal('toggle');
                    }
                },
                error: function( _response )
                {
                    console.log( _response );
                }
            });
        }

        function deletarUsuario(user, button)
        {
            swal({
                title: "Deletar",
                text: "Você deseja mesmo deletar este usuario?",
                icon: "warning",
                buttons: ["Não", "Sim"],
                dangerMode: true,
            })
            .then((deletar) =>
            {
                if (deletar)
                {
                    $.ajax({
                        url: appurl + '/gestao/usuarios/' + user + '/deletar',
                        type: 'get',
                        dataType: 'json',
                        success: function( _response )
                        {
                            console.log( _response );

                            if(_response.success)
                            {
                                swal("Yeah!", _response.success, "success");

                                $( button.parentNode.parentNode ).remove();
                            }
                            else
                            {
                                swal("Ops!", _response.error, "error");
                            }
                        },
                        error: function( _response )
                        {
                            console.log( _response );
                        }
                    });
                }
            });
        }

    </script>

@endsection
