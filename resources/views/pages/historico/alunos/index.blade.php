@extends('layouts.master')

@section('title', 'J. PIAGET - Histórico de visualizações')

@section('headend')

    <!-- Custom styles for this template -->
    <style>
        .text-type {
            color: #AC977D;
        }
    </style>

@endsection



@section('content')

    <main role="main" class="mr-0">
        <div class="row justify-content-center">
            <div class="col-11 px-2 px-lg-0 mx-auto">

                <section class="mt-5 mb-5">
                    <div class="col-lg-12 col-xl-12 mx-auto mt-2">


                        <div class="d-lg-flex justify-content-between">
                            <p class="text-primary">Histórico de visualizações</p>

                            <form action="{{ route('historico.search') }}" method="post" class="d-flex">
                                @csrf
                                <input type="text" name="search" class="input-search-favoritos"
                                       placeholder="Pesquisar no histórico">
                                <button type="submit" class="icon-search-favoritos">
                                    <i class="fas fa-search"></i>
                                </button>
                            </form>
                        </div>


                        @if($historicos->count() >= 1)
                            <div class="mt-5">
                                <i class="fas fa-calendar fa-lg"></i> <span
                                    class="text-primary">Hoje </span>({{ \Carbon\Carbon::now()->format('d/m/Y') }})
                                <div class="row mt-4">
                                    @forelse($historicos as $historico)
                                        @if( date('Y-m-d') === date('Y-m-d', strtotime($historico->created_at)))
                                            @include('pages.historico.alunos._cards')
                                        @endif
                                    @empty
                                        Nenhum registro encontrado para a data de hoje.
                                    @endforelse
                                </div>
                            </div>


                            <div class="mt-5">
                                <i class="fas fa-calendar fa-lg"></i>
                                <span class="text-primary">Ontem </span>
                                ({{ \Carbon\Carbon::now()->subDays(1)->format('d/m/Y') }})
                                <div class="row mt-4">
                                    @forelse($historicos as $historico)
                                        @if( date('Y-m-d', strtotime($historico->created_at)) === \Carbon\Carbon::now()->subDays(1)->format('Y-m-d'))
                                            @include('pages.historico.alunos._cards')
                                        @endif
                                    @empty
                                        Nenhum registro encontrado para a data de ontem
                                    @endforelse
                                </div>
                            </div>

                            <div class="mt-5">
                                <i class="fas fa-calendar fa-lg"></i>
                                <span class="text-primary">Outros </span>
                                <div class="row mt-4">
                                    @forelse($historicos as $historico)
                                        @if(date('Y-m-d', strtotime($historico->created_at)) <= \Carbon\Carbon::now()->subDays(2)->format('Y-m-d'))
                                            @include('pages.historico.alunos._cards')
                                        @endif
                                    @empty
                                        Nenhum registro encontrado
                                    @endforelse
                                </div>
                            </div>
                        @else
                            Nenhum registro encontrado para nenhuma data
                        @endif


                    </div>
                </section>
            </div>
        </div>
    </main>


@endsection

@section('bodyend')


@endsection

