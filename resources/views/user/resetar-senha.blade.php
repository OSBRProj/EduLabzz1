<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Descrição aqui">
    <meta name="author" content="Jean Piaget - Resetar Senha">
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

    <form id="formEsqueciSenha" method="POST" action="{{ route('usuario.resetar-senha') }}" aria-label="Resetar a senha" class="admin-box text-center px-3 px-sm-5">

        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div id="page1" class="form-page">

            <h5 class="mt-4 mb-5 font-weight-bold col-10 ml-auto mr-auto">
                Redefinição de senha
                <p class="small d-block mt-2">
                    Preencha seu email e defina qual será sua nova senha
                </p>
            </h5>

            <div class="input-group mb-4">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-transparent rounded-0" id="basic-addon1">
                        <i class="fas fa-at fa-fw"></i>
                    </span>
                </div>

                <input id="email" type="email" placeholder="E-mail" class="form-control rounded-0 {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div class="input-group mb-4">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-transparent rounded-0" id="basic-addon1">
                        <i class="fas fa-lock fa-fw"></i>
                    </span>
                </div>

                <input id="password" type="password" placeholder="Nova senha" class="form-control rounded-0 {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password" value="{{ old('email') }}" required>

                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>

            <div class="input-group mb-4">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-transparent rounded-0" id="basic-addon1">
                        <i class="fas fa-lock fa-fw"></i>
                    </span>
                </div>

                <input id="password-confirm" name="password_confirmation" type="password" placeholder="Confirmação de senha" class="form-control rounded-0 {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email') }}" required autofocus>
            </div>

            <div class="row">
                <a href="{{ route('login') }}" class="btn btn-lg btn-block outline-button my-4 col-4 ml-auto mr-4 font-weight-bold text-secondary">Voltar</a>
                <button type="submit" class="btn btn-lg btn-block signin-button my-4 col-4 ml-4 mr-auto text-white font-weight-bold">Salvar</button>
            </div>
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
