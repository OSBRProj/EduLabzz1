@extends('layouts.master')

@section('title', 'J. PIAGET - Turma ' . $turma->titulo)

@section('content')

    <main class="mainViewMuralTurma" role="main">

        <div class="container">

            <div class="col-12 col-md-11 mx-auto">

                <div class="row">

                    <div class="col-12 mb-3 title pl-0 text-center border-0">
                        <h2>{{ ucfirst($turma->titulo) }}</h2>
                    </div>

                    @if(strpos(URL::current(), ":3000") !== false ? (app('router')->getRoutes()->match(app('request')->create( str_replace(env('APP_URL'), "", URL::previous())  ))->getName() == 'gestao.escola-painel') : false )
                        <div class="float-none float-md-left text-truncate mb-3 mb-md-0">
                            <a href="{{ route('gestao.escola-painel', ['idEscola' => $turma->escola->id]) }}#turmas"
                                class="btn bg-transparent btn-outline w-100 text-primary text-truncate box-shadow rounded px-4 py-2">
                                <i class="fas fa-chevron-left fa-fw fa-lg mr-2"></i>
                                Voltar à todas as turmas
                            </a>
                        </div>
                    @endif

                    <h4 class="text-primary mx-auto">
                        <!-- {{ ucfirst($turma->titulo) }} -->
                        <small class="d-block my-4">
                            <a href="{{ route('gestao.escola-painel', ['idEscola' => $turma->escola->id]) }}" class=""
                                style="color: #989AC1;">
                                {{ ucfirst($turma->escola->titulo) }}
                            </a>
                            <a href="{{ route('professor.avaliacoes', ['idProfessor' => $turma->professor->id]) }}"
                                class="d-block small mt-2" style="color: #989AC1;">
                                Professor: {{ ucwords($turma->professor->name) }}
                            </a>
                        </small>
                    </h4>

                </div>

                <ul class="nav nav-tabs row justify-content-center" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="mural-tab" data-toggle="tab" href="#mural" role="tab" aria-controls="mural" aria-selected="true">Mural</a>
                    </li>

                    @if(Request::is('gestao/turma/*') && ($turma->user_id == Auth::user()->id || Auth::user()->permissao == "Z"))
                        <li class="nav-item">
                            <a class="nav-link" id="aplicacao-tab" data-toggle="tab" href="#aplicacao" role="tab"
                                aria-controls="aplicacao" aria-selected="false">Liberar aplicação</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="transmissao-tab" data-toggle="tab" href="#transmissao" role="tab"
                                aria-controls="transmissao" aria-selected="false">Transmissão</a>
                        </li>
                    @endif

                    <li class="nav-item">
                        <a class="nav-link" id="frequencia-tab" data-toggle="tab" href="#frequencia" role="tab"
                            aria-controls="frequencia" aria-selected="false">Frequência</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="alunos-tab" data-toggle="tab" href="#alunos" role="tab"
                            aria-controls="alunos" aria-selected="false">Alunos</a>
                    </li>

                    <li class="nav-item">
                        @if(Request::is('gestao/turma/*') && (Auth::user()->permissao == "Z"))
                            <a class="nav-link" href="{{ route('gestao.grade-listar', $turma->id) }}">Grade de Aulas</a>
                        @else
                            <a class="nav-link" href="{{ route('turma-grade-aulas', $turma->id) }}">Grade de Aulas</a>
                        @endif
                    </li>
                </ul>
                <hr class="row">

                <div class="row tab-content pt-3" id="tabDadosUsuario">

                    <div class="tab-pane fade w-100 show active row" id="mural" role="tabpanel"
                            aria-labelledby="mural-tab">

                        <div class="container-fluid">

                            <div class="row">

                                @if(Request::is('gestao/turma/*') && ($turma->user_id == Auth::user()->id || Auth::user()->permissao == "Z"))
                                    <div class="col-12 col-md-4">
                                        <div class="bg-card bg-white rounded-0 box-shadow p-4 mb-4">
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input type="checkbox" class="custom-control-input"
                                                        name="postagem_aberta" id="ckbModoPostagem"
                                                        onchange="mudouModoPostagemTurma({{ $turma->id }}, this);" {{ $turma->postagem_aberta ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="ckbModoPostagem">Alunos também
                                                    podem publicar no mural.</label>
                                            </div>
                                        </div>

                                        <div class="bg-card bg-white rounded-0 box-shadow p-4">
                                    <span class="d-block mb-3" style="color: #525870;">
                                        Link de acesso rápido para novos alunos.
                                    </span>

                                            <button id="btnGerarConvite" type="submit" onclick="gerarLinkConvite();"
                                                    class="btn bg-bluelight btn-block text-dark font-weight-bold mb-3 {{ $turma->codigo_convite == null ? '' : 'd-none' }}">
                                                Gerar link de convite
                                            </button>
                                            <div id="divLinkConvite"
                                                    class="input-group mb-3 {{ $turma->codigo_convite != null ? '' : 'd-none' }}">
                                                <input type="text" readonly id="lblLinkConvite"
                                                        class="form-control bg-lightgray border-0 rounded-0 text-wrap"
                                                        value="{{ route('turma-convite', ['idTurma' => $turma->id, 'idConvite' => $turma->codigo_convite]) }}">
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="col-12 col-md-8 mx-auto">

                                    <div class="bg-white rounded-0 shadow-sm mb-2">

                                        @if($turma->user_id == Auth::user()->id || $turma->postagem_aberta == 1)

                                            <div class="p-0 mb-3">

                                                <form id="formPostar" method="POST"
                                                        action="{{ route('turma-mural-postar', ['idTurma' => $turma->id]) }}"
                                                        enctype="multipart/form-data" class="">

                                                    @csrf

                                                    <div id="divEnviando" class="text-center d-none">
                                                        <i class="fas fa-spinner fa-pulse fa-3x text-primary mb-3"></i>
                                                        <h4>Enviando</h4>
                                                    </div>

                                                    <div id="divEditar" class="form-page">
                                                        <div class="form-group mb-3 text-left">
                                                            {{-- <textarea class="form-control" name="conteudo" id="txtPostagem" rows="3" placeholder="Digite aqui sua postagem." onchange="escreveuPostagem();" style="font-size: 18px;"></textarea> --}}
                                                            <div class="summernote-holder text-dark">
                                                            <textarea name="conteudo" id="txtConteudo" class="summernote-airmode d-none text-dark"></textarea>
                                                            </div>
                                                        </div>

                                                        <div class="pb-4 px-4 row">
                                                            <div class="col-auto ml-auto my-auto pr-0">
                                                                <label for="arquivo"
                                                                        class="btn btn-outline px-2 py-1 text-uppercase font-weight-bold position-relative m-0"
                                                                        style="border-width: 1px;border: 1px solid #207adc;color: #207adc;">
                                                                    <input type="file" class="custom-file-input"
                                                                            id="arquivo" name="arquivo"
                                                                            style="top: 0px;height:  100%;position:  absolute;left:  0px;"
                                                                            oninput="anexouArquivo(this);">
                                                                    <i class="fas fa-paperclip fa-fw fa-lg text-primary align-middle"></i>
                                                                    <span id="lblNomeArquivo"></span>
                                                                </label>
                                                            </div>
                                                            <div class="col-auto my-auto text-right">
                                                                <button id="btnEnviarPostagem" type="submit"
                                                                        onclick="enviarPostagem();"
                                                                        class="btn px-5 py-1 signin-button m-0 text-primary font-weight-bold"
                                                                        style="background: transparent;border: 1px solid #207adc;">
                                                                    Publicar
                                                                </button>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </form>

                                            </div>
                                        @endif

                                    </div>

                                    <div class="py-4 text-primary">
                                        <h4>
                                            Bem-vindo ao mural da sua turma
                                            <small class="d-block mt-3">
                                                As postagens são exibidas abaixo.
                                            </small>
                                        </h4>
                                    </div>

                                    @foreach ($turma->postagens as $postagem)

                                        <div class="bg-postagem rounded-10 box-shadow py-4 mb-3">

                                            <div class="container-fluid px-0">

                                                <div class="row pl-5 pr-4">

                                                    <div class="col-auto text-left px-0">
                                                        <div class="avatar-img my-0 d-inline-block"
                                                                style="width: 54px;height: 54px; background: url({{ route('usuario.perfil.image', [$postagem->user['id']]) }}); background-size: cover; background-position: 50% 50%; background-repeat: no-repeat;"></div>
                                                    </div>
                                                    <div class="col text-left">
                                                <span class="d-inline-block align-middle" style="color: #999FB4;">
                                                    {{ $postagem->user['name'] }}
                                                    @if($turma->user_id == $postagem->user['id'] || $postagem->user['permissao'] != "A")
                                                        <i class="fas fa-check-circle fa-fw ml-1"
                                                            style="color: #798AC4;"></i>
                                                    @endif
                                                </span>

                                                        <div class="float-right" style="color: #999FB4;">
                                                            {{ $postagem->created_at->diffForHumans() }}
                                                            {{-- {{ $postagem->created_at->format('d \d\e M \d\e Y') }} --}}
                                                        </div>

                                                        <div class="pt-2 text-primary">
                                                            {!! $postagem->conteudo !!}
                                                        </div>
                                                        @if($postagem->arquivo != null)
                                                            <div class="d-block text-left py-3">
                                                                <a href="{{ route('turma-postagem-arquivo', ['idTurma' => $turma->id, 'idPostagem' => $postagem->id]) }}"
                                                                    target="_blank"
                                                                    class="btn bg-bluelight px-5 signin-button m-0 text-dark font-weight-bold">
                                                                    <i class="fas fa-paperclip fa-lg text-primary mr-2 align-middle"></i>
                                                                    Download
                                                                </a>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    @if($postagem->user_id == Auth::user()->id || $turma->user_id == Auth::user()->id)
                                                        <div class="col-auto ml-auto pr-0 mx-0 text-right">
                                                            <form class=""
                                                                    action="{{ route('turma-postagem-excluir', ['idTurma' => $postagem->turma_id, 'idPostatem' => $postagem->id]) }}"
                                                                    method="post">
                                                                @csrf
                                                                <button type="submit"
                                                                        class="btn bg-transparent p-1 mr-2">
                                                                    <i class="fas fa-trash fa-fw text-danger"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    @endif

                                                </div>

                                                <hr style="border-color: #434763;">

                                                <div class="row px-5">
                                                    <div class="col-12">
                                                        <p class="small" style="color: #999FB4;">
                                                            Comentário{{ count($postagem->comentarios) != 1 ? 's' : '' }}
                                                            ({{ count($postagem->comentarios) }})
                                                        </p>
                                                    </div>
                                                </div>

                                                @foreach ($postagem->comentarios as $comentario)

                                                    <div class="row pl-5 pr-4 py-3">
                                                        <div class="col-auto text-left px-0">
                                                            <div class="avatar-img avatar-sm my-0 d-inline-block"
                                                                    style="width: 54px;height: 54px; background: url({{ route('usuario.perfil.image', [$comentario->user['id']]) }}); background-size: cover; background-position: 50% 50%; background-repeat: no-repeat;"></div>
                                                        </div>
                                                        <div class="col text-left">
                                                    <span class="d-inline-block align-middle" style="color: #999FB4;">
                                                        {{ $comentario->user['name'] }}
                                                        @if($comentario->user['id'] == $turma->user_id || $comentario->user['permissao'] != "A")
                                                            <i class="fas fa-check-circle fa-fw ml-1"
                                                                style="color: #798AC4;"></i>
                                                        @endif
                                                    </span>

                                                            <div class="float-right text-lightgray"
                                                                    style="color: #999FB4;">
                                                                {{ $comentario->created_at->diffForHumans() }}
                                                                {{-- {{ $comentario->created_at->format('d \d\e M \d\e Y') }} --}}
                                                            </div>

                                                            <div class="pt-2 text-white text-darkmode">
                                                                {!! $comentario->conteudo !!}
                                                            </div>
                                                        </div>
                                                        @if($comentario->user_id == Auth::user()->id || $turma->user_id == Auth::user()->id)
                                                            <div class="col-auto ml-auto pr-0 mx-0 text-right">
                                                                <form class=""
                                                                        action="{{ route('turma-postagem-comentario-excluir', ['idTurma' => $postagem->turma_id, 'idPostatem' => $postagem->id, 'idComentario' => $comentario->id]) }}"
                                                                        method="post">
                                                                    @csrf
                                                                    <button type="submit"
                                                                            class="btn bg-transparent p-1">
                                                                        <i class="fas fa-trash fa-fw text-danger"></i>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        @endif
                                                    </div>

                                                @endforeach

                                                <div class="row px-5">

                                                    <div class="col-12">
                                                        <form
                                                            action="{{ route('turma-postagem-comentario-enviar', ['idTurma' => $turma->id, 'idPostagem' => $postagem->id]) }}"
                                                            method="post">
                                                            <div class="input-group"
                                                                    style="font-size: 16px;margin-top:  20px;">
                                                                @csrf
                                                                <input type="text" id="txtComentarioPostagem"
                                                                        class="form-control bg-light box-shadow rounded-10 text-primary mx-auto p-2"
                                                                        name="conteudo" aria-describedby="helpId"
                                                                        placeholder="Escreva um comentário"
                                                                        style="border-right: 0px;font-weight: normal;border-radius: 10px 0px 0px 10px;">
                                                                <div
                                                                    class="input-group-append bg-light box-shadow rounded-10 text-secondary m-0"
                                                                    style="border-left: 0px;box-shadow: -3px 3px 6px rgba(0,0,0,0.16);">
                                                                    <button type="submit"
                                                                            onclick="enviarComentarioPostagem({{ $postagem->id }});"
                                                                            class="btn bg-light text-primary btn-block"
                                                                            style="color: #798ac4;border-radius: 0px 10px 10px 0px;background-color: #272A3B;">
                                                                        <i class="fas fa-paper-plane"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    @endforeach


                                </div>

                            </div>
                        </div>

                    </div>

                    @if(Request::is('gestao/turma/*') && ($turma->user_id == Auth::user()->id || Auth::user()->permissao == "Z"))
                        <div class="tab-pane fade w-100" id="aplicacao" role="tabpanel" aria-labelledby="aplicacao-tab">
                            <div class="">
                                <div class="row pt-2">

                                    <div class="col-12">

                                        <form id="formLiberarAplicacao"
                                                action="{{ route('gestao.aplicacao-liberar', ['idTurma' => $turma->id]) }}"
                                                enctype="multipart/form-data" method="post">

                                            @csrf

                                            <div class="form-group mb-3 text-left">
                                                <label hidden class="" for="cmbLiberarAplicacao">Escolha qual aplicação
                                                    deseja liberar</label>
                                                <select id="cmbLiberarAplicacao" name="idAplicacao" required
                                                        class="custom-select rounded">
                                                    <option disabled selected value="">Escolha qual aplicação deseja
                                                        liberar
                                                    </option>
                                                    @foreach ($aplicacoes as $aplicacao)
                                                        <option
                                                            value="{{ $aplicacao->id }}">{{ ucfirst($aplicacao->titulo) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <h5 class="my-3">
                                                Para quais alunos?
                                            </h5>

                                            <div class="form-group my-3 text-center">
                                                <select name="quais" required
                                                        class="custom-select border-primary bg-primary font-weight-bold text-light text-uppercase rounded"
                                                        style="text-align-last: center;">
                                                    <option value="todos">Todos</option>
                                                    <option value="nenhum">Nenhum</option>
                                                </select>
                                            </div>

                                            <h5>
                                                Exceto:
                                            </h5>

                                            <div class="form-group mb-3 text-left">
                                                <select id="cmbAlunos" name="aluno_id"
                                                        class="selectpicker rounded w-100" data-live-search="true"
                                                        title="Selecione os alunos" onchange="alunoSelecionado(this);">
                                                    @foreach ($alunos as $key => $aluno)
                                                        <option value="{{ $aluno->user->id }}"
                                                                data-name="{{ ucwords($aluno->user->name) }}"
                                                                data-content="{{ ucwords($aluno->user->name) }} • {{ $aluno->user->email }}">{{ $aluno->user->id }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div id="divAlunos">

                                            </div>

                                            <input type="hidden" name="alunos">

                                            <button type="submit"
                                                    class="btn btn-primary font-weight-bold px-4 text-lighter text-light float-right mb-5">
                                                Liberar aplicação
                                            </button>

                                        </form>

                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="tab-pane fade w-100" id="transmissao" role="tabpanel" aria-labelledby="transmissao-tab">

                            <div class="">

                                <div class="row pt-2">

                                    <div class="col-12">
                                        <form id="formNovaTransmissao"
                                                action="{{ route('gestao.transmissao-nova', ['idTurma' => $turma->id]) }}"
                                                enctype="multipart/form-data" method="post">

                                            @csrf

                                            <h5 class="mb-3">
                                                Selecione o tipo de transmissão:
                                            </h5>

                                            <div class="form-group my-3 text-center">
                                                <select name="tipo" required
                                                        class="custom-select border-primary bg-primary font-weight-bold text-light text-uppercase rounded"
                                                        style="text-align-last: center;"
                                                        onchange="mudouTipoTransmissao(this);">
                                                    <option value="1">Aplicação</option>
                                                    <option value="2">Conteúdo</option>
                                                </select>
                                            </div>

                                            <div id="divTransmissaoAplicacao" class="form-group mb-3 text-left">
                                                <select name="idAplicacao" required class="custom-select rounded">
                                                    <option disabled selected value="">Escolha qual aplicação deseja
                                                        transmitir
                                                    </option>
                                                    @foreach ($aplicacoes as $aplicacao)
                                                        <option
                                                            value="{{ $aplicacao->id }}">{{ ucfirst($aplicacao->titulo) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div id="divTransmissaoConteudo" class="form-group mb-3 text-left d-none">
                                                <select name="idConteudo" class="custom-select rounded">
                                                    <option disabled selected value="">Escolha qual conteúdo deseja
                                                        transmitir
                                                    </option>
                                                    @foreach ($conteudos as $conteudo)
                                                        <option
                                                            value="{{ $conteudo->id }}">{{ ucfirst($conteudo->titulo) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group mb-3 text-left">
                                                <h5 for="txtCodigoTransmissao" class="my-4">Código da transmissão</h5>

                                                <input type="text" class="form-control text-uppercase" maxlength="15"
                                                        name="codigo" id="txtCodigoTransmissao"
                                                        placeholder="Clique para digitar." required>
                                            </div>

                                            <button type="button" onclick="gerarToken();"
                                                    class="btn btn-primary font-weight-bold px-3 mb-4 text-uppercase">
                                                GERAR CÓDIGO
                                            </button>

                                            <div class="form-group mb-3 text-left">
                                                <h5 for="txtDescricaoTransmissao">Descrição da
                                                    transmissão
                                                    <small>(opcional)</small>
                                                </h5>
                                                <textarea class="form-control" name="descricao"
                                                            id="txtDescricaoTransmissao" rows="3"
                                                            placeholder="Clique para digitar."></textarea>
                                            </div>

                                            <button type="submit"
                                                    class="btn btn-primary font-weight-bold px-3 text-uppercase my-3">
                                                CRIAR TRANSMISSÃO
                                            </button>

                                        </form>

                                    </div>
                                </div>

                                <div class="row">

                                    <div class="container">

                                        <h5 class="text-left mb-3">
                                            Suas transmissões:
                                        </h5>

                                        <div class="row">
                                            @foreach ($transmissoes as $transmissao)
                                                <div id="divTransmissao{{ $transmissao->id }}" class="col-sm-12 col-md-6">
                                                    <div class="card col-12 rounded text-decoration-none h-100 border-0">

                                                    <div class="py-3 px-4 h-100">

                                                        <span class="d-block mb-2">
                                                            Código: <b>{{ mb_strtoupper($transmissao->token, 'utf-8') }}</b>
                                                        </span>

                                                        @if($transmissao->tipo == 1 && $transmissao->aplicacao != null)
                                                        <span class="d-block mb-2">
                                                        {{ ucfirst($transmissao->aplicacao->titulo) }}

                                                        </span>

                                                        <span class="d-block font-weight-bold" style="color: #B2AC83;">
                                                            <i class="fas fa-gamepad fa-fw mr-1"></i>
                                                            Aplicação
                                                        </span>

                                                        @else
                                                            <span class="d-block mb-2">
                                                        {{ ucfirst($transmissao->conteudo->titulo) }}
                                                        </span>
                                                                <span class="d-block font-weight-bold"
                                                                        style="color: #B2AC83;">
                                                        <i class="fas fa-file-alt fa-fw mr-1"></i>
                                                        Conteúdo
                                                        </span>
                                                        @endif
                                                    </div>

                                                        <button class="btn btn-link text-gray float-right p-2"
                                                                type="button" data-toggle="dropdown"
                                                                aria-haspopup="true" aria-expanded="false"
                                                                style="position: absolute;right: 0px;margin-right: 15px;">
                                                            <i class="fas fa-ellipsis-v"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a target="_blank"
                                                                href="{{ route('codigo-transmissao-token', ['token' => $transmissao->token]) }}"
                                                                class="btn btn-link dropdown-item">
                                                                Abrir transmissão
                                                            </a>
                                                            <button type="button"
                                                                    onclick="compartilharTransmissao('{{ $transmissao->token }}');"
                                                                    class="btn btn-link text-primary dropdown-item">
                                                                Copiar para o mural da turma
                                                            </button>
                                                            <button type="button"
                                                                    onclick="excluirTransmissao({{ $transmissao->id }});"
                                                                    class="btn btn-link text-danger dropdown-item">
                                                                Encerrar transmissão
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                    </div>
                                </div>

                            </div>

                        </div>

                    @endif

                    @include('gestao.mural.aba_frequencia')

                    <div class="tab-pane fade w-100" id="alunos" role="tabpanel" aria-labelledby="alunos-tab">

                        <div class="">

                            <div class="row mb-4">
                                <div class="col">

                                    @if(Request::is('gestao/turma/*') && ($turma->user_id == Auth::user()->id || Auth::user()->permissao == "Z"))
                                        <button id="btnGerarConvite2" type="submit" onclick="gerarLinkConvite();"
                                                class="btn bg-primary px-4 text-dark font-weight-bold mb-3 {{ $turma->codigo_convite == null ? '' : 'd-none' }}">
                                            Gerar link de convite
                                        </button>
                                        <div id="divLinkConvite2" class="input-group mb-3 {{ $turma->codigo_convite != null ? '' : 'd-none' }}">
                                            <div id="lblLinkConvite2" class="form-control bg-card border-0 rounded-sm text-wrap shadow-sm">
                                                <span class="text-gray">Link de convite: </span>
                                                {{ route('turma-convite', ['idTurma' => $turma->id, 'idConvite' => $turma->codigo_convite]) }}
                                            </div>
                                        </div>
                                    @endif

                                </div>
                                @if(Request::is('gestao/turma/*') && ($turma->user_id == Auth::user()->id || Auth::user()->permissao == "Z"))
                                    <div class="col-auto">
                                        <button type="button" onclick="showModalConvidarAlunos();"
                                                class="btn bg-primary box-shadow rounded text-white font-weight-bold float-right">
                                            <i class="fas fa-plus fa-fw mr-2"></i>
                                            Convidar alunos
                                        </button>
                                    </div>

                                    <!-- Modal Convidar alunos -->
                                    <div class="modal fade" id="divModalConvidarAlunos" tabindex="-1" role="dialog"
                                            aria-hidden="true" data-keyboard="false" data-backdrop="static">
                                        <div class="modal-dialog modal-dialog-centered px-1 px-md-5" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>

                                                    <form id="formConvidarAlunos" method="POST"
                                                            action="{{ route('gestao.turma-convidar-alunos', ['idTurma' => $turma->id]) }}"
                                                            class="text-center px-3 shadow-none border-0">

                                                        @csrf

                                                        <div id="divEnviando" class="text-center d-none">
                                                            <i class="fas fa-spinner fa-pulse fa-3x text-primary mb-3"></i>
                                                            <h4>Enviando convites</h4>
                                                        </div>

                                                        <div id="divEditar" class="form-page">

                                                            <h5 class="my-4">Convidar alunos</h5>

                                                            <button id="btnGerarConvite3" type="button"
                                                                    onclick="gerarLinkConvite();"
                                                                    class="btn bg-bluelight btn-block text-dark font-weight-bold mb-3 {{ $turma->codigo_convite == null ? '' : 'd-none' }}">
                                                                Gerar link de convite
                                                            </button>
                                                            <div id="divLinkConvite3" class="text-left mt-2 mb-3 {{ $turma->codigo_convite != null ? '' : 'd-none' }}">
                                                                Você pode convidar seus alunos utilizando o link abaixo:
                                                                <br><br>

                                                                <div id="lblLinkConvite3"
                                                                        class="form-control bg-lightgray border-0 rounded-0 text-wrap shadow-md">
                                                                    {{ route('turma-convite', ['idTurma' => $turma->id, 'idConvite' => $turma->codigo_convite]) }}
                                                                </div>
                                                            </div>

                                                            <hr>

                                                            <div id="divCampos">
                                                                <div class="form-group mb-3 text-left">
                                                                    <input type="text" class="form-control shadow-sm"
                                                                            name="email_aluno1"
                                                                            id="txtTituloNovoConteudo"
                                                                            placeholder="E-mail do aluno." required>
                                                                </div>

                                                                <div class="form-group mb-3 text-left">
                                                                    <input type="text" class="form-control shadow-sm"
                                                                            name="email_aluno2"
                                                                            id="txtTituloNovoConteudo"
                                                                            placeholder="E-mail do aluno.">
                                                                </div>

                                                                <div class="form-group mb-3 text-left">
                                                                    <input type="text" class="form-control shadow-sm"
                                                                            name="email_aluno3"
                                                                            id="txtTituloNovoConteudo"
                                                                            placeholder="E-mail do aluno.">
                                                                </div>
                                                            </div>

                                                            <button type="button"
                                                                onclick="adicionarCampoConvidarAluno();"
                                                                class="btn btn-outline-secondary btn-block font-weight-bold">
                                                                Adicionar campo
                                                            </button>

                                                            <div class="row mb-2">
                                                                <button type="button" data-dismiss="modal"
                                                                        class="btn btn-danger btn-block mt-4 mb-0 col-4 ml-auto mr-4 font-weight-bold">
                                                                    Cancelar
                                                                </button>
                                                                <button type="submit" onclick="criarTurma();"
                                                                        class="btn btn-primary btn-block mt-4 mb-0 col-4 ml-4 mr-auto font-weight-bold">
                                                                    Enviar
                                                                </button>
                                                            </div>

                                                        </div>

                                                    </form>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- Fim modal convidar alunos -->
                                @endif
                            </div>

                            <div>

                                <!-- Inicio tabela de alunos -->
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead class="thead-default">
                                        <tr>
                                            <th class="">Nome</th>
                                            @if(Auth::user()->permissao != "A")
                                                <th class="">E-mail</th>
                                            @endif
                                            @if(Request::is('gestao/turma/*') && ($turma->user_id == Auth::user()->id || Auth::user()->permissao == "Z"))
                                                <th class="w-25">Ações</th>
                                            @endif
                                        </tr>
                                        </thead>
                                        <tbody class="bg-card">

                                        @if(count($alunos) > 0)
                                            @foreach ($alunos as $aluno)

                                                <tr class="rounded shadow-sm">
                                                    <td>{{ ucwords($aluno->user->name) }}</td>
                                                    @if(Auth::user()->permissao != "A")
                                                        <td>{{ $aluno->user->email }}</td>
                                                    @endif
                                                    @if(Request::is('gestao/turma/*') && ($turma->user_id == Auth::user()->id || Auth::user()->permissao == "Z"))
                                                        <td>
                                                            <button type="button"
                                                                    onclick="removerAluno({{ $aluno->user->id }}, this);"
                                                                    class="btn btn-sm text-white btn-decline">
                                                                <i class="fas fa-times"></i>
                                                            </button>
                                                        </td>
                                                    @endif
                                                </tr>
                                                {{--  <tr class="spacer" style="height: 10px;"></tr>  --}}

                                            @endforeach
                                        @else

                                            <tr class="rounded shadow-sm">
                                                <td colspan="4" class="align-middle">Não há alunos nesta turma.</td>
                                            </tr>
                                            {{--  <tr class="spacer" style="height: 10px;"></tr>  --}}

                                        @endif

                                        </tbody>
                                    </table>
                                </div>
                                <!-- Fim tabela de alunos -->

                                <!-- Paginação -->
                                <div class="mx-auto">

                                    @if(count($alunos) > 0)
                                        <nav class="px-auto small mt-2 mx-auto text-center py-1 pb-0"
                                                aria-label="Page navigation example" style="margin: 0px -32px;">
                                            <ul class="pagination mb-0 d-inline-flex">
                                                @if($alunos->currentPage() > 2)
                                                    <li class="page-item ml-auto"><a
                                                            href="{{ $alunos->url(0) }}&qt={{ $amount }}"
                                                            class="page-link">Primeira</a></li>
                                                @endif
                                                @if($alunos->currentPage() > 1)
                                                    <li class="page-item ml-auto"><a
                                                            href="{{ $alunos->previousPageUrl() }}&qt={{ $amount }}"
                                                            class="page-link">Anterior</a></li>
                                                @endif
                                                @for($i = 0; $i < $alunos->lastPage(); $i ++)
                                                    <li class="page-item {{ $alunos->currentPage() != $i + 1 ?: 'active' }}">
                                                        <a href="{{ $alunos->url($i+1) }}&qt={{ $amount }}"
                                                            class="page-link">{{ $i + 1 }}</a></li>
                                                @endfor
                                                @if($alunos->currentPage() < $alunos->lastPage())
                                                    <li class="page-item mr-auto"><a
                                                            href="{{ $alunos->nextPageUrl() }}&qt={{ $amount }}"
                                                            class="page-link">Próxima</a></li>
                                                @endif
                                                @if($alunos->currentPage() < $alunos->lastPage() - 1)
                                                    <li class="page-item mr-auto"><a
                                                            href="{{ $alunos->url( $alunos->lastPage() ) }}&qt={{ $amount }}"
                                                            class="page-link">Última</a></li>
                                                @endif
                                            </ul>
                                        </nav>
                                    @endif
                                </div>
                                <!-- Fim paginação -->

                            </div>

                        </div>

                    </div>

                </div>


            </div>
        </div>
    </main>

@endsection

@section('bodyend')

    <!-- Bootstrap Select JavaScript -->
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>

    <!-- Bootstrap Datepicker JS -->
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/locales/bootstrap-datepicker.pt-BR.min.js"></script>

    <!-- Summernote css/js -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/lang/summernote-pt-BR.min.js" crossorigin="anonymous"></script>

    <!-- Bootstrap Date Picker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha256-bqVeqGdJ7h/lYPq6xrPv/YGzMEb6dNxlfiTUHSgRCp8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.pt-BR.min.js" integrity="sha256-QN6KDU+9DIJ/9M0ynQQfw/O90ef0UXucGgKn0LbUtq4=" crossorigin="anonymous"></script>

    <!-- Bootstrap select -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.10/js/bootstrap-select.min.js" integrity="sha256-FXzZGmaRFZngOjUKy3lWZJq/MflaMpffBbu3lPT0izE=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.10/js/i18n/defaults-pt_BR.min.js" integrity="sha256-E6oZQilh8z865CDmEuhd04HboHLDslH/HvOsN+3wxdk=" crossorigin="anonymous"></script>

    <!-- Mask JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>

    <!-- Moment JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js" integrity="sha256-4iQZ6BVL4qNKlQ27TExEhBN1HFPvAvAMbFavKKosSWQ=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/locale/pt-br.js" integrity="sha256-aIToY7VLU5x+toAJcyINV0WEogFBCIVeeWhyUbCaYiQ=" crossorigin="anonymous"></script>

    <!-- Jquery Date Range Picker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-date-range-picker/0.20.0/jquery.daterangepicker.min.js" integrity="sha256-qQx2CIbSRccEP6dedJGT0WHKhX0WhZi8crKw6TzfUeI=" crossorigin="anonymous"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

    <script src="{{ env('APP_URL') }}/assets/js/pages/gestao/turmas/mural.min.js"></script>

    <script>




        function gerarLinkConvite(ckb) {
            $.ajax({
                url: '{{ route('gestao.turma-gerar-convite', ['idTurma' => $turma->id]) }}',
                type: 'get',
                dataType: 'json',
                success: function (_response) {
                    console.log(_response);

                    if (_response.success) {
                        //swal("Yeah!", _response.success, "success");
                        $("#btnGerarConvite").addClass('d-none');
                        $("#btnGerarConvite2").addClass('d-none');
                        $("#btnGerarConvite3").addClass('d-none');
                        $("#divLinkConvite").removeClass('d-none');
                        $("#divLinkConvite2").removeClass('d-none');
                        $("#divLinkConvite3").removeClass('d-none');
                        $("#lblLinkConvite").text(_response.link);
                        $("#lblLinkConvite2").text(_response.link);
                        $("#lblLinkConvite3").text(_response.link);
                    } else {
                        swal("Ops!", _response.error, "error");
                    }
                },
                error: function (_response) {
                    console.log(_response);
                }
            });
        }

        function anexouArquivo(input) {
            if (input.value != null && input.value != "") {
                $("#lblNomeArquivo").text(input.value.split(/(\\|\/)/g).pop());
            } else {
                $("#lblNomeArquivo").text("");
            }
        }

        function removerAluno(user, button) {
            swal({
                title: "Remover",
                text: "Você deseja mesmo remover este aluno?",
                icon: "warning",
                buttons: ["Não", "Sim"],
                dangerMode: true,
            })
                .then((deletar) => {
                    if (deletar) {
                        $.ajax({
                            url: appurl + '/gestao/turma/{{ $turma->id }}/alunos/' + user + '/remover',
                            type: 'get',
                            dataType: 'json',
                            success: function (_response) {
                                console.log(_response);

                                if (_response.success) {
                                    swal("Yeah!", _response.success, "success");

                                    $(button.parentNode.parentNode).remove();
                                } else {
                                    swal("Ops!", _response.error, "error");
                                }
                            },
                            error: function (_response) {
                                console.log(_response);
                            }
                        });
                    }
                });
        }

        function showModalConvidarAlunos() {
            $('#divCampos').html(`<div class="form-group mb-3 text-left">
        <input type="text" class="form-control" name="email_aluno1" id="txtTituloNovoConteudo" placeholder="E-mail do aluno." required>
    </div>

    <div class="form-group mb-3 text-left">
        <input type="text" class="form-control" name="email_aluno2" id="txtTituloNovoConteudo" placeholder="E-mail do aluno.">
    </div>

    <div class="form-group mb-3 text-left">
        <input type="text" class="form-control" name="email_aluno3" id="txtTituloNovoConteudo" placeholder="E-mail do aluno.">
    </div>`);

            $("#divBtnAdicionarCampoEmail").removeClass('d-none');

            $("#divModalConvidarAlunos").modal("show");
        }

        function adicionarCampoConvidarAluno() {
            var count = $("#divCampos > div").length + 1;

            if (count > 10) {
                $("#divBtnAdicionarCampoEmail").addClass('d-none');

                return;
            }


            $("#divCampos").append(`<div class="form-group mb-3 text-left">
        <input type="text" class="form-control" name="email_aluno${count}" placeholder="E-mail do aluno.">
    </div>`);
        }

            @if(Request::is('gestao/turma/*') && ($turma->user_id == Auth::user()->id || Auth::user()->permissao == "Z"))

        var alunosSelecionados = [];

        function alunoSelecionado(cmb) {
            $("#divAlunos").append(`<div id="divAluno${cmb.value}" class="aluno-liberacao mr-3" data-id="${cmb.value}">
            ${$("#cmbAlunos option:selected").data("name")}
            <button type="button" onclick="removerAluno(${cmb.value});" class="btn bg-transparent p-0 ml-2 align-middle my-auto text-white">
                <i class="fas fa-times fa-fw fa-sm"></i>
            </button>
        </div>`);

            alunosSelecionados.push(cmb.value);

            $("#cmbAlunos option:selected").attr('disabled', 'true');

            $("#cmbAlunos").val(null);

            atualizarAlunos();
        }

        function removerAluno(id) {
            alunosSelecionados = alunosSelecionados.filter(function (value, index, arr) {

                return value != id;

            });

            $("#divAluno" + id).remove();

            $('#cmbAlunos option[value="' + id + '"]').removeAttr('disabled');

            atualizarAlunos();
        }

        function atualizarAlunos() {
            $("#formLiberarAplicacao [name='alunos']").val(JSON.stringify(alunosSelecionados));

            console.log($("#formLiberarAplicacao [name='alunos']").val());
        }

        function mudouTipoTransmissao(cmb) {
            if (cmb.value == 1) {
                $("#divTransmissaoAplicacao").removeClass('d-none');
                $("#divTransmissaoAplicacao select").attr('required', 'true');

                $("#divTransmissaoConteudo").addClass('d-none');
                $("#divTransmissaoConteudo select").removeAttr('required');
            } else {
                $("#divTransmissaoConteudo").removeClass('d-none');
                $("#divTransmissaoConteudo select").attr('required', 'true');

                $("#divTransmissaoAplicacao").addClass('d-none');
                $("#divTransmissaoAplicacao select").removeAttr('required');
            }
        }

        function gerarToken() {
            $.ajax({
                url: '{{ env('APP_LOCAL') }}' + '/gestao/transmissao/gerar-token',
                type: 'get',
                dataType: 'json',
                success: function (_response) {
                    //console.log( _response );

                    if (_response.success && _response.token != null) {
                        $("#txtCodigoTransmissao").val(_response.token);
                    } else {
                        swal("Ops!", _response.error, "error");
                    }
                },
                error: function (_response) {
                    console.log(_response);
                }
            });
        }

        function excluirTransmissao(idTransmissao) {
            swal({
                title: "Encerrar transmissão",
                text: "Você deseja mesmo encerrar esta transmissão?",
                icon: "warning",
                buttons: ["Não", "Sim"],
                dangerMode: true,
            })
                .then((deletar) => {
                    if (deletar) {
                        $.ajax({
                            url: '{{ env('APP_LOCAL') }}' + '/gestao/transmissao/' + idTransmissao + '/excluir',
                            type: 'post',
                            data: {'_token': '{{ csrf_token() }}'},
                            dataType: 'json',
                            success: function (_response) {
                                console.log(_response);

                                if (_response.success) {
                                    swal("Yeah!", _response.success, "success");

                                    $("#divTransmissao" + idTransmissao).remove();
                                } else {
                                    swal("Ops!", _response.error, "error");
                                }
                            },
                            error: function (_response) {
                                console.log(_response);
                            }
                        });
                    }
                });
        }

        function compartilharTransmissao(codigo) {
            $(".nav-link[href='#mural']").tab('show');
            $("#txtConteudo").summernote("code", "Acessem a nova transmissão na barra lateral inserindo o código de aula: <span class='text-uppercase text-primary font-weight-bold'>" + codigo + "</span>");
        }

        @endif

    </script>

@endsection
