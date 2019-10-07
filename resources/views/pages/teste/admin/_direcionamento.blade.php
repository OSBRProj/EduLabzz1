<div class="modal fade" id="divModalDirecionamento" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal px-1 px-md-5" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close closeDirecionamento" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                <h4 class="mb-5 text-primary text-center">Adicionar direcionamento</h4>


                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-5">
                            <label for="Regra">Regra:</label>
                            <select name="regra" class="form-control regra">
                                <option value="<">Menor que</option>
                                <option value=">">Maior que</option>
                                <option value="==">Igual a</option>
                                <option value="<=">Menor ou igual a</option>
                                <option value=">=">Maior ou igual a</option>
                            </select>
                        </div>
                        <div class="col-lg-2">
                            <label for="pontuacao">Pontuação:</label>
                            <input type="text" name="pontuacao" class="pontuacao form-control"
                                   placeholder="00" required>
                        </div>
                        <div class="col-lg-5">
                            <label for="direcionamento">Direcionamento:</label>
                            <input type="text" name="direcionamento"
                                   class="form-control direcionamento"
                                   placeholder="Direcionamento" required>
                        </div>
                    </div>
                </div>

                <div class="msg-error" style="display: none">
                    <div class="form-group">
                        <div class="p-3 alert-warning text-center mgs-error-inline"></div>
                    </div>
                </div>
                <div class="msg-add-direcionamento" style="display: none">
                    <div class="form-group">
                        <div class="p-3 alert-success text-center">Direcionamento adicioado com sucesso!</div>
                    </div>
                </div>


                <div class="row">
                    <button type="button" data-dismiss="modal"
                            aria-label="Close"
                            class="closeDirecionamento btn btn-lg btn-block outline-button mt-4 mb-0 col-4 ml-auto mr-4 font-weight-bold">
                        Cancelar
                    </button>
                    <button type="button"
                            class="btn btn-lg bg-primary btn-block btnAddDirecionamento mt-4 mb-0 col-4 ml-4 mr-auto text-white font-weight-bold">
                        Cadastrar
                    </button>
                </div>


            </div>

        </div>
    </div>
</div>

@include('pages.questoes.admin._create_ajax')
