@extends('layouts.master')

@section('title', 'J. PIAGET - Gestão de categorias')

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

        main.darkmode .table thead th, main.darkmode .table td, main.darkmode .table th
        {
            border: 0px !important;
        }

        main:not(.darkmode) thead tr
        {
            background-color: #F8F8F8;
        }

        main.darkmode .bg-white.bg-darkmode
        {
            background-color: transparent !important;
        }

    </style>

@endsection

@section('content')

<main role="main">

    <div class="container">

        <div class="row">

            <div class="col-12 col-md-11 mx-auto">

                <div class="col-12 mb-3 title pl-0">
                    <h2>Gestão de categorias</h2>
                </div>

                <div class="row">

                    <div class="col-sm-12 col-md-3 mb-4 text-left">
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
                    <div class="col-sm-12 col-md-9 mb-4     text-right">
                        <form action="{{ route('gestao.categorias') }}" method="get" class="input-group mb-3">
                            <input type="text" name="pesquisa" value="{{ Request::get('pesquisa') }}" required placeholder="Procurar categoria" class="form-control text-truncate border-1d-inline-block shadow-sm">
                            <button type="submit" class="btn btn-primary p-0 m-0 border-1 rounded input-group-append">
                                <span class="input-group-text border-0 bg-transparent" id="basic-addon2">
                                    <i class="fas fa-search text-light"></i>
                                </span>
                            </button>
                        </form>
                    </div>

                    <div class="w-100"></div>

                    <div class="col-12">
                        <button type="button" data-toggle="modal" data-target="#divModalNovaCategoria" class="btn btn-block btn-primary text-white font-weight-bold rounded shadow-none px-4 mb-2 mb-sm-0 text-truncate" data-keyboard="false" data-backdrop="static">
                            <i class="fas fa-plus mr-3"></i>
                            Cadastrar nova categoria
                        </button>
                    </div>

                    <!-- Modal Nova categoria -->
                    <div class="modal fade" id="divModalNovaCategoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>

                                    <form id="divPages" method="POST" action="{{ route('gestao.categorias.nova') }}" enctype="multipart/form-data" class="text-center px-3 shadow-none border-0">

                                        @csrf

                                        <div id="page1" class="form-page mt-3">

                                            <div style="position: relative;">
                                                <div class="text-center mb-3">
                                                    <!-- <span class="step-indicator rounded-circle mx-3 done"><i class="fas fa-check"></i></span> -->
                                                    <span class="step-indicator rounded-circle mx-3 active">1</span>
                                                </div>
                                            </div>

                                            <h5 class="mt-4 mb-5 font-weight-bold col-10 ml-auto mr-auto">
                                                Nova categoria
                                                <span class="small d-block mt-3 text-dark font-weight-normal">
                                                    Preencha o campos abaixo para criar uma nova categoria.
                                                </span>
                                            </h5>

                                            <input type="name" name="titulo" required class="form-control rounded mb-3" placeholder="Nome da categoria">

                                            <div class="form-group mb-3">
                                                <label for="tipo">Tipo de categoria</label>
                                                <select class="custom-select form-control" name="tipo" id="tipo" required>
                                                    <option value="0" selected>Geral</option>
                                                    <option value="1">Cursos</option>
                                                    <option value="2">Conteúdos</option>
                                                    <option value="3">Aplicações</option>
                                                    <option value="4">Artigos</option>
                                                    <option value="5">Áudios</option>
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
                    <!-- Fim modal nova categoria -->

                    <div class="modal fade" id="divModalEditarCategoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                            <div class="modal-content">
                                <div class="modal-body mt-3">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>

                                    <form id="divPages" method="POST" action="{{ route('gestao.categorias.update') }}" enctype="multipart/form-data" class="text-center px-3 shadow-none border-0">

                                        @csrf

                                        <div id="page1" class="form-page">

                                            <div style="position: relative;">
                                                <div class="text-center mb-3">
                                                    <!-- <span class="step-indicator rounded-circle mx-3 done"><i class="fas fa-check"></i></span> -->
                                                    <span class="step-indicator rounded-circle mx-3 active">1</span>
                                                </div>
                                            </div>

                                            <h5 class="mt-4 mb-5 font-weight-bold col-10 ml-auto mr-auto">
                                                Editando categoria
                                            </h5>

                                            <input type="name" name="titulo" required class="form-control rounded-0 mb-3" placeholder="Nome da categoria">

                                            <div class="form-group mb-3">
                                                <label for="tipo">Tipo de categoria</label>
                                                <select class="custom-select form-control" name="tipo" id="tipo" required>
                                                    <option value="0">Geral</option>
                                                    <option value="1">Cursos</option>
                                                    <option value="2">Conteúdos</option>
                                                    <option value="3">Aplicações</option>
                                                    <option value="4">Artigos</option>
                                                    <option value="5">Áudios</option>
                                                </select>
                                            </div>

                                            <input type="name" name="id" required hidden>

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

                </div>
            </div>

            <!-- Painel principal -->
            <div class="col-12">

                <div class="col-12 col-md-11 mx-auto px-0 py-4">
                    <div class="">

                        <!-- Inicio tabela de categorias -->
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="thead-default">
                                    <tr>
                                        <th class="">Nome</th>
                                        <th class="">Tipo</th>
                                        <th class="w-25">Ações</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white bg-darkmode">

                                    @if(count($categorias) > 0)
                                        @foreach ($categorias as $categoria)

                                            <tr id="divItemCategoria{{ $categoria->id }}" class="rounded shadow-sm">
                                                <td>{{ ucfirst($categoria->titulo) }}</td>
                                                <td>{{ ucfirst($categoria->tipo_name) }}</td>
                                                <td>
                                                    <button type="button" onclick="editarCategoria({{ $categoria->id }});" class="btn btn-sm text-white btn-accept mr-2">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </button>
                                                    <button type="button" onclick="deletarCategoria({{ $categoria->id }}, this);" class="btn btn-sm text-white btn-decline">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </td>
                                            </tr>

                                        @endforeach
                                    @else

                                        <tr class="rounded shadow-sm">
                                            <td colspan="4" class="align-middle">Não há categorias cadastradas ainda.</td>
                                        </tr>
                                        {{--  <tr class="spacer" style="height: 10px;"></tr>  --}}

                                    @endif

                                </tbody>
                            </table>
                        </div>
                        <!-- Fim tabela de categorias -->

                        @if(count($categorias) > 0)

                            <!-- Paginação -->
                            <nav class="px-auto small mt-2 mx-auto text-center py-1 pb-0" aria-label="Page navigation example" style="margin: 0px -32px;">
                                <ul class="pagination mb-0 d-inline-flex">
                                    @if($categorias->currentPage() > 2)
                                        <li class="page-item ml-auto"><a href="{{ $categorias->url(0) }}&qt={{ $amount }}" class="page-link">Primeira</a></li>
                                    @endif
                                    @if($categorias->currentPage() > 1)
                                        <li class="page-item ml-auto"><a href="{{ $categorias->previousPageUrl() }}&qt={{ $amount }}" class="page-link">Anterior</a></li>
                                    @endif
                                    @for($i = 0; $i < $categorias->lastPage(); $i ++)
                                        <li class="page-item {{ $categorias->currentPage() != $i + 1 ?: 'active' }}"><a href="{{ $categorias->url($i+1) }}&qt={{ $amount }}" class="page-link">{{ $i + 1 }}</a></li>
                                    @endfor
                                    @if($categorias->currentPage() < $categorias->lastPage())
                                        <li class="page-item mr-auto"><a href="{{ $categorias->nextPageUrl() }}&qt={{ $amount }}" class="page-link">Próxima</a></li>
                                    @endif
                                    @if($categorias->currentPage() < $categorias->lastPage() - 1)
                                        <li class="page-item mr-auto"><a href="{{ $categorias->url( $categorias->lastPage() ) }}&qt={{ $amount }}" class="page-link">Última</a></li>
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

