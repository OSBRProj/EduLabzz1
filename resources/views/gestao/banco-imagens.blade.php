@extends('layouts.master')

@section('title', 'J. PIAGET - Banco de imagens')

@section('headend')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css" integrity="sha256-HAaDW5o2+LelybUhfuk0Zh2Vdk8Y2W2UeKmbaXhalfA=" crossorigin="anonymous" />

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

        .card
        {
            display: flex;
            flex-direction: row;
            padding: 6px;
            border-radius: 5px;
            box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.16);
            background-color: #FFFFFF;
        }

        body.dark-mode .card
        {
            background-color: #1F212E;
        }

    </style>

@endsection

@section('content')

<main role="main">

    <div class="container">

        <div class="row">

            <section class="col-12 col-md-11 mx-auto">

                <div class="col-12 mb-3 title pl-0">
                    <h2>Banco de imagens</h2>
                </div>

                <div class="col-12 px-0 mb-4">

                    @if(count($imagens) > 0)
                        <div class="row">
                            <div class="col-sm-12 col-md-8 col-xl-9 my-auto">
                                <form action="" method="get">
                                    <div class="input-group input-group">

                                        <input name="pesquisa" type="text" value="{{ Request::has('pesquisa') ? Request::get('pesquisa') : '' }}" required class="form-control py-2 width-100 shadow-sm border-0 px-3"
                                            placeholder="Procurar aplicação."
                                            aria-label="Recipient's username" aria-describedby="button-addon2">

                                        <div class="input-group-append">
                                            <button class="btn bg-primary border-0 text-light shadow-sm" type="submit" id="button-addon2">
                                                <i class="fas fa-search fa-lg fa-fw text-light"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>

                            </div>

                            <div class="col-sm-12 col-md-4 col-xl-3">
                                <button type="button" onclick="showNovaImagem();" class="btn btn-block btn-primary text-truncate text-uppercase d-flex align-items-center justify-content-center font-weight-bold mr-3 mb-2 mb-sm-0 h-100">
                                    <i class="fas fa-plus mr-2"></i>
                                    Nova imagem
                                </button>
                            </div>

                        </div>
                    @else
                        <button type="button" onclick="showNovaImagem();" class="btn btn-primary text-truncate text-uppercase font-weight-bold mr-3 mb-2 mb-sm-0">
                            <i class="fas fa-plus mr-2"></i>
                            Nova imagem
                        </button>
                    @endif

                    @if(Request::has('pesquisa'))
                        <div class="col-sm-12 col-md-6 text-center text-md-left mb-md-0 my-3">
                            <h5 class="my-2">
                                <span class="font-weight-bold text-bluegray align-middle">Buscando por:</span>
                                <span class="font-weight-bold text-bluegray align-middle" style="background-color: #207adc;color:  white;border-radius:  25px;padding:  8px 30px;margin:  0px 10px;">
                                    "{{ ucfirst(Request::get('pesquisa')) }}"
                                    <a href="{{ url()->current() }}" class="text-white ml-2">
                                        <i class="fas fa-times"></i>
                                    </a>
                                </span>
                            </h5>
                        </div>
                    @endif

                </div>

                <div class="row my-4">

                    @if(Request::has('pesquisa'))
                        <div class="col-md-6 mb-2 text-center text-md-right mx-auto mx-md-1 ml-md-auto">
                            <div class="dropdown">
                                <label for="cmbLimite" class="h6 mr-2 font-weight-bold text-lighter">Mostrar</label>
                                <button class="btn dropdown-toggle w-auto border-0 bg-white box-shadow font-weight-bold text-lighter" type="button" id="cmbLimite" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Request::has('amount') ? Request::get('amount') : 10 }}
                                </button>
                                <div class="dropdown-menu bg-white" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item font-weight-bold text-lighter" href="{{ HelperClass::appendToUrl(['qt' => '10']) }}">10</a>
                                    <a class="dropdown-item font-weight-bold text-lighter" href="{{ HelperClass::appendToUrl(['qt' => '15']) }}">15</a>
                                    <a class="dropdown-item font-weight-bold text-lighter" href="{{ HelperClass::appendToUrl(['qt' => '20']) }}">20</a>
                                    <a class="dropdown-item font-weight-bold text-lighter" href="{{ HelperClass::appendToUrl(['qt' => '35']) }}">35</a>
                                </div>
                                <label for="cmbLimite" class="h6 ml-2 font-weight-bold text-lighter">por página</label>
                            </div>
                        </div>
                    @endif

                </div>
                <!-- END HEADER -->

                <div class="py-2">
                    <div class="row">
                        @foreach ($imagens as $imagem)

                            <div id="divImagem{{ $imagem->id }}" class="col-12 col-sm-6 col-lg-4 mb-3">
                                <div class="card rounded-10 text-decoration-none h-100 border-0">

                                    <a data-type="image" data-remote="{{ route('gestao.banco-imagens.baixar', ['imagem_id' => $imagem->id]) }}" class="card-img-auto bg-dark h-100 rounded-0" data-toggle="lightbox" style="flex: 0.6;background-image: url('{{ route('gestao.banco-imagens.baixar', ['imagem_id' => $imagem->id]) }}');background-size: cover;background-position: 50% 50%;background-repeat: no-repeat;min-height: 115px;">
                                    </a>

                                    <div class="py-3 px-4 h-100" style="color: #525870;font-size: 16px;flex: 1;">
                                        <span class="text-dark d-block mb-2">
                                            {{ ucfirst($imagem->titulo) }}
                                        </span>
                                        <span class="d-block font-weight-bold mb-2">
                                            <i class="fas fa-{{ $imagem->visibilidade == 0 ? 'eye-slash' : 'eye' }} fa-fw mr-1"></i>
                                            {{ $imagem->visibilidade == 0 ? 'Particular' : 'Público' }}
                                        </span>
                                        <p class="text-muted small">
                                            {{ ucfirst($imagem->descricao) }}
                                        </p>

                                    </div>

                                    <button class="btn btn-link text-gray float-right p-2" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="position: absolute;right: 0px;margin-right: 15px;">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a target="_blank" href="{{ route('gestao.banco-imagens.baixar', ['imagem_id' => $imagem->id]) }}" class="btn btn-link dropdown-item">
                                            Baixar imagem
                                        </a>
                                        <button type="button" onclick="editarImagem({{ $imagem->id }})" class="btn btn-link dropdown-item">
                                            Editar imagem
                                        </button>
                                        <button type="button" onclick="excluirImagem({{ $imagem->id }});" class="btn btn-link text-danger dropdown-item">
                                            Excluir imagem
                                        </button>
                                    </div>
                                </div>
                            </div>

                        @endforeach

                        @if(count($imagens) == 0)
                            <div id="divSemImagens" class="col-12 mb-3">
                                Nenhuma imagem cadastrado no banco de imagens
                            </div>
                        @endif

                        @if(Request::has('pesquisa') && count($imagens) == 0)

                            <div class="col-12 col-lg-6">
                                <h4 class="my-2">
                                    <span class="font-weight-bold text-bluegray align-middle">Infelizmente não encontramos resultados para sua busca.</span>
                                </h4>
                                <div class="my-3">
                                    <h5 class="my-2">
                                        <span class="font-weight-normal text-bluegray align-middle">Recomendamos ajustar sua busca. Aqui estão algumas ideias:</span>
                                    </h5>
                                    <ul class="no-result-page--idea-list--3YX3z">
                                        <li>Verifique se todas as palavras estão com a ortografia correta.</li>
                                        <li>Tente usar termos de pesquisa diferentes.</li>
                                        <li>Tente usar termos de pesquisa mais genéricos.</li>
                                    </ul>
                                </div>
                            </div>

                        @endif


                    </div>
                </div>

            </section>


        </div>

        <!-- Modal Nova imagem -->
        <div class="modal fade" id="divModalNovaImagem" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md px-1 px-md-5" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                        <form id="formNovaImagem" method="POST" action="{{ route('gestao.banco-imagens.cadastrar') }}" enctype="multipart/form-data" class="text-center px-3 shadow-none border-0">

                            @csrf

                            <div id="divLoading" class="text-center">
                                <i class="fas fa-spinner fa-pulse fa-3x text-primary"></i>
                            </div>

                            <div id="divEnviando" class="text-center d-none">
                                <i class="fas fa-spinner fa-pulse fa-3x text-primary mb-3"></i>
                                <h4>Enviando</h4>
                            </div>

                            <div id="divEditar" class="form-page d-none">

                                <div id="page1" class="form-page">

                                    <h4 class="my-3">Nova imagem</h4>

                                    <div class="form-group mb-3 text-left">
                                        <label class="font-weight-bold" for="titulo">Título da imagem</label>
                                        <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Clique para digitar." required>
                                    </div>

                                    <div class="form-group mb-3 text-left">
                                        <label class="font-weight-bold" for="descricao">Descrição da imagem <small>(opcional)</small></label>
                                        <textarea class="form-control" name="descricao" id="descricao" rows="3" placeholder="Clique para digitar."></textarea>
                                    </div>

                                    <div class="tipos-conteudo text-left">

                                        <div class="form-group mb-3 text-left">
                                            <label for="arquivo_imagem"><span class="font-weight-bold">Clique para fazer upload da imagem</span> (JPEG, PNG, SVG)</label>
                                            <br>
                                            <div class="upload-btn-wrapper">
                                                <button class="btn btn-primary file-name">Selecionar arquivo</button>
                                                <input type="file" name="arquivo_imagem" id="arquivo_imagem" onchange="mudouArquivoInput(this);" required accept="image/*" />
                                            </div>
                                        </div>

                                        {{-- <div class="form-group mb-3 text-left">
                                            <label class="" for="url_imagem">Ou digite o link</label>
                                            <input type="text" class="form-control" name="url_imagem" id="url_imagem" placeholder="Clique para digitar.">
                                        </div> --}}

                                    </div>

                                    <div class="form-group mb-3 text-left">
                                        <label class="font-weight-bold" for="visibilidade">Visibilidade da imagem</label>
                                        <select id="visibilidade" name="visibilidade" required class="custom-select rounded">
                                            <option disabled value="">Selecione uma visibilidade</option>
                                            <option value="0">Particular</option>
                                            <option value="1">Público</option>
                                        </select>
                                    </div>

                                    <div class="row">
                                        <button type="button" data-dismiss="modal" class="btn btn-danger mt-4 mb-0 col-4 ml-auto mr-4 font-weight-bold">Cancelar</button>
                                        <button type="button" onclick="salvarImagem();" class="btn btn-primary mt-4 mb-0 col-4 ml-4 mr-auto font-weight-bold">Salvar</button>
                                    </div>

                                </div>



                            </div>

                        </form>

                    </div>

                </div>
            </div>
        </div>
        <!-- Fim modal nova imagem -->

        <!-- Modal Editar Conteudo -->
        <div class="modal fade" id="divModalEditarImagem" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md px-1 px-md-5" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                        <form id="formEditarImagem" method="POST" action="{{ route('gestao.banco-imagens.atualizar') }}" enctype="multipart/form-data" class="text-center px-3 shadow-none border-0">

                            @csrf

                            <input name="imagem_id" required hidden>

                            <div id="divLoading" class="text-center">
                                <i class="fas fa-spinner fa-pulse fa-3x text-primary"></i>
                            </div>

                            <div id="divEnviando" class="text-center d-none">
                                <i class="fas fa-spinner fa-pulse fa-3x text-primary mb-3"></i>
                                <h4>Enviando</h4>
                            </div>

                            <div id="divEditar" class="form-page d-none">

                                <div id="page1" class="form-page">

                                    <h4>Nova imagem</h4>

                                    <div class="form-group mb-3 text-left">
                                        <label class="" for="titulo">Título da imagem</label>
                                        <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Clique para digitar." required>
                                    </div>

                                    <div class="form-group mb-3 text-left">
                                        <label class="" for="descricao">Descrição da imagem <small>(opcional)</small></label>
                                        <textarea class="form-control" name="descricao" id="descricao" rows="3" placeholder="Clique para digitar."></textarea>
                                    </div>

                                    <div class="tipos-conteudo text-left">

                                        <div class="form-group mb-3 text-left">
                                            <label class="" for="arquivo_imagem">Clique para fazer upload de uma nova imagem (JPEG, PNG, SVG)</label>
                                            <br>
                                            <div class="upload-btn-wrapper">
                                                <button class="btn btn-lg bg-primary text-white file-name">Selecionar arquivo</button>
                                                <input type="file" name="arquivo_imagem" id="arquivo_imagem" onchange="mudouArquivoInput(this);"  accept="image/*" />
                                            </div>
                                        </div>

                                        {{-- <div class="form-group mb-3 text-left">
                                            <label class="" for="url_imagem">Ou digite o link</label>
                                            <input type="text" class="form-control" name="url_imagem" id="url_imagem" placeholder="Clique para digitar.">
                                        </div> --}}

                                    </div>

                                    <div class="form-group mb-3 text-left">
                                        <label class="" for="visibilidade">Visibilidade da imagem</label>
                                        <select id="visibilidade" name="visibilidade" required class="custom-select rounded">
                                            <option disabled>Selecione uma visibilidade</option>
                                            <option value="0">Particular</option>
                                            <option value="1">Público</option>
                                        </select>
                                    </div>

                                    <div class="row">
                                        <button type="button" data-dismiss="modal" class="btn btn-lg btn-block outline-button mt-4 mb-0 col-4 ml-auto mr-4 font-weight-bold">Cancelar</button>
                                        <button type="button" onclick="salvarEdicaoImagem();" class="btn btn-lg bg-primary btn-block signin-button mt-4 mb-0 col-4 ml-4 mr-auto text-white font-weight-bold">Salvar</button>
                                    </div>

                                </div>

                            </div>

                        </form>

                    </div>

                </div>
            </div>
        </div>
        <!-- Fim modal editar conteudo -->

    </div>

