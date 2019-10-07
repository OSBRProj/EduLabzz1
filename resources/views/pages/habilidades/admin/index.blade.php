@extends('layouts.master')

@section('title', 'J. PIAGET - Gestão de conteúdo')

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


    </style>

@endsection

@section('content')

    <main role="main" class="">

        <div class="container">

            <div class="px-3 px-md-5 w-100">


                <div class="col-12 mb-3 title pl-0">
                    <h2>Gestão de habilidades</h2>
                </div>

                <div class="row my-3">
                    <div class="col-auto text-center text-md-right mb-3 mb-md-0">
                        <button type="button" class="btn btn-primary text-white font-weight-normal" data-toggle="modal"
                                data-target="#divModalNovaHabilidade">
                            <i class="fas fa-plus fa-fw mr-2"></i>
                            Nova habilidade
                        </button>
                    </div>

                </div>

                <section class="row">
                    @forelse($habilidades as $habilidade)
                        <div class="col-12 mb-3">
                            <div class="card shadow-sm border-0 rounded">
                                <div class="card-body py-3">
                                    <button class="btn btn-link text-gray float-right p-2" type="button"
                                            data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <div class="px-3">
                                        <div class="dropdown-menu">
                                            <button type="button" data-toggle="modal"
                                                    class="btn btn-link dropdown-item text-warning"
                                                    data-target="#divModalAtualizaHabilidade_{{$habilidade->id}}">
                                                <i class="fas fa-edit"></i>
                                                Editar habilidade
                                            </button>
                                            <button type="button" onclick="excluirHabilidade({{ $habilidade->id }});"
                                                    class="btn btn-link dropdown-item text-danger" href="#"><i
                                                    class="fas fa-trash-alt"></i>
                                                Excluir habilidade
                                            </button>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <h5>{{ $habilidade->titulo }}</h5>
                                            <p class="mb-0"><span class="text-muted">Categoria: </span>{{ $habilidade->categoria }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal atualiza habilidade -->
                        @include('pages.habilidades.admin._edit')

                    @empty
                        <p class="text-dark">Nenhuma habilidade cadastrada</p>
                    @endforelse
                </section>

                <form id="formExcluirHabilidade" action="{{ route('gestao.habilidades.excluir') }}"
                      method="post">
                    @csrf
                    <input id="idHabilidade" name="idHabilidade" hidden>
                </form>

            </div>

            <!-- Modal nova habilidade -->
            @include('pages.habilidades.admin._create')


        </div>

    </main>

@endsection

@section('bodyend')

    <script>

        $('#selectQuestoes').on('click', function () {
            let name = $('select[id=selectCategoria]').val();
            if (name === "outra") {
                $('#selectCategoria').remove();
                $('#innerCategoria').attr("required");
                $('#innerCategoria').show();
            }
        });

        $('#selectCategoriaEdit').on('change', function () {
            let name = $('select[id=selectCategoriaEdit]').val();
            if (name === "outra") {
                $('#selectCategoriaEdit').remove();
                $('#innerCategoriaEdit').attr("required");
                $('#innerCategoriaEdit').show();
            }
        });

        function excluirHabilidade(id) {
            $("#formExcluirHabilidade #idHabilidade").val(id);

            swal({
                title: 'Excluir Habilidade?',
                text: "Você deseja mesmo excluir esta habilidade?",
                icon: "warning",
                buttons: ['Não', 'Sim, excluir!'],
                dangerMode: true,
            }).then((result) => {
                if (result == true) {
                    $("#formExcluirHabilidade").submit();
                }
            });
        }

        function mudouCategoria(value)
        {
            //console.log(value);

            if(value == "outra")
            {
                $("[name='categoria_outra']").removeAttr("hidden");
                $("select[name='categoria']").attr("name", 'categoria_select');
                $("input[name='categoria_outra']").attr("name", 'categoria');
            }
            else
            {
                $("select[name='categoria_select']").attr("name", 'categoria');
                $("input[name='categoria']").attr("name", 'categoria_outra');
                $("[name='categoria_outra']").attr("hidden", "");
            }
        }
    </script>

@endsection
