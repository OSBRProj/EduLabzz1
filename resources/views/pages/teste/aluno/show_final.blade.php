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

    <main role="main">

        <div class="container">

            <div class="col-12 col-md-11 mx-auto">

                <div class="row">

                    <div class="col-12 title pl-0">
                        <h2>Teste de nivelamento: {{ ucwords($resultado->teste->titulo) }}</h2>
                    </div>

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0 py-3 mb-0 bg-transparent border-0">
                            <li class="breadcrumb-item active" aria-current="page">
                                <a href="{{ route('teste.listar') }}" >
                                    <i class="fas fa-chevron-left mr-2"></i>
                                    <span>Teste de nivelamento</span>
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ ucwords($resultado->teste->titulo) }}</li>
                        </ol>
                    </nav>

                    <div class="card rounded-10 pb-3 text-decoration-none h-100 p-4 border-0 shadow-sm">

                        <div class="col-12">
                            <span class="mr-2 font-weight-bold">NOTA MÁXIMA:</span> <strong class="text-primary">10</strong>
                        </div>
                        <div class="col-12">
                            <span class="mr-2 font-weight-bold">TEMPO RESTANTE:</span>
                            <span class="text-success font-weight-bold">TESTE FINALIZADO</span>
                        </div>

                        <div class="col-lg-12 mt-4">
                            <h5 class="text-primary">{{ ucwords($resultado->teste->titulo) }}</h5>
                        </div>

                        <div class="col-lg-12 mt-4">
                            <div class="row">
                                <div class="col-12 col-xl-6 my-auto">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <div>
                                            <div class="avatar-img avatar-md mr-4"
                                                style="background: url({{ route('usuario.perfil.image', [Auth::user()->id]) }}); background-size: cover; background-position: 50% 50%; background-repeat: no-repeat;">
                                            </div>
                                        </div>
                                        <div><strong>{{ $resultado->teste->user->name }}</strong></div>
                                    </div>
                                </div>

                                <div class="col-12 col-xl-6 my-auto">
                                    <div>
                                        <div class="text-bluelight text-uppercase font-weight-bold">{{ $resultado->teste->created_at->formatLocalized('%A, %d %B %Y')}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-12 mt-4">
                            <hr>
                            <h4 class="text-center font-weight-bold my-4">Resultado do teste</h4>

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

                            @if (session('msgDissertativa'))
                                <div class="mt-4">
                                    <div class="bg-warning p-3 text-center text-white">
                                        <i class="far fa-clock"></i> {{ session('msgDissertativa') }}2
                                    </div>
                                </div>

                            @else

                                @forelse($questoes as $questao)
                                    @if($questao->questao->tipo == 2)
                                        <div
                                            class="mb-4 p-3 card {{ ($questao->resposta == $questao->correta ? "card border-success" : "card border-danger") }}">
                                            <p class="font-weight-bold">{{ $questao->questao->titulo }}
                                                -{{ $questao->testeQuestao->peso }} pontos</p>
                                            <p>Sua resposta: {{ $questao->resposta }}</p>
                                            @if($questao->resposta !== $questao->correta)
                                                <small class="text-success">Resposta
                                                    correta: {{ $questao->correta }}</small>
                                            @endif
                                        </div>
                                    @else
                                        <div
                                            class="mb-4 p-3 card {{ ($questao->correta == 'true' ? "border-success" : "border-danger") }}">
                                            <p class="font-weight-bold">{{ $questao->questao->titulo }}
                                                -{{ $questao->testeQuestao->peso }} pontos</p>
                                            <p>Sua resposta: {{ $questao->resposta }}</p>
                                        </div>
                                    @endif

                                @empty
                                    <div class="bg-danger p-3 text-center text-white">
                                        Nenhuma questão foi respondida
                                    </div>
                                @endforelse
                                <div class="bg-primary p-3 text-white text-center">
                                    Pontuação total:
                                    <br>
                                    @if($resultado->pontuacao == null)
                                        <h2><span class="badge badge-secondary bg-danger">0 </span> pontos</h2>
                                    @else
                                        <h2><span class="badge badge-secondary bg-warning">{{ $resultado->pontuacao }} </span> pontos</h2>
                                    @endif
                                    <br>
                                    @if($resultado->teste->direcionamentos->count() > 0)
                                        <div class="text-center">
                                            @foreach($resultado->teste->direcionamentos as $direcionamento)
                                                @switch($direcionamento->regra)
                                                    @case('<')
                                                    @if($resultado->pontuacao < $direcionamento->pontuacao)
                                                        <h3>{{ $direcionamento->direcionamento }}</h3>
                                                    @endif
                                                    @break

                                                    @case('>')
                                                    @if($resultado->pontuacao > $direcionamento->pontuacao)
                                                        <h3>{{ $direcionamento->direcionamento }}</h3>
                                                    @endif
                                                    @break

                                                    @case('==')
                                                    @if($resultado->pontuacao == $direcionamento->pontuacao)
                                                        <h3>{{ $direcionamento->direcionamento }}</h3>
                                                    @endif
                                                    @break

                                                    @case('<=')
                                                    @if($resultado->pontuacao <= $direcionamento->pontuacao)
                                                        <h3>{{ $direcionamento->direcionamento }}</h3>
                                                    @endif
                                                    @break

                                                    @case('>=')
                                                    @if($resultado->pontuacao >= $direcionamento->pontuacao)
                                                        <h3>{{ $direcionamento->direcionamento }}</h3>
                                                    @endif
                                                    @break
                                                @endswitch
                                            @endforeach

                                        </div>
                                    @endif
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

    <script>
        $( document ).ready(function()
        {
            toggleSideMenu();
        });
    </script>

@endsection
