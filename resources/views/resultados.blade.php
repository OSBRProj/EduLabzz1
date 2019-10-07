@extends('layouts.master')

@section('title', 'J. PIAGET - Resultados')

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

    </style>

@endsection

@section('content')

<main role="main">

    <div class="container-fluid">
        <div class="row">

            <div class="col-12 col-md-10 mx-auto">

                <div class="container-fluid pt-4">

                    <div class="row mb-4">

                        <div class="col-12 align-middle my-3">
                            <h3>Rendimento</h3>
                        </div>

                        <div class="col-4">
                            <div class="box-shadow rounded-10 py-4 px-5 text-center text-white h-100" style="background-color: #525870;">
                                <h2 class="font-weight-bold my-auto">
                                    <small class="d-block mb-2">
                                        Atividades
                                    </small>
                                    {{ $rendimentoAtividades }}%
                                </h2>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="box-shadow rounded-10 py-4 px-5 text-center text-white h-100" style="background-color: #207adc;">
                                <h2 class="font-weight-bold my-auto">
                                    <small class="d-block mb-2">
                                        Aulas
                                    </small>
                                    {{ $rendimentoAulas }}%
                                </h2>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="box-shadow rounded-10 py-4 px-5 text-center text-white h-100" style="background-color: #6C79A7;">
                                <h2 class="font-weight-bold my-auto">
                                    <small class="d-block mb-2">
                                        Cursos
                                    </small>
                                    {{ $rendimentoCursos }}%
                                </h2>
                            </div>
                        </div>

                    </div>

                    <div class="row mb-4">

                        <div class="col-12 col-sm-6 align-middle my-auto">
                            <h3>
                                Progresso
                            </h3>
                        </div>

                        <div class="col-12 col-sm-6 my-auto text-center text-sm-right">
                            <div class="dropdown">
                                <label for="cmbLimite" class="h6 mr-2 font-weight-bold text-lighter">Mostrar</label>
                                <button class="btn dropdown-toggle w-auto border-0 bg-gray box-shadow font-weight-bold text-lighter" type="button" id="cmbLimite" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    10
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item font-weight-bold text-lighter" href="{{ HelperClass::appendToUrl(['qt' => '10']) }}">10</a>
                                    <a class="dropdown-item font-weight-bold text-lighter" href="{{ HelperClass::appendToUrl(['qt' => '15']) }}">15</a>
                                    <a class="dropdown-item font-weight-bold text-lighter" href="{{ HelperClass::appendToUrl(['qt' => '20']) }}">20</a>
                                    <a class="dropdown-item font-weight-bold text-lighter" href="{{ HelperClass::appendToUrl(['qt' => '35']) }}">35</a>
                                </div>
                                <label for="cmbLimite" class="h6 ml-2 font-weight-bold text-lighter">por página</label>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        @foreach ($matriculados as $matricula)
                            <div class="col-12 mb-3">
                                <div class="box-shadow rounded-10 py-3 text-left text-bluegray">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-6 my-auto">
                                                <h5 class="font-weight-bold m-0">
                                                    {{ ucfirst($matricula->curso->titulo) }}
                                                </h5>
                                            </div>
                                            <div class="col-4 my-auto text-center">
                                                <div class="" style="width: 100%; height: 12px; padding: 2px; background-color:  #E3E5F0;border-radius:  90px;">
                                                    <div style="width: {{ $matricula->curso->progresso }}%;height:  100%;background-color:  #207adc;border-radius:  90px;transition:  0.3s all ease-in-out;">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-2 my-auto text-right">
                                                <span class="mr-3" style="padding: 0px 6px;font-weight:  bold;font-size:  16px;color:  #999FB4;">
                                                    {{ $matricula->curso->progresso }}%
                                                </span>
                                                <button type="button" data-toggle="collapse" data-target="#collapseCurso{{ $matricula->curso->id }}" aria-expanded="false" aria-controls="collapseExample" class="btn btn-xl btn-primary">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 collapse" id="collapseCurso{{ $matricula->curso->id }}">
                                                <div class="container-fluid">
                                                    <div class="mx-2 px-2 pt-3 mt-3" style="border-top: 3px solid #F9F9F9;">

                                                        @foreach ($matricula->curso->aulas as $aula)
                                                            <div class="row mb-3">
                                                                <div class="col my-auto">
                                                                    <h6 class="font-weight-bold m-0">
                                                                        {{ ucfirst($aula->titulo) }}
                                                                    </h6>
                                                                </div>
                                                                <div class="col ml-auto my-auto text-right">
                                                                    <h6 class="font-weight-bold text-uppercase {{ $aula->progresso < 100 ? 'text-bluegray' : 'text-primary' }} m-0">
                                                                        {{ $aula->progresso < 100 ? $aula->progresso . '%' : 'Completa' }}
                                                                    </h6>
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
                        @endforeach

                        @if(count($matriculados) == 0)
                            <div class="col-12 mb-3">
                                <div class="box-shadow rounded-10 py-3 text-left text-bluegray">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-6 my-auto">
                                                <h5 class="font-weight-bold m-0">
                                                    Você ainda não está matriculado em nenhum curso
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

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
