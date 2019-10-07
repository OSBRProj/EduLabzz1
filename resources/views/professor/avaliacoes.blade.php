@extends('layouts.master')

@section('title', 'J. PIAGET - Avaliação professor')

@section('headend')

    <!-- Custom styles for this template -->
    <style>

        header
        {
            padding: 154px 0 100px;
        }

        @media (min-width: 992px)
        {
            header
            {
                padding: 156px 0 100px;
            }
        }

        .capa-curso
        {
            min-height: 160px;
            border-radius: 10px 10px 0px 0px;
            background-image: url('{{ env('APP_LOCAL') }}/images/default-cover.jpg');
            background-size: cover;
            background-position: 50% 50%;
            background-repeat: no-repeat;
        }

        .input-group input.text-secondary::placeholder
        {
            color: #989EB4;
        }

        .form-group label
        {
            color: #213245;
            font-weight: bold;
            font-size: 18px;
        }


        .form-control
        {
            color: #525870;
            font-weight: bold;
            font-size: 16px;
            border: 0px;
            border-radius: 5px;
            box-shadow: 0px 3px 6px rgba(0,0,0,0.16);
        }

        .form-control::placeholder
        {
            color: #B7B7B7;
        }

        .custom-select option:first-child
        {
            color: #B7B7B7;
        }

        input[type=range]::-webkit-slider-thumb
        {
            -webkit-appearance: none;
            border: 0px;
            height: 20px;
            width: 20px;
            border-radius: 50%;
            background: #525870;
            cursor: pointer;
            margin-top: 0px; /* You need to specify a margin in Chrome, but in Firefox and IE it is automatic */
        }

        input[type=range]::-webkit-slider-runnable-track
        {
            width: 100%;
            height: 36px;
            cursor: pointer;
            box-shadow: 0px 3px 6px rgba(0,0,0,0.16);
            background: #5678ef;
            border-radius: 90px;
            border: 8px solid #E3E5F0;
        }

        @media (min-width: 576px)
        {
            .side-menu
            {
                min-height: calc(100vh - 162px);
            }
        }

        .nav-tabs
        {
            border-bottom: 1px solid #EEEEEE;
        }
        .nav-tabs .nav-item
        {
            margin-bottom: 0px;
        }
        .nav-tabs .nav-link
        {
            border: 0px;
            font-size: 20px;
            border-bottom: 4px solid transparent;
            color: #525870;
            font-weight: bold;
            padding-bottom: 20px;
        }
        .nav-tabs .nav-link.active
        {
            color: #207adc;
            border-bottom: 4px solid #207adc;
        }

        .summernote-holder
        {
            padding: .375rem .75rem;
            border-radius: 0px;
            /*border: 1px solid #B7B7B7;*/
            border: 2px solid #207adc;
            box-shadow: 0px 3px 6px rgba(0,0,0,0.16);
            font-size: initial;
            text-align: initial;
            color: initial;
        }

        .fa-star
        {
            color: #525870;
        }

        .text-lightyellow
        {
            color: #FFDC4E;
        }

    </style>

    @if(\Request::is('configuracao/*'))
        <style>

            body
            {
                background-color: #F1F1F1;
            }

        </style>
    @endif

@endsection

@section('content')

