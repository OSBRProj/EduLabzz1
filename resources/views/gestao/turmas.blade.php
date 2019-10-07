@extends('layouts.master')
@section('title', 'J. PIAGET - ' . Request::is('gestao/turmas') ? 'Gestão de turmas' : 'Minhas
turmas')
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

    .form-group label {
        color: #213245;
        font-weight: bold;
        font-size: 18px;
    }


    .form-control {
        color: #525870;
        font-weight: bold;
        font-size: 16px;
        border: 0px;
        border-radius: 5px;
        box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.16);
    }

    .form-control::placeholder {
        color: #B7B7B7;
    }

    .custom-select option:first-child {
        color: #B7B7B7;
    }

    input[type=range]::-webkit-slider-thumb {
        -webkit-appearance: none;
        border: 0px;
        height: 20px;
        width: 20px;
        border-radius: 50%;
        background: #525870;
        cursor: pointer;
        margin-top: 0px;
        /* You need to specify a margin in Chrome, but in Firefox and IE it is automatic */
    }

    input[type=range]::-webkit-slider-runnable-track {
        width: 100%;
        height: 36px;
        cursor: pointer;
        box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.16);
        background: #5678ef;
        border-radius: 90px;
        border: 8px solid #E3E5F0;
    }

    @media (min-width: 576px) {
        .side-menu {
            min-height: calc(100vh - 162px);
        }
    }
</style>
@endsection

@section('content')

