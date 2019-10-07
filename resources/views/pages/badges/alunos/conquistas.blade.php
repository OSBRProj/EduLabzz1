@extends('layouts.master')

@section('title', 'J. PIAGET - Conquistas')

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

        .card-badge {
            background-color: #FFFFFF;
            display: flex;
            flex-direction: row;
            padding: 6px;
            align-items: center;
        }

        .card-badge.badge .card-img-auto {
            width: 70px;
            height: 70px;
            background-size: cover;
            background-position: 50% 50%;
            background-repeat: no-repeat;
            margin: 10px;
            border-radius: 10px;
            background-color: #13141D;
            border: 1px solid #989AC1;
        }

        .card-badge.badge.unlocked .card-img-auto {
            background-color: #207adc;
        }

    </style>

@endsection

@section('content')

    <main role="main" class="mr-auto">

        @include('pages.badges.alunos._header')

        <div class="col-12 col-md-11 mx-auto">

            <section class="mb-5">
                <div class="row">
                    @foreach ($badges as $badge)
                        <div class="col-12 mb-3">
                            <div
                                class="card-badge badge shadow-sm bg-white {{ $badge->desbloqueada == true ? 'unlocked' : '' }} rounded-10 text-decoration-none border-0">
                                <div class="card-img-auto"
                                     style="background-image: url('{{ env('APP_LOCAL') . '/uploads/badges/capas/' .  $badge->icone }}');">
                                </div>
                                <div class="py-3 px-4 h-100 text-left" style="font-size: 18px;flex: 1;">
                                        <span class="d-block mb-2 text-primary font-weight-normal">
                                            {{ ucfirst($badge->titulo) }}
                                        </span>
                                    <span class="d-block font-weight-normal small" style="color: #60748A;">
                                            {{ ucfirst($badge->descricao) }}
                                        </span>
                                </div>
                                <div class="py-2 px-1" style="font-size: 14px;text-align: right;">
                                    @if($badge->desbloqueada)
                                        <div class="rounded px-4 py-2 font-weight-bold"
                                             style="background-color: #F5F6FB; color: #2AC869;">
                                            <i class="fas fa-check-circle"></i> Completa
                                        </div>
                                    @else
                                        <div class="rounded px-4 py-2 font-weight-normal"
                                             style="background-color: #E3E5F0; color: #999FB4;">
                                            Bloqueada
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                    @endforeach
                </div>
            </section>


        </div>

    </main>

@endsection

@section('bodyend')

@endsection