<main role="main" class="mr-0">

    <div class="row justify-content-center">

            <div id="divMainMenu" class="col-12 col-sm-9 col-lg-10 py-4 px-0" style="width: calc(100% - 1px); flex: inherit; transition: 0.3s all ease-in-out;">

                <div class="container-fluid">

                    @if(\Request::is('configuracao/*'))
                        <div class="row">
                            <div class="col-12 mr-auto align-middle my-auto text-left">
                                <a href="{{ route('configuracao.index') }}" class="btn bg-white btn-outline border-thin text-primary box-shadow rounded px-4 py-2">
                                    <i class="fas fa-chevron-left fa-fw fa-lg mr-2"></i>
                                    Voltar as configurações
                                </a>
                            </div>
                        </div>
                    @endif

                    <div class="row mb-5 text-center">
                        <div class="col-auto mx-auto">
                                <div class="avatar-img avatar-lg my-3 mx-auto box-shadow" style="width: 54px;height: 54px; background: url({{ route('usuario.perfil.image', [Auth::user()->id]) }}); background-size: cover; background-position: 50% 50%; background-repeat: no-repeat; border: 0px;"></div>
                                <h2 class="{{ !\Request::is('configuracao/*') ? 'text-dark' : '' }}" style="{{ \Request::is('configuracao/*') ? 'color: #525870;' : '' }}">
                                    {{ ucfirst($professor->name) }}
                                </h2>
                                <small class="d-block mt-1 mb-3 {{ \Request::is('configuracao/*') ? 'text-center' : 'text-left' }}">
                                    {{--  <span class="text-lightgray">({{ $avaliacaoInstrutor }}) </span>  --}}
                                    <span>
                                        @for ($i = 0; $i < floor($avaliacaoInstrutor); $i++)
                                            <i class="fas fa-star text-lightyellow"></i>
                                        @endfor
                                        @for ($i = 0; $i < (5 - floor($avaliacaoInstrutor)); $i++)
                                            <i class="far fa-star text-lightyellow"></i>
                                        @endfor
                                    </span>
                                </small>
                                <h5 class="{{ \Request::is('configuracao/*') ? 'text-center' : 'text-left' }} font-weight-normal" style="color: #989AC1;">
                                    {{ ucfirst($professor->escola->titulo) }}
                                </h5>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-12">

                                <h5 class="mt-2 mb-3">
                                        Avaliações
                                    </h5>

                            <ul class="list-group py-3">

                                <li class="list-group-item font-weight-bold bg-transparent" style="border: 0px;">

                                    @foreach ($avaliacoes as $avaliacao)

                                        <div class="row">
                                            <div class="col-auto text-left pl-0 pr-0">
                                                <div class="avatar-img avatar-img-md my-0 d-inline-block" style="width: 54px;height: 54px; background: url({{ route('usuario.perfil.image', [$avaliacao->user['id']]) }}); background-size: cover; background-position: 50% 50%; background-repeat: no-repeat;"></div>
                                            </div>
                                            <div class="col my-auto text-left">
                                                <div class="d-inline-block align-middle mb-2">
                                                    <h5 class="d-inline-block align-middle mb-0 {{ \Request::is('configuracao/*') ? 'font-weight-normal' : 'font-weight-bold' }}" style="{{ \Request::is('configuracao/*') ? 'color: #525870;' : '' }}">
                                                        {{ ucwords($avaliacao->user->name) }}
                                                    </h5>
                                                    <small class="d-inline-block align-middle ml-2">
                                                            @for ($i = 0; $i < floor($avaliacao->avaliacao); $i++)
                                                            <i class="fas fa-star"></i>
                                                            @endfor
                                                            @for ($i = 0; $i < (5 - floor($avaliacao->avaliacao)); $i++)
                                                                <i class="far fa-star"></i>
                                                            @endfor
                                                    </small>
                                                </div>
                                                @if($avaliacao->descricao != '')
                                                    <div class="mt-3 p-4 box-shadow" style="background-color: {{ \Request::is('configuracao/*') ? '#FFF' : '#13141D;' }}">
                                                        <p class="font-weight-normal mb-0">
                                                            {{ $avaliacao->descricao }}
                                                        </p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                    @endforeach

                                    @if(count($avaliacoes) == 0)

                                        <div class="row">
                                            <div class="col text-left">
                                                <p class="font-weight-normal">
                                                    {{ ucwords($professor->name) }} ainda não possui avaliações.
                                                </p>
                                            </div>
                                        </div>

                                    @endif

                                </li>

                            </ul>

                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>

</main>

@endsection

@section('bodyend')

    <script>

        $( document ).ready(function()
        {

        });

    </script>

@endsection
