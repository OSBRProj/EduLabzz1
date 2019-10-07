@extends('layouts.master')

@section('title', 'J. PIAGET - Artigos de ajuda')

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

    </style>

@endsection

@section('content')

<main role="main">

    <div class="container-fluid">
        <div class="row">

            <div id="divMainMenu" class="col-12 col-lg-10 p-5 mx-auto" style="flex: inherit; transition: 0.3s all ease-in-out;">

                <div class="mb-2 mx-4">
                    <div class="row">
                        <div class="col-12 text-left mb-4">
                            <h4 class="d-inline-block">
                                Artigos de ajuda
                            </h3>
                        </div>

                        <div class="w-100"></div>

                        <div class="col-12 text-center text-sm-left mb-4">
                            <div class="input-group mb-3 font-weight-normal box-shadow">
                                <div class="input-group-prepend">
                                    <span class="input-group-text form-control border-0 shadow-none py-3 px-4 bg-gray" id="basic-addon1"><i class="fas fa-search fa-fw"></i></span>
                                </div>
                                <input id="txtPesquisa" type="text" name="pesquisa" value="{{ Request::get('pesquisa') }}" class="form-control text-truncate rounded bg-gray border-0 font-weight-normal shadow-none py-3" oninput="pesquisarArtigo(this);" required placeholder="Procurar artigo" style="font-size: 24px;">
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 mb-4 text-center text-sm-right" hidden>
                            <div class="dropdown">
                                <label for="cmbLimite" class="h5 mr-2 font-weight-normal">Limite:</label>
                                <button class="btn dropdown-toggle w-auto border-0 bg-gray" type="button" id="cmbLimite" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ $amount }}
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="?qt=10">10</a>
                                    <a class="dropdown-item" href="?qt=15">15</a>
                                    <a class="dropdown-item" href="?qt=20">20</a>
                                    <a class="dropdown-item" href="?qt=35">35</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Painel principal -->
                <div class="mt-2 mx-2">

                    <div class="row">
                        <div class="col-12">

                            <div class="container-fluid">

                                @if(count($artigos) > 0)
                                    <div id="divArtigos" class="row">
                                        @foreach ($artigos as $artigo)

                                            <div id="divItemArtigo{{ $artigo->id }}" class="col-12 mb-3">
                                                <div class="bg-white rounded-10 box-shadow p-4">
                                                    <a href="{{ route('ajuda.artigo', ['artigo_id' => $artigo->id]) }}">
                                                        <h2 class="d-inline-block align-middle mr-2">
                                                            {{ ucfirst($artigo->titulo) }}
                                                        </h2>
                                                    </a>
                                                    <p class="text-dark align-middle">
                                                        <b class="">{{ ucfirst($artigo->categoria) }}</b>
                                                        -
                                                        {{ implode(';', json_decode($artigo->marcadores)) }}
                                                    </p>
                                                    <p class="m-0 p-0">
                                                        Postado por:
                                                        @if(\App\User::find($artigo->user_id) != null)
                                                            <b>{{ ucwords(\App\User::find($artigo->user_id)->name) }}</b>
                                                        @else
                                                            Jean Piaget
                                                        @endif
                                                        <i class="fas fa-check-circle small align-top text-primary"></i>
                                                    </p>
                                                </div>
                                            </div>

                                        @endforeach
                                    </div>
                                @else
                                    <tr class="rounded shadow-sm">
                                        <td colspan="4" class="align-middle">Não há artigos cadastradas ainda.</td>
                                    </tr>
                                @endif

                            </div>

                            @if(count($artigos) > 0)
                            @if($artigos->lastPage() > 1)

                                <!-- Paginação -->
                                <nav class="px-auto mt-4 mx-auto text-center py-1 pb-0" aria-label="Page navigation example" style="margin: 0px -32px;">
                                    <ul class="pagination mb-0 d-inline-flex">
                                        @if($artigos->currentPage() > 2)
                                            <li class="page-item ml-auto"><a href="{{ $artigos->url(0) }}&qt={{ $amount }}" class="page-link">Primeira</a></li>
                                        @endif
                                        @if($artigos->currentPage() > 1)
                                            <li class="page-item ml-auto"><a href="{{ $artigos->previousPageUrl() }}&qt={{ $amount }}" class="page-link">Anterior</a></li>
                                        @endif
                                        @for($i = 0; $i < $artigos->lastPage(); $i ++)
                                            <li class="page-item {{ $artigos->currentPage() != $i + 1 ?: 'active' }}"><a href="{{ $artigos->url($i+1) }}&qt={{ $amount }}" class="page-link">{{ $i + 1 }}</a></li>
                                        @endfor
                                        @if($artigos->currentPage() < $artigos->lastPage())
                                            <li class="page-item mr-auto"><a href="{{ $artigos->nextPageUrl() }}&qt={{ $amount }}" class="page-link">Próxima</a></li>
                                        @endif
                                        @if($artigos->currentPage() < $artigos->lastPage() - 1)
                                            <li class="page-item mr-auto"><a href="{{ $artigos->url( $artigos->lastPage() ) }}&qt={{ $amount }}" class="page-link">Última</a></li>
                                        @endif
                                    </ul>
                                </nav>
                                <!-- Fim paginação -->

                            @endif
                            @endif

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

        function editarArtigo(idArtigo)
        {
            $.ajax({
                url: appurl + '/dashboard/ajuda/artigos/' + idArtigo,
                type: 'get',
                dataType: 'json',
                success: function( _response )
                {
                    console.log( _response );

                    if(_response.success)
                    {
                        $("#divModalEditarArtigo").modal('toggle');

                        $("#divModalEditarArtigo [name='id']").val(_response.artigo.id);
                        $("#divModalEditarArtigo [name='titulo']").val(_response.artigo.titulo);

                        $("#divModalEditarArtigo [name='conteudo']").summernote("code", _response.artigo.conteudo);
                        $("#divModalEditarArtigo [name='categoria']").val(_response.artigo.categoria);
                        $("#divModalEditarArtigo [name='marcadores']").val(_response.artigo.marcadores);
                        $("#divModalEditarArtigo [name='visibilidade']").val(_response.artigo.visibilidade);
                        $("#divModalEditarArtigo [name='status']").val(_response.artigo.status);
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

        var pesquisando = false;

        function pesquisarArtigo(input)
        {
            pesquisando = true;

            //console.log(input.value);

            $("#divArtigos").html(`
                    <div class="mx-auto text-center p-3 my-5">
                    <i class="fas fa-spinner fa-pulse fa-2x mb-3 text-primary"></i>
                    <h2>Carregando resultados.</h2>
                </div>
                    `)

            setTimeout(() => {

                pesquisando = false;

            }, 150);

            setTimeout(() => {

                if(!pesquisando)
                {
                    //console.log("Buscar");

                    $.ajax({
                        url: appurl + '/ajuda/artigos/pesquisar',
                        type: 'post',
                        data: {"pesquisa": input.value, '_token': '{{ csrf_token() }}' },
                        dataType: 'json',
                        success: function( _response )
                        {
                            console.log( _response );

                            if(_response.success)
                            {
                                $("#divArtigos").html('')

                                _response.artigos.forEach(function (element, index, array) {
                                    $("#divArtigos").append(`<div id="divItemArtigo${element.id}" class="col-12 mb-3">
                                        <div class="bg-white rounded-10 box-shadow p-4">
                                            <a href="{{ env('APP_URL') }}/ajuda/artigos/${element.id}">
                                                <h2 class="d-inline-block align-middle mr-2">
                                                    ${element.titulo}
                                                </h2>
                                            </a>
                                            <p class="text-dark align-middle">
                                                <b class="">${element.categoria}</b>
                                                -
                                                ${JSON.parse(element.marcadores).join(';')}
                                            </p>
                                            <p>
                                                Postado por:
                                                ${element.user != null ? element.user.name : "Jean Piaget"}
                                                <i class="fas fa-check-circle small align-top text-primary"></i>
                                            </p>
                                        </div>
                                    </div>`);
                                });

                                if(_response.artigos.length == 0)
                                {
                                    $("#divArtigos").html(`
                                        <div class="mx-auto text-center p-3 my-5">
                                            <i class="fas fa-search fa-2x mb-3 text-primary"></i>
                                            <h2>Nenhum resultado encontrado.</h2>
                                            <p>Tente mudar o termo pesquisado</p>
                                        </div>
                                        `);
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

            }, 1000);

            return;


        }

    </script>

@endsection
