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
                <div class="tab-pane w-100 fade show active" id="missoes" role="tabpanel" aria-labelledby="missoes-tab">
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
                                    data-toggle="modal" data-target="#ModalCreateMissao">
                                    <i class="fas fa-plus" style="color: #fff"></i>
                                    <span class="font-weight-bold font-size-18px">CRIAR MISSÃO</span>
                                </button>
                            </div>

                            <div class="col-pagination col-12 col-sm-4 col-md-4 col-lg-4 justify-content-end">
                                <nav aria-label="Page navigation example">
                                    {!! $missoes->links() !!}
                                </nav>
                            </div>
                        </div>

                        <div class="container-items area-btns row">
                            @forelse($missoes as $missao)
                            <div class="col-md-4">
                                <button class="btn btn-primary" onClick="editMissao({{$missao->id}});">{{ $missao->titulo }}</button>
                            </div>
                            @empty
                            <div class="col-md-12">
                                <p>Ainda não adicionou missões!</p>
                            </div>
                            @endforelse
                        </div>

                    </div>
                </div>
                <!-- -->
            </div>
            <!-- -->

            <!-- Modais -->
            @include('pages.missoes.admin._create')
            @include('pages.missoes.admin._edit')
            <!-- -->

        </div>

    </div>

</main>

@endsection

@section('bodyend')

<script>
    function editMissao(idMissao) {
        var myPath = appurl + '/gestao/missoes';

        $.getJSON(myPath + '/buscar/' + idMissao, function(response){
            $('#ModalEditMissao').find('#txtTitulo').val(response.titulo);
            $('#ModalEditMissao').find('#txtDescricao').val(response.descricao);

            $('#ModalEditMissao .form-salvar').attr('action', myPath + '/atualizar/' + idMissao);
            $('#ModalEditMissao .form-excluir').attr('action', myPath + '/excluir/' + idMissao);
            $("#ModalEditMissao .form-excluir #idMissao").val(idMissao);

            $('#ModalEditMissao').modal();
        });
    }

    $('#ModalEditMissao .btn-salvar').on('click', function() {
        $('#ModalEditMissao .form-salvar').submit();
    });

    function excluirMissao() {
        swal({
            title: 'Excluir Missão?',
            text: "Você deseja mesmo excluir esta missão?",
            icon: "warning",
            buttons: ['Não', 'Sim, excluir!'],
            dangerMode: true,
        }).then((result) => {
            if (result == true) {
                $("#ModalEditMissao .form-excluir").submit();
            }
        });
    }
</script>

@endsection
