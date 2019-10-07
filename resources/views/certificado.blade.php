<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1446 776">
    <defs>
        <style>
            {{-- body{overflow: hidden;} --}}
            .cls-1,
            .cls-9 {
                fill: #fff;
            }

            .cls-2 {
                fill: #207adc;
            }

            .cls-3 {
                fill: none;
                stroke: #95989a;
            }

            .cls-4,
            .cls-5 {
                fill: #939393;
                font-size: 20px;
            }

            .cls-4 {
                font-family: 'Robot', 'Poppins', 'Open Sans', sans-serif;
                font-weight: 700;
            }

            .cls-5,
            .cls-9 {
                font-family: 'Robot', 'Poppins', 'Open Sans', sans-serif;
            }

            .cls-6 {
                fill: #313133;
            }

            .cls-7 {
                fill: #63faff;
            }

            .cls-8 {
                fill: #ffe9f3;
            }

            .cls-9 {
                font-size: 33px;
            }

            .cls-10 {
                filter: url(#Rectangle_373);
            }

            .cls-11 {
                filter: url(#Rectangle_327);
            }
            .cls-1 {
                fill: #f8f8f7;
            }

            .cls-2 {
                fill: #202a37;
            }
            @if(isset($escola->caracteristicas))
                @if(isset($escola->caracteristicas->cor1) ? $escola->caracteristicas->cor1 != null : false)
                    #Titulo_curso, #Concluiu_o_curso {
                        fill: {{ $escola->caracteristicas->cor1 }} !important;
                    }
                    .cls-2 {
                        fill: {{ $escola->caracteristicas->cor2 }} !important;
                    }
                @endif
            @endif

            .cls-3 {
                fill: #008cc9;
            }
        </style>
        <filter id="Rectangle_327" x="0" y="0" width="1446" height="776" filterUnits="userSpaceOnUse">
            <feOffset dy="3" input="SourceAlpha" />
            <feGaussianBlur stdDeviation="3" result="blur" />
            <feFlood flood-opacity="0.161" />
            <feComposite operator="in" in2="blur" />
            <feComposite in="SourceGraphic" />
        </filter>
        <filter id="Rectangle_373" x="120.889" y="71.431" width="157.139" height="157.138" filterUnits="userSpaceOnUse">
            <feOffset dy="3" input="SourceAlpha" />
            <feGaussianBlur stdDeviation="3" result="blur-2" />
            <feFlood flood-opacity="0.161" />
            <feComposite operator="in" in2="blur-2" />
            <feComposite in="SourceGraphic" />
        </filter>
    </defs>
    <g id="Group_465" data-name="Group 465" transform="translate(-255 -256)">
        <g class="cls-11" transform="matrix(1, 0, 0, 1, 255, 256)">
            <rect id="Rectangle_327-2" data-name="Rectangle 327" class="cls-1" width="1428" height="758" rx="20"
                transform="translate(9 6)" />
        </g>
        <path id="Rectangle_328" data-name="Rectangle 328" class="cls-2" d="M20,0H1408a20,20,0,0,1,20,20V336a0,0,0,0,1,0,0H0a0,0,0,0,1,0,0V20A20,20,0,0,1,20,0Z"
            transform="translate(264 262)" style="fill: white;" />
        <text id="Titulo_curso" data-name="Titulo curso" class="cls-4" style="fill: #207adc;font-size: 30px;transform: translate(710px, 420px) !important;">
            <tspan>Certificado de conclusão do curso:</tspan>
        </text>
        <text id="Titulo_curso" data-name="Titulo curso" class="cls-4 wrap" style="fill: #207adc;font-size: 50px;transform: translate(50%, 490px) !important;">
            <tspan text-anchor="middle" x="15%">{{ ucfirst($curso->titulo) }}</tspan>
        </text>
        <text id="Concluiu_o_curso" data-name="Concluiu o curso: " class="cls-4" style="fill: #207adc;font-size: 70px; transform: translate({{ 958 + 19.5 - (19.5 * strlen(ucwords($user->name))) }}px, 750px) !important;">
            <tspan>{{ ucwords($user->name) }}</tspan>
        </text>
        <line id="Line_69" data-name="Line 69" class="cls-3" x1="868" transform="translate(544.5 800.5)" />
        <text id="" data-name="" class="cls-4" style="font-size: 30px; transform: translate({{ 793 + 7.5 - (7.5 * strlen($dataConclusao)) }}px, 875px) !important;">
            <tspan>{{ $dataConclusao }}</tspan>
        </text>
        <line id="Line_70" data-name="Line 70" class="cls-3" x1="203" transform="translate(697.5 894.5)" />
        <line id="Line_71" data-name="Line 71" class="cls-3" x1="203" transform="translate(1057.5 894.5)" />
        {{-- <text id="Concluiu_o_curso:_" data-name="Concluiu o curso: " class="cls-4" transform="translate(685 820)">
            <tspan x="210.57" y="20">Concluiu o curso: @nomecurso</tspan>
        </text> --}}
        <text id="Data" class="cls-5" transform="translate(620 923)">
            <tspan x="155.07" y="20">Data</tspan>
        </text>
        <text id="Assinatura" class="cls-5" transform="translate(979 923)">
            <tspan x="128.43" y="20">Assinatura</tspan>
        </text>
        <text id="Este_certificado_é_apresentado_a" data-name="Este certificado é apresentado a" class="cls-4"
            transform="translate(685 622)">
            <tspan x="131.12" y="20">Este certificado é apresentado a</tspan>
        </text>
        <g id="Group_317" data-name="Group 317" transform="translate(-409 377)">
            {{--  <g id="Group_310" data-name="Group 310" transform="translate(1220 -100) scale(0.5, 0.5)">
                <g id="Camada_2" data-name="Camada 2"><g id="Camada_1-2" data-name="Camada 1"><g id="Camada_1-2-2" data-name="Camada 1-2"><path class="cls-1" d="M212.56,40.08H191.23V27.48h55.92v12.6H225.83v64.76H212.56Z"/><path class="cls-1" d="M300.43,78.65a28,28,0,0,1-55.92,0c0-15.48,12.37-27.52,28-27.52S300.43,63.17,300.43,78.65Zm-13.49,0c0-8.19-5.52-15.14-14.47-15.14S258,70.47,258,78.65s5.53,15.14,14.49,15.14S287,86.81,287,78.65Z"/><path class="cls-1" d="M362.54,78.65a28,28,0,0,1-55.93,0c0-15.48,12.38-27.52,28-27.52S362.54,63.17,362.54,78.65Zm-13.48,0c0-8.19-5.53-15.14-14.49-15.14s-14.47,7-14.47,15.14,5.53,15.14,14.47,15.14S349.06,86.81,349.06,78.65Z"/><path class="cls-1" d="M373.81,21.29h13.26v83.55H373.81Z"/><path class="cls-1" d="M447.08,52.45l-26,40h24.75v12.38H398.55l26-40H400.44V52.45Z"/><path class="cls-1" d="M501.79,52.45l-26,40h24.75v12.38h-47.3l26-40H455.15V52.45Z"/></g><rect class="cls-2" x="4" y="4" width="119.49" height="119.49" rx="8.5"/><path class="cls-3" d="M115,127.49H12.5A12.52,12.52,0,0,1,0,115V12.5A12.52,12.52,0,0,1,12.5,0H115a12.52,12.52,0,0,1,12.5,12.5V115A12.52,12.52,0,0,1,115,127.49ZM12.5,8A4.51,4.51,0,0,0,8,12.5V115a4.51,4.51,0,0,0,4.5,4.51H115a4.51,4.51,0,0,0,4.5-4.51V12.5A4.51,4.51,0,0,0,115,8Z"/><g id="Camada_1-2-3" data-name="Camada 1-2"><path class="cls-1" d="M37.2,43.18H20.4V33.25H64.46v9.93H47.66v51H37.2Z"/><path class="cls-1" d="M105.57,52.93,85.1,84.44h19.51v9.75H67.34L87.8,62.67h-19V52.93Z"/></g><path class="cls-1" d="M519,47.12a5.42,5.42,0,1,1-5.4-5.27A5.29,5.29,0,0,1,519,47.12Zm-9.48,0a4.07,4.07,0,1,0,4.08-4.21A4.08,4.08,0,0,0,509.55,47.12Zm3.24,2.76h-1.22V44.61a11.28,11.28,0,0,1,2-.16,3.25,3.25,0,0,1,1.83.39,1.45,1.45,0,0,1,.51,1.16,1.36,1.36,0,0,1-1.09,1.22v.06a1.56,1.56,0,0,1,1,1.29,3.87,3.87,0,0,0,.39,1.31h-1.32a4.42,4.42,0,0,1-.42-1.28c-.09-.58-.41-.84-1.09-.84h-.58Zm0-3h.57c.68,0,1.22-.23,1.22-.78s-.35-.8-1.12-.8a3,3,0,0,0-.67.06Z"/></g></g>
            </g>  --}}
            <g id="Group_310" data-name="Group 310" transform="translate(990 -90) scale(0.5, 0.5)">
                <g id="Camada_2" data-name="Camada 2"><image xlink:href="{{ env('APP_URL') }}/images/logo-jean-piaget1.png" height="150" width="100%"></image></g>
            </g>
            {{--  <text id="Jean Piaget" class="cls-9" transform="translate(758.388 142.569)">
                <tspan x="0" y="0">Jean Piaget</tspan>
            </text>  --}}
        </g>
    </g>
</svg>
