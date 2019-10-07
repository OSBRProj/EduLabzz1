
<div class="tab-pane fade w-100" id="frequencia" role="tabpanel" aria-labelledby="frequencia-tab">

    <div class="container">

        <div class="row">
            <h4 class="mb-3 col-12">Chamada</h4>
        </div>

        <div class="row">
            <div class="form-group text-left mb-3 d-inline-block col-2">
                <label class="control-label text-primary mr-3" for="data_validade">Data da aula:</label>
                <input name="data_aula" type="text" class="form-control datepicker shadow-sm dp-icon" placeholder="dd/mm/aaaa" style="text-align: center;">
            </div>

            <div class="form-group text-left mb-3 d-inline-block col-10 search-glossario">
                <label class="control-label text-primary mr-3" for="data_validade">Descrição da aula</label>
                <input name="descricao" type="text" class="text-truncate" placeholder="Digite aqui a descrição da aula.">
            </div>
        </div>

        <div class="row">
            <div class="d-flex justify-content-between col-3 align-middle ">
                <div class="chiller_cb">
                    <input class="form-check-input" type="checkbox" id="aula_1" value="">
                    <label for="aula_1">
                        <select class="form-control shadow-none bg-transparent border-0 pl-0">
                            <option selected>Classificar pelo nome</option>
                        </select>
                    </label>
                    <span></span>
                </div>
            </div>
            <div class="form-group text-right mb-3 col-9">
                <label class="control-label text-primary" for="data_validade">Quantidade de aulas</label>
                <select class="form-control ml-3 col-1 d-inline-block font-weight-bold text-primary">
                    <option selected>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                    <option>6</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-12 mb-3 ">
                <div class="card card-shadow border-0 rounded">
                    <div class="card-body py-3 rounded-10">
                        <div class="row d-flex align-items-center">
                            <div class="col-6 d-flex align-items-center">
                                <div class="avatar-img avatar-sm mr-2"
                                    style="background: url({{ route('usuario.perfil.image', [Auth::user()->id]) }});">
                                </div>
                                <span class="label-nome pl-2">
                                    Nome Aluno
                                </span>
                            </div>
                            <div class="col-6 justify-content-end d-inline-flex">
                                <div class="chiller_cb">
                                    <input class="form-check-input" type="checkbox" id="aula_1" value="">
                                    <label for="aula_1">&nbsp;</label>
                                    <span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-end pl-0">
            <div class="mr-2 col-3">
                <a href="{{ route('gestao.trilhas.listar') }}"
                    class="btn btn-outline-primary font-weight-bold w-100">CANCELAR</a>
            </div>
            <div class="col-3">
                <button type="submit" class="btn btn-primary font-weight-bold w-100">
                    CONFIRMAR
                </button>
            </div>
        </div>

    </div>

</div>
