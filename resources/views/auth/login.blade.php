<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Plataforma de cursos digitais">
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
            color: #1d2850;
        }

    </style>

</head>

<body>

    <div class="container">

        <h1 class="title" style="transform: none;">
            <img src="{{ env('APP_URL') }}/images/logo-jean-piaget2.png" height="auto" alt="" style="max-width: 100%;">
        </h1>

        <div class="box-signin">
            <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}" class="form-signin">
                @csrf

                <div class="input-group mb-3 mt-2">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">
                        <i class="fas fa-envelope"></i>
                    </span>
                    </div>

                    <input id="email" type="text" name="email" value="{{ old('email') }}" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="E-mail:" required>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">
                        <i class="fas fa-lock"></i>
                    </span>
                    </div>

                    <input id="password" name="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Senha:" required>

                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>

                <button class="btn btn-block signin-button my-4 py-3 font-weight-bold" type="submit">{{ __('Entrar') }}</button>

                {{-- <button type="button" class="btn btn-block signin-button-google my-4 py-3 font-weight-bold disabled">
                        <img src="{{ asset('images/icon-google.png') }}" alt="Entrar com Google">
                        {{ __('Entrar com Google') }}
                </button> --}}

                <span class="text-center d-block my-3 font-weight-bold">
                    <a href="{{ route('usuario.esqueci-senha') }}" style="color: #207adc;">
                        Esqueci minha senha
                    </a>
                </span>

                <span class="text-center d-block my-3">
                    Ao inscrever-se você concorda com o nosso <a href="#" class="font-weight-bold">Termo de uso</a> e nossa <a href="#" class="font-weight-bold">Política de privacidade</a>
                </span>

                <span class="d-block signup">
                    Não tem uma conta?
                    <a class="font-weight-bold" href="{{ route('register') }}">
                        Cadastre-se
                    </a>
                </span>


            </form>
        </div>

    </div>
    <!-- /container -->


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

</body>

</html>
