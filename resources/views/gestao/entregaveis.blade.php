@extends('layouts.master')

@section('title', 'J. PIAGET - Gestão de entregáveis')

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

    </style>

@endsection

@section('content')

<main role="main">

    <div class="container">

        <div class="row" style="height: 100%; min-height: calc(100vh - 114px);">

            {{--  @include('gestao.side-menu')  --}}

            <div id="divMainMenu" class="" style="width: calc(100% - 1px); flex: inherit; transition: 0.3s all ease-in-out;">

                {{--  <div class="col-12 col-md-11 mx-auto">  --}}

                <div class="col-12 col-md-11 mx-auto">

                    <div class="title mb-4">
                        @if(Request::is('gestao/entregaveis'))
                            <h2>Gestão de entregáveis</h2>
                        @else
                            <h2>Entregáveis do curso: <span class="text-bluegray"> {{ ucfirst($curso->titulo) }} </span></h2>
                        @endif
                    </div>

                    @if(Request::is('gestao/entregaveis'))
                        <!-- <h2>Gestão de entregáveis</h2> -->
                    @else
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb p-0 py-3 mb-4 bg-transparent border-bottom">
                                <li class="breadcrumb-item active" aria-current="page">
                                    <a href="{{ route('gestao.entregaveis') }}" >
                                        <i class="fas fa-chevron-left mr-2"></i>
                                        <span>Entregáveis</span>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Gestão de entregáveis: <strong>{{ ucfirst($curso->titulo) }}</strong> </li>
                            </ol>
                        </nav>
                    @endif

                    @if(Request::is('gestao/entregaveis'))
                        <div>

                            @foreach ($cursos as $curso)

                                <div class="col-sm-12 col-md-6 col-lg-4 px-0 mb-5">
                                    <div class="card-curso shadow-sm bg-white rounded p-2 pb-3">
                                        <div class="w-100 py-5 capa-curso" style="{{ $curso->capa != '' ? 'background-image: url('. env("APP_LOCAL") .'/uploads/cursos/capas/'. $curso->capa .');' : '' }}">
                                        </div>

                                        <div class="px-2 py-1">
                                            <p class="font-weight-bold mt-2">
                                                {{ $curso->titulo }}
                                                {{-- @if(Auth::user()->id != $curso->user->id) --}}
                                                    <small class="d-block text-gray">
                                                        Autor: {{ ucfirst($curso->user->name) }}
                                                    </small>
                                                {{-- @endif --}}
                                            </p>
                                            <div class="text-center">
                                                <a href="{{ route('gestao.entregaveis-curso', ['idCurso' => $curso->id]) }}" class="btn btn-primary">
                                                    Ver conteúdos
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            @endforeach

                            @if(count($cursos) == 0)
                                <div class="col-12 px-2 mb-4">
                                    <div class="card-curso shadow-sm rounded p-3">
                                        <h5>
                                            Não há nenhum curso com conteúdos entregáveis.
                                        </h5>
                                    </div>
                                </div>
                            @endif

                        </div>
                    @else
                        <div class="row">

                                <div class="col-12 mb-3">
                                    <div class="shadow-sm rounded bg-white py-3 text-left">
                                        <div class="container-fluid">
                                            <div class="row p-3">

                                                <div class="col-12 mb-3">
                                                    <div class="d-inline-block mr-3">
                                                        <b>Filtrar por usuário:</b>
                                                        <input type="text" id="txtFiltrarUser" placeholder="" class="form-control ml-1 d-inline-block w-auto rounded" oninput="filtrarUsuario();">
                                                    </div>
                                                    <div class="d-inline-block mr-3">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="ckbOcultarCorrigidos" onchange="filtrarCorrigidos();">
                                                            <label class="custom-control-label" for="ckbOcultarCorrigidos">Ocultar respostas corrigidas</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-3 my-auto">
                                                    <h5 class="font-weight-bold m-0">
                                                        Titulo
                                                    </h5>
                                                </div>
                                                <div class="col-3 my-auto text-center">
                                                    <h5 class="font-weight-bold m-0">
                                                        Tipo
                                                    </h5>
                                                </div>
                                                <div class="col-3 my-auto text-center">
                                                    <h5 class="font-weight-bold m-0">
                                                        Data
                                                    </h5>
                                                </div>
                                                <div class="col-3 my-auto text-right">
                                                    <h5 class="font-weight-bold m-0">
                                                        Respostas
                                                    </h5>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @foreach ($conteudos as $conteudo)

                                <div class="col-12 mb-3">
                                    <div class="shadow-sm rounded bg-light p-3 text-left">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-3 my-auto">
                                                    <h5 class="font-weight-bold m-0">
                                                        {{ ucfirst($conteudo->titulo) }}
                                                    </h5>
                                                </div>
                                                <div class="col-3 my-auto text-center">
                                                    <h5 class="font-weight-bold m-0">
                                                        {{ $conteudo->tipo == 7 ? 'Dissertativa' : ($conteudo->tipo == 8 ? 'Multipla escolha' : ($conteudo->tipo == 10 ? 'Entregável' : 'Prova'))  }}
                                                    </h5>
                                                </div>

                                                <div class="col-3 my-auto text-center">
                                                    <h5 class="font-weight-bold m-0">
                                                        {{ $conteudo->data }}
                                                    </h5>
                                                </div>
                                                <div class="col-3 my-auto text-right">
                                                    <h5 class="d-inline-block font-weight-bold m-0">
                                                        {{ count($conteudo->respostas) }}
                                                    </h5>
                                                    <button type="button" data-toggle="collapse" data-target="#collapseConteudo{{ $conteudo->id }}" aria-expanded="false" aria-controls="collapseExample" class="btn btn-sm btn-primary ml-1">
                                                        <i class="fas fa-chevron-down"></i>
                                                    </button>
                                                </div>
                                                <div class="col-12 mt-2">
                                                    @if($conteudo->tipo == 7)
                                                        <hr>
                                                        <b>Pergunta:</b> {{ $conteudo->conteudo->pergunta }}
                                                        <br>
                                                        <b>Dica:</b> {{ $conteudo->conteudo->dica }}
                                                        <br>
                                                        <b>Explicação:</b> {{ $conteudo->conteudo->explicacao }}
                                                    @elseif($conteudo->tipo == 9)
                                                        @foreach ($conteudo->conteudo as $key => $pergunta)
                                                            @if($pergunta->tipo == 1)
                                                                <div class="mb-2">
                                                                    <b>{{ ($key + 1) }}) Pergunta:</b> {{ $pergunta->pergunta }}
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        {!! $conteudo->conteudo !!}
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 collapse" id="collapseConteudo{{ $conteudo->id }}">
                                                    <div class="container-fluid">
                                                        <div class="mx-2 px-2 pt-3 mt-3" style="border-top: 3px solid #F9F9F9;">

                                                            @if(count($conteudo->respostas) > 0)
                                                                <div class="row pb-3 mb-3 border-bottom">
                                                                    <div class="col my-auto">
                                                                        <h6 class="font-weight-bold m-0">
                                                                            Usuário
                                                                        </h6>
                                                                    </div>
                                                                    <div class="col my-auto">
                                                                        <h6 class="font-weight-bold m-0">
                                                                            Data da resposta
                                                                        </h6>
                                                                    </div>
                                                                    <div class="col my-auto">
                                                                        <h6 class="font-weight-bold m-0">
                                                                            Resposta
                                                                        </h6>
                                                                    </div>
                                                                    <div class="col my-auto">
                                                                        <h6 class="font-weight-bold m-0">
                                                                            Ações
                                                                        </h6>
                                                                    </div>
                                                                </div>
                                                                @foreach ($conteudo->respostas as $resposta)
                                                                    <div class="row-resposta row mb-3">
                                                                        <div class="col my-auto">
                                                                            <h6 class="nome-usuario font-weight-bold m-0">
                                                                                {{ ucfirst($resposta->user->name) }}
                                                                            </h6>
                                                                        </div>
                                                                        <div class="col my-auto">
                                                                            <h6 class="font-weight-bold m-0">
                                                                                {{ $resposta->created_at->format('d/m/Y \à\s H:i') }}
                                                                            </h6>
                                                                        </div>
                                                                        <div class="col my-auto">
                                                                            <h6 class="font-weight-bold m-0">
                                                                                @if($conteudo->tipo != 10)
                                                                                    @if($conteudo->tipo == 9)
                                                                                        @foreach (json_decode($resposta->resposta) as $key => $resp)
                                                                                            @if($conteudo->conteudo[$key]->tipo == 1)
                                                                                                <div class="mb-2">
                                                                                                    <b>{{ ($key + 1) }})</b> {{ $resp }}
                                                                                                </div>
                                                                                            @endif
                                                                                        @endforeach
                                                                                    @else
                                                                                        {{ ucfirst($resposta->resposta) }}
                                                                                    @endif
                                                                                @else
                                                                                    <a href="{{ route('gestao.entregaveis-arquivo', ['idResposta' => $resposta->id]) }}" target="_blank" class="btn bg-bluelight px-5 signin-button m-0 text-dark font-weight-bold">
                                                                                        <i class="fas fa-paperclip fa-lg text-primary mr-2 align-middle"></i>
                                                                                        Baixar arquivo
                                                                                    </a>
                                                                                @endif
                                                                            </h6>
                                                                        </div>
                                                                        <div class="col my-auto">
                                                                            <h6 id="divCorrigirResposta{{ $resposta->id }}" class="correcao font-weight-bold m-0">
                                                                                @if($conteudo->tipo != 9)
                                                                                    @if($resposta->correta !== null && $resposta->correta !== "")
                                                                                        <span class="{{ $resposta->correta ? 'text-primary' : 'text-danger' }}">{{ $resposta->correta ? 'Correta' : 'Incorreta' }}</span>
                                                                                    @else
                                                                                        <button type="button" onclick="corrigirResposta({{ $resposta->id }}, true);" class="btn btn-sm btn-success mr-2">
                                                                                            <i class="fas fa-check"></i>
                                                                                        </button>
                                                                                        <button type="button" onclick="corrigirResposta({{ $resposta->id }}, false);" class="btn btn-sm btn-danger">
                                                                                            <i class="fas fa-times"></i>
                                                                                        </button>
                                                                                    @endif
                                                                                @else
                                                                                    @if($resposta->correta !== null)
                                                                                        @foreach (json_decode($resposta->correta) as $key => $resp)
                                                                                            @if($conteudo->conteudo[$key]->tipo == 1)
                                                                                                <span class="d-block mb-2 {{ $resp == '1' ? 'text-primary' : 'text-danger' }}">{{ $resp == '1' ? 'Correta' : 'Incorreta' }}</span>
                                                                                            @endif
                                                                                        @endforeach
                                                                                    @else
                                                                                        @foreach (json_decode($resposta->resposta) as $key => $resp)
                                                                                            @if($conteudo->conteudo[$key]->tipo == 1)
                                                                                                <div data-id="{{ $resposta->id }}" class="div-correcao">
                                                                                                    <div class="custom-control custom-radio d-inline-block mr-2">
                                                                                                        <input type="radio" id="rdoResposta{{ $resposta->id . '-' . $key }}Correta" data-op="1" name="resposta{{ $resposta->id . '-' . $key }}" class="rdo-correta custom-control-input">
                                                                                                        <label class="custom-control-label text-primary" for="rdoResposta{{ $resposta->id . '-' . $key }}Correta">Correta</label>
                                                                                                    </div>
                                                                                                    <div class="custom-control custom-radio d-inline-block">
                                                                                                        <input type="radio" id="rdoResposta{{ $resposta->id . '-' . $key }}Incorreta" data-op="0" name="resposta{{ $resposta->id . '-' . $key }}" class="rdo-inorreta custom-control-input">
                                                                                                        <label class="custom-control-label text-danger" for="rdoResposta{{ $resposta->id . '-' . $key }}Incorreta">Incorreta</label>
                                                                                                    </div>
                                                                                                </div>
                                                                                                {{--  <span class="d-block mb-2 {{ $resp == '1' ? 'text-primary' : 'text-danger' }}">{{ $resp == '1' ? 'Correta' : 'Incorreta' }}</span>  --}}
                                                                                            @else
                                                                                                <div data-id="{{ $resposta->id }}" class="div-correcao d-none">
                                                                                                </div>
                                                                                            @endif
                                                                                        @endforeach
                                                                                        <button type="button" onclick="corrigirResposta({{ $resposta->id }}, 9);" class="btn btn-sm btn-primary mt-2">
                                                                                            Enviar <i class="fas fa-check ml-2"></i>
                                                                                        </button>
                                                                                    @endif
                                                                                @endif

                                                                            </h6>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            @endif

                                                            @if(count($conteudo->respostas) == 0)
                                                                <div class="row mb-3">
                                                                    <div class="col my-auto">
                                                                        <h6 class="font-weight-bold m-0">
                                                                            Este conteudo ainda não possui respostas.
                                                                        </h6>
                                                                    </div>
                                                                </div>
                                                            @endif

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endforeach

                            @if(count($conteudos) == 0)
                                <div class="col-12 px-2 mb-4">
                                    <div class="card-curso shadow-sm rounded p-3">
                                        <h5>
                                            Este curso não possui conteúdos entregáveis.
                                        </h5>
                                    </div>
                                </div>
                            @endif

                        </div>
                    @endif

                </div>

            </div>
        </div>
    </div>

