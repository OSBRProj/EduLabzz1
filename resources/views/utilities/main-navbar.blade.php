<nav class="navbar fixed-top navbar-expand-lg navbar-dark px-2" id="mainNav">

    @if(Auth::check() && \HelperClass::needSideBarButton())
        <button class="btn btn-link nav-link pl-1" onclick="toggleSideMenu();">
            <i class="fas fa-bars fa-lg fa-fw text-shadow"></i>
        </button>
    @endif

    <div class="navbar-brand mx-4 p-0 mr-auto">

        {{-- <img src="{{ env('APP_URL') }}/images/logo-{{ HelperClass::getAplicacaoAtual() }}.svg" height="50" alt=""> --}}

        @if(Request::is('gestao') || Request::is('gestao/*') || Request::is('gestao/*/*'))
            <a id="imgLogoPrincipal" href="{{ Request::is('/gestao') ? '#' : env("APP_URL") . "/gestao" }}">
                <img src="{{ env('APP_URL') }}/images/logo-jean-piaget1.png" height="50" alt="">
            </a>
        @elseif(Request::is('hub') || Request::is('hub/*'))
            <a id="imgLogoPrincipal" href="{{ Request::is('/hub') ? '#' : env("APP_URL") . "/hub" }}">
                <img src="{{ env('APP_URL') }}/images/logo-jean-piaget1.png" height="50" alt="">
            </a>
        @else
            <a id="imgLogoPrincipal" href="{{ Request::is('/') ? '#' : env("APP_URL") }}">
                <img src="{{ env('APP_URL') }}/images/logo-jean-piaget1.png" height="50" alt="">
            </a>
        @endif

    </div>


    @if(Request::is('catalogo') || Request::is('biblioteca'))
        <form action="{{ route('biblioteca') }}" method="get">
            <input type="text"
                class="form-control input-pesquisa py-2 px-4 font-weight-bold {{ Request::has('pesquisa') ? '' : 'd-none' }}"
                name="pesquisa" id="txtPesquisaPrincipal" value="{{ Request::get('pesquisa') }}" required placeholder="Digite aqui o termo que deseja procurar...">
        </form>

        <ul class="navbar-nav ml-auto">

            <li class="nav-item my-auto mx-1 mx-xl-2">
                <button class="btn btn-link nav-link" onclick="mostrarBarraPesquisa();">
                    <i class="fas fa-search fa-lg fa-fw text-shadow"></i>
                </button>
            </li>

        </ul>
    @endif

    @if(!Auth::check())

        <div class="nav-item dropdown">

            <a href="{{ route('login') }}" class="nav-link d-block d-lg-none font-weight-bold">
                Entrar
            </a>

            <a href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
               aria-expanded="false" class="nav-link dropdown-toggle font-weight-bold d-none d-lg-block">
                Entrar
            </a>

            <div class="dropdown-menu dropdown-signin-menu" aria-labelledby="navbarDropdown">
                <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}" class="form-signin"
                      style="background-color: #13141D;">
                    @csrf

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-transparent border-0" id="basic-addon1">
                                <i class="fas fa-at"></i>
                            </span>
                        </div>

                        <input id="email" type="text" name="email" value="{{ old('email') }}"
                               class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="E-mail"
                               required>

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

                        <input id="password" name="password" type="password"
                               class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                               placeholder="Senha" required>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>

                    <button class="btn btn-lg btn-block signin-button my-4" type="submit">{{ __('Entrar') }}</button>

                    <span class="text-center d-block my-3 font-weight-bold"><a
                            href="{{ route('usuario.esqueci-senha') }}">Esqueci minha senha</a></span>

                    <h6 class="text-center d-block my-3 font-weight-bold" style="color: #989EB4">
                        Não tem uma conta? <a href="{{ route('register') }}">Cadastre-se</a>
                    </h6>


                </form>
            </div>

        </div>

    @endif

    @if(Auth::check())

            <div class="dropdown dropdown-hover show">
                <a class="nav-link text-primary" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-bell fa-lg fa-fw text-shadow"data-toggle="tooltip" data-placement="bottom" title="Notificações"></i>

                    <span id="lblQtNotificacoes" class="badge badge-secondary {{ App\Notificacao::where([['user_id', '=', Auth::user()->id], ['lida', '=', 0]])->count() > 0 ? '' : 'd-none' }}" style="position: absolute;top: 0px;right: 8px;margin-left: 25%;background: #EF6969;font-size: 12px;">{{ App\Notificacao::where([['user_id', '=', Auth::user()->id], ['lida', '=', 0]])->count() }}</span>

                </a>
                <div id="divNotificacoes" class="dropdown-menu rounded-10 border-0 box-shadow" aria-labelledby="dropdownMenuLink" style="right: 0px;left: initial;">

                    <div style="max-height: 20vh;overflow-y: auto;">
                        @if(App\Notificacao::where('user_id', '=', Auth::user()->id)->count() > 0)
                            <?php
                                foreach(App\Notificacao::where('user_id', '=', Auth::user()->id)->orderBy('created_at', 'desc')->get() as $notificacao)
                                {
                                    if($notificacao->link != "")
                                    {
                                        echo '<a href="' . $notificacao->link . '" target="_blank" id="divNotificacao' . $notificacao->id . '" class="dropdown-item p-2 box-notificacao" style="color: #60748A;min-width:  340px;border-bottom:  2px solid #E3E5F0;' . ($notificacao->lida == 0 ? 'background-color: #eafeff;' : '') . '">
                                            <button type="button" class="btn bg-transparent p-1 float-right" onclick="excluirNotificacao(' . $notificacao->id . ');"><i class="fas fa-times text-danger"></i></button>
                                            <div class="px-3 py-2">
                                                <b>' . ucfirst($notificacao->titulo) . '</b>
                                                <br>
                                                <small>' . ucfirst($notificacao->descricao) . '</small>
                                            </div>
                                        </a>';
                                    }
                                    else
                                    {
                                        echo '<div class="dropdown-item p-2 box-notificacao" id="divNotificacao' . $notificacao->id . '" style="color: #60748A;min-width:  340px;border-bottom:  2px solid #E3E5F0;' . ($notificacao->lida == 0 ? 'background-color: #eafeff;' : '') . '">
                                            <button type="button" class="btn bg-transparent p-1 float-right"  onclick="excluirNotificacao(' . $notificacao->id . ');"><i class="fas fa-times text-danger"></i></button>
                                            <div class="px-3 py-2">
                                                <b>' . ucfirst($notificacao->titulo) . '</b>
                                                <br>
                                                <small>' . ucfirst($notificacao->descricao) . '</small>
                                            </div>
                                        </div>';
                                    }
                                    $notificacao->update(['lida' => 1]);
                                }
                            ?>
                        @else
                            <div class="dropdown-item px-4 py-3" style="color: #60748A;min-width:  340px;border-bottom:  2px solid #E3E5F0;">
                                Você não possui notificações.
                            </div>
                        @endif
                    </div>

                    @if(App\Notificacao::where('user_id', '=', Auth::user()->id)->count() > 0)
                        <button type="button" onclick="excluirNotificacao('todas');" class="btn btn-link btn-block text-center">
                            Apagar todas notificações
                        </button>
                    @endif
                </div>
            </div>

        <div class="ml-2 nav-item dropdown avatar">

            <a class="nav-link dropdown-toggle font-weight-bold" href="#" id="navbarDropdown" role="button"
               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="avatar-img avatar-sm mr-2"
                     style="background: url({{ route('usuario.perfil.image', [Auth::user()->id]) }}); background-size: cover; background-position: 50% 50%; background-repeat: no-repeat;">
                </div>
                <span class="d-none d-md-inline-block">{{ ucwords(Auth::user()->name) }}</span>
            </a>

            <div class="dropdown-menu dropdown-menu-lg-right bg-white" aria-labelledby="navbarDropdown">

                {{--  <a class="dropdown-item{{ \Request::is('perfil') ? ' actived' : ''  }}" href="{{ \Request::is('perfil') ? '#' : route('perfil') }}">Perfil</a>  --}}

                {{--  <a class="dropdown-item{{ \Request::is('painel') ? ' actived' : ''  }}" href="{{ \Request::is('painel') ? '#' : route('painel') }}">Painel</a>  --}}

                {{--  <a class="dropdown-item{{ \Request::is('resultados') ? ' actived' : ''  }}" href="{{ \Request::is('resultados') ? '#' : route('resultados') }}">Resultados</a>  --}}

                {{--  <a class="dropdown-item{{ \Request::is('turmas') ? ' actived' : ''  }}" href="{{ \Request::is('turmas') ? '#' : route('turmas') }}">Minhas turmas</a>  --}}

                @if(strrpos(mb_strtoupper(Auth::user()->permissao, 'UTF-8'), "P") !== false || strrpos(mb_strtoupper(Auth::user()->permissao, 'UTF-8'), "G") !== false || strrpos(mb_strtoupper(Auth::user()->permissao, 'UTF-8'), "Z") !== false)
                    <a class="dropdown-item{{ \Request::is('gestao') || \Request::is('gestao/*') ? ' actived' : ''  }}"
                       href="{{ \Request::is('gestao') ? '#' : route('gestao.index') }}">Gestão</a>
                @endif

                {{-- <a class="dropdown-item" href="{{ route('favoritos.index') }}">
                    Meus favoritos
                </a> --}}

                {{-- <a class="dropdown-item" href="{{ route('habilidades.estatisticas.listar') }}">
                    Estatísticas e habilidades
                </a> --}}

                {{-- <a class="dropdown-item" href="{{ route('perfil.recompensas') }}">
                    Conquistas e recompensas
                </a> --}}

                {{-- <a class="dropdown-item" href="{{ route('historico.index') }}">
                    Histórico de visualizações
                </a> --}}

                <a class="dropdown-item" href="{{ route('configuracao.index') }}">
                    Configurações
                </a>

                <a class="dropdown-item" href="{{ route('ajuda.index') }}">
                    Ajuda
                </a>

                <a class="dropdown-item" href="#" onclick="event.preventDefault(); confirmLogout();">
                    Sair
                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                          style="display: none;"> @csrf </form>
                </a>

            </div>
        </div>

    @endif

</nav>
