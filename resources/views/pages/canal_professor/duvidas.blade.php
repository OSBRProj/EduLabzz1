@extends('layouts.master')

@section('title', 'J. PIAGET - Canal do Professor')

@section('headend')

    <!-- Custom styles for this template -->
    <style>
        header {
            padding: 154px 0 100px;
        }

        .text-aberto {
            color: #AC977D;
            font-weight:bold;
        }

        .text-resolvido {
            color: #2AC869;
            font-weight:bold;
        }

        .tx-data {
            color:#999FB4;
            font-size:17px;
            font-weight:600;
        }
        .tx-comentarios {
            display:block;
            margin-top:10px;
            color:#60748A;
            font-size:17px;
            font-weight:500;
        }

        @media (min-width: 992px) {
            header {
                padding: 156px 0 100px;
            }
        }

    </style>

@endsection

@section('content')

    <main role="main" class="mr-auto">


        @include('pages.canal_professor._header')

        <div class="col-11 mx-auto mt-5">

            <div class="mt-4">

                @forelse($duvidas as $duvida)

                <div class="row py-3 px-2 mb-3 box-shadow bg-white">
                    <div class="col-auto my-auto text-left">
                        <div class="d-inline-block font-weight-normal align-middle">
                            <small class="tx-data">
                                {{ $duvida->created_at->format('d/m/Y \à\s H:i') }}
                            </small>
                        </div>
                    </div>
                    <div class="col my-auto text-left">
                        <div class="d-inline-block align-middle">
                            <h5 class="text-dark font-weight-bold mb-0">

                                <span class="text-muted">{{ $duvida->user['name'] }}:</span>
                                <span class="mr-2">{{ ucfirst($duvida->titulo) }}</span>

                                @if($duvida->status == 0)
                                    <span class="" style="color: #B2AC83;">
                                        Aberto
                                    </span>
                                @else
                                    <span class="" style="color: #3FC5F5;">
                                        Resolvido
                                    </span>
                                @endif

                            </h5>
                            {{-- <span class="d-block text-muted font-weight-bold small mr-2">
                                Autor: {{ $duvida->user['name'] }}
                            </span> --}}
                            <small class="tx-comentarios">
                                {{ $duvida->qt_comentarios }} comentário{{ $duvida->qt_comentarios != 1 ? 's' : '' }}
                            </small>
                        </div>
                    </div>
                    <a href="{{ route('canal-professor.duvida-respostas', ['idProfessor' => $duvida->professor_id, 'idDuvida' => $duvida->id]) }}" class="col-auto my-auto text-right ml-auto">
                        <div class="d-inline-block align-middle">
                            <small class="font-weight-bold text-uppercase ml-2">
                            @if($duvida->status == 0)
                                    <span class="" style="color: #3FC5F5;">
                                        LER DÚVIDA
                                    </span>
                                @else
                                    <span class="" style="color: #207adc;">
                                        VER RESPOSTA
                                    </span>
                                @endif
                            </small>
                        </div>
                    </a>
                </div>

                @empty

                <p>Ainda não existe dúvidas</p>

                @endforelse

            </div>

        </div>

    </main>

@endsection

@section('bodyend')

@endsection
