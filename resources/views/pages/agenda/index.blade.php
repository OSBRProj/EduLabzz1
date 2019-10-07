@extends('layouts.master')

@section('title', 'J. PIAGET - Agenda')

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

        .radio-group {
            position: relative;
        }

        .radio {
            display: inline-block;
            width: 20px;
            height: 20px;
            margin-bottom: 15px;
            margin-right: 15px;
            background-color: #dedede;
            cursor: pointer;

        }

        .radio.selected {
            border-color: #4d565f;
            background: #4d565f;
            color: #fff;
            line-height: 7;
        }

        .fc-scroller.fc-time-grid-container
        {
            max-height: 50vh !important;
            overflow-y: auto;
        }

    </style>

@endsection



@section('content')

    <main role="main" class="mr-0">

        <div class="container">

            <div class="row">

                <div class="col-12 col-md-11 mx-auto">

                    @include('pages.agenda._create')
                    @include('pages.agenda._edit')

                    <div class="mb-3">
                        @if(!empty($nomeTurma))

                            <div class="col-12 title pl-0">
                                <h2>{{ $nomeTurma }}</h2>
                            </div>

                        @else

                            <div class="col-12 title pl-0">
                                <h2>Minha agenda</h2>
                            </div>

                        @endif
                    </div>

                    <div class="dropdown text-right">

                        @if(!empty($idTurma))
                            <a href="{{ route('agenda.filtrar', ['idTurma' => $idTurma, 'mesclar' => 'true']) }}"
                                class="btn btn-info mr-2">
                                Mesclar com minha agenda
                            </a>
                        @endif

                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownVisualiza"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Filtrar visualização
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('agenda.index') }}">Minha agenda</a>
                            <a class="dropdown-item"
                                href="{{ route('agenda.filtrar', ['idTurma' => 'todas', 'mesclar' => 'false']) }}">
                                Todas as turmas
                            </a>
                            @forelse($turmas as $turma)
                                <a class="dropdown-item"
                                    href="{{ route('agenda.filtrar', ['idTurma' => $turma->turma->id, 'mesclar' => 'false']) }}">{{ $turma->turma->titulo }}
                                </a>
                            @empty
                            @endforelse
                        </div>
                    </div>
                    <hr>

                    <div id="calendar">
                        {!! $calendar->calendar() !!}
                    </div>

                </div>
            </div>
        </div>

    </main>

@endsection

@section('bodyend')

    {!! $calendar->script() !!}

    <script>

        $('.time').mask('00:00');
        $('.datepicker').datepicker({
            firstDay: 1
        });

        $('button#removeAgenda').click(function () {
            var idAgenda = $(this).attr("data-id");
            $("#formExcluirAgenda #idAgenda").val(idAgenda);

            swal({
                title: 'Excluir este horario na agenda?',
                text: "Você deseja mesmo excluir este horário em sua agenda?",
                icon: "warning",
                buttons: ['Não', 'Sim, excluir!'],
                dangerMode: true,
            }).then((result) => {
                if (result == true) {
                    $("#formExcluirAgenda").submit();
                }
            });
        });

    </script>

@endsection

