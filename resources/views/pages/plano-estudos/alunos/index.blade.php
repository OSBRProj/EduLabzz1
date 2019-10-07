@extends('layouts.master')

@section('title', 'J. PIAGET - Plano de estudos')

@section('headend')

    <!-- Custom styles for this template -->
    <style>
        .form-search {
            display: flex;
            margin-bottom: 80px;
        }

        .form-search > input {
            width: 100%;
            border: 0;
            background-color: #F8F9FF;
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
            padding: 15px 25px;
        }

        .form-search > input::placeholder {
            color: #999FB4;
            font-size: 20px;
        }

        .form-search > button {
            border: 0;
            background-color: #F8F9FF;
            color: #999FB4;
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
            padding: 15px 25px;
            font-size: 30px;
        }

        ul.list-planos-estudos {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        ul.list-planos-estudos > li {
            margin-bottom: 20px;
            border-bottom: 1px solid #e9ebf3;
            padding: 20px 10px;
        }

        .btn-adicionar {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 142px;
            height: 44px;
            text-align: center;
            background-color: #207adc;
            color: #fff;
            font-weight: bold;
            -webkit-border-radius: 22px;
            -moz-border-radius: 22px;
            border-radius: 22px;
        }

        .btn-adicionar:hover {
            color: #fff;
        }

    </style>

@endsection



@section('content')

    <main role="main">

        <div class="container-fluid pt-4">

            <div class="pt-3 px-3 px-md-5 w-100">

                <div class="text-center text-md-right float-left">
                    <a class="text-right text-primary" href="#">
                        <i class="fas fa-angle-left"></i>
                        Voltar ao painel
                    </a>
                </div>

                <div class="row my-4">
                    <div class="col-12 col-sm-10 col-lg-8 mx-auto rounded-10 box-shadow bg-white p-4">
                        <div class="container">
                            <h4 class="mb-5 text-center text-primary">
                                Planos de estudo para a carreira
                            </h4>

                            <div class="form-search">
                                <input type="text" name="search" placeholder="Bucar plano por nome do vestibular."
                                       required>
                                <button type="submit"><i class="fas fa-search"></i></button>
                            </div>

                            <ul class="list-planos-estudos">
                                <li class="d-lg-flex justify-content-between align-items-center">
                                    <div>
                                        <strong class="text-primary">UERJ</strong>
                                    </div>
                                    <div>
                                        <div class="d-lg-flex justify-content-center align-items-center">
                                            <div class="mr-5">10 minutos</div>
                                            <div class="mr-5">2/10</div>
                                            <div class="mr-5">
                                                <a href="" class="text-blue font-weight-bold">DETALHES</a>
                                            </div>
                                            <div>
                                                <a href="" class="btn-adicionar">ADICIONAR</a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>

                        </div>
                    </div>


                </div>


            </div>


        </div>

    </main>

@endsection

@section('bodyend')


@endsection

