@extends('layouts.master')

@section('title', 'J. PIAGET - Gestão de cursos')

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

        {{--  margin-left: -15px;  --}}
        {{--  width: calc(100% + 30px) !important;  --}}
    }

    .card-footer {
        border-radius: 0px 0px 10px 10px;
    }

    .input-group input.text-secondary::placeholder {
        color: #989EB4;
    }

</style>

@endsection

@section('content')

<main role="main">

    <div class="container">

        <div class="row" style="height: 100%; min-height: calc(100vh - 114px);">

            {{--  @include('gestao.side-menu')  --}}

            <div id="divMainMenu" class="col-12 p-0" style="width: calc(100% - 1px); flex: inherit; transition: 0.3s all ease-in-out;">

                <div class="col-12 col-md-11 mb-4 mx-auto">

                    <div class="col-12 mb-3 title pl-0">
                        <h2>Cursos</h2>
                    </div>

                    @if(count($cursos) > 0)
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-xl-6 my-auto">
                                <form action="" method="get">
                                <div class="input-group input-group">

                                        <input name="pesquisa" type="text" value="{{ Request::has('pesquisa') ? Request::get('pesquisa') : '' }}" required class="form-control py-2 width-100 shadow-sm border-0 px-3"
                                            placeholder="Procurar curso."
                                            aria-label="Recipient's username" aria-describedby="button-addon2">

                                        <div class="input-group-append">
                                            <button class="btn bg-primary border-0 text-light shadow-sm" type="submit" id="button-addon2">
                                                <i class="fas fa-search fa-lg fa-fw text-light"></i>
                                            </button>
                                        </div>
                                    </div>
                                    </form>

                            </div>

                            <div class="col-sm-12 col-md-3 col-xl-3 my-auto">
                                <a href="{{ route('gestao.novo-curso') }}" class="btn btn-block btn-primary text-truncate text-uppercase font-weight-bold mr-3 mb-2 mb-sm-0">
                                    <i class="fas fa-plus mr-2"></i>
                                    Novo curso
                                </a>
                            </div>

                            <div class="col-sm-12 col-md-3 col-xl-3 my-auto">
                                <button type="button" onclick="importarCurso()" title="Importar Curso" class="btn btn-block btn-primary text-truncate text-uppercase font-weight-bold mr-3 mb-2 mb-sm-0">
                                    <i class="fas fa-upload"></i>
                                    Importar curso
                                </button>
                            </div>

                        </div>
                    @else
                        <div class="col-sm-12 col-md-3 col-xl-3 my-auto">
                            <a href="{{ route('gestao.novo-curso') }}" class="btn btn-block btn-primary text-truncate text-uppercase font-weight-bold mr-3 mb-2 mb-sm-0">
                                <i class="fas fa-plus mr-2"></i>
                                Novo curso
                            </a>
                        </div>

                        <div class="col-sm-12 col-md-3 col-xl-3 my-auto">
                            <button type="button" onclick="importarCurso()" title="Importar Curso" class="btn btn-block btn-primary text-truncate text-uppercase font-weight-bold mr-3 mb-2 mb-sm-0">
                                <i class="fas fa-upload"></i>
                                Importar curso
                            </button>
                        </div>
                    @endif

                    <form id="formImportarCurso" action="{{ route('gestao.curso.importar') }}" method="post" enctype="multipart/form-data" class="targetImportCurso">@csrf <input type="file" id="fileImportCurso" name="fileImportCurso" style="display:none" /></form>

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

                <div class="col-12 col-md-11 mx-auto">

                    <div class="card-deck">
                        @foreach ($cursos as $curso)

                        <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4">

                            <div class="card rounded-10 shadow-sm border-0 h-100 px-0 mx-0">
                                <div class="w-100 py-5 capa-curso"
                                    style="{{ $curso->capa != '' ? 'background-image: url('. env("APP_LOCAL") .'/uploads/cursos/capas/'. $curso->capa .');' : '' }}">
                                </div>

                                <div class="card-body">
                                    <h6 class="card-title text-dark">
                                        {{ $curso->titulo }} -
                                        {{ $curso->preco > 0 ? 'R$ ' . number_format($curso->preco, 2, ',', '.') : 'Gratuito' }}
                                    </h6>

                                    <p class="small text-lightgray my-2">
                                        <i
                                            class="fas fa-circle {{ $curso->status == 0 ? 'text-lightgray' : 'text-accepted' }} mr-1"></i>
                                        {{ $curso->status_name }}
                                        •
                                        <i class="fas fa-eye{{ $curso->visibilidade == 0 ? '-slash' : '' }} mr-1"></i>
                                        {{ $curso->visibilidade == 1 ? 'Listado' : 'Não listado' }}
                                        •
                                        {{ $curso->matriculados }} Matriculado{{ $curso->matriculados != 1 ? 's' : '' }}
                                    </p>
                                    <p class="text-secondary font-weight-bold mt-2">
                                        <span
                                            class="text-truncate w-75 d-block font-weight-normal">{{ ucfirst($curso->descricao_curta) }}</span>
                                        {{-- @if(Auth::user()->id != $curso->user->id) --}}
                                        <small class="d-block text-gray pt-2">
                                            Autor: {{ ucfirst($curso->user->name) }}
                                        </small>
                                        {{-- @endif --}}
                                    </p>
                                </div>


                                <div class="card-footer bg-white">
                                    <div class="text-center">
                                        <a href="{{ route('curso', ['idCurso' => $curso->id]) }}"
                                            class="btn btn-light bg-white shadow-sm text-secondary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('gestao.curso.exportar', ['idCurso' => $curso->id]) }}"
                                            class="btn btn-light bg-white shadow-sm text-secondary">
                                            <i class="fas fa-file-export"></i>
                                        </a>
                                        <a href="{{ route('gestao.curso-conteudo', ['idCurso' => $curso->id]) }}"
                                            class="btn btn-light bg-white shadow-sm text-secondary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="#" class="btn btn-light bg-white shadow-sm text-secondary" hidden>
                                            <i class="fas fa-copy"></i>
                                        </a>
                                        <button type="button" onclick="excluirCurso({{ $curso->id }})"
                                            class="btn btn-light bg-white shadow-sm text-declined">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>

                                <form id="formExcluirCurso{{ $curso->id }}" action="{{ route('gestao.curso-excluir', ['idCurso' => $curso->id]) }}" method="post">@csrf</form>

                            </div>

                        </div>

                        @endforeach

                    </div>


                </div>





                <div class="col-12 col-md-11 mx-auto">



                    @if(count($cursos) == 0)
                    <div class="col-12 px-2 mb-4">
                        <div class="card-curso box-shadow rounded-10 p-3">
                            <h5>
                                Você ainda não criou nenhum curso.
                            </h5>
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
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/locales/bootstrap-datepicker.pt-BR.min.js">
</script>

<script>
    $('#txtDatePicker').datepicker({
        weekStart: 0,
        language: "pt-BR",
        daysOfWeekHighlighted: "0,6",
        autoclose: true,
        todayHighlight: true
    });

    $(document).ready(function () {
        @if(Auth::check())
        if (window.location.hash) {
            var hash = window.location.hash.substring(1);

            if (hash == "divulgar-revista") {
                $('#divModalNovaEdicao').modal('show');
            }
        }
        @endif
    })



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

    function importarCurso()
    {
        $('#fileImportCurso').trigger('click');
        $("#fileImportCurso").change(function() {
            $(this).parent('form').submit();
        });
    }

    function excluirCurso(id) {
        if ($("#formExcluirCurso" + id).length == 0)
            return;

        swal({
            title: 'Excluir curso?',
            text: "Você deseja mesmo excluir este curso? Todo seu conteúdo será apagado!",
            icon: "warning",
            buttons: ['Não', 'Sim, excluir!'],
            dangerMode: true,
        }).then((result) => {
            if (result == true) {
                $("#formExcluirCurso" + id).submit();
            }
        });
    }

</script>

@endsection
