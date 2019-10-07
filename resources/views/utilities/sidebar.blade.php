<nav id="sidebar" class="sidebar show">

    <div class="hide-opened p-3 container-aplicacao d-flex justify-content-center align-items-center">
        <img src="{{ env("APP_URL") }}/images/icon-play.svg" height="30" alt="">
    </div>

    <div class="hide-closed p-3 container-aplicacao d-flex justify-content-center align-items-center">
        <img src="{{ env("APP_URL") }}/images/logo-{{ HelperClass::getAplicacaoAtual() }}.svg" height="30" alt="">
    </div>

    <div class="d-flex flex-column justify-content-between flex-fill">

        <ul class="side-group">

            <a href="{{ route('home') }}">
                <li class="side-group-item {{ \Request::is('home') ? 'active' : '' }}">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>
                            <i class="fas fa-home fa-fw side-item-icon"></i>
                            <span>Início</span>
                        </span>
                    </div>
                </li>
            </a>

            {{-- <a href="{{ route('estatisticas.index') }}">
                <li class="side-group-item {{ \Request::is('estatisticas') ? 'active' : '' }}">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>
                            <i class="fas fa-chart-bar fa-fw side-item-icon"></i>
                            <span>Estatísticas</span>
                        </span>
                    </div>
                </li>
            </a> --}}

            <a href="{{ route('catalogo') }}">
                <li class="side-group-item {{ \Request::is('catalogo') ? 'active' : '' }}">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>
                            <i class="fas fa-book-open fa-fw side-item-icon"></i>
                            <span>Catálogo</span>
                        </span>
                    </div>
                </li>
            </a>


            <a href="{{ route('hub.index') }}">
                <li class="side-group-item {{ \Request::is('hub') ? 'active' : '' }}">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>
                            <i class="fas fa-gamepad fa-fw side-item-icon"></i>
                            <span>Central de jogos</span>
                        </span>
                    </div>
                </li>
            </a>


            <a href="{{ route('agenda.index') }}">
                <li class="side-group-item {{ \Request::is('agenda') ? 'active' : '' }}">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>
                            <i class="fas fa-calendar-alt side-item-icon"></i>
                            <span>Agenda</span>
                        </span>
                    </div>
                </li>
            </a>


            <a href="{{ route('grade-aula.index', ['date' => date('Y-m-d'), 'turma' => 'todas']) }}">
                <li class="side-group-item {{ \Request::is('grade-de-aula/*') ? 'active' : '' }}">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>
                            <i class="fas fa-clock side-item-icon"></i>
                            <span>Grade de aula</span>
                        </span>
                    </div>
                </li>
            </a>


            <a href="{{ route('teste.listar') }}">
                <li class="side-group-item {{ \Request::is('teste-nivelamento') || \Request::is('teste-nivelamento/*') ? 'active' : '' }}">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>
                            <i class="fas fa-edit side-item-icon"></i>
                            <span>Teste de nivelamento</span>
                        </span>
                    </div>
                </li>
            </a>

            <a href="{{ route('habilidades.estatisticas.listar') }}">
                <li class="side-group-item {{ \Request::is('habilidades/estatisticas') || \Request::is('habilidades') ? 'active' : '' }}">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>
                            <i class="fas fa-chart-bar side-item-icon"></i>
                            <span>Estatísticas e habilidades</span>
                        </span>
                    </div>
                </li>
            </a>

            <a href="{{ route('perfil.recompensas') }}">
                <li class="side-group-item {{ \Request::is('perfil/recompensas') || \Request::is('perfil/desafios-concluidos') || \Request::is('perfil/conquistas') ? 'active' : '' }}">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>
                            <i class="fas fa-trophy side-item-icon"></i>
                            <span>Conquistas e recompensas</span>
                        </span>
                    </div>
                </li>
            </a>

            {{-- <a href="{{ route('playlists.listar') }}">
                <li class="side-group-item {{ \Request::is('playlists') || \Request::is('playlists/*') ? 'active' : '' }}">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>
                            <i class="fas fa-list-ul side-item-icon"></i>
                            <span>Playlists</span>
                        </span>
                    </div>
                </li>
            </a> --}}


            <a href="#divCollapseSalaDeEstudos" data-toggle="collapse" href="#divCollapseSalaDeEstudos" role="button"
            aria-expanded="false" aria-controls="divCollapseSalaDeEstudos">
                <li class="side-group-item">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>
                            <i class="fas fa-book fa-fw side-item-icon"></i>
                            <span>Sala de estudos</span>
                        </span>
                        <i class="fas fa-caret-down fa-lg"></i>
                    </div>
                </li>
            </a>

            <ul id="divCollapseSalaDeEstudos"
                class="side-sub-group collapse multi-collapse {{ \Request::is('biblioteca') || \Request::is('glossario/*') || \Request::is('artigos') || \Request::is('artigos/*') ? 'show' : '' }}">
                <a href="{{ route('artigos.index') }}">
                    <li class="side-sub-group-item {{ \Request::is('artigos') || \Request::is('artigos/*') ? 'active' : '' }}">
                        <span>Artigos</span>
                    </li>
                </a>
                <a href="{{ route('biblioteca') }}">
                    <li class="side-sub-group-item {{ \Request::is('biblioteca') ? 'active' : '' }}">
                        <span>Biblioteca</span>
                    </li>
                </a>
                <a href="{{ route('glossario.index') }}">
                    <li class="side-sub-group-item {{ \Request::is('glossario/*') ? 'active' : '' }}">
                        <span>Glossário</span>
                    </li>
                </a>
            </ul>

            <a href="#divCollapseComunidade" data-toggle="collapse" href="#divCollapseComunidade" role="button"
            aria-expanded="false"
            aria-controls="divCollapseComunidade">
                <li class="side-group-item">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>
                            <i class="fas fa-users fa-fw side-item-icon"></i>
                            <span>Comunidade</span>
                        </span>
                        <i class="fas fa-caret-down fa-lg"></i>
                    </div>
                </li>
            </a>

            <ul id="divCollapseComunidade"
                class="side-sub-group collapse multi-collapse {{ \Request::is('escola/*/mural') || \Request::is('turma/*') || \Request::is('professor/*/duvidas') || \Request::is('professor/*/duvida/*') || \Request::is('professor/*/duvidas/*') || \Request::is('duvidas/*') || \Request::is('canal-do-professor/*/*') ? 'show' : '' }}">

                <a href="{{ route('escola.mural', ['escola_id' => Auth::user()->escola_id]) }}">
                    <li class="side-sub-group-item {{ \Request::is('escola/*/mural') ? 'active' : '' }}">
                        <span>Mural da escola</span>
                    </li>
                </a>

                @if(App\AlunoTurma::where('user_id', '=', Auth::user()->id)->first() != null)
                    <a href="{{ route('turmas') }}">
                        <li class="side-sub-group-item {{ \Request::is('turma/*') ? 'active' : '' }}">
                            <span>Mural da turma</span>
                        </li>
                    </a>
                    @if(App\Turma::find( App\AlunoTurma::where('user_id', '=', Auth::user()->id)->first()->turma_id ) != null)
                        <a href="{{ route('professor.duvidas', ['idProfessor' => App\Turma::find( App\AlunoTurma::where('user_id', '=', Auth::user()->id)->first()->turma_id )->user_id]) }}">
                            <li class="side-sub-group-item {{ \Request::is('professor/*/duvidas') || \Request::is('professor/*/duvida/*') || \Request::is('professor/*/duvidas/*') || \Request::is('duvidas/*') ? 'active' : '' }}">
                                <span>Fale com o professor</span>
                            </li>
                        </a>
                    @endif
                @endif

                <a href="{{ route('canal-professor.index', 1) }}">
                    <li class="side-sub-group-item {{ \Request::is('canal-do-professor/*/*') ? 'active' : '' }}">
                        <span>Canal do professor</span>
                    </li>
                </a>
            </ul>

        </ul>

        <div id="divCodigoAula" class="">
            <div onclick="showCodigoAula()" class="btn bg-primary btn-block border-light">
                <span id="lblInserirCodigoAula" class="font-weight-bold my-2 text-truncate text-white">
                    <i class="fas fa-hashtag fa-fw side-item-icon"></i>
                    <span class="text-wrap">Inserir código da aula</span>
                </span>

                <form id="formInserirCodigoAula" class="d-none" action="{{ route('codigo-transmissao') }}" method="get">
                    <div class="input-group">
                        <input type="text" maxlength="15"
                            class="form-control font-weight-bold bg-transparent border-0 rounded-10 text-white text-uppercase mx-auto p-2"
                            required name="codigo" aria-describedby="helpId" placeholder="INSERIR CÓDIGO"
                            style="box-shadow: none;font-size: 14px;">
                        <div class="input-group-append bg-transparent rounded-10 text-secondary m-0">
                            <button type="submit"
                                    class="btn bg-transparent text-white font-weight-bold text-darkmode btn-block">
                                OK
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

    </div>

</nav>
