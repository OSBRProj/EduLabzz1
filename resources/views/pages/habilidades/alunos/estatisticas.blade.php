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

        .big-number {
            font-size: 30px;
            color: #0D1033;
        }

        .select-visualizar {
            border: 3px solid #60748A;
            color: #60748A;
            margin: auto 20px;
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

                    <div class="col-12 title pl-0">
                        <h2>Estatísticas</h2>
                    </div>

                    <section class="mt-4">

                        <div class="d-flex justify-content-center">
                            <div class="title-active-container mr-4">
                                <div>
                                    <a href="{{ route('habilidades.estatisticas.listar') }}"
                                    class="text-primary font-weight-bold ">Estatísticas</a>
                                </div>
                                <div class="title-active"></div>
                            </div>
                            <a href="{{ route('habilidades.listar') }}" class="text-secondary mr-5">Habilidades</a>
                        </div>


                        <div class="mt-5">
                            <p>Notas e resultados</p>
                            <div class="d-lg-flex justify-content-start align-items-center flex-wrap">
                                <div class="card px-5 py-4 text-center ml-md-3 mb-3">
                                    <p class="font-weight-bold">Rendimento</p>
                                    <p class="big-number mb-0">0%</p>
                                </div>

                                <div class="card px-5 py-4 text-center ml-md-3 mb-3">
                                    <p class="font-weight-bold">Média de nota</p>
                                    <p class="big-number mb-0">-</p>
                                </div>

                                <div class="card px-5 py-4 text-center ml-md-3 mb-3">
                                    <p class="font-weight-bold">Presença</p>
                                    <p class="big-number mb-0">0%</p>
                                </div>

                                <div class="card px-5 py-4 text-center ml-md-3 mb-3">
                                    <p class="font-weight-bold">Nota mais baixa</p>
                                    <p class="big-number mb-0">-</p>
                                </div>

                                <div class="card px-5 py-4 text-center ml-md-3 mb-3">
                                    <p class="font-weight-bold">Nota mais alta</p>
                                    <p class="big-number mb-0">-</p>
                                </div>
                            </div>

                            <div class="mt-4 d-lg-flex justify-content-between align-items-center">
                                <p class="mb-0">Progresso do aluno em trilhas de matérias</p>
                                <div class="d-lg-flex justify-content-center align-items-center">
                                    <strong>Visualizar</strong>
                                    <select name="visualizar" class="select-visualizar p-2">
                                        <option value="10">10</option>
                                        <option value="15">15</option>
                                        <option value="35">35</option>
                                        <option value="50">50</option>
                                    </select>
                                    <strong>por página</strong>
                                </div>
                            </div>


                            <div class="my-4">
                                <div class="card box-habilidades">

                                    <div class="box-habilidades-container">
                                        <div class="box-habilidades-container-header">
                                            <div>
                                                <span class="text-secondary">
                                                    Você não possui nenhuma trilha em andamento.
                                                </span>
                                            </div>

                                        </div>

                                    </div>



                                    {{-- <div class="box-habilidades-container">
                                        <div class="box-habilidades-container-header">
                                            <div>
                                        <span class="text-secondary">História
                                        </span>
                                            </div>
                                            <div>
                                                <button class="btn btn-sm btn-primary mr-3" id="btnBars">
                                                    <i id="iconBars" class="fas fa-minus-square"></i>
                                                </button>
                                                1%
                                            </div>
                                        </div>
                                        <div class="box-habilidades-bar">
                                            <div class="progress progress-main">
                                                <div class="progress-bar progress-bar-main" role="progressbar"
                                                    style="width: 1%;"
                                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="openBars">

                                        <div class="box-habilidades-sub-container">
                                            <div class="box-habilidades-container-header">
                                                <div>
                                                    <span>1 Bimestre</span>
                                                </div>
                                                <div>9</div>
                                            </div>
                                        </div>
                                    </div> --}}

                                </div>
                            </div>


                        </div>


                    </section>

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
