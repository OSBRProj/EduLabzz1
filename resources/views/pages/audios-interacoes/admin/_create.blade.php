<div class="modal fade" id="divModalNovoAudioInteracao" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl px-1 px-md-5" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                <div class="my-1">

                    <h4 class="text-center">Nova Interação de Áudio</h4>

                    <form id="formNovoAudioInteracao" class="w-100" action="{{ route('gestao.audios-interacoes.store') }}"
                          method="post"
                          enctype="multipart/form-data">

                        @csrf

                        <input type="hidden" class="form-control" name="audio_id" value="{{ $audio_id }}">

                        <div class="row-seekbar row mb-3 d-flex align-items-center">
                            <div class="col-lg-3 col-12">
                                <input type="text" class="txtTempoAudioInteracao form-control" name="inicio"
                                       placeholder="Tempo" readonly>
                            </div>
                            <div class="col-lg-9 col-12">
                                <div class="container-track d-flex align-items-center">
                                    <span class="start-timer">00:00:00</span>
                                    <div class="container-seekbar">
                                    </div>
                                    <span class="end-timer"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-12 col-12">
                                <input type="text" class="form-control" name="titulo"
                                       placeholder="Título da Interação"
                                       required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-12 col-12">
                                <textarea class="form-control" name="descricao" placeholder="Descrição" rows="6" required></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <button type="button" data-dismiss="modal"
                                    class="btn btn-lg btn-block outline-button mt-4 mb-0 col-4 ml-auto mr-4 font-weight-bold">
                                Cancelar
                            </button>
                            <button type="submit" onclick="showEnviandoEditarAudioInteracao();"
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