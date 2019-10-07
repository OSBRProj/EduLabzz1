@extends('layouts.master')

@section('title', 'J. PIAGET - Configurações de conta')

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

            main > .row > .side-menu {
                height: 100%;
            }
        }

        main > .container-fluid {
            min-height: calc(100vh - 146px);
        }

        .option-menu .btn {
            color: #207adc !important;
            font-size: 18px;
            font-weight: bold;
            text-align: left;
            display: block;
        }

        .option-menu .btn, .option-menu .btn:hover {
            text-decoration: none;
        }

        .option-menu .btn.active {
            color: #525870 !important;
        }


        .nav-pills .nav-link.active, .nav-pills .show > .nav-link {
            background-color: transparent;
            color: #207adc;

        }


        .nav-tabs .nav-item {
            margin-bottom: 0;
        }

        .nav-tabs .nav-link {
            border: 0;
            font-size: 20px;
            color: #207adc;
            font-weight: bold;
            padding-bottom: 20px;
        }

        .nav-tabs .nav-link.active {
            color: #207adc;
            border-bottom: 4px solid #207adc;
            background: transparent;
        }

        .input-group > .form-control::placeholder {
            color: #ABABAB;
        }

        .input-group > .form-control {
            z-index: 3;
            color: #525870;
            background: #F3F3F3;
            border-top: 4px solid transparent !important;
            border-bottom: 4px solid transparent !important;
            box-shadow: none;
            font-weight: bold;
            font-size: 18px;
            width: auto;
        }

        .input-group > .custom-file:focus, .input-group > .custom-select:focus, .input-group > .form-control:focus {
            z-index: 3;
            background: #F3F3F3;
            border-bottom: 4px solid #207adc !important;
            box-shadow: none;
            color: #207adc;
            font-weight: bold;
        }

        .input-group-text {
            color: #ABABAB;
        }

        .nav-pills > a.nav-link {
            font-size: 20px;
            color: #207adc;
        }

        .nav-pills > a.nav-link.active {
            color: #207adc !important;
        }

        .input-file-custom-avatar {
            margin: 40px auto;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            color: transparent !important;
            background: url({{ route('usuario.perfil.image', [$user->id]) }}) 50% 50% no-repeat;
            background-size: cover;
            background-blend-mode: overlay;
            width: 160px;
            height: 160px;
            -webkit-border-radius: 80px;
            -moz-border-radius: 80px;
            border-radius: 80px;
            cursor: pointer;
        }

        .input-file-custom-avatar:hover {
            color: #fff;
            background: rgba(48, 58, 200, 0.7) url({{ route('usuario.perfil.image', [$user->id]) }}) 50% 50% no-repeat;
        }


    </style>

@endsection

