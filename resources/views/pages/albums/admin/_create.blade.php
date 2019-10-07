<div class="modal fade" id="divModalNovoAlbum" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl px-1 px-md-5" role="document">
        <div class="modal-content">
            <div class="modal-body p-4" style="min-height: 85vh;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                <div class="my-4">

                    <h5 class="text-center mb-5">Criar álbum</h5>

                    <form id="formNovoAlbum" class="w-100" action="{{ route('gestao.albuns.store') }}"
                          method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="row">

                            <div class="col-12 col-lg-6">

                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group mb-3">
                                            <h6 class="font-weight-bold" for="txtEditarTitulo">
                                                Título do álbum
                                            </h6>
                                            <input type="text" class="form-control" name="titulo"
                                                   placeholder="Clique para digitar."
                                                   required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group mb-3">
                                            <h6 class="font-weight-bold">Selecione uma categoria</h6>
                                            <select name="categoria" class="custom-select form-control" required>
                                                <option value="1">Geral</option>
                                                @foreach($categorias as $categoria)
                                                    <option
                                                        value="{{$categoria->id}}">{{$categoria->titulo}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <label for="capa" id="divFileInputCapa"
                                       class="file-input-area input-capa mt-3 mb-3 w-100 text-center bg-primary">
                                    <input type="file" class="custom-file-input" id="capa" name="capa"
                                           style="top: 0px;height:  100%;position:  absolute;left:  0px;"
                                           accept="image/jpg, image/jpeg, image/png"
                                           oninput="mudouArquivoCapa(this);">

                                    <h5 id="placeholder" class="text-white">
                                        <i class="far fa-image fa-2x d-block text-white mb-2 w-100"
                                           style="vertical-align: sub;"></i>
                                        CAPA DO ÁLBUM
                                        <small
                                            class="text-uppercase d-block text-white small mt-2 mx-auto w-50"
                                            style="font-size:  70%;">
                                            (Arraste o arquivo para esta área)
                                            <br>
                                            JPG ou PNG
                                        </small>
                                    </h5>
                                    <h5 id="file-name" class="float-left text-primary d-none font-weight-bold"></h5>
                                </label>

                                <div class="form-group mb-3 form-group-descricao-album">
                                    <h6 class="font-weight-bold" for="descricao">
                                        Descrição do álbum
                                    </h6>
                                    <textarea class="form-control" name="descricao" id="descricao" rows="3"
                                              placeholder="Clique para digitar.">{{ old('descricao') }}</textarea>
                                </div>


                                <div class="form-group mt-3">
                                    <div class="row audiosAddInline col-lg-12 col-12"></div>
                                </div>


                            </div>

                            <div class="col-12 col-lg-6">

                                <div class="bg-white shadow-sm p-4 pb-2 rounded">
                                    <h6 class="font-weight-bold">
                                        <i class="fas fa-volume-up"></i> Áudios
                                    </h6>

                                    <input type="text" placeholder="Buscar" class="form-control p-2 my-3">

                                    <div style="max-height: 400px; overflow-y: scroll; padding-right: 30px">
                                        @forelse($audios as $audio)
                                            <div class="audio-container removeContainerAudio_{{$audio->id}}">
                                                <div
                                                    class="w-100 d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <h5 class="audio-title font-weight-bold text-primary">{{ $audio->titulo }}</h5>
                                                        <p class="font-weight-bold">{{$audio->user->name}}</p>
                                                    </div>
                                                    <div style="cursor: pointer;" class="addAudio"
                                                         id="{{$audio->id}}" data-id="{{$audio->titulo}}">
                                                        <i class="fas fa-plus fa-lg text-primary"></i>
                                                    </div>
                                                </div>

                                                <div class="w-100 border-bottom mb-3 pb-3">
                                                    <audio
                                                        src="{{ env("APP_LOCAL") }}/uploads/audios/user_id_{{\Auth::user()->id}}/{{$audio->file}}"
                                                        controls class="w-100" style="outline: none"></audio>
                                                </div>
                                            </div>

                                        @empty
                                            Nenhum áudio cadastrado.
                                        @endforelse
                                    </div>

                                </div>

                            </div>

                        </div>


                        <div class="row mt-4">
                            <button type="button" data-dismiss="modal"
                                    class="btn btn-danger mb-0 col-4 ml-auto mr-4">
                                Cancelar
                            </button>
                            <button type="submit" onclick="showEnviandoEditarAula();"
                                    class="btn btn-primary mb-0 col-4 ml-4 mr-auto">
                                Salvar
                            </button>
                        </div>
                        <div class="audiosIds"></div>
                    </form>

                </div>

            </div>

        </div>
    </div>
</div>
