@extends('layouts.master')

@section('title', 'J. PIAGET - Configurações de conta')

@section('headend')

    <!-- Custom styles for this template -->
    <style>
        main{
            padding-top:0!important;
        }
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
            color: black;
            font-weight: normal;
        }

        .nav-pills > a.nav-link.active {
            color: #207adc !important;
            font-weight: bold;
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
            background-blend-mode: multiply;
            width: 160px;
            height: 160px;
            -webkit-border-radius: 80px;
            -moz-border-radius: 80px;
            border-radius: 80px;
            cursor: pointer;
            transition: 0.2s all ease-in-out;
        }

        .input-file-custom-avatar:hover {
            color: #fff !important;
            background: rgba(32, 122, 220, 0.7) url({{ route('usuario.perfil.image', [$user->id]) }}) 50% 50% no-repeat;
            background-size: cover;
            background-blend-mode: multiply;
        }


    </style>

@endsection

@section('content')


    <main role="main">

        <div class="container-fluid">

            <div class="row" style="min-height: calc(100vh - 114px);">

                <div class="col-12 col-md-3 pt-5 p-2 text-center" style="background: #F9F9F9;">

                    <h4 class="font-weight-bold">Configurações da Conta</h4>
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
                                <div><i class="fas fa-camera fa-lg"></i></div>
                                <div>ALTERAR FOTO</div>
                            </label>
                        </div>

                        <button id="btnSalvarFoto" type="button" onclick="salvarFotoPerfil();"
                                class="btn btn-success border-0 font-weight-bold py-2 mx-auto mb-5 d-none animated fadeIn">
                            Salvar foto
                        </button>

                        <h5 class="text-primary font-weight-bold mb-5">{{ ucwords( mb_strtolower( Auth::user()->name, 'UTF-8') ) }}</h5>

                    </div>

                    <hr class="mb-4">

                    <div
                        class="nav flex-column nav-pills py-2 mt-3 px-0 px-md-2 mx-0 mx-md-2 text-left font-weight-bold"
                        id="v-pills-tab" role="tablist" aria-orientation="vertical" style="font-size: 18px;">
                        <a class="nav-link py-1 px-1 mb-3 active" id="v-pills-home-tab" data-toggle="pill" href="#conta"
                           role="tab" aria-controls="v-pills-home" aria-selected="true">
                            Alterar e-mail ou senha
                        </a>
                        <a class="nav-link py-1 px-1 mb-3" id="v-pills-profile-tab" data-toggle="pill" href="#dados"
                           role="tab" aria-controls="v-pills-profile" aria-selected="false">
                            Alterar dados cadastrais
                        </a>
                        <a class="nav-link py-1 px-1 mb-3" id="v-pills-pagamentos-tab" data-toggle="pill" href="#pagamentos"
                           role="tab" aria-controls="v-pills-pagamentos" aria-selected="false">
                            Meus pagamentos
                        </a>
                        <a class="nav-link py-1 px-1 mb-3" id="v-pills-settings-tab" data-toggle="pill" href="#notificacoes"
                           role="tab" aria-controls="v-pills-settings" aria-selected="false">
                            Gerenciar notificações
                        </a>
                        {{--<a class="nav-link py-1 px-1 mb-3" href="{{ route('configuracao.avaliacoes') }}" role="tab"
                           aria-controls="v-pills-messages" aria-selected="false">
                            Avaliações
                        </a>--}}
                    </div>

                </div>

                <div class="col-12 col-md-9 p-5 px-lg-0" style="min-height: 100%; background-color: #fff;">

                    <div class="col-12 col-md-11 mx-auto">

                        <div class="tab-content" id="v-pills-tabContent">

                            <!-- alterar email ou senha -->
                            @include('pages.configuracoes-conta._email-senha')

                            <!-- dados cadastrais -->
                            @include('pages.configuracoes-conta._dados-cadastrais')

                            <!-- meus pagamentos -->
                            @include('pages.configuracoes-conta._meus-pagamentos')

                            <!-- notificações -->
                            @include('pages.configuracoes-conta._notificacoes')

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

        function painelShowTrocarSenha() {
            $('#formTrocarSenha').removeClass('d-none');
            $('#btnTrocarSenha').addClass('d-none');
        }

        function painelCloseTrocarSenha() {
            $('#formTrocarSenha').addClass('d-none');
            $('#btnTrocarSenha').removeClass('d-none');
            $("#formTrocarSenha > input").val("");
        }

        function alterouEmail() {
            $('#formTrocarEmail #btnSalvarAlteracoesEmail').removeClass('d-none');
            /*
            window.onbeforeunload = function () {
                return true;
            };
            */
        }

        function alterouDadosUsuario() {
            $('#formTrocarDados #btnSalvarAlteracoesDados').removeClass('d-none');
            /*
            window.onbeforeunload = function () {
                return true;
            };
            */
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

            /*window.onbeforeunload = null;*/

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
