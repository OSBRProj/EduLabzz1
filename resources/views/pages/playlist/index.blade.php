@extends('layouts.master')

@section('title', 'J. PIAGET - Playlists')

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


        .input-group input.text-secondary::placeholder {
            color: #989EB4;
        }

    </style>

@endsection

@section('content')

    <main role="main">

        <div class="container-fluid">

            <div class="row" style="height: 100%; min-height: calc(100vh - 114px);">

                <div class="col-12 col-md-11 mx-auto">

                    <div class="row">
                        <div class="col-12 mb-3 title pl-0">
                            <h2>Playlists</h2>
                        </div>

                        <div class="col-12 px-0 mb-4">

                            @if(count($playlists) > 0)
                                <div class="row">
                                    <div class="col-sm-12 col-md-8 col-xl-9 my-auto">
                                        <form action="" method="get">
                                        <div class="input-group input-group mb-3">

                                                <input name="pesquisa" type="text" value="{{ Request::has('pesquisa') ? Request::get('pesquisa') : '' }}" required class="form-control py-2 width-100 shadow-sm border-0 px-3"
                                                    placeholder="Procurar playlist."
                                                    aria-label="Recipient's username" aria-describedby="button-addon2">

                                                <div class="input-group-append">
                                                    <button class="btn bg-primary border-0 text-light shadow-sm" type="submit" id="button-addon2">
                                                        <i class="fas fa-search fa-lg fa-fw text-light"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            </form>

                                    </div>

                                    <div class="col-sm-12 col-md-4 col-xl-3 mb-3">
                                        <button type="button" data-toggle="modal" data-target="#divModalNovaPlaylist" class="btn btn-block btn-primary text-truncate text-uppercase d-flex align-items-center justify-content-center font-weight-bold mr-3 mb-2 mb-sm-0 h-100">
                                            <i class="fas fa-plus mr-2"></i>
                                            Nova playlist
                                        </button>
                                    </div>

                                </div>
                            @else
                                <button type="button" data-toggle="modal" data-target="#divModalNovaPlaylist" class="btn btn-primary text-truncate text-uppercase font-weight-bold mr-3 mb-2 mb-sm-0">
                                    <i class="fas fa-plus mr-2"></i>
                                    Nova playlist
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

                        @forelse($playlists as $playlist)

                        <!-- Modal edit playlist -->
                            @include('pages.playlist._edit')
                            <div class="col-12 col-sm-6 col-md-4 col-lg-2 px-2 mb-4">
                                <div class="card-curso box-shadow bg-white rounded-10 pb-3 h-100">

                                    <div class="w-100 py-4 text-center bg-lightgray">
                                        <i class="fas fa-list-alt fa-3x text-primary"></i>
                                    </div>

                                    <div class="px-2 py-1">

                                        <p class="text-secondary font-weight-bold mt-2">
                                            {{ $playlist->titulo }}
                                            <small class="d-block text-gray">
                                                Autor: {{ ucfirst($playlist->user->name) }} <br>
                                                <strong
                                                    class="badge badge-primary">{{count($playlist->audios)}}</strong>
                                                áudios adicionados
                                            </small>
                                        </p>
                                        <div class="text-center">
                                            <button type="button" data-toggle="modal"
                                                    data-target="#divModalEditPlaylist_{{$playlist->id}}"
                                                    class="btn btn-light bg-white box-shadow text-secondary mr-2">
                                                <i class="fas fa-edit"></i>
                                            </button>

                                            <button type="button" onclick="excluirPlaylist({{ $playlist->id }})"
                                                    class="btn btn-light bg-white box-shadow text-declined">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>

                                        <form id="formExcluirPlaylist{{ $playlist->id }}"
                                            action="{{ route('playlists.destroy', ['idPlaylist' => $playlist->id]) }}"
                                            method="post">@csrf</form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 my-3">
                                <div class="card-curso shadow-sm rounded p-3 bg-white">
                                    @if(Request::has("pesquisa"))
                                        <h5>Nenhum resultado encontrado de acordo com sua busca.</h5>
                                    @else
                                        <h5>Você ainda não criou nenhuma playlist.</h5>
                                    @endif
                                </div>
                            </div>
                        @endforelse
                    </div>

                </div>

            </div>

        </div>

        <!-- Modal nova playlist -->
        @include('pages.playlist._create')


    </main>

@endsection

@section('bodyend')

    <script src="{{ env('APP_URL') }}/assets/js/pages/gestao/playlists.min.js"></script>

    <script>

        // Adicionar Audio
        $('div.addAudio').click(function () {
            var idAudio = $(this).attr('id');
            var tituloAudio = $(this).attr('data-id');

            //if ($("input[value=" + idAudio + "]").length === 0) {
                $('div.audiosIds').append('<input type="hidden" id="audio_id_' + idAudio + '" name="audio_id[]" value="' + idAudio + '">');
                $('div.audiosAddInline').append('<div class="col-lg-12 col-12 border-bottom mb-3" id="box_audio_id_' + idAudio + '">\n' +
                    '<i class="fas fa-times d-flex text-danger removeAudio justify-content-end" id="' + idAudio + '" style="cursor: pointer;"></i>\n' +
                    '<p class="font-weight-bold text-primary">\n' +
                    '<i class="fas fa-music mr-3"></i> ' + tituloAudio + '\n' +
                    '</p>\n' +
                    '</div>');

                $('div.removeContainerAudio_' + idAudio).slideUp();
            //}

            // remover audio
            $('i.removeAudio').click(function () {
                var idAudioRemove = $(this).attr('id');
                $("input#audio_id_" + idAudioRemove).remove();
                $("div#box_audio_id_" + idAudioRemove).remove();
                $('div.removeContainerAudio_' + idAudioRemove).slideDown();
            });
        });

        // remover audio
        $('i.removeAudio').click(function () {
            var idAudioRemove = $(this).attr('id');
            $("input#audio_id_" + idAudioRemove).remove();
            $("div#box_audio_id_" + idAudioRemove).remove();
            $('div.removeContainerAudio_' + idAudioRemove).slideDown();
        });


        function excluirPlaylist(id) {
            if ($("#formExcluirPlaylist" + id).length == 0)
                return;

            swal({
                title: 'Excluir playlist?',
                text: "Você deseja mesmo excluir esta Playlist? Todo seu conteúdo será apagado!",
                icon: "warning",
                buttons: ['Não', 'Sim, excluir!'],
                dangerMode: true,
            }).then((result) => {
                if (result == true) {
                    $("#formExcluirPlaylist" + id).submit();
                }
            });
        }
    </script>

@endsection
