@extends('layouts.master')

@section('title', 'J. PIAGET - Editar álbum')

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
            box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.16);
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
            box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.16);
            background: #008cc8;
            border-radius: 90px;
            border: 8px solid #E3E5F0;
        }

    </style>

@endsection

@section('content')

    <main role="main" class="">

        <div class="container-fluid pt-0">

            <div class="px-0 w-100">

                <section>

                    <div class="row my-4">

                        <form id="formNovoAlbum" class="w-100"
                              action="{{ route('gestao.albuns.update', ['idAlbum' => $album->id]) }}"
                              method="post"
                              enctype="multipart/form-data">

                            @csrf

                            <div class="form-group m-0">
                                <input type="text"
                                       class="px-5 pt-3 pt-sm-5 pb-3 form-control font-weight-bold rounded-0 text-secondary-placeholder text-truncate"
                                       name="titulo" id="titulo" placeholder="Clique para alterar o título do álbum."
                                       style="font-size: 28px;border: 0px; border-bottom: 2px solid #E3E5F0;"
                                       value="{{ $album->titulo }}" required>
                            </div>

                            <div class="p-3" style="background-color: #FBFBFB;min-height: calc(100vh - 284px);">

                                <div class="container-fluid">

                                    <div class="row">

                                        <div class="col-12 col-lg-6">

                                            <label for="capa" id="divFileInputCapa"
                                                   class="file-input-area input-capa mt-3 mb-5 w-100 text-center bg-primary"
                                                   style="{{ $album->capa != '' ? 'background-image: url('. env("APP_LOCAL") .'/uploads/albuns/capas/'. $album->capa .');' : '' }}background-size: contain;background-position: 50% 50%;background-repeat: no-repeat;">
                                                <input type="file" class="custom-file-input" id="capa" name="capa"
                                                       style="top: 0px;height:  100%;position:  absolute;left:  0px;"
                                                       accept="image/jpg, image/jpeg, image/png"
                                                       oninput="mudouArquivoCapa(this);">

                                                <h5 id="placeholder" class="text-white">
                                                    <i class="far fa-image fa-2x d-block text-white mb-2 w-100"
                                                       style="vertical-align: sub;"></i>
                                                    CAPA Do ÁLBUM
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

                                            <div class="form-group mb-5">
                                                <label for="categoria">Selecione uma categoria</label>
                                                <select name="categoria" class="custom-select form-control" required>
                                                    <option value="1">Geral</option>
                                                    @foreach($categorias as $categoria)
                                                        <option
                                                            value="{{$categoria->id}}"
                                                            {{($categoria->id === $album->categoria ? "selected" : null)}}
                                                        >
                                                            {{$categoria->titulo}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>


                                            <div class="form-group mb-3">
                                                <label class="" for="descricao">Descrição do álbum</label>
                                                <textarea class="form-control" name="descricao" id="descricao" rows="3"
                                                          placeholder="Clique para digitar.">{{$album->descricao}}</textarea>
                                            </div>

                                            <div class="form-group mb-3 mt-5">
                                                <div class="row audiosAddInline">


                                                    @foreach($album->audios as $audio)
                                                        <div
                                                            class="col-lg-4 col-6 box-shadow rounded-10 bg-white m-4 p-4"
                                                            id="box_audio_id_{{$audio->id}}">
                                                            <i class="fas fa-times d-flex text-danger removeAudio justify-content-end"
                                                               id="{{ $audio->id }}"
                                                               style="cursor: pointer;"></i>
                                                            <p class="font-weight-bold text-primary">{{$audio->titulo}}</p>
                                                        </div>
                                                    @endforeach

                                                </div>
                                            </div>


                                        </div>

                                        <div class="col-12 col-lg-6">

                                            <div class="bg-white box-shadow p-4 rounded-10">
                                                <h4 class="text-primary font-weight-bold">
                                                    <i class="fas fa-volume-up"></i> ÁUDIOS
                                                </h4>

                                                <input type="text" placeholder="Buscar" class="form-control p-2 my-5">

                                                <div style="max-height: 400px; overflow-y: scroll; padding-right: 30px">
                                                    @foreach($audios as $audio)
                                                        <div
                                                            class="w-100 mb-3 border-bottom d-flex justify-content-between align-items-center">
                                                            <div>
                                                                <h5 class="font-weight-bold text-primary">{{ $audio->titulo }}</h5>
                                                                <p class="font-weight-bold">{{$audio->user->name}}</p>
                                                            </div>
                                                            <div style="cursor: pointer;" class="addAudio"
                                                                 id="{{$audio->id}}" data-id="{{$audio->titulo}}">
                                                                <i class="fas fa-plus fa-lg text-primary"></i>
                                                            </div>
                                                        </div>

                                                    @endforeach
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <hr>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <a href="{{ route('gestao.albuns.listar') }}"
                                           class="btn text-uppercase font-weight-bold"
                                           style="background-color: #F5F5F5; color: #B7B7B7;">CANCELAR</a>
                                    </div>
                                    <div>
                                        <div class="audiosIds">

                                            @foreach($album->audios as $audio)
                                                <input type="hidden" id="audio_id_{{$audio->id}}"
                                                       name="audio_id[]" value="{{$audio->id}}">
                                            @endforeach


                                        </div>
                                        <input type="hidden" name="capa_atual" value="{{$album->capa}}">
                                        <button type="submit" class="btn btn-primary text-uppercase font-weight-bold">
                                            SALVAR
                                        </button>
                                    </div>
                                </div>

                            </div>

                        </form>

                    </div>

                </section>

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

            $('.summernote').summernote({
                placeholder: "Clique para digitar.",
                lang: 'pt-BR',
                airMode: false,
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['fontsize', 'color']],
                    ['font', ['fontname']],
                    ['para', ['paragraph']],
                    ['insert', ['hr', 'picture', 'video', 'link', 'table', 'image', 'doc']],
                    ['misc', ['undo', 'redo', 'codeview', 'fullscreen', 'help']],
                ],
                popover: {
                    image: [
                        ['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],
                        ['float', ['floatLeft', 'floatRight', 'floatNone']],
                        ['remove', ['removeMedia']]
                    ],
                    link: [
                        ['link', ['linkDialogShow', 'unlink']]
                    ],
                    air: [
                        ['style', ['style']],
                        ['font', ['bold', 'italic', 'underline', 'clear']],
                        ['font', ['fontsize', 'color']],
                        ['font', ['fontname']],
                        ['para', ['paragraph']],
                        ['table', ['table']],
                        ['insert', ['hr', 'picture', 'video', 'link', 'table', 'image', 'doc']],
                        ['misc', ['undo', 'redo']],
                    ],
                },
            });
        });


        // Adicionar audio
        $('div.addAudio').click(function () {
            var idAudio = $(this).attr('id');
            var tituloAudio = $(this).attr('data-id');

            if ($("input[value=" + idAudio + "]").length === 0) {
                $('div.audiosIds').append('<input type="hidden" id="audio_id_' + idAudio + '" name="audio_id[]" value="' + idAudio + '">');
                $('div.audiosAddInline').append('<div class="col-lg-4 col-6 box-shadow rounded-10 bg-white m-4 p-4" id="box_audio_id_' + idAudio + '">\n' +
                    '<i class="fas fa-times d-flex text-danger removeAudio justify-content-end" id="' + idAudio + '" style="cursor: pointer;"></i>' +
                    '<p class="font-weight-bold text-primary">' + tituloAudio + '</p>\n' +
                    '</div>');
            }

            // remover audio
            $('i.removeAudio').click(function () {
                var idAudioRemove = $(this).attr('id');
                $("input#audio_id_" + idAudioRemove).remove();
                $("div#box_audio_id_" + idAudioRemove).remove();
            });
        });

        // remover audio
        $('i.removeAudio').click(function () {
            var idAudioRemove = $(this).attr('id');
            $("input#audio_id_" + idAudioRemove).remove();
            $("div#box_audio_id_" + idAudioRemove).remove();
        });

    </script>

@endsection
