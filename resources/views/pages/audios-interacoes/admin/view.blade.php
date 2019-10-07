@extends('layouts.master')

@section('title', 'J. PIAGET - Gestão de Interações de Áudios')

@section('content')

    <?php
    $audio_id = $audio->id;
    $audio_url = URL::to('/uploads/audios/user_id_' . $audio->user_id  . '/' . $audio->file);
    ?>

    <main class="mainViewAudioInteracoes" role="main">
        <div style="display:none">
            <input type="hidden" id="audio_url" value="{{ $audio_url }}">
        </div>

        <div class="container-audios-interacoes container-fluid">

            <div class="row" style="height: 100%; min-height: calc(100vh - 114px);">



                <div class="col-12 col-md-10 mx-auto p-3">

                    <div class="row-head-actions row d-flex align-items-center">
                        <div class="col-12 col-sm-8">
                            <a href="{{ route('gestao.audios-interacoes.listar') }}" class="bt-voltar"><i class="fas fa-angle-left"></i> <span>Voltar</span></a>
                        </div>
                        <div class="col-12 col-sm-4">
                            <button type="button"
                                        class="btn-nova-interacao-audio btn btn-block btn-primary box-shadow text-white text-uppercase font-weight-bold py-3 text-wrap"
                                        data-toggle="modal" onclick="novaInteracaoAudio('divModalNovoAudioInteracao')"
                                        data-target="#divModalNovoAudioInteracao">
                                    <i class="fas fa-plus mr-1"></i>
                                    Nova Interação
                            </button>
                        </div>
                    </div>

                    <div class="card">
                        <div class="row-title row d-flex align-items-center">
                            <div class="col-12 col-sm-3">

                                <div class="audio-capa d-flex align-items-center" {{ $audio->capa != '' ? 'background: url('. env("APP_LOCAL") .'/uploads/albuns/capas/'. $audio->capa .');' : '' }}>
                                    @if(empty($audio->capa))
                                    <i class="fas fa-music"></i>
                                    @endif
                                </div>

                            </div>
                            <div class="col-12 col-sm-9">
                                <h4 class="title">{{ $audio->titulo }}</h4>

                                <div class="container-track view-list d-flex align-items-center">
                                    <span class="start-timer">00:00:00</span>
                                    <div class="container-seekbar">
                                        <input class="seekbar" type="range" value="0" min="0" max="60" step="15" list="number" />
                                        <datalist class="range__list" id="number">
                                            <!--<option class="range__opt opt0">00:00:00</option>-->
                                            @foreach($audio->interacoes as $interacao)
                                                <option class="range__opt">{{ $interacao->inicio }}</option>
                                            @endforeach
                                        </datalist>
                                    </div>
                                    <span class="end-timer end-timer-view">00:00:00</span>
                                </div>
                            </div>
                        </div>


                        @php $i = 1; @endphp
                        @forelse($audio->interacoes as $interacao)

                            @include('pages.audios-interacoes.admin._edit')

                            <div class="row-interacao row d-flex align-items-center">
                                <div class="col-12 col-sm-6 col-lg-10">
                                    <h5 class="subtitle small d-flex align-items-center"><span>Interação {{ $i }}</span> <small>({{ $interacao->inicio }})</small></h5>
                                    <h6 class="subtitle">{{ $interacao->titulo }}</h6>
                                    <p class="text">
                                        {{ $interacao->descricao }}
                                    </p>
                                </div>
                                <div class="col-12 col-sm-6 col-lg-2">
                                    <button type="button" data-toggle="modal" data-target="#divModalEditAudioInteracao_{{ $interacao->id }}"
                                        class="btn-editar-audio-interacao btn btn-light bg-white box-shadow text-secondary" onclick="editarInteracaoAudio('divModalEditAudioInteracao_{{ $interacao->id }}')">
                                        <i class="fas fa-edit"></i>
                                    </button>

                                    <button type="button" onclick="excluirAudioInteracao({{ $interacao->id }})" class="btn btn-light bg-white box-shadow text-declined">
                                        <i class="fas fa-trash"></i>
                                    </button>

                                    <form id="formExcluirAudioInteracao{{ $interacao->id }}"
                                                    action="{{ route('gestao.audios-interacoes.destroy', ['idAudioInteracao' => $interacao->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    <input type="hidden" class="form-control" name="audio_id" value="{{ $audio_id }}">
                                                    </form>
                                </div>
                            </div>
                        @php $i++ @endphp
                    @empty
                        <div class="row-interacao row d-flex align-items-center">
                            <div class="col-12 col-sm-6 col-lg-10">
                                <h5 class="subtitle small">Você ainda não adicionou interações</h5>
                            </div>
                        </div>
                    @endforelse

                </div>

            </div>

        </div>

        <!-- Modal nova interação de áudio -->
        @include('pages.audios-interacoes.admin._create')

    </main>

@endsection
