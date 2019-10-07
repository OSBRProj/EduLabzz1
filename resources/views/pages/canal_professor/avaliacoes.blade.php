@extends('layouts.master')

@section('title', 'J. PIAGET - Canal do Professor')

@section('headend')

    <!-- Custom styles for this template -->
    <style>
        header {
            padding: 154px 0 100px;
        }

        .avaliacoes-card {
            width: 100%;
            margin: 0 auto 50px;
        }

        .avaliacoes-card .text-primary {
            color:#0D1033 !important;
            font-size:20px;
        }
        .avaliacoes-card .text-secondary {
            color:#60748A !important;
            font-size:17px;
        }
        .avaliacoes h4 {
            font-size:1.75rem !important;
            font-weight:600;
        }

        .avatar-aluno-avaliacao {
            margin-right: 10px;
            width: 50px;
            height: 50px;
            border-radius: 25px;
            -moz-border-radius: 25px;
            -webkit-border-radius: 25px;
            overflow: hidden;
        }

        .avatar-aluno-avaliacao > img { width: 100%; }

        .avaliacao-aluno-icon {
            margin-left: 60px;
            color: #1B2065;
            font-size: 15px;
        }

        @media (min-width: 992px) {
            header { padding: 156px 0 100px; }
        }

    </style>

@endsection

@section('content')

    <main role="main" class="avaliacoes mr-auto">


        @include('pages.canal_professor._header')

        <div class="col-11 mx-auto mt-5">

            <h4 class="text-secondary mb-5">Avaliações</h4>

            <div class="mt-4">

                @forelse($avaliacoes as $avaliacao)

                <div class="avaliacoes-card">
                    <div class="d-flex justify-content-start align-items-center mb-4">
                        <div class="avatar-aluno-avaliacao">
                            <img
                                {{--  src="@if(!empty($avaliacao->img_perfil)) {{ $avaliacao->img_perfil }} @else https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRU1gJrTqXMz_DO0hDOyo2cMMJ76hmIfrTMA5mCalphghLhxkTj @endif"  --}}
                                src="{{ route('usuario.perfil.image', [Auth::user()->id]) }}"
                                alt="Avatar">
                        </div>
                        <p class="text-primary mb-0">{{ $avaliacao->nome }}</p>
                        <div class="avaliacao-aluno-icon">
                            @for ($i = 1; $i <= $avaliacao->estrelas; $i++)
                                <i class="fas fa-star"></i>
                            @endfor
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                    <div class="card p-4 text-primary text-justify shadow-sm">
                        {{ $avaliacao->avaliacao }}
                    </div>
                </div>

                @empty

                <p>Ainda não tem nenhuma avaliação disponível</p>

                @endforelse

            </div>

        </div>

    </main>

@endsection

@section('bodyend')

@endsection
