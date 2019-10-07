<div id="divSideMenu" class="side-menu col-12 col-sm-3 col-lg-2 pt-4 px-0 mr-0" style="box-shadow: 6px 0px 6px -3px rgba(0,0,0,0.16);z-index: 3;margin-left: 0px;transition: 0.3s all ease-in-out; min-height: calc(100vh - 114px); background-color: #FFFFFF;">

    <div class="list-group list-group-flush">
        {{--  <div class="list-group-item text-lightgray text-uppercase font-weight-bold" style="border-top: 0px;">
            {{ Request::is('dashboard/*') ? 'Modo Admin' : 'Modo Gestor' }}
        </div>  --}}


        <a href="{{ route('gestao.biblioteca') }}" class="list-group-item list-group-item-action {{ Request::is('gestao/biblioteca') ? 'active' : '' }}">
            Biblioteca
        </a>
        <a href="{{ route('gestao.glossario.index') }}" class="list-group-item list-group-item-action {{ Request::is('gestao/glossario') ? 'active' : '' }}">
            Glossário
        </a>

        {{--  <a href="{{ route('gestao.relatorios') }}" class="list-group-item list-group-item-action {{ Request::is('gestao/relatorios') ? 'active' : '' }}">
            Relatórios
        </a>          --}}

        <a href="{{ route('gestao.turmas') }}" class="list-group-item list-group-item-action {{ Request::is('gestao/turmas') || Request::is('gestao/turma/*') ? 'active' : '' }}">
            Turmas
        </a>

        @if(strrpos(mb_strtoupper(Auth::user()->permissao, 'UTF-8'), "Z") !== false)
            <a href="{{ route('gestao.escolas') }}" class="list-group-item list-group-item-action {{ Request::is('gestao/escolas') || Request::is('gestao/escolas/*') || Request::is('gestao/escola/*') ? 'active' : '' }}">
                Escolas
            </a>
            <a href="{{ route('gestao.categorias') }}" class="list-group-item list-group-item-action {{ Request::is('gestao/categorias') ? 'active' : '' }}">
                Categorias
            </a>
            <a href="{{ route('dashboard.usuarios') }}" class="list-group-item list-group-item-action {{ Request::is('dashboard/usuarios') ? 'active' : '' }}">
                Usuários
            </a>
        @endif

        {{-- <a href="#" class="list-group-item list-group-item-action ">
            Configurações
        </a> --}}
    </div>

</div>
