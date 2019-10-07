@extends('layouts.master')

@section('title', 'J. PIAGET - Gestão de escolas')

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

        .input-group input::placeholder
        {
            color: #207adc;
        }

        .form-group label
        {
            color: #213245;
            font-weight: bold;
            font-size: 18px;
        }

        main.darkmode .form-group label
        {
            color: #7E80A2;
        }

        .form-control::placeholder
        {
            color: #525870;
        }

        .form-control
        {
            color: #207adc;
            font-weight: bold;
            font-size: 16px;
            border: 0px;
            border-radius: 5px;
            box-shadow: 0px 1px 3px rgba(0,0,0,0.16);
        }

        .form-control:focus
        {
            color: #207adc;
        }

        main.darkmode .form-control
        {
            background-color: #02010C;
        }

        .form-control::placeholder
        {
            color: #B7B7B7;
        }

        .custom-select option:first-child
        {
            color: #B7B7B7;
        }

        input[type=range]::-webkit-slider-thumb
        {
            -webkit-appearance: none;
            border: 0px;
            height: 20px;
            width: 20px;
            border-radius: 50%;
            background: #525870;
            cursor: pointer;
            margin-top: 0px; /* You need to specify a margin in Chrome, but in Firefox and IE it is automatic */
        }

        input[type=range]::-webkit-slider-runnable-track
        {
            width: 100%;
            height: 36px;
            cursor: pointer;
            box-shadow: 0px 1px 3px rgba(0,0,0,0.16);
            background: #5678ef;
            border-radius: 90px;
            border: 8px solid #E3E5F0;
        }

        @media (min-width: 576px)
        {
            .side-menu
            {
                min-height: calc(100vh - 162px);
            }
        }

        .side-menu
        {
            background-color: #207adc !important;
        }

        .side-menu .list-group-item.list-group-item-action
        {
            background: transparent;
            color: #FFFFFF;
            font-weight: normal:
        }

        .side-menu .list-group-item.list-group-item-action.active
        {
            background: #2992B8;
            color: #FFFFFF;
            font-weight: bold:
        }

        .bg-postagem, .bg-card
        {
            background-color: white !important;
        }

    </style>

@endsection

@section('content')

<main role="main" class="">

