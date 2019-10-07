@extends('layouts.master')

@section('title', 'J. PIAGET - Nova trilha')

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

        .capa-curso {
            min-height: 160px;
            border-radius: 10px 10px 0px 0px;
            background-image: url('{{ env('APP_LOCAL') }}/images/default-cover.jpg');
            background-size: cover;
            background-position: 50% 50%;
            background-repeat: no-repeat;
        }

        .input-group input.text-secondary::placeholder {
            color: #989EB4;
        }

        .form-group label {
            color: #213245;
            font-weight: bold;
            font-size: 18px;
        }


        .form-control {
            color: #525870;
            font-weight: bold;
            font-size: 16px;
            border: 0px;
            border-radius: 5px;
            shadow-sm: 0px 3px 6px rgba(0, 0, 0, 0.16);
        }

        .form-control::placeholder {
            color: #B7B7B7;
        }

        .custom-select option:first-child {
            color: #B7B7B7;
        }

        input[type=range]::-webkit-slider-thumb {
            -webkit-appearance: none;
            border: 0px;
            height: 20px;
            width: 20px;
            border-radius: 50%;
            background: #525870;
            cursor: pointer;
            margin-top: 0px; /* You need to specify a margin in Chrome, but in Firefox and IE it is automatic */
        }

        input[type=range]::-webkit-slider-runnable-track {
            width: 100%;
            height: 36px;
            cursor: pointer;
            shadow-sm: 0px 3px 6px rgba(0, 0, 0, 0.16);
            background: #008cc8;
            border-radius: 90px;
            border: 8px solid #E3E5F0;
        }

    </style>

@endsection

@section('content')

    <main role="main" class="">

        <div class="container-fluid">

            <div class="row">

                <div class="col-12 col-md-11 mx-auto">


                        <div class="title">
                            <h2>Adicionar trilha</h2>
                        </div>

                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb p-0 py-3 mb-4 bg-transparent border-bottom">
                                <li class="breadcrumb-item active" aria-current="page">
                                    <a href="{{ route('gestao.trilhas.listar') }}" >
                                        <i class="fas fa-chevron-left mr-2"></i>
                                        <span>Gestão de trilhas</span>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Adicionar trilha</li>
                            </ol>
                        </nav>


                        <form id="formNovoCurso" class="w-100" action="{{ route('gestao.trilhas.store') }}"
                              method="post"
                              enctype="multipart/form-data">

                            @csrf

                            <div class="form-group m-0">
                                <input type="text"
                                       class="px-4 py-3 form-control rounded-0 text-truncate shadow-none border-bottom"
                                       name="titulo" id="titulo" placeholder="Clique para adicionar o título da trilha."
                                       style="font-size:1.2rem;"
                                       value="{{old('titulo')}}" required>
                            </div>

                            <div class="p-3" style="background-color: #FBFBFB;min-height: calc(100vh - 284px);">

                                <div class="container-fluid">

                                    <div class="row">

                                        <div class="col-12 col-lg-6">

                                            <label for="capa" id="divFileInputCapa"
                                                   class="file-input-area input-capa mt-3 mb-5 w-100 text-center bg-primary">
                                                <input type="file" class="custom-file-input" id="capa" name="capa"
                                                       required=""
                                                       style="top: 0px;height:  100%;position:  absolute;left:  0px;"
                                                       accept="image/jpg, image/jpeg, image/png"
                                                       oninput="mudouArquivoCapa(this);">

                                                <h5 id="placeholder" class="text-white">
                                                    <i class="far fa-image fa-2x d-block text-white mb-2 w-100"
                                                       style="vertical-align: sub;"></i>
                                                    CAPA DA TRILHA
                                                    <small
                                                        class="text-uppercase d-block text-white small mt-2 mx-auto w-50"
                                                        style="font-size:  70%;">
                                                        (Arraste o arquivo para esta área)
                                                        <br>
                                                        JPG ou PNG
                                                    </small>
                                                </h5>
                                                <h5 id="file-name"
                                                    class="float-left text-primary d-none font-weight-bold"
                                                    style="margin: 145px 0 20px 10px;">
                                                </h5>
                                            </label>


                                            <div class="form-group mb-3">
                                                <label class="" for="descricao">Descrição da trilha</label>
                                                <textarea class="form-control shadow-sm" name="descricao" id="descricao" rows="3"
                                                          placeholder="Clique para digitar."
                                                          required>{{old('descricao')}}</textarea>
                                            </div>

                                            <div class="form-group mb-3 mt-5">
                                                <div class="row cursosAddInline">

                                                </div>
                                            </div>


                                        </div>

                                        <div class="col-12 col-lg-6">

                                            <div class="bg-white shadow-sm p-4 rounded-10">
                                                <h4 class="font-weight-bold border-bottom">Curso</h4>

                                                <input type="text" placeholder="Buscar" class="form-control p-2 my-5 shadow-sm">

                                                <div style="max-height: 400px; overflow-y: scroll; padding-right: 30px">
                                                    @foreach($cursos as $curso)
                                                        <div class="removeContainerCurso_{{$curso->id}}">
                                                            <div
                                                                class="w-100 mb-3 border-bottom d-flex justify-content-between align-items-center">
                                                                <div>
                                                                    <h5 class="font-weight-bold text-primary">{{ $curso->titulo }}</h5>
                                                                    <p class="font-weight-bold">{{$curso->user->name}}</p>
                                                                </div>
                                                                <div class="addCurso btn btn-outline-primary"
                                                                     id="{{$curso->id}}" data-id="{{$curso->titulo}}">
                                                                    <i class="fas fa-plus"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <hr>
                                <div class="float-right">
                                    <div class="cursosIds"></div>
                                    <button type="submit" class="btn btn-primary text-uppercase font-weight-bold">
                                        SALVAR
                                    </button>
                                </div>
                                <div class="float-right mr-3">
                                    <a href="{{ route('gestao.trilhas.listar') }}"
                                        class="btn text-uppercase font-weight-bold btn btn-danger">CANCELAR</a>
                                </div><br clear="all">
                            </div>

                        </form>
                    </div>
            </div>

        </div>

    </main>

