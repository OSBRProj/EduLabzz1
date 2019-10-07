<div class="modal fade" id="divModalNovoTeste" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal px-1 px-md-5" role="document">
        <div class="modal-content px-4">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                <h5 class="my-4 text-center">Cadastrar novo teste</h5>

                <form action="{{ route('gestao.teste.cadastrar') }}" method="post">
                    @csrf

                    <div class="form-group">
                        <div class="d-flex justify-content-end">
                            <label for="tempo" class="text-center"><i class="far fa-hourglass"></i> Tempo para responder <br> <small>(tempo em minutos)</small></label>
                            
                            <input type="text" name="tempo" value="{{ old('tempo') }}"
                                   class="col-lg-2 ml-2 form-control tempoMinutos"
                                   placeholder="00">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="titulo" class="font-weight-bold">Título do teste:</label>
                        <input type="text" name="titulo" value="{{ old('titulo') }}" class="form-control"
                               placeholder="Título"
                               required>
                    </div>

                    <div class="form-group">
                        <label for="descricao" class="font-weight-bold">Descrição:</label>
                        <textarea name="descricao" class="form-control" rows="5"
                                  placeholder="Descrição">{{ old('descricao') }}</textarea>
                    </div>

                    <div class="form-group">
                        <div class="d-flex justify-content-between mb-3">
                            <label for="questoes" class="font-weight-bold">Banco de questões:</label>
                            <button type="button" class="btn btn-primary addNewQuestao">
                                <i class="fas fa-plus"></i> Criar nova questão
                            </button>
                        </div>
                        <div class="alert-success p-2 mb-3 text-center msg-new-questao" style="display: none;">
                            <i class="fas fa-check"></i> Questão adicionada com sucesso!
                        </div>

                        <div class="jumbotron p-4">

                            <div class="msg-error-quest" style="display: none">
                                <div class="form-group">
                                    <div class="p-3 alert-warning text-center msg-error-quest-inline"></div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-10">
                                    <select class="form-control selectQuestoes" data-live-search="true" required>
                                    </select>
                                </div>
                                <div class="col-lg-2">
                                    <button type="button" class="btn btn-success btnAddQuestao w-100">Adicionar</button>
                                </div>
                            </div>

                            <ul class="innerListQuestoes list-group"></ul>
                        </div>
                    </div>

                    <div class="form-group">

                        <label for="" class="font-weight-bold">Direcionamento</label> <br>
                        <button type="button" class="btn btn-primary addDirecionamento"><i class="fas fa-redo-alt"></i>
                            Adicionar direcionamento
                        </button>

                    </div>


                    <div class="innerDirecionamentos"></div>


                    <div class="row mb-3">
                        <button type="button" data-dismiss="modal"
                                class="btn btn-danger mt-4 mb-0 col-3 ml-auto mr-4 font-weight-bold">
                            Cancelar
                        </button>
                        <button type="submit"
                                class="btn btn-primary mt-4 mb-0 col-3 ml-4 mr-auto font-weight-bold">
                            Cadastrar teste
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>
</div>

@include('pages.questoes.admin._create_ajax')
@include('pages.teste.admin._direcionamento')
