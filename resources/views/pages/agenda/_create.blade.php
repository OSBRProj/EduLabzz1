<div class="modal fade" id="novaAgenda" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal text-center px-1 px-md-5" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                <h4 class="mb-5 text-primary">Cadastrar nova agenda</h4>

                <form action="{{ route('agenda.cadastro') }}" method="post">
                    @csrf


                    <div class="form-group row">
                        <div class="col-lg-6">
                            <input type="text" name="date" id="dateCalendarInput" class="form-control datepicker" autocomplete="off">
                        </div>
                        <div class="col-lg-6">
                            <input type="text" name="hour" id="hourCalendarInput" class="form-control time">
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
