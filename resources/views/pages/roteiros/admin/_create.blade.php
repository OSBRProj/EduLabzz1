<div class="modal fade" id="divModalNovoRoteiro" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog-roteiros modal-dialog modal-dialog-centered modal-xl px-1 px-md-5" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                <div class="my-1">

                    <h4 class="text-center">Adicionar roteiro</h4>

                    <form id="formNovoRoteiro" class="w-100" action="{{ route('gestao.roteiros.store') }}"
                          method="post"
                          enctype="multipart/form-data">

                        @csrf

                        <div class="row mb-3 justify-content-end">
                            <div class="col-lg-12 col-12">
                                <input type="text" class="txtTituloRoteiro form-control" name="titulo"
                                       placeholder="Título do Roteiro"
                                       required>
                            </div>

                            <div class="col-topicos mt-3 col-lg-12 col-12">
                                <div class="container-input-topico form-group">
                                </div>
                            </div>

                            <div class="col-lg-12 col-12 mt-3">
                                <div class="row justify-content-end">
                                    <div class="col-lg-4 col-12">
                                        <button type="button" class="bt-adicionar-topico btn btn-primary mt-4 mb-0 ml-4 mr-auto">
                                        Adicionar Tópico   
                                        </button>                            
                                    </div>
                                </div>
                            </div>


                        </div>

                        <div class="row">
                            <button type="button" data-dismiss="modal"
                                    class="btn btn-danger mt-4 mb-0 col-4 ml-auto mr-4">
                                Cancelar
                            </button>
                            <button type="submit" onclick="showEnviandoEditarRoteiro();"
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