@section('content')


    <main role="main">

        <div class="container-fluid">

            <div class="row" style="min-height: calc(100vh - 114px);">

                <div class="col-12 col-md-3 p-5 text-center" style="background: #F9F9F9;">

                    <h3 class="text-primary">Configurações da Conta</h3>
                    {{--<p>--}}
                    {{--Não é você?--}}
                    {{--<a href="#" onclick="event.preventDefault(); confirmLogout();"--}}
                    {{--class="text-danger font-weight-bold text-uppercase border-0">sair</a>--}}
                    {{--</p>--}}

                    <div class="mx-auto">


                        <form class="" id="formTrocarFotoPerfil" method="POST"
                              action="{{ route('configuracao.trocar-foto') }}" enctype="multipart/form-data" hidden>
                            @csrf
                            <input type="file" class="custom-file-input" id="input_foto" name="foto" required
                                   style="top: 0;height:  100%; position: absolute; left: 0;"
                                   accept="image/jpg, image/jpeg, image/png" oninput="trocarFotoPerfil(this);">
                        </form>

                        <div class="d-flex justify-content-center">
                            <label for="input_foto" class="input-file-custom-avatar avatar-img">
                                <div><i class="fas fa-camera fa-lg text-white"></i></div>
                                <div>ALTERAR FOTO</div>
                            </label>
                        </div>

                        <button id="btnSalvarFoto" type="button" onclick="salvarFotoPerfil();"
                                class="btn btn-success border-0 font-weight-bold py-2 mx-auto mb-5 d-none animated fadeIn">
                            Salvar foto
                        </button>

                        <h4 class="text-primary mb-5">{{ ucwords( mb_strtolower( Auth::user()->name, 'UTF-8') ) }}</h4>

                    </div>

                    <hr class="mb-4">

                    <div
                        class="nav flex-column nav-pills py-2 mt-3 px-0 px-md-2 mx-0 mx-md-2 text-left font-weight-bold"
                        id="v-pills-tab" role="tablist" aria-orientation="vertical" style="font-size: 18px;">
                        <a class="nav-link py-3 mb-3 active" id="v-pills-home-tab" data-toggle="pill" href="#conta"
                           role="tab" aria-controls="v-pills-home" aria-selected="true">
                            Alterar e-mail ou senha
                        </a>
                        <a class="nav-link py-3 mb-3" id="v-pills-profile-tab" data-toggle="pill" href="#dados"
                           role="tab" aria-controls="v-pills-profile" aria-selected="false">
                            Alterar dados cadastrais
                        </a>
                        <a class="nav-link py-3 mb-3" id="v-pills-settings-tab" data-toggle="pill" href="#pagamentos"
                           role="tab" aria-controls="v-pills-settings" aria-selected="false">
                            Meus pagamentos
                        </a>
                        <a class="nav-link py-3 mb-3" id="v-pills-settings-tab" data-toggle="pill" href="#notificacoes"
                           role="tab" aria-controls="v-pills-settings" aria-selected="false">
                            Gerenciar notificações
                        </a>
                        {{--<a class="nav-link py-3 mb-3" href="{{ route('configuracao.avaliacoes') }}" role="tab"
                           aria-controls="v-pills-messages" aria-selected="false">
                            Avaliações
                        </a>--}}
                    </div>

                </div>

                <div class="col-12 col-md-9 p-5 px-lg-0" style="min-height: 100%; background-color: #fff;">

                    <div class="col-8 px-2 px-lg-0 mx-auto mt-5">

                        <div class="tab-content" id="v-pills-tabContent">

                            <!-- alterar email ou senha -->
                            <div class="tab-pane fade show active" id="conta" role="tabpanel"
                                 aria-labelledby="v-pills-home-tab">

                                <h5 class="mb-4 font-weight-bold" style="color: #60748A;">
                                    Trocar endereço de e-mail
                                </h5>

                                <form id="formTrocarEmail" action="{{ route('configuracao.trocar-email') }}"
                                      method="post" class="mb-5">
                                    @csrf
                                    <div class="input-group mb-4">
                                        <input type="email" name="email" value="{{ $user->email }}"
                                               class="form-control bg-lightgray px-5 py-3 border-0 rounded-10"
                                               placeholder="E-mail"
                                               required onchange="alterouEmail()">
                                    </div>
                                    <button type="submit" onclick="window.onbeforeunload = null;"
                                            id="btnSalvarAlteracoesEmail"
                                            class="btn bg-primary border-0 rounded-10 font-weight-bold text-white btn-block px-5 py-3 mb-2 d-none">
                                        Salvar alterações
                                    </button>
                                </form>


                                <form id="formTrocarSenha" action="{{ route('configuracao.trocar-senha') }}"
                                      method="post" class="mb-2">
                                    @csrf

                                    <h5 class="my-4 font-weight-bold" style="color: #60748A">
                                        Alterar senha
                                    </h5>

                                    <div class="input-group mb-4">
                                        <input type="password" name="senha_atual" id="txtSenhaAntiga" value
                                               class="form-control border-0 bg-lightgray rounded-10 px-5 py-3"
                                               placeholder="Senha atual" required>
                                    </div>

                                    <div class="input-group mb-4">
                                        <input type="password" name="senha_nova" id="txtNovaSenha" value
                                               class="form-control border-0 bg-lightgray rounded-10 px-5 py-3"
                                               placeholder="Nova senha" required>
                                    </div>

                                    <div class="input-group mb-4">
                                        <input type="password" name="senha_confirmacao" id="txtConfirmarSenha" value
                                               class="form-control border-0 bg-lightgray rounded-10 px-5 py-3"
                                               placeholder="Confirmar nova senha" required>
                                    </div>

                                    <button type="button" onclick="salvarSenha();"
                                            class="btn bg-primary border-0 rounded-10 text-white font-weight-bold btn-block px-5 py-3">
                                        Salvar alterações
                                    </button>

                                </form>

                            </div>
                            <!-- alterar email ou senha -->


                            <!-- dados cadastrais -->
                            <div class="tab-pane fade" id="dados" role="tabpanel" aria-labelledby="v-pills-profile-tab">

                                <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                                    <li class="nav-item mx-auto">
                                        <a class="nav-link active" id="dados_pessoais-tab" data-toggle="tab"
                                           href="#dados_pessoais"
                                           role="tab" aria-controls="dados_pessoais" aria-selected="true">Dados
                                            Pessoais</a>
                                    </li>
                                    <li class="nav-item mx-auto">
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#endereco"
                                           role="tab" aria-controls="profile" aria-selected="false">Endereço</a>
                                    </li>
                                </ul>

                                <div class="tab-content" id="myTabContent">

                                    <div class="tab-pane fade show active" id="dados_pessoais" role="tabpanel"
                                         aria-labelledby="dados_pessoais-tab">
                                        <form id="formTrocarDados" action="{{ route('configuracao.salvar-dados') }}"
                                              method="post">
                                            @csrf

                                            <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                    <span
                                                        class="input-group-text bg-lightgray border-0 rounded-0"
                                                        id="basic-addon1">
                                                        Nome
                                                    </span>
                                                </div>
                                                <input type="name" name="name" value="{{ $user->name }}"
                                                       class="form-control bg-lightgray border-0 rounded-0 px-5 py-3"
                                                       placeholder="Nome" required
                                                       onchange="alterouDadosUsuario()">
                                            </div>

                                            {{--<div class="input-group mb-4">--}}
                                            {{--<div class="input-group-prepend">--}}
                                            {{--<span class="input-group-text bg-lightgray border-0 rounded-0"--}}
                                            {{--id="basic-addon1">--}}
                                            {{--Nome Completo--}}
                                            {{--</span>--}}
                                            {{--</div>--}}
                                            {{--<input type="name" name="nome_completo"--}}
                                            {{--value="{{ $user->nome_completo }}"--}}
                                            {{--class="form-control bg-lightgray border-0 rounded-0"--}}
                                            {{--placeholder="Clique aqui para digitar." required--}}
                                            {{--onchange="alterouDadosUsuario()">--}}
                                            {{--</div>--}}

                                            <div class="row">

                                                <div class="col-lg-6 col-md-6 col-xs-12" style="display:none">
                                                    <div class="input-group mb-4">
                                                        <div class="input-group-prepend">
                                                        <span class="input-group-text bg-lightgray border-0 rounded-0"
                                                              id="basic-addon1">
                                                            Sexo
                                                        </span>
                                                        </div>
                                                        <select readonly name="genero" id="cmbGenero"
                                                                onchange="alterouDadosUsuario();"
                                                                class="form-control custom-select false-input border-0 bg-green-darker2 d-inline-block text-green-lighter px-5 py-3"
                                                                style="width: auto;">
                                                            <option
                                                                value="Feminino" {{ strtolower($user->genero) == "feminino" ? 'selected=true' : '' }}>
                                                                Feminino
                                                            </option>
                                                            <option
                                                                value="Masculino" {{ strtolower($user->genero) == "masculino" ? 'selected=true' : '' }}>
                                                                Masculino
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-md-6 col-xs-12">
                                                    <div class="input-group mb-4">
                                                        <div class="input-group-prepend">
                                                    <span
                                                        class="input-group-text bg-lightgray border-0 rounded-0"
                                                        id="basic-addon1">
                                                        Data de Nasc.
                                                    </span>
                                                        </div>
                                                        <input type="text" name="data_nascimento"
                                                               onchange="alterouDadosUsuario();"
                                                               value="{{ date('d/m/Y', strtotime(ucfirst($user->data_nascimento))) }}"
                                                               class="form-control bg-lightgray border-0 rounded-0 px-5 py-3 date"
                                                               placeholder="Data de Nascimento">
                                                    </div>
                                                </div>

                                            </div>

                                            {{--<div class="input-group mb-4">--}}
                                            {{--<div class="input-group-prepend">--}}
                                            {{--<span class="input-group-text bg-lightgray border-0 rounded-0"--}}
                                            {{--id="basic-addon1">--}}
                                            {{--Permissao--}}
                                            {{--</span>--}}
                                            {{--</div>--}}
                                            {{--<div class="form-control bg-lightgray border-0 rounded-0">--}}
                                            {{--{{ \App\User::PermissaoName($user->permissao) }}--}}
                                            {{--</div>--}}
                                            {{--</div>--}}


                                            {{--<div class="input-group mb-4">--}}
                                            {{--<div class="input-group-prepend">--}}
                                            {{--<span class="input-group-text bg-lightgray border-0 rounded-0"--}}
                                            {{--id="basic-addon1">--}}
                                            {{--Escola--}}
                                            {{--</span>--}}
                                            {{--</div>--}}
                                            {{--<div class="form-control bg-lightgray border-0 rounded-0">--}}
                                            {{--{{ ucfirst($user->escola->titulo) }}--}}
                                            {{--</div>--}}
                                            {{--</div>--}}


                                            {{--<div class="input-group mb-4">--}}
                                            {{--<div class="input-group-prepend">--}}
                                            {{--<span class="input-group-text bg-lightgray border-0 rounded-0"--}}
                                            {{--id="basic-addon1">--}}
                                            {{--Biografia--}}
                                            {{--</span>--}}
                                            {{--</div>--}}
                                            {{--<textarea name="descricao" id="" rows="10"--}}
                                            {{--class="form-control bg-lightgray border-0 rounded-0"--}}
                                            {{--placeholder="Clique aqui para digitar."--}}
                                            {{--onchange="alterouDadosUsuario()">{{ $user->descricao }}</textarea>--}}
                                            {{--</div>--}}

                                            <button type="button" onclick="salvarAlteracoesDados();"
                                                    id="btnSalvarAlteracoesDados"
                                                    class="btn bg-primary border-0 rounded-10 text-white font-weight-bold btn-block px-5 py-3 d-none">
                                                Salvar alterações
                                            </button>

                                        </form>
                                    </div>

                                    <div class="tab-pane fade" id="endereco" role="tabpanel"
                                         aria-labelledby="endereco-tab">

                                        <form id="formTrocarDados" action="{{ route('configuracao.salvar-dados') }}"
                                              method="post">
                                            @csrf

                                            <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                    <span
                                                        class="input-group-text bg-lightgray border-0 rounded-0"
                                                        id="basic-addon1">
                                                        CEP
                                                    </span>
                                                </div>
                                                <input type="text" name="cep" value="{{ $user->endereco->cep }}"
                                                       class="form-control bg-lightgray border-0 rounded-0 px-5 py-3"
                                                       placeholder="CEP" required
                                                       onchange="alterouDadosUsuario()">
                                            </div>

                                            <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                    <span
                                                        class="input-group-text bg-lightgray border-0 rounded-0"
                                                        id="basic-addon1">
                                                        Logradouro
                                                    </span>
                                                </div>
                                                <input type="text" name="logradouro" value="{{ $user->endereco->logradouro }}"
                                                       class="form-control bg-lightgray border-0 rounded-0 px-5 py-3"
                                                       placeholder="Logradouro" required
                                                       onchange="alterouDadosUsuario()">
                                            </div>

                                            <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                    <span
                                                        class="input-group-text bg-lightgray border-0 rounded-0"
                                                        id="basic-addon1">
                                                        Número
                                                    </span>
                                                </div>
                                                <input type="text" name="numero" value="{{ $user->endereco->numero }}"
                                                       class="form-control bg-lightgray border-0 rounded-0 px-5 py-3"
                                                       placeholder="numero" required
                                                       onchange="alterouDadosUsuario()">
                                            </div>

                                            <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                    <span
                                                        class="input-group-text bg-lightgray border-0 rounded-0"
                                                        id="basic-addon1">
                                                        Complemento
                                                    </span>
                                                </div>
                                                <input type="text" name="complemento" value="{{ $user->endereco->complemento }}"
                                                       class="form-control bg-lightgray border-0 rounded-0 px-5 py-3"
                                                       placeholder="complemento" required
                                                       onchange="alterouDadosUsuario()">
                                            </div>


                                            <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                    <span
                                                        class="input-group-text bg-lightgray border-0 rounded-0"
                                                        id="basic-addon1">
                                                        Bairro
                                                    </span>
                                                </div>
                                                <input type="text" name="bairro" value="{{ $user->endereco->bairro }}"
                                                       class="form-control bg-lightgray border-0 rounded-0 px-5 py-3"
                                                       placeholder="bairro" required
                                                       onchange="alterouDadosUsuario()">
                                            </div>


                                            <div class="row">

                                                <div class="col-lg-8 col-md-8 col-xs-12">
                                                    <div class="input-group mb-4">
                                                        <div class="input-group-prepend">
                                                    <span
                                                        class="input-group-text bg-lightgray border-0 rounded-0"
                                                        id="basic-addon1">
                                                        Cidade
                                                    </span>
                                                        </div>
                                                        <input type="text" name="cidade" value="{{ $user->endereco->cidade }}"
                                                               class="form-control bg-lightgray border-0 rounded-0 px-5 py-3"
                                                               placeholder="cidade" required
                                                               onchange="alterouDadosUsuario()">
                                                    </div>
                                                </div>

                                                <div class="col-lg-4 col-md-4 col-xs-12">
                                                    <div class="input-group mb-4">
                                                        <div class="input-group-prepend">
                                                        <span class="input-group-text bg-lightgray border-0 rounded-0"
                                                              id="basic-addon1">
                                                            UF
                                                        </span>
                                                        </div>
                                                        <select readonly name="uf" id="uf"
                                                                onchange="alterouDadosUsuario();"
                                                                class="form-control custom-select false-input border-0 bg-green-darker2 d-inline-block text-green-lighter px-5 py-3"
                                                                style="width: auto;">
                                                            <option
                                                                value="Feminino" {{ strtolower($user->genero) == "feminino" ? 'selected=true' : '' }}>
                                                                UF
                                                            </option>
                                                        </select>
                                                        <div class="form-control bg-lightgray border-0 rounded-0">
                                                            {{ ucfirst($user->genero) }}
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            {{--<div class="input-group mb-4">--}}
                                            {{--<div class="input-group-prepend">--}}
                                            {{--<span class="input-group-text bg-lightgray border-0 rounded-0"--}}
                                            {{--id="basic-addon1">--}}
                                            {{--Permissao--}}
                                            {{--</span>--}}
                                            {{--</div>--}}
                                            {{--<div class="form-control bg-lightgray border-0 rounded-0">--}}
                                            {{--{{ \App\User::PermissaoName($user->permissao) }}--}}
                                            {{--</div>--}}
                                            {{--</div>--}}


                                            {{--<div class="input-group mb-4">--}}
                                            {{--<div class="input-group-prepend">--}}
                                            {{--<span class="input-group-text bg-lightgray border-0 rounded-0"--}}
                                            {{--id="basic-addon1">--}}
                                            {{--Escola--}}
                                            {{--</span>--}}
                                            {{--</div>--}}
                                            {{--<div class="form-control bg-lightgray border-0 rounded-0">--}}
                                            {{--{{ ucfirst($user->escola->titulo) }}--}}
                                            {{--</div>--}}
                                            {{--</div>--}}


                                            {{--<div class="input-group mb-4">--}}
                                            {{--<div class="input-group-prepend">--}}
                                            {{--<span class="input-group-text bg-lightgray border-0 rounded-0"--}}
                                            {{--id="basic-addon1">--}}
                                            {{--Biografia--}}
                                            {{--</span>--}}
                                            {{--</div>--}}
                                            {{--<textarea name="descricao" id="" rows="10"--}}
                                            {{--class="form-control bg-lightgray border-0 rounded-0"--}}
                                            {{--placeholder="Clique aqui para digitar."--}}
                                            {{--onchange="alterouDadosUsuario()">{{ $user->descricao }}</textarea>--}}
                                            {{--</div>--}}

                                            <button type="button" onclick="salvarAlteracoesDados();"
                                                    id="btnSalvarAlteracoesDados"
                                                    class="btn bg-primary border-0 rounded-10 text-white font-weight-bold btn-block px-5 py-3 d-none">
                                                Salvar alterações
                                            </button>

                                        </form>

                                    </div>
                                </div>


                            </div>
                            <!-- dados cadastrais -->


                            <!-- notificações -->
                            <div class="tab-pane fade" id="notificacoes" role="tabpanel"
                                 aria-labelledby="v-pills-settings-tab">

                                <h5 class="mb-4 font-weight-bold">
                                    Notificações por e-mail
                                </h5>

                                <div class="custom-control custom-checkbox mb-3">
                                    <input type="checkbox" class="custom-control-input" id="ckbNotificacaoCursoNovo">
                                    <label class="custom-control-label" for="ckbNotificacaoCursoNovo">Receber
                                        notificações de cursos novos</label>
                                </div>

                                <div class="custom-control custom-checkbox mb-3">
                                    <input type="checkbox" class="custom-control-input"
                                           id="ckbNotificacaoRespostaProfessor">
                                    <label class="custom-control-label" for="ckbNotificacaoRespostaProfessor">Receber
                                        notificações de quando houver uma resposta do professor</label>
                                </div>

                                <div class="custom-control custom-checkbox mb-3">
                                    <input type="checkbox" class="custom-control-input"
                                           id="ckbNotificacaoPagamentoAprovado">
                                    <label class="custom-control-label" for="ckbNotificacaoPagamentoAprovado">Receber
                                        notificações de quando meus pagamentos forem aprovados</label>
                                </div>

                            </div>
                            <!-- notificações -->

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </main>

