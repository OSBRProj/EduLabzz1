@extends('layouts.master')

@section('title', 'J. PIAGET - Teste de nivelamento')

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

        .card {
            min-height: 120px;
            margin-bottom: 20px;
        }

        .btnAdd {
            font-size: 0.9rem;
            color: #999FB4;
        }

        .modal {
            overflow-y: auto !important;
        }

    </style>

@endsection

@section('content')

    <main role="main">

        <div class="container">

            <div class="row">

                <div class="col-12 col-md-11 mx-auto">

                    <div class="col-12 title pl-0">
                        <h2>Teste de nivelamento</h2>
                    </div>

                    <div class="row my-3">
                        <div class="col-auto text-center text-md-right mb-3 mb-md-0">
                            <button type="button" class="btn btn-primary text-white font-weight-normal" data-toggle="modal"
                                    data-target="#divModalNovoTeste">
                                <i class="fas fa-plus fa-fw mr-2"></i>
                                Novo teste
                            </button>
                        </div>
                    </div>

                    <section class="row">
                        @forelse($testes as $teste)
                            <div class="col-lg-12">
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <button class="btn btn-link text-gray float-right p-2" type="button"
                                                data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <div class="px-3">
                                            <div class="dropdown-menu">
                                                {{-- <button type="button" data-toggle="modal"
                                                        class="btn btn-link dropdown-item text-warning"
                                                        data-target="#divModalAtualizaTeste_{{$teste->id}}">
                                                    <i class="fas fa-edit"></i>
                                                    Editar teste
                                                </button>--}}
                                                <a href="{{ route('gestao.teste.editar', $teste->id) }}"
                                                class="btn btn-link dropdown-item text-warning">
                                                    <i class="fas fa-edit"></i>
                                                    Editar teste
                                                </a>
                                                <button type="button" onclick="excluirTeste({{ $teste->id }});"
                                                        class="btn btn-link dropdown-item text-danger" href="#"><i
                                                        class="fas fa-trash-alt"></i>
                                                    Excluir teste
                                                </button>
                                                <a href="{{ route('gestao.teste.resultados', $teste->id) }}"
                                                class="btn btn-link dropdown-item text-primary">
                                                    <i class="fas fa-bars"></i>
                                                    Visualizar resultados
                                                </a>
                                            </div>

                                        </div>


                                        <h4>{{ $teste->titulo }}</h4>
                                        <small> {{ $teste->descricao }}</small>

                                    </div>
                                </div>
                            </div>
                            <!-- Modal atualiza teste -->
                            @include('pages.teste.admin._edit')

                        @empty
                            <p class="text-dark">Nenhum teste cadastrado</p>
                        @endforelse
                    </section>

                    <form id="formExcluirTeste" action="{{ route('gestao.teste.excluir') }}"
                        method="post">@csrf
                        <input id="idTeste" name="idTeste" hidden>
                    </form>


                </div>


            </div>

            <!-- Modal novo teste -->
            @include('pages.teste.admin._create')


        </div>

    </main>

@endsection

