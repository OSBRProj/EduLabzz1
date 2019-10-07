<div class="modal fade" id="divModalNovaQuestaoAjax" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal px-1 px-md-5" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close closeQuestao" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                <h4 class="mb-5 text-primary text-center">Cadastrar nova questão</h4>

                <form action="" method="post" class="form-add-questao">
                    @csrf

                    <div class="form-group">
                        <label for="titulo">Título da questão:</label>
                        <input type="text" name="titulo" value="{{ old('titulo') }}" class="form-control"
                               placeholder="Título"
                               required>
                    </div>

                    <div class="form-group">
                        <label for="descricao">Descrição:</label>
                        <textarea name="descricao" class="form-control" rows="5"
                                  placeholder="Descrição">{{ old('descricao') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="tipo">Tipo de questão:</label>
                        <select name="tipo" class="form-control selectTipo" required>
                            <option value="1" selected>Dissertativa</option>
                            <option value="2">Múltipla escolha</option>
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
                            <button type="button" class="btn btn-light btn-block btnAdd" id="3">
                                <i class="fas fa-plus"></i> ADICIONAR NOVA OPÇÃO
                            </button>
                        </div>

                    </div>

                    <div class="row">
                        <button type="button" data-dismiss="modal"
                                class="closeQuestao btn btn-lg btn-block outline-button mt-4 mb-0 col-4 ml-auto mr-4 font-weight-bold">
                            Cancelar
                        </button>
                        <button type="submit"
                                class="btn btn-lg bg-primary btn-block mt-4 mb-0 col-4 ml-4 mr-auto text-white font-weight-bold">
                            Cadastrar
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>
</div>