<div class="container">

    <div class="row">

        <div class="col-12 col-md-11 mx-auto">

            <div class="col-12 mb-3 title pl-0">
                <h2>Gestão de escolas</h2>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3 text-center text-md-left">
                    <div class="dropdown">
                        <label for="cmbLimite" class="h6 mr-2 font-weight-bold text-lighter">Mostrar</label>
                        <button class="btn dropdown-toggle w-auto border-0 shadow-sm font-weight-normal text-lighter" type="button" id="cmbLimite" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ $amount }}
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item font-weight-bold text-lighter" href="{{ HelperClass::appendToUrl(['qt' => '10']) }}">10</a>
                            <a class="dropdown-item font-weight-bold text-lighter" href="{{ HelperClass::appendToUrl(['qt' => '15']) }}">15</a>
                            <a class="dropdown-item font-weight-bold text-lighter" href="{{ HelperClass::appendToUrl(['qt' => '20']) }}">20</a>
                            <a class="dropdown-item font-weight-bold text-lighter" href="{{ HelperClass::appendToUrl(['qt' => '35']) }}">35</a>
                        </div>
                        <label for="cmbLimite" class="h6 ml-2 font-weight-normal text-lighter">por página</label>
                    </div>
                </div>
                <div class="col-auto ml-auto mb-3 text-center text-md-left">
                    <form action="" method="get">
                        <div class="input-group rounded" style="">
                            <input type="text" maxlength="15" class="form-control font-weight-normal rounded mx-auto p-2" required name="pesquisa" aria-describedby="helpId" placeholder="Procurar">
                            <div class="input-group-append bg-transparent rounded-10 m-0">
                                <button type="submit" class="btn btn-primary font-weight-bold btn-block">
                                    <i class="fas fa-search fa-fw"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>

            <hr class="mb-4 mt-0">

            <div class="row">
                <div class="col-12 mb-3 text- text-md-left">
                    <label class="text-primary mr-2 font-weight-normal align-middle"><span id="lblSelecionados">1</span> / {{ $escolas->count() }} - {{ $escolas->total() }} no total</label>
                </div>
            </div>

            <div class="row">
                    <div class="col-12 mx-auto align-middle my-auto text-right">
                        <button type="button" data-toggle="modal" data-target="#divModalNovaEscola" class="btn btn-primary d-block shadow-sm rounded font-weight-bold">
                            <i class="fas fa-plus fa-fw mr-2"></i>
                            Cadastrar nova escola
                        </button>
                    </div>
                </div>

            <div class="container-fluid pt-4">
                <div class="row">

                    @foreach ($escolas as $escola)

                        <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 px-1 mb-3">
                            <div class="px-3 pb-3 pt-2 bg-card rounded shadow-sm">

                                <button class="btn btn-link text-gray float-right p-2" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="position: absolute;right: 0px;margin-right: 15px;">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <button type="button" onclick="editarEscola({{ $escola->id }});" class="btn btn-link dropdown-item">
                                        Editar escola
                                    </button>
                                    <button type="button" onclick="excluirEscola({{ $escola->id }});" class="btn btn-link text-danger dropdown-item">
                                        Excluir escola
                                    </button>
                                </div>

                                <h5 class="my-3"style="color: #7E80A2; margin-right: 15px;">
                                    {{ ucfirst($escola->titulo) }}

                                    <small class="d-block mt-2" style="color: #B2AC83">
                                        <strong>{{ $escola->qt_alunos }}</strong> aluno{{ $escola->qt_alunos != 1 ? 's' : '' }}
                                    </small>
                                </h5>

                                <div class="">
                                    <a href="{{ route('gestao.escola-painel', ['idEscola' => $escola->id]) }}" class="btn btn-primary mt-5 mx-2 text-uppercase small">
                                        Entrar
                                    </a>
                                    <a href="{{ route('gestao.escola.mural', ['escola_id' => $escola->id]) }}" class="btn btn-success mt-5 mx-2 text-uppercase small">
                                        Ver mural
                                    </a>
                                </div>

                            </div>
                        </div>

                    @endforeach

                    @if(count($escolas) == 0)
                        <div class="col-12 px-2 mb-3">
                            <div class="px-1 pt-1 pb-0 bg-white rounded-10 shadow-sm text-secondary">
                                <div class="px-3">
                                    <h5 class="my-3 pb-3">
                                        Você ainda não criou nenhuma escola.
                                    </h5>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </div>

            <!-- Modal Nova Escola -->
            <div class="modal fade" id="divModalNovaEscola" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
                <div class="modal-dialog modal-dialog-centered modal-md px-1 px-md-5" role="document">
                    <div class="modal-content bg-card">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>

                            <form id="formNovaEscola" method="POST" action="{{ route('gestao.escola-nova') }}" enctype="multipart/form-data" class="text-center px-3 shadow-none border-0">

                                @csrf

                                <div id="divEnviando" class="text-center d-none">
                                    <i class="fas fa-spinner fa-pulse fa-3x text-primary mb-3"></i>
                                    <h4>Enviando</h4>
                                </div>

                                <div id="divEditar" class="form-page">

                                    <div id="page1" class="form-page">

                                        <h5 class="my-4">Nova escola</h5>

                                        <label for="capa" id="divFileInputCapa" class="file-input-area input-capa mt-3 mb-5 w-100 text-center bg-primary">
                                            <input type="file" class="custom-file-input" id="capa" name="capa" style="top: 0px;height:  100%;position:  absolute;left:  0px;" accept="image/jpg, image/jpeg, image/png" oninput="mudouArquivoCapa(this);">

                                            <h6 id="placeholder" class="text-white">
                                                <i class="far fa-image fa-2x d-block text-white mb-2 w-100" style="vertical-align: sub;"></i>
                                                CAPA DA ESCOLA
                                                <small class="text-uppercase d-block text-white small mt-2 mx-auto w-50" style="font-size:  70%;">
                                                    (Arraste o arquivo para esta área ou clique para alterar)
                                                </small>
                                                <small class="text-uppercase d-block text-white small mt-2 mx-auto w-50" style="font-size:  70%;">
                                                    Opcional
                                                </small>
                                            </h6>
                                            <h5 id="file-name" class="float-left text-darkmode d-none font-weight-bold" style="margin-top: 145px;margin-left:  10px;margin-bottom:  20px;">
                                            </h5>
                                        </label>

                                        <div class="form-group mb-3 text-left">
                                            <label class="" for="txtTituloNovoConteudo">Título da escola</label>
                                            <input type="text" class="form-control" name="titulo" id="txtTituloNovoConteudo" placeholder="Clique para digitar." required>
                                        </div>

                                        <div class="form-group mb-3 text-left">
                                            <label class="" for="txtDescricaoNovoConteudo">Descrição da escola <small>(opcional)</small></label>
                                            <textarea class="form-control" name="descricao" id="txtDescricaoNovoConteudo" rows="3" placeholder="Clique para digitar."></textarea>
                                        </div>

                                        <div class="row mb-3">
                                            <button type="button" data-dismiss="modal" class="btn btn-danger mt-4 mb-0 col-4 ml-auto mr-4 font-weight-bold">Cancelar</button>
                                            <button type="submit" onclick="criarEscola();" class="btn btn-primary mt-4 mb-0 col-4 ml-4 mr-auto font-weight-bold">Criar</button>
                                        </div>

                                    </div>



                                </div>

                            </form>

                        </div>

                    </div>
                </div>
            </div>
            <!-- Fim modal nova escola -->

            <!-- Modal Editar Escola -->
            <div class="modal fade" id="divModalEditarEscola" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
                <div class="modal-dialog modal-dialog-centered modal-md px-1 px-md-5" role="document">
                    <div class="modal-content bg-card">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>

                            <form id="formEditarEscola" method="POST" action="{{ route('gestao.escola-salvar') }}" enctype="multipart/form-data" class="text-center px-3 shadow-none border-0">

                                @csrf

                                <div id="divEnviando" class="text-center d-none">
                                    <i class="fas fa-spinner fa-pulse fa-3x text-primary mb-3"></i>
                                    <h4>Enviando</h4>
                                </div>

                                <div id="divEditar" class="form-page">

                                    <div id="page1" class="form-page">

                                        <h5 class="my-3">Editar escola 1</h5>

                                        <input type="hidden" name="escola_id" value="" required>

                                        <label for="capa" id="divFileInputCapa" class="file-input-area input-capa bg-primary text-white border border-primary mt-3 mb-5 w-100 text-center" style="">
                                            <input type="file" class="custom-file-input" id="capa" name="capa" style="top: 0px;height:  100%;position:  absolute;left:  0px;" accept="image/jpg, image/jpeg, image/png" oninput="mudouArquivoCapa(this);">

                                            <h6 id="placeholder" class="">
                                                <i class="far fa-image fa-2x text-white d-block mb-2 w-100" style="vertical-align: sub;"></i>
                                                CAPA DA ESCOLA
                                                <small class="text-uppercase text-white d-block small mt-2 mx-auto w-50" style="font-size:  70%;">
                                                    (Arraste o arquivo para esta área ou clique para alterar)
                                                </small>
                                                <small class="text-uppercase text-white d-block small mt-2 mx-auto w-50" style="font-size:  70%;">
                                                    Opcional
                                                </small>
                                            </h6>
                                            <h5 id="file-name" class="float-left text-primary d-none font-weight-bold" style="margin-top: 145px;margin-left:  10px;margin-bottom:  20px;">
                                            </h5>
                                        </label>

                                        <div class="form-group mb-3 text-left">
                                            <label class="" for="titulo">Título da escola</label>
                                            <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Clique para digitar." required>
                                        </div>

                                        <div class="form-group mb-3 text-left">
                                            <label class="" for="descricao">Descrição da escola <small>(opcional)</small></label>
                                            <textarea class="form-control" name="descricao" id="descricao" rows="3" placeholder="Clique para digitar."></textarea>
                                        </div>

                                        {{-- <div class="form-group mb-3 text-left">
                                            <label class="" for="nome_completo">Nome completo da escola <small>(opcional)</small></label>
                                            <input type="text" class="form-control" name="nome_completo" id="nome_completo" placeholder="Clique para digitar.">
                                        </div>

                                        <div class="form-group mb-3 text-left">
                                            <label class="" for="cnpj">CNPJ <small>(opcional)</small></label>
                                            <input type="text" class="form-control cnpj" name="cnpj" id="cnpj" placeholder="Clique para digitar.">
                                        </div>

                                        <div class="form-group mb-3 text-left">
                                            <label class="" for="nome_responsavel">Nome do responsável <small>(opcional)</small></label>
                                            <input type="text" class="form-control" name="nome_responsavel" id="nome_responsavel" placeholder="Clique para digitar.">
                                        </div>

                                        <div class="form-group mb-3 text-left">
                                            <label class="" for="email_responsavel">E-mail do responsável <small>(opcional)</small></label>
                                            <input type="text" class="form-control" name="email_responsavel" id="email_responsavel" placeholder="Clique para digitar.">
                                        </div>

                                        <div class="form-group mb-3 text-left">
                                            <label class="" for="telefone_responsavel">Telefone do responsável <small>(opcional)</small></label>
                                            <input type="text" class="form-control telefone" name="telefone_responsavel" id="telefone_responsavel" placeholder="Clique para digitar.">
                                        </div>

                                        <div class="form-group mb-3 text-left">
                                            <label class="" for="limite_alunos">Limite de alunos <small>(opcional)</small></label>
                                            <input type="number" min="1" step="1" class="form-control" name="limite_alunos" id="limite_alunos" placeholder="Clique para digitar.">
                                        </div> --}}

                                        <div class="row">
                                            <button type="button" data-dismiss="modal" class="btn btn-danger mt-3 mb-2 col-4 ml-auto mr-4 font-weight-bold">Cancelar</button>
                                            <button type="submit" onclick="salvarEdicaoEscola();" class="btn btn-primary mt-3 mb-2 col-4 ml-4 mr-auto font-weight-bold">Salvar</button>
                                        </div>

                                    </div>



                                </div>

                            </form>

                        </div>

                    </div>
                </div>
            </div>
            <!-- Fim modal nova escola -->

            <form id="formExcluirEscola" action="{{ route('gestao.escola-excluir') }}" method="post">@csrf <input id="idEscola" name="idEscola" hidden> </form>

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
            $(".date").mask('00/00/0000');
            $('.telefone').mask('(00) 0 0000-0000');
            $('.cnpj').mask('00.000.000/0000-00', {reverse: true});
        });

        function criarEscola()
        {
            $("#formNovaEscola #divEnviando").removeClass('d-none');

            $("#formNovaEscola #divEditar").addClass('d-none');
        }

        function editarEscola(idEscola)
        {
            $("#divModalEditarEscola").modal({ keyboard: false, backdrop: 'static' });
            $("#divModalEditarEscola #divLoading").removeClass('d-none');
            $("#divModalEditarEscola #divEditar").addClass('d-none');
            $("#divModalEditarEscola #divEnviando").addClass('d-none');

            $("#divModalEditarEscola .form-page").addClass('d-none');
            $("#divModalEditarEscola #page1").removeClass('d-none');

            $.ajax({
                url: appurl + '/gestao/escola/' + idEscola + '/editar',
                type: 'get',
                dataType: 'json',
                success: function( _response )
                {
                    console.log( _response );

                    if(_response.success)
                    {
                        $("#divModalEditarEscola [name='escola_id']").val(_response.escola.id);

                        if(_response.escola.capa != "")
                        {
                            $("#divModalEditarEscola [id='divFileInputCapa']").attr('style', 'background-image: url(\'' + appurl + "/uploads/escolas/capas/" + _response.escola.capa + '\');background-size: contain;background-position: 50% 50%;background-repeat: no-repeat;');
                            $("#divModalEditarEscola [id='divFileInputCapa'] #placeholder").addClass('d-none');
                            $("#divModalEditarEscola [id='divFileInputCapa'] #file-name").removeClass('d-none');
                            $("#divModalEditarEscola [id='divFileInputCapa'] #file-name").text("Clique para alterar a foto de capa");
                        }
                        else
                        {
                            $("#divModalEditarEscola [id='divFileInputCapa']").attr('style', 'background-image: none;');
                            $("#divModalEditarEscola [id='divFileInputCapa'] #placeholder").removeClass('d-none');
                            $("#divModalEditarEscola [id='divFileInputCapa'] #file-name").addClass('d-none');
                        }

                        $("#divModalEditarEscola [name='titulo']").val(_response.escola.titulo);
                        $("#divModalEditarEscola [name='descricao']").val(_response.escola.descricao);
                        $("#divModalEditarEscola [name='limite_alunos']").val(_response.escola.limite_alunos);
                        $("#divModalEditarEscola [name='nome_completo']").val(_response.escola.nome_completo);
                        $("#divModalEditarEscola [name='cnpj']").val(_response.escola.cnpj);
                        $("#divModalEditarEscola [name='nome_responsavel']").val(_response.escola.nome_responsavel);
                        $("#divModalEditarEscola [name='email_responsavel']").val(_response.escola.email_responsavel);
                        $("#divModalEditarEscola [name='telefone_responsavel']").val(_response.escola.telefone_responsavel);

                        $("#divModalEditarEscola #divLoading").addClass('d-none');
                        $("#divModalEditarEscola #divEditar").removeClass('d-none');
                    }
                    else
                    {
                        swal("Ops!", _response.error, "error");

                        $("#divModalEditarEscola").modal({ keyboard: false, backdrop: 'static' });
                    }
                },
                error: function( _response )
                {
                    console.log( _response );
                }
            });
        }

        function salvarEdicaoEscola()
        {
            var isValid = true;

            $('#divModalEditarEscola input').each(function() {
                if ( $(this).val() === '' && $(this).attr('required') )
                {
                    $(this).focus();

                    isValid = false;
                }
            });

            if(!isValid || $("#divModalEditarEscola textarea").html() == '')
                return;

            $("#formEditarEscola").submit();

            $("#divModalEditarEscola #divLoading").addClass('d-none');
            $("#divModalEditarEscola #divEditar").addClass('d-none');
            $("#divModalEditarEscola #divEnviando").removeClass('d-none');

            $("#divModalEditarEscola #divLoading").addClass('d-none');
            $("#divModalEditarEscola #divEditar").addClass('d-none');
            $("#divModalEditarEscola #divEnviando").removeClass('d-none');
        }

        function excluirEscola(id)
        {
            $("#formExcluirEscola #idEscola").val(id);

            swal({
                title: 'Excluir escola?',
                text: "Você deseja mesmo excluir esta escola? Todos seus alunos, conteúdos e aplicações serão excluídos também!",
                icon: "warning",
                buttons: ['Não', 'Sim, excluir!'],
                dangerMode: true,
            }).then((result) => {
                if (result == true)
                {
                  $("#formExcluirEscola").submit();
                }
            });
        }

    </script>

@endsection