</main>

@endsection

@section('bodyend')

    <script>

        $( document ).ready(function()
        {

        });

        function editarCategoria(categoria_id)
        {
            $("#divModalEditarCategoria").modal('toggle');

            $.ajax({
                url: appurl + '/gestao/categorias/' + categoria_id,
                type: 'get',
                dataType: 'json',
                success: function( _response )
                {
                    console.log( _response );

                    if(_response.response == true)
                    {
                        $("#divModalEditarCategoria [name='id']").val(_response.categoria.id);
                        $("#divModalEditarCategoria [name='titulo']").val(_response.categoria.titulo);
                        $("#divModalEditarCategoria [name='tipo']").val(_response.categoria.tipo);
                    }
                    else
                    {
                        swal("Ops!", _response.data, "error");

                        $("#divModalEditarCategoria").modal('toggle');
                    }
                },
                error: function( _response )
                {
                    console.log( _response );
                }
            });


        }

        function deletarCategoria(categoria, button)
        {
            swal({
                title: "Deletar",
                text: "Você deseja mesmo deletar esta categoria?",
                icon: "warning",
                buttons: ["Não", "Sim"],
                dangerMode: true,
            })
            .then((deletar) =>
            {
                if (deletar)
                {
                    $.ajax({
                        url: appurl + '/dashboard/categorias/' + categoria + '/deletar',
                        type: 'get',
                        dataType: 'json',
                        success: function( _response )
                        {
                            console.log( _response );

                            if(_response.success)
                            {
                                swal("Yeah!", _response.success, "success");

                                $( button.parentNode.parentNode ).remove();
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
