@extends('layouts.master')

@section('title', 'J. PIAGET - Gestão de aplicações')

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
            display: flex;
            flex-direction: row;
            padding: 6px;
            border-radius: 5px;
            box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.16);
            background-color: #FFFFFF;
        }

        body.dark-mode .card
        {
            background-color: #1F212E;
        }

    </style>

@endsection

@section('content')

<main role="main" class="">

    <div class="container">



<div class="">

    <div class="col-12 col-md-11 mx-auto">

        <div class="row">

            <div class="col-12 mb-3 title pl-0">
                <h2>Aplicações</h2>
            </div>

            <div class="col-12 px-0 mb-4">

                @if(count($aplicacoes) > 0)
                    <div class="row">
                        <div class="col-sm-12 col-md-8 col-xl-9 my-auto">
                            <form action="" method="get">
                            <div class="input-group input-group">

                                    <input name="pesquisa" type="text" value="{{ Request::has('pesquisa') ? Request::get('pesquisa') : '' }}" required class="form-control py-2 width-100 shadow-sm border-0 px-3"
                                        placeholder="Procurar aplicação."
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
                            <button type="button" onclick="showEditarCurso();" data-toggle="modal" data-target="#divModalNovaAplicacao" class="btn btn-block btn-primary text-truncate text-uppercase d-flex align-items-center justify-content-center font-weight-bold mr-3 mb-2 mb-sm-0 h-100">
                                <i class="fas fa-plus mr-2"></i>
                                Nova aplicação
                            </button>
                        </div>

                    </div>
                @else
                    <button type="button" onclick="showEditarCurso();" data-toggle="modal" data-target="#divModalNovaAplicacao" class="btn btn-primary text-truncate text-uppercase font-weight-bold mr-3 mb-2 mb-sm-0">
                        <i class="fas fa-plus mr-2"></i>
                        Nova aplicação
                    </button>
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

        <div class="col-12 mx-0 px-0 mb-3">

            <div class="container-fluid px-0">

                <div class="row mx-0 w-100">

                    @foreach ($aplicacoes as $aplicacao)

                        <div id="divAplicacao{{ $aplicacao->id }}" class="col-sm-12 col-md-6 col-xl-4 mb-4">
                            <div class="card rounded shadow-sm text-decoration-none h-100 border-0">

                                <div class="card-img-auto h-100 rounded-0" style="flex:1;background-image: url('{{ $aplicacao->capa != "" ?  (env('APP_LOCAL') . '/uploads/aplicacoes/capas/' .  $aplicacao->capa) : '' }}');background-size: cover;background-position: 50% 50%;background-repeat: no-repeat;min-height: 165px;">
                                </div>

                                <div class="py-3 px-4 h-100" style="flex: 1;">
                                    <h5 class="d-block mb-3">
                                        {{ ucfirst($aplicacao->titulo) }}
                                    </h5>
                                    <span class="d-block mb-1">
                                        <i class="fas fa-gamepad mr-1"></i>
                                        Jogo
                                    </span>
                                    <span class="d-block mb-1">
                                        <i class="fas fa-{{ $aplicacao->status == 0 ? 'times' : 'check' }} mr-1 text-{{ $aplicacao->status == 0 ? 'danger' : 'success' }}"></i>
                                        {{ $aplicacao->status == 0 ? 'Não publicado' : 'Publicado' }}
                                    </span>
                                    @if($aplicacao->status == 1)
                                        <span class="d-block mb-1">
                                            <i class="fas fa-lock{{ $aplicacao->liberada == 0 ? '' : '-open' }} mr-1 text-{{ $aplicacao->liberada == 0 ? 'danger' : 'success' }}"></i>
                                            {{ $aplicacao->liberada == 0 ? 'Bloqueada' : 'Liberada' }}
                                        </span>
                                    @endif
                                    @if($aplicacao->data_lancamento != null)
                                        <span class="d-block font-weight-bold">
                                            <i class="fas fa-calendar fa-fw mr-1"></i>
                                            {{ $aplicacao->data_lancamento->format('d/m/Y H:i') }}
                                        </span>
                                    @endif
                                </div>

                                <button class="btn btn-link text-gray float-right p-2" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="position: absolute;right: 0px;margin-right: 15px;">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a target="_blank" href="{{ route('hub.aplicacao', ['idAplicacao' => $aplicacao->id]) }}" class="btn btn-link dropdown-item">
                                        Abrir aplicação
                                    </a>
                                    <button type="button" onclick="editarAplicacao({{ $aplicacao->id }})" class="btn btn-link dropdown-item">
                                        Editar aplicação
                                    </button>
                                    <button type="button" onclick="excluirAplicacao({{ $aplicacao->id }});" class="btn btn-link text-danger dropdown-item">
                                        Excluir aplicação
                                    </button>
                                </div>

                                <div hidden class="py-2 px-1" style="color: #C3C4D9;font-size: 16px;text-align: right;align-self: flex-end;">
                                    <button type="button" onclick="editarAplicacao({{ $aplicacao->id }})" class="btn btn-outline text-uppercase text-primary font-weight-bold">
                                        Editar
                                    </button>
                                </div>
                            </div>
                        </div>

                    @endforeach

                </div>

            </div>

        </div>

        <!-- Modal Nova Aplicacao -->
        <div class="modal fade" id="divModalNovaAplicacao" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog modal-dialog-centered modal-md px-1 px-md-5" role="document">
                <div class="modal-content bg-card">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                        <form id="formNovaAplicacao" method="POST" action="{{ route('gestao.aplicacao-nova') }}" enctype="multipart/form-data" class="text-center px-3 shadow-none border-0">

                            @csrf

                            <div id="divEnviando" class="text-center d-none">
                                <i class="fas fa-spinner fa-pulse fa-3x text-primary mb-3"></i>
                                <h4>Enviando</h4>
                            </div>

                            <div id="divEditar" class="form-page">

                                <div id="page1" class="form-page">

                                    <h5 class="my-4">Nova aplicação</h5>

                                    <label for="capa" id="divFileInputCapa" class="file-input-area input-capa text-primary border border-primary mt-3 mb-5 w-100 text-center" style="">
                                        <input type="file" class="custom-file-input" id="capa" name="capa" style="top: 0px;height:  100%;position:  absolute;left:  0px;" accept="image/jpg, image/jpeg, image/png" oninput="mudouArquivoCapa(this);">

                                        <h6 id="placeholder" class="">
                                            <i class="far fa-image fa-2x text-primary d-block mb-2 w-100" style="vertical-align: sub;"></i>
                                            CAPA DA APLICAÇÃO
                                            <small class="text-uppercase text-primary d-block small mt-2 mx-auto w-50" style="font-size:  70%;">
                                                (Arraste o arquivo para esta área ou clique para alterar)
                                            </small>
                                            <small class="text-uppercase text-primary d-block small mt-2 mx-auto w-50" style="font-size:  70%;">
                                                Opcional
                                            </small>
                                        </h6>
                                        <h5 id="file-name" class="float-left text-primary d-none font-weight-bold" style="margin-top: 145px;margin-left:  10px;margin-bottom:  20px;">
                                        </h5>
                                    </label>

                                    <div class="form-group mb-3 text-left">
                                        <label class="font-weight-bold" for="txtTituloNovoConteudo">Título da aplicação</label>
                                        <input type="text" class="form-control" name="titulo" id="txtTituloNovaAplicacao" placeholder="Clique para digitar." required>
                                    </div>

                                    <div class="form-group mb-3 text-left">
                                        <label class="font-weight-bold" for="txtDescricaoNovoConteudo">Descrição da aplicação <small>(opcional)</small></label>
                                        <textarea class="form-control" name="descricao" id="txtDescricaoNovaAplicacao" rows="3" placeholder="Clique para digitar."></textarea>
                                    </div>

                                    <div class="form-group mb-3 text-left">
                                        <label class="font-weight-bold" for="txtMarcadoresNovaAplicacao">Marcadores da aplicação <small>(opcional, separe utilizando ponto e virugla ";")</small></label>
                                        <textarea class="form-control" name="marcadores" id="txtMarcadoresNovaAplicacao" rows="3" placeholder="Clique para digitar."></textarea>
                                    </div>

                                    <div class="form-group mb-3 text-left">
                                        <label class="font-weight-bold" for="cmbCategoriaNovaAplicacao">Categoria da aplicação</label>
                                        <select id="cmbCategoriaNovaAplicacao" name="categoria" required class="custom-select rounded">
                                            <option selected value="1">Selecione uma categoria</option>
                                            <option value="1">Geral</option>
                                            @foreach ($categorias as $categoria)
                                                <option value="{{ $categoria->id }}">{{ ucfirst($categoria->titulo) }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group mb-3 text-left">
                                        <label class="font-weight-bold" for="nivel_ensino">Nível de ensino</label>
                                        <select id="nivel_ensino" name="nivel_ensino" required class="custom-select rounded">
                                            <option value="">Selecione um nível de ensino</option>
                                            <option>Educação Infantil</option>
                                            <option>Fundamental</option>
                                            <option>Ensino Médio</option>
                                        </select>
                                    </div>

                                    <div class="form-group mb-3 text-left">
                                        <label class="font-weight-bold" for="ano_serie">Ano / Série</label>
                                        <select id="ano_serie" name="ano_serie" required class="custom-select rounded">
                                            <option value="">Selecione um nível de ensino</option>
                                            <option>Maternal I</option>
                                            <option>Maternal II</option>
                                            <option>Nível I</option>
                                            <option>Nível II</option>
                                            <option>1º Ano</option>
                                            <option>2º Ano</option>
                                            <option>3º Ano</option>
                                            <option>4º Ano</option>
                                            <option>5º Ano</option>
                                            <option>6º Ano</option>
                                            <option>7º Ano</option>
                                            <option>8º Ano</option>
                                            <option>9º Ano</option>
                                        </select>
                                    </div>

                                    <button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#divModalInstrucoesAplicacao">
                                        Instruções para envio de aplicação
                                    </button>

                                    <label for="file" class="custom-file-area btn btn-outline border-thin text-primary bg-transparent d-block py-2 mt-4 mb-3 text-center text-truncate" style="">
                                        <input type="file" class="custom-file-input" id="arquivo" required name="arquivo" accept="application/zip" oninput="enviouArquivo(this);">
                                        <h6 class="m-0 text-truncate" id="placeholder">
                                            <i class="fas fa-plus fa-fw mr-2"></i>
                                            CLIQUE PARA ANEXAR A APLICAÇÃO
                                        </h6>
                                        <h6 class="m-0 file-name text-truncate d-none">
                                            nome-do-arquivo.zip
                                        </h6>
                                    </label>

                                    <div class="form-group mb-3 text-left">
                                        <label class="font-weight-bold" for="cmbStatusNovaAplicacao">Status da aplicação</label>
                                        <select id="cmbStatusNovaAplicacao" name="status" required class="custom-select rounded">
                                            <option selected value="0">Selecione uma status</option>
                                            <option value="0">Não publicado</option>
                                            <option value="1">Publicado</option>
                                        </select>
                                    </div>

                                    <div class="custom-control custom-checkbox mb-3 text-left">
                                        <input type="checkbox" class="custom-control-input" name="destaque" id="ckbDestaqueNovaAplicacao">
                                        <label class="custom-control-label font-weight-bold" for="ckbDestaqueNovaAplicacao">Destacar aplicação</label>
                                    </div>

                                    <div class="form-group mb-3 text-left">
                                        <label class="font-weight-bold" for="txtDataLancamentoNovaAplicacao">Data para lançamento <small>(Opcional)</small></label>
                                        <input type="datetime-local" class="form-control" name="data_lancamento" step="300" id="txtDataLancamentoNovaAplicacao" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}">
                                    </div>

                                    <div class="form-group mb-3 text-left" hidden>
                                        <label class="" for="cmbLiberadaNovaAplicacao">Acesso da aplicação</label>
                                        <select id="cmbLiberadaNovaAplicacao" name="liberada" required class="custom-select font-weight-bold border-0 rounded">
                                            <option selected value="1">Selecione o acesso</option>
                                            <option value="0">Acesso mediante permissão</option>
                                            <option value="1">Acesso liberado à todos</option>
                                        </select>
                                    </div>

                                    <div class="row">
                                        <button type="button" data-dismiss="modal" class="btn btn-danger mt-4 mb-0 col-4 ml-auto mr-4 font-weight-bold">Cancelar</button>
                                        <button type="button" onclick="criarAplicacao();" class="btn btn-primary btn-block mt-4 mb-0 col-4 ml-4 mr-auto font-weight-bold">Criar</button>
                                    </div>

                                </div>



                            </div>

                        </form>

                    </div>

                </div>
            </div>
        </div>
        <!-- Fim modal nova aplicação -->

        <!-- Modal Instruçoes aplicação -->
        <div class="modal fade" id="divModalInstrucoesAplicacao" tabindex="-1" role="dialog" aria-labelledby="divModalInstrucoesAplicacao" aria-hidden="true" style="z-index: 99999999; background: #000000c4;">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <button type="button" class="close ml-auto mr-2" onclick="$('#divModalInstrucoesAplicacao').modal('hide');">
                        <span aria-hidden="true">&times;</span>
                    </button>

                    <div class="modal-body border-0">
                        <h5 class="modal-title text-center mb-4">
                            Instruções para enviar aplicação
                        </h5>
                        <p class="text-justify">
                            Para enviar uma nova aplicação à plataforma você deve exportar a aplicação desenvolvida em cocos2D para Web.
                            <br>
                            Você deve anexar um .zip dos arquivos que estão dentro da pasta de build.
                        </p>
                        <p class="text-justify">
                            Dentro do zip deve conter 2 pastas, 1 pasta chamada "padroes" e a outra "jogo", a pasta "padroes" é onde ficam os arquivos de framework do Cocos2D, e a pasta jogo deverá ter seu conteúdo parecido com a seguinte imagem:
                        </p>
                        <img class="mb-2" src="{{ env('APP_LOCAL') }}/images/instrucao-1.jpg" width="100%" height="auto" alt="" style="max-width: 100px;">
                        <p class="text-justify">
                            As variavéis "id", "padroesPath" e "engineDir" do arquivo "project.json" dentro da pasta jogo deverá ter seu conteúdo como da imagem a seguir:
                        </p>
                        <img class="mb-2" src="{{ env('APP_LOCAL') }}/images/instrucao-2.jpg" width="100%" height="auto" alt="" style="max-width: 420px;">
                        <p class="text-justify">
                            O arquivo "paths.json" dentro da pasta jogo deverá ter seu conteúdo como da imagem a seguir:
                        </p>
                        <img class="mb-2" src="{{ env('APP_LOCAL') }}/images/instrucao-3.jpg" width="100%" height="auto" alt="" style="max-width: 230px;">
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" onclick="$('#divModalInstrucoesAplicacao').modal('hide');" class="btn btn-primary">
                            Entendi
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fim modal Instruçoes aplicação -->

        <!-- Modal Editar Aplicacao -->
        <div class="modal fade" id="divModalEditarAplicacao" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog modal-dialog-centered modal-md px-1 px-md-5" role="document">
                <div class="modal-content bg-card">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                        <form id="formEditarAplicacao" method="POST" action="{{ route('gestao.aplicacao-salvar') }}" enctype="multipart/form-data" class="text-center px-3 shadow-none border-0">

                            @csrf

                            <div id="divEnviando" class="text-center d-none">
                                <i class="fas fa-spinner fa-pulse fa-3x text-primary mb-3"></i>
                                <h4>Enviando</h4>
                            </div>

                            <div id="divEditar" class="form-page">

                                <div id="page1" class="form-page">

                                    <h5 class="my-4">Editar aplicação</h5>

                                    <input type="hidden" name="idAplicacao" value="">

                                    <label for="capa" id="divFileInputCapa" class="file-input-area input-capa text-primary border border-primary mt-3 mb-5 w-100 text-center" style="">
                                        <input type="file" class="custom-file-input" id="capa" name="capa" style="top: 0px;height:  100%;position:  absolute;left:  0px;" accept="image/jpg, image/jpeg, image/png" oninput="mudouArquivoCapa(this);">

                                        <h6 id="placeholder" class="">
                                            <i class="far fa-image fa-2x text-primary d-block mb-2 w-100" style="vertical-align: sub;"></i>
                                            CAPA DA APLICAÇÃO
                                            <small class="d-block small mt-2 mx-auto w-50" style="font-size:  70%;">
                                                (Arraste o arquivo para esta área ou clique para alterar)
                                            </small>
                                            <small class="text-uppercase text-primary d-block small mt-2 mx-auto w-50" style="font-size:  70%;">
                                                Opcional
                                            </small>
                                        </h6>
                                        <h5 id="file-name" class="float-left text-primary d-none font-weight-bold" style="margin-top: 145px;margin-left:  10px;margin-bottom:  20px;">
                                        </h5>
                                    </label>

                                    <div class="form-group mb-3 text-left">
                                        <label class="font-weight-bold" for="txtTituloEditarAplicacao">Título da aplicação</label>
                                        <input type="text" class="form-control" name="titulo" id="txtTituloEditarAplicacao" placeholder="Clique para digitar." required>
                                    </div>

                                    <div class="form-group mb-3 text-left">
                                        <label class="font-weight-bold" for="txtDescricaoEditarAplicacao">Descrição da aplicação <small>(opcional)</small></label>
                                        <textarea class="form-control" name="descricao" id="txtDescricaoEditarAplicacao" rows="3" placeholder="Clique para digitar."></textarea>
                                    </div>

                                    <div class="form-group mb-3 text-left">
                                        <label class="font-weight-bold" for="txtMarcadoresEditarAplicacao">Marcadores da aplicação <small>(opcional, separe utilizando ponto e virugla ";")</small></label>
                                        <textarea class="form-control" name="marcadores" id="txtMarcadoresEditarAplicacao" rows="3" placeholder="Clique para digitar."></textarea>
                                    </div>

                                    <div class="form-group mb-3 text-left">
                                        <label class="font-weight-bold" for="cmbCategoriaEditarAplicacao">Categoria da aplicação</label>
                                        <select id="cmbCategoriaEditarAplicacao" name="categoria" required class="custom-select rounded">
                                            <option disabled>Selecione uma categoria</option>
                                            <option value="1">Geral</option>
                                            @foreach ($categorias as $categoria)
                                                <option value="{{ $categoria->id }}">{{ ucfirst($categoria->titulo) }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group mb-3 text-left">
                                        <label class="font-weight-bold" for="nivel_ensino">Nível de ensino</label>
                                        <select id="nivel_ensino" name="nivel_ensino" required class="custom-select rounded">
                                            <option value="">Selecione um nível de ensino</option>
                                            <option>Educação Infantil</option>
                                            <option>Fundamental</option>
                                            <option>Ensino Médio</option>
                                        </select>
                                    </div>

                                    <div class="form-group mb-3 text-left">
                                        <label class="font-weight-bold" for="ano_serie">Ano / Série</label>
                                        <select id="ano_serie" name="ano_serie" required class="custom-select rounded">
                                            <option value="">Selecione um nível de ensino</option>
                                            <option>Maternal I</option>
                                            <option>Maternal II</option>
                                            <option>Nível I</option>
                                            <option>Nível II</option>
                                            <option>1º Ano</option>
                                            <option>2º Ano</option>
                                            <option>3º Ano</option>
                                            <option>4º Ano</option>
                                            <option>5º Ano</option>
                                            <option>6º Ano</option>
                                            <option>7º Ano</option>
                                            <option>8º Ano</option>
                                            <option>9º Ano</option>
                                        </select>
                                    </div>

                                    <button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#divModalInstrucoesAplicacao">
                                        Instruções para envio de aplicação
                                    </button>

                                    <label for="file" class="custom-file-area btn btn-outline border-thin text-primary bg-transparent d-block py-2 mt-4 mb-3 text-center text-truncate" style="">
                                        <input type="file" class="custom-file-input" id="arquivo" name="arquivo" accept="application/zip" oninput="enviouArquivo(this);">
                                        <h6 class="m-0 text-truncate" id="placeholder">
                                            <i class="fas fa-plus fa-fw mr-2"></i>
                                            CLIQUE PARA ANEXAR A APLICAÇÃO
                                        </h6>
                                        <h6 class="m-0 file-name text-truncate d-none">
                                            nome-do-arquivo.zip
                                        </h6>
                                    </label>

                                    <div class="form-group mb-3 text-left">
                                        <label class="font-weight-bold" for="cmbStatusEditarAplicacao">Status da aplicação</label>
                                        <select id="cmbStatusEditarAplicacao" name="status" required class="custom-select rounded">
                                            <option disabled>Selecione um status</option>
                                            <option value="0">Não publicado</option>
                                            <option value="1">Publicado</option>
                                        </select>
                                    </div>

                                    <div class="custom-control custom-checkbox mb-3 text-left">
                                        <input type="checkbox" class="custom-control-input" name="destaque" id="ckbDestaqueEditarAplicacao">
                                        <label class="custom-control-label" for="ckbDestaqueEditarAplicacao">Destacar aplicação</label>
                                    </div>

                                    <div class="form-group mb-3 text-left">
                                        <label class="font-weight-bold" for="txtDataLancamentoEditarAplicacao">Data para lançamento <small>(Opcional)</small></label>
                                        <input type="datetime-local" class="form-control" name="data_lancamento" step="300" id="txtDataLancamentoEditarAplicacao" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}">
                                    </div>

                                    <div class="form-group mb-3 text-left" hidden>
                                        <label class="" for="cmbLiberadaEditarAplicacao">Acesso da aplicação</label>
                                        <select id="cmbLiberadaEditarAplicacao" name="liberada" required class="custom-select rounded">
                                            <option disabled>Selecione o acesso</option>
                                            <option value="0">Acesso mediante permissão</option>
                                            <option value="1">Acesso liberado à todos</option>
                                        </select>
                                    </div>

                                    <div class="row pb-3">
                                        <button type="button" data-dismiss="modal" class="btn btn-danger mt-4 mb-0 col-4 ml-auto mr-4 font-weight-bold">Cancelar</button>
                                        <button type="button" onclick="salvarEdicaoAplicacao();" class="btn btn-primary mt-4 mb-0 col-4 ml-4 mr-auto font-weight-bold">Salvar</button>
                                    </div>

                                </div>

                            </div>

                        </form>

                    </div>

                </div>
            </div>
        </div>
        <!-- Fim modal editar aplicação -->



        </div>
        </div>



    </div>

