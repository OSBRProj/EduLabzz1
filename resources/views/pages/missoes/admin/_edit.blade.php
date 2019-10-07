<!-- Modal -->
<div class="modal fade" id="ModalEditMissao" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content p-3">
            <h2 class="font-weigth-bold">Editar Missão</h2>

            <form class="form-salvar mt-2" action="{{ route('gestao.missoes.atualizar', 0) }}" method="post" enctype="multipart/form-data">
                @csrf

                <h6 class="font-weight-bold">Título</h6>
                <div class="form-group">
                    <input type="text" name="titulo" id="txtTitulo" value="{{ old('titulo') }}" class="form-control"
                        placeholder="Título">
                </div>

                <h6 class="font-weight-bold">Descrição</h6>
                <div class="form-group">
                    <textarea name="descricao" id="txtDescricao" class="form-control border-0 border-bottom" rows="4" placeholder="Escreva algo."></textarea>
                    <hr>
                </div>
            </form>
            <div class="row my-3 px-3 justify-content-between">
                    <button class="btn font-weight-bold text-secondary" onClick="excluirMissao();">EXCLUIR</button>
                    <button class="btn-salvar btn bg-primary text-white font-weight-bold">SALVAR</button>
                </div>
                <form class="form-excluir" action="{{ route('gestao.missoes.excluir', 0) }}" method="post">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Fim modal -->
