@extends('layouts.master')

@section('title', 'J. PIAGET - Gestão de cursos')

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

        .capa-curso
        {
            min-height: 160px;
            border-radius: 10px 10px 0px 0px;
            background-image: url('{{ env('APP_LOCAL') }}/images/default-cover.jpg');
            background-size: cover;
            background-position: 50% 50%;
            background-repeat: no-repeat;
        }

        .input-group input.text-secondary::placeholder
        {
            color: #989EB4;
        }

    </style>

@endsection

@section('content')

<main role="main">

    <div class="container">

        <div class="row" style="height: 100%; min-height: calc(100vh - 114px);">

            <div class="col-12 col-md-11 mx-auto">

                <div class="row">

                    <div class="col-12 mb-3 title pl-0">
                        <h2>Cursos para professores</h2>
                    </div>

                    <div class="col-12 px-0 mb-4">

                        @if(count($cursos) > 0)
                            <div class="row">
                                <div class="col-12 my-auto">
                                    <form action="" method="get">
                                    <div class="input-group input-group">

                                            <input name="pesquisa" type="text" value="{{ Request::has('pesquisa') ? Request::get('pesquisa') : '' }}" required class="form-control py-2 width-100 shadow-sm border-0 px-3"
                                                placeholder="Procurar cursos."
                                                aria-label="Recipient's username" aria-describedby="button-addon2">

                                            <div class="input-group-append">
                                                <button class="btn bg-primary border-0 text-light shadow-sm" type="submit" id="button-addon2">
                                                    <i class="fas fa-search fa-lg fa-fw text-light"></i>
                                                </button>
                                            </div>
                                        </div>
                                        </form>

                                </div>

                                {{-- <div class="col-sm-12 col-md-4 col-xl-3">
                                    <button type="button" onclick="showEditarCurso();" data-toggle="modal" data-target="#divModalNovaAplicacao" class="btn btn-block btn-primary text-truncate text-uppercase d-flex align-items-center justify-content-center font-weight-bold mr-3 mb-2 mb-sm-0 h-100">
                                        <i class="fas fa-plus mr-2"></i>
                                        Novo curso
                                    </button>
                                </div> --}}

                            </div>
                        @else
                            {{-- <button type="button" onclick="showEditarCurso();" data-toggle="modal" data-target="#divModalNovaAplicacao" class="btn btn-primary text-truncate text-uppercase font-weight-bold mr-3 mb-2 mb-sm-0">
                                <i class="fas fa-plus mr-2"></i>
                                Novo curso
                            </button> --}}
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

                </div>

                <div class="row">

                    @foreach ($cursos as $curso)

                        <a href="{{ route('curso', ['curso_id' => $curso->id]) }}" class="col-12 col-sm-6 col-md-6 col-lg-4 px-2 mb-4">
                            <div class="card-curso box-shadow rounded-10 pb-3 h-100 bg-white">
                                <div class="w-100 py-5 capa-curso " style="{{ $curso->capa != '' ? 'background-image: url('. env("APP_LOCAL") .'/uploads/cursos/capas/'. $curso->capa .');' : '' }}">
                                </div>

                                <div class="px-2 py-1">
                                    <p class="text-secondary font-weight-bold mt-2">
                                        {{ ucfirst($curso->titulo) }}
                                        <span class="text-truncate w-75 d-block font-weight-normal">{{ ucfirst($curso->descricao_curta) }}</span>
                                        {{-- @if(Auth::user()->id != $curso->user->id) --}}
                                            <small class="d-block text-gray">
                                                Autor: {{ ucfirst($curso->user->name) }}
                                            </small>
                                        {{-- @endif --}}
                                    </p>

                                    <form id="formExcluirCurso{{ $curso->id }}" action="{{ route('gestao.curso-excluir', ['idCurso' => $curso->id]) }}" method="post">@csrf</form>

                                </div>
                            </div>
                        </a>

                    @endforeach

                    @if(count($cursos) == 0)
                        <div id="divSemArtigos" class="col-12 mb-3">
                            Não há nenhum curso por aqui ainda.
                        </div>
                    @endif

                    @if(Request::has('pesquisa') && count($cursos) == 0)

                        <div class="col-12 col-lg-6">
                            <h4 class="my-2">
                                <span class="font-weight-bold text-bluegray align-middle">Infelizmente não encontramos resultados para sua busca.</span>
                            </h4>
                            <div class="my-3">
                                <h5 class="my-2">
                                    <span class="font-weight-normal text-bluegray align-middle">Recomendamos ajustar sua busca. Aqui estão algumas ideias:</span>
                                </h5>
                                <ul class="no-result-page--idea-list--3YX3z">
                                    <li>Verifique se todas as palavras estão com a ortografia correta.</li>
                                    <li>Tente usar termos de pesquisa diferentes.</li>
                                    <li>Tente usar termos de pesquisa mais genéricos.</li>
                                </ul>
                            </div>
                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>

</main>

@endsection

@section('bodyend')

    <!-- Bootstrap Datepicker JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/locales/bootstrap-datepicker.pt-BR.min.js"></script>

    <script>

        $('#txtDatePicker').datepicker({
            weekStart: 0,
            language: "pt-BR",
            daysOfWeekHighlighted: "0,6",
            autoclose: true,
            todayHighlight: true
        });

        $( document ).ready(function()
        {
            @if(Auth::check())
                if(window.location.hash)
                {
                    var hash = window.location.hash.substring(1);

                    if(hash == "divulgar-revista")
                    {
                        $('#divModalNovaEdicao').modal('show');
                    }
                }
            @endif
        })



        function showListMode(mode, button)
        {
            if(mode == 1)
            {
                $('.book-item').addClass('col-lg-6');
                $('#btnListMode1').addClass("text-primary");
                $('#btnListMode2').removeClass("text-primary");
            }
            else
            {
                $('.book-item').removeClass('col-lg-6');
                $('#btnListMode2').addClass("text-primary");
                $('#btnListMode1').removeClass("text-primary");
            }
        }

        function excluirCurso(id)
        {
            if($("#formExcluirCurso" + id).length == 0)
                return;

            swal({
                title: 'Excluir curso?',
                text: "Você deseja mesmo excluir este curso? Todo seu conteúdo será apagado!",
                icon: "warning",
                buttons: ['Não', 'Sim, excluir!'],
                dangerMode: true,
            }).then((result) => {
                if (result == true)
                {
                  $("#formExcluirCurso" + id).submit();
                }
            });
        }

    </script>

@endsection
