@extends('layouts.master')

@section('title', 'J. PIAGET - Configurações de gamificação')

@section('content')

    <main role="main" class="">

        <div class="container">

            <div class="px-3 px-md-5 w-100">


                <div class="col-12 mb-3 title">

                    <div class="row">
                        <div class="col-auto mb-3 pl-0">
                            <h2 class="d-inline-block">
                                Configurações de gamificação
                            </h2>

                        </div>
                        <div class="col-auto mb-3 pl-0 ml-auto">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customCheck1">
                                <label class="custom-control-label font-weight-bold" for="customCheck1">Ativar gamificação</label>
                            </div>
                        </div>
                    </div>

                </div>

                <section class="row">

                    <div class="col-auto mb-3">

                        <div class="card py-4 px-5 rounded">

                            <form action="{{ route('gestao.gamificacao.store') }}" method="post">

                                @csrf

                                <div class="custom-control custom-checkbox mb-3">
                                    <input type="checkbox" class="custom-control-input" id="login_ativo" name="login_ativo" {{ $configuracoes_gamificacao->login_ativo === true ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="login_ativo">
                                        Cada login dá:
                                    </label>
                                    <div class="d-inline-block ml-2 align-middle">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="login_xp" name="login_xp" placeholder="" value="{{ $configuracoes_gamificacao->login_xp }}">
                                            <div class="input-group-append">
                                                <div class="input-group-text">pontos</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="custom-control custom-checkbox mb-3">
                                    <input type="checkbox" class="custom-control-input" id="conclusao_conteudo_ativo" name="conclusao_conteudo_ativo" {{ $configuracoes_gamificacao->conclusao_conteudo_ativo === true ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="conclusao_conteudo_ativo">
                                        Cada conclusão de conteúdo dá:
                                    </label>
                                    <div class="d-inline-block ml-2 align-middle">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="conclusao_conteudo_xp" name="conclusao_conteudo_xp" placeholder="" value="{{ $configuracoes_gamificacao->conclusao_conteudo_xp }}">
                                            <div class="input-group-append">
                                                <div class="input-group-text">pontos</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="custom-control custom-checkbox mb-3">
                                    <input type="checkbox" class="custom-control-input" id="conclusao_aula_ativo" name="conclusao_aula_ativo" {{ $configuracoes_gamificacao->conclusao_aula_ativo === true ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="conclusao_aula_ativo">
                                        Cada conclusão de aula dá:
                                    </label>
                                    <div class="d-inline-block ml-2 align-middle">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="conclusao_aula_xp" name="conclusao_aula_xp" placeholder="" value="{{ $configuracoes_gamificacao->conclusao_aula_xp }}">
                                            <div class="input-group-append">
                                                <div class="input-group-text">pontos</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="custom-control custom-checkbox mb-3">
                                    <input type="checkbox" class="custom-control-input" id="conclusao_curso_ativo" name="conclusao_curso_ativo" {{ $configuracoes_gamificacao->conclusao_curso_ativo === true ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="conclusao_curso_ativo">
                                        Cada conclusão de curso dá:
                                    </label>
                                    <div class="d-inline-block ml-2 align-middle">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="conclusao_curso_xp" name="conclusao_curso_xp" placeholder="" value="{{ $configuracoes_gamificacao->conclusao_curso_xp }}">
                                            <div class="input-group-append">
                                                <div class="input-group-text">pontos</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="custom-control custom-checkbox mb-3">
                                    <input type="checkbox" class="custom-control-input" id="conclusao_teste_ativo"  name="conclusao_teste_ativo" {{ $configuracoes_gamificacao->conclusao_teste_ativo === true ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="conclusao_teste_ativo">
                                        Cada conclusão de teste dá:
                                    </label>
                                    <div class="d-inline-block ml-2 align-middle">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="conclusao_teste_xp" name="conclusao_teste_xp" placeholder="" value="{{ $configuracoes_gamificacao->conclusao_teste_xp }}">
                                            <div class="input-group-append">
                                                <div class="input-group-text">pontos</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="custom-control custom-checkbox mb-3">
                                    <input type="checkbox" class="custom-control-input" id="topico_ativo" name="topico_ativo" {{ $configuracoes_gamificacao->topico_ativo === true ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="topico_ativo">
                                        Cada tópico iniciado ou dúvida criada dá:
                                    </label>
                                    <div class="d-inline-block ml-2 align-middle">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="topico_xp" name="topico_xp" placeholder="" value="{{ $configuracoes_gamificacao->topico_xp }}">
                                            <div class="input-group-append">
                                                <div class="input-group-text">pontos</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="custom-control custom-checkbox mb-3">
                                    <input type="checkbox" class="custom-control-input" id="comentario_ativo" name="comentario_ativo" {{ $configuracoes_gamificacao->comentario_ativo === true ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="comentario_ativo">
                                        Cada comentário realizado ou discussão iniciada dá:
                                    </label>
                                    <div class="d-inline-block ml-2 align-middle">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="comentario_xp" name="comentario_xp" placeholder="" value="{{ $configuracoes_gamificacao->comentario_xp }}">
                                            <div class="input-group-append">
                                                <div class="input-group-text">pontos</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="custom-control custom-checkbox mb-3">
                                    <input type="checkbox" class="custom-control-input" id="level_up_curso_ativo" name="level_up_curso_ativo" {{ $configuracoes_gamificacao->level_up_curso_ativo === true ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="level_up_curso_ativo">
                                        Progresso de nível a cada:
                                    </label>
                                    <div class="d-inline-block ml-2 align-middle">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="level_up_curso" name="level_up_curso" placeholder="" value="{{ $configuracoes_gamificacao->level_up_curso }}">
                                            <div class="input-group-append">
                                                <div class="input-group-text">cursos concluídos</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="custom-control custom-checkbox mb-3">
                                    <input type="checkbox" class="custom-control-input" id="level_up_conquista_ativo" name="level_up_conquista_ativo" {{ $configuracoes_gamificacao->level_up_conquista_ativo === true ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="level_up_conquista_ativo">
                                        Progresso de nível a cada:
                                    </label>
                                    <div class="d-inline-block ml-2 align-middle">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="level_up_conquista" name="level_up_conquista" placeholder="" value="{{ $configuracoes_gamificacao->level_up_conquista }}">
                                            <div class="input-group-append">
                                                <div class="input-group-text">conquistas desbloqueadas</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="custom-control custom-checkbox mb-3">
                                    <input type="checkbox" class="custom-control-input" id="formula_level_ativo" name="formula_level_ativo" {{ $configuracoes_gamificacao->formula_level_ativo === true ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="formula_level_ativo">
                                        Fórmula de level:
                                    </label>
                                    <input type="text" class="form-control d-inline-block ml-2 w-auto" id="formula_level" name="formula_level" placeholder="" value="{{ $configuracoes_gamificacao->formula_level }}">
                                </div>

                                <div class="mt-4 row">
                                    <button id="btnSalvarConfiguracoes" type="submit" class="btn btn-primary mb-3 px-4">
                                        Salvar
                                    </button>

                                    <button type="button" class="btn btn-danger mb-3 ml-auto mr-2 px-4" hidden>
                                        Redefinir para configurações padrão
                                    </button>

                                    <button type="button" class="btn btn-danger mb-3 px-4" hidden>
                                        Cancelar
                                    </button>
                                </div>

                            </form>

                        </div>

                    </div>

                </section>

            </div>

        </div>

    </main>

@endsection
