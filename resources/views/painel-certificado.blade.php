@extends('layouts.master')

@section('title', (isset($escola) ? $escola->titulo : 'Jean Piaget') . ' - Certificado ' . ucfirst($curso->titulo))

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
            background: #008cc8;
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

            <div class="col-12 col-md-10 mx-auto pt-5 pb-3">

                <div class="row">
                    <div class="col align-middle my-auto">
                        <h3>Certificado do curso: {{ ucfirst($curso->titulo) }}</h3>
                    </div>
                    <button class="btn btn-outline border-primary text-primary" onclick="imprimirCertificado();">Imprimir</button>
                </div>

                <div class="col-auto mx-auto mt-3" style="text-align: -webkit-center;">
                    <iframe id="printf" name="printf" class="" src="{{ route('curso.certificado', ['idCurso' => $curso->id]) }}" style="overflow: hidden;border: none;width: 75vw;height: 42vw;">
                    </iframe>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="text-center text-uppercase my-2 mx-auto">
                            <div class="row mx-auto">
                                <div class="separator-bar bar-left"></div>
                                <a href="{{ isset($escola) ? route('painel', ['escola_id' => $escola->url]) : route('painel') }}" class="font-weight-bold"> Meu Painel </a>
                                <div class="separator-bar bar-right"></div>
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

        function imprimirCertificado()
        {
            window.frames["printf"].focus();
            window.frames["printf"].print();
        }

    </script>

@endsection
