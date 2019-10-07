@extends('layouts.master')

@section('title', 'J. PIAGET - ' . ucfirst($aplicacao->titulo))

@section('headend')
    <meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1, minimum-scale=1,maximum-scale=1,target-densitydpi=device-dpi"/>

    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="format-detection" content="telephone=no">

    <!-- force webkit on 360 -->
    <meta name="renderer" content="webkit"/>
    <meta name="force-rendering" content="webkit"/>
    <!-- force edge on IE -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="msapplication-tap-highlight" content="no">

    <!-- force full screen on some browser -->
    <meta name="full-screen" content="yes"/>
    <meta name="x5-fullscreen" content="true"/>
    <meta name="360-fullscreen" content="true"/>

    <!-- force screen orientation on some browser -->
    <!-- <meta name="screen-orientation" content="portrait"/>
    <meta name="x5-orientation" content="portrait"> -->

    <meta name="browsermode" content="application">
    <meta name="x5-page-mode" content="app">

    <style type="text/css">

        html
        {
            -ms-touch-action: none;
        }

        {{-- body, canvas, div
        {
            margin: 0;
            padding: 0;
            outline: none;
            -moz-user-select: none;
            -webkit-user-select: none;
            -ms-user-select: none;
            -khtml-user-select: none;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
        } --}}

        body {
            {{-- position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            padding: 0;
            border: 0;
            margin: 0;

            cursor: default;
            color: #888;
            background-color: #333;

            text-align: center;
            font-family: Helvetica, Verdana, Arial, sans-serif;

            display: flex;
            flex-direction: column; --}}
        }

        #Cocos2dGameContainer
        {
            position: absolute;
            margin: 0;
            overflow: hidden;
            left: 0px;
            top: 0px;

            display: -webkit-box;
            -webkit-box-orient: horizontal;
            -webkit-box-align: center;
            -webkit-box-pack: center;
        }

        canvas {
        background-color: rgba(0, 0, 0, 0);
        }

        main
        {
            align-items: center;
            display: flex;
        }

        .webgl-content, .game-container
        {

            {{--  width: 67.5vw !important;
            height: 38.3vw !important;
            max-width: 972px;
            max-height: 552px;  --}}

            {{-- width: calc(85vw + 12px) !important;
            height: calc(48vw + 12px) !important; --}}

            width: calc(95% + 12px) !important;
            height: calc(48vw + 12px) !important;

            max-width: 1292px;
            max-height: 732px;
        }

        .game-container
        {
            border: 6px solid #f26f22 !important;
            overflow: hidden;
        }

        .game-container canvas
        {
            width: 100% !important;
            height: 100% !important;
        }

        body
        {
            background-color: #202020;
        }

    </style>

@endsection

@section('content')

<main role="main" class="darkmode">

    <div class="container-fluid">
        <div class="row">

            <div class="col-12 col-xl-10 mx-auto px-1 px-xl-3 pb-4">

                <div class="webgl-content mx-auto">

                    {{-- <div class="game-container mx-auto" id="gameCanvas"></div> --}}
                    <iframe class="game-container mx-auto" id="gameCanvas" style="overflow: hidden;" src="{{ env('APP_LOCAL') }}/uploads/aplicacoes/{{ $aplicacao->id }}" frameborder="0"></iframe>

                    <div class="footer">
                        {{--  <div class="webgl-logo"></div>  --}}
                        <div class="fullscreen" onclick="gameInstance.SetFullscreen(1)"></div>
                        <div class="title h4 text-primary">{{ ucfirst($aplicacao->titulo) }}</div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</main>

@endsection

@section('bodyend')

    <script>

        var idAplicacao = '{{ $aplicacao->id }}';

        var padroesUrl = appurl + "/uploads/aplicacoes/padroes";

        var aplicacaoUrl = appurl + "/uploads/aplicacoes/" + idAplicacao;


        $( document ).ready(function()
        {
            toggleSideMenu();

            $('iframe').ready( function() {
                //console.log($('iframe').contents().find("head"));
                $('iframe').contents().find("body").css("overflow", 'hidden');
                $('iframe').contents().find("head")
                  .append($("<style type='text/css'>  body{overflow:hidden;}  </style>"));
            });

        });

        $(window).on('unload', function() {

            //console.log("Sending interaction beacon!");

            var fd = new FormData();
            fd.append('_token', '{{ csrf_token() }}');
            fd.append('tipo', 1);
            fd.append('inicio', '{{ date("Y-m-d H:i:s") }}');
            {{--  fd.append('inicio', new Date().toISOString().slice(0, 19).replace('T', ' '));  --}}

            navigator.sendBeacon('{{ env('APP_LOCAL') }}/play/conteudo/{{ $aplicacao->id }}/interacao/enviar', fd);
        });



    </script>

@endsection
