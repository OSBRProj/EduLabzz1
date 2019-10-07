<div class="modal fade" id="divModalAtualizaQuestao_{{$questao->id}}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal px-1 px-md-5" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                <h5 class="text-center my-4">Editar questão {{ $questao->titulo }}</h5>

                <form action="{{ route('gestao.questoes.atualizar', $questao->id) }}" method="post">
                    @csrf

                    <div class="form-group">
                        <label for="titulo" class="font-weight-bold">Título da questão:</label>
                        <input type="text" name="titulo" value="{{ $questao->titulo }}" class="form-control"
                               placeholder="Título"
                               required>
                    </div>

                    <div class="form-group">
                        <label for="descricao">Descrição:</label>
                        <textarea name="descricao" class="form-control" rows="5"
                                  placeholder="Descrição">{{ $questao->descricao }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="tipo" class="font-weight-bold">Tipo de questão:</label>
                        <select name="tipo" class="form-control selectTipo" required>
                            <option value="1" {{ $questao->tipo == 1 ? 'selected' : '' }}>Dissertativa</option>
                            <option value="2" {{ $questao->tipo == 2 ? 'selected' : '' }}>Múltipla escolha</option>
                        </select>
                    </div>

                    <div class="innerAlternativas" style="display: none">
                        <div class="form-group">

                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <input type="radio" name="alternativa_correta" value="1"
                                               checked>
                                        <span class="ml-2 text-secondary">Alternativa 1: </span>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="1"
                                       placeholder="Digite aqui a alternativa 1">
                            </div>

                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <input type="radio" name="alternativa_correta" value="2">
                                        <span class="ml-2 text-secondary">Alternativa 2:</span>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="2"
                                       placeholder="Digite aqui a alternativa 2">
                            </div>

                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <input type="radio" name="alternativa_correta" value="3">
                                        <span class="ml-2 text-secondary">Alternativa 3:</span>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="3"
                                       placeholder="Digite aqui a alternativa 3">
                            </div>

                            <div class="showNewInput"></div>

                        </div>

                        <div class="form-group">
                            <button type="button" class="btn btn-secondary btn-block" id="3">
                                <i class="fas fa-plus"></i> ADICIONAR NOVA OPÇÃO
                            </button>
                        </div>

                    </div>

                    @if($questao->tipo == 2)
                        <div class="innerAlternativasEdit innerAlternativas">
                            <div class="form-group">
                                @foreach(json_decode($questao->alternativas) as $key => $alternativa)

                                    <div class="input-group mb-2 groupNewInput_{{ $key }}">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <input type="radio" name="alternativa_correta" value="{{ $key }}"
                                                    {{ $key == $questao->resposta_correta ? "checked" : '' }}
                                                >
                                                <span class="ml-2 text-secondary">Alternativa {{ $key }}: </span>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="{{ $key }}"
                                               placeholder="Digite aqui a alternativa {{ $key }}"
                                               value="{{ $alternativa }}">
                                        @if($key >= 4)
                                            <button type="button" class="ml-2 btn btn-sm btn-danger removeInput"
                                                    id="{{ $key }}"><i class="fas fa-times"></i></button>
                                        @endif
                                    </div>
                                @endforeach

                                <div class="showNewInput"></div>

                            </div>

                            <div class="form-group">
                                <button type="button" class="btn btn-secondary btn-block" id="3">
                                    <i class="fas fa-plus"></i> ADICIONAR NOVA OPÇÃO
                                </button>
                            </div>

                        </div>
                    @endif

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