@section('bodyend')

    <script>

        $(document).ready(function () {

            $('.tempoMinutos').mask('000');
            $('.pontuacao').mask('00');

            loadQuestoes();

            $('.selectQuestoes').on('change', function () {
                var questaoId = $(this).val();
                $('.selectQuestoes option:selected').val(questaoId);
            });

            // adiciona questão relacionado ao teste
            $('.btnAddQuestao').on('click', function () {
                var questaoId = $('.selectQuestoes').val();
                var questaoTitulo = $('.questaoOpt_' + questaoId).attr('name');

                var countQuestao = $('.countQuest').find('input.' + questaoId).length;
                if (countQuestao >= 1) {
                    $('.msg-error-quest').fadeIn();
                    $('.msg-error-quest-inline').html('Questão já adicionada!');
                    setTimeout(function () {
                        $('.msg-error-quest').fadeOut(500)
                    }, 1500);
                } else {
                    addQuestoesInn(questaoId, questaoTitulo);
                }

            });


            $('.innerListQuestoes').on('click', '.btnRemoveQuestao', function () {
                var id = $(this).attr('id');
                $('li.questao_' + id).remove();
            });

            // Abre modal para cadastrar nova questão
            $('.addNewQuestao').on('click', function () {
                $('#divModalNovaQuestaoAjax').modal('show');
                $('#divModalNovoTeste').modal('hide');
                $('.closeQuestao').click(function () {
                    $('#divModalNovoTeste').modal('show');
                })
            });


            // Abre modal para adicionar redirecionamentos
            $('.addDirecionamento').on('click', function () {
                $('#divModalDirecionamento').modal('show');
                $('#divModalNovoTeste').modal('hide');
                $('.closeDirecionamento').click(function () {
                    $('#divModalNovoTeste').modal('show');
                });

                // adiciona redirecionamentos
                $('.btnAddDirecionamento').on('click', function () {
                    var regra = $('select.regra').val();
                    var pontuacao = $('input.pontuacao').val();
                    var direcionamento = $('input.direcionamento').val();
                    if (pontuacao === '' || direcionamento === '') {
                        $('.msg-error').fadeIn();
                        $('.mgs-error-inline').html('Todos os campos são obrigatórios');
                        setTimeout(function () {
                            $('.msg-error').fadeOut(500)
                        }, 1500);
                    } else {
                        $('.msg-add-direcionamento').fadeIn();
                        setTimeout(function () {
                            $('.msg-add-direcionamento').fadeOut(500)
                        }, 1500);

                        var idDirec = Math.round(new Date().getTime());

                        $('.innerDirecionamentos').append('<div class="form-group newGroupDirec_' + idDirec + '">\n' +
                            '                            <div class="row">\n' +
                            '                                <div class="col-lg-4">\n' +
                            '\n' +
                            '                                    <select name="regra[]" class="form-control">\n' +
                            '                                        <option value="<" ' + (regra === "<" ? "selected" : "") + '>Menor que</option>\n' +
                            '                                        <option value=">" ' + (regra === ">" ? "selected" : "") + '>Maior que</option>\n' +
                            '                                        <option value="==" ' + (regra === "==" ? "selected" : "") + '>Igual a</option>\n' +
                            '                                        <option value="<=" ' + (regra === "<=" ? "selected" : "") + '>Menor ou igual a</option>\n' +
                            '                                        <option value=">=" ' + (regra === ">=" ? "selected" : "") + '>Maior ou igual a</option>\n' +
                            '                                    </select>\n' +
                            '\n' +
                            '                                </div>\n' +
                            '                                <div class="col-lg-2">\n' +
                            '                                    <input type="text" name="pontuacao[]" value="' + pontuacao + '" class="form-control"\n' +
                            '                                           placeholder="00">\n' +
                            '                                </div>\n' +
                            '                                <div class="col-lg-5">\n' +
                            '                                    <input type="text" name="direcionamento[]" value="' + direcionamento + '" \n' +
                            '                                           class="form-control"\n' +
                            '                                           placeholder="Direcionamento">\n' +
                            '                                </div>\n' +
                            '                                <div class="col-lg-1">\n' +
                            '                                    <button type="button" class="ml-2 btn btn-sm btn-danger removeDirec"\n' +
                            '                                            id="' + idDirec + ' "><i class="fas fa-times"></i></button>\n' +
                            '                                </div>\n' +
                            '\n' +
                            '                            </div>\n' +
                            '                        </div>');

                        $('input.pontuacao').val('');
                        $('input.direcionamento').val('');
                    }
                })
            });

            // remove redirecionamentos
            $('.innerDirecionamentos').on('click', '.removeDirec', function () {
                let idDirecRemove = $(this).attr('id');
                $('.newGroupDirec_' + idDirecRemove).remove();
            });

            // inputs para multipla escolha
            $('.selectTipo').on('change', function () {
                let tipo = $(this).val();
                if (tipo == 2) {
                    $('.innerAlternativas').slideDown();
                } else {
                    $('.innerAlternativas').slideUp();
                }
            });

            // adiciona nova opção de alternativas
            $('.btnAdd').click(function () {
                let count = parseInt($(this).attr('id'));
                let sum = count + 1;
                $(this).attr('id', sum);

                $('.showNewInput').append(
                    '<div class="input-group mb-2 groupNewInput_' + sum + '">\n' +
                    '    <div class="input-group-prepend">\n' +
                    '        <div class="input-group-text">\n' +
                    '            <input type="radio" name="alternativa_correta" value="' + sum + '">\n' +
                    '            <span class="ml-2 text-secondary">Alternativa ' + sum + ':</span>\n' +
                    '        </div>\n' +
                    '    </div>\n' +
                    '    <input type="text" class="form-control" name="' + sum + '"\n' +
                    '    placeholder="Digite aqui a alternativa ' + sum + '">\n' +
                    '    <button type="button" class="ml-2 btn btn-sm btn-danger removeInput" id="' + sum + '"><i class="fas fa-times"></i></button>' +
                    '</div>');
            });


            // remove input extra
            $('.showNewInput , .innerAlternativasEdit').on('click', '.removeInput', function () {
                let id = $(this).attr('id');
                $('.groupNewInput_' + id).remove();
            });


            // cadastra nova questão
            $('form.form-add-questao').on('submit', function (e) {
                e.preventDefault(e);
                $.ajax({
                    type: 'post',
                    url: '{{ route("gestao.questoes.cadastrar.ajax") }}',
                    data: $(this).serialize(),
                    success: function (data) {
                        $('.selectQuestoes').children('option').remove();
                        loadQuestoes();
                        // $('.selectpicker').selectpicker('refresh');
                        $('form.form-add-questao')[0].reset();
                        $('#divModalNovaQuestaoAjax').modal('hide');
                        $('#divModalNovoTeste').modal('show');
                        $('.msg-new-questao').fadeIn();
                        setTimeout(function () {
                            $('.msg-new-questao').fadeOut(500)
                        }, 1500);
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            });

        });


        function loadQuestoes() {
            $.get('{{ env("APP_LOCAL") }}/gestao/banco-de-questoes/ajax/', function (questao) {

                console.log(questao);

                questao.forEach( function (quest, index, array) {

                    $('.selectQuestoes').append('<option value="' + quest.id + '" class="questaoOpt_' + quest.id + '" name="' + quest.titulo + '">' + quest.titulo + '</option>');

                });

                {{-- $.each(questao, function (index, quest) {
                    $('.selectQuestoes').append('<option value="' + quest.id + '" class="questaoOpt_' + quest.id + '" name="' + quest.titulo + '">' + quest.titulo + '</option>');
                }); --}}
            });
        }

        function addQuestoesInn(questaoId, questaoTitulo) {
            $('.innerListQuestoes').append('<li class="list-group-item countQuest mt-3 questao_' + questaoId + '">\n' +
                '                                    <div class="row">\n' +
                '                                        <div class="col-lg-4">' + questaoTitulo + '</div>\n' +
                '                                        <div class="col-lg-7">\n' +
                '                                            <input type="text" class="ml-2 form-control ' + questaoId + '" required\n' +
                '                                                   name="peso[' + questaoId + ']" placeholder="peso da questão">\n' +
                '                                        </div>\n' +
                '                                        <div class="col-lg-1">\n' +
                '                                            <button type="button" class="btn btn-sm btn-danger btnRemoveQuestao" id="' + questaoId + '">X</button>\n' +
                '                                        </div>\n' +
                '                                    </div>\n' +
                '                                </li>'
            );
        }






        function excluirTeste(id) {
            $("#formExcluirTeste #idTeste").val(id);

            swal({
                title: 'Excluir teste?',
                text: "Você deseja mesmo excluir este teste?",
                icon: "warning",
                buttons: ['Não', 'Sim, excluir!'],
                dangerMode: true,
            }).then((result) => {
                if (result == true) {
                    $("#formExcluirTeste").submit();
                }
            });
        }
    </script>

@endsection
