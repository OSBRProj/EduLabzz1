<div class="modal fade" id="divModalAtualizaTeste_{{$teste->id}}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal px-1 px-md-5" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                <h4 class="mb-5 text-primary text-center">Editar teste: {{ $teste->titulo }}</h4>

                <form action="{{ route('gestao.teste.atualizar', $teste->id) }}" method="post">
                    @csrf

                    <div class="form-group">
                        <div class="d-flex justify-content-end">
                            <label for="tempo" class="text-center">Tempo para responder <br> (tempo em minutos)</label>
                            <input type="text" name="tempo" class="col-lg-2 ml-2 form-control tempoMinutos"
                                   placeholder="000" value="{{ $teste->tempo }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="titulo">Título do teste:</label>
                        <input type="text" name="titulo" value="{{ $teste->titulo }}" class="form-control"
                               placeholder="Título"
                               required>
                    </div>

                    <div class="form-group">
                        <label for="descricao">Descrição:</label>
                        <textarea name="descricao" class="form-control" rows="5"
                                  placeholder="Descrição">{{ $teste->descricao }}</textarea>
                    </div>

                    <div class="form-group">
                        <div class="d-flex justify-content-between mb-3">
                            <label for="questoes">Banco de questões:</label>
                            <button type="button" class="btn btn-primary addNewQuestao">
                                <i class="fas fa-plus"></i> Criar nova questão
                            </button>
                        </div>
                        <div class="alert-success p-2 mb-3 text-center msg-new-questao" style="display: none;">
                            <i class="fas fa-check"></i> Questão adicionada com sucesso!
                        </div>


                        <div class="jumbotron p-4">
                            <div class="row">
                                <div class="col-lg-10">
                                    <select class="form-control selectQuestoes"
                                            data-live-search="true"
                                            required>
                                    </select>
                                </div>
                                <div class="col-lg-2">
                                    <button type="button" class="btn btn-success btnAddQuestao">Adicionar
                                    </button>
                                </div>
                            </div>

                            <ul class="innerListQuestoes list-group"></ul>
                            <ul class="list-group">
                                @foreach($teste->questoes as $questao)
                                    <li class="list-group-item mt-3">
                                        <div class="row">
                                            <div class="col-lg-4">{{ $questao->questao->titulo }}</div>
                                            <div class="col-lg-7">
                                                <input type="text" class="ml-2 form-control" required
                                                       value="{{ $questao->peso }}" name="peso[{{$questao->id}}]"
                                                       placeholder="peso da questão">
                                            </div>
                                            <div class="col-lg-1">
                                                <a href="" class="btn btn-sm btn-danger">X</a>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>

                        </div>


                    </div>

                    <div class="form-group">

                        <label for="">Direcionamento</label> <br>
                        <button type="button" class="btn btn-primary addDirecionamento"><i class="fas fa-redo-alt"></i>
                            Adicionar direcionamento
                        </button>

                    </div>


                    <div class="innerDirecionamentos"></div>


                    <div class="row">
                        <button type="button" data-dismiss="modal"
                                class="btn btn-lg btn-block outline-button mt-4 mb-0 col-4 ml-auto mr-4 font-weight-bold">
                            Cancelar
                        </button>
                        <button type="submit"
                                class="btn btn-lg bg-primary btn-block signin-button mt-4 mb-0 col-4 ml-4 mr-auto text-white font-weight-bold">
                            Atualizar teste
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>
</div>

@include('pages.questoes.admin._create_ajax')
@include('pages.teste.admin._direcionamento')
