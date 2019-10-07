<div class="modal fade" id="novaGrade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal text-center px-1 px-md-5" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                <h4 class="mb-5 text-primary">Cadastrar nova aula</h4>

                <form action="{{ route('gestao.grade-nova', $turma->id) }}" method="post">
                    @csrf

                    <div class="form-group row text-left">
                        <div class="col-lg-4">
                            <label for="Data">Data:</label>
                            <input type="text" name="data" id="dateCalendarInput" class="form-control datepicker" autocomplete="off">
                        </div>
                        <div class="col-lg-4">
                            <label for="Hora inicial">Hora inicial: <small>(Ex: 06:00)</small></label>
                            <input type="text" name="data_inicial" id="hourInitialCalendarInput" class="form-control time">
                        </div>
                        <div class="col-lg-4">
                            <label for="Hora final">Hora final: <small>(Ex: 10:00)</small></label>
                            <input type="text" name="data_final" id="hourFinalCalendarInput" class="form-control time">
                        </div>
                    </div>


                    <div class="form-group">
                        <input type="text" name="titulo" value="{{ old('titulo') }}" class="form-control"
                               placeholder="Adicionar título"
                               required>
                    </div>
                    <div class="form-group">
                        <textarea name="descricao" class="form-control" placeholder="Descrição" rows="4"></textarea>
                    </div>

                    <div class="form-group text-left">

                        <div class="form-group">
                            <label for="recorrente">Manter grade de aula recorrente?</label> <br>
                            <div class="form-check form-check-inline">
                                <span class="mr-4">
                                    <input class="form-check-input" type="radio" name="recorrente" value="1" checked>Sim
                                </span>
                                <input class="form-check-input" type="radio" name="recorrente" value="0">Não
                            </div>
                        </div>

                        <label for="cores">Cores</label> <br>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="cor" value="#FFBE07" checked>
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
                            Cadastrar
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>
</div>
