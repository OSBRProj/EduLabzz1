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
                <div class="tab-pane w-100 fade show active" id="recompensas-virtuais" role="tabpanel" aria-labelledby="recompensas-virtuais-tab">
                    <div class="col-md-12">

                        <div class="row-tab-content-header row">
                            <div class="col-pesquisa col-12 col-sm-4 col-md-4 col-lg-4">
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
                            <div class="col-12 col-sm-4 col-md-5 col-lg-5">
                                <!-- Btn chama modal -->
                                <button
                                    class="btn btn-block btn-primary d-flex justify-content-around p-2 align-items-center"
                                    data-toggle="modal" data-target="#ModalCreateRecompensaExtraJogo">
                                    <i class="fas fa-plus" style="color: #fff"></i>
                                    <span class="font-weight-bold font-size-18px">CRIAR RECOMPENSA EXTRA-JOGO</span>
                                </button>
                            </div>

                            <div class="col-pagination col-12 col-sm-4 col-md-4 col-lg-4 justify-content-end">
                                <nav aria-label="Page navigation example">
                                    {!! $recompensasExtraJogo->links() !!}
                                </nav>
                            </div>
                        </div>

                        <div class="container-items area-btns row">
                            @forelse($recompensasExtraJogo as $recompensaExtraJogo)
                            <div class="col-md-4">
                                <button class="btn btn-primary" onClick="editRecompensaExtraJogo({{$recompensaExtraJogo->id}});">{{ $recompensaExtraJogo->titulo }}</button>
                            </div>
                            @empty
                            <div class="col-md-12">
                                <p>Ainda não adicionou nenhuma recompensa extra-jogo!</p>
                            </div>
                            @endforelse
                        </div>

                    </div>
                </div>
                <!-- -->
            </div>
            <!-- -->

            <!-- Modais -->
            @include('pages.recompensas-extra-jogo.admin._create')
            @include('pages.recompensas-extra-jogo.admin._edit')
            <!-- -->

        </div>

    </div>

</main>

@endsection

@section('bodyend')

<script>
    function editRecompensaExtraJogo(idRecompensaExtraJogo) {
        var myPath = appurl + '/gestao/recompensas-extra-jogo';

        $.getJSON(myPath + '/buscar/' + idRecompensaExtraJogo, function(response){
            $('#ModalEditRecompensaExtraJogo').find('#txtTitulo').val(response.titulo);
            $('#ModalEditRecompensaExtraJogo').find('#txtDescricao').val(response.descricao);

            $('#ModalEditRecompensaExtraJogo .form-salvar').attr('action', myPath + '/atualizar/' + idRecompensaExtraJogo);
            $('#ModalEditRecompensaExtraJogo .form-excluir').attr('action', myPath + '/excluir/' + idRecompensaExtraJogo);

            $('#ModalEditRecompensaExtraJogo').modal();
        });
    }

    $('#ModalEditRecompensaExtraJogo .btn-salvar').on('click', function() {
        $('#ModalEditRecompensaExtraJogo .form-salvar').submit();
    });

    function excluirRecompensaExtraJogo() {
        swal({
            title: 'Excluir Recompensa Extra-Jogo?',
            text: "Você deseja mesmo excluir esta Recompensa Extra-Jogo?",
            icon: "warning",
            buttons: ['Não', 'Sim, excluir!'],
            dangerMode: true,
        }).then((result) => {
            if (result == true) {
                $("#ModalEditRecompensaExtraJogo .form-excluir").submit();
            }
        });
    }
</script>

@endsection
