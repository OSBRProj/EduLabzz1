<div class="modal fade" id="divModalAtualizaHabilidade_{{$habilidade->id}}" tabindex="-1" role="dialog"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal text-center px-1 px-md-5" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                <h5 class="my-4">Editar habilidade {{ $habilidade->titulo }}</h5>

                <form action="{{ route('gestao.habilidades.atualizar', $habilidade->id) }}" method="post">
                    @csrf

                    <div class="form-group text-left font-weight-bold">
                        <label for="visibilidade">Visibilidade da habilidade</label>
                        <select name="visibilidade" class="form-control" required>
                            @if($habilidade->visibilidade == 0)
                            <option value="0" selected>Oculta</option>
                            <option value="1">Listada</option>
                            @else
                            <option value="0">Oculta</option>
                            <option value="1" selected>Listada</option>
                            @endif
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="text" name="titulo" value="{{ $habilidade->titulo }}" class="form-control"
                            placeholder="Título" required>
                    </div>

                    <div class="form-group">
                        {{-- <input type="text" name="categoria" value="{{ $habilidade->categoria }}" id="innerCategoriaEdit" class="form-control" placeholder="Digite o nome da categoria" style="display: none !important;"> --}}

                        <select name="categoria" id="selectCategoriaEdit" class="form-control mb-3" onchange="mudouCategoria(this.value);">
                            @foreach($categorias as $cat)
                                @if($habilidade->categoria == $cat)
                                    <option value="{{ $habilidade->categoria }}" selected>{{ $habilidade->categoria }}</option>
                                @else
                                    <option value="{{ $cat }}">{{ $cat }}</option>
                                @endif
                            @endforeach
                            <option value="outra">Outra categoria</option>
                        </select>

                        <input type="text" name="categoria_outra" value="{{ old('categoria') }}" class="form-control" placeholder="Digite o nome da categoria" hidden>
                    </div>

                    <div class="row mb-2">
                        <button type="button" data-dismiss="modal"
                            class="btn btn-danger mt-4 mb-0 col-4 ml-auto mr-4 font-weight-bold">
                            Cancelar
                        </button>
                        <button type="submit"
                            class="btn btn-primary mt-4 mb-0 col-4 ml-4 mr-auto font-weight-bold">
                            Atualizar
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>
</div>
