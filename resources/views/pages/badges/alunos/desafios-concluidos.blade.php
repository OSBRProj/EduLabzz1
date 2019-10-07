@extends('layouts.master')

@section('title', 'J. PIAGET - Desafios concluídos')

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


    </style>

@endsection

@section('content')

    <main role="main" class="mr-auto">

        @include('pages.badges.alunos._header')

        <div class="col-12 col-md-11 mx-auto">

            <section class="mb-5">
                <div class="row">
                    <div class="col-12 mb-3">
                        <div class="bg-white shadow-sm rounded p-4">

                            {{-- @include('pages.badges.alunos._desafios_card') --}}

                            <div class="col-12">
                                <div class="d-lg-flex justify-content-center">
                                    <div class="d-lg-flex justify-content-center">
                                        <div class="text-muted">
                                            Você ainda não concluiu nenhum desafio.
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </section>


        </div>

    </main>

@endsection

@section('bodyend')

@endsection
