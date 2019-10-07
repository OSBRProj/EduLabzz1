@extends('layouts.master')

@section('title', 'J. PIAGET - Mural de Gestão ' . $escola->titulo)

@section('headend')

    <!-- Bootstrap Select CSS -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css">

    <!-- Custom styles for this template -->
    <style>

        header {
            padding: 154px 0 100px;
        }

        @media (min-width: 992px) {
            header {
                padding: 156px 0 100px;
            }
        }

        .capa-curso {
            min-height: 160px;
            border-radius: 10px 10px 0px 0px;
            background-image: url('{{ env('APP_LOCAL') }}/images/default-cover.jpg');
            background-size: cover;
            background-position: 50% 50%;
            background-repeat: no-repeat;
        }

        .input-group input.text-secondary::placeholder {
            color: #989EB4;
        }

        .form-group label {
            color: #c3c5d2;
            font-weight: bold;
            font-size: 18px;
        }


        .form-control {
            color: #525870;
            font-weight: bold;
            font-size: 16px;
            border: 0px;
            border-radius: 5px;
            box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.16);
        }

        .form-control::placeholder {
            color: #B7B7B7;
        }

        .custom-select option:first-child {
            color: #B7B7B7;
        }

        input[type=range]::-webkit-slider-thumb {
            -webkit-appearance: none;
            border: 0px;
            height: 20px;
            width: 20px;
            border-radius: 50%;
            background: #c3c5d2;
            cursor: pointer;
            margin-top: 0px; /* You need to specify a margin in Chrome, but in Firefox and IE it is automatic */
        }

        input[type=range]::-webkit-slider-runnable-track {
            width: 100%;
            height: 36px;
            cursor: pointer;
            box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.16);
            background: #5678ef;
            border-radius: 90px;
            border: 8px solid #E3E5F0;
        }

        @media (min-width: 576px) {
            .side-menu {
                min-height: calc(100vh - 162px);
            }
        }

        .nav-tabs {
            border-bottom: 0;
        }

        .nav-tabs .nav-item {
            margin-bottom: 0px;
        }

        .nav-tabs .nav-link {
            border: 0px;
            font-size: 20px;
            border-bottom: 4px solid transparent;
            color: #525870;
            font-weight: bold;
            padding-bottom: 20px;
            background: transparent;
        }

        .nav-tabs .nav-link.active {
            background: transparent;
            color: #207adc;
            border-bottom: 4px solid #207adc;

        }

        .summernote-holder {
            /*padding: .375rem .75rem;*/
            padding: 0px;
            border-radius: 0px;
            border: 0px;
            box-shadow: none;
            font-size: initial;
            text-align: initial;
            color: initial;
            margin-bottom: 30px;
        }

        .table thead th {
            border: 0px;
        }

        .bg-postar {
            background-color: transparent !important;
        }

        .bg-postagem, .bg-card {
            background-color: white !important;
        }

        main.darkmode .bg-card, main.darkmode .bg-postagem, main.darkmode .bg-postar {
            background-color: #13141D !important;
        }

        main:not(.darkmode) .text-white.text-darkmode {
            color: #13141D !important;
        }

        main:not(.darkmode) .bg-light {
            background-color: white !important;
        }

        main.darkmode .bg-light {
            background-color: #272A3B !important;
        }

        .aluno-liberacao {
            padding: 10px;
            background-color: #000313;
            display: inline-block;
            border-radius: 5px;
            color: white;
        }

    </style>

@endsection

