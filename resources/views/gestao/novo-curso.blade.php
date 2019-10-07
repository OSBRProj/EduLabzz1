@extends('layouts.master')

@section('title', 'J. PIAGET - Novo curso')

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
            box-shadow: 0px 1px 2px rgba(0,0,0,0.16);
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
            box-shadow: 0px 1px 2px rgba(0,0,0,0.16);
            background: #008cc8;
            border-radius: 90px;
            border: 8px solid #E3E5F0;
        }

    </style>

@endsection

@section('content')

<main role="main" class="">

    <div class="container">

        <div class="row">


                <div class="col-12 col-md-11 mx-auto">


                    <div class="title">
                        <h2>Cursos</h2>
                    </div>

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0 py-3 mb-4 bg-transparent border-bottom">
                            <li class="breadcrumb-item active" aria-current="page">
                                <a href="{{ route('gestao.cursos') }}" >
                                    <i class="fas fa-chevron-left mr-2"></i>
                                    <span>Meus cursos</span>
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Adicionar curso</li>
                        </ol>
                    </nav>



                    <form id="formNovoCurso" class="w-100" action="{{ route('gestao.novo-curso') }}" method="post" enctype="multipart/form-data">

                        @csrf

                        <div class="form-group m-0">
                            <input type="text" class="px-4 py-3 form-control rounded-0 text-truncate shadow-none border-bottom" name="titulo" id="titulo" placeholder="Clique para adicionar o título do curso." style="font-size: 1.5rem;" required>
                        </div>

                        <div class="p-3" style="background-color: #FBFBFB;min-height: calc(100vh - 284px);">

                            <div class="container-fluid">

                                <div class="row">

                                    <div class="col-12 col-lg-6">

                                        <label for="capa" id="divFileInputCapa" class="file-input-area input-capa mt-3 mb-5 w-100 text-center bg-primary">
                                            <input type="file" class="custom-file-input" id="capa" name="capa" required="" style="top: 0px;height:  100%;position:  absolute;left:  0px;" accept="image/jpg, image/jpeg, image/png" oninput="mudouArquivoCapa(this);">

                                            <h5 id="placeholder" class="text-white">
                                                <i class="far fa-image fa-2x d-block text-white mb-2 w-100 w-100" style="vertical-align: sub;"></i>
                                                CAPA DO CURSO
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
                                        <label class="" for="descricao_curta">Descrição curta do curso</label>
                                        <textarea class="form-control" name="descricao_curta" id="descricao_curta" rows="3" placeholder="Clique para digitar." required></textarea>
                                        </div>

                                        <div class="form-group mb-3">
                                        <label class="" for="descricao">Descrição do curso</label>
                                        {{-- <textarea class="form-control" name="descricao" id="descricao" rows="3" placeholder="Clique para digitar." required></textarea> --}}
                                        <textarea name="descricao" id="descricao" class="summernote" placeholder="Clique para digitar."></textarea>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="categoria">Categoria do curso</label>
                                            <select class="custom-select form-control" name="categoria" id="categoria" required>
                                                <option disabled="disabled" value="0" selected>Selecione uma categoria</option>
                                                @foreach ($categorias as $categoria)
                                                    <option value="{{ $categoria->id }}">{{ ucfirst($categoria->titulo) }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>

                                    <div class="col-12 col-lg-6">

                                        @if(Auth::user()->permissao == "G" || Auth::user()->permissao == "Z")
                                            <div class="form-group mb-3">
                                                <label for="tipo">Tipo de curso</label>
                                                <select class="custom-select form-control" name="tipo" id="tipo" required>
                                                    <option disabled="disabled" value="1" selected>Selecione um tipo</option>
                                                    <option value="1">Curso padrão / Para alunos</option>
                                                    <option value="2">Curso para Professores / Gestores</option>
                                                </select>
                                            </div>
                                        @endif

                                        <div class="form-group mb-3">
                                            <label for="categoria">Visibilidade do curso</label>
                                            <select class="custom-select form-control" name="visibilidade" id="visibilidade" required>
                                                <option disabled="disabled" value="">Selecione uma visibilidade</option>
                                                <option value="1">Público</option>
                                                @if(strtoupper(Auth::user()->permissao) == "E" || strtoupper(Auth::user()->permissao) == "Z")
                                                    <option value="2">Oculto</option>
                                                @endif
                                            </select>
                                        </div>

                                        @if((strtoupper(Auth::user()->permissao) == "E" || strtoupper(Auth::user()->permissao) == "Z"))
                                            <div class="form-group mb-3">
                                                <label class="" for="senha">Senha do curso <small>(opcional)</small></label>
                                                <input type="text" class="form-control" name="senha" id="senha" aria-describedby="helpId" placeholder="Clique para digitar.">
                                            </div>
                                        @endif

                                        <div class="form-group mb-3">
                                            @if((strtoupper(Auth::user()->permissao) == "E" || strtoupper(Auth::user()->permissao) == "Z"))
                                                <label class="" for="preco">Preço do curso (Opcional)</label>
                                            @else
                                                <label class="" for="preco">Preço do curso (Opcional / mín. R$ 25,00)</label>
                                            @endif
                                        <input type="text" class="form-control money" name="preco" id="preco" aria-describedby="helpId" placeholder="Clique para digitar.">
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="" for="periodo">Período do curso (dias)</label>
                                            <label class="float-right" id="lblPeriodo" for="periodo">Ilimitado</label>
                                            <input type="range" class="custom-range" min="0" max="365" value="0" name="periodo" id="periodo" oninput="mudouPeriodo(this);">
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="" for="vagas">Vagas do curso</label>
                                            <label class="float-right" id="lblVagas" for="vagas">Ilimitado</label>
                                            <input type="range" class="custom-range" min="0" max="100" value="0" name="vagas" id="vagas" oninput="mudouVagas(this);">
                                        </div>

                                        <input id="rasunho" value="false" type="text" hidden>

                                        <div class="">
                                            <div class="row">
                                                <div class="col-12 col-xl-7">
                                                    <button type="button" onclick="salvar(true);" class="btn btn-secondary btn-block font-weight-bold text-truncate">
                                                        Salvar como rascunho
                                                    </button>
                                                </div>
                                                <div class="col-12 col-xl-5">
                                                    <button type="button" onclick="salvar(true);" class="btn btn-primary btn-block font-weight-bold text-truncate">
                                                        Continuar
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </form>

                </div>


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

        function salvar(rascunho)
        {
            var isValid = true;

            $('input, textarea').each(function() {
                if ( ($(this).val() === '' || $(this).val() == '0' || $(this).val() == null) && $(this).attr('required') )
                {
                    console.log(this);

                    $(this).focus();

                    isValid = false;
                }
            });

            if(!isValid)
                return;

            $("#rascunho").val(rascunho);
            $("#divSalvando").removeClass('d-none');
            $("#formNovoCurso").submit();
        }

        function mudouPeriodo(el)
        {
            if(el.value > 0)
            {
                $("#lblPeriodo").text(el.value);
            }
            else
            {
                $("#lblPeriodo").text("Ilimitado");
            }
        }

        function mudouVagas(el)
        {
            if(el.value > 0)
            {
                $("#lblVagas").text(el.value);
            }
            else
            {
                $("#lblVagas").text("Ilimitado");
            }
        }

    </script>

@endsection