</main>

@endsection

@section('bodyend')

    <script>

        $( document ).ready(function()
        {

        });

        function criarAplicacao()
        {
            var isValid = true;

            $('#divModalNovaAplicacao input').each(function() {
                if ( $(this).val() === '' && $(this).attr('required') )
                {
                    $(this).focus();

                    isValid = false;
                }
            });

            if(!isValid || $("#divModalNovaAplicacao textarea").html() == '')
            {
                swal('Atenção!', 'Você deve preencher todos os dados corretamente!', 'warning');
                return;
            }

            $("#formNovaAplicacao").submit();

            //$("#divModalNovaAplicacao #divLoading").addClass('d-none');
            $("#divModalNovaAplicacao #divEditar").addClass('d-none');
            $("#divModalNovaAplicacao #divEnviando").removeClass('d-none');

            //$("#divModalNovaAplicacao #divLoading").addClass('d-none');
            $("#divModalNovaAplicacao #divEditar").addClass('d-none');
            $("#divModalNovaAplicacao #divEnviando").removeClass('d-none');
        }

        function editarAplicacao(idAplicacao)
        {
            $("#divModalEditarAplicacao").modal({ keyboard: false, backdrop: 'static' });
            $("#divModalEditarAplicacao #divLoading").removeClass('d-none');
            $("#divModalEditarAplicacao #divEditar").addClass('d-none');
            $("#divModalEditarAplicacao #divEnviando").addClass('d-none');

            $("#divModalEditarAplicacao .form-page").addClass('d-none');
            $("#divModalEditarAplicacao #page1").removeClass('d-none');

            $.ajax({
                url: appurl + '/gestao/aplicacao/' + idAplicacao + '/editar',
                type: 'get',
                dataType: 'json',
                success: function( _response )
                {
                    console.log( _response );

                    if(_response.success)
                    {
                        $("#divModalEditarAplicacao [name='idAplicacao']").val(_response.aplicacao.id);

                        if(_response.aplicacao.capa != "")
                        {
                            $("#divModalEditarAplicacao [id='divFileInputCapa']").attr('style', 'background-image: url(\'' + appurl + "/uploads/aplicacoes/capas/" + _response.aplicacao.capa + '\');background-size: contain;background-position: 50% 50%;background-repeat: no-repeat;');
                            $("#divModalEditarAplicacao [id='divFileInputCapa'] #placeholder").addClass('d-none');
                            $("#divModalEditarAplicacao [id='divFileInputCapa'] #file-name").removeClass('d-none');
                            $("#divModalEditarAplicacao [id='divFileInputCapa'] #file-name").text("Clique para alterar a foto de capa");
                        }
                        else
                        {
                            $("#divModalEditarAplicacao [id='divFileInputCapa']").attr('style', 'background-image: none;');
                            $("#divModalEditarAplicacao [id='divFileInputCapa'] #placeholder").removeClass('d-none');
                            $("#divModalEditarAplicacao [id='divFileInputCapa'] #file-name").addClass('d-none');
                        }

                        $("#divModalEditarAplicacao [name='titulo']").val(_response.aplicacao.titulo);
                        $("#divModalEditarAplicacao [name='descricao']").val(_response.aplicacao.descricao);
                        $("#divModalEditarAplicacao [name='categoria']").val(_response.aplicacao.categoria_id);
                        $("#divModalEditarAplicacao [name='nivel_ensino']").val(_response.aplicacao.nivel_ensino);
                        $("#divModalEditarAplicacao [name='ano_serie']").val(_response.aplicacao.ano_serie);
                        $("#divModalEditarAplicacao [name='marcadores']").val(_response.aplicacao.tags.join(';'));
                        $("#divModalEditarAplicacao [name='status']").val(_response.aplicacao.status);
                        $("#divModalEditarAplicacao [name='liberada']").val(_response.aplicacao.liberada);
                        $("#divModalEditarAplicacao [name='destaque']").prop('checked', (_response.aplicacao.destaque == 1 ? true : false));

                        if(_response.aplicacao.data_lancamento != null)
                        {
                            $("#divModalEditarAplicacao [name='data_lancamento']").val(_response.aplicacao.data_lancamento.replace(" ", "T"));
                        }

                        $("#divModalEditarAplicacao #divLoading").addClass('d-none');
                        $("#divModalEditarAplicacao #divEditar").removeClass('d-none');
                    }
                    else
                    {
                        swal("Ops!", _response.error, "error");

                        $("#divModalEditarAplicacao").modal({ keyboard: false, backdrop: 'static' });
                    }
                },
                error: function( _response )
                {
                    console.log( _response );
                }
            });
        }

        function salvarEdicaoAplicacao()
        {
            var isValid = true;

            $('#divModalEditarAplicacao input').each(function() {
                if ( $(this).val() === '' && $(this).attr('required') )
                {
                    $(this).focus();

                    isValid = false;
                }
            });

            if(!isValid)
                return;

            $("#formEditarAplicacao").submit();

            $("#divModalEditarAplicacao #divLoading").addClass('d-none');
            $("#divModalEditarAplicacao #divEditar").addClass('d-none');
            $("#divModalEditarAplicacao #divEnviando").removeClass('d-none');

            $("#divModalEditarAplicacao #divLoading").addClass('d-none');
            $("#divModalEditarAplicacao #divEditar").addClass('d-none');
            $("#divModalEditarAplicacao #divEnviando").removeClass('d-none');
        }

        function excluirAplicacao(idAplicacao)
        {
            swal({
                title: "Excluir aplicação",
                text: "Você deseja mesmo excluir esta aplicação?",
                icon: "warning",
                buttons: ["Não", "Sim"],
                dangerMode: true,
            })
            .then((deletar) =>
            {
                if (deletar)
                {
                    $.ajax({
                        url: '{{ env('APP_LOCAL') }}' + '/gestao/aplicacao/' + idAplicacao + '/excluir',
                        type: 'post',
                        data: { '_token' : '{{ csrf_token() }}' },
                        dataType: 'json',
                        success: function( _response )
                        {
                            console.log( _response );

                            if(_response.success)
                            {
                                swal("Yeah!", _response.success, "success");

                                $( "#divAplicacao" + idAplicacao ).remove();
                            }
                            else
                            {
                                swal("Ops!", _response.error, "error");
                            }
                        },
                        error: function( _response )
                        {
                            console.log( _response );
                        }
                    });
                }
            });
        }

    </script>

@endsection
