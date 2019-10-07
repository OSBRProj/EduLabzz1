<!-- Row Tabs -->
<div class="row my-3">
    <ul class="nav nav-tabs border-0 mt-2 justify-content-center" id="myTab" role="tablist">
        <li class="nav-item col-6 col-md-2">
            <a class="nav-link {{ \Request::is('gestao/missoes') || \Request::is('gestao/missoes/*') ? 'active' : '' }}" href="{{ URL::to('gestao/missoes') }}">Missões</a>
        </li>
        <li class="nav-item col-6 col-md-2">
            <a class="nav-link {{ \Request::is('gestao/desafios') || \Request::is('gestao/desafios/*') ? 'active' : '' }}" href="{{ URL::to('gestao/desafios') }}">Desafios</a>
        </li>
        <li class="nav-item col-6 col-md-2">
            <a class="nav-link {{ \Request::is('gestao/conquistas') || \Request::is('gestao/conquistas/*') ? 'active' : '' }}" href="{{ URL::to('gestao/conquistas') }}">Conquistas</a>
        </li>
        <li class="nav-item col-6 col-md-3">
            <a class="nav-link {{ \Request::is('gestao/recompensas-virtuais') || \Request::is('gestao/recompensas-virtuais/*') ? 'active' : '' }}" href="{{ URL::to('gestao/recompensas-virtuais') }}">Recompensas Virtuais</a>
        </li>
        <li class="nav-item col-6 col-md-4">
            <a class="nav-link {{ \Request::is('gestao/recompensas-extra-jogo') || \Request::is('gestao/recompensas-extra-jogo/*') ? 'active' : '' }}" href="{{ URL::to('gestao/recompensas-extra-jogo') }}">Recompensas Extra-Jogo</a>
        </li>

        <li class="nav-item col-6 col-md-2">
            <a class="nav-link {{ \Request::is('gestao/badges') || \Request::is('gestao/badges/*') ? 'active' : '' }}" href="{{ URL::to('gestao/badges') }}">Medalhas</a>
        </li>
        <li class="nav-item col-6 col-md-2">
            <a class="nav-link {{ \Request::is('gestao/habilidades') || \Request::is('gestao/habilidades/*') ? 'active' : '' }}" href="{{ URL::to('gestao/habilidades') }}">Habilidades</a>
        </li>
    </ul>
</div>
<!-- Fim row Tabs -->