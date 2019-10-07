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

        main.darkmode thead tr
        {
            background-color: #1F212E;
        }

        main.darkmode .bg-white.bg-darkmode
        {
            background-color: transparent !important;
        }

    </style>

@endsection

@section('content')

<main role="main" class="">
    <div class="container">

        <div class="row">

            <div class="col-12 col-md-11 mx-auto">

                <div class="col-12 mb-3 title pl-0">
                    <h2>Gestão de usuários</h2>
                </div>

                <div class="w-100">
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

                <div class="w-100 pr-0 text-right">
                    <form action="{{ route('gestao.usuarios') }}" method="get" class="input-group mb-3">
                        <input type="text" name="pesquisa" value="{{ Request::get('pesquisa') }}" required class="form-control text-truncate border-1 d-inline-block shadow-sm" placeholder="Procurar usuário">
                        <button type="submit" class="btn btn-primary border-0 rounded input-group-append d-inline-block">
                            <span class="input-group-text border-0 bg-transparent" id="basic-addon2">
                                <i class="fas fa-search text-light"></i>
                            </span>
                        </button>
                    </form>
                </div>
                <div class="w-100"></div>

                <div class="col-12 px-0">
                    <button type="button" data-toggle="modal" data-target="#divModalNovoUsuario" class="btn btn-block btn-primary text-white font-weight-bold rounded shadow-none px-4 mb-2 mb-sm-0 text-truncate" data-keyboard="false" data-backdrop="static">
                        <i class="fas fa-plus mr-3"></i>
                        Cadastrar novo usuário
                    </button>
                </div>

                <!-- Modal Novo usuario -->
                <div class="modal fade" id="divModalNovoUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>

                                <form id="divPages" method="POST" action="{{ route('gestao.usuarios.novo') }}" class="text-center px-3 shadow-none border-0">

                                        @csrf

                                        <div id="page1" class="form-page mx-0 mx-sm-5">

                                            <h5 class="mt-4 mb-5 font-weight-bold col-10 ml-auto mr-auto">
                                                Cadastro de novo usuário
                                            </h5>

                                            <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-transparent rounded-0" id="basic-addon1">
                                                        <i class="fas fa-user fa-fw"></i>
                                                    </span>
                                                </div>

                                                <input id="name" type="text" placeholder="Nome e sobrenome" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }} rounded-0" name="name" value="{{ old('name') }}" required autofocus>

                                                @if ($errors->has('name'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-transparent rounded-0" id="basic-addon1">
                                                        <i class="fas fa-envelope fa-fw"></i>
                                                    </span>
                                                </div>

                                                <input id="email" type="email" placeholder="E-mail" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} rounded-0" name="email" value="{{ old('email') }}" required>

                                                @if ($errors->has('email'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>

                                            @if( strrpos(mb_strtoupper(\Auth::user()->permissao, 'UTF-8'), "Z") === false)
                                                <input type="text" name="permissao" readonly class="form-control rounded-0 my-3">
                                            @else
                                                <select name="permissao" required class="custom-select rounded-0 my-3">
                                                    <option value="">Selecione uma permissão</option>
                                                    <option value="A">Aluno</option>
                                                    <option value="P">Professor / Instrutor</option>
                                                    <option value="G">Gestor de Escola</option>
                                                    <option value="Z">Administrador</option>
                                                </select>
                                            @endif

                                            <select name="escola_id" required class="custom-select rounded-0 my-3">
                                                <option value="">Selecione uma escola</option>
                                                @foreach ($escolas as $escola)
                                                    <option value="{{ $escola->id }}">{{ ucfirst($escola->titulo) }}</option>
                                                @endforeach
                                            </select>

                                            <div class="row">
                                                <a href="{{ route('login') }}" class="btn btn-lg btn-block outline-button my-4 col-4 ml-auto mr-4 font-weight-bold text-secondary">Voltar</a>
                                                <button type="button" onclick="$('#page1').addClass('d-none'); $('#page2').removeClass('d-none'); setTimeout(function(){ document.getElementById('divPages').submit(); }, 500);" class="btn btn-lg btn-block bg-primary my-4 col-4 ml-4 mr-auto text-white font-weight-bold">Cadastrar</button>
                                            </div>

                                        </div>

                                        <div id="page2" class="form-page mx-0 mx-sm-5 d-none py-3">

                                            <i class="fas fa-spinner fa-pulse fa-3x text-primary"></i>

                                            <h5 class="mt-4 font-weight-bold col-10 ml-auto mr-auto">
                                                Cadastro de novo usuário

                                                <span class="small d-block mt-3 text-dark font-weight-normal">
                                                    Você será redirecionado para o Painel do usuário em instantes.
                                                </span>
                                            </h5>

                                        </div>

                                    </form>

                            </div>

                        </div>
                    </div>
                </div>
                <!-- Fim modal novo usuario -->


                <div class="modal fade" id="divModalEditarUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>



                                <form id="divPages" method="POST" action="{{ route('gestao.usuarios.salvar') }}" class="text-center px-3 shadow-none border-0">

                                        @csrf

                                        <div id="divLoading">
                                            <i class="fas fa-spinner fa-pulse fa-3x text-primary"></i>
                                        </div>

                                        <div id="divEditar" class="form-page mx-0 mx-sm-5 d-none">

                                            <h5 class="mt-4 mb-5 col-10 ml-auto mr-auto">
                                                Editar usuário
                                            </h5>

                                            <input name="id" type="text" hidden required>

                                            <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-transparent rounded-0" id="basic-addon1">
                                                        <i class="fas fa-user fa-fw"></i>
                                                    </span>
                                                </div>

                                                <input id="name" type="text" placeholder="Nome e sobrenome" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }} rounded-0" name="name" value="{{ old('name') }}" required autofocus>

                                                @if ($errors->has('name'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-transparent rounded-0" id="basic-addon1">
                                                        <i class="fas fa-envelope fa-fw"></i>
                                                    </span>
                                                </div>

                                                <input id="email" type="email" placeholder="E-mail" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} rounded-0" name="email" value="{{ old('email') }}" required>

                                                @if ($errors->has('email'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>

                                            @if( strrpos(mb_strtoupper(\Auth::user()->permissao, 'UTF-8'), "Z") === false)
                                                <input type="text" name="permissao" readonly class="form-control rounded-0 my-3">
                                            @else
                                                <select name="permissao" required class="custom-select rounded-0 my-3">
                                                    <option value="">Selecione uma permissão</option>
                                                    <option value="A">Aluno</option>
                                                    <option value="P">Professor / Instrutor</option>
                                                    <option value="G">Gestor de Escola</option>
                                                    <option value="Z">Administrador</option>
                                                </select>
                                            @endif


                                            <div class="row">
                                                <button type="button" data-dismiss="modal" class="btn btn-secondary my-4 col-4 ml-auto mr-4 font-weight-bold">Voltar</button>
                                                <button type="submit" class="btn btn-primary my-4 col-4 ml-4 mr-auto font-weight-bold">Salvar</button>
                                            </div>

                                        </div>

                                    </form>

                            </div>

                        </div>
                    </div>
                </div>


                <!-- Painel principal -->
                <div class="mt-2 mx-2">

                    <div class="row">
                        <div class="col-12">

                            <!-- Inicio tabela de usuarios -->
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="thead-default">
                                        <tr>
                                            <th class="">Nome</th>
                                            <th class="">E-mail</th>
                                            <th class="d-none d-xl-table-cell">Última Atividade</th>
                                            <th class="d-none d-lg-table-cell">Permissão</th>
                                            <th class="w-25">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white bg-darkmode">

                                    @if(count($usuarios) > 0)
                                        @foreach ($usuarios as $usuario)

                                            <tr class="rounded shadow-sm">
                                                <td>{{ ucwords($usuario->name) }}</td>
                                                <td>{{ $usuario->email }}</td>
                                                <td class="d-none d-xl-table-cell">{{ (strftime("%d de %b de %G às %H:%M", strtotime($usuario->ultima_atividade))) }}</td>
                                                <td class="d-none d-lg-table-cell">{{ $usuario->permissao_name }}</td>
                                                <td>
                                                    <button type="button" onclick="editarUsuario({{ $usuario->id }})" class="btn btn-sm text-white btn-accept mr-2">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </button>
                                                    <button type="button" onclick="deletarUsuario({{ $usuario->id }}, this);" class="btn btn-sm text-white btn-decline">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            {{--  <tr class="spacer" style="height: 10px;"></tr>  --}}

                                        @endforeach
                                    @else

                                        <tr class="rounded shadow-sm">
                                            <td colspan="4" class="align-middle">Não há usuários cadastrados ainda.</td>
                                        </tr>
                                        {{--  <tr class="spacer" style="height: 10px;"></tr>  --}}

                                    @endif

                                    </tbody>
                                </table>
                            </div>
                            <!-- Fim tabela de usuarios -->

                            <!-- Paginação -->
                            @if(count($usuarios) > 0)
                                <nav class="px-auto small mt-2 mx-auto text-center py-1 pb-0" aria-label="Page navigation example" style="margin: 0px -32px;">
                                    <ul class="pagination mb-0 d-inline-flex">
                                        @if($usuarios->currentPage() > 2)
                                            <li class="page-item ml-auto"><a href="{{ $usuarios->url(0) }}&qt={{ $amount }}" class="page-link">Primeira</a></li>
                                        @endif
                                        @if($usuarios->currentPage() > 1)
                                            <li class="page-item ml-auto"><a href="{{ $usuarios->previousPageUrl() }}&qt={{ $amount }}" class="page-link">Anterior</a></li>
                                        @endif
                                        @for($i = 0; $i < $usuarios->lastPage(); $i ++)
                                            <li class="page-item {{ $usuarios->currentPage() != $i + 1 ?: 'active' }}"><a href="{{ $usuarios->url($i+1) }}&qt={{ $amount }}" class="page-link">{{ $i + 1 }}</a></li>
                                        @endfor
                                        @if($usuarios->currentPage() < $usuarios->lastPage())
                                            <li class="page-item mr-auto"><a href="{{ $usuarios->nextPageUrl() }}&qt={{ $amount }}" class="page-link">Próxima</a></li>
                                        @endif
                                        @if($usuarios->currentPage() < $usuarios->lastPage() - 1)
                                            <li class="page-item mr-auto"><a href="{{ $usuarios->url( $usuarios->lastPage() ) }}&qt={{ $amount }}" class="page-link">Última</a></li>
                                        @endif
                                    </ul>
                                </nav>
                            @endif
                            <!-- Fim paginação -->

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

        function editarUsuario(user)
        {
            $("#divModalEditarUsuario").modal('toggle');
            $("#divModalEditarUsuario #divLoading").removeClass('d-none');
            $("#divModalEditarUsuario #divEditar").addClass('d-none');

            $.ajax({
                url: appurl + '/gestao/usuarios/' + user + '/editar',
                type: 'get',
                dataType: 'json',
                success: function( _response )
                {
                    console.log( _response );

                    if(_response.success)
                    {
                        _response.user = JSON.parse(_response.user);
                        $("#divModalEditarUsuario [name='id']").val(_response.user.id);
                        $("#divModalEditarUsuario [name='name']").val(_response.user.name);
                        $("#divModalEditarUsuario [name='email']").val(_response.user.email);
                        $("#divModalEditarUsuario [name='permissao']").val(_response.user.permissao);

                        $("#divModalEditarUsuario #divLoading").addClass('d-none');
                        $("#divModalEditarUsuario #divEditar").removeClass('d-none');
                    }
                    else
                    {
                        swal("Ops!", _response.error, "error");

                        $("#divModalEditarUsuario").modal('toggle');
                    }
                },
                error: function( _response )
                {
                    console.log( _response );
                }
            });
        }

        function deletarUsuario(user, button)
        {
            swal({
                title: "Deletar",
                text: "Você deseja mesmo deletar este usuario?",
                icon: "warning",
                buttons: ["Não", "Sim"],
                dangerMode: true,
            })
            .then((deletar) =>
            {
                if (deletar)
                {
                    $.ajax({
                        url: appurl + '/gestao/usuarios/' + user + '/deletar',
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