@section('content')

    <main role="main">

            <div class="container fadeIn">

            <div class="row">

                <div class="col-12 col-md-11 mx-auto">


                    <div class="row text-center mb-3">
                        <h2 class="text-primary mx-auto">
                            {{ ucfirst($escola->titulo) }}
                        </h2>
                    </div>

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item ml-auto mr-md-3 pr-md-3">
                            <a class="nav-link active" id="mural-tab" data-toggle="tab" href="#mural" role="tab"
                            aria-controls="mural" aria-selected="true">Mural</a>
                        </li>

                        <li class="nav-item mr-auto ml-md-3 pl-md-3">
                            <a class="nav-link" id="usuarios-tab" data-toggle="tab" href="#usuarios" role="tab"
                            aria-controls="usuarios" aria-selected="false">Usuários</a>
                        </li>
                    </ul>

                    <div class="tab-content pt-4" id="tabDadosUsuario">

                        <div class="tab-pane fade show active" id="mural" role="tabpanel"
                            aria-labelledby="mural-tab">

                            <div class="container-fluid">

                                <div class="row px-1">

                                    <div class="col-12">

                                        <div class="bg-light rounded-0 shadow-sm mb-2">

                                            @if( (Auth::user()->escola_id == $escola->id && Auth::user()->permissao == "P") || $escola->id && Auth::user()->permissao == "G" || $escola->id && Auth::user()->permissao == "Z")

                                                <div class="p-0 mb-3">

                                                    <form id="formPostar" method="POST"
                                                        action="{{ route('gestao.escola.mural-gestao-postar', ['escola_id' => $escola->id]) }}"
                                                        enctype="multipart/form-data" class="">

                                                        @csrf

                                                        <div id="divEnviando" class="text-center d-none">
                                                            <i class="fas fa-spinner fa-pulse fa-3x text-primary mb-3"></i>
                                                            <h4>Enviando</h4>
                                                        </div>

                                                        <div id="divEditar" class="form-page">

                                                            <div class="form-group mb-3 text-left">
                                                                {{-- <textarea class="form-control" name="conteudo" id="txtPostagem" rows="3" placeholder="Digite aqui sua postagem." onchange="escreveuPostagem();" style="font-size: 18px;"></textarea> --}}

                                                                <div class="summernote-holder text-dark">
                                                                    <textarea name="conteudo" id="txtConteudo" class="summernote-airmode d-none text-dark"></textarea>
                                                                </div>
                                                            </div>

                                                            <div class="pb-4 px-4 row">
                                                                <div class="ml-auto">
                                                                    <label for="arquivo"
                                                                        class="btn btn-outline px-2 py-1 text-uppercase font-weight-bold position-relative m-0 mr-3"
                                                                        style="border-width: 1px;border: 1px solid #207adc;color: #207adc;">
                                                                        <input type="file" class="custom-file-input"
                                                                            id="arquivo" name="arquivo"
                                                                            style="top: 0px;height:  100%;position:  absolute;left:  0px;"
                                                                            oninput="anexouArquivo(this);">
                                                                        <i class="fas fa-paperclip fa-fw fa-lg text-primary align-middle"></i>
                                                                        <span id="lblNomeArquivo"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="">
                                                                    <button id="btnEnviarPostagem" type="submit"
                                                                            onclick="enviarPostagem();"
                                                                            class="btn px-5 py-1 signin-button m-0 text-primary font-weight-bold"
                                                                            style="background: transparent;border: 1px solid #207adc;">
                                                                        Publicar
                                                                    </button>
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </form>

                                                </div>
                                            @endif

                                        </div>

                                        <div class="pb-4 text-primary">
                                            <h4>
                                                Bem-vindo ao mural de gestão da sua escola
                                                <small class="d-block mt-3">
                                                    As postagens são exibidas abaixo.
                                                    <br>
                                                    *Alunos não acessam este mural!
                                                </small>
                                            </h4>
                                        </div>

                                        @foreach ($escola->postagens_gestao as $postagem)

                                            <div class="col bg-postagem rounded shadow-sm py-4 mb-3">

                                                <div class="px-4">

                                                    <div class="row">

                                                        <div class="col-auto text-left px-0">
                                                            <div class="avatar-img my-0 d-inline-block"
                                                                style="width: 54px;height: 54px; background: url({{ route('usuario.perfil.image', [$postagem->user['id']]) }}); background-size: cover; background-position: 50% 50%; background-repeat: no-repeat;"></div>
                                                        </div>
                                                        <div class="col text-left">

                                                            <span class="d-inline-block align-middle" style="color: #999FB4;">
                                                                {{ $postagem->user['name'] }}
                                                                @if($escola->user_id == $postagem->user['id'] || $postagem->user['permissao'] != "A")
                                                                    <i class="fas fa-check-circle fa-fw ml-1"
                                                                    style="color: #798AC4;"></i>
                                                                @endif
                                                            </span>

                                                            <div class="float-right" style="color: #999FB4;">
                                                                {{ $postagem->created_at->diffForHumans() }}
                                                                {{-- {{ $postagem->created_at->format('d \d\e M \d\e Y') }} --}}
                                                            </div>

                                                            <div class="pt-2 text-primary">
                                                                {!! $postagem->conteudo !!}
                                                            </div>
                                                            @if($postagem->arquivo != null)
                                                                <div class="d-block text-left py-3">
                                                                    <a href="{{ route('gestao.escola.mural-gestao-postagem-arquivo', ['escola_id' => $escola->id, 'idPostagem' => $postagem->id]) }}"
                                                                    target="_blank"
                                                                    class="btn bg-bluelight px-5 signin-button m-0 text-dark font-weight-bold">
                                                                        <i class="fas fa-paperclip fa-lg text-primary mr-2 align-middle"></i>
                                                                        Download
                                                                    </a>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        @if($postagem->user_id == Auth::user()->id || $escola->user_id == Auth::user()->id)
                                                            <div class="col-auto ml-auto pr-0 mx-0 text-right">
                                                                <form class=""
                                                                    action="{{ route('gestao.escola.mural-gestao-postagem-excluir', ['escola_id' => $postagem->escola_id, 'idPostatem' => $postagem->id]) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    <button type="submit"
                                                                            class="btn bg-transparent p-1 mr-2">
                                                                        <i class="fas fa-trash fa-fw text-danger"></i>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        @endif

                                                    </div>

                                                    <hr style="border-color: #434763;">

                                                    <div class="">
                                                        <div class="">
                                                            <p class="small" style="color: #999FB4;">
                                                                Comentário{{ count($postagem->comentarios) != 1 ? 's' : '' }}
                                                                ({{ count($postagem->comentarios) }})
                                                            </p>
                                                        </div>
                                                    </div>

                                                    @foreach ($postagem->comentarios as $comentario)

                                                        <div class="row pl-5 pr-4 py-3">
                                                            <div class="col-auto text-left px-0">
                                                                <div class="avatar-img avatar-sm my-0 d-inline-block"
                                                                    style="width: 54px;height: 54px; background: url({{ route('usuario.perfil.image', [$comentario->user['id']]) }}); background-size: cover; background-position: 50% 50%; background-repeat: no-repeat;"></div>
                                                            </div>
                                                            <div class="col text-left">
                                                        <span class="d-inline-block align-middle" style="color: #999FB4;">
                                                            {{ $comentario->user['name'] }}
                                                            @if($comentario->user['id'] == $escola->user_id || $comentario->user['permissao'] != "A")
                                                                <i class="fas fa-check-circle fa-fw ml-1"
                                                                style="color: #798AC4;"></i>
                                                            @endif
                                                        </span>

                                                                <div class="float-right text-lightgray"
                                                                    style="color: #999FB4;">
                                                                    {{ $comentario->created_at->diffForHumans() }}
                                                                    {{-- {{ $comentario->created_at->format('d \d\e M \d\e Y') }} --}}
                                                                </div>

                                                                <div class="pt-2 text-white text-darkmode">
                                                                    {!! $comentario->conteudo !!}
                                                                </div>
                                                            </div>
                                                            @if($comentario->user_id == Auth::user()->id || $escola->user_id == Auth::user()->id)
                                                                <div class="col-auto ml-auto pr-0 mx-0 text-right">
                                                                    <form class=""
                                                                        action="{{ route('gestao.escola.mural-gestao-postagem-comentario-excluir', ['escola_id' => $postagem->escola_id, 'idPostatem' => $postagem->id, 'idComentario' => $comentario->id]) }}"
                                                                        method="post">
                                                                        @csrf
                                                                        <button type="submit"
                                                                                class="btn bg-transparent p-1">
                                                                            <i class="fas fa-trash fa-fw text-danger"></i>
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            @endif
                                                        </div>

                                                    @endforeach

                                                    <div class="row">

                                                        <div class="col-12">
                                                            <form
                                                                action="{{ route('gestao.escola.mural-gestao-postagem-comentario-enviar', ['escola_id' => $escola->id, 'idPostagem' => $postagem->id]) }}"
                                                                method="post">
                                                                <div class="input-group"
                                                                    style="font-size: 16px;margin-top:  20px;">
                                                                    @csrf
                                                                    <input type="text" id="txtComentarioPostagem"
                                                                        class="form-control bg-light shadow-sm rounded text-primary mx-auto p-2"
                                                                        name="conteudo" aria-describedby="helpId"
                                                                        placeholder="Escreva um comentário"
                                                                        style="border-right: 0px;font-weight: normal;border-radius: 10px 0px 0px 10px;">
                                                                    <div
                                                                        class="input-group-append bg-light shadow-sm rounded text-secondary m-0"
                                                                        style="border-left: 0px;box-shadow: -3px 3px 6px rgba(0,0,0,0.16);">
                                                                        <button type="submit"
                                                                                onclick="enviarComentarioPostagem({{ $postagem->id }});"
                                                                                class="btn bg-light text-primary btn-block"
                                                                                style="color: #798ac4;border-radius: 0px 10px 10px 0px;background-color: #272A3B;">
                                                                            <i class="fas fa-paper-plane"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        @endforeach

                                        @if(count($escola->postagens_gestao) == 0)

                                            <div class="bg-postagem rounded shadow-sm py-4 mb-3">

                                                <div class="container-fluid px-0">

                                                    <div class="row pl-5 pr-4">

                                                        <div class="col text-left">
                                                            Nenhuma postagem por aqui ainda.
                                                        </div>

                                                    </div>

                                                </div>

                                            </div>
                                        @endif


                                    </div>

                                </div>
                            </div>

                        </div>

                        <div class="tab-pane fade" id="usuarios" role="tabpanel" aria-labelledby="usuarios-tab">

                            <div>
                                <div>

                                    <!-- Inicio tabela de usuarios -->
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0">
                                            <thead class="thead-default">
                                            <tr>
                                                <th class="">Nome</th>
                                                @if(Auth::user()->permissao != "A")
                                                    <th class="">E-mail</th>
                                                @endif
                                                <th class="">Último acesso</th>
                                                @if(Request::is('gestao/turma/*') && ($escola->user_id == Auth::user()->id || Auth::user()->permissao == "Z"))
                                                    <th class="w-25">Ações</th>
                                                @endif
                                            </tr>
                                            </thead>
                                            <tbody class="bg-card">

                                            @if(count($usuarios) > 0)
                                                @foreach ($usuarios as $aluno)

                                                    <tr class="rounded shadow-sm">
                                                        <td>{{ ucwords($aluno->name) }}</td>
                                                        @if(Auth::user()->permissao != "A")
                                                            <td>{{ $aluno->email }}</td>
                                                        @endif
                                                        <td>{{ $aluno->permissao_name }}</td>
                                                        <td>{{ Carbon\Carbon::parse($aluno->ultima_atividade)->formatLocalized('%d de %B de %Y às %H:%M') }}</td>
                                                        @if(Request::is('gestao/turma/*') && ($escola->user_id == Auth::user()->id || Auth::user()->permissao == "Z"))
                                                            <td>
                                                                <button type="button"
                                                                        onclick="removerAluno({{ $aluno->id }}, this);"
                                                                        class="btn btn-sm text-white btn-decline">
                                                                    <i class="fas fa-times"></i>
                                                                </button>
                                                            </td>
                                                        @endif
                                                    </tr>
                                                    {{--  <tr class="spacer" style="height: 10px;"></tr>  --}}

                                                @endforeach
                                            @else

                                                <tr class="rounded shadow-sm">
                                                    <td colspan="4" class="align-middle">Não há usuários nesta escola.</td>
                                                </tr>
                                                {{--  <tr class="spacer" style="height: 10px;"></tr>  --}}

                                            @endif

                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- Fim tabela de usuarios -->

                                    <!-- Paginação -->
                                    <div class="mx-auto">

                                        @if(count($usuarios) > 0)
                                            <nav class="px-auto small mt-2 mx-auto text-center py-1 pb-0"
                                                aria-label="Page navigation example" style="margin: 0px -32px;">
                                                <ul class="pagination mb-0 d-inline-flex">
                                                    @if($usuarios->currentPage() > 2)
                                                        <li class="page-item ml-auto"><a
                                                                href="{{ $usuarios->url(0) }}&qt={{ $amount }}"
                                                                class="page-link">Primeira</a></li>
                                                    @endif
                                                    @if($usuarios->currentPage() > 1)
                                                        <li class="page-item ml-auto"><a
                                                                href="{{ $usuarios->previousPageUrl() }}&qt={{ $amount }}"
                                                                class="page-link">Anterior</a></li>
                                                    @endif
                                                    @for($i = 0; $i < $usuarios->lastPage(); $i ++)
                                                        <li class="page-item {{ $usuarios->currentPage() != $i + 1 ?: 'active' }}">
                                                            <a href="{{ $usuarios->url($i+1) }}&qt={{ $amount }}"
                                                            class="page-link">{{ $i + 1 }}</a></li>
                                                    @endfor
                                                    @if($usuarios->currentPage() < $usuarios->lastPage())
                                                        <li class="page-item mr-auto"><a
                                                                href="{{ $usuarios->nextPageUrl() }}&qt={{ $amount }}"
                                                                class="page-link">Próxima</a></li>
                                                    @endif
                                                    @if($usuarios->currentPage() < $usuarios->lastPage() - 1)
                                                        <li class="page-item mr-auto"><a
                                                                href="{{ $usuarios->url( $usuarios->lastPage() ) }}&qt={{ $amount }}"
                                                                class="page-link">Última</a></li>
                                                    @endif
                                                </ul>
                                            </nav>
                                        @endif
                                    </div>
                                    <!-- Fim paginação -->

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

        <!-- Bootstrap Select JavaScript -->
            <script
                src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>

            <!-- Bootstrap Datepicker JS -->
            <script
                src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
            <script
                src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/locales/bootstrap-datepicker.pt-BR.min.js"></script>

            <!-- Summernote css/js -->
            <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
            <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/lang/summernote-pt-BR.min.js"
                    crossorigin="anonymous"></script>


            <script>

                $('#txtDatePicker').datepicker({
                    weekStart: 0,
                    language: "pt-BR",
                    daysOfWeekHighlighted: "0,6",
                    autoclose: true,
                    todayHighlight: true
                });

                $(document).ready(function () {

                    if (window.location.hash) {
                        $(".nav-link[href='" + window.location.hash + "']").tab('show');
                    }

                    $('.summernote-airmode').summernote({
                        lang: 'pt-BR',
                        placeholder: 'Clique aqui para escrever sua postagem, você pode colocar imagens, personalizar o texto e muito mais...',
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

                function escreveuPostagem() {
                    if ($("#formPostar #txtPostagem").val() != "") {
                        $("#formPostar #btnEnviarPostagem").removeClass('d-none');
                    } else {
                        $("#formPostar #btnEnviarPostagem").addClass('d-none');
                    }
                }

                function enviarPostagem() {
                    $("#formPostar #divEnviando").removeClass('d-none');
                    $("#formPostar #divEditar").addClass('d-none');
                }

                function anexouArquivo(input) {
                    if (input.value != null && input.value != "") {
                        $("#lblNomeArquivo").text(input.value.split(/(\\|\/)/g).pop());
                    } else {
                        $("#lblNomeArquivo").text("");
                    }
                }

            </script>

@endsection
