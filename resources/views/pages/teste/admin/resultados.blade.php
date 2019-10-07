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
            min-height: 120px;
            margin-bottom: 20px;
        }

    </style>
@endsection

@section('content')

    <main role="main" class="mr-0">

        <div class="py-2">
            <div class="col-11 px-2 px-lg-0 mx-auto mt-4">
                <h4 class="text-primary font-weight-bold mb-5">Resultados para {{ $teste->titulo }}</h4>

                <h6 class="text-blue font-weight-bold mb-3 ">Testes finalizados</h6>

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
                                    <hr>
                                    <span class="d-block font-weight-light">
                                        <i class="fas fa-user-graduate"></i> {{ $finalizado->user->name }}
                                    </span>
                                    <span class="d-block font-weight-bold">{{ $finalizado->teste->titulo }}</span>
                                    <span class="d-block mb-2"><small>{{ $finalizado->teste->descricao }}</small></span>
                                </div>
                                <div class="py-2 px-1"
                                     style="color: #C3C4D9;font-size: 16px;text-align: right;align-self: flex-end;">
                                    <a href="{{ route('teste.finalizado', $finalizado->id) }}"
                                       class="text-success font-weight-bold">
                                        Visualizar
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p>Nenhum teste finalizado</p>
                    @endforelse
                </div>

                <hr>

                <h6 class="text-blue font-weight-bold mb-3 ">Testes aguardando correção</h6>

                <div class="row">
                    @forelse($correcoes as $correcao)
                        <div class="col-lg-4 col-md-12 mb-3">
                            <div class="card rounded-10 text-decoration-none h-100 border-0 flex-column">
                                <div class="py-3 px-4 h-100" style="color: #60748A;font-size: 16px;flex: 1;">
                                    <div class="mb-3 row">
                                        <div class="col-12 col-xl-6">
                                            <small>
                                                <i class="far fa-clock"></i>
                                                Iniciado: <br>
                                                {{  date('d/m/y - H:i', strtotime($correcao->created_at)) }}
                                            </small>
                                        </div>
                                        <div class="col-12 col-xl-6">
                                            <small>
                                                <i class="fas fa-clock"></i>
                                                Finalizado: <br>
                                                {{  date('d/m/y - H:i', strtotime($correcao->finalizado)) }}
                                            </small>
                                        </div>
                                    </div>
                                    <hr>
                                    <span class="d-block font-weight-light">
                                        <i class="fas fa-user-graduate"></i> {{ $correcao->user->name }}
                                    </span>
                                    <span class="d-block font-weight-bold">{{ $correcao->teste->titulo }}</span>
                                    <span class="d-block mb-2"><small>{{ $correcao->teste->descricao }}</small></span>
                                </div>
                                <div class="py-2 px-1"
                                     style="color: #C3C4D9;font-size: 16px;text-align: right;align-self: flex-end;">
                                    <a href="{{ route('gestao.teste.resultado.exibe', $correcao->id) }}"
                                       class="text-warning font-weight-bold">
                                        Corrigir teste
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p>Nenhum teste finalizado</p>
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
