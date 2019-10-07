@extends('layouts.master')

@section('title', 'J. PIAGET - Recompensas')

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

    <main role="main">

        @include('pages.badges.alunos._header')

        <div class="container">

            <div class="row">

                <div class="col-12 col-md-11 mx-auto">

                    <div class="card-badge shadow-sm bg-white rounded border-0 p-4 text-center">
                        <p class="text-muted mb-0 mx-auto font-weight-normal">
                            Você ainda não possui nenhuma recompensa.
                        </p>
                    </div>

                    {{-- <div class="card-badge badge shadow-sm bg-white rounded text-decoration-none border-0">
                        <div class="card-img-auto"
                                style="">
                        </div>
                        <div class="py-3 px-4 h-100 text-left" style="font-size: 18px;flex: 1;">
                                    <span class="d-block mb-2 text-primary font-weight-normal">
                                        Medalha de academina de novato
                                    </span>
                            <span class="d-block font-weight-normal small" style="color: #999FB4;">
                                lorem ipsum
                            </span>
                        </div>
                        <div class="py-2 px-1" style="font-size: 14px;text-align: right;">
                            <div class="rounded px-4 py-2 font-weight-bold"
                                    style="background-color: #F5F6FB; color: #2AC869;">
                                <i class="fas fa-check-circle"></i> 500 XP
                            </div>

                        </div>
                    </div> --}}

                </div>

            </div>

        </div>

    </main>

@endsection

@section('bodyend')

@endsection