@endsection

@section('bodyend')

    <!-- Mask JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>

    <script>

        var estados = null;

        $(function () {
            $(".date").mask('00/00/0000');
            $(".cpf").mask('000.000.000-00');
            $(".rg").mask('00.000.000-A');
            $('.telefone').mask('(00) 0 0000-0000');
            $(".cep").mask('00000-000');

            var url = 'https://servicodados.ibge.gov.br/api/v1/localidades/estados';

            $.get(url, function (data) {
                //console.log( "Estados carregados com sucesso via API IBGE." );
                //console.log(data);
                window.estados = data;

                @if(isset($endereco))
                $("select#uf").val("{{ $endereco->uf }}");

                if (findValueWhere(estados, 'sigla', $("select#uf").val()) != null) {
                    var url = 'https://servicodados.ibge.gov.br/api/v1/localidades/estados/' + findValueWhere(estados, 'sigla', $("select#uf").val()).id + '/municipios';

                    $.get(url, function (data) {
                        console.log(data);

                        $("#cmbCidade").html("");

                        $("#cmbCidade").append("<option value=''>Selecione sua cidade</option>");

                        data.forEach(function (cidade) {

                            $("#cmbCidade").append("<option value='" + cidade.nome + "'>" + cidade.nome + "</option>");

                        });

                        @if(isset($endereco))
                        $("select#cmbCidade").val("{{ $endereco->cidade }}");
                        @endif
                    });
                } else {
                    console.log("Estado não encontrado na base de dados do IBGE");
                }
                @endif
            });

            if (window.location.hash) {
                $(".nav-link[href='" + window.location.hash + "']").tab('show');
            }

        });

        function selectEstado(element) {
            if (findValueWhere(estados, 'sigla', element.value) != null) {
                var url = 'https://servicodados.ibge.gov.br/api/v1/localidades/estados/' + findValueWhere(estados, 'sigla', element.value).id + '/municipios';

                $.get(url, function (data) {
                    console.log(data);

                    $("#cmbCidade").html("");

                    $("#cmbCidade").append("<option value=''>Selecione sua cidade</option>");

                    data.forEach(function (cidade) {

                        $("#cmbCidade").append("<option value='" + cidade.nome + "'>" + cidade.nome + "</option>");

                    });

                    @if(isset($endereco))
                    $("select#cmbCidade").val("{{ $endereco->cidade }}");
                    @endif

                });
            } else {
                console.log("Estado não encontrado na base de dados do IBGE");
            }

            alterouDadosUsuario();
        }

        function painelCloseTrocarSenha() {
            $('#formTrocarSenha').addClass('d-none');
            $('#btnTrocarSenha').removeClass('d-none');
            $("#formTrocarSenha > input").val("");
        }

        function alterouEmail() {
            $('#formTrocarEmail #btnSalvarAlteracoesEmail').removeClass('d-none');
            window.onbeforeunload = function () {
                return true;
            };
        }

        function alterouDadosUsuario() {
            $('#formTrocarDados #btnSalvarAlteracoesDados').removeClass('d-none');
            window.onbeforeunload = function () {
                return true;
            };
        }

        function salvarAlteracoesDados() {
            var preenchido = true;

            $("#formTrocarDados").find('#pessoal :input[required]').each(function () {
                if ($(this).val() == "") {
                    $(this).focus();
                    preenchido = false;
                    $('#formTrocarDados a[href="#pessoal"]').tab('show');
                    return false;
                }
            });

            $("#formTrocarDados").find('#endereco :input[required]').each(function () {
                if ($(this).val() == "") {
                    $(this).focus();
                    preenchido = false;
                    $('#formTrocarDados a[href="#endereco"]').tab('show');
                    return false;
                }
            });

            if (!preenchido) {
                return;
            }

            window.onbeforeunload = null;

            document.getElementById("formTrocarDados").submit();
        }

        function trocarFotoPerfil(input) {
            if (input.files && input.files[0]) {
                $("#btnSalvarFoto").addClass("d-block");

                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.avatar-img').attr('style', 'background: url(\'' + e.target.result + '\');background-size: cover;background-position: 50% 50%;background-repeat: no-repeat;');
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        function salvarFotoPerfil() {
            if ($("#formTrocarFotoPerfil input").val() == null) {
                $("#formTrocarFotoPerfil input").focus();

                return;
            }

            document.getElementById("formTrocarFotoPerfil").submit();
        }

        function painelShowTrocarSenha() {
            $('#formTrocarSenha').removeClass('d-none');
            $('#btnTrocarSenha').addClass('d-none');
        }

        function salvarSenha() {

            window.checarPreenchimento("#formTrocarSenha");

            if ($("#txtSenhaAntiga").val() == "" || $("#txtSenhaAntiga").val() == null) {
                $("#txtSenhaAntiga").focus();
                return;
            }

            if ($("#txtNovaSenha").val() == "" || $("#txtNovaSenha").val() == null) {
                $("#txtNovaSenha").focus();
                return;
            }

            if ($("#txtConfirmarSenha").val() == "" || $("#txtConfirmarSenha").val() == null) {
                $("#txtConfirmarSenha").focus();
                return;
            }

            if ($("#txtSenhaAntiga").val().toString().length < 6 || $("#txtNovaSenha").val().toString().length < 6) {
                $("#txtNovaSenha").focus();
                swal("Ops!", "Sua senha deve conter 6 ou mais caracteres!", "warning");
                return;
            }

            if ($("#txtSenhaAntiga").val() == $("#txtNovaSenha").val()) {
                $("#txtNovaSenha").focus();
                swal("Ops!", "Sua nova senha deve ser diferente da antiga!", "warning");
                return;
            }

            if ($("#txtNovaSenha").val() != $("#txtConfirmarSenha").val()) {
                $("#txtConfirmarSenha").focus();
                swal("Ops!", "A senha de confirmação deve ser igual a sua nova senha!", "warning");
                return;
            }

            document.getElementById("formTrocarSenha").submit();
        }

        async function consultarCEP(cep) {
            if (cep.length != 9) {
                return {'error': 'Cep inválido!'};
            }

            let response = await fetch("https://viacep.com.br/ws/" + cep + "/json/");

            let data = await response.json();

            console.log("Resultado CEP: ", data);

            return data;
        }

    </script>

@endsection
