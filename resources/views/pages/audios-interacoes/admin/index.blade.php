@extends('layouts.master')

@section('title', 'J. PIAGET - Gestão de Interações de Áudios')

@section('content')

    <main role="main">

        <div class="container-audios-interacoes container-fluid">

            <div class="row" style="height: 100%; min-height: calc(100vh - 114px);">

                <div class="col-12 col-sm-12 col-md-11 mx-auto p-3">

                    <div class="row">
                        <div class="col-12 mb-3 title pl-0">
                            <h2>Interações de áudio</h2>
                        </div>

                        <div class="col-12 px-0 mb-4">

                            @if(count($audios) > 0)
                                <div class="row">
                                    <div class="col-12 col-md-12 col-xl-12 my-auto">
                                        <form action="" method="get">
                                        <div class="input-group input-group mb-3">

                                                <input name="pesquisa" type="text" value="{{ Request::has('pesquisa') ? Request::get('pesquisa') : '' }}" required class="form-control py-2 width-100 shadow-sm border-0 px-3"
                                                    placeholder="Procurar áudio ou interação."
                                                    aria-label="Recipient's username" aria-describedby="button-addon2">

                                                <div class="input-group-append">
                                                    <button class="btn bg-primary border-0 text-light shadow-sm" type="submit" id="button-addon2">
                                                        <i class="fas fa-search fa-lg fa-fw text-light"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            </form>

                                    </div>

                                    {{-- <div class="col-sm-12 col-md-4 col-xl-3 mb-3">
                                        <a href="{{ route('gestao.audios.listar') }}" class="btn btn-block btn-primary text-truncate text-uppercase d-flex align-items-center justify-content-center font-weight-bold mr-3 mb-2 mb-sm-0 h-100">
                                            <i class="fas fa-plus mr-2"></i>
                                            Novo áudio
                                        </a>
                                    </div> --}}

                                </div>
                            @else
                                {{-- <a href="{{ route('gestao.audios.listar') }}" class="btn btn-primary text-truncate text-uppercase font-weight-bold mr-3 mb-2 mb-sm-0">
                                    <i class="fas fa-plus mr-2"></i>
                                    Novo áudio
                                </a> --}}
                            @endif

                            @if(Request::has('pesquisa'))
                                <div class="col-sm-12 col-md-6 text-center text-md-left mb-md-0 my-3">
                                    <h5 class="my-2">
                                        <span class="font-weight-bold text-bluegray align-middle">Buscando por:</span>
                                        <span class="font-weight-bold text-bluegray align-middle" style="background-color: #207adc;color:  white;border-radius:  25px;padding:  8px 30px;margin:  0px 10px;">
                                            "{{ ucfirst(Request::get('pesquisa')) }}"
                                            <a href="{{ url()->current() }}" class="text-white ml-2">
                                                <i class="fas fa-times"></i>
                                            </a>
                                        </span>
                                    </h5>
                                </div>
                            @endif

                        </div>
                    </div>

                    <div class="row">

                        @forelse($audios as $audio)

                        <div class="col-item col-12 col-sm-10 col-md-5 col-lg-4 mb-3 mx-auto mx-md-0">
                            <a href="{{ route('gestao.audios-interacoes.view', ['id' => $audio->id]) }}" class="audio-card card box-shadow bg-white rounded-10 px-3">
                                <div class="row-audio-card row">
                                    <div class="audio-capa d-flex align-items-center" {{ $audio->capa != '' ? 'background: url('. env("APP_LOCAL") .'/uploads/albuns/capas/'. $audio->capa .');' : 'red' }}>
                                        @if(empty($audio->capa))
                                        <i class="fas fa-music"></i>
                                        @endif
                                    </div>
                                    <div class="audio-desc text-dark">
                                        <span class="title">{{ ucfirst($audio->titulo) }}</span>
                                        <small class="qtd">{{ count($audio->interacoes) }} interações</small>
                                        <small class="tempo">{{ $audio->duracao }}</small>
                                    </div>
                                </div>
                            </a>
                        </div>

                        @empty
                            <div class="col-12 px-2 mb-4">
                                <div class="card box-shadow rounded-10 p-3">
                                    @if(Request::has("pesquisa"))
                                        <h5>Nenhum resultado encontrado de acordo com sua busca.</h5>
                                    @else
                                        <h5>Você ainda não adicionou nenhuma interação de áudio.</h5>
                                    @endif
                                </div>
                            </div>
                            <!-- Modal novo roteiro -->
                        @endforelse
                    </div>

                </div>

            </div>

        </div>

    </main>

@endsection
