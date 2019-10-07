<div class="modal fade" id="divModalNovoAudio" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md px-1 px-md-5" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                <div class="my-4">

                    <h5 class="text-center mb-3">Adicionar áudio</h5>

                    <form id="formNovoAlbum" class="w-100" action="{{ route('gestao.audios.store') }}"
                          method="post"
                          enctype="multipart/form-data">

                        @csrf

                        <div class="row mb-3">
                            <input type="hidden" name="duracao" class="txtDuracaoAudio" value="">

                            <div class="col-12 mx-auto">

                                <div class="form-group mb-3">
                                    <h6 class="font-weight-bold" for="txtEditarTitulo">
                                        Título do áudio
                                    </h6>
                                    <input type="text" class="form-control" name="titulo" placeholder="Clique para digitar." required>
                                </div>

                                <label for="file" id="divFileInputCapa" class="file-input-area input-capa  mb-3 w-100 text-center bg-secondary">
                                    <input type="file" class="custom-file-input" id="file" name="file" required style="top: 0; height:  100%;position: absolute;left:  0;" accept="audio/mp3, audio/wav">

                                    <h5 id="placeholder" class="text-white">
                                        <i class="far fa-file-audio fa-2x d-block text-white mb-2 w-100" style="vertical-align: sub;"></i>
                                        ARQUIVO DE ÁUDIO
                                        <small
                                            class="text-uppercase d-block text-white small mt-2 mx-auto w-50"
                                            style="font-size:  70%;">
                                            (Arraste o arquivo para esta área)
                                            <br>
                                            MP3 ou WAV
                                        </small>
                                    </h5>
                                </label>

                                <div class="form-group mb-3">
                                        <div class="showAudio"></div>
                                    </div>

                                <div class="form-group mb-3">
                                    <h6 class="font-weight-bold" for="categoria">Selecione uma categoria</h6>

                                    <select name="categoria_id" class="custom-select form-control" required>
                                        <option value="1">Geral</option>
                                        @foreach($categorias as $categoria)
                                            <option
                                                value="{{$categoria->id}}">{{$categoria->titulo}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <h6 class="font-weight-bold" for="descricao">
                                        Descrição do áudio
                                    </h6>
                                    <textarea class="form-control" name="descricao" id="descricao"
                                              placeholder="Clique para digitar.">{{ old('descricao') }}</textarea>
                                </div>


                            </div>


                        </div>


                        <div class="row">
                            <button type="button" data-dismiss="modal"
                                    class="btn btn-danger mt-4 mb-0 col-4 ml-auto mr-4">
                                Cancelar
                            </button>
                            <button type="submit" onclick="showEnviandoEditarAula();"
                                    class="btn btn-primary mt-4 mb-0 col-4 ml-4 mr-auto">
                                Salvar
                            </button>
                        </div>


                    </form>

                </div>

            </div>

        </div>
    </div>
</div>
