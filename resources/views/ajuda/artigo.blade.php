@extends('layouts.master')

@section('title', 'J. PIAGET - ' . ucfirst($artigo->titulo))

@section('headend')

    <!-- Custom styles for this template -->
    <style>

        main
        {
            background-color: #f3f3f3;
        }

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
            background: #008cc8;
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

        .btn.content-reaction
        {
            transition: 0.1s all ease-in-out;
            box-shadow: none !important;
        }

        .btn.content-reaction.active
        {
            transform: scale(1.5);
        }

        .btn.content-reaction:hover
        {
            transform: scale(1.6);
        }

        .btn.content-reaction:active
        {
            transform: scale(2.2);
        }

    </style>

@endsection

@section('content')

<main role="main">

    <div class="container-fluid">
        <div class="row">

            <div id="divMainMenu" class="col-12 col-lg-10 py-5 px-0 mx-auto" style="flex: inherit; transition: 0.3s all ease-in-out;">

                <div class="mb-2 mx-4">
                    <div class="row">

                        <div class="col-12 col-sm-6 mb-4 pr-0 text-center text-sm-left">
                            <a href="{{ route('ajuda.artigos') }}" class="btn btn-primary w-auto border-0 bg-gray">
                                <i class="fas fa-chevron-left mr-2"></i>
                                Voltar
                            </a>
                        </div>

                        <div class="w-100 my-3"></div>

                        <div class="col-12 text-center mb-4 pl-0">
                            <h2 class="d-inline-block">
                                {{ ucfirst($artigo->titulo) }}
                            </h2>
                            <p>
                                Postado por:
                                @if(\App\User::find($artigo->user_id) != null)
                                    <b>{{ ucwords(\App\User::find($artigo->user_id)->name) }}</b>
                                @else
                                    Jean Piaget
                                @endif
                                <i class="fas fa-check-circle small align-top text-primary"></i>

                                <br>

                                <small>
                                    {{ \Carbon\Carbon::parse($artigo->created_at)->format('d/m/Y \à\s H:i') }}
                                </small>
                            </p>
                        </div>

                    </div>
                </div>

                <!-- Painel principal -->
                <div class="mt-2 mx-2">

                    <div class="row">
                        <div class="col-12 col-md-10 col-xl-8 mx-auto">

                            <div class="container-fluid px-0">

                                <div id="divItemArtigo{{ $artigo->id }}" class="col-12 px-0 mx-auto">
                                    <div class="bg-white rounded-10 box-shadow p-4">

                                        {!! $artigo->conteudo !!}

                                        <p class="text-dark align-middle">
                                            <b class="">{{ ucfirst($artigo->categoria) }}</b>
                                            -
                                            {{ $artigo->marcadores }}
                                        </p>

                                        {{--  <div class="spacer py-3"></div>  --}}

                                        <div class="content-reaction-picker mx-auto text-center mt-5 py-3 bg-gray" dir="ltr">

                                            <h5 class="mb-3">Encontrou sua resposta?</h5>

                                            <button onclick="avaliarConteudo(-1);" class="btn bg-transparent btn-lg content-reaction {{ $artigo->avaliacoes_user != null ? $artigo->avaliacoes_user->avaliacao == -1 ?  'active' : '' : '' }}" data-reaction-text="disappointed" tabindex="0" aria-label="Disappointed Reaction">
                                                <span class="h4" data-emoji="disappointed" title="Disappointed">😞</span>
                                            </button>

                                            <button onclick="avaliarConteudo(0);" class="btn bg-transparent btn-lg content-reaction {{ $artigo->avaliacoes_user != null ? $artigo->avaliacoes_user->avaliacao == 0 ?  'active' : '' : '' }}" data-reaction-text="neutral_face" tabindex="0" aria-label="Neutral face Reaction">
                                                <span class="h4" data-emoji="neutral_face" title="Neutral face">😐</span>
                                            </button>

                                            <button onclick="avaliarConteudo(1);" class="btn bg-transparent btn-lg content-reaction {{ $artigo->avaliacoes_user != null ? $artigo->avaliacoes_user->avaliacao == 1 ?  'active' : '' : '' }}" data-reaction-text="smiley" tabindex="0" aria-label="Smiley Reaction">
                                                <span class="h4" data-emoji="smiley" title="Smiley">😃</span>
                                            </button>

                                        </div>

                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

</main>

@endsection

@section('bodyend')

    <!-- Summernote css/js -->
    {{-- <link href="{{ env('APP_LOCAL') }}/assets/css/summernote-lite-cerulean.min.css" rel="stylesheet"> --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/lang/summernote-pt-BR.min.js" crossorigin="anonymous"></script>

    <!-- Mask JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>

    <script>

        $( document ).ready(function()
        {
            //$('.money').mask("#.##0,00", {reverse: true});

            $('.summernote').summernote({
                placeholder: "Clique para digitar.",
                lang: 'pt-BR',
                airMode: false,
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['fontsize', 'color']],
                    ['font', ['fontname']],
                    ['para', ['paragraph']],
                    ['insert', ['hr', 'picture', 'video', 'link', 'table', 'image', 'doc']],
                    ['misc', ['undo', 'redo', 'codeview', 'fullscreen', 'help']],
                ],
                popover: {
                    image: [
                        ['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],
                        ['float', ['floatLeft', 'floatRight', 'floatNone']],
                        ['remove', ['removeMedia']]
                    ],
                    link: [
                        ['link', ['linkDialogShow', 'unlink']]
                    ],
                    air: [
                        ['style', ['style']],
                        ['font', ['bold', 'italic', 'underline', 'clear']],
                        ['font', ['fontsize', 'color']],
                        ['font', ['fontname']],
                        ['para', ['paragraph']],
                        ['table', ['table']],
                        ['insert', ['hr', 'picture', 'video', 'link', 'table', 'image', 'doc']],
                        ['misc', ['undo', 'redo']],
                    ],
                },
            });

        });

        function avaliarConteudo(avaliacao)
        {
            $(".content-reaction-picker .content-reaction").removeClass('active');

            $.ajax({
                url: appurl + '/ajuda/artigos/' + {{ $artigo->id }} + '/avaliar',
                type: 'post',
                data: {"avaliacao": avaliacao, '_token': '{{ csrf_token() }}' },
                dataType: 'json',
                success: function( _response )
                {
                    console.log( _response );

                    if(_response.success)
                    {
                        if(avaliacao == -1)
                        {
                            $(".content-reaction-picker").find("[data-reaction-text='disappointed']").addClass('active');
                        }
                        else if(avaliacao == 0)
                        {
                            $(".content-reaction-picker").find("[data-reaction-text='neutral_face']").addClass('active');
                        }
                        else if(avaliacao == 1)
                        {
                            $(".content-reaction-picker").find("[data-reaction-text='smiley']").addClass('active');
                        }
                    }
                    else
                    {
                        swal("Ops!", _response.error, "error");
                    }
                },
                error: function( _response )
                {
                    console.log( _response );
                }
            });
        }

    </script>

@endsection
