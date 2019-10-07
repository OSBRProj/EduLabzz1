<div class="modal fade" id="divModalNovaBadge" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal px-1 px-md-5" role="document">
        <div class="modal-content">
            <div class="modal-body px-md-3 px-lg-5">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                <h5 class="my-5 text-center">Cadastrar novo plano de aula</h5>

                <form action="{{ route('gestao.plano-aulas.cadastrar') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="row">

                        <div class="form-group col-lg-6">
                            <label class="font-weight-bold">Selecione uma aula</label>
                            <select name="grade_aula_id" class="form-control selectGradeAulas" required>
                                <option selected>Selecione uma aula:</option>
                                @foreach($gradeAulas as $grade)
                                    <option value="{{ $grade->id }}"
                                            class="{{ $grade->recorrente }}"
                                            id="{{$grade->dia}}">
                                        {{ $grade->titulo }}
                                    </option>
                                @endforeach
                            </select>


                        </div>

                        <div class="form-group selectDataRecorrente d-block">
                            <label for="">Selecione uma data para uma aula recorrente</label>
                            <input class="datepickerRecorrente" name="data"
                                    placeholder="Clique aqui para selecionar uma data" autocomplete="off">
                        </div>


                        <div class="form-group col-lg-6">
                            <label class="font-weight-bold">Assunto</label>
                            <input type="text" name="assunto" value="{{ old('assunto') }}" class="form-control"
                                   placeholder="Assunto"
                                   required>
                        </div>


                        <div class="form-group col-lg-6">
                            <label class="font-weight-bold">Tarefa de classe</label>
                            <textarea name="tarefa_classe" value="{{ old('tarefa_classe') }}" class="form-control"
                                      rows="5"
                                      placeholder="Tarefa de classe" required></textarea>
                        </div>

                        <div class="form-group col-lg-6">
                            <label class="font-weight-bold">Tarefa de casa</label>
                            <textarea name="tarefa_casa" class="form-control" rows="5" value="{{ old('tarefa_casa') }}"
                                      placeholder="Tarefa de casa"></textarea>
                        </div>


                        <div class="form-group col-lg-6">
                            <label class="font-weight-bold">Adicionar atividades</label>
                            <select class="selectpicker form-control" multiple name="atividades[]"
                                    data-live-search="true">
                                @foreach($conteudos as $conteudo)
                                    <option
                                        value="{{ $conteudo->id }}"
                                        data-content="<span class='badge badge-primary'>{{ $conteudo->titulo }}</span>">{{ $conteudo->titulo }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <hr>

                        <div class="form-group col-lg-6">
                            <label class="font-weight-bold">Adicionar materiais</label>
                            <select class="selectpicker form-control" multiple name="materiais[]"
                                    data-live-search="true">
                                @foreach($conteudos as $conteudo)
                                    <option
                                        value="{{ $conteudo->id }}"
                                        data-content="<span class='badge badge-info'>{{ $conteudo->titulo }}</span>">{{ $conteudo->titulo }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- tema -->
                        <div class="form-group col-lg-12">
                            <label class="font-weight-bold"> Tema </label>
                            <textarea name="tema" class="form-control" rows="5" value="{{ old('tema') }}"
                                      placeholder="Tema"></textarea>
                        </div>

                        <!-- nivel ensino -->
                        <div class="form-group col-lg-6">
                            <label class="font-weight-bold">Nível de Ensino</label>
                            <div class="box-select">
                                <div class="form-check">
                                    <input class="mr-3" type="radio" name="nivel_ensino"
                                           value="Educação Infantil" checked>
                                    <label class="form-check-label">
                                        Educação Infantil
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="mr-3" type="radio" name="nivel_ensino"
                                           value="Ensino Fundamental">
                                    <label class="form-check-label">
                                        Ensino Fundamental
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="mr-3" type="radio" name="nivel_ensino"
                                           value="Ensino Médio">
                                    <label class="form-check-label">
                                        Ensino Médio
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="mr-3" type="radio" name="nivel_ensino"
                                           value="Pré-vestibular">
                                    <label class="form-check-label">
                                        Pré-vestibular
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Ano/Serie -->
                        <div class="form-group col-lg-6">
                            <label class="font-weight-bold">Ano / Série</label>
                            <div class="box-select">
                                <div class="form-check">
                                    <input class="mr-3" type="radio" name="ano_serie"
                                           value="1º Ano" checked>
                                    <label class="form-check-label">
                                        1º Ano
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="mr-3" type="radio" name="ano_serie"
                                           value="2º Ano">
                                    <label class="form-check-label">
                                        2º Ano
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="mr-3" type="radio" name="ano_serie"
                                           value="3º Ano">
                                    <label class="form-check-label">
                                        3º Ano
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="mr-3" type="radio" name="ano_serie"
                                           value="4º Ano">
                                    <label class="form-check-label">
                                        4º Ano
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="mr-3" type="radio" name="ano_serie"
                                           value="5º Ano">
                                    <label class="form-check-label">
                                        5º Ano
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="mr-3" type="radio" name="ano_serie"
                                           value="6º Ano">
                                    <label class="form-check-label">
                                        6º Ano
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="mr-3" type="radio" name="ano_serie"
                                           value="7º Ano">
                                    <label class="form-check-label">
                                        7º Ano
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="mr-3" type="radio" name="ano_serie"
                                           value="8º Ano">
                                    <label class="form-check-label">
                                        8º Ano
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="mr-3" type="radio" name="ano_serie"
                                           value="9º Ano">
                                    <label class="form-check-label">
                                        9º Ano
                                    </label>
                                </div>

                            </div>
                        </div>

                        <!-- Materia -->
                        <div class="form-group col-lg-6">
                            <label class="font-weight-bold">Matéria</label>
                            <div class="box-select">

                                <div class="form-check">
                                    <input class="mr-3" type="radio" name="materia"
                                           value="Português" checked>
                                    <label class="form-check-label">
                                        Português
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="mr-3" type="radio" name="materia"
                                           value="Matemática">
                                    <label class="form-check-label">
                                        Matemática
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="mr-3" type="radio" name="materia"
                                           value="História">
                                    <label class="form-check-label">
                                        História
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="mr-3" type="radio" name="materia"
                                           value="Geografia">
                                    <label class="form-check-label">
                                        Geografia
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="mr-3" type="radio" name="materia"
                                           value="Biologia">
                                    <label class="form-check-label">
                                        Biologia
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="mr-3" type="radio" name="materia"
                                           value="Física">
                                    <label class="form-check-label">
                                        Física
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="mr-3" type="radio" name="materia"
                                           value="Química">
                                    <label class="form-check-label">
                                        Química
                                    </label>
                                </div>

                            </div>
                        </div>

                        <!-- quantidade_aulas -->
                        <div class="form-group col-lg-6">
                            <label class="font-weight-bold">Duração</label>
                            <div class="box-select">

                                <div class="form-check">
                                    <input class="mr-3" type="radio" name="quantidade_aulas"
                                           value="1" checked>
                                    <label class="form-check-label">
                                        1 Aula
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="mr-3" type="radio" name="quantidade_aulas"
                                           value="2">
                                    <label class="form-check-label">
                                        2 Aulas
                                    </label>
                                </div>


                                <div class="form-check">
                                    <input class="mr-3" type="radio" name="quantidade_aulas"
                                           value="3">
                                    <label class="form-check-label">
                                        3 Aulas
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="mr-3" type="radio" name="quantidade_aulas"
                                           value="4">
                                    <label class="form-check-label">
                                        4 Aulas
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="mr-3" type="radio" name="quantidade_aulas"
                                           value="5">
                                    <label class="form-check-label">
                                        5 Aulas
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="mr-3" type="radio" name="quantidade_aulas"
                                           value="6">
                                    <label class="form-check-label">
                                        6 Aulas
                                    </label>
                                </div>

                            </div>
                        </div>

                        <!-- Objetivos -->
                        <div class="form-group col-lg-6">
                            <label class="font-weight-bold">Objetivos</label>
                            <textarea name="objetivos" class="form-control" rows="5" value="{{ old('objetivos') }}"
                                      placeholder="Objetivos"></textarea>
                        </div>

                        <!-- Tópicos de conhecimento -->
                        <div class="form-group col-lg-6">
                            <label class="font-weight-bold">Tópicos de conhecimento</label>
                            <textarea name="topicos_conhecimento" class="form-control" rows="5"
                                      value="{{ old('topicos_conhecimento') }}"
                                      placeholder="Tópicos de conhecimento"></textarea>
                        </div>

                        <!-- Habilidades e competencias -->
                        <div class="form-group col-lg-12">
                            <label class="font-weight-bold">Habilidades e competências</label>
                            <div class="box-select">

                                <div class="row">

                                    <div class="col-lg-6">
                                        <div class="form-check">
                                            <input class="mr-3" type="radio" name="habilidades_competencias"
                                                   value="História e Geografia - Ensino Fundamental" checked>
                                            <label class="form-check-label">
                                                História e Geografia - Ensino Fundamental
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="mr-3" type="radio" name="habilidades_competencias"
                                                   value="Ciências Humanas - Ensino Médio">
                                            <label class="form-check-label">
                                                Ciências Humanas - Ensino Médio
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="mr-3" type="radio" name="habilidades_competencias"
                                                   value="Linguagem e Códigos - Ensino Médio">
                                            <label class="form-check-label">
                                                Linguagem e Códigos - Ensino Médio
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-check">
                                            <input class="mr-3" type="radio" name="habilidades_competencias"
                                                   value="Ciências Naturais - Ensino Fundamental">
                                            <label class="form-check-label">
                                                Ciências Naturais - Ensino Fundamental
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="mr-3" type="radio" name="habilidades_competencias"
                                                   value="Língua Estrangeira - Ensino Médio">
                                            <label class="form-check-label">
                                                Língua Estrangeira - Ensino Médio
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="mr-3" type="radio" name="habilidades_competencias"
                                                   value="Linguagem e Códigos - Ensino Fundamental">
                                            <label class="form-check-label">
                                                Linguagem e Códigos - Ensino Fundamental
                                            </label>
                                        </div>
                                    </div>

                                </div>


                            </div>
                        </div>

                        <!-- Etapas e Atividades -->
                        <div class="form-group col-lg-6">
                            <label class="font-weight-bold">Etapas e Atividades</label>
                            <textarea name="etapas_atividades" class="form-control" rows="5"
                                      value="{{ old('etapas_atividades') }}"
                                      placeholder="Etapas e Atividades"></textarea>
                        </div>

                        <!-- Recursos necessários -->
                        <div class="form-group col-lg-6">
                            <label class="font-weight-bold">Recursos necessários</label>
                            <textarea name="recursos_necessarios" class="form-control" rows="5"
                                      value="{{ old('recursos_necessarios') }}"
                                      placeholder="Recursos necessários"></textarea>
                        </div>

                        <!-- Avaliação -->
                        <div class="form-group col-lg-6">
                            <label class="font-weight-bold">Avaliação</label>
                            <textarea name="avaliacao" class="form-control" rows="5"
                                      value="{{ old('avaliacao') }}"
                                      placeholder="Avaliação"></textarea>
                        </div>

                        <!-- Metodologia -->
                        <div class="form-group col-lg-6">
                            <label class="font-weight-bold">Metodologia</label>
                            <textarea name="metodologia" class="form-control" rows="5"
                                      value="{{ old('metodologia') }}"
                                      placeholder="Metodologia"></textarea>
                        </div>

                        <button type="button" data-dismiss="modal"
                                class="btn btn-danger mt-3 mb-3 col-3 ml-auto mr-4 font-weight-bold">
                            Cancelar
                        </button>
                        <button type="submit"
                                class="btn btn-primary mt-3 mb-3 col-3 ml-4 mr-auto font-weight-bold">
                            Cadastrar
                        </button>
                    </div>


                </form>


            </div>
        </div>
    </div>
