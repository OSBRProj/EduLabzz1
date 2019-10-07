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


    </style>

@endsection

@section('content')

    <main role="main" class="">

        <div class="container">

            <div class="row">

                <div class="col-12 col-md-11 mx-auto">

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0 pb-3 mb-3 bg-transparent border-bottom">
                            <li class="breadcrumb-item active" aria-current="page">
                                <a href="{{ route('gestao.teste.listar') }}" >
                                    <i class="fas fa-chevron-left mr-2"></i>
                                    <span>Teste de nivelamento</span>
                                </a>
                            </li>
                            <li class="breadcrumb-item active text-truncate" aria-current="page">{{ $teste->titulo }} </li>
                        </ol>
                    </nav>

                    <div class="col-12 title pl-0 border-0">
                        <h2>Editar teste: {{ $teste->titulo }}</h2>
                    </div>

                    <div class="card shadow-sm">
                        <div class="card-body p-md-3 p-lg-5">
                            <form action="{{ route('gestao.teste.atualizar', $teste->id) }}" method="post">
                                @csrf

                                <div class="form-group">
                                    <div class="d-flex justify-content-end">
                                        <label for="tempo" class="text-center"><i class="far fa-hourglass"></i> Tempo para responder <br> <small>(tempo em
                                            minutos) </small></label>
                                        <input type="text" name="tempo" class="col-lg-2 ml-2 form-control tempoMinutos"
                                            placeholder="000" value="{{ $teste->tempo }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="titulo" class="font-weight-bold">Título do teste:</label>
                                    <input type="text" name="titulo" value="{{ $teste->titulo }}" class="form-control"
                                        placeholder="Título"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label for="descricao" class="font-weight-bold">Descrição:</label>
                                    <textarea name="descricao" class="form-control" rows="5"
                                            placeholder="Descrição">{{ $teste->descricao }}</textarea>
                                </div>

                                <div class="form-group">
                                    <div class="d-flex justify-content-between mb-3">
                                        <label for="questoes" class="font-weight-bold">Banco de questões:</label>
                                        <button type="button" class="btn btn-primary addNewQuestao">
                                            <i class="fas fa-plus"></i> Criar nova questão
                                        </button>
                                    </div>
                                    <div class="alert-success p-2 mb-3 text-center msg-new-questao" style="display: none;">
                                        <i class="fas fa-check"></i> Questão adicionada com sucesso!
                                    </div>


                                    <div class="jumbotron p-4">
                                        <div class="msg-error-quest" style="display: none">
                                            <div class="form-group">
                                                <div class="p-3 alert-warning text-center msg-error-quest-inline"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-10">
                                                <select class="form-control selectQuestoes"
                                                        data-live-search="true"
                                                        required>
                                                </select>
                                            </div>
                                            <div class="col-lg-2">
                                                <button type="button" class="btn btn-success btnAddQuestao w-100">Adicionar
                                                </button>
                                            </div>
                                        </div>

                                        <ul class="innerListQuestoes list-group"></ul>
                                        <div class="innerQuestoesExcluidas"></div>
                                        <ul class="list-group">
                                            @foreach($teste->questoes as $questao)
                                                <li class="list-group-item countQuest mt-3 questao_edit_{{$questao->id}}">
                                                    <div class="row">
                                                        <div class="col-lg-4">{{ $questao->questao->titulo }}</div>
                                                        <div class="col-lg-7">
                                                            <input type="text"
                                                                class="ml-2 form-control {{ $questao->questao->id }}"
                                                                required
                                                                value="{{ $questao->peso }}"
                                                                name="peso[{{$questao->id}}]"
                                                                placeholder="peso da questão">
                                                        </div>
                                                        <div class="col-lg-1">
                                                            <button type="button" id="{{ $questao->id }}"
                                                                    class="btn btn-sm btn-danger btnRemoveQuestaoEdit">X
                                                            </button>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>

                                    </div>


                                </div>

                                <div class="form-group">

                                    <label for="" class="font-weight-bold">Direcionamento</label> <br>
                                    <button type="button" class="btn btn-primary addDirecionamento"><i
                                            class="fas fa-redo-alt"></i>
                                        Adicionar direcionamento
                                    </button>

                                </div>


                                <div class="innerDirecionamentos"></div>

                                <div class="innerDirecExcluidos"></div>

                                @forelse($teste->direcionamentos as $direc)
                                    <div class="form-group direc_edit_{{ $direc->id }}">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <select name="regra[{{$direc->id}}]" class="form-control">
                                                    <option value="<" {{ ($direc->regra === "<" ? "selected" : "") }}>
                                                        Menor que
                                                    </option>
                                                    <option value=">" {{ ($direc->regra === ">" ? "selected" : "") }}>
                                                        Maior que
                                                    </option>
                                                    <option value="==" {{ ($direc->regra === "==" ? "selected" : "") }}>
                                                        Igual a
                                                    </option>
                                                    <option value="<=" {{ ($direc->regra === "<=" ? "selected" : "") }}>
                                                        Menor ou igual a
                                                    </option>
                                                    <option value=">=" {{ ($direc->regra === ">=" ? "selected" : "") }}>
                                                        Maior ou igual a
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="col-lg-2">
                                                <input type="text" name="pontuacao[{{ $direc->id }}]"
                                                    value="{{ $direc->pontuacao }}"
                                                    class="form-control" placeholder="00" required>
                                            </div>
                                            <div class="col-lg-5">
                                                <input type="text" name="direcionamento[{{ $direc->id }}]"
                                                    value="{{ $direc->direcionamento }}"
                                                    class="form-control"
                                                    placeholder="Direcionamento">
                                            </div>
                                            <div class="col-lg-1">
                                                <button type="button" id="{{ $direc->id }}"
                                                        class="btn btn-sm btn-danger btnRemoveDirecEdit">X
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                @endforelse


                                <div class="d-flex justify-content-center text-center">
                                    <button type="submit"
                                            class="btn btn-primary mt-4 mb-0 col-4 ml-4 font-weight-bold">
                                        Atualizar teste
                                    </button>
                                </div>


                            </form>
                        </div>
                    </div>

                </div>


            </div>

        </div>

    </main>
    @include('pages.questoes.admin._create_ajax')
    @include('pages.teste.admin._direcionamento')
