<nav id="sidebar" class="sidebar hub-sidebar darkmode show">
    <ul class="side-group">

        <a href="{{ route('hub.index') }}">
            <li class="side-group-item {{ \Request::is('hub') || \Request::is('hub/*') ? 'active' : '' }}">
                <div class="d-flex justify-content-between align-items-center">
                    <span>
                        <span>Início</span>
                    </span>
                </div>
            </li>
        </a>

        <a href="#">
            <li class="side-group-item">
                <div class="d-flex justify-content-between align-items-center">
                    <span>
                        <span>Jogos</span>
                    </span>
                </div>
            </li>
        </a>

        <a href="#">
            <li class="side-group-item">
                <div class="d-flex justify-content-between align-items-center">
                    <span>
                        <span>Atividades</span>
                    </span>
                </div>
            </li>
        </a>

        <hr class="mx-2" style="border: 1px solid #333333;">

        @if(\Auth::check() == false)
            <div class="mx-4 my-3">

                <button onclick="" type="button" class="btn btn-block btn-primary rounded box-shadow text-white">Entrar</button>

                <a href="#" class="font-weight-bold text-white mx-auto d-block text-center my-4">
                    Cadastre-se
                </a>

            </div>
        @endif

        <div class="mx-auto text-center my-3">
            <a href="#" class="font-weight-bold text-white ml-auto mr-2">
                Sobre
            </a>
            <a href="#" class="font-weight-bold text-white mx-2">
                Download
            </a>
            <a href="#" class="font-weight-bold text-white ml-2 mr-auto">
                Ajuda
            </a>
        </div>

    </ul>

</nav>
