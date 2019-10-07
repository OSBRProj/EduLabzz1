@extends('layouts.master')

@section('title', 'J. PIAGET - Painel')

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
            box-shadow: 0px 3px 6px rgba(0,0,0,0.16);
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
            box-shadow: 0px 3px 6px rgba(0,0,0,0.16);
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

        .separator-bar
        {
            width: calc(48% - (136px / 2));
        }

    </style>

@endsection

@section('content')

<main role="main">

    <div class="container-fluid">
        <div class="row">

            <div class="col-12 col-md-10 mx-auto p-5">

                <div class="row">
                    <div class="col align-middle my-auto">
                        <h3>
                            <small>Perfil de: </small>
                            {{ ucfirst(Auth::user()->name) }}
                        </h3>
                    </div>
                </div>

                <div class="container-fluid pt-4">

                    <div class="row">

                        <div class="col-12 col-md-6">

                            <div class="box-shadow rounded-10 py-3 px-4 mb-4 text-left">

                                <h5 class="font-weight-bold my-4">
                                    {{ ucfirst(Auth::user()->name) }}
                                </h5>

                                <hr>

                                <div class="text-lightgray my-3">
                                    BIO

                                    <div class="float-right">
                                        <a href="{{ route('configuracao.index') }}#dados" class="text-lightgray">
                                            Editar
                                            <i class="fas fa-edit text-primary"></i>
                                        </a>
                                    </div>

                                </div>

                                <h6 class="font-weight-bold my-4">
                                    {{ ucfirst(Auth::user()->descricao) }}
                                </h6>

                            </div>

                        </div>

                        <div class="col-12 col-md-3">
                            <div class="container-fluid px-0">

                                <div class="box-shadow rounded-10 py-4 px-2 mb-4 text-center text-bluegray">
                                    <div class="d-inline-block align-middle mr-2" style="background-color: #354353;border: 3px solid #E3E5F0;padding: 10px 13.25px; border-radius:  50px;text-align:  -webkit-center;font-size: 26px;">
                                        <i class="fas fa-play fa-fw" style="color: #3CD689;"></i>
                                    </div>
                                    <div class="d-inline-block align-middle text-left">

                                        <h4 class="d-inline-block font-weight-bold">
                                            {{ $qtCursosConcluidos }}
                                        </h4>
                                        <br>
                                        <span class="d-inline-block">{{ $qtCursosConcluidos == 1 ? 'Curso concluído' : 'Cursos concluídos' }}</span>
                                    </div>
                                </div>

                                <div class="box-shadow rounded-10 py-4 px-2 mb-4 text-center text-bluegray">
                                    <div class="d-inline-block align-middle mr-2" style="background-color: #354353;border: 3px solid #E3E5F0;padding: 10px 13.25px; border-radius:  50px;text-align:  -webkit-center;font-size: 26px;">
                                        <i class="fas fa-edit fa-fw" style="color: #3CD689;"></i>
                                    </div>
                                    <div class="d-inline-block align-middle text-left">

                                        <h4 class="d-inline-block font-weight-bold">
                                            {{ $qtAtividadesConcluidas }}
                                        </h4>
                                        <br>
                                        <span class="d-inline-block">{{ $qtAtividadesConcluidas == 1 ? 'Atividade concluída' : 'Atividades concluídas' }}</span>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-12 col-md-3">
                            <div class="container-fluid px-0">

                                <div class="box-shadow rounded-10 pt-4 pb-2 px-4 mb-4 text-bluegray">
                                    <h5 class="font-weight-bold mb-4">
                                        Matriculados
                                    </h5>
                                    @foreach ($matriculados as $matricula)
                                        <h6 class="font-weight-bold mb-3">
                                            <a href="{{ route('curso', ['idCurso' => $matricula->curso->id]) }}">{{ $matricula->curso->titulo }}</a>
                                        </h6>
                                    @endforeach
                                    @if(count($matriculados) == 0)
                                        <h6 class="font-weight-bold mb-3">
                                            Você ainda não está em nenhum curso.
                                        </h6>
                                    @endif
                                </div>

                                <div class="box-shadow rounded-10 pt-4 pb-2 px-4 mb-4 text-bluegray">
                                    <h5 class="font-weight-bold mb-4">
                                        Últimos acessados
                                    </h5>
                                    @foreach ($acessados as $acesso)
                                        <h6 class="font-weight-bold mb-3">
                                            <a href="{{ route('curso', ['idCurso' => $acesso->curso->id]) }}">{{ $acesso->curso->titulo }}</a>
                                            <small class="d-block text-lightgray pt-1"><i class="fas fa-eye mr-2"></i> {{ $acesso->curso->visualizacoes }}</small>
                                        </h6>
                                    @endforeach
                                    @if(count($acessados) == 0)
                                        <h6 class="font-weight-bold mb-3">
                                            Você ainda não acessou nenhum curso.
                                        </h6>
                                    @endif
                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-12">



                                    <div class="text-center text-uppercase my-4 mx-auto">
                                        <div class="row mx-auto">
                                            <div class="separator-bar bar-left"></div>
                                            <a href="{{ route('resultados') }}" class="font-weight-bold"> Ver resultados </a>
                                            <div class="separator-bar bar-right"></div>
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

    <!-- Bootstrap Datepicker JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/locales/bootstrap-datepicker.pt-BR.min.js"></script>

    <script>

        $('#txtDatePicker').datepicker({
            weekStart: 0,
            language: "pt-BR",
            daysOfWeekHighlighted: "0,6",
            autoclose: true,
            todayHighlight: true
        });

        $( document ).ready(function()
        {

        });

    </script>

@endsection
