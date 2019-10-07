@extends('layouts.master')

@section('title', 'J. PIAGET - Gestão de Recompensas')

@section('content')

<main role="main" class="mainRecompensas">

    <div class="container-fluid pt-4">

        <div class="px-sm-3 w-100">

            <h2 class="text-center font-weight-bold">RECOMPENSAS</h2>

            <!-- Abas -->
            @include('utilities._tabs-recompensas')
            <!-- -->

            <!-- Conteudos das tabs -->
            <div class="row-tab-content row ml-1 rounded p-4 tab-content">
                <!-- Conteudo da tab -->
                <div class="tab-pane w-100 fade show active" id="conquistas" role="tabpanel" aria-labelledby="conquistas-tab">
                    <div class="col-md-12">

                        <div class="row-tab-content-header row">
                            <div class="col-pesquisa col-12 col-sm-4 col-md-5 col-lg-5">
                                <div class="d-flex flex-direction-row" style="position:relative;">
                                    <form action="" method="get" class="w-100">
                                        <input class="form-control font-size-18px" type="search" name="pesquisa"
                                            id="pesquisa" value="{{ Request::has('pesquisa') ? Request::get('pesquisa') : '' }}" placeholder="Digite aqui..">
                                        <button type="submit" style="position:absolute;top:8px;right:8px;cursor:pointer;border:none;background:transparent;">
                                            <i class="fas fa-search fa-lg fa-fw my-auto" style="color: #999FB4;"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4 col-md-3 col-lg-3">
                                <!-- Btn chama modal -->
                                <button
                                    class="btn btn-block btn-primary d-flex justify-content-around p-2 align-items-center"
                                    data-toggle="modal" data-target="#ModalCreateConquista">
                                    <i class="fas fa-plus" style="color: #fff"></i>
                                    <span class="font-weight-bold font-size-18px">CRIAR CONQUISTA</span>
                                </button>
                            </div>

                            <div class="col-pagination col-12 col-sm-4 col-md-4 col-lg-4 justify-content-end">
                                <nav aria-label="Page navigation example">
                                    {!! $conquistas->links() !!}
                                </nav>
                            </div>
                        </div>

                        <div class="container-items area-btns row">
                            @forelse($conquistas as $conquista)
                            <div class="col-md-4">
                                <button class="btn btn-primary" onClick="editConquista({{$conquista->id}});">{{ $conquista->titulo }}</button>
                            </div>
                            @empty
                            <div class="col-md-12">
                                <p>Ainda não adicionou conquistas!</p>
                            </div>
                            @endforelse
                        </div>

                    </div>
                </div>
                <!-- -->
            </div>
            <!-- -->

            <!-- Modais -->
            @include('pages.conquistas.admin._create')
            @include('pages.conquistas.admin._edit')
            <!-- -->

        </div>

    </div>

</main>

@endsection

@section('bodyend')

<script>
    function editConquista(idConquista) {
        var myPath = appurl + '/gestao/conquistas';

        $.getJSON(myPath + '/buscar/' + idConquista, function(response){
            $('#ModalEditConquista').find('#txtTitulo').val(response.titulo);
            $('#ModalEditConquista').find('#txtDescricao').val(response.descricao);

            $('#ModalEditConquista .form-salvar').attr('action', myPath + '/atualizar/' + idConquista);
            $('#ModalEditConquista .form-excluir').attr('action', myPath + '/excluir/' + idConquista);

            $('#ModalEditConquista').modal();
        });
    }

    $('#ModalEditConquista .btn-salvar').on('click', function() {
        $('#ModalEditConquista .form-salvar').submit();
    });

    function excluirConquista() {
        swal({
            title: 'Excluir Conquista?',
            text: "Você deseja mesmo excluir esta conquista?",
            icon: "warning",
            buttons: ['Não', 'Sim, excluir!'],
            dangerMode: true,
        }).then((result) => {
            if (result == true) {
                $("#ModalEditConquista .form-excluir").submit();
            }
        });
    }
</script>

@endsection
