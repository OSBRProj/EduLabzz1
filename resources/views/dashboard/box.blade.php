@extends('layouts.box')

@section('title', 'J. PIAGET - Dashboard Box')

@section('headend')

    <!-- Custom styles main -->
    <style>

        body
        {
            padding-top: 10vh;
            padding-bottom: 40px;
            background-color: #F3F3F3;
        }

        .title
        {
            text-align: center;
            font-weight: 100;
            font-size: 60px;
            margin: 20px;
            margin-bottom: 8vh;
            transform: scale(0.8,1.5);
            color: #1d2850;
            position: absolute;
            left: 0px;
            top: 0px;
        }

    </style>

@endsection

@section('content')

    <div class="container">

        <h1 class="title d-none d-lg-block">
            Jean Piaget
        </h1>

        <form class="admin-box text-center px-5">

            <div style="position: relative;">
                <!-- <hr style="position: absolute; top: 0px; display: block; width: 100%;"> -->
                <div class="text-center mb-3">
                    <span class="step-indicator rounded-circle mx-3 active">1</span>
                    <span class="step-indicator rounded-circle mx-3">2</span>
                    <span class="step-indicator rounded-circle mx-3">3</span>
                </div>
            </div>

            <h4 class="mt-4 mb-5 font-weight-bold col-10 ml-auto mr-auto">
                Quer divulgar sua revista?
                <span class="small d-block mt-3 text-dark font-weight-bold">
                    Preencha os campos abaixo que aprovaremos no catálogo e entraremos em contato para te avisar.
                </span>
            </h4>

            <input type="email" id="" class="form-control rounded-0 mb-3" placeholder="Título da revista" required>

            <select class="custom-select rounded-0 my-3">
                <option selected>Categoria</option>
            </select>

            <div class="file-input-area my-5">
                <i class="far fa-arrow-alt-circle-up text-primary mb-2"></i>
                <h5 class="text-secondary">
                    Clique para fazer upload da sua revista
                    <small class="text-uppercase d-block text-muted small mt-2">
                        (Formatos: PDF, DOC, DOCX)
                    </small>
                </h5>
            </div>

            <div class="row">
                <button class="btn btn-lg btn-block outline-button my-4 col-4 ml-auto mr-4 font-weight-bold" type="submit">Cancelar</button>
                <button class="btn btn-lg btn-block signin-button my-4 col-4 ml-4 mr-auto text-dark font-weight-bold" type="submit">Próximo</button>
            </div>


        </form>

    </div>

@endsection
