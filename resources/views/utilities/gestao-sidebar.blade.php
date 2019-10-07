<nav class="sidebar gestao-sidebar show">

    <div class="p-3 container-aplicacao d-flex justify-content-center align-items-center">
        <img src="{{ env("APP_URL") }}/images/logo-{{ HelperClass::getAplicacaoAtual() }}.svg" height="30" alt="">
    </div>

    <ul class="side-group">

        @if(strrpos(mb_strtoupper(Auth::user()->permissao, 'UTF-8'), "Z") !== false)
            <a href="{{ route('gestao.aplicacoes') }}">
                <li
                    class="side-group-item {{ Request::is('gestao/aplicacoes') || Request::is('gestao/aplicacoes/*') || Request::is('gestao/aplicacoes/*') ? 'active' : '' }}">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>
                            <span>Aplicações</span>
                        </span>
                    </div>
                </li>
            </a>
        @endif

        <a href="{{ route('gestao.cursos') }}">
            <li class="side-group-item {{ \Request::is('gestao/cursos') ? 'active' : '' }}">
                <div class="d-flex justify-content-between align-items-center">
                    <span>
                        <span>Cursos</span>
                    </span>
                </div>
            </li>
        </a>

        <a href="{{ route('gestao.trilhas.listar') }}">
            <li class="side-group-item {{ \Request::is('gestao/trilhas') ? 'active' : '' }}">
                <div class="d-flex justify-content-between align-items-center">
                    <span>
                        <span>Trilhas</span>
                    </span>
                </div>
            </li>
        </a>

        <a href="#divCollapsePortalCast" data-toggle="collapse" href="#divCollapsePortalCast" role="button"
           aria-expanded="false" aria-controls="divCollapsePortalCast">
            <li class="side-group-item">
                <div class="d-flex justify-content-between align-items-center">
                    <span>
                        <span>Portal Cast</span>
                    </span>
                    <i class="fas fa-caret-down fa-lg"></i>
                </div>
            </li>
        </a>

        <ul id="divCollapsePortalCast"
            class="side-sub-group collapse multi-collapse {{ \Request::is('gestao/albuns') || \Request::is('gestao/albuns/*') || \Request::is('gestao/audios') || \Request::is('gestao/roteiros') || \Request::is('gestao/playlists') || \Request::is('gestao/audios-interacoes') || \Request::is('gestao/audios-interacoes/*') ? 'show' : ''}}">

            <a href="{{ route('gestao.audios.listar') }}">
                <li class="side-sub-group-item {{ \Request::is('gestao/audios') ? 'active' : '' }}">
                    <span>Áudios</span>
                </li>
            </a>

            <a href="{{ route('gestao.audios-interacoes.listar') }}">
                <li class="side-sub-group-item {{ \Request::is('gestao/audios-interacoes') || \Request::is('gestao/audios-interacoes/*') ? 'active' : '' }}">
                    <span>Interações</span>
                </li>
            </a>

            <a href="{{ route('gestao.albuns.listar') }}">
                <li class="side-sub-group-item {{ \Request::is('gestao/albuns') || \Request::is('gestao/albuns/*') ? 'active' : '' }}">
                    <span>Álbuns</span>
                </li>
            </a>

            <a href="{{ route('gestao.playlists.listar') }}">
                <li class="side-sub-group-item {{\Request::is('gestao/playlists') ? 'active' : '' }}">
                    <span>Playlists</span>
                </li>
            </a>

            <a href="{{ route('gestao.roteiros.listar') }}">
                <li class="side-sub-group-item {{\Request::is('gestao/roteiros') ? 'active' : '' }}">
                    <span>Roteiros</span>
                </li>
            </a>

        </ul>


        <a href="{{ route('gestao.biblioteca') }}">
            <li class="side-group-item {{ \Request::is('gestao/biblioteca') ? 'active' : '' }}">
                <div class="d-flex justify-content-between align-items-center">
                    <span>
                        <span>Biblioteca</span>
                    </span>
                </div>
            </li>
        </a>

        <a href="#divCollapsePortalProfessor" data-toggle="collapse" href="#divCollapsePortalProfessor" role="button"
           aria-expanded="false" aria-controls="divCollapsePortalProfessor">
            <li class="side-group-item">
                <div class="d-flex justify-content-between align-items-center">
                    <span>
                        {{-- <i class="fas fa-book fa-fw side-item-icon"></i> --}}
                        <span>Portal do professor</span>
                    </span>
                    <i class="fas fa-caret-down fa-lg"></i>
                </div>
            </li>
        </a>

        <ul id="divCollapsePortalProfessor"
            class="side-sub-group collapse multi-collapse {{ \Request::is('gestao/artigos') || \Request::is('gestao/artigos/*') || \Request::is('gestao/cursos-professores') || \Request::is('gestao/banco-imagens') || \Request::is('gestao/ranking-professores') ? 'show' : '' }}">

            <a href="{{ route('gestao.artigos.index') }}">
                <li class="side-sub-group-item {{ \Request::is('gestao/artigos') || \Request::is('gestao/artigos/*') ? 'active' : '' }}">
                    <span>Artigos</span>
                </li>
            </a>
            <a href="{{ route('gestao.cursos-professores') }}">
                <li class="side-sub-group-item {{ \Request::is('gestao/cursos-professores') ? 'active' : '' }}">
                    <span>Cursos para professores</span>
                </li>
            </a>
            <a href="{{ route('gestao.ranking-professores') }}">
                <li class="side-sub-group-item {{ \Request::is('gestao/ranking-professores') ? 'active' : '' }}">
                    <span>Ranking</span>
                </li>
            </a>
            <a href="{{ route('gestao.banco-imagens.index') }}">
                <li class="side-sub-group-item {{ \Request::is('gestao/banco-imagens') ? 'active' : '' }}">
                    <span>Banco de imagens</span>
                </li>
            </a>

        </ul>

        <a href="{{ route('gestao.glossario.index') }}">
            <li
                class="side-group-item {{ \Request::is('gestao/glossario') || \Request::is('gestao/glossario/*') ? 'active' : '' }}">
                <div class="d-flex justify-content-between align-items-center">
                    <span>
                        <span>Glossário</span>
                    </span>
                </div>
            </li>
        </a>

        <a href="#divCollapseGamificacao" data-toggle="collapse" href="#divCollapseGamificacao" role="button"
           aria-expanded="false" aria-controls="divCollapseGamificacao">
            <li class="side-group-item">
                <div class="d-flex justify-content-between align-items-center">
                    <span>
                        <span>Portal de gamificação</span>
                    </span>
                    <i class="fas fa-caret-down fa-lg"></i>
                </div>
            </li>
        </a>

        <ul id="divCollapseGamificacao"
            class="side-sub-group collapse multi-collapse
                {{
                    \Request::is('gestao/missoes') || \Request::is('gestao/missoes/*') ||
                    \Request::is('gestao/desafios') || \Request::is('gestao/desafios/*') ||
                    \Request::is('gestao/conquistas') || \Request::is('gestao/conquistas/*') ||
                    \Request::is('gestao/recompensas-virtuais') || \Request::is('gestao/recompensas-virtuais/*') ||
                    \Request::is('gestao/recompensas-extra-jogo') || \Request::is('gestao/recompensas-extra-jogo/*') ||
                    \Request::is('gestao/badges') || \Request::is('gestao/badges/*') ||
                    \Request::is('gestao/habilidades') || \Request::is('gestao/habilidades/*') ||
                    \Request::is('gestao/gamificacao') || \Request::is('gestao/gamificacao/*')
                    ? 'show' : ''
                }}">

            <a href="{{ route('gestao.missoes.listar') }}">
                <li class="side-sub-group-item {{ \Request::is('gestao/missoes') || \Request::is('gestao/missoes/*') ? 'active' : '' }}">
                    <span>Missões</span>
                </li>
            </a>

            <a href="{{ route('gestao.desafios.listar') }}">
                <li class="side-sub-group-item {{ \Request::is('gestao/desafios') || \Request::is('gestao/desafios/*') ? 'active' : '' }}">
                    <span>Desafios</span>
                </li>
            </a>

            <a href="{{ route('gestao.conquistas.listar') }}">
                <li class="side-sub-group-item {{ \Request::is('gestao/conquistas') || \Request::is('gestao/conquistas/*') ? 'active' : '' }}">
                    <span>Conquistas</span>
                </li>
            </a>

            <a href="{{ route('gestao.recompensas-virtuais.listar') }}">
                <li class="side-sub-group-item {{ \Request::is('gestao/recompensas-virtuais') || \Request::is('gestao/recompensas-virtuais/*') ? 'active' : '' }}">
                    <span>Recompensas virtuais</span>
                </li>
            </a>

            <a href="{{ route('gestao.recompensas-extra-jogo.listar') }}">
                <li class="side-sub-group-item {{ \Request::is('gestao/recompensas-extra-jogo') || \Request::is('gestao/recompensas-extra-jogo/*') ? 'active' : '' }}">
                    <span>Recompensas extra-jogo</span>
                </li>
            </a>

            <a href="{{ route('gestao.badges.listar') }}">
                <li class="side-sub-group-item {{ \Request::is('gestao/badges') || \Request::is('gestao/badges/*') ? 'active' : '' }}">
                    <span>Medalhas</span>
                </li>
            </a>

            <a href="{{ route('gestao.habilidades.listar') }}">
                <li class="side-sub-group-item {{ \Request::is('gestao/habilidades') || \Request::is('gestao/habilidades/*') ? 'active' : '' }}">
                    <span>Habilidades</span>
                </li>
            </a>

            <a href="{{ route('gestao.gamificacao.index') }}">
                <li class="side-sub-group-item {{ \Request::is('gestao/gamificacao') || \Request::is('gestao/gamificacao/*') ? 'active' : '' }}">
                    <span>Configurações</span>
                </li>
            </a>

        </ul>

        <a href="{{ route('gestao.questoes.listar') }}">
            <li
                class="side-group-item {{ \Request::is('gestao/banco-de-questoes') || \Request::is('gestao/banco-de-questoes/*') ? 'active' : '' }}">
                <div class="d-flex justify-content-between align-items-center">
                    <span>
                        <span>Banco de questões</span>
                    </span>
                </div>
            </li>
        </a>

        <a href="{{ route('gestao.teste.listar') }}">
            <li
                class="side-group-item {{ \Request::is('gestao/teste-de-nivelamento') || \Request::is('gestao/teste-de-nivelamento/*') ? 'active' : '' }}">
                <div class="d-flex justify-content-between align-items-center">
                    <span>
                        <span>Teste de nivelamento</span>
                    </span>
                </div>
            </li>
        </a>

        <a href="{{ route('gestao.plano-aulas.listar') }}">
            <li
                class="side-group-item {{ \Request::is('gestao/plano-de-aulas') || \Request::is('gestao/plano-de-aulas/*') ? 'active' : '' }}">
                <div class="d-flex justify-content-between align-items-center">
                    <span>
                        <span>Plano de aulas</span>
                    </span>
                </div>
            </li>
        </a>


        <a href="{{ route('gestao.turmas') }}">
            <li class="side-group-item {{ Request::is('gestao/turmas') || Request::is('gestao/turma/*') ? 'active' : '' }}">
                <div class="d-flex justify-content-between align-items-center">
                    <span>
                        <span>Turmas</span>
                    </span>
                </div>
            </li>
        </a>

        <a href="{{ route('gestao.escola.mural', ['escola_id' => Auth::user()->escola_id]) }}">
            <li class="side-group-item {{ \Request::is('gestao/escola/*/mural') ? 'active' : '' }}">
                <div class="d-flex justify-content-between align-items-center">
                    <span>
                        <span>Mural da escola</span>
                    </span>
                </div>
            </li>
        </a>

        <a href="{{ route('gestao.escola.mural-gestao', ['escola_id' => Auth::user()->escola_id]) }}">
            <li class="side-group-item {{ \Request::is('gestao/escola/*/mural-gestao') ? 'active' : '' }}">
                <div class="d-flex justify-content-between align-items-center">
                    <span>
                        <span>Mural de gestão da escola</span>
                    </span>
                </div>
            </li>
        </a>

        <a href="{{ route('gestao.entregaveis') }}">
            <li class="side-group-item {{ Request::is('gestao/entregaveis') || Request::is('gestao/entregaveis/*') ? 'active' : '' }}">
                <div class="d-flex justify-content-between align-items-center">
                    <span>
                        <span>Entregáveis</span>
                    </span>
                </div>
            </li>
        </a>

        <a href="{{ route('gestao.professor.duvidas', ['idProfessor' => Auth::user()->id]) }}">
            <li class="side-group-item {{ Request::is('gestao/professor/*/duvidas') || Request::is('gestao/professor/*/duvida/*') ? 'active' : '' }}">
                <div class="d-flex justify-content-between align-items-center">
                    <span>
                        <span>Dúvidas de alunos</span>
                    </span>
                </div>
            </li>
        </a>

        <a href="{{ route('gestao.relatorios') }}">
            <li
                class="side-group-item {{ Request::is('gestao/relatorios') || Request::is('gestao/relatorios/*') ? 'active' : '' }}">
                <div class="d-flex justify-content-between align-items-center">
                    <span>
                        <span>Relatórios</span>
                    </span>
                </div>
            </li>
        </a>

        @if(strrpos(mb_strtoupper(Auth::user()->permissao, 'UTF-8'), "Z") !== false)

            <a href="{{ route('gestao.escolas') }}">
                <li
                    class="side-group-item {{ Request::is('gestao/escolas') || Request::is('gestao/escola/*/painel') ? 'active' : '' }}">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>
                            <span>Escolas</span>
                        </span>
                    </div>
                </li>
            </a>

            <a href="{{ route('gestao.usuarios') }}">
                <li class="side-group-item {{ \Request::is('gestao/usuarios') ? 'active' : '' }}">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>
                            <span>Usuários</span>
                        </span>
                    </div>
                </li>
            </a>

            <a href="{{ route('gestao.categorias') }}">
                <li class="side-group-item {{ \Request::is('gestao/categorias') ? 'active' : '' }}">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>
                            <span>Categorias</span>
                        </span>
                    </div>
                </li>
            </a>

            <a href="{{ route('gestao.ajuda.artigos') }}">
                <li class="side-group-item {{ \Request::is('gestao/ajuda/*') ? 'active' : '' }}">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>
                            <span>Ajuda / FAQ</span>
                        </span>
                    </div>
                </li>
            </a>

            <a href="{{ route('dashboard.doc.api.index') }}">
                <li class="side-group-item {{ \Request::is('dashboard/documentacao/api') ? 'active' : '' }}">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>
                            <span>Documentação API</span>
                        </span>
                    </div>
                </li>
            </a>
        @endif

    </ul>

</nav>
