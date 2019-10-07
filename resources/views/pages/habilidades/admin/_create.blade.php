<div class="modal fade" id="divModalNovaHabilidade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal text-center px-1 px-md-5" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                <h5 class="my-4">Cadastrar nova habilidade</h5>

                <form action="{{ route('gestao.habilidades.cadastrar') }}" method="post" enctype="multipart/form-data">
                    @csrf


                    <div class="form-group text-left">
                        <h6 for="visibilidade" class="font-weight-bold">Visibilidade da habilidade</h6>
                        <select name="visibilidade" class="form-control" required>
                            <option value="0">Oculta</option>
                            <option value="1" selected>Listada</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="text" name="titulo" value="{{ old('titulo') }}" class="form-control"
                            placeholder="Título" required>
                    </div>

                    <div class="form-group">

                        <input type="text" name="categoria" value="{{ old('categoria') }}" id="innerCategoria"
                            class="form-control" placeholder="Digite o nome da categoria"
                            style="display: none !important;">

                        @if(empty($categorias))
                            <input type="text" name="categoria" value="{{ old('categoria') }}" class="form-control" placeholder="Digite o nome da categoria" required>
                        @else
                            <select name="categoria" id="selectCategoria" class="form-control mb-3" onchange="mudouCategoria(this.value);">
                                @foreach($categorias as $cat)
                                    <option value="{{ $cat }}">{{ $cat }}</option>
                                @endforeach
                                <option value="outra">Outra categoria</option>
                            </select>

                            <input type="text" name="categoria_outra" value="{{ old('categoria') }}" class="form-control" placeholder="Digite o nome da categoria" hidden>
                        @endif
                    </div>


                    <div class="row">
                        <button type="button" data-dismiss="modal"
                            class="btn btn-danger mt-4 mb-0 col-4 ml-auto mr-4 font-weight-bold">
                            Cancelar
                        </button>
                        <button type="submit"
                            class="btn btn-primary mt-4 mb-0 col-4 ml-4 mr-auto font-weight-bold">
                            Cadastrar
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>
</div>
