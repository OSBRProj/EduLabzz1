<!DOCTYPE html>
{{-- <html lang="pt-br"> --}}
<html lang="{{ app()->getLocale() }}">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Plataforma de cursos digitais">
        <meta name="author" content="Jean Piaget - Edulabzz">
        <link rel="icon" href="{{ env('APP_URL') }}/images/favicon.png">

        <title>J. PIAGET - {{ ucfirst($aplicacao->titulo) }}</title>

        <!-- Bootstrap CSS -->
        {{--  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">  --}}

        <!-- Font Awesome -->
        {{--  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">  --}}

        <!-- Font Body -->
        {{--  <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>  --}}

        <!-- Animations -->
        {{-- <link href="{{ env('APP_URL') }}/assets/css/animated.css" rel="stylesheet"> --}}
        {{--  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" />  --}}


        <!-- Font Edulabzz -->

        <!-- Custom styles main -->
        {{--  <link rel="stylesheet" href="{{ env('APP_URL') }}/assets/css/main.css">  --}}

        <!-- Custom styles for this template -->
        <style>

            main
            {
                align-items: center;
                display: flex;
                overflow: hidden;
            }

            body
            {
                margin: 0px;
                padding: 0px;
            }

            .webgl-content, .game-container
            {
                width: 100vw !important;
                height: 100vh !important;
            }

            .game-container
            {
                border: 0px solid #207adc !important;
            }

            .game-container canvas
            {
                width: 100% !important;
                height: 100% !important;
            }

        </style>

        <link rel="stylesheet" href="{{ env('APP_LOCAL') }}/assets/unity/TemplateData/style.css">

    </head>

    <body id="page-top">


        <main role="main">

            <div class="game-container mx-auto" id="gameContainer"></div>

        </main>

        <!-- Bootstrap core JavaScript -->
        {{--  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>  --}}

        <!-- Jquery UI -->
        {{--  <script src="{{ env('APP_URL') }}/assets/js/jquery-ui.min.js"></script>  --}}

        {{--  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>  --}}
        {{--  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>  --}}

        <!-- Sweet Alert -->
        {{--  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>  --}}

        <!-- Jquery Easing -->
        {{--  <script src="{{ env('APP_URL') }}/assets/js/jquery.easing.compatibility.min.js"></script>  --}}

        <!-- Custom Scrolling Nav -->
        {{--  <script src="{{ env('APP_URL') }}/assets/js/scrolling-nav.js"></script>  --}}

        <!-- Custom Smooth Scrolling -->
        {{--  <script src="{{ env('APP_URL') }}/assets/js/smooth-scrolling.js"></script>  --}}

        <!-- Declare App URL -->
        <script>var appurl = '{{ env("APP_LOCAL") }}';</script>

        <!-- Custom JavaScript -->
        {{--  <script src="{{ env('APP_URL') }}/assets/js/main.js"></script>  --}}


        <!-- Unity player js -->
        <script src="{{ env('APP_LOCAL') }}/assets/unity/TemplateData/UnityProgress.js"></script>
        <script src="{{ env('APP_LOCAL') }}/uploads/aplicacoes/{{ $aplicacao->id }}/UnityLoader.js"></script>
        <script>
            var gameInstance = UnityLoader.instantiate("gameContainer", "{{ env('APP_LOCAL') }}/uploads/aplicacoes/{{ $aplicacao->id }}/aplicacao.json", {onProgress: UnityProgress});
        </script>

    </body>

</html>
