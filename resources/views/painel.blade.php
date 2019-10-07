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

    </style>

@endsection

@section('content')

<main role="main">

    <div class="container-fluid">
        <div class="row">

            <div class="col-12 col-md-10 mx-auto p-5">

                <div class="row">
                    <div class="col align-middle my-auto">
                        <h3>Painel</h3>
                    </div>
                </div>

                <div class="container-fluid pt-4">

                    <div class="row">

                        <div class="col-6">
                            <h3 class="text-lighter font-weight-bold mb-4">Continuar</h3>

                            <div class="box-shadow rounded-10 py-4 px-4 mb-4 text-center">

                                <h4 class="font-weight-bold my-4">
                                    <div class="avatar-img avatar-img-md my-3 d-inline-block mr-2" style="width: 54px;height: 54px; background: url({{ route('usuario.perfil.image', [Auth::user()->id]) }}); background-size: cover; background-position: 50% 50%; background-repeat: no-repeat;"></div>
                                    {{ ucfirst(Auth::user()->name) }}
                                </h4>

                                @if ($continuar == null)
                                    <h5 class="font-weight-bold my-3">
                                        Você não possui nenhum curso em andamento
                                    </h5>
                                @else
                                    <div style="width: 100%;">
                                        <div class="mt-3 mb-4" style="width: calc(100% - 70px);height: 8px;background-color:  #E3E5F0;border-radius:  90px;display:  inline-block;vertical-align:  -webkit-baseline-middle;">
                                            <div style="width: {{ $continuar->progresso }}%;height:  100%;background-color:  #207adc;border-radius:  90px;transition:  0.3s all ease-in-out;">
                                            </div>
                                        </div>
                                        <span style="padding: 0px 6px;font-weight:  bold;font-size:  12px;color:  #999FB4;">{{ $continuar->progresso }}%</span>
                                    </div>

                                    <h5 class="font-weight-bold my-3">
                                        {{ ucfirst($continuar->curso->titulo) }}
                                    </h5>

                                    <h4 class="font-weight-bold my-4">
                                            Onde parei?
                                    </h4>
                                    <h5 class="font-weight-bold my-4">
                                        Aula {{ $continuar->ultimaAula }} de {{ $continuar->qtAulas }} / Atividade {{ $continuar->ultimoConteudo }} de {{ $continuar->qtConteudos }}
                                    </h5>
                                    <div class="container py-2">
                                        <div class="row">
                                            <div class="col-6">
                                                <a href="{{ route('curso', ['idCurso' => $continuar->curso->id]) }}" class="btn px-3 rounded-10" style="border: 2px solid #999FB4; color: #999FB4; background: transparent; font-weight: bold;">
                                                    Ver conteúdos
                                                </a>
                                            </div>
                                            <div class="col-6">
                                                <a href="{{ route('curso.play', ['idCurso' => $continuar->curso->id]) }}" class="btn bg-bluelight px-5 rounded-10" style="color: #566188;border: 2px solid #5678ef;font-weight: bold;">
                                                    Continuar
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                @endif

                            </div>

                        </div>

                        <div class="col-6">
                            <h3 class="text-lighter font-weight-bold mb-4">Últimos</h3>

                            <div class="container">

                                @foreach ($ultimos as $index => $ultimo)
                                    @if($index > 1)
                                        <div class="box-shadow rounded-10 py-4 px-4 mb-4 text-center">
                                            <div style="width: 100%;">
                                                <div class="mt-3 mb-4" style="width: calc(100% - 70px);height: 8px;background-color:  #E3E5F0;border-radius:  90px;display:  inline-block;vertical-align:  -webkit-baseline-middle;">
                                                    <div style="width: {{ $ultimo->progresso }}%;height:  100%;background-color:  #207adc;border-radius:  90px;transition:  0.3s all ease-in-out;">
                                                    </div>
                                                </div>
                                                <span style="padding: 0px 6px;font-weight:  bold;font-size:  12px;color:  #999FB4;">{{ $ultimo->progresso }}%</span>
                                            </div>
                                            <h5 class="font-weight-bold">
                                                {{ $ultimo->curso->titulo }}
                                            </h5>
                                        </div>
                                    @elseif(count($ultimos) == 1)
                                        <div class="box-shadow rounded-10 py-4 px-4 mb-4 text-center">
                                            <div style="width: 100%;">
                                                <div class="mt-3 mb-4" style="width: calc(100% - 70px);height: 8px;background-color:  #E3E5F0;border-radius:  90px;display:  inline-block;vertical-align:  -webkit-baseline-middle;">
                                                    <div style="width: {{ $ultimo->progresso }}%;height:  100%;background-color:  #207adc;border-radius:  90px;transition:  0.3s all ease-in-out;">
                                                    </div>
                                                </div>
                                                <span style="padding: 0px 6px;font-weight:  bold;font-size:  12px;color:  #999FB4;">{{ $ultimo->progresso }}%</span>
                                            </div>
                                            <h5 class="font-weight-bold">
                                                {{ $ultimo->curso->titulo }}
                                            </h5>
                                        </div>
                                    @endif
                                @endforeach

                                @if (count($ultimos) == 0)
                                    <div class="box-shadow rounded-10 py-4 px-4 mb-4 text-center">
                                        <h5 class="font-weight-bold">
                                            Você ainda não iniciou nenhum curso
                                        </h5>
                                    </div>
                                @endif

                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-12 align-middle my-3">
                            <h3>Concluídos</h3>
                        </div>

                        @foreach ($concluidos as $concluido)
                            <div class="col-3">
                                <div class="box-shadow rounded-10 py-4 px-5 text-center">
                                    <h6 class="font-weight-bold mb-4">
                                        {{ $concluido->curso->titulo }}
                                    </h6>

                                    <a href="{{ route('painel.certificado', ['idCurso' => $concluido->curso->id]) }}" class="d-block font-weight-bold">Ver certificado</a>
                                </div>
                            </div>
                        @endforeach
                        @if(count($concluidos) == 0)
                            <div class="col-3">
                                <div class="box-shadow rounded-10 py-4 px-5 text-center">
                                    <h6 class="font-weight-bold mb-4">
                                        Você ainda não concluiu nenhum curso
                                    </h6>
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
