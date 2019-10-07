@extends('layouts.master')

@section('title', 'J. PIAGET - Gestão de áudios')

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

        .input-group input.text-secondary::placeholder { color: #989EB4; }


        .row-audio-card .title {
            border-bottom:0 !important;
            margin-bottom:0;
        }

        .audio-card { margin:15px; }
        .audio-card .row-audio-card { padding:15px; }


    </style>

@endsection

@section('content')

    <main role="main">

        <div class="container-fluid">

            <div class="col-12 col-md-11 mx-auto">

                <div class="row mx-auto">

                    <div class="col-12 mb-3 title pl-0">
                        <h2>Áudios</h2>
                    </div>

                    <div class="col-12 px-0 mb-4">

                        @if(count($audios) > 0)
                            <div class="row">
                                <div class="col-sm-12 col-md-8 col-xl-9 my-auto">
                                    <form action="" method="get">
                                    <div class="input-group input-group">

                                            <input name="pesquisa" type="text" value="{{ Request::has('pesquisa') ? Request::get('pesquisa') : '' }}" required class="form-control py-2 width-100 shadow-sm border-0 px-3"
                                                placeholder="Procurar áudios."
                                                aria-label="Recipient's username" aria-describedby="button-addon2">

                                            <div class="input-group-append">
                                                <button class="btn bg-primary border-0 text-light shadow-sm" type="submit" id="button-addon2">
                                                    <i class="fas fa-search fa-lg fa-fw text-light"></i>
                                                </button>
                                            </div>
                                        </div>
                                        </form>

                                </div>

                                <div class="col-sm-12 col-md-4 col-xl-3">
                                    <button type="button" data-toggle="modal" data-target="#divModalNovoAudio" class="btn btn-block btn-primary text-truncate text-uppercase d-flex align-items-center justify-content-center font-weight-bold mr-3 mb-2 mb-sm-0 h-100">
                                        <i class="fas fa-plus mr-2"></i>
                                        Novo áudio
                                    </button>
                                </div>

                            </div>
                        @else
                            <button type="button" data-toggle="modal" data-target="#divModalNovoAudio" class="btn btn-primary text-truncate text-uppercase font-weight-bold mr-3 mb-2 mb-sm-0">
                                <i class="fas fa-plus mr-2"></i>
                                Novo áudio
                            </button>
                        @endif

                        @if(Request::has('pesquisa'))
                            <div class="col-sm-12 col-md-6 text-center text-md-left mb-md-0 my-3">
                                <h5 class="my-2">
                                    <span class="font-weight-bold text-bluegray align-middle">Buscando por:</span>
                                    <span class="font-weight-bold text-bluegray align-middle" style="background-color: #207adc;color:  white;border-radius:  25px;padding:  8px 30px;margin:  0px 10px;">
                                        "{{ ucfirst(Request::get('pesquisa')) }}"
                                        <a href="{{ url()->current() }}" class="text-white ml-2">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    </span>
                                </h5>
                            </div>
                        @endif

                    </div>

                </div>

                <div class="row">

                    @forelse($audios as $audio)
                        <!-- Modal edit audio -->
                            @include('pages.audios.admin._edit')

                        <div class="audio-card card box-shadow bg-white rounded-10 col-item col-10 col-sm-10 col-md-5 col-lg-5">

                            <div class="row-audio-card row">

                                <div class="audio-capa d-flex align-items-center" {{ $audio->capa != '' ? 'background: url('. env("APP_LOCAL") .'/uploads/albuns/capas/'. $audio->capa .');' : 'red' }}>
                                    @if(empty($audio->capa))
                                    <i class="fas fa-music"></i>
                                    @endif
                                </div>

                                <div class="audio-desc">
                                    <p>
                                        <span class="title font-weight-bold text-dark">{{ $audio->titulo }}</span>
                                        <small class="d-block text-gray">Autor: {{ ucfirst($audio->user->name) }}</small>
                                    </p>
                                </div>

                                <button class="btn ml-auto align-self-start btn-link text-gray p-2" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <div class="dropdown-menu text-left">
                                    <button type="button" data-toggle="modal" data-target="#divModalEditAudio_{{$audio->id}}" class="btn btn-link dropdown-item">
                                        <i class="fas fa-edit"></i>
                                        Editar áudio
                                    </button>
                                    @if($audio->interacoes)
                                        <a href="{{ route('gestao.audios.interacoes', ['idAudio' => $audio->id]) }}" class="btn btn-link dropdown-item">
                                            <i class="fas fa-audio-description mr-1"></i>
                                            Ver interações
                                        </a>
                                    @endif
                                    <button type="button" onclick="excluirAudio({{ $audio->id }})" class="btn btn-link dropdown-item text-danger">
                                        <i class="fas fa-trash mr-1"></i>
                                        Excluir áudio
                                    </button>
                                </div>


                                <form id="formExcluirAudio{{ $audio->id }}" action="{{ route('gestao.audios.destroy', ['idAudio' => $audio->id]) }}" method="post">@csrf</form>

                            </div>


                        </div>
                    @empty
                        <div class="col-12 my-3">
                            <div class="card-curso shadow-sm rounded p-3 bg-white">
                                <h5>Você ainda não adicionou nenhum áudio.</h5>
                            </div>
                        </div>
                        <!-- Modal novo audio -->
                    @endforelse



                </div>

            </div>

        </div>

        <!-- Modal novo audio -->
        @include('pages.audios.admin._create')

    </main>

@endsection

@section('bodyend')

    <script src="{{ env('APP_URL') }}/assets/js/pages/gestao/audios.min.js"></script>

    <script>
        function formatTime(seconds) {
            return [
                parseInt(seconds / 60 / 60),
                parseInt(seconds / 60 % 60),
                parseInt(seconds % 60)
            ]
                .join(":")
                .replace(/\b(\d)\b/g, "0$1")
        }

        function hmsToSecondsOnly(str) {
            var p = str.split(':'),
                s = 0, m = 1;

            while (p.length > 0) {
                s += m * parseInt(p.pop(), 10);
                m *= 60;
            }

            return s;
        }

        $('input#file').on('change', function () {
            if ($('audio#audioAdded')) {
                $('#audioAdded').remove();
            }

            var parentForm = $(this).closest('form');

            var file = this.files[0];
            var size = file.size; //In bytes

            if ((size / 1000000) > 100)
            {
                $('label#divFileInputCapa').removeClass('bg-success').addClass('bg-secondary');
                swal("Arquivo muito grande!", "Seu áudio passou do limite de 100MB", "warning");
            }
            else
            {
                $('label#divFileInputCapa').removeClass('bg-secondary').addClass('bg-success');
                var fileUrl = window.URL.createObjectURL(file);
                $('.showAudio').append('<audio id="audioAdded" src="' + fileUrl + '" type="' + file.type + '" class="w-100" controls></audio>');

                /* PEGA TEMPO AUDIO DINAMICAMENTE */
                var myAudio = document.getElementById('audioAdded');
                myAudio.onloadedmetadata = function () {
                    var hhMMSS = formatTime(myAudio.duration);
                    parentForm.find('.txtDuracaoAudio').val(hhMMSS);
                    console.log(parentForm.find('.txtDuracaoAudio').val());
                }
                /* */
            }
        });


        function excluirAudio(id) {
            if ($("#formExcluirAudio" + id).length == 0)
                return;

            swal({
                title: 'Excluir áudio?',
                text: "Você deseja mesmo excluir este áudio? Todo seu conteúdo será apagado!",
                icon: "warning",
                buttons: ['Não', 'Sim, excluir!'],
                dangerMode: true,
            }).then((result) => {
                if (result == true) {
                    $("#formExcluirAudio" + id).submit();
                }
            });
        }

    </script>

@endsection
