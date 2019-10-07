<div class="modal fade" id="divModalEditAudio_{{$audio->id}}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md px-1 px-md-5" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                <div class="my-4">

                    <h4 class="text-center">Atualizar áudio</h4>

                    <form id="formEditarAudio" class="w-100"
                          action="{{ route('gestao.audios.update', ['idAudio' => $audio->id]) }}"
                          method="post"
                          enctype="multipart/form-data"
                          onsubmit="atualizarAudio();">
                        @csrf

                        <div id="divLoading" class="my-4 text-center d-none">
                            <i class="fas fa-spinner fa-pulse fa-3x text-primary"></i>
                        </div>

                        <div id="divEnviando" class="my-4 text-center d-none">
                            <i class="fas fa-spinner fa-pulse fa-3x text-primary mb-3"></i>
                            <h4>Enviando</h4>
                        </div>

                        <div id="divEditar" class="form-page">

                            <input type="hidden" name="audio_atual" value="{{ $audio->file }}">

                            <input type="hidden" name="duracao" class="txtDuracaoAudio" value="{{ $audio->duracao }}">

                            <div class="row mb-3">
                                <div class="col-12 mx-auto">

                                    <div class="form-group mb-3">
                                        <label class="text-primary font-weight-bold" for="txtEditarTitulo">
                                            Título do áudio
                                        </label>
                                        <input type="text" class="form-control" name="titulo"
                                            placeholder="Clique para digitar." value="{{ $audio->titulo }}"
                                            required>
                                    </div>

                                    <label for="file" id="divFileInputCapa"
                                        class="file-input-area input-capa  mb-3 w-100 text-center bg-secondary">
                                        <input type="file" class="custom-file-input" id="file" name="file"
                                            style="top: 0; height:  100%;position: absolute;left:  0;"
                                            accept="audio/mp3, audio/wav">

                                        <h5 id="placeholder" class="text-white">
                                            <i class="far fa-file-audio fa-2x d-block text-white mb-2 text-center w-100"
                                            style=""></i>
                                            TROCAR ARQUIVO DE ÁUDIO
                                            <small
                                                class="text-uppercase d-block text-white small mt-2 mx-auto w-50"
                                                style="font-size:  70%;">
                                                (Arraste o arquivo para esta área para trocar de arquivo)
                                                <br>
                                                MP3 ou WAV
                                            </small>
                                        </h5>
                                    </label>

                                    <div class="form-group mb-3">
                                        <div class="showAudio"></div>
                                    </div>

                                    <div class="form-group mb-3">
                                        <p>Arquivo atual:</p>
                                        <audio
                                            src="{{ env("APP_LOCAL") }}/uploads/audios/user_id_{{ \Auth::user()->id }}/{{ $audio->file }}"
                                            controls class="w-100" style="outline: none"></audio>
                                    </div>


                                    <div class="form-group mb-3">
                                        <label for="categoria">Selecione uma categoria</label>
                                        <select name="categoria_id" class="custom-select form-control" required>
                                            <option value="1">Geral</option>
                                            @foreach($categorias as $categoria)
                                                <option
                                                    {{ $categoria->id === $audio->categoria_id ? "selected" : null }}
                                                    value="{{$categoria->id}}"
                                                >
                                                    {{$categoria->titulo}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="text-primary font-weight-bold" for="descricao">
                                            Descrição do áudio
                                        </label>
                                        <textarea class="form-control" name="descricao" id="descricao"
                                                placeholder="Clique para digitar.">{{ $audio->descricao }}</textarea>
                                    </div>

                                </div>

                            </div>


                            <div class="row">
                                <button type="button" data-dismiss="modal"
                                        class="btn btn-lg btn-block outline-button mt-4 mb-0 col-4 ml-auto mr-4 font-weight-bold">
                                    Cancelar
                                </button>
                                <button type="submit" onclick="showEnviandoEditarAula();"
                                        class="btn btn-lg btn-block bg-blue mt-4 mb-0 col-4 ml-4 mr-auto text-white font-weight-bold">
                                    Atualizar
                                </button>
                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>
    </div>
</div>
