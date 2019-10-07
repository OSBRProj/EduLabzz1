@extends('layouts.master')

@section('title', 'J. PIAGET - Plano de aulas')

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

        .form-search {
            width: 100%;
            display: flex;
            background-color: #FFFFFF;
            border-radius: 10px;
        }

        .form-search > input {
            width: 100%;
            border: 0;
            background: transparent;
            padding: 20px;

        }

        .form-search > button {
            padding: 0 20px;
            border: 0;
            background: transparent;
        }

        .btn-add {
            display: flex;
            justify-content: center;
            align-items: center;
            color: #FFFFFF;
            width: 300px;
            padding: 20px 10px;
            background-color: #207adc;
            cursor: pointer;
            font-weight: bold;
        }

        .btn-select {
            display: flex;
            justify-content: space-between;
            border: 1px solid #207adc;
            background-color: transparent;
            color: #207adc;
            padding: 15px;
            font-weight: bold;
            font-size: 22px;
        }

        .btn-select-open {
            background-color: #207adc;
            color: #FFFFFF;
        }

        .btn-select > span > i {
            font-size: 30px;
        }


        .selectDataRecorrente,
        .selectDataRecorrenteEdit {
            display: none;
        }

        .box-select {
            width: 100%;
            height: 200px;
            overflow-x: hidden;
            overflow-y: scroll;
            scrollbar-base-color: #207adc !important;
            border: 1px solid #d0d0d0;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            padding: 10px;
            justify-content: center;
        }

        .form-check {
            margin-bottom: 15px;
        }

        .box-select::-webkit-scrollbar {
            width: 10px;
            background-color: #E3E5F0;
            -webkit-border-radius: 10px;
            -moz-border-radius: 10px;
            border-radius: 10px;
        }

        .box-select::-webkit-scrollbar-thumb {
            background-color: #207adc;
            -webkit-border-radius: 10px;
            -moz-border-radius: 10px;
            border-radius: 10px;
        }
    </style>

@endsection

