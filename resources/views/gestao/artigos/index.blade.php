@extends('layouts.master')

@section('title', 'J. PIAGET - Gestão de artigos')

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

                <div class="row">
                    <div class="col-12 mb-3 title pl-0">
                        <h2>Artigos</h2>
                    </div>

                    <div class="col-12 px-0 mb-4">

                        @if(count($artigos) > 0)
                            <div class="row">
                                <div class="col-sm-12 col-md-8 col-xl-9 my-auto">
                                    <form action="" method="get">
                                    <div class="input-group input-group mb-3">

                                            <input name="pesquisa" type="text" value="{{ Request::has('pesquisa') ? Request::get('pesquisa') : '' }}" required class="form-control py-2 width-100 shadow-sm border-0 px-3"
                                                placeholder="Procurar artigo."
                                                aria-label="Recipient's username" aria-describedby="button-addon2">

                                            <div class="input-group-append">
                                                <button class="btn bg-primary border-0 text-light shadow-sm" type="submit" id="button-addon2">
                                                    <i class="fas fa-search fa-lg fa-fw text-light"></i>
                                                </button>
                                            </div>
                                        </div>
                                        </form>

                                </div>

                                <div class="col-sm-12 col-md-4 col-xl-3 mb-3">
                                    <a href="{{ route('gestao.artigos.novo') }}" class="btn btn-block btn-primary text-truncate text-uppercase d-flex align-items-center justify-content-center font-weight-bold mr-3 mb-2 mb-sm-0 h-100">
                                        <i class="fas fa-plus mr-2"></i>
                                        Novo artigo
                                    </a>
                                </div>

                            </div>
                        @else
                            <a href="{{ route('gestao.artigos.novo') }}" class="btn btn-primary text-truncate text-uppercase font-weight-bold mr-3 mb-2 mb-sm-0">
                                <i class="fas fa-plus mr-2"></i>
                                Novo artigo
                            </a>
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
                </div>

                <div class="row">

                    @if(Request::has('pesquisa'))
                        <div class="col-md-6 mb-2 text-center text-md-right mx-auto mx-md-1 ml-md-auto">
                            <div class="dropdown">
                                <label for="cmbLimite" class="h6 mr-2 font-weight-bold text-lighter">Mostrar</label>
                                <button class="btn dropdown-toggle w-auto border-0 bg-white box-shadow font-weight-bold text-lighter" type="button" id="cmbLimite" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Request::has('qt') ? Request::get('qt') : 10 }}
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
                        @foreach ($artigos as $artigo)

                            <div id="divArtigo{{ $artigo->id }}" class="col-12 col-sm-6 col-lg-4 mb-3">
                                <div class="card rounded-10 text-decoration-none h-100 border-0">

                                    <div class="card-img-auto bg-dark h-100 rounded-0" style="flex: 0.6;background-image: url('{{ env("APP_LOCAL") . '/uploads/artigos/' . $artigo->capa }}');background-size: cover;background-position: 50% 50%;background-repeat: no-repeat;min-height: 115px;">
                                    </div>
                                    <div class="py-3 px-4 h-100 w-100" style="color: #525870;font-size: 16px;flex: 1;">
                                        <span class="text-dark d-block mb-2">
                                            {{ ucfirst($artigo->titulo) }}
                                        </span>
                                        <span class="d-block font-weight-bold mb-2">
                                            <i class="fas fa-{{ $artigo->status == 0 ? 'times' : 'check' }} fa-fw mr-1"></i>
                                            {{ $artigo->status == 0 ? 'Não publicado' : 'Publicado' }}
                                        </span>
                                        <p class="text-muted small">
                                            {{ ucfirst($artigo->descricao) }}
                                        </p>

                                    </div>

                                    <button class="btn btn-link text-gray float-right p-2" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="position: absolute;right: 0px;margin-right: 15px;">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a target="_blank" href="{{ route('gestao.artigos.ler', ['artigo_id' => $artigo->id, 'sluged_title' => str_slug($artigo->titulo, '-') ]) }}" class="btn btn-link dropdown-item">
                                            Ver artigo
                                        </a>
                                        <a href="{{ route('gestao.artigos.editar', ['artigo_id' => $artigo->id]) }}" class="btn btn-link dropdown-item">
                                            Editar artigo
                                        </a>
                                        <button type="button" onclick="excluirArtigo({{ $artigo->id }});" class="btn btn-link text-danger dropdown-item">
                                            Excluir artigo
                                        </button>
                                    </div>
                                </div>
                            </div>

                        @endforeach

                        @if(count($artigos) == 0)
                            <div id="divSemArtigos" class="col-12 mb-3">
                                Ainda não há nada para ver por aqui.
                            </div>
                        @endif

                        @if(Request::has('pesquisa') && count($artigos) == 0)

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

        <!-- Modal Novo artigo -->
        <div class="modal fade" id="divModalNovoArtigo" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md px-1 px-md-5" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                        <form id="formNovoArtigo" method="POST" action="{{ route('gestao.artigos.cadastrar') }}" enctype="multipart/form-data" class="text-center px-3 shadow-none border-0">

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

                                    <h4>Novo artigo</h4>

                                    <div class="form-group mb-3 text-left">
                                        <label class="" for="titulo">Título da artigo</label>
                                        <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Clique para digitar." required>
                                    </div>

                                    <div class="form-group mb-3 text-left">
                                        <label class="" for="descricao">Descrição da artigo <small>(opcional)</small></label>
                                        <textarea class="form-control" name="descricao" id="descricao" rows="3" placeholder="Clique para digitar."></textarea>
                                    </div>

                                    <div class="tipos-conteudo text-left">

                                        <div class="form-group mb-3 text-left">
                                            <label class="" for="arquivo_capa">Clique para fazer upload da artigo (JPEG, PNG, SVG)</label>
                                            <br>
                                            <div class="upload-btn-wrapper">
                                                <button class="btn btn-lg bg-primary text-white file-name">Selecionar arquivo</button>
                                                <input type="file" name="arquivo_capa" id="arquivo_capa" onchange="mudouArquivoInput(this);" required accept="image/*" />
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group mb-3 text-left">
                                        <label class="" for="status">Status do artigo</label>
                                        <select id="status" name="status" required class="custom-select rounded">
                                            <option disabled value="">Selecione um status</option>
                                            <option value="0">Não publicado</option>
                                            <option value="1">Publicado</option>
                                        </select>
                                    </div>

                                    <div class="row">
                                        <button type="button" data-dismiss="modal" class="btn btn-lg btn-block outline-button mt-4 mb-0 col-4 ml-auto mr-4 font-weight-bold">Cancelar</button>
                                        <button type="button" onclick="salvarArtigo();" class="btn btn-lg bg-primary btn-block signin-button mt-4 mb-0 col-4 ml-4 mr-auto text-white font-weight-bold">Salvar</button>
                                    </div>

                                </div>



                            </div>

                        </form>

                    </div>

                </div>
            </div>
        </div>
        <!-- Fim modal nova artigo -->

        <!-- Modal Editar Conteudo -->
        <div class="modal fade" id="divModalEditarArtigo" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md px-1 px-md-5" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                        <form id="formEditarArtigo" method="POST" action="{{ route('gestao.artigos.atualizar') }}" enctype="multipart/form-data" class="text-center px-3 shadow-none border-0">

                            @csrf

                            <input name="artigo_id" required hidden>

                            <div id="divLoading" class="text-center">
                                <i class="fas fa-spinner fa-pulse fa-3x text-primary"></i>
                            </div>

                            <div id="divEnviando" class="text-center d-none">
                                <i class="fas fa-spinner fa-pulse fa-3x text-primary mb-3"></i>
                                <h4>Enviando</h4>
                            </div>

                            <div id="divEditar" class="form-page d-none">

                                <div id="page1" class="form-page">

                                    <h4>Novo artigo</h4>

                                    <div class="form-group mb-3 text-left">
                                        <label class="" for="titulo">Título da artigo</label>
                                        <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Clique para digitar." required>
                                    </div>

                                    <div class="form-group mb-3 text-left">
                                        <label class="" for="descricao">Descrição da artigo <small>(opcional)</small></label>
                                        <textarea class="form-control" name="descricao" id="descricao" rows="3" placeholder="Clique para digitar."></textarea>
                                    </div>

                                    <div class="tipos-conteudo text-left">

                                        <div class="form-group mb-3 text-left">
                                            <label class="" for="arquivo_capa">Clique para fazer upload de uma nova artigo (JPEG, PNG, SVG)</label>
                                            <br>
                                            <div class="upload-btn-wrapper">
                                                <button class="btn btn-lg bg-primary text-white file-name">Selecionar arquivo</button>
                                                <input type="file" name="arquivo_capa" id="arquivo_capa" onchange="mudouArquivoInput(this);"  accept="image/*" />
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group mb-3 text-left">
                                        <label class="" for="status">Status do artigo</label>
                                        <select id="status" name="status" required class="custom-select rounded">
                                            <option disabled>Selecione um status</option>
                                            <option value="0">Não publicado</option>
                                            <option value="1">Publicado</option>
                                        </select>
                                    </div>

                                    <div class="row">
                                        <button type="button" data-dismiss="modal" class="btn btn-lg btn-block outline-button mt-4 mb-0 col-4 ml-auto mr-4 font-weight-bold">Cancelar</button>
                                        <button type="button" onclick="salvarEdicaoArtigo();" class="btn btn-lg bg-primary btn-block signin-button mt-4 mb-0 col-4 ml-4 mr-auto text-white font-weight-bold">Salvar</button>
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

    <script>

        $( document ).ready(function()
        {

        });

        function showNovoArtigo()
        {
            $("#divModalNovoArtigo").modal({ keyboard: false, backdrop: 'static' });
            $("#divModalNovoArtigo #divLoading").addClass('d-none');
            $("#divModalNovoArtigo #divEnviando").addClass('d-none');
            $("#divModalNovoArtigo #divEditar").removeClass('d-none');

            $("#divModalNovoArtigo [name='titulo']").val('');
            $("#divModalNovoArtigo [name='descricao']").val('');
            $("#divModalNovoArtigo [name='status']").val('');

            $("#divModalNovoArtigo [name='titulo']").focus();
        }

        function salvarArtigo()
        {
            var isValid = true;

            $('#divModalNovoArtigo input').each(function() {
                if ( $(this).val() === '' && $(this).attr('required') )
                {
                    $(this).focus();

                    isValid = false;
                }
            });

            if(!isValid || $("#divModalNovoArtigo textarea").html() == '')
                return;

            $("#formNovoArtigo").submit();

            $("#divModalNovoArtigo #divLoading").addClass('d-none');
            $("#divModalNovoArtigo #divEditar").addClass('d-none');
            $("#divModalNovoArtigo #divEnviando").removeClass('d-none');

            $("#divModalNovoArtigo #divLoading").addClass('d-none');
            $("#divModalNovoArtigo #divEditar").addClass('d-none');
            $("#divModalNovoArtigo #divEnviando").removeClass('d-none');
        }

        function editarArtigo(artigo_id)
        {
            $("#divModalEditarArtigo").modal({ keyboard: false, backdrop: 'static' });
            $("#divModalEditarArtigo #divLoading").removeClass('d-none');
            $("#divModalEditarArtigo #divEditar").addClass('d-none');
            $("#divModalEditarArtigo #divEnviando").addClass('d-none');

            $("#divModalEditarArtigo .form-page").addClass('d-none');
            $("#divModalEditarArtigo #page1").removeClass('d-none');

            $.ajax({
                url: appurl + '/gestao/artigos/' + artigo_id,
                type: 'get',
                dataType: 'json',
                success: function( _response )
                {
                    console.log( _response );

                    if(_response.response == true)
                    {
                        $("#divModalEditarArtigo [name='artigo_id']").val(_response.artigo.id);
                        $("#divModalEditarArtigo [name='titulo']").val(_response.artigo.titulo);
                        $("#divModalEditarArtigo [name='descricao']").val(_response.artigo.descricao);
                        $("#divModalEditarArtigo [name='conteudo']").val(_response.artigo.conteudo);
                        $("#divModalEditarArtigo [name='status']").val(_response.artigo.status);

                        $("#divModalEditarArtigo #divLoading").addClass('d-none');
                        $("#divModalEditarArtigo #divEditar").removeClass('d-none');
                    }
                    else
                    {
                        swal("Ops!", _response.error, "error");

                        $("#divModalEditarArtigo").modal({ keyboard: false, backdrop: 'static' });
                    }
                },
                error: function( _response )
                {
                    console.log( _response );
                }
            });
        }

        function salvarEdicaoArtigo()
        {
            var isValid = true;

            $('#divModalEditarArtigo input').each(function() {
                if ( $(this).val() === '' && $(this).attr('required') )
                {
                    $(this).focus();

                    isValid = false;
                }
            });

            if(!isValid)
                return;

            $("#formEditarArtigo").submit();

            $("#divModalEditarArtigo #divLoading").addClass('d-none');
            $("#divModalEditarArtigo #divEditar").addClass('d-none');
            $("#divModalEditarArtigo #divEnviando").removeClass('d-none');

            $("#divModalEditarArtigo #divLoading").addClass('d-none');
            $("#divModalEditarArtigo #divEditar").addClass('d-none');
            $("#divModalEditarArtigo #divEnviando").removeClass('d-none');
        }

        function excluirArtigo(artigo_id)
        {
            swal({
                title: "Excluir artigo",
                text: "Você deseja mesmo excluir esta artigo?",
                icon: "warning",
                buttons: ["Não", "Sim"],
                dangerMode: true,
            })
            .then((deletar) =>
            {
                if (deletar)
                {
                    $.ajax({
                        url: '{{ env('APP_LOCAL') }}' + '/gestao/artigos/' + artigo_id + '/excluir',
                        type: 'post',
                        data: { '_token' : '{{ csrf_token() }}' },
                        dataType: 'json',
                        success: function( _response )
                        {
                            //console.log( _response );

                            if(_response.response)
                            {
                                swal("Yeah!", _response.data, "success");

                                $( "#divArtigo" + artigo_id ).remove();
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
