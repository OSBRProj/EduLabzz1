<div class="modal fade" id="divModalEditAlbum_{{$album->id}}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl px-1 px-md-5" role="document">
        <div class="modal-content">
            <div class="modal-body" style="min-height: 85vh;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                <div class="my-4">

                    <h4 class="text-center">Atualizar álbum</h4>

                    <form id="formEditarAlbum" class="w-100"
                          action="{{ route('gestao.albuns.update', ['idAlbum' => $album->id]) }}"
                          method="post"
                          enctype="multipart/form-data">
                        @csrf

                        <div class="row">

                            <div class="col-12 col-lg-6">

                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group mb-3">
                                            <label class="text-primary font-weight-bold" for="txtEditarTitulo">
                                                Título do álbum
                                            </label>
                                            <input type="text" class="form-control" name="titulo"
                                                   placeholder="Clique para digitar." value="{{$album->titulo}}"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group mb-3">
                                            <label class="text-primary font-weight-bold">Selecione uma categoria</label>
                                            <select name="categoria" class="custom-select form-control" required>
                                                <option value="1">Geral</option>
                                                @foreach($categorias as $categoria)
                                                    <option
                                                        value="{{$categoria->id}}"
                                                        {{ ($categoria->id === $album->categoria ? 'selected' : null ) }}
                                                    >
                                                        {{$categoria->titulo}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <label for="capa" id="divFileInputCapa"
                                       class="file-input-area input-capa mt-3 mb-3 w-100 text-center bg-primary" 
                                       style="@if($album->capa) background:url({{ url('/uploads/albuns/capas/' . $album->capa) }}) no-repeat top center;background-size:contain;background-position:50% 50%;background-repeat: no-repeat; @endif">
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
                                    <h5 id="file-name"
                                        class="float-left text-primary d-none font-weight-bold"
                                        style="margin: 145px 0 20px 10px;">
                                    </h5>
                                </label>

                                <div class="form-group mb-3 form-group-descricao-album">
                                    <label class="text-primary font-weight-bold" for="descricao">
                                        Descrição do álbum
                                    </label>
                                    <textarea class="form-control" name="descricao" id="descricao" rows="3"
                                              placeholder="Clique para digitar.">{{$album->descricao}}</textarea>
                                </div>


                                <div class="form-group mt-3">
                                    <div class="row audiosAddInline col-lg-12 col-12">
                                        @foreach($album->audios as $audio)
                                            <div class="col-lg-12 col-12 border-bottom mb-3"
                                                 id="box_audio_id_{{$audio->id}}">
                                                <i class="fas fa-times d-flex text-danger removeAudio justify-content-end"
                                                   id="{{ $audio->id }}" style="cursor: pointer;"></i>
                                                <p class="font-weight-bold text-primary">
                                                    <i class="fas fa-music mr-3"></i> {{$audio->titulo}}
                                                </p>
                                            </div>

                                            <div class="audiosIds">
                                                <input type="hidden" id="audio_id_{{$audio->id}}" name="audio_id[]"
                                                       value="{{$audio->id}}">
                                            </div>

                                        @endforeach
                                    </div>
                                </div>


                            </div>

                            <div class="col-12 col-lg-6">

                                <div class="bg-white box-shadow p-4 rounded-10">
                                    <h4 class="text-primary font-weight-bold">
                                        <i class="fas fa-volume-up"></i> ÁUDIOS
                                    </h4>

                                    <input type="text" placeholder="Buscar" class="form-control p-2 my-5">

                                    <div style="max-height: 400px; overflow-y: scroll; padding-right: 30px">
                                        @forelse($audios as $audio)
                                            <div class="removeContainerAudio_{{$audio->id}}"
                                                 style="display: {{( $album->audios->contains('id', $audio->id) ? 'none' : null )}}"
                                            >
                                                <div
                                                    class="w-100 d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <h5 class="font-weight-bold text-primary">{{ $audio->titulo }}</h5>
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


                        <div class="row">
                            <button type="button" data-dismiss="modal"
                                    class="btn btn-lg btn-block outline-button mt-4 mb-0 col-4 ml-auto mr-4 font-weight-bold">
                                Cancelar
                            </button>
                            <input type="hidden" name="capa_atual" value="{{$album->capa}}">
                            <button type="submit" onclick="showEnviandoEditarAula();"
                                    class="btn btn-lg btn-block bg-blue mt-4 mb-0 col-4 ml-4 mr-auto text-white font-weight-bold">
                                Salvar
                            </button>
                        </div>

                    </form>

                </div>

            </div>

        </div>
    </div>
</div>
