@extends('layouts.master')

@section('title', 'J. PIAGET - Teste de nivelamento')

@section('headend')

    <!-- Custom styles for this template -->
    <style>

        header {
            padding: 154px 0 100px;
        }

        @media (min-width: 992px) {
            header {
                padding: 156px 0 100px;
            }
        }

        .card {
            background-color: #FFFFFF;
            display: flex;
            flex-direction: row;
            padding: 6px;
            border-radius: 5px;
        }

    </style>

@endsection

@section('content')

    <main role="main" class="mr-0">

        <div class="container">

            <div class="col-11 px-2 px-lg-0 mx-auto">

                <div class="col-12 title pl-0">
                    <h2>Teste de nivelamento</h2>
                </div>


                <h5 class="font-weight-bold my-3">Testes finalizados</h5>

                <div class="row">
                    @forelse($finalizados as $finalizado)
                        <div class="col-lg-4 col-md-12 mb-3">
                            <div class="card rounded-10 text-decoration-none h-100 border-0 flex-column">
                                <div class="py-3 px-4 h-100" style="color: #60748A;font-size: 16px;flex: 1;">
                                    <div class="mb-3 row">
                                        <div class="col-12 col-xl-6">
                                            <small>
                                                <i class="far fa-clock"></i>
                                                Iniciado: <br>
                                                {{  date('d/m/y - H:i', strtotime($finalizado->created_at)) }}
                                            </small>
                                        </div>
                                        <div class="col-12 col-xl-6">
                                            <small>
                                                <i class="fas fa-clock"></i>
                                                Finalizado: <br>
                                                {{  date('d/m/y - H:i', strtotime($finalizado->finalizado)) }}
                                            </small>
                                        </div>
                                    </div>
                                    <span class="d-block font-weight-bold">{{ ucfirst($finalizado->teste->titulo) }}</span>
                                    <span class="d-block mb-2"><small>{{ ucfirst($finalizado->teste->descricao) }}</small></span>
                                </div>
                                <div class="py-2 px-1"
                                     style="color: #C3C4D9;font-size: 16px;text-align: right;align-self: flex-end;">
                                    <a href="{{ route('teste.finalizado', $finalizado->id) }}"
                                       class="btn btn-primary font-weight-bold">
                                        Visualizar
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p>
                            Nenhum teste finalizado.
                        </p>
                    @endforelse
                </div>

                <hr>

                <h6 class="text-blue font-weight-bold mb-3 ">Testes em aberto</h6>

                <div class="row">
                    @forelse($abertos as $aberto)
                        <div class="col-lg-4 col-md-12 mb-3">
                            <div class="card rounded-10 text-decoration-none h-100 border-0 flex-column flex-wrap">
                                <div class="py-3 px-4 h-100" style="color: #60748A;font-size: 16px;flex: 1;">
                                    <span class="d-block font-weight-bold">{{ ucfirst($aberto->teste->titulo) }}</span>
                                    <span class="d-block mb-2"><small>{{ ucfirst($aberto->teste->descricao) }}</small></span>
                                </div>
                                <div class="py-2 px-1"
                                     style="color: #C3C4D9;font-size: 16px;text-align: right;align-self: flex-end;">
                                    <a href="{{ route('teste.exibe', $aberto->teste->id) }}"
                                       class="btn btn-outline-warning font-weight-bold">
                                        Continuar
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p>
                            Nenhum teste em aberto.
                        </p>
                    @endforelse
                </div>

                <hr>


                <h6 class="text-blue font-weight-bold mb-3 ">Todos os testes</h6>

                <div class="row">
                    @forelse($testes as $teste)
                        <div class="col-lg-4 col-md-12 mb-3">
                            <div class="card rounded-10 text-decoration-none border-0 h-100 flex-wrap">
                                <div class="py-3 px-4" style="color: #60748A;font-size: 16px;flex: 1;">
                                    <span class="d-block font-weight-bold">{{ ucfirst($teste->titulo) }}</span>
                                    <span class="d-block mb-2"><small>{{ ucfirst($teste->descricao) }}</small></span>
                                </div>
                                <div class="py-2 px-1 mx-auto"
                                     style="color: #C3C4D9;font-size: 16px;text-align: right;align-self: flex-end;">
                                    <a href="{{ route('teste.exibe', $teste->id) }}"
                                       class="btn btn-outline-primary font-weight-bold">
                                        Iniciar
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p>
                            Nenhum teste de nivelamento cadastrado no momento.
                        </p>
                    @endforelse
                </div>


            </div>
        </div>

    </main>

@endsection

@section('bodyend')

    <script>


    </script>

@endsection
