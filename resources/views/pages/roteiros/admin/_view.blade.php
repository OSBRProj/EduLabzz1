<div class="modal fade" id="divModalViewRoteiro_{{$roteiro->id}}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog-roteiros modal-dialog modal-dialog-centered modal-xl px-1 px-md-5" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="bt-fechar-view-roteiros close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                <div class="my-1">

                    <h4 class="text-center">Roteiro</h4>

                    <form id="formViewRoteiro" class="w-100"
                          action="{{ route('gestao.roteiros.view', ['idRoteiro' => $roteiro->id]) }}"
                          method="post"
                          enctype="multipart/form-data">

                        @csrf

                        <div class="row-view-topico row mb-3 justify-content-end">
                            <div class="col-lg-12 col-12">
                                <h3>{{$roteiro->titulo}}</h3>

                                <span class="numero-itens">{{ count($roteiro->topicos) }} tópicos</span>
                                <div class="box-percent">
                                <span class="lb-percent">
                                @if($roteiro->topicos->topicosAtivos == 0) 
                                    0%
                                @endif                                                    

                                @if(($roteiro->topicos->topicosAtivos > 0 && $roteiro->topicos->topicosInativos > 0) && ($roteiro->topicos->topicosAtivos == $roteiro->topicos->topicosInativos && $roteiro->topicos->topicosInativos == $roteiro->topicos->topicosAtivos))
                                    50%
                                @endif                                     

                                @if($roteiro->topicos->topicosAtivos > 0 && $roteiro->topicos->topicosInativos == 0)
                                    100%
                                @endif

                                @if($roteiro->topicos->topicosAtivos > 0 && $roteiro->topicos->topicosInativos > 0)
                                    @if($roteiro->topicos->topicosAtivos !== $roteiro->topicos->topicosInativos)
                                        @php $ta = $roteiro->topicos->topicosAtivos @endphp
                                        @php $ti = $roteiro->topicos->topicosInativos @endphp
                                        @php $total = $ta + $ti @endphp 
                                        @php $vp = ($ta * 100) / $total @endphp
                                        {{ ceil($vp) }}%
                                    @endif
                                @endif
                                </span>
                                <div class="box-percent-bg">
                                    <span class="fill-percent-bg"></span>
                                </div>
                                </div>                                
                            </div>

                            <div class="col-topicos col-lg-12 col-12 mt-3">
                                <div class="container-input-topico form-group">
                                    @foreach($roteiro->topicos as $topico)                            
                                    <div class="container-input">
                                        <div class="chiller_cb">
                                            <input class="form-check-input" type="checkbox" id="topico_{{ $topico->id }}" onclick="ajaxUpdateStatusTopico({{ $topico->id }});" data-roteiro-id="{{ $topico->roteiro_id }}" value="@if($topico->status) {{ $topico->status }} @else 0 @endif" @if($topico->status == 1) checked @endif>                                         
                                            <label for="topico_{{ $topico->id }}">{{ $topico->titulo }}</label>                                            
                                            <span></span>                                            
                                        </div>                                            
                                        <!--<h5>{{ $topico->titulo }}</h5>-->
                                        <input type="hidden" class="form-control input-topico" name="topico[]"
                                        placeholder="Tópico" value="{{ $topico->titulo }}" disabled>
                                    </div>
                                    @endforeach                                
                                </div>
                            </div>
                           
                        </div>

                    </form>

                </div>

            </div>

        </div>
    </div>
</div>
