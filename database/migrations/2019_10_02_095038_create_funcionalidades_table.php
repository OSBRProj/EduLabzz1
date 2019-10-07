<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Funcionalidade;

class CreateFuncionalidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funcionalidades', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descricao');
            $table->string('codigo');
            $table->timestamps();
        });

        $funcionalidades = [
            // MENU DE GESTÃO (MANAGER)
            ['descricao' => 'Gestão de aplicações', 'codigo' => 'manager.aplicacoes.consultar'],
            ['descricao' => 'Gestão de aplicações', 'codigo' => 'manager.aplicacoes.gravar'],
            // MENU/SUBMENU
            ['descricao' => 'Cards Creator', 'codigo' => 'manager.cards'],
            ['descricao' => 'Gestão de baralhos', 'codigo' => 'manager.cards.baralhos.consultar'],
            ['descricao' => 'Gestão de baralhos', 'codigo' => 'manager.cards.baralhos.gravar'],
            ['descricao' => 'Gestão de carreiras', 'codigo' => 'manager.cards.carreiras.consultar'],
            ['descricao' => 'Gestão de carreiras', 'codigo' => 'manager.cards.carreiras.gravar'],
            // MENU/SUBMENU (FIM)
            ['descricao' => 'Gestão de cursos', 'codigo' => 'manager.cursos.consultar'],
            ['descricao' => 'Gestão de cursos', 'codigo' => 'manager.cursos.gravar'],
            ['descricao' => 'Gestão de trilhas', 'codigo' => 'manager.trilhas.consultar'],
            ['descricao' => 'Gestão de trilhas', 'codigo' => 'manager.trilhas.gravar'],
            // MENU/SUBMENU
            ['descricao' => 'Cast Creator', 'codigo' => 'manager.cast'],
            ['descricao' => 'Gestão de áudios', 'codigo' => 'manager.cast.audios.consultar'],
            ['descricao' => 'Gestão de áudios', 'codigo' => 'manager.cast.audios.gravar'],
            ['descricao' => 'Gestão de álbuns', 'codigo' => 'manager.cast.albuns.consultar'],
            ['descricao' => 'Gestão de álbuns', 'codigo' => 'manager.cast.albuns.gravar'],
            ['descricao' => 'Gestão de playlists', 'codigo' => 'manager.cast.playlists.consultar'],
            ['descricao' => 'Gestão de playlists', 'codigo' => 'manager.cast.playlists.gravar'],
            ['descricao' => 'Gestão de roteiros', 'codigo' => 'manager.cast.roteiros.consultar'],
            ['descricao' => 'Gestão de roteiros', 'codigo' => 'manager.cast.roteiros.gravar'],
            // MENU/SUBMENU (FIM)
            ['descricao' => 'Gestão de conteúdo', 'codigo' => 'manager.biblioteca.consultar'],
            ['descricao' => 'Gestão de conteúdo', 'codigo' => 'manager.biblioteca.gravar'],
            // MENU/SUBMENU
            ['descricao' => 'Portal do professor', 'codigo' => 'manager.professores'],
            ['descricao' => 'Gestão de artigos', 'codigo' => 'manager.professores.artigos.consultar'],
            ['descricao' => 'Gestão de artigos', 'codigo' => 'manager.professores.artigos.gravar'],
            ['descricao' => 'Cursos para professores', 'codigo' => 'manager.professores.cursos.consultar'],
            ['descricao' => 'Cursos para professores', 'codigo' => 'manager.professores.cursos.gravar'],
            ['descricao' => 'Ranking professor', 'codigo' => 'manager.professores.ranking.consultar'],
            ['descricao' => 'Ranking professor', 'codigo' => 'manager.professores.ranking.gravar'],
            ['descricao' => 'Gestão do Banco de Imagens', 'codigo' => 'manager.professores.imagens.consultar'],
            ['descricao' => 'Gestão do Banco de Imagens', 'codigo' => 'manager.professores.imagens.gravar'],
            // MENU/SUBMENU (FIM)
            ['descricao' => 'Glossário', 'codigo' => 'manager.glossario.consultar'],
            ['descricao' => 'Glossário', 'codigo' => 'manager.glossario.gravar'],
            // MENU/SUBMENU
            ['descricao' => 'Portal de gamificação', 'codigo' => 'manager.gamificacao'],
            ['descricao' => 'Gestão de medalhas', 'codigo' => 'manager.gamificacao.medalhas.consultar'],
            ['descricao' => 'Gestão de medalhas', 'codigo' => 'manager.gamificacao.medalhas.gravar'],
            ['descricao' => 'Gestão de habilidades', 'codigo' => 'manager.gamificacao.habilidades.consultar'],
            ['descricao' => 'Gestão de habilidades', 'codigo' => 'manager.gamificacao.habilidades.gravar'],
            ['descricao' => 'Gestão de configurações', 'codigo' => 'manager.gamificacao.configuracoes.consultar'],
            ['descricao' => 'Gestão de configurações', 'codigo' => 'manager.gamificacao.configuracoes.gravar'],
            // MENU/SUBMENU (FIM)
            ['descricao' => 'Gestão dos testes de nivelamento', 'codigo' => 'manager.nivelamento.consultar'],
            ['descricao' => 'Gestão dos testes de nivelamento', 'codigo' => 'manager.nivelamento.gravar'],
            ['descricao' => 'Gestão do plano de aulas', 'codigo' => 'manager.plano.consultar'],
            ['descricao' => 'Gestão do plano de aulas', 'codigo' => 'manager.plano.gravar'],
            ['descricao' => 'Gestão de turmas', 'codigo' => 'manager.turmas.consultar'],
            ['descricao' => 'Gestão de turmas', 'codigo' => 'manager.turmas.gravar'],
            ['descricao' => 'Mural da escola', 'codigo' => 'manager.mural.escola.consultar'],
            ['descricao' => 'Mural da escola', 'codigo' => 'manager.mural.escola.gravar'],
            ['descricao' => 'Mural da gestão da escola', 'codigo' => 'manager.mural.manager.consultar'],
            ['descricao' => 'Mural da gestão da escola', 'codigo' => 'manager.mural.manager.gravar'],
            ['descricao' => 'Relatórios', 'codigo' => 'manager.relatorios.consultar'],
            ['descricao' => 'Relatórios', 'codigo' => 'manager.relatorios.gravar'],
            ['descricao' => 'Gestão de escolas', 'codigo' => 'manager.escolas.consultar'],
            ['descricao' => 'Gestão de escolas', 'codigo' => 'manager.escolas.gravar'],
            ['descricao' => 'Gestão de usuários', 'codigo' => 'manager.usuarios.consultar'],
            ['descricao' => 'Gestão de usuários', 'codigo' => 'manager.usuarios.gravar'],
            ['descricao' => 'Gestão de categorias', 'codigo' => 'manager.categorias.consultar'],
            ['descricao' => 'Gestão de categorias', 'codigo' => 'manager.categorias.gravar'],
            ['descricao' => 'Gestão financeira', 'codigo' => 'manager.financeiro.consultar'],
            ['descricao' => 'Gestão financeira', 'codigo' => 'manager.financeiro.gravar'],
            ['descricao' => 'Ajuda / FAQ', 'codigo' => 'manager.faq.consultar'],
            ['descricao' => 'Ajuda / FAQ', 'codigo' => 'manager.faq.gravar'],
            ['descricao' => 'Funcionalidades', 'codigo' => 'manager.funcionalidade.consultar'],
            ['descricao' => 'Funcionalidades', 'codigo' => 'manager.funcionalidade.gravar'],
            ['descricao' => 'Plataforma', 'codigo' => 'manager.plataforma.consultar'],
            ['descricao' => 'Plataforma', 'codigo' => 'manager.plataforma.gravar'],
            ['descricao' => 'Documentação API', 'codigo' => 'manager.documentacao.consultar'],
            ['descricao' => 'Documentação API', 'codigo' => 'manager.documentacao.gravar'],
            // FIM MENU GESTÃO

            // MENU DE PROFESSOR (MASTER)
            ['descricao' => 'Gestão de cursos', 'codigo' => 'master.cursos.consultar'],
            ['descricao' => 'Gestão de cursos', 'codigo' => 'master.cursos.gravar'],
            ['descricao' => 'Gestão de trilhas', 'codigo' => 'master.trilhas.consultar'],
            ['descricao' => 'Gestão de trilhas', 'codigo' => 'master.trilhas.gravar'],
            // MENU/SUBMENU
            ['descricao' => 'Cards Creator', 'codigo' => 'master.cards'],
            ['descricao' => 'Gestão de baralhos', 'codigo' => 'master.cards.baralhos.consultar'],
            ['descricao' => 'Gestão de baralhos', 'codigo' => 'master.cards.baralhos.gravar'],
            ['descricao' => 'Gestão de carreiras', 'codigo' => 'master.cards.carreiras.consultar'],
            ['descricao' => 'Gestão de carreiras', 'codigo' => 'master.cards.carreiras.gravar'],
            // MENU/SUBMENU (FIM)
            // MENU/SUBMENU
            ['descricao' => 'Cast Creator', 'codigo' => 'master.cast'],
            ['descricao' => 'Gestão de áudios', 'codigo' => 'master.cast.audios.consultar'],
            ['descricao' => 'Gestão de áudios', 'codigo' => 'master.cast.audios.gravar'],
            ['descricao' => 'Gestão de álbuns', 'codigo' => 'master.cast.albuns.consultar'],
            ['descricao' => 'Gestão de álbuns', 'codigo' => 'master.cast.albuns.gravar'],
            ['descricao' => 'Gestão de playlists', 'codigo' => 'master.cast.playlists.consultar'],
            ['descricao' => 'Gestão de playlists', 'codigo' => 'master.cast.playlists.gravar'],
            ['descricao' => 'Gestão de roteiros', 'codigo' => 'master.cast.roteiros.consultar'],
            ['descricao' => 'Gestão de roteiros', 'codigo' => 'master.cast.roteiros.gravar'],
            // MENU/SUBMENU (FIM)
            ['descricao' => 'Gestão de conteúdo', 'codigo' => 'master.biblioteca.consultar'],
            ['descricao' => 'Gestão de conteúdo', 'codigo' => 'master.biblioteca.gravar'],
            // MENU/SUBMENU
            ['descricao' => 'Portal do professor', 'codigo' => 'master.professores'],
            ['descricao' => 'Gestão de artigos', 'codigo' => 'master.professores.artigos.consultar'],
            ['descricao' => 'Gestão de artigos', 'codigo' => 'master.professores.artigos.gravar'],
            ['descricao' => 'Cursos para professores', 'codigo' => 'master.professores.cursos.consultar'],
            ['descricao' => 'Cursos para professores', 'codigo' => 'master.professores.cursos.gravar'],
            ['descricao' => 'Ranking professor', 'codigo' => 'master.professores.ranking.consultar'],
            ['descricao' => 'Ranking professor', 'codigo' => 'master.professores.ranking.gravar'],
            ['descricao' => 'Gestão do Banco de Imagens', 'codigo' => 'master.professores.imagens.consultar'],
            ['descricao' => 'Gestão do Banco de Imagens', 'codigo' => 'master.professores.imagens.gravar'],
            // MENU/SUBMENU (FIM)
            ['descricao' => 'Glossário', 'codigo' => 'master.glossario.consultar'],
            ['descricao' => 'Glossário', 'codigo' => 'master.glossario.gravar'],
            // MENU/SUBMENU
            ['descricao' => 'Portal de gamificação', 'codigo' => 'master.gamificacao'],
            ['descricao' => 'Gestão de medalhas', 'codigo' => 'master.gamificacao.medalhas.consultar'],
            ['descricao' => 'Gestão de medalhas', 'codigo' => 'master.gamificacao.medalhas.gravar'],
            ['descricao' => 'Gestão de habilidades', 'codigo' => 'master.gamificacao.habilidades.consultar'],
            ['descricao' => 'Gestão de habilidades', 'codigo' => 'master.gamificacao.habilidades.gravar'],
            ['descricao' => 'Gestão de configurações', 'codigo' => 'master.gamificacao.configuracoes.consultar'],
            ['descricao' => 'Gestão de configurações', 'codigo' => 'master.gamificacao.configuracoes.gravar'],
            // MENU/SUBMENU (FIM)
            ['descricao' => 'Gestão dos testes de nivelamento', 'codigo' => 'master.nivelamento.consultar'],
            ['descricao' => 'Gestão dos testes de nivelamento', 'codigo' => 'master.nivelamento.gravar'],
            ['descricao' => 'Gestão do plano de aulas', 'codigo' => 'master.plano.consultar'],
            ['descricao' => 'Gestão do plano de aulas', 'codigo' => 'master.plano.gravar'],
            ['descricao' => 'Gestão de turmas', 'codigo' => 'master.turmas.consultar'],
            ['descricao' => 'Gestão de turmas', 'codigo' => 'master.turmas.gravar'],
            ['descricao' => 'Mural da escola', 'codigo' => 'master.mural.escola.consultar'],
            ['descricao' => 'Mural da escola', 'codigo' => 'master.mural.escola.gravar'],
            ['descricao' => 'Mural da gestão da escola', 'codigo' => 'master.mural.manager.consultar'],
            ['descricao' => 'Mural da gestão da escola', 'codigo' => 'master.mural.manager.gravar'],
            ['descricao' => 'Entregáveis', 'codigo' => 'master.entregaveis.consultar'],
            ['descricao' => 'Entregáveis', 'codigo' => 'master.entregaveis.gravar'],
            ['descricao' => 'Dúvidas de alunos', 'codigo' => 'master.alunos.duvidas.consultar'],
            ['descricao' => 'Dúvidas de alunos', 'codigo' => 'master.alunos.duvidas.gravar'],
            ['descricao' => 'Relatórios', 'codigo' => 'master.relatorios.consultar'],
            ['descricao' => 'Relatórios', 'codigo' => 'master.relatorios.gravar'],
            // FIM MENU PROFESSOR

            // MENU ALUNO
            ['descricao' => 'Home do aluno', 'codigo' => 'play.home.consultar'],
            ['descricao' => 'Home do aluno', 'codigo' => 'play.home.gravar'],
            ['descricao' => 'Central de jogos', 'codigo' => 'play.jogos.consultar'],
            ['descricao' => 'Agenda do aluno', 'codigo' => 'play.agenda.consultar'],
            ['descricao' => 'Agenda do aluno', 'codigo' => 'play.agenda.gravar'],
            ['descricao' => 'Grade de aula', 'codigo' => 'play.grade.consultar'],
            ['descricao' => 'Grade de aula', 'codigo' => 'play.grade.gravar'],
            ['descricao' => 'Trilhas do aluno', 'codigo' => 'play.trilhas.consultar'],
            ['descricao' => 'Trilhas do aluno', 'codigo' => 'play.trilhas.gravar'],
            ['descricao' => 'Teste de nivelamento', 'codigo' => 'play.nivelamento.consultar'],
            ['descricao' => 'Teste de nivelamento', 'codigo' => 'play.nivelamento.gravar'],
            ['descricao' => 'Estatíscias e habilidades', 'codigo' => 'play.estatisca.consultar'],
            ['descricao' => 'Estatíscias e habilidades', 'codigo' => 'play.estatisca.gravar'],
            ['descricao' => 'Conquistas e recompensas', 'codigo' => 'play.conquistas.consultar'],
            ['descricao' => 'Conquistas e recompensas', 'codigo' => 'play.conquistas.gravar'],
            //MENU/SUBMENU
            ['descricao' => 'Sala de estudos', 'codigo' => 'play.estudos'],
            ['descricao' => 'Artigos do aluno', 'codigo' => 'play.estudos.artigos.consultar'],
            ['descricao' => 'Artigos do aluno', 'codigo' => 'play.estudos.artigos.gravar'],
            ['descricao' => 'Biblioteca do aluno', 'codigo' => 'play.estudos.biblioteca.consultar'],
            ['descricao' => 'Biblioteca do aluno', 'codigo' => 'play.estudos.biblioteca.gravar'],
            ['descricao' => 'Glossário do aluno', 'codigo' => 'play.estudos.glossario.consultar'],
            ['descricao' => 'Glossário do aluno', 'codigo' => 'play.estudos.glossario.gravar'],
            //MENU/SUBMENU (FIM)
            //MENU/SUBMENU
            ['descricao' => 'Comunidade', 'codigo' => 'play.comunidade.'],
            ['descricao' => 'Mural da escola (aluno)', 'codigo' => 'play.comunidade.escola.consultar'],
            ['descricao' => 'Mural da escola (aluno)', 'codigo' => 'play.comunidade.escola.gravar'],
            ['descricao' => 'Mural da turma (aluno)', 'codigo' => 'play.comunidade.turma.consultar'],
            ['descricao' => 'Mural da turma (aluno)', 'codigo' => 'play.comunidade.turma.gravar'],
            ['descricao' => 'Fale com o professor', 'codigo' => 'play.comunidade.professor.consultar'],
            ['descricao' => 'Fale com o professor', 'codigo' => 'play.comunidade.professor.gravar'],
            ['descricao' => 'Canal do professor', 'codigo' => 'play.comunidade.canal.professor.consultar'],
            ['descricao' => 'Canal do professor', 'codigo' => 'play.comunidade.canal.professor.gravar'],
            //MENU/SUBMENU (FIM)
            //FIM MENU ALUNO

            // MENU NAV BAR
            ['descricao' => 'Gestão', 'codigo' => 'navbar.manager.consultar'],
            ['descricao' => 'Configurações', 'codigo' => 'navbar.configuracoes.consultar'],
            ['descricao' => 'Ajuda', 'codigo' => 'navbar.ajuda']
            //FIM MENU NAV BAR
        ];

        foreach ($funcionalidades as $funcionalidade) {
            Funcionalidade::create([
                'descricao' => $funcionalidade['descricao'],
                'codigo' => $funcionalidade['codigo']
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('funcionalidades');
    }
}