</main>

@endsection

@section('bodyend')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js" integrity="sha256-Y1rRlwTzT5K5hhCBfAFWABD4cU13QGuRN6P5apfWzVs=" crossorigin="anonymous"></script>

    <script>

        $( document ).ready(function()
        {

        });

        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox();
        });

        function showNovaImagem()
        {
            $("#divModalNovaImagem").modal({ keyboard: false, backdrop: 'static' });
            $("#divModalNovaImagem #divLoading").addClass('d-none');
            $("#divModalNovaImagem #divEnviando").addClass('d-none');
            $("#divModalNovaImagem #divEditar").removeClass('d-none');

            $("#divModalNovaImagem [name='titulo']").val('');
            $("#divModalNovaImagem [name='descricao']").val('');
            $("#divModalNovaImagem [name='visibilidade']").val('');

            $("#divModalNovaImagem [name='titulo']").focus();
        }

        function salvarImagem()
        {
            var isValid = true;

            $('#divModalNovaImagem input').each(function() {
                if ( $(this).val() === '' && $(this).attr('required') )
                {
                    $(this).focus();

                    isValid = false;
                }
            });

            if(!isValid || $("#divModalNovaImagem textarea").html() == '')
                return;

            $("#formNovaImagem").submit();

            $("#divModalNovaImagem #divLoading").addClass('d-none');
            $("#divModalNovaImagem #divEditar").addClass('d-none');
            $("#divModalNovaImagem #divEnviando").removeClass('d-none');

            $("#divModalNovaImagem #divLoading").addClass('d-none');
            $("#divModalNovaImagem #divEditar").addClass('d-none');
            $("#divModalNovaImagem #divEnviando").removeClass('d-none');
        }

        function editarImagem(imagem_id)
        {
            $("#divModalEditarImagem").modal({ keyboard: false, backdrop: 'static' });
            $("#divModalEditarImagem #divLoading").removeClass('d-none');
            $("#divModalEditarImagem #divEditar").addClass('d-none');
            $("#divModalEditarImagem #divEnviando").addClass('d-none');

            $("#divModalEditarImagem .form-page").addClass('d-none');
            $("#divModalEditarImagem #page1").removeClass('d-none');

            $.ajax({
                url: appurl + '/gestao/banco-imagens/' + imagem_id,
                type: 'get',
                dataType: 'json',
                success: function( _response )
                {
                    console.log( _response );

                    if(_response.response == true)
                    {
                        $("#divModalEditarImagem [name='imagem_id']").val(_response.imagem.id);
                        $("#divModalEditarImagem [name='titulo']").val(_response.imagem.titulo);
                        $("#divModalEditarImagem [name='descricao']").val(_response.imagem.descricao);
                        $("#divModalEditarImagem [name='visibilidade']").val(_response.imagem.visibilidade);

                        $("#divModalEditarImagem #divLoading").addClass('d-none');
                        $("#divModalEditarImagem #divEditar").removeClass('d-none');
                    }
                    else
                    {
                        swal("Ops!", _response.error, "error");

                        $("#divModalEditarImagem").modal({ keyboard: false, backdrop: 'static' });
                    }
                },
                error: function( _response )
                {
                    console.log( _response );
                }
            });
        }

        function salvarEdicaoImagem()
        {
            var isValid = true;

            $('#divModalEditarImagem input').each(function() {
                if ( $(this).val() === '' && $(this).attr('required') )
                {
                    $(this).focus();

                    isValid = false;
                }
            });

            if(!isValid)
                return;

            $("#formEditarImagem").submit();

            $("#divModalEditarImagem #divLoading").addClass('d-none');
            $("#divModalEditarImagem #divEditar").addClass('d-none');
            $("#divModalEditarImagem #divEnviando").removeClass('d-none');

            $("#divModalEditarImagem #divLoading").addClass('d-none');
            $("#divModalEditarImagem #divEditar").addClass('d-none');
            $("#divModalEditarImagem #divEnviando").removeClass('d-none');
        }

        function excluirImagem(imagem_id)
        {
            swal({
                title: "Excluir imagem",
                text: "Você deseja mesmo excluir esta imagem?",
                icon: "warning",
                buttons: ["Não", "Sim"],
                dangerMode: true,
            })
            .then((deletar) =>
            {
                if (deletar)
                {
                    $.ajax({
                        url: '{{ env('APP_LOCAL') }}' + '/gestao/banco-imagens/' + imagem_id + '/excluir',
                        type: 'post',
                        data: { '_token' : '{{ csrf_token() }}' },
                        dataType: 'json',
                        success: function( _response )
                        {
                            //console.log( _response );

                            if(_response.response)
                            {
                                swal("Yeah!", _response.data, "success");

                                $( "#divImagem" + imagem_id ).remove();
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