<main role="main" class="{{ !Request::is('gestao/turmas') ? 'darkmode' : '' }}">

    <div class="container">



    <div class="row">


    <div class="col-12 col-md-11 mx-auto">

            @if(Request::is('gestao/turmas'))


            <div class="col-12 mb-3 title pl-0">
                <h2>Gestão de turmas</h2>
            </div>

            <div class="row">
                <div class="col ml-auto align-middle my-auto">
                    <button type="button" data-toggle="modal" data-target="#divModalNovaTurma" class="btn btn-primary shadow-sm">
                        <i class="fas fa-plus fa-fw mr-2"></i>
                        NOVA TURMA
                    </button>
                </div>
            </div>

            <!-- Modal Nova turma -->
            <div class="modal fade" id="divModalNovaTurma" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
                <div class="modal-dialog modal-dialog-centered px-1 px-md-5" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>

                            <form id="formNovaturma" method="POST" action="{{ route('gestao.nova-turma') }}" class="text-center px-3 shadow-none border-0">

                                @csrf

                                <div id="divEnviando" class="text-center d-none">
                                    <i class="fas fa-spinner fa-pulse fa-3x text-primary mb-3"></i>
                                    <h4>Enviando</h4>
                                </div>

                                <div id="divEditar" class="form-page">

                                    <div id="page1" class="form-page">

                                        <h5 class="my-4">Nova turma</h5>

                                        <div class="form-group mb-3 text-left">
                                            <label class="" for="txtTituloNovoConteudo">Título da turma</label>
                                            <input type="text" class="form-control" name="titulo" id="txtTituloNovoConteudo" placeholder="Clique para digitar." required>
                                        </div>

                                        <div class="form-group mb-3 text-left" hidden>
                                            <label class="" for="txtDescricaoNovoConteudo">Descrição da turma <small>(opcional)</small></label>
                                            <textarea class="form-control" name="descricao" id="txtDescricaoNovoConteudo" rows="3" placeholder="Clique para digitar."></textarea>
                                        </div>

                                        <div class="row">
                                            <button type="button" data-dismiss="modal" class="btn btn-danger mt-4 mb-0 col-4 ml-auto mr-4 font-weight-bold">Cancelar</button>
                                            <button type="submit" onclick="criarTurma();" class="btn btn-primary mt-4 mb-0 col-4 ml-4 mr-auto font-weight-bold">Criar</button>
                                        </div>

                                    </div>



                                </div>

                            </form>

                        </div>

                    </div>
                </div>
            </div>
            <!-- Fim modal nova turma -->

            <form id="formExcluirTurma" action="{{ route('gestao.turma-excluir') }}" method="post">@csrf <input id="idTurma" name="idTurma" hidden> </form>
            @else

            <div class="row">
                <div class="col align-middle my-auto">
                    <h4 class="font-weight-normal">Suas turmas</h4>
                </div>
            </div>

            <form id="formDeixarTurma" action="{{ route('turma-sair') }}" method="post">@csrf <input id="idTurma" name="idTurma" hidden> </form>

            @endif

            <div class="container pt-4">

                <div class="row">

                    @foreach ($turmas as $turma)

                    <div class="col-12 col-sm-12 col-md-4 col-lg-3 col-xl-3 mb-3 pl-0">
                        <div class="px-1 pt-1 pb-0 bg-white rounded shadow-sm text-secondary h-100">
                            <button class="btn btn-link text-gray float-right p-2" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                            <div class="px-3">
                                <h5 class="my-3">
                                    @if(Request::is('gestao/turmas'))
                                    <div class="dropdown-menu">
                                        <button type="button" onclick="excluirTurma({{ $turma->id }});" class="btn btn-link dropdown-item" href="#">Excluir turma</button>
                                    </div>
                                    @else
                                    <div class="dropdown-menu">
                                        <button type="button" onclick="deixarTurma({{ $turma->id }});" class="btn btn-link dropdown-item" href="#">Sair da turma</button>
                                    </div>
                                    @endif {{ ucfirst($turma->titulo) }}

                                    <small class="d-block mt-2">
                                            <strong> Prof.: </strong>{{ ucfirst($turma->professor->name) }}
                                            <i class="fas fa-check-circle fa-fw fa-sm ml-1" style="color: #798AC4;"></i>
                                        </small>

                                    <small class="d-block mt-2">
                                           <strong> {{ $turma->qt_alunos }}</strong> aluno{{ $turma->qt_alunos != 1 ? 's' : '' }}
                                        </small>
                                </h5>

                                <a href="{{ Request::is('gestao/turmas') ? route('gestao.turma-mural', ['idTurma' => $turma->id]) : route('turma-mural', ['idTurma' => $turma->id]) }}"
                                    class="btn-block text-center text-primary my-3 text-uppercase small font-weight-bold" style="width: 100%;f">
                                        Ir para o mural
                                    </a>
                            </div>
                        </div>
                    </div>

                    @endforeach @if(count($turmas) == 0)
                    <div class="col-12 px-2 mb-3">
                        <div class="px-1 pt-1 pb-0 bg-white rounded-10 shadow-sm text-secondary">
                            <div class="px-3">
                                <h5 class="my-3 pb-3">
                                    {{ Request::is('gestao/turmas') ? 'Você ainda não criou nenhuma turma.' : 'Você ainda não está em nenhuma turma.' }}
                                </h5>
                            </div>
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

        });

        function criarTurma()
        {
            $("#formNovaTurma #divEnviando").removeClass('d-none');

            $("#formNovaTurma #divEditar").addClass('d-none');
        }

        function excluirTurma(id)
        {
            $("#formExcluirTurma #idTurma").val(id);

            swal({
                title: 'Excluir turma?',
                text: "Você deseja mesmo excluir esta turma?",
                icon: "warning",
                buttons: ['Não', 'Sim, excluir!'],
                dangerMode: true,
            }).then((result) => {
                if (result == true)
                {
                  $("#formExcluirTurma").submit();
                }
            });
        }

        function deixarTurma(id)
        {
            $("#formDeixarTurma #idTurma").val(id);

            swal({
                title: 'Sair da turma?',
                text: "Você deseja mesmo deixar esta turma?",
                icon: "warning",
                buttons: ['Não', 'Sim, sair!'],
                dangerMode: true,
            }).then((result) => {
                if (result == true)
                {
                  $("#formDeixarTurma").submit();
                }
            });
        }
</script>
@endsection
