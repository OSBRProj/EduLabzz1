<!-- Modal -->
<div class="modal fade" id="ModalCreateDesafio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content p-3">
            <h2 class="font-weigth-bold">Desafio</h2>

            <form class="mt-2" id="form_missao" action="{{ route('gestao.desafios.cadastrar') }}" method="post" enctype="multipart/form-data">
                @csrf

                <h6 class="font-weight-bold">Título</h6>
                <div class="form-group">
                    <input type="text" name="titulo" value="{{ old('titulo') }}" class="form-control"
                        placeholder="Título" required>
                </div>

                <h6 class="font-weight-bold">Descrição</h6>
                <div class="form-group">
                    <textarea name="descricao" class="form-control border-0 border-bottom" rows="4" placeholder="Escreva algo." required></textarea>
                    <hr>
                </div>
                <div class="row my-3 px-3 justify-content-between">
                    <button data-dismiss="modal" class="btn btn-danger">CANCELAR</button>
                    <button class="btn bg-primary text-white font-weight-bold">SALVAR</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Fim modal -->
