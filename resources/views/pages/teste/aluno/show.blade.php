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

                <div class="col-12 title pl-0 border-0">
                    <h2>Teste de nivelamento: <span class="text-black-50"> {{ ucwords($teste->titulo) }} </span></h2>
                </div>

                @if(session('msgExpirado'))
                @else
                    @if (session('msgTeste'))
                        <div class="row mt-4 mb-4">
                            <div class="col-12">
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <span class="text-center">{{ session('msgTeste') }}</span>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif


                @if (session('msgExpirado'))
                    <div class="mt-4 mb-4">
                        <div class="col-6 px-2 px-lg-0 mx-auto">
                            <div class="alert alert-danger p-4 alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <span class="text-center">{{ session('msgExpirado') }}</span>
                            </div>
                        </div>
                    </div>
                @endif

                @if (session('msgAddQuestao'))
                    <div class="mt-4 mb-4">
                        <div class="col-6 px-2 px-lg-0 mx-auto">
                            <div class="alert alert-success p-4 alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <span class="text-center">{{ session('msgAddQuestao') }}</span>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="">
                    <div class="card rounded-10 text-decoration-none h-100 p-5 border-0 shadow-sm">
                        <form class="row" action="{{ route('teste.questao.cadastro') }}" method="post">
                            @csrf

                            <input type="hidden" name="teste_id" value="{{ $teste->id }}">
                            <input type="hidden" name="teste_nivelamento_resultado_id" value="{{ $resultadoId }}">
                            <input type="hidden" name="questao_id" value="{{ $testeQuestao->id }}">

                            <div class="col-lg-6">
                                <span class="mr-4">NOTA MÁXIMA:</span> <strong class="text-primary">10</strong>
                            </div>
                            <div class="col-lg-6">
                                @if($teste->tempo)
                                    <span class="mr-4">TEMPO RESTANTE:</span>
                                    @if(session('msgExpirado'))
                                        <span class="text-danger">TEMPO EXPIRADO</span>
                                    @else
                                        <strong class="text-primary">
                                            <span class="time"></span>
                                        </strong>
                                    @endif
                                @endif
                            </div>

                            <div class="col-lg-12 mt-4">
                                <h5 class="text-primary">{{ ucwords($teste->titulo) }}</h5>
                            </div>

                            <div class="col-lg-12 mt-4">
                                <div class="row">
                                    <div class="col-lg-6 my-auto">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <div>
                                                <div class="avatar-img avatar-md mr-4"
                                                    style="background: url({{ route('usuario.perfil.image', [Auth::user()->id]) }}); background-size: cover; background-position: 50% 50%; background-repeat: no-repeat;">
                                                </div>
                                            </div>
                                            <div>{{ $teste->user->name }}</div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 my-auto">
                                        <div>
                                            <div class="text-bluelight text-uppercase font-weight-bold">{{ $teste->created_at->formatLocalized('%A, %d %B %Y') }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 mt-4">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <select name="questoes" id="questoes" class="form-control">
                                            @foreach($teste->questoes->whereIn('questao_id', $questoesRespondidas) as $questao)
                                                <option class="disabled" disabled>
                                                    {{ $questao->questao->titulo }} - Respondida
                                                </option>
                                            @endforeach

                                            @foreach($teste->questoes->whereNotIn('questao_id', $questoesRespondidas) as $questao)
                                                <option
                                                    value="{{$questao->questao->id}}" {{ ($questao->questao->id == $testeQuestao->id ? 'selected' : '') }}>
                                                    {{ $questao->questao->titulo }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mr-3">
                                        <div class="innerQuestao">
                                            @if(\Request::is('teste-nivelamento/*/*/exibe'))
                                                <span class="mr-4">PESO:</span> <strong
                                                    class="text-primary">{{ $pesoQuestao->peso }}</strong>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if(\Request::is('teste-nivelamento/*/*/exibe'))
                                <div class="col-lg-12 innerQuestao">

                                    <div class="col-lg-12 mt-4">
                                        <span class="mr-4">TIPO DE RESPOSTA:</span>
                                        <strong class="text-primary">
                                            {{ ($testeQuestao->tipo == 1 ? "DISSERTATIVA" : "MULTIPLA-ESCOLHA")  }}
                                        </strong>
                                    </div>

                                    <div class="col-lg-12 mt-4">
                                        <h5 class="text-primary">{{ $testeQuestao->titulo }}</h5>
                                        <p>{{ $testeQuestao->descricao }}</p>
                                    </div>


                                    @if($testeQuestao->tipo == 1)
                                        <div class="col-lg-12 mt-4">
                                        <textarea class="form-control border-active" name="resposta" rows="5"
                                                  placeholder="Digite sua resposta" required></textarea>
                                        </div>
                                    @else
                                        <div class="col-lg-12 mt-4">
                                            @foreach(json_decode($testeQuestao->alternativas) as $id => $alternativa)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="alternativa"
                                                           value="{{ $id }}" required>
                                                    <label class="form-check-label">
                                                        {{ $alternativa }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif


                                    <div class="col-lg-12 mt-4">
                                        <hr>

                                        <div class="row">

                                            @if (session('msgExpirado'))
                                                <a href="{{ route('teste.listar') }}"
                                                   class="btn btn-lg btn-block outline-button mt-4 mb-0 col-4 ml-auto mr-4 font-weight-bold">
                                                    VOLTAR
                                                </a>
                                                <button type="button"
                                                        class="btn btn-lg bg-secondary btn-block disabled mt-4 mb-0 col-4 ml-4 mr-auto text-white font-weight-bold"
                                                        disabled>
                                                    CONFIRMAR
                                                </button>
                                            @else
                                            <div class="mx-auto">
                                                <a href="{{ route('teste.listar') }}"
                                                    class="btn btn-primary">
                                                    VOLTAR
                                                </a>

                                                <button type="submit"
                                                    class="btn btn-success">
                                                    CONFIRMAR
                                                </button>
                                            </div>
                                            @endif
                                        </div>


                                    </div>
                                </div>
                        </form>
                        @endif

                    </div>
                </div>

            </div>

        </div>

    </div>


</main>

@endsection

@section('bodyend')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.23.0/locale/pt-br.js"></script>

    <script>

        $( document ).ready(function()
        {
            toggleSideMenu();
        });

        function updateTime() {
            var testeTime = '{{$teste->tempo}}';
            var testeExpired = '{{$expired}}';
            var now = moment(new Date());
            var date_final = moment('{{$final_date}}');
            var diff = date_final.diff(now);
            var diffDuration = moment.duration(diff);
            $('.time').html(diffDuration.minutes() + ':' + diffDuration.seconds());

            if (testeTime !== "" && diffDuration.minutes() <= 0 && diffDuration.seconds() <= 0 && testeExpired == 1) {
                $.get("{{ env("APP_LOCAL") }}/teste-nivelamento/expira/update/{{$resultadoId}}", function () {
                    location.reload();
                });
            }
        }

        setInterval(updateTime, 1000);

        $('select#questoes').on('change', function () {
            var resultadoId = '{{$resultadoId}}';
            var idTeste = '{{$teste->id}}';
            var idQuestao = $(this).val();
            location.href = '{{ env("APP_LOCAL") }}/teste-nivelamento/' + idTeste + '/questao/' + idQuestao + '/' + resultadoId + '/exibe';
        })
    </script>

@endsection
