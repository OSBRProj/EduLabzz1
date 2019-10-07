<nav class="navbar fixed-top navbar-expand-lg navbar-dark px-2" id="mainNav">

    @if(\HelperClass::needSideBarButton())
        <button class="btn btn-link nav-link pl-1" onclick="toggleSideMenu();">
            <i class="fas fa-bars fa-lg fa-fw text-shadow"></i>
        </button>
    @endif

    <div class="navbar-brand mx-4 p-0 mr-auto">
        @if(Request::is('gestao') || Request::is('gestao/*') || Request::is('gestao/*/*'))
            <a id="imgLogoPrincipal" href="{{ Request::is('/gestao') ? '#' : env("APP_URL") . "/gestao" }}">
                <img src="{{ env('APP_URL') }}/images/logo-jean-piaget1.png" height="50" alt="">
            </a>
        @elseif(Request::is('hub') || Request::is('hub/*'))
            <a id="imgLogoPrincipal" href="{{ Request::is('/hub') ? '#' : env("APP_URL") . "/hub" }}">
                <img src="{{ env('APP_URL') }}/images/logo-piaget-digital.png" height="50" alt="">
            </a>
        @else
            <a id="imgLogoPrincipal" href="{{ Request::is('/') ? '#' : env("APP_URL") }}">
                <img src="{{ env('APP_URL') }}/images/logo-jean-piaget1.png" height="50" alt="">
            </a>
        @endif
    </div>


    <form class="mx-auto" action="{{ route('hub.index') }}" method="get">
        <input type="text" class="form-control input-pesquisa py-2 px-4 font-weight-bold {{ Request::has('pesquisa') ? '' : 'd-none' }}" name="pesquisa" id="txtPesquisaPrincipal" value="{{ Request::get('pesquisa') }}" placeholder="Buscar jogo.">
    </form>


    <ul class="navbar-nav">

        <li class="nav-item my-auto mx-1 mx-xl-2">
            <button class="btn btn-link nav-link" onclick="mostrarBarraPesquisa();">
                <i class="fas fa-search fa-lg fa-fw text-shadow"></i>
            </button>
        </li>

    </ul>

    @if(!Auth::check())

        <div class="nav-item dropdown">

            <a href="{{ route('login') }}" class="nav-link d-block d-lg-none font-weight-bold">
                Entrar
            </a>

            <a href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle font-weight-bold d-none d-lg-block">
                Entrar
            </a>

            <div class="dropdown-menu dropdown-signin-menu" aria-labelledby="navbarDropdown">
                <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}" class="form-signin" style="background-color: #13141D;">
                    @csrf

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-transparent border-0" id="basic-addon1">
                                <i class="fas fa-at"></i>
                            </span>
                        </div>

                        <input id="email" type="text" name="email" value="{{ old('email') }}" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="E-mail" required>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-transparent border-0" id="basic-addon1">
                                <i class="fas fa-lock"></i>
                            </span>
                        </div>

                        <input id="password" name="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Senha" required>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>

                    <button class="btn btn-lg btn-block signin-button my-4" type="submit">{{ __('Entrar') }}</button>

                    <span class="text-center d-block my-3 font-weight-bold"><a href="{{ route('usuario.esqueci-senha') }}">Esqueci minha senha</a></span>

                    <h6 class="text-center d-block my-3 font-weight-bold" style="color: #989EB4">
                        Não tem uma conta? <a href="{{ route('register') }}">Cadastre-se</a>
                    </h6>


                </form>
            </div>

        </div>

    @endif

    @if(Auth::check())

        <div class="ml-2 nav-item dropdown avatar">

            <a class="nav-link dropdown-toggle font-weight-bold" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="avatar-img avatar-sm mr-2" style="background: url({{ route('usuario.perfil.image', [Auth::user()->id]) }}); background-size: cover; background-position: 50% 50%; background-repeat: no-repeat;">
                </div>
                {{ ucwords(Auth::user()->name) }}
            </a>

            <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                @if(strrpos(mb_strtoupper(Auth::user()->permissao, 'UTF-8'), "P") !== false || strrpos(mb_strtoupper(Auth::user()->permissao, 'UTF-8'), "G") !== false || strrpos(mb_strtoupper(Auth::user()->permissao, 'UTF-8'), "Z") !== false)
                    <a class="dropdown-item{{ \Request::is('gestao') || \Request::is('gestao/*') ? ' actived' : ''  }}" href="{{ \Request::is('gestao') ? '#' : route('gestao.index') }}">Gestão</a>
                @endif

                <a class="dropdown-item" href="#" onclick="event.preventDefault(); confirmLogout();">
                    Sair
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> @csrf </form>
                </a>

            </div>
        </div>

    @endif

</nav>
