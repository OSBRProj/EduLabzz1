@extends('layouts.master')

@section('headend')

    <style>

        .sidebar.gestao-sidebar:not(.show) + main {
            padding-left: 232px;
        }

        .sidebar.show + main {
            padding-left: 464px;
        }

    </style>

@endsection

@section('content')
    <main id="main" class="bg-white" style="overflow: hidden">

        <div class="container">

            <div class="row">

                <div class="col-12 col-md-11 mx-auto">

                    <div class="pb-4">
                        <h3 class="text-dark">Documentação</h3>

                        <!-- desbloquear badge admin -->
                        <h5 class="text-secondary mt-5">Badges</h5>
                        <section id="badge_get_admin">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="pt-4 pb-4">
                                        <div class="text-secondary"><span class="text-success mr-2">GET</span> Desbloquear Badge

                                            <i class="fas fa-lock" data-toggle="tooltip" data-placement="bottom"
                                            title="Esta requisição requer autenticação e permissão de administrador"></i>
                                        </div>
                                        <div class="box-code-input">
                                            {{ env("APP_URL") }}/api/jpiaget/badges/usuario/{idUsuario}/{idBadge}/desbloquear
                                        </div>

                                        <div class="mt-4 text-secondary">
                                            <h6>Headers</h6>
                                            <table class="table table-striped table-bordered">
                                                <tbody>
                                                <tr>
                                                    <td class="font-weight-bold">withCredentials</td>
                                                    <td>true</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Content-Type</td>
                                                    <td>application/json</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>


                                        <div class="mt-4 text-secondary">
                                            <h6>Parameters
                                                <small>URL</small>
                                            </h6>
                                            <table class="table table-striped table-bordered">
                                                <tbody>
                                                <tr>
                                                    <td class="font-weight-bold">idUsuario</td>
                                                    <td>1</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">idBadge</td>
                                                    <td>19</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-lg-6 row code-api">
                                    <small class="text-white-50">Example response</small>
                                    <section class="code-api-content">
                                        { <br>
                                        "success": "Medalha desbloqueada com sucesso!" <br>
                                        }
                                    </section>
                                </div>
                            </div>
                        </section>

                        <!-- desbloquear badge user -->
                        <section id="badge_get_user">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="pt-4 pb-4">


                                        <div class="text-secondary"><span class="text-success mr-2">GET</span> Desbloquear Badge
                                        </div>
                                        <div class="box-code-input">
                                            {{ env("APP_URL") }}/api/jpiaget/badges/{idBadge}/desbloquear
                                        </div>

                                        <div class="mt-4 text-secondary">
                                            <h6>Headers</h6>
                                            <table class="table table-striped table-bordered">
                                                <tbody>
                                                <tr>
                                                    <td class="font-weight-bold">withCredentials</td>
                                                    <td>true</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Content-Type</td>
                                                    <td>application/json</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>


                                        <div class="mt-4 text-secondary">
                                            <h6>Parameters
                                                <small>URL</small>
                                            </h6>
                                            <table class="table table-striped table-bordered">
                                                <tbody>
                                                <tr>
                                                    <td class="font-weight-bold">idBadge</td>
                                                    <td>19</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>


                                    </div>
                                </div>
                                <div class="col-lg-6 row code-api">
                                    <small class="text-white-50">Example response</small>
                                    <section class="code-api-content">
                                        { <br>
                                        "success": "Medalha desbloqueada com sucesso!" <br>
                                        }
                                    </section>
                                </div>
                            </div>
                        </section>


                        <h5 class="text-secondary mt-5">Métricas</h5>
                        <section id="metricas_add">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="pt-4 pb-4">
                                        <div class="text-secondary"><span class="text-warning mr-2">POST</span> Adicionar métrica

                                            <i class="fas fa-lock" data-toggle="tooltip" data-placement="bottom"
                                            title="Esta requisição requer autenticação e permissão de administrador"></i>
                                        </div>
                                        <div class="box-code-input">
                                            {{ env("APP_URL") }}/api/jpiaget/metricas/nova
                                        </div>

                                        <div class="mt-4 text-secondary">
                                            <h6>Headers</h6>
                                            <table class="table table-striped table-bordered">
                                                <tbody>
                                                <tr>
                                                    <td class="font-weight-bold">withCredentials</td>
                                                    <td>true</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Content-Type</td>
                                                    <td>application/json</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>


                                        <div class="mt-4 text-secondary">
                                            <h6>Body
                                                <small>Formdata</small>
                                            </h6>
                                            <table class="table table-striped table-bordered">
                                                <tbody>
                                                <tr>
                                                    <td class="font-weight-bold">titulo</td>
                                                    <td>Título da métrica</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">descricao</td>
                                                    <td>Descrição da métrica</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-lg-6 row code-api">
                                    <small class="text-white-50">Example response</small>
                                    <section class="code-api-content">
                                        { <br>
                                        "success": "Métrica cadastrada com sucesso!" <br>
                                        }
                                    </section>
                                </div>
                            </div>
                        </section>


                        <h5 class="text-secondary mt-5">Habilidades</h5>
                        <section id="habilidades_add_admin">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="pt-4 pb-4">


                                        <div class="text-secondary"><span class="text-warning mr-2">POST</span> Adicionar
                                            Habilidades
                                            <i class="fas fa-lock" data-toggle="tooltip" data-placement="bottom"
                                            title="Esta requisição requer autenticação e permissão de administrador"></i>
                                        </div>
                                        <div class="box-code-input">
                                            {{ env("APP_URL") }}/api/jpiaget/habilidades/usuario/{idUsuario}/{idHabilidade}
                                        </div>

                                        <div class="mt-4 text-secondary">
                                            <h6>Headers</h6>
                                            <table class="table table-striped table-bordered">
                                                <tbody>
                                                <tr>
                                                    <td class="font-weight-bold">withCredentials</td>
                                                    <td>true</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Content-Type</td>
                                                    <td>application/json</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>


                                        <div class="mt-4 text-secondary">
                                            <h6>Parameters
                                                <small>URL</small>
                                            </h6>
                                            <table class="table table-striped table-bordered">
                                                <tbody>
                                                <tr>
                                                    <td class="font-weight-bold">idUsuario</td>
                                                    <td>1</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">idHabilidade</td>
                                                    <td>2</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="mt-4 text-secondary">
                                            <h6>Body
                                                <small>Formdata</small>
                                            </h6>
                                            <table class="table table-striped table-bordered">
                                                <tbody>
                                                <tr>
                                                    <td class="font-weight-bold">pontos</td>
                                                    <td>10</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>


                                    </div>
                                </div>
                                <div class="col-lg-6 row code-api">
                                    <small class="text-white-50">Example response</small>
                                    <section class="code-api-content">
                                        { <br>
                                        "success": "Habilidade adicionada com sucesso!" <br>
                                        }
                                    </section>
                                </div>
                            </div>
                        </section>


                        <section id="habilidades_add">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="pt-4 pb-4">


                                        <div class="text-secondary"><span class="text-warning mr-2">POST</span> Adicionar
                                            Habilidades
                                        </div>
                                        <div class="box-code-input">
                                            {{ env("APP_URL") }}/api/jpiaget/habilidades/{idHabilidade}
                                        </div>

                                        <div class="mt-4 text-secondary">
                                            <h6>Headers</h6>
                                            <table class="table table-striped table-bordered">
                                                <tbody>
                                                <tr>
                                                    <td class="font-weight-bold">withCredentials</td>
                                                    <td>true</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Content-Type</td>
                                                    <td>application/json</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>


                                        <div class="mt-4 text-secondary">
                                            <h6>Parameters
                                                <small>URL</small>
                                            </h6>
                                            <table class="table table-striped table-bordered">
                                                <tbody>
                                                <tr>
                                                    <td class="font-weight-bold">idHabilidade</td>
                                                    <td>2</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="mt-4 text-secondary">
                                            <h6>Body
                                                <small>Formdata</small>
                                            </h6>
                                            <table class="table table-striped table-bordered">
                                                <tbody>
                                                <tr>
                                                    <td class="font-weight-bold">pontos</td>
                                                    <td>10</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>


                                    </div>
                                </div>
                                <div class="col-lg-6 row code-api">
                                    <small class="text-white-50">Example response</small>
                                    <section class="code-api-content">
                                        { <br>
                                        "success": "Habilidade adicionada com sucesso!" <br>
                                        }
                                    </section>
                                </div>
                            </div>
                        </section>


                        <h5 class="text-secondary mt-5">Gamificação</h5>
                        <section id="gamificacao_inc_admin">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="pt-4 pb-4">


                                        <div class="text-secondary"><span class="text-warning mr-2">POST</span> Incrementar
                                            XP
                                            <i class="fas fa-lock" data-toggle="tooltip" data-placement="bottom"
                                            title="Esta requisição requer autenticação e permissão de administrador"></i>
                                        </div>
                                        <div class="box-code-input">
                                            {{ env("APP_URL") }}/api/jpiaget/gamificacao/usuario/{idUsuario}/incrementar
                                        </div>

                                        <div class="mt-4 text-secondary">
                                            <h6>Headers</h6>
                                            <table class="table table-striped table-bordered">
                                                <tbody>
                                                <tr>
                                                    <td class="font-weight-bold">withCredentials</td>
                                                    <td>true</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Content-Type</td>
                                                    <td>application/json</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>


                                        <div class="mt-4 text-secondary">
                                            <h6>Parameters
                                                <small>URL</small>
                                            </h6>
                                            <table class="table table-striped table-bordered">
                                                <tbody>
                                                <tr>
                                                    <td class="font-weight-bold">idUsuario</td>
                                                    <td>1</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="mt-4 text-secondary">
                                            <h6>Body
                                                <small>Formdata</small>
                                            </h6>
                                            <table class="table table-striped table-bordered">
                                                <tbody>
                                                <tr>
                                                    <td class="font-weight-bold">xp</td>
                                                    <td>1</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>


                                    </div>
                                </div>
                                <div class="col-lg-6 row code-api">
                                    <small class="text-white-50">Example response</small>
                                    <section class="code-api-content">
                                        { <br>
                                        "success": "Incrementação adicionada com sucesso!" <br>
                                        }
                                    </section>
                                </div>
                            </div>
                        </section>

                        <section id="gamificacao_listar">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="pt-4 pb-4">


                                        <div class="text-secondary"><span class="text-success mr-2">GET</span> Listar XP
                                        </div>
                                        <div class="box-code-input">
                                            {{ env("APP_URL") }}/api/jpiaget/gamificacao/usuario/{idUsuario}
                                        </div>

                                        <div class="mt-4 text-secondary">
                                            <h6>Headers</h6>
                                            <table class="table table-striped table-bordered">
                                                <tbody>
                                                <tr>
                                                    <td class="font-weight-bold">withCredentials</td>
                                                    <td>true</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Content-Type</td>
                                                    <td>application/json</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>


                                        <div class="mt-4 text-secondary">
                                            <h6>Parameters
                                                <small>URL</small>
                                            </h6>
                                            <table class="table table-striped table-bordered">
                                                <tbody>
                                                <tr>
                                                    <td class="font-weight-bold">idUsuario</td>
                                                    <td>1</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>


                                    </div>
                                </div>
                                <div class="col-lg-6 row code-api">
                                    <small class="text-white-50">Example response</small>
                                    <section class="code-api-content">
                                        { <br>
                                        "xp": 1 <br>
                                        }
                                    </section>
                                </div>
                            </div>
                        </section>

                    </div>

                </div>

            </div>

        </div>

    </main>
@endsection
