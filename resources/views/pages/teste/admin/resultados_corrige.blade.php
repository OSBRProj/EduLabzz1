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
            width: 100%;
            background-color: #FFFFFF;
            border-radius: 5px;
        }

        .text-bluelight {
            color: #207adc;
        }

        .bg-blue {
            background: #207adc;
        }

        .border-active {
            border: 3px solid #207adc;
        }

        .innerQuestao {

        }

        hr {
            width: 100%;
            border: 1px solid #d8dae7;
        }

    </style>

@endsection

@section('content')

    <main role="main" class="mr-0">

        <div class="py-2">
            <div class="col-11 px-2 px-lg-0 mx-auto mt-4">


                <div class="col-6 px-2 px-lg-0 mx-auto">
                    <div class="card rounded-10 text-decoration-none h-100 p-4 border-0 shadow">


                        <div class="row">
                            <div class="col-12 col-xl-6">
                                <span class="mr-4">NOTA MÁXIMA:</span> <strong class="text-primary">10</strong>
                            </div>
                            <div class="col-12 col-xl-6">
                                <span class="mr-4">TEMPO RESTANTE:</span>
                                <span class="text-success">TESTE FINALIZADO</span>
                            </div>
                        </div>

                        <div class="col-lg-12 mt-4">
                            <h5 class="text-primary">{{ $resultado->teste->titulo }}</h5>
                        </div>

                        <div class="col-lg-12 mt-4">
                            <div class="row">
                                <div class="col-12 col-xl-6">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <div>
                                            <img src="https://www.w3schools.com/howto/img_avatar.png" width="75"
                                                 class="rounded-circle mr-4">
                                        </div>
                                        <div>{{ $resultado->teste->user->name }}</div>
                                    </div>
                                </div>

                                <div class="col-12 col-xl-6">
                                    <div class="mt-4">
                                        <div
                                            class="text-bluelight text-uppercase font-weight-bold">{{ $resultado->teste->created_at->format('l, jS \\ F Y')}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-12 mt-4">
                            <hr>
                            @if($countRespostas >= 1)
                                <h4 class="text-primary text-center font-weight-bold mb-4">
                                    {{ $countRespostas }} questões para correção
                                </h4>
                            @else
                                <h4 class="text-primary text-center font-weight-bold mb-4">
                                    Todas questões foram corrigidas
                                </h4>
                            @endif

                            <div class="mb-3 row">
                                <div class="col-12 col-xl-6">
                                    <small>
                                        <i class="far fa-clock"></i>
                                        Iniciado: {{  date('d/m/y - H:i', strtotime($resultado->created_at)) }}
                                    </small>
                                </div>
                                <div class="col-12 col-xl-6 text-right">
                                    <small>
                                        <i class="fas fa-clock"></i>
                                        Finalizado: {{  date('d/m/y - H:i', strtotime($resultado->finalizado)) }}
                                    </small>
                                </div>
                            </div>

                            @forelse($questoes as $questao)
                                @if($questao->questao->tipo == 1)
                                    <div class="d-flex justify-content-between">
                                        <div
                                            class="mb-4 p-3 card {{ ($questao->correta == null ? 'border' : ($questao->correta == 'true' ? "border-success" : "border-danger")) }}">
                                            <p class="font-weight-bold">{{ $questao->questao->titulo }}
                                                -{{ $questao->testeQuestao->peso }} pontos</p>
                                            <p><strong>Resposta do aluno:</strong> <br> {{ $questao->resposta }}</p>
                                        </div>
                                        <div class="mb-4 p-3 text-center">
                                            @if($questao->correta == null)
                                                <div>
                                                    <a href="{{ route('gestao.teste.resultado.correcao', ['idRespostaQuestao' => $questao->id, 'value' => 'true']) }}"
                                                       class="btn btn-success btn-block">
                                                        <i class="fas fa-check"></i> Correta
                                                    </a>
                                                </div>
                                                <hr>
                                                <div>
                                                    <a href="{{ route('gestao.teste.resultado.correcao', ['idRespostaQuestao' => $questao->id, 'value' => 'false']) }}"
                                                       class="btn btn-danger btn-block">
                                                        <i class="fas fa-times"></i> Incorreta
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endif

                            @empty
                                <div class="bg-danger p-3 text-center text-white">
                                    Nenhuma questão foi respondida
                                </div>
                            @endforelse


                        </div>


                    </div>
                </div>
            </div>

        </div>


    </main>

@endsection

@section('bodyend')

    <script>

    </script>

@endsection