</main>

@endsection

@section('bodyend')

    <!-- Bootstrap Datepicker JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/locales/bootstrap-datepicker.pt-BR.min.js"></script>

    <script>

        $('#txtDatePicker').datepicker({
            weekStart: 0,
            language: "pt-BR",
            daysOfWeekHighlighted: "0,6",
            autoclose: true,
            todayHighlight: true
        });

        $( document ).ready(function()
        {
            @if(Auth::check())
                if(window.location.hash)
                {
                    var hash = window.location.hash.substring(1);

                    if(hash == "divulgar-revista")
                    {
                        $('#divModalNovaEdicao').modal('show');
                    }
                }
            @endif
        })



        function showListMode(mode, button)
        {
            if(mode == 1)
            {
                $('.book-item').addClass('col-lg-6');
                $('#btnListMode1').addClass("text-primary");
                $('#btnListMode2').removeClass("text-primary");
            }
            else
            {
                $('.book-item').removeClass('col-lg-6');
                $('#btnListMode2').addClass("text-primary");
                $('#btnListMode1').removeClass("text-primary");
            }
        }

        function excluirCurso(id)
        {
            if($("#formExcluirCurso" + id).length == 0)
                return;

            swal({
                title: 'Excluir curso?',
                text: "Você deseja mesmo excluir este curso? Todo seu conteúdo será apagado!",
                icon: "warning",
                buttons: ['Não', 'Sim, excluir!'],
                dangerMode: true,
            }).then((result) => {
                if (result == true)
                {
                  $("#formExcluirCurso" + id).submit();
                }
            });
        }

        @if(!Request::is('gestao/entregaveis'))

        function corrigirResposta(idResposta, correta)
        {
            var prova = false;

            if(correta === 9)
            {
                prova = true;

                if($("#divCorrigirResposta" + idResposta).find("input:checked").length < $("#divCorrigirResposta" + idResposta).find("input").length / 2)
                {
                    //console.log("marcar todos");
                    return;
                }

                var correta = [];

                $("#divCorrigirResposta" + idResposta).find(".div-correcao").each( function (index, value) {

                    console.log($(this).find("input[name='resposta" + $(this).data('id') + "-" + index + "']:checked").attr('id'));

                    if($(this).hasClass("d-none"))
                        correta[index] = null;
                    else
                        correta[index] = $(this).find("input[name='resposta" + $(this).data('id') + "-" + index + "']:checked").data('op');

                });

                console.log(correta);
            }
            else if(correta != true && correta != false)
            {
                return;
            }

            var formData = { '_token' : '{{ csrf_token() }}', 'correta': correta };

            $.ajax({
                url: '{{ env('APP_LOCAL') }}/gestao/entregaveis/curso/{{ $curso->id }}/corrigir/' + idResposta,
                type: 'post',
                dataType: 'json',
                data: formData,
                success: function( _response )
                {
                    console.log( _response );

                    if(_response.success != null)
                    {
                        if(prova)
                        {
                            $("#divCorrigirResposta" + idResposta).find(".div-correcao").each( function (index, value) {
                                if(!$(this).hasClass("d-none"))
                                {
                                    if(correta[index] == 1)
                                    {
                                        $(this).html('<span class="text-primary">Correta</span>');
                                    }
                                    else
                                    {
                                        $(this).html('<span class="text-danger">Incorreta</span>');
                                    }
                                }
                            });

                            $("#divCorrigirResposta" + idResposta + " .btn").remove();
                        }
                        else
                        {
                            if(correta)
                                $("#divCorrigirResposta" + idResposta).html('<span class="text-primary">Correta</span>');
                            else
                                $("#divCorrigirResposta" + idResposta).html('<span class="text-danger">Incorreta</span>');
                        }
                    }
                },
                error: function( _response )
                {
                    console.log( _response );
                }
            });
        }

        function filtrarUsuario()
        {
            var nome = $("#txtFiltrarUser").val().toLowerCase();

            $(".row-resposta").each(function( index ) {
                if($(this).find('.nome-usuario').text().toLowerCase().indexOf(nome) >= 0)
                {
                    $(this).removeClass('d-none');
                }
                else
                {
                    $(this).addClass('d-none');
                }
            });
        }

        function filtrarCorrigidos()
        {
            $(".row-resposta").each(function( index ) {
                if($(this).find('.correcao span:contains("Correta")').length > 0 || $(this).find('.correcao span:contains("Incorreta")').length > 0)
                {
                    if($('#ckbOcultarCorrigidos:checked').length > 0)
                    {
                        $(this).addClass('d-none');
                    }
                    else
                    {
                        $(this).removeClass('d-none');
                    }
                }
            });
        }

        @endif

    </script>

@endsection