@section('content')

    <main role="main">

        <div class="container">

            <div class="px-3 px-md-5 w-100">

                <div class="col-12 mb-3 title pl-0">
                    <h2>Plano de Aula</h2>
                </div>

                <div class="row mb-4">

                    <div class="col-sm-12 col-md-9 col-xl-9">
                        <form action="{{ route('gestao.plano-aulas.busca') }}" method="post" class="">
                            @csrf
                            <div class="form-search shadow-sm">
                                <input type="text" name="search" class="form-control py-2 width-100 shadow-sm border-0 px-3"
                                    placeholder="Digite o nome do curso que está procurando">
                                <button type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="col-sm-12 col-md-3 col-xl-3">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-primary w-100 text-truncate" data-toggle="modal"
                                    data-target="#divModalNovaBadge">
                                <i class="fas fa-plus fa-fw mr-2"></i>
                                PLANO DE AULA
                            </button>
                        </div>
                    </div>


                </div>



                <!-- <div class="col-sm-12 col-md-8 col-xl-9">
                    <div class="input-group input-group mb-4">
                        <input type="text" class="form-control py-2 width-100 shadow-sm border-0 px-3"
                            placeholder="Digite o nome do curso que está procurando"
                            aria-label="Recipient's username" aria-describedby="button-addon2">

                        <div class="input-group-append">
                            <button class="btn bg-primary border-0 text-light shadow-sm" type="button"
                                id="button-addon2"><i
                                    class="fas fa-search fa-lg fa-fw text-light"></i></button>
                        </div>
                    </div>
                </div> -->





                <div class="row">

                    <div class="col-lg-3 col-md-12 col-sm-12">

                        <div class="mb-3">
                            <button
                                class="btn btn-select w-100 rounded selectAno p-2 fs-1 {{ (Session::has('anos') ? 'btn-select-open' : '') }}"
                                type="button"
                                data-toggle="collapse"
                                data-target="#selectAno" aria-expanded="false" aria-controls="selectAno">
                                <span>ANO</span>
                                <span>
                                    <i class="{{ (Session::has('anos') ? 'fas fa-caret-up' : 'fas fa-caret-down') }}"
                                       id="icon-ano"></i>
                                </span>
                            </button>
                            <div class="collapse {{ (Session::has('anos') ? 'show' : '') }}" id="selectAno">
                                <div class="p-4 bg-white shadow-sm rounded">
                                    @foreach($anos as $ano)
                                        <div class="d-flex justify-content-start align-items-center mb-3">
                                            <div class="mr-3">
                                                <form action="{{ route('gestao.plano-aulas.filtrar') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="input-ano" value="{{ $ano->ano_serie }}">
                                                    @if(Session::has('anos'))
                                                        <input type="checkbox" class="input-check"
                                                               {{ (in_array($ano->ano_serie, Session::get('anos')) ? 'checked' : '' ) }}
                                                               value="{{ $ano->ano_serie }}"
                                                               onclick="this.form.submit();">
                                                    @else
                                                        <input type="checkbox" class="input-check"
                                                               value="{{ $ano->ano_serie }}"
                                                               onclick="this.form.submit();">
                                                    @endif
                                                </form>
                                            </div>
                                            <div class="mr-3 text-primary">{{ $ano->ano_serie }}</div>
                                            <div
                                                style="padding: 5px 10px; background-color: #E3E5F0; color: #999FB4; border-radius: 3px">
                                                {{ $ano->select('id')->where('ano_serie', $ano->ano_serie)->count() }}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <button
                                class="btn btn-select w-100 rounded selectDisciplina p-2 fs-1 {{ (Session::has('disciplina') ? 'btn-select-open' : '') }}"
                                type="button"
                                data-toggle="collapse"
                                data-target="#selectDisciplina" aria-expanded="false"
                                aria-controls="selectDisciplina">
                                <span>DISCIPLINA</span>
                                <span>
                                    <i class="{{ (Session::has('disciplina') ? 'fas fa-caret-up' : 'fas fa-caret-down') }}"
                                       id="icon-ano"></i>
                                </span>
                            </button>
                            <div class="collapse {{ (Session::has('disciplina') ? 'show' : '') }}"
                                 id="selectDisciplina">
                                <div class="p-4 bg-white shadow-sm rounded">
                                    @foreach($disciplinas as $disciplina)
                                        <div class="d-flex justify-content-start align-items-center mb-3">
                                            <div class="mr-3">
                                                <form action="{{ route('gestao.plano-aulas.filtrar') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="input-disciplina"
                                                           value="{{ $disciplina->materia }}">
                                                    @if(Session::has('disciplina'))
                                                        <input type="checkbox" class="input-check"
                                                               {{ (in_array($disciplina->materia, Session::get('disciplina')) ? 'checked' : '' ) }}
                                                               value="{{ $disciplina->materia }}"
                                                               onclick="this.form.submit();">
                                                    @else
                                                        <input type="checkbox" class="input-check"
                                                               value="{{ $disciplina->materia }}"
                                                               onclick="this.form.submit();">
                                                    @endif
                                                </form>
                                            </div>
                                            <div class="mr-3 text-primary">{{ $disciplina->materia }}</div>
                                            <div
                                                style="padding: 5px 10px; background-color: #E3E5F0; color: #999FB4; border-radius: 3px">
                                                {{ $disciplina->select('id')->where('materia', $disciplina->materia)->count() }}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="col-lg-9 col-mb-9 col-sm-12">

                        @forelse($planos as $plano)
                            <div class="w-100 shadow-sm bg-white rounded mb-4">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <img src="https://www.yayskool.com/images/school/509432school.jpg" width="100%">
                                    </div>

                                    <div class="col-lg-9 p-4">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <h5 class="font-weight-bold">{{ $plano->assunto }}</h5>
                                                <span style="color: #60748A;">{{ $plano->objetivos }}</span>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="d-lg-flex-row justify-content-center">
                                                    <div class="font-weight-bold text-muted text-right">
                                                        <p>{{ $plano->ano_serie }} <br>
                                                            {{ $plano->materia }}</p>
                                                    </div>
                                                    <div>
                                                        <button class="btn btn-link text-gray float-right p-2"
                                                                type="button"
                                                                data-toggle="dropdown"
                                                                aria-haspopup="true" aria-expanded="false">
                                                            <i class="fas fa-ellipsis-h"></i>
                                                        </button>
                                                        <div class="px-3">
                                                            <div class="dropdown-menu">
                                                                <button type="button" data-toggle="modal"
                                                                        class="btn btn-link dropdown-item text-warning editPlano"
                                                                        data-id="{{ $plano->id }}"
                                                                        data-target="#divModalAtualizaPlano_{{ $plano->id }}">
                                                                    <i class="fas fa-edit"></i>
                                                                    Editar plano de aula
                                                                </button>
                                                                <button type="button"
                                                                        onclick="excluirPlano({{ $plano->id }});"
                                                                        class="btn btn-link dropdown-item text-danger"
                                                                        href="#"><i
                                                                        class="fas fa-trash-alt"></i>
                                                                    Excluir plano de aula
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                    </div>
                                </div>

                                <!-- Modal atualiza badge -->
                                @include('pages.plano-aulas.admin._edit')

                                <form id="formExcluirPlano" action="{{ route('gestao.plano-aulas.excluir') }}"
                                      method="post">
                                    @csrf
                                    <input id="idPlano" name="idPlano" hidden>
                                </form>
                            </div>
                        @empty
                            <p class="text-secondary">Nenhum plano de aula cadastrado</p>
                        @endforelse

                        <div class="mt-5 d-flex justify-content-center">
                            {!! $planos->links() !!}
                        </div>

                    </div>


                </div>

                <!-- Modal novo plano de aula -->
                @include('pages.plano-aulas.admin._create')


            </div>
        </div>
    </main>

