@extends('layouts.master')

@section('title', 'J. PIAGET - Gestão de roteiros')

@section('content')

    <main class="indexRoteiros" role="main">

        <div class="container">

            <div class="row" style="height: 100%; min-height: calc(100vh - 114px);">

                <div class="col-12 col-md-11 mx-auto">

                    <div class="row">
                        <div class="col-12 mb-3 title pl-0">
                            <h2>Roteiros</h2>
                        </div>

                        <div class="col-12 px-0 mb-4">

                            @if(count($roteiros) > 0)
                                <div class="row">
                                    <div class="col-sm-12 col-md-8 col-xl-9 my-auto">
                                        <form action="" method="get">
                                        <div class="input-group input-group mb-3">

                                                <input name="pesquisa" type="text" value="{{ Request::has('pesquisa') ? Request::get('pesquisa') : '' }}" required class="form-control py-2 width-100 shadow-sm border-0 px-3"
                                                    placeholder="Procurar roteiro."
                                                    aria-label="Recipient's username" aria-describedby="button-addon2">

                                                <div class="input-group-append">
                                                    <button class="btn bg-primary border-0 text-light shadow-sm" type="submit" id="button-addon2">
                                                        <i class="fas fa-search fa-lg fa-fw text-light"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            </form>

                                    </div>

                                    <div class="col-sm-12 col-md-4 col-xl-3 mb-3">
                                        <button type="button" data-toggle="modal" data-target="#divModalNovoRoteiro" class="btn btn-block btn-primary text-truncate text-uppercase d-flex align-items-center justify-content-center font-weight-bold mr-3 mb-2 mb-sm-0 h-100">
                                            <i class="fas fa-plus mr-2"></i>
                                            Novo roteiro
                                        </button>
                                    </div>

                                </div>
                            @else
                                <button type="button" data-toggle="modal" data-target="#divModalNovoRoteiro" class="btn btn-primary text-truncate text-uppercase font-weight-bold mr-3 mb-2 mb-sm-0">
                                    <i class="fas fa-plus mr-2"></i>
                                    Novo roteiro
                                </button>
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

                        @forelse($roteiros as $roteiro)
                            <!-- Modal edit audio -->
                                @include('pages.roteiros.admin._view')
                                @include('pages.roteiros.admin._edit')
                            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3 px-2 mb-4">
                                <div class="card-curso card-roteiro box-shadow bg-white rounded-10 pb-3 h-100" id="cardRoteiro_{{ $roteiro->id }}">

                                    <p class="text-secondary font-weight-bold">
                                        <span class="titulo-roteiro">{{ ucfirst($roteiro->titulo) }}</span>

                                        <span class="numero-itens">{{ count($roteiro->topicos) }} tópicos</span>
                                            <div class="box-percent">
                                            <span class="lb-percent">
                                            @if($roteiro->topicos->topicosAtivos > 0 && $roteiro->topicos->topicosInativos == 0)
                                                100%
                                            @endif

                                            @if($roteiro->topicos->topicosAtivos == 0)
                                                0%
                                            @endif

                                            @if(($roteiro->topicos->topicosAtivos > 0 && $roteiro->topicos->topicosInativos > 0) && ($roteiro->topicos->topicosAtivos == $roteiro->topicos->topicosInativos && $roteiro->topicos->topicosInativos == $roteiro->topicos->topicosAtivos))
                                                50%
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
                                    </p>

                                    <div class="text-center">
                                        <button type="button" data-toggle="modal"
                                                data-target="#divModalViewRoteiro_{{$roteiro->id}}"
                                                class="btn btn-light bg-white box-shadow text-secondary">
                                            <i class="fas fa-eye"></i>
                                        </button>

                                        <button type="button" data-toggle="modal"
                                                data-target="#divModalEditRoteiro_{{$roteiro->id}}"
                                                class="btn btn-light bg-white box-shadow text-secondary">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <button type="button" onclick="excluirRoteiro({{ $roteiro->id }})"
                                                class="btn btn-light bg-white box-shadow text-declined">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>

                                    <form id="formExcluirRoteiro{{ $roteiro->id }}"
                                            action="{{ route('gestao.roteiros.destroy', ['idRoteiro' => $roteiro->id]) }}"
                                            method="post">@csrf</form>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 my-3">
                                <div class="card-curso shadow-sm rounded p-3 bg-white">
                                    @if(Request::has("pesquisa"))
                                        <h5>Nenhum resultado encontrado de acordo com sua busca.</h5>
                                    @else
                                        <h5>Você ainda não adicionou nenhum roteiro.</h5>
                                    @endif
                                </div>
                            </div>
                            <!-- Modal novo roteiro -->
                        @endforelse
                    </div>

                </div>

            </div>

        </div>

        <!-- Modal novo audio -->
        @include('pages.roteiros.admin._create')

    </main>

@endsection
