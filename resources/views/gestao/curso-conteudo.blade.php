@extends('layouts.master')

@section('title', 'J. PIAGET - Criação de conteúdo')

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

        main
        {
            padding-bottom: 0px !important;
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

        .form-group label
        {
            color: #213245;
            font-weight: bold;
            font-size: 18px;
        }


        .form-control
        {
            color: #525870;
            font-weight: bold;
            font-size: 16px;
            border: 0px;
            border-radius: 5px;
            box-shadow: 0px 1px 2px rgba(0,0,0,0.16);
        }

        .form-control::placeholder
        {
            color: #B7B7B7;
        }

        /*.custom-select option:first-child
        {
            color: #B7B7B7;
        }*/

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
            box-shadow: 0px 1px 2px rgba(0,0,0,0.16);
            background: #5678ef;
            border-radius: 90px;
            border: 8px solid #E3E5F0;
        }

        @media (min-width: 576px)
        {
            .side-menu
            {
                min-height: calc(100vh - 265px);
            }
        }

        .tipo-conteudo
        {
            transition: 0.3s all ease-in-out;
            opacity: 0;
            background:  #E3E5F0;
            position:  absolute;
            top: -4px;
            left: 32px;
            height:  100%;
            border-radius: 100px;
            width: auto;
            z-index:  5;
            padding:  7px;
            display: flex;
            justify-content: flex-start;
            align-items: flex-start;
        }

        .tipo-conteudo div:last-child
        {
            margin-right: 0px !important;
        }

        .handle
        {
            cursor: move;
        }

        #divListaConteudos table
        {
            border-collapse: separate;
            border-spacing: 0 10px;
        }

        #divListaConteudos tr
        {
            font-size: 18px;
            background-color: #F5F5F5;
            border-radius: 10px;
            border: 0px;
        }

        #divListaConteudos tr td
        {
            border: 0px;
        }

        .note-popover.popover
        {
            display: none;
        }

        .list-group-item.active, .list-group-item-action.active
        {
            border: 0px;
            background-color: #E3E5F0 !important;
            color: #207adc;
        }

        .modal form .form-control
        {
            border: 1px solid #B7B7B7;
            border-radius: 0px;
        }
        .modal form .form-control:focus, .modal form .form-control:active/*, .summernote-holder:focus, .summernote-holder:active*/
        {
            border: 2px solid #207adc;
            border-radius: 0px;
            box-shadow: 0px 1px 2px rgba(0,0,0,0.16);
        }
        .summernote-holder
        {
            padding: .375rem .75rem;
            border-radius: 0px;
            /*border: 1px solid #B7B7B7;*/
            border: 2px solid #207adc;
            box-shadow: 0px 1px 2px rgba(0,0,0,0.16);
            font-size: initial;
            text-align: initial;
            color: initial;
        }

        /* Custom radio buttons */
        .btn-group-toggle .btn:not(:disabled):not(.disabled)
        {
            color: #525870;
            background-color: white;
            border: 0px;
            border-radius: 0px;
            margin: 0px 10px;
            box-shadow: none;
        }
        .btn-group-toggle .btn:not(:disabled):not(.disabled).active
        {
            color: #207adc;
            border-bottom: 4px solid #207adc;
        }

        .btn-ico {
            background:#f1f1f1;
            color:#999FB4;
            border-radius:50%;
            padding:6px;
            width:36px;
            height:36px;
        }

        .ball-links-menu {
            width:48px !important;
            height:40px !important;
        }

    </style>

@endsection

@section('content')