@endsection

@section('bodyend')

    <!-- datetimepicker bootstrap -->
    <script src="https://unpkg.com/gijgo@1.9.12/js/gijgo.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/gijgo@1.9.12/js/messages/messages.pt-br.js"
            type="text/javascript"></script>

    <script>

        // Ano filter dropbox
        $('.selectAno').click(function () {
            var css = $("div#selectAno").attr("class");
            if (css !== 'collapse show') {
                $(this).addClass('btn-select-open');
                $('i#icon-ano').removeClass('fas fa-caret-down').addClass('fas fa-caret-up');
            } else {
                $('i#icon-ano').removeClass('fas fa-caret-up').addClass('fas fa-caret-down');
                $(this).removeClass('btn-select-open');
            }
            /*$('.input-ano').click(function () {
                var value = $('.input-ano:checked').val();
                if (value !== undefined) {
                    $.ajax({
                        method: "POST",
                        url: 'plano-de-aulas/filtrar',
                        data: {value: value},
                        success: function (date) {
                            console.log(date);
                        }
                    });
                }
            })*/
        });

        $('.selectDisciplina').click(function () {
            var css = $("div#selectDisciplina").attr("class");

            if (css !== 'collapse show') {
                $(this).addClass('btn-select-open');
                $('i#icon-ano').removeClass('fas fa-caret-down').addClass('fas fa-caret-up');
            } else {
                $('i#icon-ano').removeClass('fas fa-caret-up').addClass('fas fa-caret-down');
                $(this).removeClass('btn-select-open');
            }
        });


        $("button.editPlano").on('click', function () {
            var idPlano = $(this).attr('data-id');
            var gradeAula = $("select.selectGradeAulasEdit_" + idPlano + " option:selected");
            if (gradeAula.attr('class') === '1') {
                var today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
                var idGrade = gradeAula.val();
                var daySelected = gradeAula.attr('id');
                var planoDate = gradeAula.attr('data-id');
                $.ajax({
                    method: 'get',
                    url: 'plano-de-aulas/getDates/' + idGrade,
                    success: function (date) {
                        $('.selectDataRecorrenteEdit').slideDown();
                        calendarEdit(daySelected, today, planoDate, date);
                    }
                });
            } else {
                $('.selectDataRecorrenteEdit').slideUp();
            }
        });


        $(".selectGradeAulas").on('change', function () {
            var idGrade = $(".selectGradeAulas option:selected").val();
            var recorrente = $(".selectGradeAulas option:selected").attr('class');
            var daySelected = $(".selectGradeAulas option:selected").attr('id');

            var today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
            if (recorrente === '1') {
                $.ajax({
                    method: 'get',
                    url: 'plano-de-aulas/getDates/' + idGrade,
                    success: function (date) {
                        $('.selectDataRecorrente').slideDown();
                        calendar(daySelected, today, date);
                    }
                });
            } else {
                $('.selectDataRecorrente').slideUp();
            }
        });

        function getDaysWeek(daySelected) {
            days = [0, 1, 2, 3, 4, 5, 6]; // days of week
            var removeItem = daySelected;
            return days = $.grep(days, function (value) {
                return value != removeItem;
            });
        }

        function calendar(daySelected, today, disabledDays) {
            $('.datepickerRecorrente').datepicker({
                locale: 'pt-br',
                format: 'dd-mm-yyyy',
                modal: true,
                minDate: today,
                disableDaysOfWeek: getDaysWeek(daySelected),
                //disableDates: ['20/03/2019', '27/03/2019'] // apenas formato dd/mm/yyyy
                disableDates: disabledDays
            });
        }

        function calendarEdit(daySelected, today, planoDate, disabledDays) {
            $('.datepickerRecorrenteEdit').datepicker({
                locale: 'pt-br',
                format: 'dd-mm-yyyy',
                modal: true,
                minDate: today,
                value: planoDate,
                disableDaysOfWeek: getDaysWeek(daySelected),
                disableDates: disabledDays
            });
        }


        function excluirPlano(id) {
            $("#formExcluirPlano #idPlano").val(id);

            swal({
                title: 'Excluir Plano de aula?',
                text: "Você deseja mesmo excluir este plano de aula?",
                icon: "warning",
                buttons: ['Não', 'Sim, excluir!'],
                dangerMode: true,
            }).then((result) => {
                if (result == true) {
                    $("#formExcluirPlano").submit();
                }
            });
        }
    </script>

@endsection
