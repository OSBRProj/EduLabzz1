@extends('layouts.master')

@section('title', 'J. PIAGET - Novo artigo')

@section('headend')

    <!-- Custom styles for this template -->
    <style>

        header
        {
            padding: 154px 0 100px;
        }

        @media (min-width: 992px)
        {
            header
            {
                padding: 156px 0 100px;
            }
        }

        .capa-curso
        {
            min-height: 160px;
            border-radius: 10px 10px 0px 0px;
            background-image: url('{{ env('APP_LOCAL') }}/images/default-cover.jpg');
            background-size: cover;
            background-position: 50% 50%;
            background-repeat: no-repeat;
        }

        .input-group input.text-secondary::placeholder
        {
            color: #989EB4;
        }

        .form-group label
        {
            color: #213245;
            font-weight: bold;
            font-size: 18px;
        }


        .form-control
        {
            color: #525870;
            font-weight: bold;
            font-size: 16px;
            border: 0px;
            border-radius: 5px;
            box-shadow: 0px 3px 6px rgba(0,0,0,0.16);
        }

        .form-control::placeholder
        {
            color: #B7B7B7;
        }

        .custom-select option:first-child
        {
            color: #B7B7B7;
        }

        input[type=range]::-webkit-slider-thumb
        {
            -webkit-appearance: none;
            border: 0px;
            height: 20px;
            width: 20px;
            border-radius: 50%;
            background: #525870;
            cursor: pointer;
            margin-top: 0px; /* You need to specify a margin in Chrome, but in Firefox and IE it is automatic */
        }

        input[type=range]::-webkit-slider-runnable-track
        {
            width: 100%;
            height: 36px;
            cursor: pointer;
            box-shadow: 0px 3px 6px rgba(0,0,0,0.16);
            background: #008cc8;
            border-radius: 90px;
            border: 8px solid #E3E5F0;
        }

        .note-editable.card-block
        {
            min-height: calc(100vh - 720px);
        }

    </style>

@endsection

@section('content')

<main role="main" class="">

    <div class="container">

        <div class="row">

            <section class="col-12 col-md-11 mx-auto">

                <div class="col-12 title pl-0">
                    <h2>Criar artigo</h2>
                </div>

                <div class="my-4">

                    <form id="formNovoArtigo" class="w-100" method="POST" action="{{ route('gestao.artigos.cadastrar') }}" enctype="multipart/form-data">

                        @csrf

                        <div class="form-group m-0">
                            <input type="text" class="px-5 pt-3 pt-sm-4 form-control font-weight-bold rounded-0 text-secondary-placeholder text-truncate" name="titulo" id="titulo" placeholder="Título" style="font-size: 28px;border: 0px; border-bottom: 0px solid #E3E5F0;" required>
                            <input type="text" class="px-5 pt-2 pt-sm-3 pb-3 form-control font-weight-bold rounded-0 text-secondary-placeholder text-truncate" name="subtitulo" id="subtitulo" placeholder="Subtítulo" style="font-size: 18px;border: 0px; border-bottom: 2px solid #E3E5F0;" required>
                        </div>

                        <div class="p-3" style="background-color: #FBFBFB;min-height: calc(100vh - 284px);">

                            <div class="container-fluid">

                                <div class="row">

                                    <div class="col-12">

                                        <label for="capa" id="arquivo_capa" class="file-input-area input-capa mt-3 mb-5 w-100 text-center bg-primary">
                                            <input type="file" class="custom-file-input" id="arquivo_capa" name="arquivo_capa" required="" style="top: 0px;height:  100%;position:  absolute;left:  0px;" accept="image/jpg, image/jpeg, image/png" oninput="mudouArquivoCapa(this);">

                                            <h5 id="placeholder" class="text-white">
                                                <i class="far fa-image fa-2x d-block text-white mb-2 w-100" style="vertical-align: sub;"></i>
                                                CAPA DO ARTIGO
                                                <small class="text-uppercase d-block text-white small mt-2 mx-auto w-50" style="font-size:  70%;">
                                                    (Arraste o arquivo para esta área)
                                                    <br>
                                                    JPG ou PNG
                                                </small>
                                            </h5>
                                            <h5 id="file-name" class="float-left text-darker d-none font-weight-bold" style="margin-top: 145px;margin-left:  10px;margin-bottom:  20px;">
                                            </h5>
                                        </label>

                                        <div class="form-group mb-3">
                                            <label class="" for="descricao">Descrição curta</label>
                                            <textarea class="form-control" name="descricao" id="descricao" rows="3" placeholder="Clique para digitar." required></textarea>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="categoria">Categoria do artigo</label>
                                            <select class="custom-select form-control" name="categoria" id="categoria" required>
                                                <option disabled="disabled" value="0" selected>Selecione uma categoria</option>
                                                <option value="1" selected>Geral</option>
                                                @foreach ($categorias as $categoria)
                                                    <option value="{{ $categoria->id }}">{{ ucfirst($categoria->titulo) }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <textarea name="conteudo" id="conteudo" class="summernote" rows="10" placeholder="Escreva aqui seu artigo." required></textarea>

                                        <input type="hidden" name="status" value="0">

                                    </div>

                                </div>

                                <div class="mt-4 d-flex" style="justify-content: space-between;">
                                    <a href="{{ route('gestao.artigos.index') }}" class="btn btn-outline-secondary font-weight-bold px-3">Voltar</a>
                                    <button type="button" onclick="salvarArtigo(false);" class="btn btn-secondary font-weight-bold ml-auto mr-4 px-4">Salvar como rascunho</button>
                                    <button type="button" onclick="salvarArtigo(true);" class="btn btn-primary font-weight-bold px-5">Publicar</button>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/locales/bootstrap-datepicker.pt-BR.min.js"></script>

    <!-- Summernote css/js -->
    {{-- <link href="{{ env('APP_LOCAL') }}/assets/css/summernote-lite-cerulean.min.css" rel="stylesheet"> --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/lang/summernote-pt-BR.min.js" crossorigin="anonymous"></script>

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

        $( document ).ready(function()
        {
            $('.money').mask("#.##0,00", {reverse: true});

            $('.summernote').summernote({
                placeholder: $(".summernote").attr('placeholder'),
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

            $('.summernote').summernote('code', '');
        });

        function salvarArtigo(publicar)
        {
            var isValid = true;

            window.checarPreenchimento("#formNovoArtigo");

            $('#formNovoArtigo input, #formNovoArtigo select').each(function() {

                if ( ($(this).val() === '' || $(this).val() === null) && $(this).attr('required') )
                {
                    $(this).focus();

                    isValid = false;
                }
            });

            if(!isValid || $('.summernote').summernote('code') == '')
            {
                return;
            }

            if(publicar)
            {
                $("#formNovoArtigo input[name=status]").val("1");
            }
            else
            {
                $("#formNovoArtigo input[name=status]").val("0");
            }

            $("#formNovoArtigo").submit();

            $("#formNovoArtigo #divLoading").addClass('d-none');
            $("#formNovoArtigo #divEditar").addClass('d-none');
            $("#formNovoArtigo #divEnviando").removeClass('d-none');

            $("#formNovoArtigo #divLoading").addClass('d-none');
            $("#formNovoArtigo #divEditar").addClass('d-none');
            $("#formNovoArtigo #divEnviando").removeClass('d-none');
        }

    </script>

@endsection