<main role="main">

    <div class="container-fluid">

        <div class="row">
            <div class="col-12 px-4 py-3 d-flex align-items-center shadow-sm" style="background-color: #FFFFFF;z-index:1;margin-top:-45px;">
                <a href="{{ route('gestao.cursos') }}" class="h5 text-primary mr-3 my-auto">
                    <i class="fas fa-chevron-left mr-2"></i>
                    <span class="font-weight-normal">Cursos</span>
                </a>

                <div class="ml-auto mt-2 mt-sm-0">

                    {{-- <button type="button" onclick="showEditarCurso();" class="btn btn-outline-primary px-4 text-uppercase font-weight-bold text-truncate mr-3 mb-2 mb-sm-0 col-12 col-sm-auto">
                        Editar curso
                        <i class="fas fa-edit"></i>
                    </button> --}}

                    @if($curso->status == 0)
                    <a href="{{ route('curso', ['idCurso' => $curso->id]) }}" class="btn btn-outline-primary px-4 text-uppercase font-weight-bold text-truncate mr-3 mb-2 mb-sm-0 col-12 col-sm-auto">
                        Preview
                        <i class="fas fa-search"></i>
                    </a>

                    <button type="button" onclick="publicarCurso();" class="btn btn-primary px-4 text-uppercase font-weight-bold text-truncate col-12 col-sm-auto">
                        Publicar curso
                        <i class="fas fa-eye fa-fw ml-1"></i>
                    </button>

                    @else
                        <a href="{{ route('curso', ['idCurso' => $curso->id]) }}" class="btn btn-outline-primary px-4 text-uppercase font-weight-bold text-truncate mr-3 mb-2 mb-sm-0 col-12 col-sm-auto">
                            Preview
                            <i class="fas fa-search"></i>
                        </a>

                        <button type="button" onclick="publicarCurso();" class="btn btn-primary px-4 text-uppercase font-weight-bold text-truncate col-12 col-sm-auto">
                            Despublicar curso
                            <i class="fas fa-eye-slash fa-fw ml-1"></i>
                        </button>
                    @endif

                    <form id="formPublicarCurso" action="{{ route('gestao.curso-publicar', ['idCurso' => $curso->id]) }}" method="post">@csrf</form>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- <div class="col-12 py-4 mx-auto px-0">

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb p-0 py-3 mb-4 bg-transparent border-bottom">
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="{{ route('gestao.cursos') }}" >
                                <i class="fas fa-chevron-left mr-2"></i>
                                <span>Cursos</span>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Gestão de cursos</li>
                    </ol>
                </nav>

            </div> -->

            <!--

            <div class="col-12 mx-auto mb-4 px-0">
                <button type="button" onclick="showEditarCurso();" class="btn btn-outline-primary px-4 text-uppercase font-weight-bold text-truncate mr-3 mb-2 mb-sm-0 col-12 col-sm-auto">
                    Editar curso
                    <i class="fas fa-edit"></i>
                </button>

                @if($curso->status == 0)
                    <a href="{{ route('curso', ['idCurso' => $curso->id]) }}" class="btn btn-outline-warning px-4 text-uppercase font-weight-bold text-truncate mr-3 mb-2 mb-sm-0 col-12 col-sm-auto">
                        Preview
                        <i class="fas fa-search"></i>
                    </a>

                    <button type="button" onclick="publicarCurso();" class="btn btn-outline-success px-4 text-uppercase font-weight-bold text-truncate col-12 col-sm-auto">
                        Publicar curso
                        <i class="fas fa-eye fa-fw ml-1"></i>
                    </button>
                @else
                    <a href="{{ route('curso', ['idCurso' => $curso->id]) }}" class="btn btn-outline-warning px-4 text-uppercase font-weight-bold text-truncate mr-3 mb-2 mb-sm-0 col-12 col-sm-auto">
                        Preview
                        <i class="fas fa-search"></i>
                    </a>

                    <button type="button" onclick="publicarCurso();" class="btn btn-outline-danger px-4 text-uppercase font-weight-bold text-truncate col-12 col-sm-auto">
                        Despublicar curso
                        <i class="fas fa-eye-slash fa-fw ml-1"></i>
                    </button>
                @endif
                <form id="formPublicarCurso" action="{{ route('gestao.curso-publicar', ['idCurso' => $curso->id]) }}" method="post">@csrf</form>
            </div> -->

        </div> <!-- menu: edição/preview/publicar -->


        <div class="col-12 pt-0 px-0 mx-auto">



        <div class="row" style="height: calc(100% - 103px);">


        <div class="side-menu col-12 col-md-3 p-3 text-center rounded shadow-sm mb-sm-3">

            <h4 class="d-flex align-items-center my-auto py-3 font-weight-bold">
                <span style="width:90%;float:left;display:block;">{{ ucfirst($curso->titulo) }}</span>
                <button type="button" onclick="showEditarCurso();" class="btn btn-link p-0 text-uppercase font-weight-bold text-truncate float-right" data-toggle="tooltip" data-placement="auto" title="Editar curso">
                    <i class="fas fa-cog fa-lg"></i>
                </button>
            </h4>
            <hr style="display:block;width:100%;float:left;">
            <h5 class="mb-4">Aulas</h5>

            <button type="button" onclick="showCriarAula();" class="btn btn-primary btn-block box-shadow text-white text-uppercase font-weight-bold py-2 text-wrap mt-3">
                <i class="fas fa-plus mr-1"></i>
                Nova aula
            </button>

            <button type="button" onclick="importarAula();" class="btn btn-primary btn-block box-shadow text-white text-uppercase font-weight-bold py-2 text-wrap mt-3 mb-4">
                <i class="fas fa-file-upload mr-1"></i>
                Importar aula
            </button>

            <div id="divAulas" class="list-group list-group-flush text-left sortable-aulas" style="max-height: 45vh; overflow-y: auto;">

                @if(count($curso->aulas) == 0)
                    <div class="list-group-item list-group-item-action bg-transparent text-center">
                        {{--  <i class="fas fa-bars fa-fw mr-2 handle"></i>  --}}
                        Você ainda não criou nenhuma aula
                    </div>
                @endif

                @foreach ($curso->aulas as $aula)
                    <a id="btnAula{{ $aula->id }}" href="javascript:void(0);" onclick="showAula({{ $aula->id }}); return false;" class="list-group-item list-group-item-action bg-transparent">
                        <i class="fas fa-bars fa-fw mr-2 handle"></i>
                        {{ ucfirst($aula->titulo) }}
                    </a>
                @endforeach

            </div>

            <hr>

            <div class="text-left">

                @if($curso->user_id != Auth::user()->id && \App\User::find($curso->user_id) != null)
                    <p>
                        <b>Criador do curso:</b>
                        {{ ucwords(\App\User::find($curso->user_id)->name) }}
                    </p>
                @endif

                <p>
                    <b>Data de criação:</b>
                    {{ $curso->created_at->format('d/m/Y \à\s H:i') }}
                </p>
                <p>
                    <b>Data de publicação: </b>
                    {{ $curso->data_publicacao != null ? (new \Carbon\Carbon($curso->data_publicacao))->format('d/m/Y \à\s H:i') : '-' }}

                </p>
                <p>
                    <b>Periodo de validade: </b>
                    {{ $curso->periodo > 0 ? ($curso->periodo == 1 ? '1 dia' : $curso->periodo . ' dias') : 'Ilimitado' }}
                </p>
                <p>
                    <b>Periodo restante: </b>
                    {{ $curso->periodo > 0 ? ($curso->periodo_restante == 1 ? '1 dia' : $curso->periodo_restante . ' dias') : 'Ilimitado' }}
                </p>
                <p>
                    <b>Data de expiração: </b>
                    {{ $curso->data_expiracao != null ? $curso->data_expiracao->format('d/m/Y') : '-' }}
                </p>
                <p>
                    <b>Status: </b>
                    {{ $curso->status == 1 ? "Publicado" : 'Não publicado' }}
                </p>
                <p>
                    <b>Visibilidade: </b>
                    {{ $curso->visibilidade == 1 ? "Visível para todos" : 'Oculto' }}
                </p>
                <p>
                    <b>Vagas totais: </b>
                    {{ $curso->vagas > 0 ? ($curso->vagas == 1 ? '1 vaga' : $curso->vagas . ' vagas') : 'Ilimitadas' }}
                </p>
                <p>
                    <b>Matriculados: </b>
                    {{ $curso->matriculados == 1 ? '1 aluno' : $curso->matriculados . ' alunos' }}
                </p>
                <p>
                    <b>Vagas restantes: </b>
                    {{ $curso->vagas > 0 ? ($curso->vagasRestantes == 1 ? '1 vaga' : $curso->vagasRestantes . ' vagas') : 'Ilimitadas' }}
                </p>
                <p>
                    <b>Preço: </b>
                    {{ $curso->preco > 0 ? ('R$ ' . number_format($curso->preco, 2, ',', '.')) : 'Gratuito' }}
                </p>
            </div>

        </div>



            <!-- Modal Editar Aula -->
            <div class="modal fade" id="divModalEditarAula" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>

                            <h4 class="text-center">Editar aula</h4>

                            <form id="formEditarAula" method="POST" action="{{ route('gestao.curso.aula-salvar', ['idCurso' => $curso->id]) }}" class="px-3 shadow-none border-0">

                                @csrf

                                <input name="idAula" required hidden>

                                <div id="divLoading" class="text-center">
                                    <i class="fas fa-spinner fa-pulse fa-3x text-primary"></i>
                                </div>

                                <div id="divEnviando" class="text-center d-none">
                                    <i class="fas fa-spinner fa-pulse fa-3x text-primary mb-3"></i>
                                    <h4>Enviando</h4>
                                </div>

                                <div id="divEditar" class="form-page d-none">

                                    <div id="page1" class="form-page">

                                        <div class="form-group mb-3">
                                            <label class="" for="txtEditarTitulo">Título da aula</label>
                                            <input type="text" class="form-control" name="titulo" id="txtEditarTitulo" placeholder="Clique para digitar." required>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="" for="txtEditarDescricao">Descrição da aula</label>
                                            <textarea class="form-control" name="descricao" id="txtEditarDescricao" rows="3" placeholder="Clique para digitar." required></textarea>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="" for="txtEditarDuracao">Duração da aula em minutos <small>(opcional)</small></label>
                                            <input type="text" class="form-control" name="duracao" id="txtEditarDuracao" placeholder="Clique para digitar.">
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="cmbRequisitoAula">Requisito para acesso <small>(opcional)</small></label>
                                            <select class="custom-select form-control" name="requisito" id="cmbRequisitoAula" onchange="mudouRequisitoAula(true);">
                                                <option value="nenhum" selected>Nenhum</option>
                                                <option value="anterior">Aula anterior</option>
                                                <option value="aula">Aula específica</option>
                                            </select>
                                        </div>

                                        <div id="divAulaEspecifica" class="form-group mb-3 d-none">
                                            <label for="cmbAulaEspecifica">Aula específica</label>
                                            <select class="custom-select form-control" name="aula_especifica" id="cmbAulaEspecifica">
                                                <option value="0" disabled selected>Seleciona uma aula</option>
                                                @foreach ($curso->aulas as $aula)
                                                    <option value="{{ $aula->id }}">{{ ucfirst($aula->titulo) }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="row">
                                            <button type="button" data-dismiss="modal" class="btn btn-lg btn-block outline-button mt-4 mb-0 col-4 ml-auto mr-4 font-weight-bold">Cancelar</button>
                                            <button type="submit" onclick="showEnviandoEditarAula();" class="btn btn-lg btn-block bg-primary mt-4 mb-0 col-4 ml-4 mr-auto text-white font-weight-bold">Salvar</button>
                                        </div>

                                    </div>



                                </div>

                            </form>

                        </div>

                    </div>
                </div>
            </div>
            <!-- Fim modal editar aula -->

            <!-- Modal Novo Conteudo -->
            @include('gestao.conteudo.modal-novo-conteudo')
            <!-- Fim modal novo conteudo -->

            <!-- Modal Editar Conteudo -->
            @include('gestao.conteudo.modal-editar-conteudo')
            <!-- Fim modal editar conteudo -->

            <div class="col-12 col-md-9 mx-auto col-lg-9">

                <div class="container-fluid h-100">

                    <div class="row h-100 d-none animated fadeIn shadow-sm rounded" id="divEditarCurso" style="background-color: #FBFBFB;">

                        <div id="divEnviando" class="w-100 text-center d-none">
                            <div style="position: absolute;left 50%;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                                <i class="fas fa-spinner fa-pulse fa-3x text-primary mb-3"></i>
                                <h4>Enviando</h4>
                            </div>
                        </div>

                        <div id="divEditar" class="w-100 d-none">

                            <form class="w-100" id="formEditarCurso" action="{{ route('gestao.curso-salvar', ['idCurso' => $curso->id]) }}" method="post" enctype="multipart/form-data">

                                @csrf

                                <div class="form-group m-0">
                                    <span class="d-block px-4 py-2" id="info-alterar-titulo">Clique para alterar o título do curso</span>
                                    <input type="text" class="px-4 py-3 form-control rounded-0 text-truncate shadow-none border-bottom" name="titulo" id="titulo" placeholder="Clique para alterar o título do curso." style="font-size:1.5rem;" required="" value="{{ $curso->titulo }}">
                                </div>

                                <div class="p-3" style="background-color: #FBFBFB;min-height: calc(100vh - 284px);">

                                    <div class="container-fluid">

                                        <div class="row">

                                            <div class="col-12 col-lg-6">

                                                    <label for="capa" id="divFileInputCapa" class="file-input-area input-capa mt-3 mb-5 w-100 text-center bg-primary" style="{{ $curso->capa != '' ? 'background-image: url('. env("APP_LOCAL") .'/uploads/cursos/capas/'. $curso->capa .');' : '' }}background-size: contain;background-position: 50% 50%;background-repeat: no-repeat;">
                                                        <input type="file" class="custom-file-input" id="capa" name="capa" style="top: 0px;height:  100%;position:  absolute;left:  0px;" accept="image/jpg, image/jpeg, image/png" oninput="mudouArquivoCapa(this);">

                                                        <h5 id="placeholder" class="text-white d-none">
                                                            <i class="far fa-image fa-2x d-block text-white mb-2 w-100" style="vertical-align: sub;"></i>
                                                            CAPA DO CURSO
                                                            <small class="text-uppercase d-block text-white small mt-2 mx-auto w-50" style="font-size:  70%;">
                                                                (Arraste o arquivo para esta área)
                                                                <br>
                                                                JPG ou PNG
                                                            </small>
                                                        </h5>
                                                        <h5 id="file-name" class="float-left text-darker font-weight-bold" style="margin-top: 145px;margin-left:  10px;margin-bottom:  20px;">
                                                        </h5>
                                                    </label>

                                                <div class="form-group mb-3">
                                                    <label class="" for="descricao_curta">Descrição curta do curso</label>
                                                    <textarea class="form-control" name="descricao_curta" id="descricao_curta" rows="3" placeholder="Clique para digitar." required="">{{ $curso->descricao_curta }}</textarea>
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label class="" for="descricao">Descrição do curso</label>
                                                    {{-- <textarea class="form-control" name="descricao" id="descricao" rows="3" placeholder="Clique para digitar." required="">{{ $curso->descricao }}</textarea> --}}
                                                    <textarea name="descricao" id="descricao" class="summernote">{{ $curso->descricao }}</textarea>
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label for="categoria">Categoria do curso</label>
                                                    <select class="custom-select form-control" name="categoria" id="categoria" required="">
                                                        <option disabled="disabled" value="">Selecione uma categoria</option>
                                                        @foreach ($categorias as $categoria)
                                                            <option value="{{ $categoria->id }}" {{ $curso->categoria == $categoria->id ? 'selected=true' : '' }}>{{ ucfirst($categoria->titulo) }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>

                                            <div class="col-12 col-lg-6">

                                                @if(Auth::user()->permissao == "G" || Auth::user()->permissao == "Z")
                                                    <div class="form-group mb-3">
                                                        <label for="tipo">Tipo de curso</label>
                                                        <select class="custom-select form-control" name="tipo" id="tipo" required>
                                                            <option disabled="disabled">Selecione um tipo</option>
                                                            <option value="1" {{ $curso->tipo == 1 ? 'selected=true' : '' }}>Curso padrão / Para alunos</option>
                                                            <option value="2" {{ $curso->tipo == 2 ? 'selected=true' : '' }}>Curso para Professores / Gestores</option>
                                                        </select>
                                                    </div>
                                                @endif

                                                <div class="form-group mb-3">
                                                    <label for="categoria">Visibilidade do curso</label>
                                                    <select class="custom-select form-control" name="visibilidade" id="visibilidade" required="" value="">
                                                        <option disabled="disabled" value="">Selecione uma visibilidade</option>
                                                        <option value="1"  {{ $curso->visibilidade == 1 ? 'selected=true' : '' }}>Público</option>
                                                        <option value="2"  {{ $curso->visibilidade == 2 ? 'selected=true' : '' }}>Oculto</option>
                                                    </select>
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label class="" for="senha">Senha do curso <small>(opcional)</small></label>
                                                    <input type="text" class="form-control" name="senha" id="senha" aria-describedby="helpId" placeholder="Clique para digitar." value="{{ $curso->senha }}">
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label class="" for="preco">Preço do curso (Opcional / mín. R$ 25,00)</label>
                                                    <input type="text" class="form-control" name="preco" id="preco" aria-describedby="helpId" placeholder="Clique para digitar." value="{{ $curso->preco }}">
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label class="" for="periodo">Período do curso (dias)</label>
                                                    <label class="float-right" id="lblPeriodo" for="periodo">{{ $curso->periodo > 0 ? $curso->periodo : "Ilimitado"  }}</label>
                                                    <input type="range" class="custom-range" min="0" max="365" value="{{ $curso->periodo }}" name="periodo" id="periodo" required="" oninput="mudouPeriodo(this);">
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label class="" for="vagas">Vagas do curso</label>
                                                    <label class="float-right" id="lblVagas" for="vagas">{{ $curso->vagas > 0 ? $curso->vagas : "Ilimitado"  }}</label>
                                                    <input type="range" class="custom-range" min="0" max="100" value="{{ $curso->vagas }}" name="vagas" id="vagas" required="" oninput="mudouVagas(this);">
                                                </div>

                                                <input id="rasunho" value="false" type="text" hidden="">

                                                <div class="container-fluid my-2">
                                                    <div class="row">
                                                        <div class="col-12 px-0">
                                                            <button type="button" onclick="salvarCurso();" class="btn btn-primary px-4">
                                                                Salvar
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </form>

                        </div>

                    </div>


                    <div class="row h-100 d-none animated fadeIn" id="divNovaAula" style="background-color: #FBFBFB;">
                        <div class="col-12 px-5 py-3">

                            <div id="divEnviando" class="w-100 text-center d-none">
                                <div style="position: absolute;left 50%;top: 50%;left:  50%;transform: translate(-50%, -50%);">
                                    <i class="fas fa-spinner fa-pulse fa-3x text-primary mb-3"></i>
                                    <h4>Enviando</h4>
                                </div>
                            </div>

                            <div id="divEditar" class="w-100 d-none">

                                <h4 class="text-center">Nova aula</h4>

                                <form id="formNovaAula" action="{{ route('gestao.curso.nova-aula', ['curso' => $curso->id]) }}" method="post">

                                    @csrf

                                    <div class="form-group mb-3">
                                        <label class="" for="txtTitulo">Título da aula</label>
                                        <input type="text" class="form-control" name="titulo" id="txtTitulo" placeholder="Clique para digitar." required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="" for="txtDescricao">Descrição da aula</label>
                                        <textarea class="form-control" name="descricao" id="txtDescricao" rows="3" placeholder="Clique para digitar." required></textarea>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="" for="txtDuracao">Duração da aula em minutos <small>(opcional)</small></label>
                                        <input type="text" class="form-control" name="duracao" id="txtDuracao" placeholder="Clique para digitar.">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="cmbRequisitoAula">Requisito para acesso <small>(opcional)</small></label>
                                        <select class="custom-select form-control" name="requisito" id="cmbRequisitoAula" onchange="mudouRequisitoAula(false);">
                                            <option value="nenhum" selected>Nenhum</option>
                                            <option value="anterior">Aula anterior</option>
                                            <option value="aula">Aula específica</option>
                                        </select>
                                    </div>

                                    <div id="divAulaEspecifica" class="form-group mb-3 d-none">
                                        <label for="cmbAulaEspecifica">Aula específica</label>
                                        <select class="custom-select form-control" name="aula_especifica" id="cmbAulaEspecifica">
                                            <option value="0" disabled selected>Seleciona uma aula</option>
                                            @foreach ($curso->aulas as $aula)
                                                <option value="{{ $aula->id }}">{{ ucfirst($aula->titulo) }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <button type="submit" onclick="showEnviandoAula();" class="btn btn-primary btn-lg">
                                        Salvar
                                    </button>


                                </form>

                            </div>

                        </div>
                    </div>

                    <div class="row animated fadeIn" id="divMainLoading" style="display:none;">
                        <div class="text-center" style="position: absolute;left 50%;top: 50%;left:  50%;transform: translate(-50%, -50%);">
                            <i class="fas fa-spinner fa-pulse fa-3x text-primary mb-3"></i>
                            <h4>Carregando</h4>
                        </div>
                    </div>

                    <div class="row pt-3 d-none" id="divConteudos">

                        <div class="col-auto p-0" style="width:110px;">

                            <div class="bg-primary py-3 px-0" style="border-radius: 85px;">

                                <div onclick="showConteudosTipo(1);" class="btn bg-transparent text-white border-0 p-1 btn-block text-uppercase text-center mb-3">
                                    <div class="position-relative">
                                        <i class="fas fa-book fa-lg fa-fw bg-blue text-white rounded-circle ball-links-menu" style=""></i>

                                        <div id="divConteudosTipo1" class="tipo-conteudo text-left d-none">
                                            <div class="d-inline-block align-top mr-3 text-uppercase font-weight-bold">
                                                <i class="fas fa-book fa-fw bg-blue text-white rounded-circle ball-links-menu-modal" style=""></i>
                                            </div>
                                            <div onclick="showNovoConteudo(1)" class="btn-ball-links-menu btn btn-dark border-0 bg-transparent d-inline-block align-top p-0 mx-2 text-uppercase font-weight-bold">
                                                <i class="fas fa-font fa-fw bg-blue rounded-circle ball-links-menu-modal" style=""></i>
                                                <p class="small font-weight-bold mt-3">Texto</p>
                                            </div>
                                            <div onclick="showNovoConteudo(2)" class="btn-ball-links-menu btn btn-dark border-0 bg-transparent d-inline-block align-top p-0 mx-2 text-uppercase font-weight-bold">
                                                <i class="fas fa-podcast fa-fw bg-blue rounded-circle ball-links-menu-modal" style=""></i>
                                                <p class="small font-weight-bold mt-3">Áudio</p>
                                            </div>
                                            <div onclick="showNovoConteudo(3)" class="btn-ball-links-menu btn btn-dark border-0 bg-transparent d-inline-block align-top p-0 mx-2 text-uppercase font-weight-bold">
                                                <i class="fas fa-video fa-fw bg-blue rounded-circle ball-links-menu-modal" style=""></i>
                                                <p class="small font-weight-bold mt-3">Vídeo</p>
                                            </div>
                                            <div onclick="showNovoConteudo(4)" class="btn-ball-links-menu btn btn-dark border-0 bg-transparent d-inline-block align-top p-0 mx-2 text-uppercase font-weight-bold">
                                                <i class="fas fa-file-powerpoint fa-fw bg-blue rounded-circle ball-links-menu-modal" style=""></i>
                                                <p class="small font-weight-bold mt-3">Slide</p>
                                            </div>
                                            <div onclick="showNovoConteudo(5)" class="btn-ball-links-menu btn btn-dark border-0 bg-transparent d-inline-block align-top p-0 mx-2 text-uppercase font-weight-bold">
                                                <i class="fas fa-broadcast-tower fa-fw bg-blue rounded-circle ball-links-menu-modal" style=""></i>
                                                <p class="small font-weight-bold mt-3">Transmissão</p>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="small font-weight-bold">Conteúdo</spann>
                                </div>

                                <div onclick="showConteudosTipo(2);" class="btn bg-transparent text-white border-0 p-1 btn-block text-uppercase text-center mb-3">
                                    <div class="position-relative">
                                        <i class="fas fa-file-archive fa-lg fa-fw bg-blue text-white rounded-circle ball-links-menu" style=""></i>
                                        <div onclick="showNovoConteudo(6)" id="divConteudosTipo2" class="tipo-conteudo text-left d-none">
                                            <div class="d-inline-block align-top mr-3 text-uppercase font-weight-bold">
                                                <i class="fas fa-file-archive fa-fw bg-blue rounded-circle ball-links-menu-modal" style=""></i>
                                                <small class="font-weight-bold text-darker mx-2">Enviar arquivo próprio  (Até 20Mb PDF, DOC, PNG, JPG)</small>
                                                <i class="fas fa-upload text-darker mx-4"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="small font-weight-bold">Arquivos</spann>
                                </div>

                                <div onclick="showConteudosTipo(3);" class="btn bg-transparent text-white border-0 p-1 btn-block text-uppercase text-center mb-3">
                                    <div class="position-relative">
                                        <i class="fas fa-gamepad fa-lg fa-fw bg-blue text-white rounded-circle ball-links-menu" style=""></i>
                                        <div id="divConteudosTipo3" class="tipo-conteudo text-left d-none">
                                            <div class="d-inline-block align-top mr-3 text-uppercase font-weight-bold">
                                                <i class="fas fa-gamepad fa-fw bg-blue rounded-circle ball-links-menu-modal" style=""></i>
                                            </div>
                                            <div onclick="showNovoConteudo(7)" class="btn-ball-links-menu btn btn-dark border-0 bg-transparent d-inline-block align-top p-0 mx-2 text-uppercase font-weight-bold">
                                                <i class="fas fa-comment-alt fa-fw bg-blue rounded-circle ball-links-menu-modal" style=""></i>
                                                <p class="small font-weight-bold mt-3">Dissertativa</p>
                                            </div>
                                            <div onclick="showNovoConteudo(8)" class="btn-ball-links-menu btn btn-dark border-0 bg-transparent d-inline-block align-top p-0 mx-2 text-uppercase font-weight-bold">
                                                <i class="fas fa-list-ul fa-fw bg-blue rounded-circle ball-links-menu-modal" style=""></i>
                                                <p class="small font-weight-bold mt-3">Quiz</p>
                                            </div>
                                            <div onclick="showNovoConteudo(9)" class="btn-ball-links-menu btn btn-dark border-0 bg-transparent align-top p-0 mx-2 text-uppercase font-weight-bold d-inline-block">
                                                <i class="fas fa-stopwatch fa-fw bg-blue rounded-circle ball-links-menu-modal" style=""></i>
                                                <p class="small font-weight-bold mt-3">Prova</p>
                                            </div>
                                            <div onclick="showNovoConteudo(11)" class="btn-ball-links-menu btn btn-dark border-0 bg-transparent align-top p-0 mx-2 text-uppercase font-weight-bold d-inline-block">
                                                <i class="fas fa-file-alt fa-fw bg-blue rounded-circle ball-links-menu-modal" style=""></i>
                                                <p class="small font-weight-bold mt-3">Livro digital</p>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="small font-weight-bold">Atividades</spann>
                                </div>

                                <div onclick="showConteudosTipo(4);" class="btn bg-transparent text-white border-0 p-1 btn-block text-uppercase text-center mb-3">
                                    <div class="position-relative">
                                        <i class="fas fa-arrow-circle-up fa-lg fa-fw bg-blue text-white rounded-circle ball-links-menu" style=""></i>
                                        <div id="divConteudosTipo4" class="tipo-conteudo text-left d-none">
                                            <div onclick="showNovoConteudo(10)" class="btn p-0 d-inline-block align-top mr-3 text-uppercase font-weight-bold">
                                                <i class="fas fa-arrow-circle-up fa-fw bg-blue rounded-circle ball-links-menu-modal" style=""></i>
                                                <small class="font-weight-bold text-darker mx-2">Receber arquivo do aluno  (Até 20Mb PDF, DOC, PNG, JPG)</small>
                                                <i class="fas fa-upload text-darker mx-4"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="small font-weight-bold">Entregável</spann>
                                </div>

                            </div>

                        </div>
                        <div class="col-12 p-3" style="max-width: calc(100% - 125px); overflow-y: auto; max-height: calc(100vh - 160px);">

                            <h3>
                                <span id="lblTituloAulaAtual">Aula 1</span>

                                <button type="button" onclick="showEditarAula()" class="btn-ico btn btn-light ml-2 bg-white box-shadow" data-toggle="tooltip" data-placement="top" title="Editar aula">
                                    <i class="fas fa-pencil-alt fa-fw"></i>
                                </button>

                                <a href="{{ route('gestao.curso.aula-exportar', ['idCurso' => $curso->id, 'idAula' => '###']) }}" class="targetExportIdAula btn-ico btn btn-light ml-2 bg-white box-shadow" title="Exportar Aula" data-toggle="tooltip" data-placement="top" title="Exportar aula">
                                    <i class="fas fa-download"></i>
                                </a>

                                <button type="button" onclick="importarAulaConteudo()" class="btn-ico btn btn-light ml-2 bg-white box-shadow" data-toggle="tooltip" data-placement="top" title="Importar conteúdo para aula">
                                    <i class="fas fa-upload"></i>
                                </button>

                                <button type="button" onclick="duplicarAula()" class="btn-ico btn btn-light ml-2 bg-white box-shadow" data-toggle="tooltip" data-placement="top" title="Duplicar aula">
                                    <i class="fas fa-copy fa-fw"></i>
                                </button>

                                <button type="button" onclick="excluirAula()" class="btn-ico btn btn-light ml-2 bg-white box-shadow" data-toggle="tooltip" data-placement="top" title="Excluír aula">
                                    <i class="fas fa-trash fa-fw text-danger"></i>
                                </button>
                            </h3>

                            <form id="formImportarAula" action="{{ route('gestao.curso.aula-importar', ['idCurso' => $curso->id, 'idAula' => '###']) }}" method="post" enctype="multipart/form-data" class="targetImportIdAula">@csrf <input type="file" id="fileImportAula" name="fileImportAula" style="display:none" />  </form>
                            <form id="formImportarAulaConteudo" action="{{ route('gestao.curso.aula-conteudo-importar', ['idCurso' => $curso->id, 'idAula' => '###']) }}" method="post" enctype="multipart/form-data" class="targetImportIdAulaConteudo">@csrf <input type="file" id="fileImportAulaConteudo" name="fileImportAulaConteudo" style="display:none" />  </form>

                            <form id="formDuplicarAula" action="{{ route('gestao.curso-aula-duplicar', ['idCurso' => $curso->id]) }}" method="post">@csrf <input id="idAula" name="idAula" hidden> </form>
                            <form id="formExcluirAula" action="{{ route('gestao.curso-aula-excluir', ['idCurso' => $curso->id]) }}" method="post">@csrf <input id="idAula" name="idAula" hidden> </form>

                            <div id="divListaConteudos" class="table-responsive">
                                <table class="table">
                                    <tbody class="sortable-conteudos">
                                        <tr id="divItemAula1">
                                            <td class="align-middle handle"><i class="fas fa-bars fa-fw mr-2"></i></td>
                                            <td class="font-weight-bold align-middle" style="color: #999FB4;">
                                                Conteúdo 1
                                            </td>
                                            <td class="font-weight-bold align-middle" style="color: #999FB4;">
                                                <i class="fas fa-video fa-lg fa-fw mr-1" style="color: #207adc;"></i>
                                                <span style="color: #60748A;">Vídeo</span>
                                            </td>
                                            <td class="font-weight-bold align-middle">
                                                <span style="color: #60748A;">Fundamentos-do-conteudo.mp4</span>
                                            </td>
                                            <td class="font-weight-bold align-middle">
                                                <span style="color: #60748A;">31 de jan de 18 às 18:35</span>
                                            </td>
                                            <td class="font-weight-bold align-middle px-1">
                                                <button type="button" class="btn btn-light bg-white box-shadow text-secondary">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            </td>
                                            <td class="font-weight-bold align-middle px-1">
                                                <button type="button" onclick="duplicarConteudo();" class="btn btn-light bg-white box-shadow text-secondary">
                                                    <i class="fas fa-copy"></i>
                                                </button>
                                            </td>
                                            <td class="font-weight-bold align-middle px-1">
                                                <button type="button" onclick="excluirConteudo();" class="btn btn-light bg-white box-shadow text-secondary">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <form id="formDuplicarConteudo" action="{{ route('gestao.curso-conteudo-duplicar', ['idCurso' => $curso->id]) }}" method="post">@csrf <input id="idAula" name="idAula" hidden> <input id="idConteudo" name="idConteudo" hidden> </form>
                            <form id="formExcluirConteudo" action="{{ route('gestao.curso-conteudo-excluir', ['idCurso' => $curso->id]) }}" method="post">@csrf <input id="idAula" name="idAula" hidden> <input id="idConteudo" name="idConteudo" hidden> </form>

                        </div>
                    </div>
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

    {{--  <!-- HTML5 Sortable -->  --}}
    {{--  <script src="https://cdnjs.cloudflare.com/ajax/libs/html5sortable/0.9.3/html5sortable.min.js" integrity="sha256-wXQBwC9CsAvsJMSjVlVtHGr6ECvH8k9TSx7eM+wg1bA=" crossorigin="anonymous"></script>  --}}

    <!-- Summernote css/js -->
    {{-- <link href="{{ env('APP_LOCAL') }}/assets/css/summernote-lite-cerulean.min.css" rel="stylesheet"> --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/lang/summernote-pt-BR.min.js" crossorigin="anonymous"></script>


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
            //if(window.screen.width <= 1280)
            {
                $(".sidebar").removeClass("show");
            }

        $( "#info-alterar-titulo" ).click(function() {
            $( "#titulo" ).focus();
        });


            $('.sortable-aulas').sortable({
                handle: '.handle',
                update: function(event, ui){ reordenouAulas(event, ui) },
            });

            $('.sortable-conteudos').sortable({
                handle: '.handle',
                update: function(event, ui){ reordenouConteudos(event, ui) },
            });

            closeConteudos();

            @if(Request::get('aula') != null)
                @if(Request::get('aula') > 0)
                    showAula({{ Request::get('aula') }});
                @endif
            @else
                @if(count($curso->aulas) > 0)
                    showAula('{{ $curso->aulas[0]->id }}');
                @else
                    showCriarAula();
                @endif
            @endif

            $('.summernote').summernote({
                placeholder: "Clique para digitar.",
                lang: 'pt-BR',
                airMode: false,
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['fontsize', 'color']],
                    ['font', ['fontname']],
                    ['para', ['paragraph']],
                    ['insert', ['hr', 'picture', 'video', 'link', 'table', 'image', 'doc']],
                    ['misc', ['undo', 'redo', 'codeview', 'fullscreen', 'help']],
                ],
                popover: {
                    image: [
                        ['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],
                        ['float', ['floatLeft', 'floatRight', 'floatNone']],
                        ['remove', ['removeMedia']]
                    ],
                    link: [
                        ['link', ['linkDialogShow', 'unlink']]
                    ],
                    air: [
                        ['style', ['style']],
                        ['font', ['bold', 'italic', 'underline', 'clear']],
                        ['font', ['fontsize', 'color']],
                        ['font', ['fontname']],
                        ['para', ['paragraph']],
                        ['table', ['table']],
                        ['insert', ['hr', 'picture', 'video', 'link', 'table', 'image', 'doc']],
                        ['misc', ['undo', 'redo']],
                    ],
                },
            });

            $('.summernote-airmode').summernote({
                placeholder: "Clique para digitar.",
                lang: 'pt-BR',
                airMode: true,
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['fontsize', 'color']],
                    ['font', ['fontname']],
                    ['para', ['paragraph']],
                    ['insert', ['hr', 'picture', 'video', 'link', 'table', 'image', 'doc']],
                    ['misc', ['undo', 'redo', 'codeview', 'fullscreen', 'help']],
                ],
                popover: {
                    image: [
                        ['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],
                        ['float', ['floatLeft', 'floatRight', 'floatNone']],
                        ['remove', ['removeMedia']]
                    ],
                    link: [
                        ['link', ['linkDialogShow', 'unlink']]
                    ],
                    air: [
                        ['style', ['style']],
                        ['font', ['bold', 'italic', 'underline', 'clear']],
                        ['font', ['fontsize', 'color']],
                        ['font', ['fontname']],
                        ['para', ['paragraph']],
                        ['table', ['table']],
                        ['insert', ['hr', 'picture', 'video', 'link', 'table', 'image', 'doc']],
                        ['misc', ['undo', 'redo']],
                    ],
                },
            });
        });

        function reordenouAulas(event, ui)
        {
            console.log(ui);

            var idAula = ui.item[0].id.replace('btnAula', '');
            var position = $(ui.item[0]).index() + 1;

            console.log($(ui.item[0]).index() + 1);

            $.ajax({
                url: appurl + '/gestao/curso/' + {{ $curso->id }} + '/aula/' + idAula + '/reordenar/' + position,
                type: 'get',
                dataType: 'json',
                success: function( _response )
                {
                    console.log( _response );

                    var oldAula = $(ui.item[0].parentNode).children().eq(position - 1);
                    $(ui.item[0].parentNode).children().eq(position - 1).attr('id', 'btnAula' + idAula);
                    oldAula.id = 'btnAula' + position;
                    console.log("Ordem da aula " + idAula + " atualizada com sucesso!");
                },
                error: function( _response )
                {
                    console.log( _response );
                }
            });
        }

        function reordenouConteudos(event, ui)
        {
            console.log(ui);

            var idConteudo = ui.item[0].id.replace('divConteudo', '');
            var position = $(ui.item[0]).index() + 1;

            console.log($(ui.item[0]).index() + 1);

            $.ajax({
                url: appurl + '/gestao/curso/' + {{ $curso->id }} + '/aula/' + aulaAtual + '/conteudo/' + idConteudo + '/reordenar/' + position,
                type: 'get',
                dataType: 'json',
                success: function( _response )
                {
                    console.log( _response );

                    var oldAula = $(ui.item[0].parentNode).children().eq(position - 1);
                    $(ui.item[0].parentNode).children().eq(position - 1).attr('id', 'divConteudo' + idAula);
                    oldAula.id = 'divConteudo' + position;
                    console.log("Ordem do conteudo " + idAula + " atualizada com sucesso!");
                },
                error: function( _response )
                {
                    console.log( _response );
                }
            });
        }

        function showConteudosTipo(tipo)
        {
            $("#divBackgroundTipos").removeClass('d-none');
            $("#divConteudosTipo" + tipo).removeClass('d-none');

            setTimeout(function() {
                $("#divBackgroundTipos").css('opacity', 1);
                $("#divConteudosTipo" + tipo).css('opacity', 1);
            }, 100);

            setTimeout(function() {
                $(".tipo-conteudo").css('max-width', '600px');
                $(".tipo-conteudo").css('overflow', 'visible');
            }, 200);
        }

        function closeConteudos()
        {
            $("#divBackgroundTipos").css('opacity', 0);
            $(".tipo-conteudo").css('opacity', 0);

            $(".tipo-conteudo").css('max-width', '51px');
            $(".tipo-conteudo").css('overflow', 'hidden');

            setTimeout(function() {
                $("#divBackgroundTipos").addClass('d-none');
                $(".tipo-conteudo").addClass('d-none');
            }, 350);
        }

        function closeConteudosTipo(tipo)
        {
            $("#divBackgroundTipos").css('opacity', 0);
            $("#divConteudosTipo" + tipo).css('opacity', 0);

            setTimeout(function() {
                $("#divBackgroundTipos").addClass('d-none');
                $("#divConteudosTipo" + tipo).addClass('d-none');

            }, 350);
        }

        function closeAllPages()
        {
            $("#divEditarCurso").addClass('d-none');
            $("#divNovaAula").addClass('d-none');
            $("#divConteudos").addClass('d-none');
            $("#divMainLoading").addClass('d-none');

            $("#divAulas .list-group-item").removeClass('active');
        }

        function showEditarCurso()
        {
            closeAllPages();
            $("#divEditarCurso").removeClass('d-none');
            $("#divEditarCurso #divEditar").removeClass('d-none');
            $("#divEditarCurso #divEnviando").addClass('d-none');
        }

        function salvarCurso()
        {
            var isValid = true;

            $('#formEditarCurso input').each(function() {
                if ( $(this).val() === '' && $(this).attr('required') )
                {
                    $(this).focus();

                    isValid = false;
                }
            });

            if(!isValid || $("#formEditarCurso textarea").html() == '')
                return;

            $("#divEditarCurso #divEditar").addClass('d-none');
            $("#divEditarCurso #divEnviando").removeClass('d-none');

            $("#formEditarCurso").submit();
        }

        function publicarCurso()
        {
            swal({
                @if($curso->status == 0)
                    title: 'Deseja mesmo publicar?',
                    text: "Você deseja mesmo publicar seu curso?",
                    icon: "warning",
                    buttons: ['Não', 'Sim, pode publicar!'],
                @else
                    title: 'Deseja mesmo despublicar?',
                    text: "Você deseja mesmo despublicar seu curso?",
                    icon: "warning",
                    buttons: ['Não', 'Sim, pode despublicar!'],
                @endif
            }).then((result) => {
                if (result == true)
                {
                  $("#formPublicarCurso").submit();
                }
            });
        }

        function showCriarAula()
        {
            closeAllPages();
            $("#divNovaAula").removeClass('d-none');
            $("#divNovaAula #divEditar").removeClass('d-none');
            $("#divNovaAula #divEnviando").addClass('d-none');

            $("#formNovaAula [name='requisito']").val("nenhum");
            $("#formNovaAula [name='aula_especifica']").val("0");
            $("#formNovaAula #divAulaEspecifica").addClass('d-none');
        }

        function showEnviandoAula()
        {
            var isValid = true;

            $('#formNovaAula select, #formNovaAula input, #formNovaAula textarea').each(function() {
                if ( ($(this).val() === '' || $(this).val() == '0' || $(this).val() == null) && $(this).attr('required') )
                {
                    $(this).focus();

                    isValid = false;
                }
            });

            if($("#formNovaAula #cmbRequisitoAula").val() == "aula" && $("#formNovaAula #cmbAulaEspecifica").val() <= 0)
            {
                $("#formNovaAula #cmbAulaEspecifica").focus();

                isValid = false;
            }

            if(!isValid)
                return;

            $("#divNovaAula #divEditar").addClass('d-none');
            $("#divNovaAula #divEnviando").removeClass('d-none');
        }

        var aulaAtual = 0;

        function showAula(id)
        {
            if(id == aulaAtual)
            {
                closeAllPages();
                $("#divConteudos").removeClass('d-none');
                $("#divAulas #btnAula"+id).addClass('active');
                return;
            }

            closeAllPages();
            $("#divMainLoading").removeClass('d-none');
            $("#divAulas #btnAula"+id).addClass('active');

            $.ajax({
                url: appurl + '/gestao/curso/' + {{ $curso->id }} + '/aula/' + id + '/conteudos',
                type: 'get',
                dataType: 'json',
                success: function( _response )
                {
                    console.log( _response );

                    if(_response.success)
                    {
                        _response.aula = JSON.parse(_response.aula);

                        $('#lblTituloAulaAtual').text(_response.aula.titulo.charAt(0).toUpperCase() + _response.aula.titulo.slice(1));

                        var targetExportIdAula = $('.targetExportIdAula').attr('href').replace('###', id);
                        $('.targetExportIdAula').attr('href', targetExportIdAula);

                        var targetImportIdAula = $('.targetImportIdAula').attr('action').replace('###', id);
                        $('.targetImportIdAula').attr('action', targetImportIdAula);

                        var targetImportIdAulaConteudo = $('.targetImportIdAulaConteudo').attr('action').replace('###', id);
                        $('.targetImportIdAulaConteudo').attr('action', targetImportIdAulaConteudo);

                        var conteudos = '';

                        if(_response.aula.conteudos.length == 0)
                        {
                            conteudos = `<div style="border:  2px solid #E3E5F0;background:  #F9F9F9;padding: 20px;max-width: 450px;font-size: 18px;font-weight: bold;color:  #999FB4;">
                                <img class="mr-2 align-middle" src="{{ env('APP_LOCAL') }}/images/instrucao.jpg" width="85" style="display:  inline-block;">
                                <div class="d-inline-block align-middle" style="width: calc(100% - 100px);">
                                    Utilize a <span style="color: #207adc;">barra de criação</span> para adicionar algum conteúdo!
                                </div>
                            </div>`;
                        }

                        //console.log(_response.aula.conteudos);

                        //console.log(Object.values(_response.aula.conteudos);

                        if(_response.aula.conteudos.length == undefined)
                        {
                            _response.aula.conteudos = Object.values(_response.aula.conteudos)
                        }

                        for (let index = 0; index < _response.aula.conteudos.length; index++) {

                            const value = _response.aula.conteudos[index];

                            conteudos = conteudos + `<tr id="divConteudo${value.id}" class="bg-white box-shadow">
                                <td class="align-middle handle"><i class="fas fa-bars fa-fw mr-2"></i></td>
                                <td class="font-weight-bold align-middle" style="color: #999FB4;">
                                    ${value.titulo}
                                </td>
                                <td class="font-weight-bold align-middle" style="color: #999FB4;">
                                    <i class="${value.tipo_icon} fa-lg fa-fw mr-1" style="color: #207adc;"></i>
                                    <span style="color: #60748A;">${value.tipo_nome}</span>
                                </td>
                                <td colspan="1" class="font-weight-bold align-middle">
                                    {{--  <span style="color: #60748A;">Nome do arquivo</span>  --}}
                                </td>
                                <td class="font-weight-bold align-middle">
                                    <span style="color: #60748A;">${value.date}</span>
                                </td>
                                <td class="font-weight-bold align-middle px-1">
                                    <button class="btn btn-link text-gray p-2" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <div class="dropdown-menu text-left">
                                        <button type="button" onclick="editarConteudo(${value.id});" class="btn btn-link dropdown-item">
                                            <i class="fas fa-edit"></i>
                                            Editar conteúdo
                                        </button>
                                        <a href="` + appurl + '/gestao/curso/' + {{ $curso->id }} + '/aula/' + id + '/conteudo/' + value.id + '/exportar' + `" class="btn btn-link dropdown-item">
                                            <i class="fas fa-file-export mr-1"></i>
                                            Exportar conteúdo
                                        </a>
                                        <button type="button" onclick="duplicarConteudo(${value.id});" class="btn btn-link dropdown-item">
                                            <i class="fas fa-copy mr-1"></i>
                                            Duplicar conteúdo
                                        </button>
                                        <button type="button" onclick="excluirConteudo(${value.id});" class="btn btn-link dropdown-item text-danger">
                                            <i class="fas fa-trash mr-1"></i>
                                            Excluir conteúdo
                                        </button>
                                    </div>

                                </td>
                            </tr>`;

                        }

                        {{-- _response.aula.conteudos.each(function(value, index, array){

                            conteudos = conteudos + `<tr id="divConteudo${value.id}" class="bg-white box-shadow">
                                <td class="align-middle handle"><i class="fas fa-bars fa-fw mr-2"></i></td>
                                <td class="font-weight-bold align-middle" style="color: #999FB4;">
                                    ${value.titulo}
                                </td>
                                <td class="font-weight-bold align-middle" style="color: #999FB4;">
                                    <i class="${value.tipo_icon} fa-lg fa-fw mr-1" style="color: #207adc;"></i>
                                    <span style="color: #60748A;">${value.tipo_nome}</span>
                                </td>
                                <td colspan="1" class="font-weight-bold align-middle">
                                     <span style="color: #60748A;">Nome do arquivo</span>
                                </td>
                                <td class="font-weight-bold align-middle">
                                    <span style="color: #60748A;">${value.date}</span>
                                </td>
                                <td class="font-weight-bold align-middle px-1">
                                    <button type="button" onclick="editarConteudo(${value.id});" class="btn btn-light bg-white box-shadow text-secondary">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </td>
                                <td class="font-weight-bold align-middle px-1">
                                    <button type="button" onclick="duplicarConteudo(${value.id});" class="btn btn-light bg-white box-shadow text-secondary">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                </td>
                                <td class="font-weight-bold align-middle px-1">
                                    <button type="button" onclick="excluirConteudo(${value.id});" class="btn btn-light bg-white box-shadow text-secondary">
                                        <i class="fas fa-trash text-danger"></i>
                                    </button>
                                </td>
                            </tr>`;
                        }); --}}

                        $("#divListaConteudos").find('tbody').html(conteudos);

                        closeAllPages();
                        $("#divConteudos").removeClass('d-none');
                        $("#divAulas #btnAula"+id).addClass('active');

                        aulaAtual = id;
                    }
                    else
                    {
                        swal("Ops!", _response.error, "error");

                        closeAllPages();
                        $("#divNovaAula").removeClass('d-none');
                    }
                },
                error: function( _response )
                {
                    console.log( _response );
                }
            });
        }

        function showEditarAula()
        {
            $("#divModalEditarAula").modal({ keyboard: false, backdrop: 'static' });
            $("#divModalEditarAula #divLoading").removeClass('d-none');
            $("#divModalEditarAula #divEditar").addClass('d-none');
            $("#divModalEditarAula #divEnviando").addClass('d-none');

            $("#divModalEditarAula .form-page").addClass('d-none');
            $("#divModalEditarAula #page1").removeClass('d-none');

            $.ajax({
                url: appurl + '/gestao/curso/' + {{ $curso->id }} + '/aula/' + aulaAtual + '/editar',
                type: 'get',
                dataType: 'json',
                success: function( _response )
                {
                    console.log( _response );

                    if(_response.success)
                    {
                        _response.aula = JSON.parse(_response.aula);

                        $("#divModalEditarAula [name='idAula']").val(_response.aula.id);
                        $("#divModalEditarAula [name='titulo']").val(_response.aula.titulo);
                        $("#divModalEditarAula [name='descricao']").val(_response.aula.descricao);
                        $("#divModalEditarAula [name='duracao']").val(_response.aula.duracao);
                        $("#divModalEditarAula [name='requisito']").val(_response.aula.requisito);
                        if(_response.aula.requisito == "aula")
                        {
                            $("#formEditarAula #divAulaEspecifica").removeClass('d-none');
                            $("#divModalEditarAula [name='aula_especifica']").val(_response.aula.requisito_id);
                        }
                        else
                        {
                            $("#formEditarAula #divAulaEspecifica").addClass('d-none');
                            $("#divModalEditarAula [name='aula_especifica']").val("0");
                        }

                        $("#divModalEditarAula #divLoading").addClass('d-none');
                        $("#divModalEditarAula #divEditar").removeClass('d-none');
                    }
                    else
                    {
                        swal("Ops!", _response.error, "error");

                        $("#divModalEditarAula").modal({ keyboard: false, backdrop: 'static' });
                    }
                },
                error: function( _response )
                {
                    console.log( _response );
                }
            });
        }

        function importarAula()
        {
            $('#fileImportAula').trigger('click');
            $("#fileImportAula").change(function() {
                $(this).parent('form').submit();
            });
        }

        function importarAulaConteudo()
        {
            $('#fileImportAulaConteudo').trigger('click');
            $("#fileImportAulaConteudo").change(function() {
                $(this).parent('form').submit();
            });
        }

        function duplicarAula()
        {
            $("#formDuplicarAula #idAula").val(aulaAtual);

            swal({
                title: 'Duplicar aula?',
                text: "Você deseja mesmo duplicar esta aula?",
                icon: "warning",
                buttons: ['Não', 'Sim, duplicar!'],
            }).then((result) => {
                if (result == true)
                {
                  $("#formDuplicarAula").submit();
                }
            });
        }

        function excluirAula(id)
        {
            $("#formExcluirAula #idAula").val(aulaAtual);

            swal({
                title: 'Excluir aula?',
                text: "Você deseja mesmo excluir este aula?",
                icon: "warning",
                buttons: ['Não', 'Sim, excluir!'],
                dangerMode: true,
            }).then((result) => {
                if (result == true)
                {
                  $("#formExcluirAula").submit();
                }
            });
        }

        function showNovoConteudo(tipo)
        {
            closeConteudos();

            $("#divModalNovoConteudo").modal({ keyboard: false, backdrop: 'static' });
            $("#divModalNovoConteudo #divLoading").addClass('d-none');
            $("#divModalNovoConteudo #divEnviando").addClass('d-none');
            $("#divModalNovoConteudo #divEditar").removeClass('d-none');

            $("#divModalNovoConteudo .tipos-conteudo .tipo").addClass('d-none');

            $("#divModalNovoConteudo .tipos-conteudo").find('#conteudoTipo' + tipo).removeClass('d-none');

            $("#divModalNovoConteudo [name='idAula']").val(aulaAtual);

            $("#divModalNovoConteudo [name='tipo']").val(tipo);

            $("#divModalNovoConteudo [name='titulo']").val('');
            $("#divModalNovoConteudo [name='descricao']").val('');
            $("#divModalNovoConteudo [name='obrigatorio']").prop('checked', true);
            $("#divModalNovoConteudo [name='tempo']").val('');

            switch(tipo)
            {
                case 1:
                    $("#lblTipoNovoConteudo").text("Novo conteúdo livre");
                    $("#formNovoConteudo #txtConteudo").summernote('code',`<div style="color: #525870;font-weight: bold;font-size: 16px;">
                        <p>Esta é a área de edição de conteúdo misto, clique aqui para começar a editar.</p>
                        <ul>
                            <li>Aqui você pode escrever artigos.</li>
                            <li>Colocar imagens, vídeos, tabelas.</li>
                            <li>Personalizar o texto da forma como desejar.</li>
                            <li>E muito mais.</li>
                        </ul>
                    </div>`);
                break;
                case 2:
                    $("#lblTipoNovoConteudo").text("Novo conteúdo de aúdio");
                break;
                case 3:
                    $("#lblTipoNovoConteudo").text("Novo conteúdo de vídeo");
                break;
                case 4:
                    $("#lblTipoNovoConteudo").text("Novo conteúdo de slide");
                break;
                case 5:
                    $("#lblTipoNovoConteudo").text("Novo conteúdo de transmissão ao vivo");
                break;
                case 6:
                    $("#lblTipoNovoConteudo").text("Novo conteúdo de upload");
                break;
                case 7:
                    $("#lblTipoNovoConteudo").text("Novo conteúdo de questão dissertativa");
                break;
                case 8:
                    $("#lblTipoNovoConteudo").text("Novo conteúdo de multipla escolha");
                break;
                case 9:
                    $("#lblTipoNovoConteudo").text("Novo conteúdo de prova");
                break;
                case 10:
                    $("#lblTipoNovoConteudo").text("Novo conteúdo entregável");
                break;
                case 11:
                    $("#lblTipoNovoConteudo").text("Novo conteúdo livro digital");
                break;
                default:
                    $("#lblTipoNovoConteudo").text("Novo conteúdo livre");
                break;
            }

            $("#divModalNovoConteudo [name='titulo']").focus();
        }


        function salvarConteudo()
        {
            var isValid = true;

            $('#divModalNovoConteudo input').each(function() {
                if ( $(this).val() === '' && $(this).attr('required') )
                {
                    $(this).focus();

                    isValid = false;
                }
            });

            if($('#divModalNovoConteudo .summernote').summernote('code') == '' && $("#divModalNovoConteudo .tipos-conteudo").find('#conteudoTipo1').hasClass('d-none') == false)
                return;

            if(!isValid)// || $("#divModalNovoConteudo textarea").html() == '')
                return;

            $("#formNovoConteudo").submit();

            $("#divModalNovoConteudo #divLoading").addClass('d-none');
            $("#divModalNovoConteudo #divEditar").addClass('d-none');
            $("#divModalNovoConteudo #divEnviando").removeClass('d-none');

            $("#divModalNovoConteudo #divLoading").addClass('d-none');
            $("#divModalNovoConteudo #divEditar").addClass('d-none');
            $("#divModalNovoConteudo #divEnviando").removeClass('d-none');
        }

        function showEnviandoEditarAula()
        {
            var isValid = true;

            $('#formEditarAula select, #formEditarAula input, #formEditarAula textarea').each(function() {
                if ( ($(this).val() === '' || $(this).val() == '0' || $(this).val() == null) && $(this).attr('required') )
                {
                    $(this).focus();

                    isValid = false;
                }
            });

            if($("#formEditarAula #cmbRequisitoAula").val() == "aula" && $("#formEditarAula #cmbAulaEspecifica").val() <= 0)
            {
                $("#formEditarAula #cmbAulaEspecifica").focus();

                isValid = false;
            }

            if(!isValid)
                return;

            $("#divModalEditarAula #divLoading").addClass('d-none');
            $("#divModalEditarAula #divEditar").addClass('d-none');
            $("#divModalEditarAula #divEnviando").removeClass('d-none');

            $("#divModalEditarAula #divLoading").addClass('d-none');
            $("#divModalEditarAula #divEditar").addClass('d-none');
            $("#divModalEditarAula #divEnviando").removeClass('d-none');
        }

        function editarConteudo(idConteudo)
        {
            $("#divModalEditarConteudo").modal({ keyboard: false, backdrop: 'static' });
            $("#divModalEditarConteudo #divLoading").removeClass('d-none');
            $("#divModalEditarConteudo #divEditar").addClass('d-none');
            $("#divModalEditarConteudo #divEnviando").addClass('d-none');

            $("#divModalEditarConteudo .form-page").addClass('d-none');
            $("#divModalEditarConteudo #page1").removeClass('d-none');

            $.ajax({
                url: appurl + '/gestao/curso/{{ $curso->id }}/aula/' + aulaAtual + '/conteudos/' + idConteudo + '/editar',
                type: 'get',
                dataType: 'json',
                success: function( _response )
                {
                    console.log( _response );

                    if(_response.success)
                    {
                        _response.conteudo = JSON.parse(_response.conteudo);

                        $("#divModalEditarConteudo .tipos-conteudo .tipo").addClass('d-none');

                        $("#divModalEditarConteudo .tipos-conteudo").find('#conteudoTipo' + _response.conteudo.tipo).removeClass('d-none');

                        var tipo = parseInt(_response.conteudo.tipo);

                        switch(tipo)
                        {
                            case 1:
                                $("#divModalEditarConteudo #lblTipoConteudo").text("Editando conteúdo livre");
                                $("#formEditarConteudo #txtConteudo").summernote('code',_response.conteudo.conteudo);
                            break;

                            case 2:
                                $("#divModalEditarConteudo #lblTipoConteudo").text("Editando conteúdo de aúdio");
                                if(_response.conteudo.temArquivo)
                                {
                                    $("#divVerArquivoAtual").removeClass('d-none');
                                    $("#btnVerArquivoAtual").attr('href', '{{ env("APP_LOCAL") }}/play/{{ $curso->id }}/conteudo/' + _response.conteudo.conteudo_aula.aula_id + '/' + _response.conteudo.id + '/arquivo');
                                    $("#divModalEditarConteudo [name='conteudoAudio']").val();
                                }
                                else
                                {
                                    $("#divVerArquivoAtual").addClass('d-none');
                                    $("#btnVerArquivoAtual").attr('href', '#');
                                    $("#divModalEditarConteudo [name='conteudoAudio']").val(_response.conteudo.conteudo);
                                }
                                console.log($("#divModalEditarConteudo [name='conteudoAudio']").length)
                                console.log($("#divModalEditarConteudo [name='conteudoAudio']").val())
                            break;

                            case 3:
                                $("#divModalEditarConteudo #lblTipoConteudo").text("Editando conteúdo de vídeo");
                                if(_response.conteudo.temArquivo)
                                {
                                    $("#divVerArquivoAtual").removeClass('d-none');
                                    $("#btnVerArquivoAtual").attr('href', '{{ env("APP_LOCAL") }}/play/{{ $curso->id }}/conteudo/' + _response.conteudo.conteudo_aula.aula_id + '/' + _response.conteudo.id + '/arquivo');
                                    $("#divModalEditarConteudo [name='conteudoVideo']").val();
                                }
                                else
                                {
                                    $("#divVerArquivoAtual").addClass('d-none');
                                    $("#btnVerArquivoAtual").attr('href', '#');
                                    $("#divModalEditarConteudo [name='conteudoVideo']").val(_response.conteudo.conteudo);
                                }
                            break;

                            case 4:
                                $("#divModalEditarConteudo #lblTipoConteudo").text("Editando conteúdo de slide");
                                if(_response.conteudo.temArquivo)
                                {
                                    $("#divVerArquivoAtual").removeClass('d-none');
                                    $("#btnVerArquivoAtual").attr('href', '{{ env("APP_LOCAL") }}/play/{{ $curso->id }}/conteudo/' + _response.conteudo.conteudo_aula.aula_id + '/' + _response.conteudo.id + '/arquivo');
                                    $("#divModalEditarConteudo [name='conteudoSlide']").val();
                                }
                                else
                                {
                                    $("#divVerArquivoAtual").addClass('d-none');
                                    $("#btnVerArquivoAtual").attr('href', '#');
                                    $("#divModalEditarConteudo [name='conteudoSlide']").val(_response.conteudo.conteudo);
                                }
                            break;

                            case 5:
                                $("#divModalEditarConteudo #lblTipoConteudo").text("Editando conteúdo de transmissão ao vivo");
                                $("#divModalEditarConteudo [name='conteudoTransmissao']").val(_response.conteudo.conteudo);
                            break;

                            case 6:
                                $("#divModalEditarConteudo #lblTipoConteudo").text("Editando conteúdo de upload");
                                if(_response.conteudo.temArquivo)
                                {
                                    $("#divVerArquivoAtual").removeClass('d-none');
                                    $("#btnVerArquivoAtual").attr('href', '{{ env("APP_LOCAL") }}/play/{{ $curso->id }}/conteudo/' + _response.conteudo.conteudo_aula.aula_id + '/' + _response.conteudo.id + '/arquivo');
                                    $("#divModalEditarConteudo [name='conteudoArquivo']").val();
                                }
                                else
                                {
                                    $("#divVerArquivoAtual").addClass('d-none');
                                    $("#btnVerArquivoAtual").attr('href', '#');
                                    $("#divModalEditarConteudo [name='conteudoArquivo']").val(_response.conteudo.conteudo);
                                }
                            break;

                            case 7:
                                $("#divModalEditarConteudo #lblTipoConteudo").text("Editando conteúdo de questão dissertativa");
                                _response.conteudo.conteudo = JSON.parse(_response.conteudo.conteudo);
                                $("#divModalEditarConteudo [name='conteudoDissertativa']").val(_response.conteudo.conteudo.pergunta);
                                $("#divModalEditarConteudo [name='conteudoDissertativaDica']").val(_response.conteudo.conteudo.dica);
                                $("#divModalEditarConteudo [name='conteudoDissertativaExplicacao']").val(_response.conteudo.conteudo.explicacao);
                            break;

                            case 8:
                                $("#divModalEditarConteudo #lblTipoConteudo").text("Editando conteúdo de multipla escolha");
                                _response.conteudo.conteudo = JSON.parse(_response.conteudo.conteudo);
                                $("#divModalEditarConteudo [name='conteudoQuiz']").val(_response.conteudo.conteudo.pergunta);
                                $("#divModalEditarConteudo #rdoAlternativa" + _response.conteudo.conteudo.correta).prop("checked", true);
                                $("#divModalEditarConteudo [name='conteudoQuizAlternativa1']").val(_response.conteudo.conteudo.alternativas[0]);
                                $("#divModalEditarConteudo [name='conteudoQuizAlternativa2']").val(_response.conteudo.conteudo.alternativas[1]);
                                $("#divModalEditarConteudo [name='conteudoQuizAlternativa3']").val(_response.conteudo.conteudo.alternativas[2]);
                                $("#divModalEditarConteudo [name='conteudoQuizDica']").val(_response.conteudo.conteudo.dica);
                                $("#divModalEditarConteudo [name='conteudoQuizExplicacao']").val(_response.conteudo.conteudo.explicacao);
                            break;

                            case 9:
                                $("#divModalEditarConteudo #lblTipoConteudo").text("Editando conteúdo de prova");
                            break;

                            case 10:
                                $("#divModalEditarConteudo #lblTipoConteudo").text("Editando conteúdo entregável");
                                $("#formEditarConteudo #txtConteudoEntregavel").summernote('code',_response.conteudo.conteudo);
                            break;

                            case 11:
                                $("#divModalEditarConteudo #lblTipoConteudo").text("Editando conteúdo livro digital");
                                $("#formEditarConteudo #txtConteudoApostila").summernote('code',_response.conteudo.conteudo);
                            break;

                            default:
                                $("#divModalEditarConteudo #lblTipoConteudo").text("Editando conteúdo livre2");
                                $("#formEditarConteudo #txtConteudo").summernote('code',_response.conteudo.conteudo);
                            break;
                        }

                        $("#divModalEditarConteudo [name='idAula']").val(_response.conteudo.conteudo_aula.aula_id);
                        $("#divModalEditarConteudo [name='idConteudo']").val(_response.conteudo.id);
                        $("#divModalEditarConteudo [name='tipo']").val(_response.conteudo.tipo);
                        $("#divModalEditarConteudo [name='titulo']").val(_response.conteudo.titulo);
                        $("#divModalEditarConteudo [name='obrigatorio']").prop("checked", _response.conteudo.obrigatorio);
                        if(_response.conteudo.tempo > 0)
                            $("#divModalEditarConteudo [name='tempo']").val(_response.conteudo.tempo);
                        else
                            $("#divModalEditarConteudo [name='tempo']").val("");

                        {{--  $("#divModalEditarConteudo [name='visibilidade']").val(_response.conteudo.visibilidade);  --}}
                        $("#divModalEditarConteudo [name='status']").val(_response.conteudo.status);

                        $("#divModalEditarConteudo [name='apoio']").val(_response.conteudo.apoio);
                        $("#divModalEditarConteudo [name='fonte']").val(_response.conteudo.fonte);
                        $("#divModalEditarConteudo [name='autores']").val(_response.conteudo.autores);

                        $("#divModalEditarConteudo #divLoading").addClass('d-none');
                        $("#divModalEditarConteudo #divEditar").removeClass('d-none');
                    }
                    else
                    {
                        swal("Ops!", _response.error, "error");

                        $("#divModalEditarConteudo").modal({ keyboard: false, backdrop: 'static' });
                    }
                },
                error: function( _response )
                {
                    console.log( _response );
                }
            });
        }

        function salvarEdicaoConteudo()
        {
            console.log("Salvar conteudo");

            var isValid = true;

            $('#divModalEditarConteudo input').each(function() {
                if ( $(this).val() === '' && $(this).attr('required') )
                {
                    console.log("Campo obrigatório: ", this);

                    $(this).focus();

                    isValid = false;
                }
            });

            {{-- if($('#divModalNovoConteudo .summernote').summernote('code') == '' && $("#divModalNovoConteudo .tipos-conteudo").find('#conteudoTipo1').hasClass('d-none') == false)
                return; --}}

            if(!isValid)// || $("#divModalNovoConteudo textarea").html() == '')
                return;

            {{-- if(!isValid || $("#divModalEditarConteudo textarea").html() == '')
            {
                return;
            } --}}

            $("#formEditarConteudo").submit();

            $("#divModalEditarConteudo #divLoading").addClass('d-none');
            $("#divModalEditarConteudo #divEditar").addClass('d-none');
            $("#divModalEditarConteudo #divEnviando").removeClass('d-none');

            $("#divModalEditarConteudo #divLoading").addClass('d-none');
            $("#divModalEditarConteudo #divEditar").addClass('d-none');
            $("#divModalEditarConteudo #divEnviando").removeClass('d-none');
        }

        function duplicarConteudo(id)
        {
            $("#formDuplicarConteudo #idAula").val(aulaAtual);
            $("#formDuplicarConteudo #idConteudo").val(id);

            swal({
                title: 'Deseja mesmo duplicar?',
                text: "Você deseja mesmo duplicar este conteúdo?",
                icon: "warning",
                buttons: ['Não', 'Sim, duplicar!'],
            }).then((result) => {
                if (result == true)
                {
                  $("#formDuplicarConteudo").submit();
                }
            });
        }

        function excluirConteudo(id)
        {
            $("#formExcluirConteudo #idAula").val(aulaAtual);
            $("#formExcluirConteudo #idConteudo").val(id);

            swal({
                title: 'Deseja mesmo excluir?',
                text: "Você deseja mesmo excluir este conteúdo?",
                icon: "warning",
                buttons: ['Não', 'Sim, excluir!'],
                dangerMode: true,
            }).then((result) => {
                if (result == true)
                {
                  $("#formExcluirConteudo").submit();
                }
            });
        }

        function mudouPeriodo(el)
        {
            if(el.value > 0)
            {
                $("#lblPeriodo").text(el.value);
            }
            else
            {
                $("#lblPeriodo").text("Ilimitado");
            }
        }

        function mudouVagas(el)
        {
            if(el.value > 0)
            {
                $("#lblVagas").text(el.value);
            }
            else
            {
                $("#lblVagas").text("Ilimitado");
            }
        }

        function mudouRequisitoAula(editando)
        {
            if(editando)
            {
                console.log($("#formEditarAula #cmbRequisitoAula").val());

                //Desabilita a aula que está sendo editada
                $("#formEditarAula #cmbAulaEspecifica option").removeAttr('disabled');
                $("#formEditarAula #cmbAulaEspecifica option[value='0']").attr('disabled', true);
                $("#formEditarAula #cmbAulaEspecifica option[value='" + $("#divModalEditarAula [name='idAula']").val() + "']").attr('disabled', true);

                if($("#formEditarAula #cmbRequisitoAula").val() == "aula")
                {
                    $("#formEditarAula #divAulaEspecifica").removeClass('d-none');
                }
                else
                {
                    $("#formEditarAula #divAulaEspecifica").addClass('d-none');
                }
            }
            else
            {
                console.log($("#formNovaAula #cmbRequisitoAula").val());

                if($("#formNovaAula #cmbRequisitoAula").val() == "aula")
                {
                    $("#formNovaAula #divAulaEspecifica").removeClass('d-none');
                }
                else
                {
                    $("#formNovaAula #divAulaEspecifica").addClass('d-none');
                }
            }
        }

        function mudouTipoRespostaProva(op)
        {
            if(op == "rdoTipoResposta1")
            {
                $("#divModalNovoConteudo #divDissertativa").removeClass("d-none");
                $("#divModalNovoConteudo #divMultiplaEscolha").addClass("d-none");
            }
            else
            {
                $("#divModalNovoConteudo #divMultiplaEscolha").removeClass("d-none");
                $("#divModalNovoConteudo #divDissertativa").addClass("d-none");
            }
        }

        var perguntasProva = [];

        function mudouPerguntaProvaAtual()
        {
            var perguntaAtual = $("#divModalNovoConteudo #cmbQuestaoAtual").val();

            if(perguntasProva.length >= perguntaAtual)
            {
                if(perguntasProva[perguntaAtual - 1].tipo == 1)
                {
                    $("#divModalNovoConteudo #rdoTipoResposta1").prop('checked', true);
                    $("#divModalNovoConteudo #btnTipoResposta1").button('toggle');
                    $("#divModalNovoConteudo #divDissertativa").removeClass("d-none");
                    $("#divModalNovoConteudo #divMultiplaEscolha").addClass("d-none");

                    $("#divModalNovoConteudo #divDissertativa #txtPerguntaDissertativa").val(perguntasProva[perguntaAtual - 1].pergunta);
                }
                else
                {
                    $("#divModalNovoConteudo #rdoTipoResposta2").prop('checked', true);
                    $("#divModalNovoConteudo #btnTipoResposta2").button('toggle');
                    $("#divModalNovoConteudo #divMultiplaEscolha").removeClass("d-none");
                    $("#divModalNovoConteudo #divDissertativa").addClass("d-none");

                    $("#divModalNovoConteudo #divMultiplaEscolha #txtPerguntaQuiz").val(perguntasProva[perguntaAtual - 1].pergunta);
                    $("#divModalNovoConteudo #divMultiplaEscolha #txtQuizAlternativa1").val(perguntasProva[perguntaAtual - 1].alternativas[0]);
                    $("#divModalNovoConteudo #divMultiplaEscolha #txtQuizAlternativa2").val(perguntasProva[perguntaAtual - 1].alternativas[1]);
                    $("#divModalNovoConteudo #divMultiplaEscolha #txtQuizAlternativa3").val(perguntasProva[perguntaAtual - 1].alternativas[2]);
                    $("#divModalNovoConteudo #divMultiplaEscolha #rdoAlternativaMultiplaEscolha" + perguntasProva[perguntaAtual - 1].correta).prop("checked", true);
                }

                $("#divModalNovoConteudo #txtPesoPergunta").val(perguntasProva[perguntaAtual - 1].peso);

                $("#btnAdicionarPergunta").text("Salvar pergunta");
            }
            else
            {
                if(perguntaAtual == (perguntasProva.length + 1))
                {
                    $("#divModalNovoConteudo #rdoTipoResposta1").prop('checked', true);
                    $("#divModalNovoConteudo #btnTipoResposta1").button('toggle');
                    $("#divModalNovoConteudo #divDissertativa").removeClass("d-none");
                    $("#divModalNovoConteudo #divMultiplaEscolha").addClass("d-none");

                    $("#divModalNovoConteudo #divDissertativa #txtPerguntaDissertativa").val("");
                    $("#divModalNovoConteudo #divMultiplaEscolha #rdoAlternativaMultiplaEscolha1").prop("checked", false);
                    $("#divModalNovoConteudo #divMultiplaEscolha #rdoAlternativaMultiplaEscolha2").prop("checked", false);
                    $("#divModalNovoConteudo #divMultiplaEscolha #rdoAlternativaMultiplaEscolha3").prop("checked", false);
                    $("#divModalNovoConteudo #divMultiplaEscolha #txtPerguntaQuiz").val("");
                    $("#divModalNovoConteudo #divMultiplaEscolha #txtQuizAlternativa1").val("");
                    $("#divModalNovoConteudo #divMultiplaEscolha #txtQuizAlternativa2").val("");
                    $("#divModalNovoConteudo #divMultiplaEscolha #txtQuizAlternativa3").val("");

                    $("#divModalNovoConteudo #txtPesoPergunta").val("");
                }
                else
                {
                    $("#divModalNovoConteudo #cmbQuestaoAtual option[value='" + perguntaAtual + "']").remove();
                    $("#divModalNovoConteudo #cmbQuestaoAtual").val(perguntasProva.length + 1);
                }

                $("#btnAdicionarPergunta").text("Adicionar nova pergunta");
            }
        }

        function adicionarNovaPerguntaProva()
        {
            if($("#divModalNovoConteudo #rdoTipoResposta1").prop('checked'))
            {
                if($("#divModalNovoConteudo #divDissertativa #txtPerguntaDissertativa").val() == "")
                {
                    $("#divModalNovoConteudo #divDissertativa #txtPerguntaDissertativa").focus();
                    return;
                }
                else if($("#divModalNovoConteudo #txtPesoPergunta").val() <= 0)
                {
                    $("#divModalNovoConteudo #txtPesoPergunta").focus();
                    return;
                }

                if($("#divModalNovoConteudo #cmbQuestaoAtual").val() == (perguntasProva.length + 1))
                {
                    perguntasProva.push({
                        'tipo' : 1,
                        'pergunta' : $("#divModalNovoConteudo #divDissertativa #txtPerguntaDissertativa").val(),
                        'peso' : $("#divModalNovoConteudo #txtPesoPergunta").val(),
                    });
                }
                else
                {
                    perguntasProva[$("#divModalNovoConteudo #cmbQuestaoAtual").val() - 1] = {
                        'tipo' : 1,
                        'pergunta' : $("#divModalNovoConteudo #divDissertativa #txtPerguntaDissertativa").val(),
                        'peso' : $("#divModalNovoConteudo #txtPesoPergunta").val(),
                    };
                }

                $("#divModalNovoConteudo #divDissertativa #txtPerguntaDissertativa").val("");

            }
            else
            {
                var correta = 0;
                if($("#divModalNovoConteudo #divMultiplaEscolha #rdoAlternativaMultiplaEscolha1").prop("checked"))
                    correta = 1;
                else if($("#divModalNovoConteudo #divMultiplaEscolha #rdoAlternativaMultiplaEscolha2").prop("checked"))
                    correta = 2;
                else if($("#divModalNovoConteudo #divMultiplaEscolha #rdoAlternativaMultiplaEscolha3").prop("checked"))
                    correta = 3;

                if($("#divModalNovoConteudo #divMultiplaEscolha #txtPerguntaQuiz").val() == "")
                {
                    $("#divModalNovoConteudo #divMultiplaEscolha #txtPerguntaQuiz").focus();
                    return;
                }
                else if($("#divModalNovoConteudo #divMultiplaEscolha #txtQuizAlternativa1").val() == "")
                {
                    $("#divModalNovoConteudo #divMultiplaEscolha #txtQuizAlternativa1").focus();
                    return;
                }
                else if($("#divModalNovoConteudo #divMultiplaEscolha #txtQuizAlternativa2").val() == "")
                {
                    $("#divModalNovoConteudo #divMultiplaEscolha #txtQuizAlternativa2").focus();
                    return;
                }
                else if($("#divModalNovoConteudo #divMultiplaEscolha #txtQuizAlternativa3").val() == "")
                {
                    $("#divModalNovoConteudo #divMultiplaEscolha #txtQuizAlternativa3").focus();
                    return;
                }
                else if(correta == 0)
                {
                    return;
                }
                else if($("#divModalNovoConteudo #txtPesoPergunta").val() <= 0)
                {
                    $("#divModalNovoConteudo #txtPesoPergunta").focus();
                    return;
                }

                if($("#divModalNovoConteudo #cmbQuestaoAtual").val() == (perguntasProva.length + 1))
                {
                    perguntasProva.push({
                        'tipo' : 2,
                        'pergunta' : $("#divModalNovoConteudo #divMultiplaEscolha #txtPerguntaQuiz").val(),
                        'alternativas' : [ $("#divModalNovoConteudo #divMultiplaEscolha #txtQuizAlternativa1").val(),
                            $("#divModalNovoConteudo #divMultiplaEscolha #txtQuizAlternativa2").val(),
                            $("#divModalNovoConteudo #divMultiplaEscolha #txtQuizAlternativa3").val()
                            ],
                        'correta' : correta,
                        'peso' : $("#divModalNovoConteudo #txtPesoPergunta").val(),
                    });
                }
                else
                {
                    perguntasProva[$("#divModalNovoConteudo #cmbQuestaoAtual").val() - 1] = {
                        'tipo' : 2,
                        'pergunta' : $("#divModalNovoConteudo #divMultiplaEscolha #txtPerguntaQuiz").val(),
                        'alternativas' : [ $("#divModalNovoConteudo #divMultiplaEscolha #txtQuizAlternativa1").val(),
                            $("#divModalNovoConteudo #divMultiplaEscolha #txtQuizAlternativa2").val(),
                            $("#divModalNovoConteudo #divMultiplaEscolha #txtQuizAlternativa3").val()
                            ],
                        'correta' : correta,
                        'peso' : $("#divModalNovoConteudo #txtPesoPergunta").val(),
                    };
                }

                $("#divModalNovoConteudo #divMultiplaEscolha #rdoAlternativaMultiplaEscolha1").prop("checked", false);
                $("#divModalNovoConteudo #divMultiplaEscolha #rdoAlternativaMultiplaEscolha2").prop("checked", false);
                $("#divModalNovoConteudo #divMultiplaEscolha #rdoAlternativaMultiplaEscolha3").prop("checked", false);
                $("#divModalNovoConteudo #divMultiplaEscolha #txtPerguntaQuiz").val("");
                $("#divModalNovoConteudo #divMultiplaEscolha #txtQuizAlternativa1").val("");
                $("#divModalNovoConteudo #divMultiplaEscolha #txtQuizAlternativa2").val("");
                $("#divModalNovoConteudo #divMultiplaEscolha #txtQuizAlternativa3").val("");
            }

            $("#divModalNovoConteudo #txtPesoPergunta").val("");

            $("#divModalNovoConteudo #cmbQuestaoAtual option[value='" + perguntasProva.length + "']").removeAttr("disabled");

            if($("#divModalNovoConteudo #cmbQuestaoAtual option").length < (perguntasProva.length + 1))
            {
                $("#divModalNovoConteudo #cmbQuestaoAtual").append("<option value='" + (perguntasProva.length + 1) +"'>Questão " + (perguntasProva.length + 1) +"</option>");
            }

            $("#divModalNovoConteudo #cmbQuestaoAtual").val(perguntasProva.length + 1);

            $("#divModalNovoConteudo #txtPerguntas").val(JSON.stringify(perguntasProva));

            //console.log(perguntasProva);
            //console.log($("#divModalNovoConteudo #txtPerguntas").val());
        }

    </script>

@endsection
