@extends('layouts.master')

@section('title', 'Piaget + Digital')

@section('headend')

    <!-- Custom styles for this template -->
    <style>

        .tag
        {
            border-radius: 10px;
            padding: 3px 15px;
            color: white;
            font-weight: bold;
            background-color: #F26F22;
            font-size: 13px;
            margin: 0px 8px 8px 8px;
            display: inline-block;
            text-transform: uppercase;
        }

        .text-primary
        {
            color: #F26F22 !important;
        }

    </style>

@endsection

@section('content')

<main role="main" class="darkmode mr-0 w-100">

        <div class="container-fluid w-100 px-0">

            <div class="py-2" style="background-image: url('{{ env('APP_LOCAL') . '/uploads/aplicacoes/capas/' .  $aplicacao->capa }}');background-size: cover;background-position: 50% 50%;background-repeat: no-repeat;height: 40vh;width: 100%;position: relative;top: 0px;left: 0px;">
            </div>

            <div class="col-11 px-2 px-lg-0 mx-auto">

                <section>

                    <div class="py-4">

                        <div class="row">

                            <div class="col-12 col-lg-11 mx-auto text-left">

                                <div class="float-right">
                                    <a href="{{ route('hub.aplicacao-play', ['idAplicacao' => $aplicacao->id]) }}" class="btn btn-primary btn-lg px-4 py-3 text-uppercase font-weight-bold text-white" style="border-radius: 50px;">
                                        Jogar agora
                                    </a>
                                </div>

                                <h4 style="color: #E4E8F5;">
                                    {{ ucfirst($aplicacao->titulo) }}
                                </h4>

                                <div>
                                    @if($aplicacao->categoria != null)
                                        <span class="text-uppercase font-weight-bold" style="color: #828BAB;">
                                            <span class="text-uppercase" style="color: #828BAB;">
                                                {{ $aplicacao->categoria->titulo }}
                                            </span>
                                        </span>
                                    @endif

                                    @if($aplicacao->tags != null ? count($aplicacao->tags) > 0 : false)
                                        @foreach ($aplicacao->tags as $marcador)
                                            @if($marcador != "")
                                                <span class="tag">
                                                    {{ ucfirst($marcador) }}
                                                </span>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>

                                <h5 class="mt-3 text-uppercase font-weight-bold text-white">
                                    Sobre {{ ucfirst($aplicacao->titulo) }}
                                </h5>

                                <h5 class="mx-auto font-weight-normal" style="color: #E4E8F5; white-space: pre-line;">
                                    {{ ucfirst($aplicacao->descricao) }}
                                </h5>

                                <h5 class="mt-5 mb-3 text-uppercase font-weight-bold text-white">
                                    CONTEÚDOS RELACIONADOS
                                </h5>

                                <div class="mb-3">
                                    @if($aplicacao->categoria != null)
                                        <span class="text-uppercase font-weight-bold" style="color: #828BAB;">
                                            <span class="text-uppercase" style="color: #828BAB;">
                                                {{ $aplicacao->categoria->titulo }}
                                            </span>
                                        </span>
                                    @endif

                                    @if($aplicacao->tags != null ? count($aplicacao->tags) > 0 : false)
                                        @foreach ($aplicacao->tags as $marcador)
                                            @if($marcador != "")
                                                <span class="tag">
                                                    {{ ucfirst($marcador) }}
                                                </span>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>

                                <div class="py-2">
                                    <div class="row">

                                        @foreach ($relacionados as $aplicacao)

                                            <div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-3">
                                                <a href="{{ route('hub.aplicacao', ['idAplicacao' => $aplicacao->id]) }}" class="card rounded-10 text-decoration-none h-100 bg-transparent border-0" style="display: flex;flex-direction: column;">
                                                    <div class="card-img-auto bg-dark" style="background-image: url('{{ env('APP_LOCAL') . '/uploads/aplicacoes/capas/' .  $aplicacao->capa }}');background-size: cover;background-position: 50% 50%;background-repeat: no-repeat;box-shadow: none;border-radius: 10px 10px 0px 0px;flex: 1;min-height: 192px;">
                                                    </div>
                                                    <div class="pt-2 pb-3 px-4 font-weight-bold" style="background-color: #0D0D0D;color: white;font-size: 16px;box-shadow: none;border-radius: 0px 0px 10px 10px;flex: 0.3;">
                                                        <span class="d-block my-2" style="color: #C8CEDF;">
                                                            {{ ucfirst($aplicacao->titulo) }}
                                                        </span>
                                                        @if($aplicacao->categoria != null)
                                                            <span class="text-uppercase" style="color: #828BAB;">
                                                                {{ $aplicacao->categoria->titulo }}
                                                            </span>
                                                        @endif
                                                        @if($aplicacao->tags != null ? count($aplicacao->tags) > 0 : false)
                                                            @foreach ($aplicacao->tags as $marcador)
                                                                @if($marcador != "")
                                                                    <span class="tag">
                                                                        {{ ucfirst($marcador) }}
                                                                    </span>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </a>
                                            </div>

                                        @endforeach

                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                </section>


            </div>

        </div>

</main>

@endsection

@section('bodyend')

    <script>

        $( document ).ready(function()
        {

        });

    </script>

@endsection
