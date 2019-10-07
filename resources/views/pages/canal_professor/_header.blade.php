<style>
    .header-profile {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        margin-bottom:48px;
    }

    .avatar-professor {
        margin: 0 auto 10px;
        width: 90px;
        height: 90px;
        border-radius: 45px;
        -moz-border-radius: 45px;
        -webkit-border-radius: 45px;
        overflow: hidden;
    }

    .avatar-professor > img {
        width: 100%;
    }

    .title-professor {
        font-size: 28px;
        color: #0D1033;
        margin-bottom: 15px;
    }

    .icon-check {
        margin-left: 30px;
        color: #798AC4;
        font-size: 21px;
    }

    .icon-ratings {
        color: #FFDC4E;
        margin-bottom: 10px;
    }

    .professor-menu { margin: 40px auto; }

    .professor-menu .pmc { height:45px; }

    .professor-menu > hr {
        width: 100%;
        margin: 0 auto;
    }

    .title-menu {
        margin: 0 25px;
        color: #0D1033;
        font-size: 25px;
        padding-bottom: 10px;
    }

    .title-menu-active {
        margin: 0 25px;
        color: #207adc;
        font-size: 25px;
        font-weight:600;
        padding-bottom: 10px;
        border-bottom: 4px solid #207adc;
    }

    .title-menu:hover {
        color: #207adc;
        border-bottom: 4px solid #207adc;
    }

    .input-search > input {
        border: 2px solid #207adc;
        border-top-left-radius: 10px;
        border-bottom-left-radius: 10px;
        border-right: 0;
        padding: 5px 15px;
        background: transparent;
    }

    .input-search > input::placeholder {
        color: #207adc;
        font-weight: bold;
    }

    .input-search > button {
        border: 2px solid #207adc;
        border-top-right-radius: 10px;
        border-bottom-right-radius: 10px;
        border-left: 0;
        background: transparent;
        padding: 5px 10px;
        color: #207adc;
    }

    .section-conteudo { margin-bottom:60px; }
    .section-conteudo h4 {
        font-size:20px;
        color:#0D1033;
        margin-bottom:48px;
    }

    @media (max-width:767.98px) {
        .title-menu, .title-menu-active {
            display: inline-block;
            font-size:18px;
            margin-bottom: 12px;
        }
        .professor-menu .pmc { height:auto; }
    }

</style>

<div class="main">

    <div class="container">

        <div class="row">

            <div class="col-12 col-md-11 mx-auto">

                <div class="header-profile">
                    <div class="avatar-professor">
                        <img
                            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRU1gJrTqXMz_DO0hDOyo2cMMJ76hmIfrTMA5mCalphghLhxkTj"
                            alt="Avatar">
                    </div>
                    <h2 class="title-professor">{{ $professor->name }} <i class="fas fa-check-circle icon-check"></i></h2>
                    <div class="icon-ratings">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>

                </div>


                <div class="professor-menu">
                    <div class="pmc text-center">
                        <a href="{{ route('canal-professor.index', 1) }}"
                        class="{{ (\Request::is('canal-do-professor/*/canal') ? 'title-menu-active' : 'title-menu') }}">
                            Canal
                        </a>
                        <a href="{{ route('canal-professor.biblioteca', 1) }}"
                        class="{{ (\Request::is('canal-do-professor/*/biblioteca') ? 'title-menu-active' : 'title-menu') }}">
                            Biblioteca
                        </a>
                        <a href="{{ route('canal-professor.avaliacoes', 1) }}"
                        class="{{ (\Request::is('canal-do-professor/*/avaliacoes') ? 'title-menu-active' : 'title-menu') }}">
                            Avaliações
                        </a>
                        <a href="{{ route('canal-professor.duvidas', 1) }}"
                        class="{{ (\Request::is('canal-do-professor/*/duvidas') ? 'title-menu-active' : 'title-menu') }}">
                            Dúvidas
                        </a>
                    </div>
                    <hr>
                </div>

                @if(Request::segment(3) === 'biblioteca')
                    <div class="d-flex justify-content-end input-search">
                        <input type="text" placeholder="Pesquisar conteúdo">
                        <button type="submit"><i class="fas fa-search"></i></button>
                    </div>
                @endif


            </div>

        </div>

    </div>
</div>
