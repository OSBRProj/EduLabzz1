@extends('layouts.master')

@section('title', 'J. PIAGET - Financeiro')

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

    </style>

@endsection

@section('content')

<main role="main" class="darkmode">

    <div class="container-fluid pt-4">

        <div class="mb-2 mx-4">
            <div class="row">
                <div class="col mb-4 pl-0">
                    <h3 class="d-inline-block">
                        Gestão financeira
                    </h3>
                </div>

                <div class="w-100"></div>

                <div class="col-12 col-lg-8 mb-3">
                    <div class="container px-0">
                        <div class="row">
                            <div class="col-4 px-2">
                                <div class="box-shadow rounded-10 py-5 px-1 text-center text-white h-100" style="background-color: #525870;">
                                    <h3 class="font-weight-bold my-auto">
                                        <small class="d-block mb-2">
                                            Saldo a receber
                                        </small>
                                        R$ {{ number_format($saldoReceber, 2) }}
                                    </h3>
                                </div>
                            </div>

                            <div class="col-4 px-2">
                                <div class="box-shadow rounded-10 py-5 px-1 text-center text-white h-100" style="background-color: #525870;">
                                    <h3 class="font-weight-bold my-auto">
                                        <small class="d-block mb-2">
                                            Saldo disponível
                                        </small>
                                        R$ {{ number_format($saldoDisponivel, 2) }}
                                    </h3>
                                </div>
                            </div>

                            <div class="col-4 px-2">
                                <div class="box-shadow rounded-10 py-5 px-1 text-center text-white h-100" style="background-color: #525870;">
                                    <h3 class="font-weight-bold my-auto">
                                        <small class="d-block mb-2">
                                            Faturamento total
                                        </small>
                                        R$ {{ number_format($totalFaturado, 2) }}
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Painel principal -->
        <div class="mt-2 mx-2">

            <div class="row">
                <div class="col-12">

                    <!-- Inicio tabela de transacoes -->
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="thead-default">
                                <tr style="background-color: #F8F8F8;">
                                    <th class="">ID</th>
                                    <th class="">Curso</th>
                                    <th class="">Aluno</th>
                                    <th class="d-none d-xl-table-cell">Email</th>
                                    <th class="d-none d-lg-table-cell">Valor</th>
                                    <th class="d-none d-lg-table-cell">Estado</th>
                                    <th class="d-none d-lg-table-cell">Data</th>
                                    <th class="d-none d-lg-table-cell">Meio de Pagamento</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">

                                @foreach ($transacoes as $transacao)
                                    <tr class="rounded shadow-sm">
                                        <td class="align-middle">{{ $transacao->id }}</td>
                                        <td class="align-middle">
                                            @foreach ($transacao->produtos as $produto)
                                                {{ ucfirst($produto->titulo) }}{{ count($transacao->produtos) > 1 ? ', ' : '' }}
                                            @endforeach
                                        </td>
                                        <td class="align-middle">{{ ucwords($transacao->user->name) }}</td>
                                        <td class="d-none d-xl-table-cell align-middle">{{ $transacao->user->email }}</td>
                                        <td class="d-none d-lg-table-cell align-middle">R$ {{ number_format($transacao->total, 2) }}</td>
                                        <td class="d-none d-lg-table-cell align-middle">
                                            <span class="d-block text-center p-2 text-white text-uppercase rounded" style="background-color: {{ $transacao->status == 3 || $transacao->status == 4 ? '#3CD689' : '#FF9747' }};">{{ $transacao->status_name }}</span>
                                        </td>
                                        <td class="d-none d-lg-table-cell align-middle">{{ $transacao->created_at->format('d/m/Y \à\s H:i:s') }}</td>
                                        <td class="d-none d-lg-table-cell align-middle">{{ ucfirst($transacao->metodo) }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <!-- Fim tabela de transacoes -->

                    <!-- Paginação -->
                    <small>
                        {{--  @if(count($usuarios) > 0)
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
                        @endif  --}}
                    </small>
                    <!-- Fim paginação -->

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
                url: appurl + '/dashboard/usuarios/' + user + '/editar',
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
                        url: appurl + '/dashboard/usuarios/' + user + '/deletar',
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
