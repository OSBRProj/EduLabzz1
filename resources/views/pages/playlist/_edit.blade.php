<div class="modal fade" id="divModalEditPlaylist_{{$playlist->id}}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl px-1 px-md-5" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                <div class="my-4">

                    <h4 class="text-center">Atualizar playlist</h4>

                    <form id="formEditarPlaylist" class="w-100"
                          action="{{ route('playlists.update', [ 'idPlaylist' => $playlist->id]) }}"
                          method="post"
                          enctype="multipart/form-data"
                          onsubmit="atualizarPlaylist();">
                        @csrf

                        <div id="divLoading" class="my-4 text-center d-none">
                            <i class="fas fa-spinner fa-pulse fa-3x text-primary"></i>
                        </div>

                        <div id="divEnviando" class="my-4 text-center d-none">
                            <i class="fas fa-spinner fa-pulse fa-3x text-primary mb-3"></i>
                            <h4>Enviando</h4>
                        </div>

                        <div id="divEditar" class="form-page" style="min-height: 70vh; display: flex; flex-direction: column; justify-content: space-between;">

                            <div class="row">

                                <div class="col-12 col-lg-6">

                                    <div class="form-group mb-3">
                                        <label class="text-primary font-weight-bold" for="txtEditarTitulo">
                                            Título da playlist
                                        </label>
                                        <input type="text" class="form-control" name="titulo"
                                            placeholder="Clique para digitar." value="{{$playlist->titulo}}"
                                            required>
                                    </div>


                                    <div class="form-group mt-3">
                                        <div class="row audiosAddInline col-lg-12 col-12">

                                            @foreach($playlist->audios as $audio)
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
                                                    style="display: {{( $playlist->audios->contains('id', $audio->id) ? 'none' : null )}}"
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
                                                            controls preload="none" class="w-100"
                                                            style="outline: none"></audio>
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
