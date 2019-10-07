<!DOCTYPE html>
{{-- <html lang="pt-br"> --}}
<html lang="{{ app()->getLocale() }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Plataforma de cursos digitais">
    <meta name="author" content="Jean Piaget - Edulabzz">
    <link rel="icon" href="{{ env('APP_URL') }}/images/favicon.png">

    <title>@yield('title')</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

    <!-- Bootstrap Select -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css">

    <!-- Font Awesome -->
    {{-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous"> --}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" crossorigin="anonymous">

    <!-- Font Body -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>

    <!-- Animations -->
    {{-- <link href="{{ env('APP_URL') }}/assets/css/animated.css" rel="stylesheet"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" />

    <!-- Laravel Full calendar -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>

    <!-- Jquery UI datepicker -->
    <link rel="stylesheet" href="{{ env('APP_URL') }}/assets/css/jquery-ui.min.css">
    <link rel="stylesheet" href="{{ env('APP_URL') }}/assets/css/jquery-ui.theme.min.css">

    <!-- datetimepicker bootstrap -->
    <link href="https://unpkg.com/gijgo@1.9.11/css/gijgo.min.css" rel="stylesheet" type="text/css" />

    <!-- Font Edulabzz -->

    <link rel="stylesheet" href="{{ env('APP_URL') }}/assets/css/app.min.css">

    <!-- Custom styles main -->
    @if(!Request::is('hub') && !Request::is('hub/*'))
    {{-- <link rel="stylesheet" href="{{ env('APP_URL') }}/assets/css/main.css"> --}}
    @else
    <link rel="stylesheet" href="{{ env('APP_URL') }}/assets/css/hub-main.css">
    @endif

    @yield('headend')

    @if(\HelperClass::needSideBar())
        <style>
            main
            {
                width: calc(100vw - 28px);
            }
        </style>
    @endif

    @if(Request::is('gestao/*'))
        <style>
            body
            {
                background-color: #F6F7F9;
            }
        </style>
    @endif





</head>

<body id="page-top">

    <!-- Navigation -->
    @if(Request::is('hub') || Request::is('hub/*'))
        @include('utilities.hub-navbar')
    @else
        @include('utilities.main-navbar')
    @endif

    <div id="divBackgroundTipos" onclick="closeConteudos();" class="d-none" style="transition: 0.3s all ease-in-out; opacity: 0; position: fixed; top: 0px; left: 0px; width: 100%; height: 100%; background: rgba(0,0,0,0.8); z-index: 5;">
    </div>


    @if(Auth::check())
        @if(\HelperClass::needSideBar())
            <!-- sidebar -->
            @include('utilities.sidebar')
        @endif
    @endif

    @if(Auth::check())
        @if(\HelperClass::needGestaoSideBar())
            <!-- sidebar -->
            @include('utilities.gestao-sidebar')
        @endif
    @endif

    @if(Auth::check())
        @if(\HelperClass::needDocSideBar())
            <!-- sidebar -->
            @include('utilities.sidebar-doc')
        @endif
    @endif

    @yield('content')

    <!-- notifications -->
    {{-- @include('utilities.notifications') --}}

    @include('utilities.footer')

    <script type="text/javascript">
        var _userway_config = {
        /* uncomment the following line to override default position*/
        /* position: '3', */
        /* uncomment the following line to override default size (values: small, large)*/
        /* size: 'large', */
        /* uncomment the following line to override default language (e.g., fr, de, es, he, nl, etc.)*/
        language: 'pt-BR',
        /* uncomment the following line to override color set via widget (e.g., #053f67)*/
        color: '#207adc',
        /* uncomment the following line to override type set via widget(1=person, 2=chair, 3=eye)*/
        /* type: '1', */
        /* uncomment the following line to override support on mobile devices*/
        /* mobile: true, */
        account: '3gsM1IWRhU'
        };
    </script>
    <script type="text/javascript" src="https://cdn.userway.org/widget.js"></script>


    <!-- Bootstrap core JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

    @if(Auth::check())
        {!! \App\Services\GamificacaoService::showLevelUpNotification(); !!}
    @endif

    <!-- Jquery UI -->
    <script src="{{ env('APP_URL') }}/assets/js/jquery-ui.min.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

    <!-- Sweet Alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- Jquery Easing -->
    <script src="{{ env('APP_URL') }}/assets/js/jquery.easing.compatibility.min.js"></script>

    <!-- Custom Scrolling Nav -->
    <script src="{{ env('APP_URL') }}/assets/js/scrolling-nav.js"></script>

    <!-- jQuery-Mask-Plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>

    <!-- Laravel Full calendar -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/locale/pt-br.js"></script>


    <!-- Bootstrap select -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>

    <!-- Bootstrap select -->
    <!-- (Optional) Latest compiled and minified JavaScript translation files -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/i18n/defaults-pt_BR.min.js"></script>


    <!-- Custom Smooth Scrolling -->
    {{--  <script src="{{ env('APP_URL') }}/assets/js/smooth-scrolling.js"></script>  --}}

    <!-- Declare App URL -->
    <script>var appurl = '{{ env("APP_LOCAL") }}';</script>

    <!-- Custom JavaScript -->
    <script src="{{ env('APP_URL') }}/assets/js/main.js"></script>

    <script>

        $( document ).ready(function(){

            if(window.screen.width < 768)
            {
                $(".sidebar").removeClass("show");
            }

            @if($errors->any())
                swal("Ops!", '{{ $errors->first() }}', 'error');
            @elseif(session()->has('success'))
                swal("Yeah!", '{{ session()->get('success') }}', 'success');
            @elseif(session()->has('message'))
                swal("Yeah!", '{{ session()->get('message') }}', 'success');
            @elseif(session()->has('warning'))
                swal("Atenção!", '{{ session()->get('warning') }}', 'warning');
            @elseif(session()->has('error'))
                swal("Ops!", '{{ session()->get('error') }}', 'error');
            @endif

            $('[data-toggle="tooltip"]').tooltip();

            console.log($('form').length);

            $('form [type=submit]').on('click', (element) => {

                window.checarPreenchimento($(element.target).closest("form"));
            });

            $('form').on('submit', (element) => {

                window.checarPreenchimento($(element.target).closest("form"));
            });
        });

    </script>

    @yield('bodyend')

    <!-- Custom JavaScript -->
    <script src="{{ env('APP_URL') }}/assets/js/app.min.js"></script>


</body>

</html>
