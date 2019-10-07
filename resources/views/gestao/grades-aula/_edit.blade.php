<div class="modal fade" id="editaGrade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal text-center px-1 px-md-5" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>


                <div class="d-flex justify-content-around">
                    <div><h4 class="mb-5 text-primary" id="dateShowCalendar"></h4></div>
                    <div>
                        <button type="button" id="removeGrade" class="btn btn-sm btn-danger">
                            <i class="fas fa-calendar-times"></i> Excluir
                        </button>
                    </div>
                </div>

                <form id="formExcluirGrade" action="{{ route('gestao.grade-deletar') }}" method="post">
                    @csrf
                    <input id="idGrade" name="idGrade" hidden>
                </form>

                <form action="{{ route('gestao.grade-atualizar') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" id="idCalendar">
                    <input type="hidden" value="{{ $turma->id }}" name="idTurma">

                    <div class="form-group row text-left">
                        <div class="col-lg-4">
                            <label for="Data">Data:</label>
                            <input type="text" name="data" id="editSemana" class="form-control datepicker" autocomplete="off">
                        </div>
                        <div class="col-lg-4">
                            <label for="Hora inicial">Hora inicial:</label>
                            <input type="text" name="data_inicial" id="editHourInitial" class="form-control time">
                        </div>
                        <div class="col-lg-4">
                            <label for="Hora final">Hora final:</label>
                            <input type="text" name="data_final" id="editHourFinal" class="form-control time">
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="text" name="titulo" id="tituloCalendar" class="form-control"
                               placeholder="Título"
                               required>
                    </div>
                    <div class="form-group">
                        <textarea name="descricao" id="descricaoCalendar" class="form-control" placeholder="Descrição"
                                  rows="4"></textarea>
                    </div>

                    <div class="form-group text-left">


                        <div class="form-group">
                            <label for="recorrente">Manter grade de aula recorrente?</label> <br>
                            <div class="form-check form-check-inline">
                                <span class="mr-4">
                                    <input class="form-check-input" id="dateRangesYes" type="radio" name="recorrente"
                                           value="1">Sim
                                </span>
                                <input class="form-check-input" id="dateRangesNo" type="radio" name="recorrente"
                                       value="0">Não
                            </div>
                        </div>


                        <label for="cores">Cores</label> <br>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="cor" value="#FFBE07">
                            <label class="form-check-label" for="cor">
                                <div class="p-2 rounded" style="background-color: #FFBE07;"></div>
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="cor" value="#00BDD4">
                            <label class="form-check-label" for="cor">
                                <div class="p-2 rounded" style="background-color: #00BDD4;"></div>
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="cor" value="#2195F4">
                            <label class="form-check-label" for="cor">
                                <div class="p-2 rounded" style="background-color: #2195F4;"></div>
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="cor" value="#207adc">
                            <label class="form-check-label" for="cor">
                                <div class="p-2 rounded" style="background-color: #207adc;"></div>
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="cor" value="#207adc">
                            <label class="form-check-label" for="cor">
                                <div class="p-2 rounded" style="background-color: #207adc;"></div>
                            </label>
                        </div>

                    </div>


                    <div class="row">
                        <button type="button" data-dismiss="modal"
                                class="btn btn-lg btn-block outline-button mt-4 mb-0 col-4 ml-auto mr-4 font-weight-bold">
                            Cancelar
                        </button>
                        <button type="submit"
                                class="btn btn-lg bg-primary btn-block signin-button mt-4 mb-0 col-4 ml-4 mr-auto text-white font-weight-bold">
                            Atualizar
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>
</div>
