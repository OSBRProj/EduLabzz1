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
                <div class="tab-pane w-100 fade show active" id="desafios" role="tabpanel" aria-labelledby="desafios-tab">
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
                                    data-toggle="modal" data-target="#ModalCreateDesafio">
                                    <i class="fas fa-plus" style="color: #fff"></i>
                                    <span class="font-weight-bold font-size-18px">CRIAR DESAFIO</span>
                                </button>
                            </div>

                            <div class="col-pagination col-12 col-sm-4 col-md-4 col-lg-4 justify-content-end">
                                <nav aria-label="Page navigation example">
                                    {!! $desafios->links() !!}
                                </nav>
                            </div>
                        </div>

                        <div class="container-items area-btns row">
                            @forelse($desafios as $desafio)
                            <div class="col-md-4">
                                <button class="btn btn-primary" onClick="editDesafio({{$desafio->id}});">{{ $desafio->titulo }}</button>
                            </div>
                            @empty
                            <div class="col-md-12">
                                <p>Ainda não adicionou desafios!</p>
                            </div>
                            @endforelse
                        </div>

                    </div>
                </div>
                <!-- -->
            </div>
            <!-- -->

            <!-- Modais -->
            @include('pages.desafios.admin._create')
            @include('pages.desafios.admin._edit')
            <!-- -->

        </div>

    </div>

</main>

@endsection

@section('bodyend')

<script>
    function editDesafio(idDesafio) {
        var myPath = appurl + '/gestao/desafios';

        $.getJSON(myPath + '/buscar/' + idDesafio, function(response){
            $('#ModalEditDesafio').find('#txtTitulo').val(response.titulo);
            $('#ModalEditDesafio').find('#txtDescricao').val(response.descricao);

            $('#ModalEditDesafio .form-salvar').attr('action', myPath + '/atualizar/' + idDesafio);
            $('#ModalEditDesafio .form-excluir').attr('action', myPath + '/excluir/' + idDesafio);
            $("#ModalEditDesafio .form-excluir #idDesafio").val(idDesafio);

            $('#ModalEditDesafio').modal();
        });
    }

    $('#ModalEditDesafio .btn-salvar').on('click', function() {
        $('#ModalEditDesafio .form-salvar').submit();
    });

    function excluirDesafio() {
        swal({
            title: 'Excluir Desafio?',
            text: "Você deseja mesmo excluir este desafio?",
            icon: "warning",
            buttons: ['Não', 'Sim, excluir!'],
            dangerMode: true,
        }).then((result) => {
            if (result == true) {
                $("#ModalEditDesafio .form-excluir").submit();
            }
        });
    }
</script>

@endsection
