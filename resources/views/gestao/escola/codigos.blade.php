@extends('layouts.master')

@section('title', 'J. PIAGET - Gestão de códigos de acesso')

@section('headend')

    <!-- Custom styles for this template -->
    <style>

        @media print
        {
            .col-6, .box-codigo
            {
                width: 33% !important;
            }

            .print-hide
            {
                display: none !important;
                opacity: 0 !important;
            }

            body, main, .darkmode, main.darkmode
            {
                background: white !important;
                background-color: white !important;
            }
        }

        @media not print
        {
            .box-codigo
            {
                display: none !important;
                opacity: 0 !important;
            }
        }

    </style>

@endsection

@section('content')

<main role="main" class="">

    <div class="container-fluid pt-4 animated fadeIn">

        <div class="px-3 w-100">

            <section>

                <div class="row my-4">

                    <div class="col text-center mb-3 mb-md-0">
                        <h4 class="text-dark">
                            Códigos de acesso
                        </h4>
                    </div>

                </div>

            </section>

            <div class="py-2">
                    <div class="row">

                        <div class="text-center px-3 shadow-none border-0 mx-auto col-12 col-md-6">

                        <h4>Gerar códigos</h4>

                        @if(($escola->limite_alunos - count($alunos)) > 0)
                        <form id="formGerarCodigos" method="POST" action="{{ route('gestao.escola.codigos-gerar', ["idEscola" => $escola->id]) }}" class="">

                            @csrf

                            <div class="form-group mb-3 text-left">
                                <label class="" for="aplicacao_id">Vincular a uma turma:</label>
                                <select id="turma_id" name="turma_id" required onchange="mudouTipoLiberacaoAplicacao(this);" class="custom-select rounded">
                                    <option disabled selected>Selecione uma turma</option>
                                    @foreach ($turmas as $turma)
                                        <option value="{{ $turma->id }}">{{ ucfirst($turma->titulo) }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-3 text-left">
                                <label class="" for="aplicacao_id">Quantidade de códigos a serem gerados:</label>
                                <input id="quantidade" name="quantidade" type="number" min="0" max="{{ ($escola->limite_alunos - count($alunos) - \App\CodigoAcessoEscola::where([['escola_id', $escola->id], ['aluno_id', null]])->count()) > 0 ? $escola->limite_alunos - count($alunos) : 0 }}" placeholder="Digitar." class="form-control" required autofocus>
                            </div>

                            <button type="submit" class="btn btn-lg bg-bluelight ">Gerar códigos</button>

                        </form>
                        @else
                            <p class="">
                                Você não pode gerar mais códigos
                            </p>
                        @endif
                        </div>

                    </div>
                </div>

                <div class="row mt-4 mb-3">
                    <h5 class="w-100">
                        <span class="text-darkmode">Códigos gerados: ({{ count($codigosAcesso)  . '/' . $escola->limite_alunos }}) - Alunos vinculados: ({{ count($alunos) . '/' . $escola->limite_alunos }})</span>
                        @if(count($codigosAcesso) > 0)
                        <button type="button" onclick="$('.box-codigo, .box-codigo:not(.print-hide) span.codigo').printThis({ importCSS: true });" class="btn bg-bluelight float-right">Imprimit códigos</button>
                        @endif
                    </h5>
                </div>

                <div class="row">

                        <div class="col-12 px-0 mb-3">

                            @if(count($codigosAcesso) > 0)
                                <div class="py-2">
                                    <div id="divCodigosGerados" class="row">
                                        @foreach ($codigosAcesso as $codigo)

                                            @if($codigo->aluno_id == null)
                                                <div class="d-inline-block p-3 m-2 border-thin border-secondary box-codigo bg-white rounded-10 text-center">
                                                    <h4>{{ ucwords($escola->titulo) }}</h4>
                                                    <span class="d-block mb-2 text-center">
                                                        Na hora de se cadastrar
                                                        <br>
                                                        utilize o código de acesso abaixo:
                                                    </span>
                                                    <h4>{{ mb_strtoupper($codigo->codigo, 'UTF-8') }}</h4>
                                                </div>
                                            @endif

                                            <div id="divCodigoAcesso{{ $codigo->id }}" class="col-12 col-sm-6 col-lg-4 mb-3 {{ $codigo->aluno_id != null ? 'print-hide' : '' }}">
                                                <div class="card rounded-10 text-decoration-none h-100 border-0">
                                                    <div class="py-3 px-4 h-100 text-secondary" style="font-size: 16px;flex: 1;">
                                                        <span class="d-block mb-2 font-weight-bold">
                                                            {{ mb_strtoupper($codigo->codigo, 'UTF-8') }}
                                                        </span>
                                                        <span class="d-block mb-2 print-hide">
                                                            Turma vinculada: {{ $codigo->turma_id != null ? (\App\Turma::find($codigo->turma_id) != null ? ucwords(\App\Turma::find($codigo->turma_id)->titulo) : "Turma não encontrada") : "Não vinculado" }}
                                                        </span>
                                                        <span class="d-block mb-2 print-hide">
                                                            Aluno: {{ $codigo->aluno_id != null ? \App\User::find($codigo->aluno_id) != null ? ucwords(\App\User::find($codigo->aluno_id)->name) : "Anônimo" : "Não utilizado" }}
                                                        </span>
                                                        @if($codigo->aluno_id != null)
                                                        <span class="d-block mb-2 print-hide">
                                                            Data da utilização: {{ (strftime("%d de %b de %G às %H:%M", strtotime($codigo->updated_at))) }}
                                                        </span>
                                                        @endif
                                                    </div>

                                                    <button class="btn btn-link text-gray float-right p-2" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="position: absolute;right: 0px;margin-right: 15px;">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <button type="button" onclick="excluirCodigo({{ $codigo->id }});" class="btn btn-link text-danger dropdown-item">
                                                            Excluir código
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>

                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <p class="">
                                    Você ainda não liberou nenhuma aplicação para esta escola.
                                </p>
                            @endif

                        </div>

                    </div>

            {{--  @if(count($slides) > 0)
                <section>
                    <div class="row my-4">
                        <div class="col-md-6 text-center text-md-left mb-3 mb-md-0">
                            <h4 class="my-2" style="color: #999FB4;">
                                <i class="fas fa-file-powerpoint small-2 align-middle text-shadow mr-2"></i>
                                <span class="font-weight-bold align-middle">Slides</span>
                            </h4>
                        </div>
                    </div>

                    <div class="py-2">
                        <div class="row">
                            @foreach ($slides as $conteudo)

                                <div id="divConteudo{{ $conteudo->id }}" class="col-12 col-sm-6 col-lg-4 mb-3">
                                    <div class="card rounded-10 text-decoration-none h-100 border-0">
                                        <div class="py-3 px-4 h-100" style="color: #525870;font-size: 16px;flex: 1;">
                                            <span class="d-block mb-2">
                                                {{ ucfirst($conteudo->titulo) }} - (Id: {{ $conteudo->id }})
                                            </span>
                                            <span class="d-block font-weight-bold" style="color: #B2AC83;">
                                                <i class="fas fa-file-powerpoint fa-fw mr-1"></i>
                                                Slide
                                            </span>
                                        </div>

                                        <button class="btn btn-link text-gray float-right p-2" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="position: absolute;right: 0px;margin-right: 15px;">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a target="_blank" href="{{ route('conteudo.play', ['idConteudo' => $conteudo->id]) }}" class="btn btn-link dropdown-item">
                                                Abrir conteúdo
                                            </a>
                                            <button type="button" onclick="editarConteudo({{ $conteudo->id }})" class="btn btn-link dropdown-item">
                                                Editar conteúdo
                                            </button>
                                            <button type="button" onclick="excluirConteudo({{ $conteudo->id }});" class="btn btn-link text-danger dropdown-item">
                                                Excluir conteúdo
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                        </div>
                    </div>
                </section>
            @endif  --}}

        </div>

    </div>

</main>

@endsection

@section('bodyend')

    <!-- PrintThis JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/printThis/1.14.0/printThis.min.js"></script>

    <script>

        $( document ).ready(function()
        {

        });

        function excluirCodigo(idCodigoAcesso)
        {
            swal({
                title: "Excluir código",
                text: "Você deseja mesmo excluir este código de acesso?",
                icon: "warning",
                buttons: ["Não", "Sim"],
                dangerMode: true,
            })
            .then((deletar) =>
            {
                if (deletar)
                {
                    $.ajax({
                        url: '{{ env('APP_LOCAL') }}' + '/gestao/escola/{{ $escola->id }}/codigo/' + idCodigoAcesso + '/excluir',
                        type: 'post',
                        data: { '_token' : '{{ csrf_token() }}' },
                        dataType: 'json',
                        success: function( _response )
                        {
                            console.log( _response );

                            if(_response.success)
                            {
                                swal("Yeah!", _response.success, "success");

                                $( "#divCodigoAcesso" + idCodigoAcesso ).remove();
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
            });
        }

    </script>

@endsection
