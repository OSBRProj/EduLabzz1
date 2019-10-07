<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Descrição aqui">
    <meta name="author" content="Jean Piaget - Edulabzz">
    <link rel="icon" href="{{ env('APP_URL') }}/images/favicon.png">

    <title>J. PIAGET</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB"
        crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <!-- <link href="{{ env('APP_URL') }}/assets/css/login-custom.css" rel="stylesheet"> -->

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">

    <!-- Font Body -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>

    <!-- Font Edulabzz -->


    <!-- Custom styles main -->
    <link rel="stylesheet" href="{{ env('APP_URL') }}/assets/css/main.css">

    <style>

        body
        {
            padding-top: 10vh;
            padding-bottom: 40px;
            background-color: #F3F3F3;
        }

        .title
        {
            text-align: center;
            font-weight: 100;
            font-size: 60px;
            margin: 20px;
            margin-bottom: 8vh;
            transform: scale(0.8,1.5);
            color: #1d2850;
            position: absolute;
            left: 0px;
            top: 0px;
        }

    </style>

</head>

<body>

    <div class="container px-3 px-sm-3">

        <h1 class="title d-none d-xl-block" style="transform: none;">
            <img src="{{ env('APP_URL') }}/images/logo-preto.svg" height="60" alt="">
            {{-- <a class="navbar-brand mr-auto" href="#">
            </a> --}}
        </h1>

        <h1 class="col-12 d-block d-xl-none text-center mb-4" style="margin-top:  -50px;">
            <img src="{{ env('APP_URL') }}/images/logo-preto.svg" height="60" alt="">
            {{-- <a class="navbar-brand mr-auto" href="#">
            </a> --}}
        </h1>

        <form id="divPages" method="POST" action="{{ route('perfil-incompleto-salvar') }}" class="admin-box text-center px-3 px-sm-5">

            @csrf

            <div id="page1" class="form-page mx-2 mx-sm-5">

                <h5 class="font-weight-bold col-10 ml-auto mr-auto">
                    Dados pessoais
                    {{-- <span class="small d-block mt-3 text-green-lighter font-weight-normal">
                        Complemente suas informações
                    </span> --}}
                </h5>

                <div style="position: relative;">
                    <div class="text-center mt-4 mb-5">
                        <span class="step-indicator rounded-circle mx-3 done"><i class="fas fa-check"></i></span>
                        <span class="step-indicator rounded-circle mx-3 active">2</span>
                        <span class="step-indicator rounded-circle mx-3">3</span>
                        <span class="step-indicator rounded-circle mx-3">4</span>
                    </div>
                </div>

                <div class="input-group mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="fas fa-user fa-fw"></i>
                        </span>
                    </div>

                    <input id="nome_completo" type="text" placeholder="Nome Completo" class="form-control{{ $errors->has('nome_completo') ? ' is-invalid' : '' }}" name="nome_completo" value="{{ old('nome_completo') }}{{ Auth::user()->nome_completo }}" required autofocus>

                    @if ($errors->has('nome_completo'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('nome_completo') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="input-group mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="fas fa-user fa-fw"></i>
                        </span>
                    </div>

                    <input id="data_nascimento" type="text" placeholder="Data de nascimento" class="form-control{{ $errors->has('data_nascimento') ? ' is-invalid' : '' }} date" name="data_nascimento" value="{{ old('data_nascimento') }}{{ Auth::user()->data_nascimento }}" required>

                    @if ($errors->has('data_nascimento'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('data_nascimento') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="input-group mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="fas fa-user fa-fw"></i>
                        </span>
                    </div>

                    <input id="cpf" type="text" placeholder="CPF" class="form-control{{ $errors->has('cpf') ? ' is-invalid' : '' }} cpf" name="cpf" value="{{ old('cpf') }}{{ Auth::user()->cpf }}" required>

                    @if ($errors->has('cpf'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('cpf') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="input-group mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="fas fa-user fa-fw"></i>
                        </span>
                    </div>

                    <input id="rg" type="text" placeholder="RG" class="form-control{{ $errors->has('rg') ? ' is-invalid' : '' }} rg" name="rg" value="{{ old('rg') }}{{ Auth::user()->rg }}" required>

                    @if ($errors->has('rg'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('rg') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="input-group mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="fas fa-user fa-fw"></i>
                        </span>
                    </div>

                    <input id="telefone" type="text" maxlength="16" placeholder="Telefone" class="form-control{{ $errors->has('telefone') ? ' is-invalid' : '' }} telefone" name="telefone" value="{{ old('telefone') }}{{ Auth::user()->telefone }}" required>

                    @if ($errors->has('telefone'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('telefone') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="input-group mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="fas fa-user fa-fw"></i>
                        </span>
                    </div>

                    <select class="form-control" id="genero" class="form-control{{ $errors->has('genero') ? ' is-invalid' : '' }}" name="genero" value="{{ old('genero') }}{{ Auth::user()->genero }}" required>
                        <option value="">Selecione seu gênero</option>
                        <option value="Feminino" {{ Auth::user()->genero == "Feminino" ? "selected" : '' }}>Feminino</option>
                        <option value="Masculino" {{ Auth::user()->genero == "Masculino" ? "selected" : '' }}>Masculino</option>
                    </select>

                    @if ($errors->has('genero'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('genero') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="input-group mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="fas fa-user fa-fw"></i>
                        </span>
                    </div>

                    <input id="profissao" type="text" placeholder="Profissão" class="form-control{{ $errors->has('profissao') ? ' is-invalid' : '' }}" name="profissao" value="{{ old('profissao') }}{{ Auth::user()->profissao }}" required>

                    @if ($errors->has('profissao'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('profissao') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="row">
                    <div class="col-6">
                        <a href="{{ route('sair') }}" class="btn mt-4 mb-4 bg-transparent font-weight-semibold text-secondary ml-auto mr-2 py-2 btn-block">Sair</a>
                    </div>
                    <div class="col-6">
                        <button type="button" onclick="proximoModal(this.parentNode.parentNode.parentNode.parentNode);" class="btn mt-4 mb-4 bg-green-light font-weight-semibold text-green-dark box-shadow ml-auto py-2 btn-block">Próximo</button>
                    </div>
                </div>

            </div>

            <div id="page2" class="form-page d-none mx-2 mx-sm-5">

                <h5 class="font-weight-bold col-10 ml-auto mr-auto">
                    Endereço residencial
                </h5>

                <div style="position: relative;">
                    <div class="text-center mt-4 mb-5">
                        <span class="step-indicator rounded-circle mx-3 done"><i class="fas fa-check"></i></span>
                        <span class="step-indicator rounded-circle mx-3 done"><i class="fas fa-check"></i></span>
                        <span class="step-indicator rounded-circle mx-3 active">3</span>
                        <span class="step-indicator rounded-circle mx-3">4</span>
                    </div>
                </div>

                <div class="input-group mb-4">
                    <input id="cep" type="text" placeholder="CEP" class="form-control{{ $errors->has('cep') ? ' is-invalid' : '' }} cep" name="cep" value="{{ old('cep') }}{{ isset($endereco) ? $endereco->cep : '' }}" onchange="verificarCep();" required>

                    @if ($errors->has('cep'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('cep') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="row mb-4">

                    <div class="input-group col-12 col-sm-5 mb-4 mb-sm-0">
                        <select class="form-control" id="uf" class="form-control{{ $errors->has('nome_completo') ? ' is-invalid' : '' }}" name="uf" value="{{ old('uf') }}" onchange="selectEstado(this);" required>
                            <option value="">UF</option>
                            <option value="AC">AC</option>
                            <option value="AL">AL</option>
                            <option value="AP">AP</option>
                            <option value="AM">AM</option>
                            <option value="BA">BA</option>
                            <option value="CE">CE</option>
                            <option value="DF">DF</option>
                            <option value="ES">ES</option>
                            <option value="GO">GO</option>
                            <option value="MA">MA</option>
                            <option value="MT">MT</option>
                            <option value="MS">MS</option>
                            <option value="MG">MG</option>
                            <option value="PA">PA</option>
                            <option value="PB">PB</option>
                            <option value="PR">PR</option>
                            <option value="PE">PE</option>
                            <option value="PI">PI</option>
                            <option value="RJ">RJ</option>
                            <option value="RN">RN</option>
                            <option value="RS">RS</option>
                            <option value="RO">RO</option>
                            <option value="RR">RR</option>
                            <option value="SC">SC</option>
                            <option value="SP">SP</option>
                            <option value="SE">SE</option>
                            <option value="TO">TO</option>
                        </select>

                        @if ($errors->has('uf'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('uf') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="input-group pl-sm-0 col-12 col-sm-7">
                        <select class="form-control" id="cmbCidade" class="form-control{{ $errors->has('cidade') ? ' is-invalid' : '' }}" name="cidade" value="{{ old('cidade') }}{{ isset($endereco) ? $endereco->cidade : '' }}" required>
                            <option value="">Selecione sua cidade</option>
                        </select>

                        @if ($errors->has('cidade'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('cidade') }}</strong>
                            </span>
                        @endif
                    </div>

                </div>

                <div class="input-group mb-4">
                    <input id="bairro" type="text" placeholder="Bairro" class="form-control{{ $errors->has('bairro') ? ' is-invalid' : '' }}" name="bairro" value="{{ old('bairro') }}{{ isset($endereco) ? $endereco->bairro : '' }}" required>

                    @if ($errors->has('bairro'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('bairro') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="input-group mb-4">
                    <input id="logradouro" type="text" placeholder="Logradouro" class="form-control{{ $errors->has('logradouro') ? ' is-invalid' : '' }}" name="logradouro" value="{{ old('logradouro') }}{{ isset($endereco) ? $endereco->logradouro : '' }}" required>

                    @if ($errors->has('logradouro'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('logradouro') }}</strong>
                        </span>
                    @endif
                </div>


                <div class="input-group mb-4">
                    <input id="numero_complemento" type="text" placeholder="Numero e complemento" class="form-control{{ $errors->has('numero_complemento') ? ' is-invalid' : '' }}" name="numero_complemento" value="{{ old('numero_complemento') }}{{ isset($endereco) ? $endereco->numero_complemento : '' }}">

                    @if ($errors->has('numero_complemento'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('numero_complemento') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="row">
                    <div class="col-6">
                        <button id="btnVoltar" type="button" onclick="anteriorModal(this.parentNode.parentNode.parentNode.parentNode);" class="btn mt-4 mb-4 bg-transparent font-weight-semibold text-secondary ml-auto mr-2 py-2 btn-block">Voltar</button>
                    </div>
                    <div class="col-6">
                        <button type="button" onclick="confirmarCadastro();" class="btn mt-4 mb-4 bg-green-light font-weight-semibold text-green-dark box-shadow mr-auto py-2 btn-block">Enviar</button>
                    </div>
                </div>

            </div>

            <div id="divLoading" class="form-page mx-0 mx-sm-5 d-none py-3">

                <i class="fas fa-spinner fa-pulse fa-3x text-primary"></i>

                <h5 class="mt-4 font-weight-bold col-10 ml-auto mr-auto">
                    Enviando informações pessoais

                    <span class="small d-block mt-3 text-dark font-weight-normal">
                        Você será redirecionado em instantes.
                    </span>
                </h5>

            </div>

        </form>

    </div>
    <!-- /container -->


    <!-- Custom JS -->
    <script src="{{ env('APP_URL') }}/assets/js/main.js"></script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

    <!-- Mask JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>

    <script>

        $( document ).ready(function(){

            @if($errors->any())
            {{-- @if(session()->has('error')) --}}
                swal("Ops!", '{{ $errors->first() }}', 'error');
            @elseif(session()->has('message'))
                swal("Yeah!", '{{ session()->get('message') }}', 'success');
            @endif

            $('[data-toggle="tooltip"]').tooltip();

            $(".date").mask('00/00/0000');
            $(".cpf").mask('000.000.000-00');
            $(".rg").mask('00.000.000-A');
            $('.telefone').mask('(00) 0 0000-0000');
            $(".cep").mask('00000-000');

            var url = 'https://servicodados.ibge.gov.br/api/v1/localidades/estados';

            $.get( url, function(data)
            {
                window.estados = data;

                @if(isset($endereco))
                    $("select#uf").val("{{ $endereco->uf }}");

                    selectEstado(document.getElementById('uf'));
                @endif

            });

        });

        var estados = null;

        function selectEstado(element)
        {
            if(findValueWhere(estados, 'sigla', element.value) != null)
            {
                var url = 'https://servicodados.ibge.gov.br/api/v1/localidades/estados/' + findValueWhere(estados, 'sigla', element.value).id + '/municipios';

                $.get( url, function(data)
                {
                    console.log(data);

                    $("#cmbCidade").html('');

                    $("#cmbCidade").append('<option value="">Selecione sua cidade</option>');

                    data.forEach( function(cidade) {

                        $("#cmbCidade").append( '<option>' + cidade.nome + '</option>' );

                    });

                    @if(isset($endereco))
                        $("select#cmbCidade").val("{{ $endereco->cidade }}");
                    @endif

                    if(localidade != null)
                    {
                        $("#cmbCidade").val(localidade);
                    }
                });
            }
            else
            {
                console.log("Estado não encontrado na base de dados do IBGE");
            }
        }

        function confirmarCadastro()
        {
            var preenchido = true;

            $('#page2 :input[required]').each(function()
            {
                if( $(this).val() == "")
                {
                    $(this).focus();
                    preenchido = false;
                    return false;
                }
            });

            if(preenchido)
            {
                $('#page2').addClass('d-none');
                $('#divLoading').removeClass('d-none');
                setTimeout(function()
                {
                    document.getElementById('divPages').submit();
                }, 500);
            }
        }

        function verificarCep()
        {
            consultarCEP($("#cep").val()).then( (data) => {
                if(data.localidade != null)
                {
                    localidade = data.localidade;
                }
                if(data.uf != null)
                {
                    $("#uf").val(data.uf);
                    selectEstado(document.getElementById('uf'));
                }
                if(data.bairro != null)
                {
                    $("#bairro").val(data.bairro);
                }
                if(data.logradouro != null)
                {
                    $("#logradouro").val(data.logradouro);
                }

                $("#numero_complemento").focus();
            });
        }

        var localidade = null;

        async function consultarCEP(cep)
        {
            if(cep.length != 9)
            {
                return { 'error' : 'Cep inválido!' };
            }

            let response = await fetch("https://viacep.com.br/ws/" + cep + "/json/");

            let data = await response.json();

            console.log("Resultado CEP: ", data);

            return data;
        }

    </script>

</body>

</html>