@endsection

@section('bodyend')

    <!-- Bootstrap Datepicker JS -->
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/locales/bootstrap-datepicker.pt-BR.min.js"></script>

    <!-- Summernote css/js -->
    {{-- <link href="{{ env('APP_LOCAL') }}/assets/css/summernote-lite-cerulean.min.css" rel="stylesheet"> --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/lang/summernote-pt-BR.min.js"
            crossorigin="anonymous"></script>

    <!-- Mask JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>

    <script>

        $('#txtDatePicker').datepicker({
            weekStart: 0,
            language: "pt-BR",
            daysOfWeekHighlighted: "0,6",
            autoclose: true,
            todayHighlight: true
        });

        $(document).ready(function () {

        });


        // Adicionar curso
        $('div.addCurso').click(function () {
            var idCurso = $(this).attr('id');
            var tituloCurso = $(this).attr('data-id');

            if ($("[value=" + idCurso + "]").length === 0) {
                $('div.cursosIds').append('<input type="hidden" id="curso_id_' + idCurso + '" name="curso_id[]" value="' + idCurso + '">');
                $('div.cursosAddInline').append('<div class="col-lg-4 col-6 shadow rounded-sm-10 bg-white m-4 p-4" id="box_curso_id_' + idCurso + '">\n' +
                    '<i class="fas fa-times d-flex text-danger removeCurso justify-content-end" id="' + idCurso + '" style="cursor: pointer;"></i>' +
                    '<p class="font-weight-bold text-primary">' + tituloCurso + '</p>\n' +
                    '</div>');
                $('div.removeContainerCurso_' + idCurso).slideUp();
            }

            // remover curso
            $('i.removeCurso').click(function () {
                var idCursoRemove = $(this).attr('id');
                $("input#curso_id_" + idCursoRemove).remove();
                $("div#box_curso_id_" + idCursoRemove).remove();
                $('div.removeContainerCurso_' + idCursoRemove).slideDown();
            });
        });


    </script>

@endsection
