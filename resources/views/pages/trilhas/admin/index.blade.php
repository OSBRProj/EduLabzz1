
@extends('layouts.master')

@section('title', 'J. PIAGET - Gestão de trilhas')

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

        .capa-curso {
            min-height: 160px;
            border-radius: 10px 10px 0px 0px;
            background-image: url('{{ env('APP_LOCAL') }}/images/default-cover.jpg');
            background-size: cover;
            background-position: 50% 50%;
            background-repeat: no-repeat;
        }

        .input-group input.text-secondary::placeholder {
            color: #989EB4;
        }

    </style>

@endsection

@section('content')

    <main role="main">

        <div class="container">

            <div class="row">

                <div id="divMainMenu" class="col-12 p-0" style="width: calc(100% - 1px); flex: inherit; transition: 0.3s all ease-in-out;">

                    <div class="col-12 col-md-11 mb-4 mx-auto">

                        <div class="col-12 mb-3 title pl-0">
                            <h2>Trilhas</h2>
                        </div>

                        @if(count($trilhas) > 0)
                            <div class="row">
                                <div class="col-sm-12 col-md-8 col-xl-9 my-auto">
                                    <form action="" method="get">
                                    <div class="input-group input-group">

                                            <input name="pesquisa" type="text" value="{{ Request::has('pesquisa') ? Request::get('pesquisa') : '' }}" required class="form-control py-2 width-100 shadow-sm border-0 px-3"
                                                placeholder="Procurar trilha."
                                                aria-label="Recipient's username" aria-describedby="button-addon2">

                                            <div class="input-group-append">
                                                <button class="btn bg-primary border-0 text-light shadow-sm" type="submit" id="button-addon2">
                                                    <i class="fas fa-search fa-lg fa-fw text-light"></i>
                                                </button>
                                            </div>
                                        </div>
                                        </form>

                                </div>

                                <div class="col-sm-12 col-md-4 col-xl-3">
                                    <a href="{{ route('gestao.trilhas.create') }}" class="btn btn-block btn-primary text-truncate text-uppercase d-flex align-items-center justify-content-center font-weight-bold mr-3 mb-2 mb-sm-0 h-100">
                                        <i class="fas fa-plus mr-2"></i>
                                        Nova trilha
                                    </a>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('gestao.trilhas.create') }}" class="btn btn-primary text-truncate text-uppercase font-weight-bold mr-3 mb-2 mb-sm-0">
                                <i class="fas fa-plus mr-2"></i>
                                Nova trilha
                            </a>
                        @endif

                        @if(Request::has('pesquisa'))
                            <div class="col-sm-12 col-md-6 text-center text-md-left mb-md-0 my-3">
                                <h5 class="my-2">
                                    <span class="font-weight-bold text-bluegray align-middle">Buscando por:</span>
                                    <span class="font-weight-bold text-bluegray align-middle" style="background-color: #207adc;color:  white;border-radius:  25px;padding:  8px 30px;margin:  0px 10px;">
                                        "{{ ucfirst(Request::get('pesquisa')) }}"
                                        <a href="{{ url()->current() }}" class="text-white ml-2">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    </span>
                                </h5>
                            </div>
                        @endif

                    </div>


                    <div class="col-12 col-md-11 mb-4 mx-auto">

                        <div class="row">

                            @foreach ($trilhas as $trilha)

                                <div class="col-12 col-sm-6 col-md-4 col-lg-4 mb-4">
                                    <div class="card-curso shadow-sm bg-white rounded-10 pb-3 h-100">
                                        <div class="w-100 py-5 capa-curso "
                                            style="{{ $trilha->capa != '' ? 'background-image: url('. env("APP_LOCAL") .'/uploads/trilhas/capas/'. $trilha->capa .');' : '' }}">
                                        </div>

                                        <div class="px-3 py-1">

                                            <p class="text-secondary font-weight-bold mt-2">
                                                {{ $trilha->titulo }}
                                                <small class="d-block text-gray">
                                                    Autor: {{ ucfirst($trilha->user->name) }}
                                                </small>
                                            </p>
                                            <div class="text-center">
                                                <a href="{{ route('gestao.trilhas.edit', ['idTrilha' => $trilha->id]) }}"
                                                class="btn btn-light bg-white shadow-sm text-secondary">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <button type="button" onclick="excluirTrilha({{ $trilha->id }})"
                                                        class="btn btn-light bg-white shadow-sm text-declined">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>

                                            <form id="formExcluirTrilha{{ $trilha->id }}"
                                                action="{{ route('gestao.trilhas.destroy', ['idTrilha' => $trilha->id]) }}"
                                                method="post">@csrf</form>
                                        </div>
                                    </div>
                                </div>

                            @endforeach

                            @if(count($trilhas) == 0)
                                <div class="w-100">
                                    <div class="card-curso shadow-sm bg-white rounded p-3">
                                        <h5>
                                            Você ainda não criou nenhuma trilha.
                                        </h5>
                                    </div>
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

    <!-- Bootstrap Datepicker JS -->
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/locales/bootstrap-datepicker.pt-BR.min.js"></script>

    <script>

        $('#txtDatePicker').datepicker({
            weekStart: 0,
            language: "pt-BR",
            daysOfWeekHighlighted: "0,6",
            autoclose: true,
            todayHighlight: true
        });


        function showListMode(mode, button) {
            if (mode == 1) {
                $('.book-item').addClass('col-lg-6');
                $('#btnListMode1').addClass("text-primary");
                $('#btnListMode2').removeClass("text-primary");
            } else {
                $('.book-item').removeClass('col-lg-6');
                $('#btnListMode2').addClass("text-primary");
                $('#btnListMode1').removeClass("text-primary");
            }
        }

        function excluirTrilha(id) {
            if ($("#formExcluirTrilha" + id).length == 0)
                return;

            swal({
                title: 'Excluir trilha?',
                text: "Você deseja mesmo excluir esta trilha? Todo seu conteúdo será apagado!",
                icon: "warning",
                buttons: ['Não', 'Sim, excluir!'],
                dangerMode: true,
            }).then((result) => {
                if (result == true) {
                    $("#formExcluirTrilha" + id).submit();
                }
            });
        }

    </script>

@endsection
