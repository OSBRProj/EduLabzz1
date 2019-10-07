<div class="modal fade" id="divModalAtualizaPlano_{{$plano->id}}" tabindex="-1" role="dialog"
     aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal px-1 px-md-5" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                <h5 class="my-5 text-center">Editar Plano de aula: {{ $plano->assunto }}</h5>

                <form action="{{ route('gestao.plano-aulas.atualizar', $plano->id) }}" method="post">
                    @csrf
                    <div class="row">


                        <div class="form-group col-lg-6">
                            <label for="Aula" class="font-weight-bold">Selecione uma aula:</label>
                            <select name="grade_aula_id" class="form-control selectGradeAulasEdit_{{$plano->id}}">
                                @foreach($gradeAulas as $grade)
                                    <option
                                        {{ ($grade->id === $plano->grade_aula_id ? "selected" : "") }}
                                        value="{{ $grade->id }}"
                                        data-id="{{date('d-m-Y', strtotime($plano->data))}}"
                                        class="{{ $grade->recorrente }}" id="{{$grade->dia}}">
                                        {{ $grade->titulo }}
                                    </option>
                                @endforeach
                            </select>

                            <div class="form-group selectDataRecorrenteEdit">
                                <label for="" class="font-weight-bold my-3">Selecione uma data para uma aula recorrente</label>
                                <input class="datepickerRecorrenteEdit" name="data"
                                       placeholder="Clique aqui para selecionar uma data" autocomplete="off">
                            </div>
                        </div>


                        <div class="form-group col-lg-6">
                            <label for="" class="font-weight-bold">Assunto</label>
                            <input type="text" name="assunto" value="{{ $plano->assunto }}" class="form-control"
                                   placeholder="Assunto"
                                   required>
                        </div>

                        <div class="form-group col-lg-6">
                        <textarea name="tarefa_classe" class="form-control" rows="5"
                                  placeholder="Tarefa de classe" required>{{ $plano->tarefa_classe }}</textarea>
                        </div>


                        <div class="form-group col-lg-6">
                        <textarea name="tarefa_casa" class="form-control" rows="5"
                                  placeholder="Tarefa de casa">{{ $plano->tarefa_casa }}</textarea>
                        </div>


                        <div class="form-group col-lg-6">
                            <label for="" class="font-weight-bold">Adicionar atividades</label>
                            <select class="selectpicker form-control" multiple name="atividades[]"
                                    data-live-search="true">
                                @foreach($conteudos as $conteudo)
                                    <option
                                        {{ ($plano->anexosAtividades->contains('conteudo_id',$conteudo->id) ? "selected" : "") }}
                                        value="{{ $conteudo->id }}"
                                        data-content="<span class='badge badge-primary'>{{ $conteudo->titulo }}</span>">{{ $conteudo->titulo }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <hr>

                        <div class="form-group col-lg-6">
                            <label for="" class="font-weight-bold">Adicionar materiais</label>
                            <select class="selectpicker form-control" multiple name="materiais[]"
                                    data-live-search="true">
                                @foreach($conteudos as $conteudo)
                                    <option
                                        {{ ($plano->anexosMateriais->contains('conteudo_id',$conteudo->id) ? "selected" : "") }}
                                        value="{{ $conteudo->id }}"
                                        data-content="<span class='badge badge-info'>{{ $conteudo->titulo }}</span>">{{ $conteudo->titulo }}
                                    </option>
                                @endforeach
                            </select>
                        </div>


                        <!-- tema -->
                        <div class="form-group col-lg-12">
                            <label class="font-weight-bold"> Tema </label>
                            <textarea name="tema" class="form-control" rows="5"
                                      placeholder="Tema">{{$plano->tema }}</textarea>
                        </div>

                        <!-- nivel ensino -->
                        <div class="form-group col-lg-6">
                            <label class="font-weight-bold">Nível de Ensino</label>
                            <div class="box-select">
                                <div class="form-check">
                                    <input class="mr-3" type="radio"
                                           name="nivel_ensino"
                                           value="Educação Infantil"
                                        {{ ($plano->nivel_ensino === 'Educação Infantil' ? 'checked' : '') }}
                                    >
                                    <label class="form-check-label">
                                        Educação Infantil
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="mr-3" type="radio" name="nivel_ensino"
                                           value="Ensino Fundamental"
                                        {{ ($plano->nivel_ensino === 'Ensino Fundamental' ? 'checked' : '') }}
                                    >
                                    <label class="form-check-label">
                                        Ensino Fundamental
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="mr-3" type="radio" name="nivel_ensino"
                                           value="Ensino Médio"
                                        {{ ($plano->nivel_ensino === 'Ensino Médio' ? 'checked' : '') }}
                                    >
                                    <label class="form-check-label">
                                        Ensino Médio
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="mr-3" type="radio" name="nivel_ensino"
                                           value="Pré-vestibular"
                                        {{ ($plano->nivel_ensino === 'Pré-vestibular' ? 'checked' : '') }}
                                    >
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
                                           value="1º Ano"
                                        {{ ($plano->ano_serie === '1º Ano' ? 'checked' : '') }}
                                    >
                                    <label class="form-check-label">
                                        1º Ano
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="mr-3" type="radio" name="ano_serie"
                                           value="2º Ano"
                                        {{ ($plano->ano_serie === '2º Ano' ? 'checked' : '') }}
                                    >
                                    <label class="form-check-label">
                                        2º Ano
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="mr-3" type="radio" name="ano_serie"
                                           value="3º Ano"
                                        {{ ($plano->ano_serie === '3º Ano' ? 'checked' : '') }}
                                    >
                                    <label class="form-check-label">
                                        3º Ano
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="mr-3" type="radio" name="ano_serie"
                                           value="4º Ano"
                                        {{ ($plano->ano_serie === '4º Ano' ? 'checked' : '') }}
                                    >
                                    <label class="form-check-label">
                                        4º Ano
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="mr-3" type="radio" name="ano_serie"
                                           value="5º Ano"
                                        {{ ($plano->ano_serie === '5º Ano' ? 'checked' : '') }}
                                    >
                                    <label class="form-check-label">
                                        5º Ano
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="mr-3" type="radio" name="ano_serie"
                                           value="6º Ano"
                                        {{ ($plano->ano_serie === '6º Ano' ? 'checked' : '') }}
                                    >
                                    <label class="form-check-label">
                                        6º Ano
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="mr-3" type="radio" name="ano_serie"
                                           value="7º Ano"
                                        {{ ($plano->ano_serie === '7º Ano' ? 'checked' : '') }}
                                    >
                                    <label class="form-check-label">
                                        7º Ano
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="mr-3" type="radio" name="ano_serie"
                                           value="8º Ano"
                                        {{ ($plano->ano_serie === '8º Ano' ? 'checked' : '') }}
                                    >
                                    <label class="form-check-label">
                                        8º Ano
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="mr-3" type="radio" name="ano_serie"
                                           value="9º Ano"
                                        {{ ($plano->ano_serie === '9º Ano' ? 'checked' : '') }}
                                    >
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
                                           value="Português"
                                        {{ ($plano->materia === 'Português' ? 'checked' : '') }}
                                    >
                                    <label class="form-check-label">
                                        Português
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="mr-3" type="radio" name="materia"
                                           value="Matemática"
                                        {{ ($plano->materia === 'Matemática' ? 'checked' : '') }}
                                    >
                                    <label class="form-check-label">
                                        Matemática
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="mr-3" type="radio" name="materia"
                                           value="História"
                                        {{ ($plano->materia === 'História' ? 'checked' : '') }}
                                    >
                                    <label class="form-check-label">
                                        História
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="mr-3" type="radio" name="materia"
                                           value="Geografia"
                                        {{ ($plano->materia === 'Geografia' ? 'checked' : '') }}
                                    >
                                    <label class="form-check-label">
                                        Geografia
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="mr-3" type="radio" name="materia"
                                           value="Biologia"
                                        {{ ($plano->materia === 'Biologia' ? 'checked' : '') }}
                                    >
                                    <label class="form-check-label">
                                        Biologia
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="mr-3" type="radio" name="materia"
                                           value="Física"
                                        {{ ($plano->materia === 'Física' ? 'checked' : '') }}
                                    >
                                    <label class="form-check-label">
                                        Física
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="mr-3" type="radio" name="materia"
                                           value="Química"
                                        {{ ($plano->materia === 'Química' ? 'checked' : '') }}
                                    >
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
                                           value="1"
                                        {{ ($plano->quantidade_aulas === 1 ? 'checked' : '') }}
                                    >
                                    <label class="form-check-label">
                                        1 Aula
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="mr-3" type="radio" name="quantidade_aulas"
                                           value="2"
                                        {{ ($plano->quantidade_aulas === 2 ? 'checked' : '') }}
                                    >
                                    <label class="form-check-label">
                                        2 Aulas
                                    </label>
                                </div>


                                <div class="form-check">
                                    <input class="mr-3" type="radio" name="quantidade_aulas"
                                           value="3"
                                        {{ ($plano->quantidade_aulas === 3 ? 'checked' : '') }}
                                    >
                                    <label class="form-check-label">
                                        3 Aulas
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="mr-3" type="radio" name="quantidade_aulas"
                                           value="4"
                                        {{ ($plano->quantidade_aulas === 4 ? 'checked' : '') }}
                                    >
                                    <label class="form-check-label">
                                        4 Aulas
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="mr-3" type="radio" name="quantidade_aulas"
                                           value="5"
                                        {{ ($plano->quantidade_aulas === 5 ? 'checked' : '') }}
                                    >
                                    <label class="form-check-label">
                                        5 Aulas
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="mr-3" type="radio" name="quantidade_aulas"
                                           value="6"
                                        {{ ($plano->quantidade_aulas === 6 ? 'checked' : '') }}
                                    >
                                    <label class="form-check-label">
                                        6 Aulas
                                    </label>
                                </div>

                            </div>
                        </div>

                        <!-- Objetivos -->
                        <div class="form-group col-lg-6">
                            <label class="font-weight-bold">Objetivos</label>
                            <textarea name="objetivos" class="form-control" rows="5"
                                      placeholder="Objetivos">{{ $plano->objetivos }}</textarea>
                        </div>

                        <!-- Tópicos de conhecimento -->
                        <div class="form-group col-lg-6">
                            <label class="font-weight-bold">Tópicos de conhecimento</label>
                            <textarea name="topicos_conhecimento" class="form-control" rows="5"
                                      placeholder="Tópicos de conhecimento">{{ $plano->topicos_conhecimento }}</textarea>
                        </div>

                        <!-- Habilidades e competencias -->
                        <div class="form-group col-lg-12">
                            <label class="font-weight-bold">Habilidades e competências</label>
                            <div class="box-select">

                                <div class="row">

                                    <div class="col-lg-6">
                                        <div class="form-check">
                                            <input class="mr-3" type="radio" name="habilidades_competencias"
                                                   value="História e Geografia - Ensino Fundamental"
                                                {{ ($plano->habilidades_competencias === 'História e Geografia - Ensino Fundamental' ? 'checked' : '') }}
                                            >
                                            <label class="form-check-label">
                                                História e Geografia - Ensino Fundamental
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="mr-3" type="radio" name="habilidades_competencias"
                                                   value="Ciências Humanas - Ensino Médio"
                                                {{ ($plano->habilidades_competencias === 'Ciências Humanas - Ensino Médio' ? 'checked' : '') }}
                                            >
                                            <label class="form-check-label">
                                                Ciências Humanas - Ensino Médio
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="mr-3" type="radio" name="habilidades_competencias"
                                                   value="Linguagem e Códigos - Ensino Médio"
                                                {{ ($plano->habilidades_competencias === 'Linguagem e Códigos - Ensino Médio' ? 'checked' : '') }}
                                            >
                                            <label class="form-check-label">
                                                Linguagem e Códigos - Ensino Médio
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-check">
                                            <input class="mr-3" type="radio" name="habilidades_competencias"
                                                   value="Ciências Naturais - Ensino Fundamental"
                                                {{ ($plano->habilidades_competencias === 'Ciências Naturais - Ensino Fundamental' ? 'checked' : '') }}
                                            >
                                            <label class="form-check-label">
                                                Ciências Naturais - Ensino Fundamental
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="mr-3" type="radio" name="habilidades_competencias"
                                                   value="Língua Estrangeira - Ensino Médio"
                                                {{ ($plano->habilidades_competencias === 'Língua Estrangeira - Ensino Médio' ? 'checked' : '') }}
                                            >
                                            <label class="form-check-label">
                                                Língua Estrangeira - Ensino Médio
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="mr-3" type="radio" name="habilidades_competencias"
                                                   value="Linguagem e Códigos - Ensino Fundamental"
                                                {{ ($plano->habilidades_competencias === 'Linguagem e Códigos - Ensino Fundamental' ? 'checked' : '') }}
                                            >
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
                                      placeholder="Recursos necessários">{{ $plano->recursos_necessarios }}</textarea>
                        </div>

                        <!-- Avaliação -->
                        <div class="form-group col-lg-6">
                            <label class="font-weight-bold">Avaliação</label>
                            <textarea name="avaliacao" class="form-control" rows="5"
                                      placeholder="Avaliação">{{ $plano->avaliacao }}</textarea>
                        </div>

                        <!-- Metodologia -->
                        <div class="form-group col-lg-6">
                            <label class="font-weight-bold">Metodologia</label>
                            <textarea name="metodologia" class="form-control" rows="5"
                                      placeholder="Metodologia">{{ $plano->metodologia }}</textarea>
                        </div>

                        <button type="button" data-dismiss="modal"
                                class="btn btn-danger my-3 col-4 ml-auto mr-4 font-weight-bold">
                            Cancelar
                        </button>
                        <button type="submit"
                                class="btn btn-primary my-3 col-4 ml-4 mr-auto font-weight-bold">
                            Atualizar
                        </button>
                    </div>


                </form>

            </div>

        </div>
    </div>
</div>
