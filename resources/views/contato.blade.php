@extends('layouts.master')

@section('title', 'J. PIAGET - Contato')

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

        section
        {
            padding: 150px 0;
        }

        .navbar
        {
            box-shadow: 0px 3px 6px rgba(0,0,0,0.16);
            z-index: 3;
        }

        /* Conteudo */

        .side-menu
        {
            /* background-color: #fcfcfc; */
            background-color: #f2f2f2;
            box-shadow: 4px 0px 10px -4px rgba(0,0,0,0.16);
            z-index: 1;
        }

        .side-menu .list-group-item
        {
            background: transparent;
            color: #707070;
            border: 0;
            font-weight: normal;
            padding: 20px 12px;
            font-size: 16px;
        }

        .side-menu .list-group-item.text-muted
        {
            color: #ABABAB !important;
        }

        .side-menu .list-group-item.active
        {
            background: transparent;
            color: #ffba00;
            border: 0;
        }

        .btn-yellow
        {
            color: rgba(255, 255, 255, 1);
            border-radius: 10px;
            outline: 0px;
            border: 0px;
            background-color: rgba(255, 186, 0, 1);
            box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.16);
        }

        .main-panel
        {
            /* background-color: white; */
            background-color: #f3f3f3;
            min-height: calc(100vh - 130px);
        }

        .main-panel h4
        {
            color: #5F5F5F
        }

    </style>

@endsection

@section('content')

    <div class="container bg-lightgray mx-0 w-100 mw-100" style="min-height: calc(100vh - 162px);">

        <div class="row row mx-0 mx-sm-5">

            <div class="col-8 px-5 py-3 mt-3 mb-2 mx-auto">

                <form action="{{ route('contato.enviar') }}" method="get" class="admin-box text-center px-5">

                    @csrf

                    <h5 class="mt-4 mb-5 font-weight-bold col-10 ml-auto mr-auto">
                        Contato
                        <span class="small d-block mt-3 text-dark font-weight-normal">
                            Envie-nos uma mensagem, estamos à disposição para solucionar suas duvidas e abertos a sugestões!
                        </span>
                    </h5>

                    <input type="name" name="nome" class="form-control rounded-0 mb-3" placeholder="Nome e sobrenome" required="">

                    <input type="email" name="email" class="form-control rounded-0 mb-3" placeholder="Seu e-mail" required="">

                    <textarea name="mensagem" rows="4" placeholder="Escreva aqui sua mensagem." class="form-control rounded-0 mb-3" required></textarea>

                    <div class="row">
                        <button type="button" onclick="window.history.back();" class="btn btn-block outline-button my-4 col-4 ml-auto mr-4 font-weight-bold">Voltar</button>

                        <button type="submit" class="btn btn-block signin-button my-4 col-4 ml-4 mr-auto text-dark font-weight-bold">Enviar</button>
                    </div>

                </form>

            </div>
        </div>

    </div>

@endsection

@section('bodyend')

    <script>

        $( document ).ready(function() {

        });

    </script>

@endsection
