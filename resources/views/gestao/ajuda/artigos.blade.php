@extends('layouts.master')

@section('title', 'J. PIAGET - Gestão de artigos de ajuda')

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
            box-shadow: 0px 1px 3px rgba(0,0,0,0.16);
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
            box-shadow: 0px 1px 3px rgba(0,0,0,0.16);
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

<main role="main" class="">

    <div class="container">

        <div class="row">

            <div class="col-12 col-md-11 mx-auto">

                <div class="col-12 mb-3 title pl-0">
                    <h2>Gestão de artigos de ajuda</h2>
                </div>

                <div id="divMainMenu" style="width: calc(100% - 1px); flex: inherit; transition: 0.3s all ease-in-out;">

                    <div class="mb-2 mx-3">
                        <div class="row">

                            <div class="col-sm-12 col-md-4 mb-4 text-left pl-0">
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
                            <div class="col-sm-12 col-md-8 mb-4 pr-0 text-right">
                                <form action="{{ route('gestao.ajuda.artigos') }}" method="get" class="input-group mb-3">
                                    <input type="text" name="pesquisa" value="{{ Request::get('pesquisa') }}" required placeholder="Procurar artigo" class="form-control text-truncate border-1 d-inline-block shadow-sm">
                                    <button type="submit" class="btn btn-primary p-0 border-1 rounded input-group-append d-inline-block">
                                        <span class="input-group-text border-0 bg-transparent" id="basic-addon2">
                                            <i class="fas fa-search text-light"></i>
                                        </span>
                                    </button>
                                </form>
                            </div>

                            <div class="w-100"></div>

                            <div class="col-12 px-0">
                                <button type="button" data-toggle="modal" data-target="#divModalNovoArtigo" class="btn btn-block btn-primary text-white font-weight-bold rounded shadow-none px-4 mb-2 mb-sm-0 text-truncate" data-keyboard="false" data-backdrop="static">
                                    <i class="fas fa-plus mr-3"></i>
                                    Cadastrar novo artigo
                                </button>
                            </div>

                            <!-- Modal Novo Artigo -->
                            <div class="modal fade" id="divModalNovoArtigo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body px-4">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>

                                            <form id="divPages" method="POST" action="{{ route('gestao.ajuda.artigo-novo') }}" enctype="multipart/form-data" class="text-center shadow-none border-0">

                                                @csrf

                                                <div id="page1" class="form-page text-left">

                                                    <div style="position: relative;">
                                                        <div class="text-center mb-3">
                                                            <!-- <span class="step-indicator rounded-circle mx-3 done"><i class="fas fa-check"></i></span> -->
                                                            <span class="step-indicator rounded-circle mx-3 active">1</span>
                                                        </div>
                                                    </div>

                                                    <h5 class="mt-4 mb-5 font-weight-bold col-10 ml-auto mr-auto text-center">
                                                        Novo artigo
                                                        <span class="small d-block mt-3 text-dark font-weight-normal">
                                                            Preencha o campos abaixo para criar um novo artigo.
                                                        </span>
                                                    </h5>

                                                    <div class="form-group mb-3">
                                                        <label class="" for="titulo">Título do artigo</label>
                                                        <input type="text" name="titulo" id="titulo" required class="form-control rounded-0 mb-3" placeholder="Título do artigo">
                                                    </div>

                                                    <div class="form-group mb-3">
                                                        <label class="" for="conteudo">Conteúdo do artigo</label>
                                                        {{-- <textarea class="form-control" name="descricao" id="descricao" rows="3" placeholder="Clique para digitar." required></textarea> --}}
                                                        <textarea name="conteudo" id="conteudo" class="summernote" placeholder="Clique para digitar."></textarea>
                                                    </div>

                                                    <div class="form-group mb-3">
                                                        <label class="" for="categoria">Categoria do artigo</label>
                                                        <input type="text" name="categoria" id="categoria" required class="form-control rounded-0 mb-3" placeholder="Ex.: Criação de cursos">
                                                    </div>

                                                    <div class="form-group mb-3">
                                                        <label class="" for="marcadores">Marcadores do artigo <small>(Opcional / Separar usando ponto e virgula)</small></label>
                                                        <input type="text" name="marcadores" id="marcadores" class="form-control rounded-0 mb-3" placeholder="Ex.: (marcador1; marcador2; marcador3)">
                                                    </div>

                                                    <div class="form-group mb-3">
                                                        <label for="status">Situação do artigo</label>
                                                        <select class="custom-select form-control" name="status" id="status" required>
                                                            <option disabled="disabled" selected>Selecione uma situação</option>
                                                            <option value="1">Publicado</option>
                                                            <option value="0">Não publicado</option>
                                                        </select>
                                                    </div>

                                                    <div class="row">
                                                        <button type="button" data-dismiss="modal" class="btn btn-danger my-4 col-4 ml-auto mr-4 font-weight-bold">Cancelar</button>
                                                        <button type="submit" class="btn btn-primary my-4 col-4 ml-4 mr-auto font-weight-bold">Salvar</button>
                                                    </div>

                                                </div>

                                            </form>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- Fim modal novo artigo -->

                            <div class="modal fade" id="divModalEditarArtigo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body px-4">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>

                                            <form id="divPages" method="POST" action="{{ route('gestao.ajuda.artigo-update') }}" enctype="multipart/form-data" class="text-center shadow-none border-0">

                                                @csrf

                                                <div id="page1" class="form-page text-left">

                                                    <div style="position: relative;">
                                                        <div class="text-center mb-3">
                                                            <!-- <span class="step-indicator rounded-circle mx-3 done"><i class="fas fa-check"></i></span> -->
                                                            <span class="step-indicator rounded-circle mx-3 active">1</span>
                                                        </div>
                                                    </div>

                                                    <h5 class="mt-4 mb-5 font-weight-bold col-10 ml-auto mr-auto text-center">
                                                        Editando artigo
                                                    </h5>

                                                    <div class="w-100 text-center my-2">
                                                        <span class="d-inline-block w-auto px-3" data-emoji="disappointed" title="Disappointed">
                                                            <div class="h4 mb-2">😞</div>
                                                            <b id="lblNegativo">
                                                                10 (50%)
                                                            </b>
                                                        </span>

                                                        <span class="d-inline-block w-auto px-3" data-emoji="neutral_face" title="Neutral face">
                                                            <div class="h4 mb-2">😐</div>
                                                            <b id="lblNeutro">
                                                                10 (50%)
                                                            </b>
                                                        </span>

                                                        <span class="d-inline-block w-auto px-3" data-emoji="smiley" title="Smiley">
                                                            <div class="h4 mb-2">😃</div>
                                                            <b id="lblPositivo">
                                                                10 (50%)
                                                            </b>
                                                        </span>
                                                    </div>

                                                    <input type="name" name="id" required hidden>

                                                    <div class="form-group mb-3">
                                                        <label for="titulo">Título do artigo</label>
                                                        <input type="text" name="titulo" required class="form-control rounded-0 mb-3" placeholder="Título do artigo">
                                                    </div>

                                                    <div class="form-group mb-3">
                                                        <label class="" for="editando_conteudo">Conteúdo do artigo</label>
                                                        {{-- <textarea class="form-control" name="descricao" id="descricao" rows="3" placeholder="Clique para digitar." required></textarea> --}}
                                                        <textarea name="conteudo" id="editando_conteudo" class="summernote" placeholder="Clique para digitar."></textarea>
                                                    </div>

                                                    <div class="form-group mb-3">
                                                        <label class="" for="categoria">Categoria do artigo</label>
                                                        <input type="text" name="categoria" id="categoria" required class="form-control rounded-0 mb-3" placeholder="Ex.: Criação de cursos">
                                                    </div>

                                                    <div class="form-group mb-3">
                                                        <label class="" for="marcadores">Marcadores do artigo <small>(Opcional / Separar usando ponto e virgula)</small></label>
                                                        <input type="text" name="marcadores" id="marcadores" class="form-control rounded-0 mb-3" placeholder="Ex.: (marcador1; marcador2; marcador3)">
                                                    </div>

                                                    <div class="form-group mb-3">
                                                        <label for="status">Situação do artigo</label>
                                                        <select class="custom-select form-control" name="status" id="status" required>
                                                            <option disabled="disabled">Selecione uma situação</option>
                                                            <option value="1">Publicado</option>
                                                            <option value="0">Não publicado</option>
                                                        </select>
                                                    </div>

                                                    <div class="row">
                                                        <button type="button" data-dismiss="modal" class="btn btn-danger my-4 col-4 ml-auto mr-4 font-weight-bold">Cancelar</button>
                                                        <button type="submit" class="btn btn-primary my-4 col-4 ml-4 mr-auto font-weight-bold">Salvar</button>
                                                    </div>

                                                </span>

                                            </form>

                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Painel principal -->
                    <div class="mt-3 mx-0 w-100">

                        <div class="row">
                            <div class="col-12 px-0 mx-0">

                                <div class="container-fluid px-0">

                                    @if(count($artigos) > 0)
                                    <div class="row">
                                        @foreach ($artigos as $artigo)


                                                <div id="divItemArtigo{{ $artigo->id }}" class="col-12 col-lg-6 mb-3">
                                                    <div class="rounded-10 box-shadow p-4 h-100 bg-white">
                                                        <div>
                                                            <h5 class="d-inline-block align-middle mr-2 font-weight-bold">
                                                                {{ ucfirst($artigo->titulo) }}
                                                            </h5>
                                                            <span class="align-middle d-block py-2 text-{{ $artigo->status == 1 ? 'success' : 'danger' }}">
                                                                {{ $artigo->status == 1 ? "Publicado" : "Não publicado" }}
                                                            </span>
                                                        </div>

                                                        {{-- {!! ucfirst($artigo->conteudo) !!} --}}

                                                        <p class="font-weight-bold">
                                                            <span class="text-primary">{{ ucfirst($artigo->categoria) }}</span>
                                                            -
                                                            {{ implode(';', json_decode($artigo->marcadores)) }}
                                                        </p>

                                                        <div class="text-left mb-3">
                                                            <span class="d-inline-block w-auto pr-3" data-emoji="disappointed" title="Disappointed">
                                                                😞
                                                                <b id="lblNegativo">
                                                                    {{ $artigo->total_negativo }} ({{ $artigo->total_avaliacoes > 0 ? number_format(($artigo->total_negativo * 100) / $artigo->total_avaliacoes, 1, ',' , '.') : 0 }}%)
                                                                </b>
                                                            </span>

                                                            <span class="d-inline-block w-auto pr-3" data-emoji="neutral_face" title="Neutral face">
                                                                😐
                                                                <b id="lblNeutro">
                                                                    {{ $artigo->total_neutro }} ({{ $artigo->total_avaliacoes > 0 ? number_format(($artigo->total_neutro * 100) / $artigo->total_avaliacoes, 1, ',' , '.') : 0 }}%)
                                                                </b>
                                                            </span>

                                                            <span class="d-inline-block w-auto pr-3" data-emoji="smiley" title="Smiley">
                                                                😃
                                                                <b id="lblPositivo">
                                                                    {{ $artigo->total_positivo }} ({{ $artigo->total_avaliacoes > 0 ? number_format(($artigo->total_positivo * 100) / $artigo->total_avaliacoes, 1, ',' , '.') : 0 }}%)
                                                                </b>
                                                            </span>
                                                        </div>

                                                        <button type="button" onclick="editarArtigo({{ $artigo->id }});" class="btn btn-sm text-white btn-accept mr-2">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </button>
                                                        <button type="button" onclick="deletarArtigo({{ $artigo->id }}, this);" class="btn btn-sm text-white btn-decline">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </div>
                                                </div>




                                                @endforeach
                                            </div>
                                    @else

                                        <tr class="rounded shadow-sm">
                                            <td colspan="4" class="align-middle">Não há artigos cadastradas ainda.</td>
                                        </tr>
                                        {{--  <tr class="spacer" style="height: 10px;"></tr>  --}}

                                    @endif

                                </div>

                                @if(count($artigos) > 0)

                                    <!-- Paginação -->
                                    <nav class="px-auto small mt-2 mx-auto text-center py-1 pb-0" aria-label="Page navigation example" style="margin: 0px -32px;">
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

        function editarArtigo(idArtigo)
        {
            $.ajax({
                url: appurl + '/gestao/ajuda/artigos/' + idArtigo,
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
                        $("#divModalEditarArtigo [name='status']").val(_response.artigo.status);

                        $("#divModalEditarArtigo #lblNegativo").text(_response.artigo.total_negativo + " (" + ((_response.artigo.total_negativo * 100) / _response.artigo.total_avaliacoes).toLocaleString('pt-BR', { maximumSignificantDigits: 1 }) + "%)");
                        $("#divModalEditarArtigo #lblNeutro").text(_response.artigo.total_neutro + " (" + ((_response.artigo.total_neutro * 100) / _response.artigo.total_avaliacoes).toLocaleString('pt-BR', { maximumSignificantDigits: 1 }) + "%)");
                        $("#divModalEditarArtigo #lblPositivo").text(_response.artigo.total_positivo + " (" + ((_response.artigo.total_positivo * 100) / _response.artigo.total_avaliacoes).toLocaleString('pt-BR', { maximumSignificantDigits: 1 }) + "%)");

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

        function deletarArtigo(idArtigo, button)
        {
            swal({
                title: "Deletar",
                text: "Você deseja mesmo deletar este artigo?",
                icon: "warning",
                buttons: ["Não", "Sim"],
                dangerMode: true,
            })
            .then((deletar) =>
            {
                if (deletar)
                {
                    $.ajax({
                        url: appurl + '/gestao/ajuda/artigos/' + idArtigo + '/deletar',
                        type: 'get',
                        dataType: 'json',
                        success: function( _response )
                        {
                            console.log( _response );

                            if(_response.response == true)
                            {
                                swal("Yeah!", _response.data, "success");

                                $( "#divItemArtigo" + idArtigo ).remove();
                            }
                            else
                            {
                                swal("Ops!", _response.data, "error");
                            }
                        },
                        error: function( _response )
                        {
                            console.log( _response );
                        }
                    });
                }
            });
        }

    </script>

@endsection
