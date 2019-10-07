<div class="modal fade" id="divModalEditRoteiro_{{$roteiro->id}}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog-roteiros modal-dialog modal-dialog-centered modal-xl px-1 px-md-5" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                <div class="my-1">

                    <h4 class="text-center">Atualizar roteiro</h4>

                    <form id="formEditRoteiro" class="w-100"
                          action="{{ route('gestao.roteiros.update', ['idRoteiro' => $roteiro->id]) }}"
                          method="post"
                          enctype="multipart/form-data">

                        @csrf

                        <div class="row mb-3 justify-content-end">
                            <div class="col-lg-12 col-12">
                                <input type="text" class="form-control" name="titulo"
                                       placeholder="Título do Roteiro" value="{{$roteiro->titulo}}"
                                       required>
                            </div>

                            <div class="col-topicos col-lg-12 col-12 mt-3">
                                <div class="container-input-topico form-group">
                                    
                                    @foreach($roteiro->topicos as $i => $topico)                            
                                    <div class="container-input">
                                        <input class="form-check-input checkbox-topico topico-{{ $topico->id }}" type="checkbox" name="topico[{{$i}}][status]" id="topico_edit_{{ $topico->id }}" value="{{ $topico->status }}" @if($topico->status == 1) checked @endif >
                                        <input type="text" class="form-control input-topico" name="topico[{{$i}}][titulo]"
                                        placeholder="Tópico" value="{{ $topico->titulo }}" required>
                                        <button type="button" class="bt-excluir-topico btn btn-light bg-white box-shadow text-declined"><i class="fas fa-trash"></i></button>
                                    </div>
                                    @endforeach                                

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
                                Atualizar
                            </button>
                        </div>


                    </form>

                </div>

            </div>

        </div>
    </div>
</div>
