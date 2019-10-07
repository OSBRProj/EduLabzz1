@extends('layouts.master')

@section('title', 'J. PIAGET - Biblioteca')

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

        .card
        {
            background-color: #FFFFFF;
            display: flex;
            flex-direction: row;
            padding: 6px;
            border-radius: 5px;
            align-items: center;
        }

        .card.badge .card-img-auto
        {
            width: 70px;
            height: 70px;
            min-height: none;
            background-size: cover;
            background-position: 50% 50%;
            background-repeat: no-repeat;
            margin: 10px;
            border-radius: 10px;
            background-color: #13141D;
            border: 1px solid #989AC1;
        }

        .card.badge.unlocked .card-img-auto
        {
            background-color: #207adc;
        }

    </style>

@endsection

@section('content')

<main role="main" class="mr-0">

    <div class="row justify-content-center">

        <div class="col-11 px-2 px-lg-0 mx-auto">

            <section>
                <div class="row my-4">
                    <div class="col-md-6 text-center text-md-left mb-3 mb-md-0">
                        <h4 class="my-2" style="color: #989AC1;">
                            Perfil do aluno
                            <small class="d-block">
                                Lista de badges do jogador
                            </small>
                        </h4>
                    </div>
                </div>

                <div class="py-2">
                    <div class="row">
                        @foreach ($badges as $badge)

                            <div class="col-12 mb-3">
                                <div class="card badge {{ $badge->desbloqueada == true ? 'unlocked' : '' }} rounded-10 text-decoration-none border-0">
                                    <div class="card-img-auto" style="background-image: url('{{ env('APP_LOCAL') . '/uploads/badges/' .  $badge->icone }}');">
                                    </div>
                                    <div class="py-3 px-4 h-100 text-left text-secondary" style="font-size: 18px;flex: 1;">
                                        <span class="d-block mb-2">
                                            {{ ucfirst($badge->titulo) }}
                                        </span>
                                        <span class="d-block font-weight-normal small" style="color: #60748A;">
                                            {{ ucfirst($badge->descricao) }}
                                        </span>
                                    </div>
                                    <div class="py-2 px-1" style="color: #C3C4D9;font-size: 14px;text-align: right;">
                                        @if($badge->desbloqueada)
                                            <div class="rounded px-4 py-2 bg-primary text-dark font-weight-bold">
                                                Completa
                                            </div>
                                        @else
                                            <div class="rounded px-4 py-2 font-weight-normal" style="background-color: #989AC1; color: #434763;">
                                                Bloqueada
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        @endforeach
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
