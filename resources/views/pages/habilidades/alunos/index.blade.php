@extends('layouts.master')

@section('title', 'J. PIAGET - Habilidades')

@section('headend')

    <!-- Custom styles for this template -->
    <style>
        header {
            padding: 154px 0 100px;
        }

        .text-secondary {
            color: #60748A !important;
        }

        .title-active-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .title-active {
            border-bottom: 4px solid #207adc;
            width: 80px;
            text-align: center;
        }

        @media (min-width: 992px) {
            header {
                padding: 156px 0 100px;
            }
        }

    </style>

@endsection

@section('content')

    <main role="main">

        <div class="container">

            <div class="row">

                <div class="col-12 col-md-11 mx-auto">

                    <div class="col-12 title pl-0 mb-4">
                        <h2>Habilidades</h2>
                    </div>


                    <div class="d-flex justify-content-center">
                        <a href="{{ route('habilidades.estatisticas.listar') }}" class="text-secondary mr-5">Estatísticas</a>
                        <div class="title-active-container">
                            <div>
                                <a href="{{ route('habilidades.listar') }}" class="text-primary font-weight-bold ">Habilidades</a>
                            </div>
                            <div class="title-active"></div>
                        </div>
                    </div>

                    @if($habilidades->count() !== 0)
                    <div class="row">

                        <div class="col-12 mt-4">
                            @foreach ($categorias as $categoria)
                                <div class="card box-habilidades mb-3">

                                    <div class="box-habilidades-container">
                                        <div class="box-habilidades-container-header">
                                            <div>
                                        <span class="text-secondary">
                                            {{ ucfirst($categoria->categoria) }}
                                        </span>
                                            </div>
                                            <div>
                                                <button class="btn btn-sm btn-primary mr-3" id="btnBars">
                                                    <i id="iconBars" class="fas fa-minus-square"></i>
                                                </button>
                                                {{ number_format($categoria->total_pontos / $categoria->total_habilidades, 2, ",", ".") }}
                                            </div>
                                        </div>
                                        <div class="box-habilidades-bar">
                                            <div class="progress progress-main">
                                                <div class="progress-bar progress-bar-main" role="progressbar"
                                                    style="width: {{ $categoria->total_pontos / $categoria->total_habilidades }}%;"
                                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="openBars">
                                        @foreach($habilidades as $habilidade)
                                            @if($habilidade->categoria == $categoria->categoria && ($habilidade->visibilidade == 1 || $habilidade->pontos > 0))
                                                <div class="box-habilidades-sub-container">
                                                    <div class="box-habilidades-container-header">
                                                        <div>
                                                            <span class="text-secondary">{{ $habilidade->titulo }}</span>
                                                        </div>
                                                        <div>
                                                            {{-- <span class="text-blue font-weight-bold text-uppercase mr-3">atividade relacionada</span>  --}}
                                                            {{ number_format($habilidade->pontos, 2, ",", ".") }}
                                                        </div>
                                                    </div>
                                                    <div class="box-habilidades-bar">
                                                        <div class="progress progress-sub">
                                                            <div class="progress-bar progress-bar-sub" role="progressbar"
                                                                style="width: {{ $habilidade->pontos }}%;"
                                                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>

                                </div>
                            @endforeach
                        </div>

                    </div>
                    @else
                        <p class="text-primary text-center mt-5">Você ainda não possui pontos de habilidade</p>
                    @endif

                </div>

            </div>

        </div>

    </main>

@endsection

@section('bodyend')

    <script>
        $(document).ready(function () {
            $("#btnBars").click(function () {
                let icon = $("#iconBars").attr("class");
                if (icon === "fas fa-minus-square") {
                    $("#iconBars").attr("class", "fas fa-plus-square");
                }
                if (icon === "fas fa-plus-square") {
                    $("#iconBars").attr("class", "fas fa-minus-square");
                }
                $("#openBars").toggle();
            })
        });

    </script>

@endsection
