@extends('layouts.master')
@section('title', 'J. PIAGET - Catálogo de conteúdo')
@section('headend')

<!-- Custom styles for this template -->
<style>
    .btn-menu-header {
        padding: 10px 40px;
        background: transparent;
        border-radius: 10px;
        font-size: 0.7rem;
        font-weight: bold;
        border: 2px solid #E3E5F0;
        color: #989EB4;
    }

    .btn-menu-header-active {
        padding: 10px 40px;
        background: transparent;
        border-radius: 10px;
        font-size: 0.7rem;
        font-weight: bold;
        border: 2px solid #207adc;
        color: #207adc;
    }

    .btn-menu-header-filter {
        padding: 10px 40px;
        background-color: #207adc;
        border-radius: 10px;
        font-size: 0.7rem;
        font-weight: bold;
        border: 2px solid #207adc;
        color: #FFFFFF;
    }

    .btn-menu-header-filter:hover {
        color: #FFFFFF;
    }

    .carousel-caption {
        left: 0;
        bottom: 0;
        width: 100%;
        padding: 20px 60px;
        text-align: left;
        background: rgba(0, 0, 0, 0.7);
    }

    .carousel-control-next,
    .carousel-control-prev {
        opacity: 1;
    }

    /*.carousel-control-next-icon,*/

    .carousel-control-prev-icon {
        position: absolute;
        left: 0;
        width: 70px;
        height: 60px;
        border-top-right-radius: 95px;
        border-bottom-right-radius: 95px;
        background-image: none;
        background-color: #FFFFFF;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .carousel-control-next-icon {
        position: absolute;
        right: 0;
        width: 70px;
        height: 60px;
        border-top-left-radius: 95px;
        border-bottom-left-radius: 95px;
        background-image: none;
        background-color: #FFFFFF;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .carousel-control-prev-icon:after {
        font-family: "Font Awesome 5 Free";
        content: "\f104";
        font-weight: bold;
        font-size: 30px;
        color: #207adc;
    }

    .carousel-control-next-icon:after {
        font-family: "Font Awesome 5 Free";
        content: "\f105";
        font-weight: bold;
        font-size: 30px;
        color: #207adc;
    }

    @media (max-width: 720px) {
        .carousel-control-prev-icon:after,
        .carousel-control-next-icon:after {
            font-size: 15px;
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            width: 35px;
            height: 25px;
        }
    }

    .box-filter {
        top: 1px;
        right: 0;
        position: fixed;
        z-index: 999999;
        display: none;
        overflow-y: auto;
        width: 400px;
        height: 100vh;
        border: 0;
        background-color: #FFFFFF;
    }

    .icons-dropdown {
        margin: auto;
        cursor: pointer;
        width: 80px;
        height: 80px;
        -webkit-border-radius: 40px;
        -moz-border-radius: 40px;
        border-radius: 40px;
        background-color: #E3E5F0;
        color: #999FB4;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 30px;
    }

    .icons-dropdown-active {
        margin: auto;
        cursor: pointer;
        width: 80px;
        height: 80px;
        -webkit-border-radius: 40px;
        -moz-border-radius: 40px;
        border-radius: 40px;
        background-color: #207adc;
        color: #FFFFFF;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 30px;
    }

    .dropdown-input-select {
        border: 2px solid #989AC1;
    }
</style>
@endsection

@section('content')

