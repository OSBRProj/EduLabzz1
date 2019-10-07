<div class="modal fade" id="divModalEditarConteudo" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl px-1 px-md-5" role="document">
        <div class="modal-content">
            <div class="modal-body mt-4">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                @if(\Request::is('gestao/curso/*'))
                    <form id="formEditarConteudo" method="POST" action="{{ route('gestao.curso.aula-conteudos-salvar', ['idCurso' => $curso->id]) }}" enctype="multipart/form-data" class="text-center px-3 shadow-none border-0">
                @else
                    <form id="formEditarConteudo" method="POST" action="{{ route('gestao.conteudos-salvar') }}" enctype="multipart/form-data" class="text-center px-3 shadow-none border-0">
                @endif

                    @csrf

                    <input name="idConteudo" required hidden>

                    @if(\Request::is('gestao/curso/*'))
                        <input name="idAula" required hidden>
                    @endif

                    <input name="tipo" required hidden>

                    <div id="divLoading" class="text-center">
                        <i class="fas fa-spinner fa-pulse fa-3x text-primary"></i>
                    </div>

                    <div id="divEnviando" class="text-center d-none">
                        <i class="fas fa-spinner fa-pulse fa-3x text-primary mb-3"></i>
                        <h4>Enviando</h4>
                    </div>

                    <div id="divEditar" class="form-page d-none">

                        <div id="page1" class="form-page">

                            <h4 id="lblTipoConteudo">Tipo de conteudo</h4>

                            <div class="form-group mb-3 text-left">
                                <label class="" for="txtTituloNovoConteudo">Título do conteúdo</label>
                                <input type="text" class="form-control" name="titulo" id="txtTituloNovoConteudo" placeholder="Clique para digitar." required>
                            </div>

                            <div class="form-group mb-3 text-left">
                                <label class="" for="txtDescricaoNovoConteudo">Descrição do conteúdo <small>(opcional)</small></label>
                                <textarea class="form-control" name="descricao" id="txtDescricaoNovoConteudo" rows="3" placeholder="Clique para digitar."></textarea>
                            </div>

                            <div class="custom-control custom-checkbox form-group mb-3 text-left">
                                <input type="checkbox" class="custom-control-input" name="obrigatorio" id="ckbObrigatorioNovoConteudo" checked>
                                <label class="custom-control-label" for="ckbObrigatorioNovoConteudo">Conteúdo obrigatório</label>
                            </div>

                            <div class="form-group mb-3 text-left">
                                <label class="" for="txtTempoLimiteNovoConteudo">Tempo limite <small>(opcional - em minutos)</small></label>
                                <input type="number" step="1" min="0" max="60" class="form-control w-auto" name="tempo" id="txtTempoLimiteNovoConteudo" placeholder="min.">
                            </div>

                            <div id="divVerArquivoAtual" class="form-group mb-3 text-left d-none">
                                <a id="btnVerArquivoAtual" target="_blank" class="btn btn-lg bg-blue text-dark">Ver arquivo atual</a>
                            </div>

                            <div class="tipos-conteudo text-left">

                                <div id="conteudoTipo1" class="tipo">
                                    <div class="form-group mb-3">
                                        <label class="" for="txtConteudo">Conteúdo</label>
                                        <div class="summernote-holder">
                                            <textarea name="conteudo" id="txtConteudo" class="summernote-airmode">
                                                <div style="color: #525870;font-weight: bold;font-size: 16px;">
                                                    <p>Esta é a área de edição de conteúdo misto, clique aqui para começar a editar.</p>
                                                    <ul>
                                                        <li>Aqui você pode escrever artigos.</li>
                                                        <li>Colocar imagens, vídeos, tabelas.</li>
                                                        <li>Personalizar o texto da forma como desejar.</li>
                                                        <li>E muito mais.</li>
                                                    </ul>
                                                </div>
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                                <div id="conteudoTipo2" class="tipo">
                                    <div class="form-group mb-3 text-left">
                                        <label class="" for="inputAudioNovoConteudo">Clique para fazer upload de um novo aúdio</label>
                                        <br>
                                        <div class="upload-btn-wrapper">
                                            <button class="btn btn-lg bg-blue text-white file-name">Selecionar arquivo</button>
                                            <input type="file" name="arquivoAudio" id="inputAudioNovoConteudo" onchange="mudouArquivoInput(this);"  accept="audio/*" />
                                        </div>
                                    </div>
                                    <div class="form-group mb-3 text-left">
                                        <label class="" for="txtAudioNovoConteudo">Ou digite o link</label>
                                        <input type="text" class="form-control" name="conteudoAudio" id="txtAudioNovoConteudo" placeholder="Clique para digitar.">
                                    </div>
                                </div>
                                <div id="conteudoTipo3" class="tipo">
                                    <div class="form-group mb-3 text-left">
                                        <label class="" for="inputVideoNovoConteudo">Clique para fazer upload de um novo vídeo</label>
                                        <br>
                                        <div class="upload-btn-wrapper">
                                            <button class="btn btn-lg bg-blue text-white file-name">Selecionar arquivo</button>
                                            <input type="file" name="arquivoVideo" id="inputVideoNovoConteudo" onchange="mudouArquivoInput(this);"  accept="video/*" />
                                        </div>
                                    </div>
                                    <div class="form-group mb-3 text-left">
                                        <label class="" for="txtVideoNovoConteudo">Ou digite o link</label>
                                        <input type="text" class="form-control" name="conteudoVideo" id="txtVideoNovoConteudo" placeholder="Clique para digitar.">
                                    </div>
                                    <div class="form-group mb-3 text-left" hidden>
                                        <label class="">Preview:</label>
                                        <iframe class="d-block" src="https://www.youtube.com/embed/NpEaa2P7qZI" frameborder="0" allow="encrypted-media" style="width: 40vw;height: 25vw;max-width: 1040px;max-height: 586px;"></iframe>
                                    </div>
                                </div>
                                <div id="conteudoTipo4" class="tipo">
                                    <div class="form-group mb-3 text-left">
                                        <label class="" for="inputSlideNovoConteudo">Clique para fazer upload de um novo slide (Powerpoint)</label>
                                        <br>
                                        <div class="upload-btn-wrapper">
                                            <button class="btn btn-lg bg-blue text-white file-name">Selecionar arquivo</button>
                                            <input type="file" name="arquivoSlide" id="inputSlideNovoConteudo" onchange="mudouArquivoInput(this);"  accept="application/vnd.ms-powerpoint, application/vnd.openxmlformats-officedocument.presentationml.slideshow, application/vnd.openxmlformats-officedocument.presentationml.presentation, .pps, .pptx" />
                                        </div>
                                    </div>
                                    <div class="form-group mb-3 text-left">
                                        <label class="" for="txtSlideNovoConteudo">Ou digite o link</label>
                                        <input type="text" class="form-control" name="conteudoSlide" id="txtSlideNovoConteudo" placeholder="Clique para digitar.">
                                    </div>
                                </div>
                                <div id="conteudoTipo5" class="tipo">
                                    <div class="form-group mb-3 text-left">
                                        <label class="" for="txtTransmissaoNovoConteudo">Digite a url/endpoint da sua transmissão ao vivo</label>
                                        <input type="text" class="form-control" name="conteudoTransmissao" id="txtTransmissaoNovoConteudo" placeholder="Clique para digitar.">
                                    </div>
                                    <div id="divInstrucaoStream" class="" style="margin: 15px 0px; display: block;" hidden>
                                        <h5>Instruçoes para Streaming</h5>
                                        <small>
                                            <p>
                                                <span>Ao iniciar ou configurar o programa, insira os seguintes dados nos respectivos campos:</span> <br>
                                                <strong>Streaming service: </strong>Custom <br>
                                                <strong>Server: </strong>rtmp://stream.ssh101.com/edutube01 <br>
                                                <strong>Play Path/Stream Key: </strong>edutube01 <br>
                                                <strong>Programa recomendado:</strong> <br>
                                                <img src="http://www.edulabzz.com.br/edutube/plataforma/img/obs_logo.png" style="width:20px;height:20px;vertical-align:middle;margin-right:6px">
                                                <strong style="position:relative;top:2px">
                                                    Open Broadcaster Software (OBS):&nbsp;&nbsp;
                                                    (<a style="color:#82a6c8" href="http://obsproject.com/download" target="_blank"> Baixar </a>)
                                                </strong>
                                            </p>
                                        </small>
                                    </div>
                                </div>
                                <div id="conteudoTipo6" class="tipo">
                                    <div class="form-group mb-3 text-left">
                                        <label class="" for="inputArquivoNovoConteudo">Clique para fazer upload de um novo arquivo</label>
                                        <br>
                                        <div class="upload-btn-wrapper">
                                            <button class="btn btn-lg bg-blue text-white file-name">Selecionar arquivo</button>
                                            <input type="file" name="arquivoArquivo" id="inputArquivoNovoConteudo" onchange="mudouArquivoInput(this);" />
                                        </div>
                                    </div>
                                    <div class="form-group mb-3 text-left">
                                        <label class="" for="txtArquivoNovoConteudo">Ou digite o link</label>
                                        <input type="text" class="form-control" name="conteudoArquivo" id="txtArquivoNovoConteudo" placeholder="Clique para digitar.">
                                    </div>
                                </div>
                                <div id="conteudoTipo7" class="tipo">
                                    <div class="form-group mb-3 text-left">
                                        <label class="" for="txtDissertativaNovoConteudo">Sua pergunta dissertativa:</label>
                                        <input type="text" class="form-control" name="conteudoDissertativa" id="txtDissertativaNovoConteudo" placeholder="Digite aqui sua pergunta.">
                                    </div>
                                    <div class="form-group mb-3 text-left">
                                        <label class="" for="txtDissertativaDicaNovoConteudo">Dica <small>(opcional)</small></label>
                                        <input type="text" class="form-control" name="conteudoDissertativaDica" id="txtDissertativaDicaNovoConteudo" placeholder="Digite aqui uma mensagem de dica que será exibida caso seu aluno erre 3x.">
                                    </div>
                                    <div class="form-group mb-3 text-left">
                                        <label class="" for="txtDissertativaExplicacaoNovoConteudo">Explicação <small>(opcional)</small></label>
                                        <input type="text" class="form-control" name="conteudoDissertativaExplicacao" id="txtDissertativaExplicacaoNovoConteudo" placeholder="Digite aqui uma mensagem explicativa a ser exibida quando o usuário acertar.">
                                    </div>
                                </div>
                                <div id="conteudoTipo8" class="tipo">
                                    <div class="form-group mb-3 text-left">
                                        <label class="" for="txtQuizNovoConteudo">Sua pergunta:</label>
                                        <input type="text" class="form-control" name="conteudoQuiz" id="txtQuizNovoConteudo" placeholder="Digite aqui sua pergunta.">
                                    </div>
                                    <div class="custom-control custom-radio mb-3 text-left">
                                        <input type="radio" id="rdoAlternativa1" name="conteudoQuizAlternativaCorreta" value="1" class="custom-control-input">
                                        <label class="custom-control-label" for="rdoAlternativa1">Alternativa 1:</label>
                                        <input type="text" class="form-control d-inline-block mx-2" name="conteudoQuizAlternativa1" id="txtQuizAlternativa1NovoConteudo" placeholder="Digite aqui a 1ª alternativa." style="width: calc(95% - 80px);">
                                    </div>
                                    <div class="custom-control custom-radio mb-3 text-left">
                                        <input type="radio" id="rdoAlternativa2" name="conteudoQuizAlternativaCorreta" value="2" class="custom-control-input">
                                        <label class="custom-control-label" for="rdoAlternativa2">Alternativa 2:</label>
                                        <input type="text" class="form-control d-inline-block mx-2" name="conteudoQuizAlternativa2" id="txtQuizAlternativa2NovoConteudo" placeholder="Digite aqui a 2ª alternativa." style="width: calc(95% - 80px);">
                                    </div>
                                    <div class="custom-control custom-radio mb-3 text-left">
                                        <input type="radio" id="rdoAlternativa3" name="conteudoQuizAlternativaCorreta" value="3" class="custom-control-input">
                                        <label class="custom-control-label" for="rdoAlternativa3">Alternativa 3:</label>
                                        <input type="text" class="form-control d-inline-block mx-2" name="conteudoQuizAlternativa3" id="txtQuizAlternativa3NovoConteudo" placeholder="Digite aqui a 3ª alternativa." style="width: calc(95% - 80px);">
                                    </div>
                                    <div class="form-group mb-3 text-left">
                                        <label class="" for="txtQuizDicaNovoConteudo">Dica <small>(opcional)</small></label>
                                        <input type="text" class="form-control" name="conteudoQuizDica" id="txtQuizDicaNovoConteudo" placeholder="Digite aqui uma mensagem de dica que será exibida caso seu aluno erre 3x.">
                                    </div>
                                    <div class="form-group mb-3 text-left">
                                        <label class="" for="txtQuizExplicacaoNovoConteudo">Explicação <small>(opcional)</small></label>
                                        <input type="text" class="form-control" name="conteudoQuizExplicacao" id="txtQuizExplicacaoNovoConteudo" placeholder="Digite aqui uma mensagem explicativa a ser exibida quando o usuário acertar.">
                                    </div>
                                </div>
                                <div id="conteudoTipo9" class="tipo">
                                    <h4>Tipo 9 = Prova</h4>
                                </div>
                                <div id="conteudoTipo10" class="tipo">
                                    <div class="form-group mb-3">
                                        <label class="" for="txtConteudoEntregavel">Instruções para o conteúdo entregável</label>
                                        <div class="summernote-holder">
                                            <textarea name="conteudoEntregavel" id="txtConteudoEntregavel" class="summernote-airmode">
                                                <div style="color: #525870;font-weight: bold;font-size: 16px;">
                                                    <p>Utilize esta area para passar as instruções necessárias ao seu aluno sobre o que ele deverá lhe enviar.</p>
                                                    <ul>
                                                        <li>Você pode colocar imagens de exemplo de alguma lição ou fotografia.</li>
                                                        <li>Colocar algum vídeo ensinando algo prático para que ele também faça.</li>
                                                        <li>Pode dar instruções de algum trabalho escrito.</li>
                                                        <li>O limite é sua imaginação.</li>
                                                    </ul>
                                                </div>
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                                <div id="conteudoTipo11" class="tipo">
                                    <div class="form-group mb-3 text-left">
                                        <label class="" for="inputApostilaNovoConteudo">Clique para fazer upload do livro digital (.zip)</label>
                                        <br>
                                        <div class="upload-btn-wrapper">
                                            <button class="btn btn-lg bg-blue text-dark file-name">Selecionar arquivo</button>
                                            <input type="file" name="arquivoApostila" id="inputApostilaNovoConteudo" onchange="mudouArquivoInput(this);"  accept=".zip" />
                                        </div>
                                    </div>
                                    <div class="form-group mb-3 text-left">
                                        <label class="" for="txtApostilaNovoConteudo">Ou digite o link</label>
                                        <input type="text" class="form-control" name="conteudoApostila" id="txtApostilaNovoConteudo" placeholder="Clique para digitar.">
                                    </div>
                                </div>
                            </div>

                            {{--  <div class="form-group mb-3 text-left">
                                <label class="" for="cmbStatusNovoConteudo">Status do conteúdo</label>
                                <select id="cmbStatusNovoConteudo" name="status" required class="custom-select rounded">
                                    <option disabled selected>Selecione um status</option>
                                    <option value="0">Não publicado</option>
                                    <option value="1">Publicado</option>
                                    <option value="2">Não listado</option>
                                </select>
                            </div>  --}}
                            <input type="hidden" name="status" value="1">

                            <div class="form-group mb-3 text-left">
                                <label class="" for="txtApoioNovoConteudo">Material / Informações de apoio <small>(opcional)</small></label>
                                <textarea class="form-control" name="apoio" id="txtApoioNovoConteudo" rows="2" placeholder="Clique para digitar."></textarea>
                            </div>

                            <div class="form-group mb-3 text-left">
                                <label class="" for="txtFonteNovoConteudo">Fonte do conteúdo <small>(opcional)</small></label>
                                <textarea class="form-control" name="fonte" id="txtFonteNovoConteudo" rows="2" placeholder="Clique para digitar."></textarea>
                            </div>

                            <div class="form-group mb-3 text-left">
                                <label class="" for="txtAutoresNovoConteudo">Autores do conteúdo <small>(opcional)</small></label>
                                <textarea class="form-control" name="autores" id="txtAutoresNovoConteudo" rows="2" placeholder="Clique para digitar."></textarea>
                            </div>

                            <div class="row mb-3">
                                <button type="button" data-dismiss="modal" class="btn btn-danger mt-4 mb-0 col-4 ml-auto mr-4 font-weight-bold">Cancelar</button>
                                <button type="button" onclick="salvarEdicaoConteudo();" class="btn btn-primary mt-4 mb-0 col-4 ml-4 mr-auto font-weight-bold">Salvar</button>
                            </div>

                        </div>



                    </div>

                </form>

            </div>

        </div>
    </div>
</div>
