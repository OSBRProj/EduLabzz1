@extends('layouts.master')

@section('title', 'J. PIAGET - Canal do Professor')

@section('headend')

    <!-- Custom styles for this template -->
    <style>
        header {
            padding: 154px 0 100px;
        }

        @media (min-width: 992px) {
            header {
                padding: 156px 0 100px;
            }
        }

        h4 { color:#0D1033; }

        .favoritos-thumb-content { position:relative; }

        .favoritos-thumb-img {
            border-top-left-radius: 4px;
            border-bottom-left-radius: 4px;
        }

        .card-desc { overflow:hidden; }

    </style>

@endsection

@section('content')

    <main role="main" class="mr-auto">

        <?php $hasContent = false; ?>

        @include('pages.canal_professor._header')

        <div class="col-11 mx-auto mt-5">

            @if(count($podcasts))
            <?php $hasContent = true; ?>
            <!-- PODCASTS -->
            <section class="section-conteudo mt-5">
                <h4 class="font-weight-bold"><i class="fas fa-podcast"></i> Podcasts</h4>
                <div class="row mt-4">

                   @forelse($podcasts as $podcast)

                   <div class="mb-sm-4 col-12 col-sm-12 col-md-4 col-lg-4">
                        <div class="bg-white rounded-10 w-100">
                            <div class="d-xl-flex justify-content-xl-between">
                                <div class="favoritos-thumb-content">
                                    <div class="icon-favs-bg">
                                        <i class="fas fa-heart"></i>
                                    </div>
                                    <img
                                        class="favoritos-thumb-img"
                                        src="https://theblackboardsite.files.wordpress.com/2017/02/cropped-logo-cover.jpg?w=200"
                                        alt="">
                                </div>
                                <div class="p-4">
                                    <p class="card-text mb-1">{{ $podcast->titulo }}</p>
                                    <div class="d-lg-flex">
                                        <small style="margin-right:6px">{{ $podcast->titulo }}</small>
                                        <span class="badge badge-info pl-2 pr-2 rounded-10">GEOGRAFIA</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @empty

                    <div class="col-12 my-3">
                        <div class="card-curso shadow-sm rounded p-3 bg-white">
                            <h5 class="text-center">Você ainda não criou nenhum podcast.</h5>
                        </div>
                    </div>

                    @endforelse

                </div>
            </section>
            @endif

            @if(count($transmissoes))
            <?php $hasContent = true; ?>
            <!-- TRANSMISSÕES AO VIVO -->
            <section class="section-conteudo mt-2 mb-5">
                <h4 class="font-weight-bold"><i class="fas fa-tv"></i> Transmissões ao vivo</h4>

                <div class="row mt-4 mb-5">

                    @forelse($transmissoes as $transmissao)

                    <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-12">
                        <div class="card-desc bg-white rounded-10">
                            <img src="https://i.ytimg.com/vi/9-2Lr3nmTbE/maxresdefault.jpg" class="card-img-top mb-3">
                            <div class="pb-2 px-4">
                                <p class="card-text mb-1">{{ $transmissao->titulo }}</p>
                                <p>
                                    <small class="text-secondary font-weight-bold">{{ $transmissao->conteudo }}</small>
                                    <i class="fas fa-check-circle text-info"></i></p>
                                <small>Em: {{ date('d/m/Y', strtotime($transmissao->created_at)) }}</small>
                                <span class="badge badge-info pl-2 pr-2 rounded-10">
                                        {{ $transmissao->categoria_id }}
                                    </span>
                                <p class="text-center text-danger mt-4 font-weight-bold"><i class="fas fa-circle"></i>
                                    AO VIVO</p>
                            </div>
                        </div>
                    </div>

                    @empty

                    <div class="col-12 my-3">
                        <div class="card-curso shadow-sm rounded p-3 bg-white">
                            <h5 class="text-center">Você ainda não fez nenhuma transmissão.</h5>
                        </div>
                    </div>

                    @endforelse

                </div>
            </section>
            @endif

            @if(!$hasContent)
            <div class="col-12 my-3">
                <div class="card-curso shadow-sm rounded p-3 bg-white">
                    <h5 class="text-center">O canal desse professor não está disponibilizando conteúdos nesse momento.</h5>
                </div>
            </div>
            @endif

        </div>

    </main>

@endsection

@section('bodyend')

@endsection
