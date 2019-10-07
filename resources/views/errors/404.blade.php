@extends('layouts.master')

@section('title', 'J. PIAGET - Página não encontrada')

@section('headend')

    @include('errors.style')

@endsection

@section('content')

    <div class="container mx-0 w-100 mw-100">

        <div class="row">

            <!-- Inicio painel central -->
            <div class="main-panel col-12 px-4 pt-3">

                <!-- Painel principal -->
                <div class="mx-2" style="position:  absolute;left:  50%;top: 50%;transform:  translate(-50%, -50%);width: 90vh;">

                    <div class="row px-5 mb-4">

                        <div class="col-12 mb-4 text-center">
                            <span class="h1 font-weight-normal">
                                <i class="fas fa-exclamation-triangle text-primary my-4 fa-3x d-block"></i>
                                <div class="d-inline-block align-middle">
                                    Ops!
                                    <h2 class="py-3">
                                        Parece que o você está procurando não existe.
                                    </h2>
                                    <div class="small text-lightgray">
                                        <small>Erro 404</small>
                                    </div>
                                </div>
                            </span>
                            <br>
                            <a href="{{ route('home') }}" class="btn btn-lg btn-outline mt-5 text-secondary py-2 px-4 font-weight-bold text-truncate">
                                <i class="fas fa-home text-muted mr-2"></i>
                                Voltar para home
                            </a>
                        </div>

                    </div>

                </div>
                <!-- Fim Painel principal -->

            </div>
        </div>

    </div>

@endsection