<main role="main" class="mr-0">
    <div class="row justify-content-center">
        <div class="col-11 px-2 px-lg-0 mx-auto">

            <section class="mt-5 mb-5">
                <div class="d-lg-flex justify-content-between">
                    <h4 class="text-primary font-weight-bold"><i class="fas fa-star"></i> Destaques</h4>

                    <!-- nav -->
                    <nav class="d-lg-flex justify-content-center">

                        <a href="#" class="btn btn-menu-header-active mr-lg-4">JOGOS</a>

                        <a href="#" class="btn btn-menu-header mr-lg-4">AULAS</a>

                        <a href="#" class="btn btn-menu-header mr-lg-4">CURSOS</a>

                        <button type="button" class="btn btn-menu-header-filter">
                                FILTAR <i class="fas fa-filter fa-lg ml-4"></i>
                            </button>
                        <div class="box-filter box-shadow">
                            <div class="dropdown-header text-right">
                                <button type="button" class="close closeDropdown" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>
                            <div class="p-4">
                                <small class="text-primary font-weight-bold d-block mb-3">Tipo de mídia</small>
                                <div class="row mb-4">

                                    <div class="col-md-4 col-lg-4 col-6 mb-3 text-center">
                                        <div class="icons-dropdown-active">
                                            <i class="fas fa-tv"></i>
                                        </div>
                                        <small class="text-blue">Transmissão</small>
                                    </div>

                                    <div class="col-md-4 col-lg-4 col-6 mb-3 text-center">
                                        <div class="icons-dropdown">
                                            <i class="fas fa-file"></i>
                                        </div>
                                        <small class="text-secondary">Arquivo</small>
                                    </div>



                                    <div class="col-md-4 col-lg-4 col-6 mb-3 text-center">
                                        <div class="icons-dropdown">
                                            <i class="fas fa-font"></i>
                                        </div>
                                        <small class="text-secondary">Texto</small>
                                    </div>

                                    <div class="col-md-4 col-lg-4 col-6 mb-3 text-center">
                                        <div class="icons-dropdown">
                                            <i class="fas fa-podcast"></i>
                                        </div>
                                        <small class="text-secondary">Podcast</small>
                                    </div>

                                    <div class="col-md-4 col-lg-4 col-6 mb-3 text-center">
                                        <div class="icons-dropdown">
                                            <i class="fas fa-video"></i>
                                        </div>
                                        <small class="text-secondary">Vídeo</small>
                                    </div>

                                    <div class="col-md-4 col-lg-4 col-6 mb-3 text-center">
                                        <div class="icons-dropdown-active">
                                            <i class="fas fa-gamepad"></i>
                                        </div>
                                        <small class="text-blue">Jogo</small>
                                    </div>

                                    <div class="col-md-4 col-lg-4 col-6 mb-3 text-center">
                                        <div class="icons-dropdown">
                                            <i class="fas fa-tv"></i>
                                        </div>
                                        <small class="text-secondary">Canal</small>
                                    </div>

                                </div>

                                <div class="mb-4">
                                    <small class="text-primary font-weight-bold d-block mb-3">Plano:</small>
                                    <select class="dropdown-input-select form-control">
                                            <option>Selecionar</option>
                                        </select>
                                </div>

                                <div class="mb-4">
                                    <small class="text-primary font-weight-bold d-block mb-3">Trilha:</small>
                                    <select class="dropdown-input-select form-control">
                                            <option>4 ANO</option>
                                        </select>
                                </div>

                                <div class="mb-4">
                                    <small class="text-primary font-weight-bold d-block mb-3">Matéria:</small>
                                    <select class="dropdown-input-select form-control">
                                            <option>GEOGRAFIA</option>
                                    </select>
                                </div>

                                <div class="mt-5">
                                    <div class="d-lg-flex justify-content-around">
                                        <button class="btn text-blue">LIMPAR FILTROS</button>
                                        <button class="btn bg-blue text-white">FILTRAR</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </nav>
                </div>
            </section>

            <!-- SLIDER -->
            <section class="mb-5">

                <div class="mb-5">
                    <div id="carouselCaptions" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="http://www.htmldrive.net/edit_media/2013/201307/20130715/revolverjs-master/png/2.png" class="d-block w-100" alt=".">
                                <div class="carousel-caption d-none d-md-block">
                                    <small class="text-muted font-weight-bold">JOGO</small>
                                    <p class="font-weight-bold mb-0">Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                                    <p>4 ANO</p>
                                </div>
                            </div>

                            <div class="carousel-item">
                                <img src="http://www.htmldrive.net/edit_media/2013/201307/20130715/revolverjs-master/png/2.png" class="d-block w-100" alt=".">
                                <div class="carousel-caption d-none d-md-block">
                                    <small class="text-muted font-weight-bold">JOGO</small>
                                    <p class="font-weight-bold mb-0">Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                                    <p>4 ANO</p>
                                </div>
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselCaptions" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                        <a class="carousel-control-next" href="#carouselCaptions" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                    </div>
                </div>

                <a href="#" class="text-primary font-weight-bold">Mostrar mais</a>
            </section>

            <hr>

            <!-- JOGOS -->
            <section class="mt-5 mb-5">
                <h4 class="text-primary font-weight-bold"><i class="fas fa-gamepad"></i> Jogos</h4>

                <div class="row mt-4 mb-5">
                    <div class="col-md-3 col-lg-3 col-12">
                        <div class="bg-white rounded-10">
                            <img src="https://i.ytimg.com/vi/9-2Lr3nmTbE/maxresdefault.jpg" class="card-img-top" alt=".">
                            <div class="card-body">
                                <p class="card-text text-primary">Lorem ipsum dolor sit amet.</p>
                                <small>4 ANO</small>
                                <span class="badge badge-info pl-2 pr-2 rounded-10">
                                        GEOGRAFIA
                                    </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="clearfix"></div>
                <a href="#" class="text-primary font-weight-bold">Mostrar mais</a>
            </section>

            <hr>

            <!-- CANAIS -->
            <section class="mt-5 mb-5">
                <h4 class="text-primary font-weight-bold"><i class="fas fa-tv"></i> Canais</h4>
                <div class="mt-4 mb-5 d-lg-flex justify-content-lg-between">

                    <div class="text-center mb-4">
                        <div class="canais-avatar">
                            <img src="https://randomuser.me/api/portraits/men/83.jpg" alt="" class="w-100">
                        </div>
                        <p class="text-primary text-center">Cláudio O Professor <i class="fas fa-check-circle text-info"></i></p>
                    </div>

                    <div class="text-center">
                        <div class="canais-avatar">
                            <img src="https://randomuser.me/api/portraits/women/81.jpg" alt="" class="w-100">
                        </div>
                        <p class="text-primary">Silvia Nascimento <i class="fas fa-check-circle text-info"></i></p>
                    </div>

                    <div class="text-center">
                        <div class="canais-avatar">
                            <img src="https://randomuser.me/api/portraits/women/17.jpg" alt="" class="w-100">
                        </div>
                        <p class="text-primary">Kenshin San Himura <i class="fas fa-check-circle text-info"></i></p>
                    </div>

                    <div class="text-center">
                        <div class="canais-avatar">
                            <img src="https://randomuser.me/api/portraits/men/22.jpg" alt="" class="w-100">
                        </div>
                        <p class="text-primary">Roberto Dominguez <i class="fas fa-check-circle text-info"></i></p>
                    </div>


                    <div class="text-center">
                        <div class="canais-avatar">
                            <img src="https://randomuser.me/api/portraits/men/11.jpg" alt="" class="w-100">
                        </div>
                        <p class="text-primary">Tristan Sanders Lou <i class="fas fa-check-circle text-info"></i>
                        </p>
                    </div>


                </div>

                <div class="clearfix"></div>
                <a href="#" class="text-primary font-weight-bold">Mostrar mais</a>
            </section>

            <hr>

            <!-- PODCASTS -->
            <section class="mt-5 mb-5">
                <h4 class="text-primary font-weight-bold"><i class="fas fa-podcast"></i> Podcasts</h4>
                <div class="row mt-4 mb-5">
    @include('pages.podcasts._all')
                </div>
                <div class="clearfix"></div>
                <a href="#" class="text-primary font-weight-bold">Mostrar mais</a>
            </section>

            <hr>

            <!-- TRANSMISSÕES AO VIVO -->
            <section class="mt-5 mb-5">
                <h4 class="text-primary font-weight-bold"><i class="fas fa-tv"></i> Transmissões ao vivo</h4>

                <div class="row mt-4 mb-5">
                    <div class="col-md-3 col-lg-3 col-12">
                        <div class="bg-white rounded-10">
                            <img src="https://i.ytimg.com/vi/9-2Lr3nmTbE/maxresdefault.jpg" class="card-img-top mb-3">
                            <div class="p-2">
                                <p class="card-text text-primary mb-1">Lorem ipsum dolor sit amet.</p>
                                <p>
                                    <small class="text-secondary font-weight-bold">Cláudio O Professor</small>
                                    <i class="fas fa-check-circle text-info"></i></p>
                                <small>4 ANO</small>
                                <span class="badge badge-info pl-2 pr-2 rounded-10">
                                        GEOGRAFIA
                                    </span>
                                <p class="text-center text-danger mt-4 font-weight-bold"><i class="fas fa-circle"></i> AO VIVO</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="clearfix"></div>
                <a href="#" class="text-primary font-weight-bold">Mostrar mais</a>
            </section>

            <hr>

            <!-- PLANO DE ESTUDOS -->
            <section class="mt-5 mb-5">
                <h4 class="text-primary font-weight-bold"><i class="fas fa-bars"></i> Planos de estudos</h4>

                <div class="row mt-4 mb-5">
    @include('pages.plano-aulas.alunos._all')
                </div>
                <div class="clearfix"></div>
                <a href="#" class="text-primary font-weight-bold">Mostrar mais</a>
            </section>


            <hr>

            <!-- ATIVIDADES -->
            <section class="mt-5 mb-5">
                <h4 class="text-primary font-weight-bold"><i class="fas fa-video"></i> Atividades</h4>

                <div class="row mt-4 mb-5">
                    <div class="col-md-3 col-lg-3 col-12">
                        <div class="bg-white rounded-10">
                            <img src="https://i.ytimg.com/vi/9-2Lr3nmTbE/maxresdefault.jpg" class="card-img-top mb-3">
                            <div class="p-2">
                                <p class="card-text text-primary">Lorem ipsum dolor sit amet.</p>
                                <p>
                                    <small>4 ANO</small>
                                    <span class="badge badge-info pl-2 pr-2 rounded-10">
                                        GEOGRAFIA
                                    </span>
                            </div>
                        </div>
                    </div>
                </div>

            </section>

        </div>
    </div>
</main>
@endsection

@section('bodyend')

<script>
    $(".btn-menu-header-filter").click(function () {
            $(".box-filter").toggle();
    });
    $(".closeDropdown").click(function () {
            $(".box-filter").fadeOut('normal');
    });

</script>
@endsection