@endsection

@section('bodyend')

    <script>
        $('.tempoMinutos').mask('000');
        $('.pontuacao').mask('00');

        function loadQuestoes() {
            $.get('{{ env("APP_LOCAL") }}/gestao/banco-de-questoes/ajax/', function (questao) {
                $.each(questao, function (index, quest) {
                    $('.selectQuestoes').append('<option value="' + quest.id + '" class="questaoOpt_' + quest.id + '" name="' + quest.titulo + '">' + quest.titulo + '</option>');
                });
            });
        }

        loadQuestoes();

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
                $('.innerListQuestoes').append('<li class="list-group-item countQuest mt-3 questao_' + questaoId + '">\n' +
                    '                                    <div class="row">\n' +
                    '                                        <div class="col-lg-4">' + questaoTitulo + '</div>\n' +
                    '                                        <div class="col-lg-7">\n' +
                    '                                            <input type="text" class="ml-2 form-control ' + questaoId + '" required\n' +
                    '                                                   name="peso_new[' + questaoId + ']" placeholder="peso da questão">\n' +
                    '                                        </div>\n' +
                    '                                        <div class="col-lg-1">\n' +
                    '                                            <button type="button" class="btn btn-sm btn-danger btnRemoveQuestao" id="' + questaoId + '">X</button>\n' +
                    '                                        </div>\n' +
                    '                                    </div>\n' +
                    '                                </li>'
                );
            }

        });
        $('.innerListQuestoes').on('click', '.btnRemoveQuestao', function () {
            var count = $('li.countQuest').length;
            if (count <= 1) {
                $('.msg-error-quest').fadeIn();
                $('.msg-error-quest-inline').html('Pelo menos 1 questão é obrigatória');
                setTimeout(function () {
                    $('.msg-error-quest').fadeOut(500)
                }, 1500);
            } else {
                var id = $(this).attr('id');
                $('li.questao_' + id).remove();
            }
        });

        $('.btnRemoveQuestaoEdit').on('click', function () {
            var count = $('li.countQuest').length;
            if (count <= 1) {
                $('.msg-error-quest').fadeIn();
                $('.msg-error-quest-inline').html('Pelo menos 1 questão é obrigatória');
                setTimeout(function () {
                    $('.msg-error-quest').fadeOut(500)
                }, 1500);
            } else {
                var id = $(this).attr('id');
                $('.innerQuestoesExcluidas').append('<input type="hidden" name="questoesExcluidas[]" value="' + id + '">');
                $('li.questao_edit_' + id).remove();
            }
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
                        '                                    <select name="regra_new[]" class="form-control">\n' +
                        '                                        <option value="<" ' + (regra === "<" ? "selected" : "") + '>Menor que</option>\n' +
                        '                                        <option value=">" ' + (regra === ">" ? "selected" : "") + '>Maior que</option>\n' +
                        '                                        <option value="==" ' + (regra === "==" ? "selected" : "") + '>Igual a</option>\n' +
                        '                                        <option value="<=" ' + (regra === "<=" ? "selected" : "") + '>Menor ou igual a</option>\n' +
                        '                                        <option value=">=" ' + (regra === ">=" ? "selected" : "") + '>Maior ou igual a</option>\n' +
                        '                                    </select>\n' +
                        '\n' +
                        '                                </div>\n' +
                        '                                <div class="col-lg-2">\n' +
                        '                                    <input type="text" name="pontuacao_new[]" value="' + pontuacao + '" class="form-control"\n' +
                        '                                           placeholder="00">\n' +
                        '                                </div>\n' +
                        '                                <div class="col-lg-5">\n' +
                        '                                    <input type="text" name="direcionamento_new[]" value="' + direcionamento + '" \n' +
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

        $('.btnRemoveDirecEdit').on('click', function () {
            var id = $(this).attr('id');
            $('.innerDirecExcluidos').append('<input type="hidden" name="direcExcluidos[]" value="' + id + '">');
            $('div.direc_edit_' + id).remove();
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
