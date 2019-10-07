@extends('layouts.master')

@section('title', 'J. PIAGET - Banco de questões')

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

    </style>

@endsection

@section('content')

    <main role="main">

        <div class="container">

            <div class="row">

                <div class="col-12 col-md-11 mx-auto">

                    <div class="col-12 title pl-0">
                        <h2>Banco de questões</h2>
                    </div>

                    <div class="row my-3">
                        <div class="col-auto text-center text-md-right mb-3 mb-md-0">
                            <button type="button" class="btn btn-primary text-white font-weight-normal" data-toggle="modal"
                                    data-target="#divModalNovaQuestao">
                                <i class="fas fa-plus fa-fw mr-2"></i>
                                Nova questão
                            </button>
                        </div>
                    </div>

                    <section class="row">
                        @forelse($questoes as $questao)
                            <div class="col-lg-12">
                                <div class="card  shadow-sm">
                                    <div class="card-body rounded">
                                        <button class="btn btn-link text-gray float-right p-2" type="button"
                                                data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <div class="px-3">
                                            <div class="dropdown-menu">
                                                <button type="button" data-toggle="modal"
                                                        class="btn btn-link dropdown-item text-warning"
                                                        data-target="#divModalAtualizaQuestao_{{$questao->id}}">
                                                    <i class="fas fa-edit"></i>
                                                    Editar questão
                                                </button>
                                                <button type="button" onclick="excluirQuestao({{ $questao->id }});"
                                                        class="btn btn-link dropdown-item text-danger" href="#"><i
                                                        class="fas fa-trash-alt"></i>
                                                    Excluir questão
                                                </button>
                                            </div>

                                        </div>


                                        <h4>{{ $questao->titulo }}</h4>
                                        <small> {{ $questao->descricao }}</small>

                                    </div>
                                </div>
                            </div>
                            <!-- Modal atualiza questão -->
                            @include('pages.questoes.admin._edit')

                        @empty
                            <p class="text-dark">Nenhuma questão cadastrada</p>
                        @endforelse
                    </section>

                    <form id="formExcluirQuestao" action="{{ route('gestao.questoes.excluir') }}"
                        method="post">@csrf
                        <input id="idQuestao" name="idQuestao" hidden>
                    </form>

                </div>

            </div>

            <!-- Modal nova questao -->
            @include('pages.questoes.admin._create')

        </div>

    </main>

@endsection

@section('bodyend')

    <script>


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


        function excluirQuestao(id) {
            $("#formExcluirQuestao #idQuestao").val(id);

            swal({
                title: 'Excluir questão?',
                text: "Você deseja mesmo excluir esta questão?",
                icon: "warning",
                buttons: ['Não', 'Sim, excluir!'],
                dangerMode: true,
            }).then((result) => {
                if (result == true) {
                    $("#formExcluirQuestao").submit();
                }
            });
        }
    </script>

@endsection
