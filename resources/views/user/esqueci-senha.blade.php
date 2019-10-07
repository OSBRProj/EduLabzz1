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
            padding-top: 0vh;
            padding-bottom: 40px;
            background-color: #207adc;
            min-height: 100vh;
        }

        .title
        {
            text-align: center;
            font-weight: 100;
            font-size: 60px;
            margin: 20px;
            margin-bottom: 6vh;
            transform: scale(0.8,1.5);
            color: #207adc;
        }


    </style>

</head>

<body>

<div class="back-to-login">
    <a href="{{ route('login')}}"> <i class="fas fa-chevron-left"></i> Voltar a plataforma</a>
</div>

<div class="container px-3 px-sm-3">


    <h1 class="title d-none d-xl-block" style="transform: none;">
        <img src="{{ env('APP_URL') }}/images/logo-jean-piaget2.png" height="110" alt="">
    </h1>

    <form id="formEsqueciSenha" method="POST" action="{{ route('usuario.esqueci-senha') }}" aria-label="Esqueci minha senha" class="admin-box text-center px-3 px-sm-5">

        @csrf

        <div id="page1" class="form-page">

            <h5 class="mt-4 mb-5 font-weight-bold col-10 ml-auto mr-auto" style="color: #207adc;">
                Qual seu e-mail de cadastro?
            </h5>

            <div class="input-group mb-4">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-transparent rounded-0" id="basic-addon1">
                        <i class="fas fa-at fa-fw"></i>
                    </span>
                </div>

                <input id="email" type="email" placeholder="E-mail" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

                <button type="button" onclick="$('#page1').addClass('d-none'); $('#page2').removeClass('d-none'); setTimeout( function () { $('#formEsqueciSenha').submit(); }, 500);" class="btn btn-lg btn-block signin-button mt-5 font-weight-bold">Enviar</button>

            <span class="d-block signup" >
                    <a href="{{ route('register') }}">
                    Criar nova conta
                </a>
                </span>

        </div>

        <div id="page2" class="form-page d-none py-3">

            <i class="fas fa-spinner fa-pulse fa-3x text-primary"></i>

            <h5 class="mt-4 font-weight-bold col-10 ml-auto mr-auto">
                Estamos enviando um e-mail para redefinição de senha para sua caixa de entrada.
                <span class="small d-block mt-3 text-dark font-weight-normal">
                                Utilize o link em seu email para criar uma nova senha
                            </span>
            </h5>

        </div>

    </form>

</div>
<!-- /container -->


<!-- Custom JS -->
<script src="{{ env('APP_URL') }}/assets/js/main.js"></script>

<!-- Password strength  detection -->
<script src="{{ env('APP_URL') }}/assets/js/password-strength.js"></script>

<!-- ZXCVBN for Password strength  detection -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.2.0/zxcvbn.js"></script>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>


<!-- Mask JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>


</body>

</html>
