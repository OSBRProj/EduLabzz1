<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Input;

use Illuminate\Http\Request;

use App\User;

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

\Carbon\Carbon::setLocale('pt_BR');

// Rotas de autenticação
Auth::routes();

// Conteudo
//Aqui fora para funciona com o powerpoint e google docs
Route::get('play/conteudo/{idConteudo}/arquivo', 'ConteudoController@playGetArquivo')->name('conteudo.play.get-arquivo');

//Aqui fora para funciona com o powerpoint e google docs
Route::get('/play/{idCurso}/conteudo/{idAula}/{idConteudo}/arquivo', 'CursoController@playGetArquivo')->name('curso.play.get-arquivo');


// Area de visitantes
Route::group([], function() {

    Route::get('catalogo', 'CatalogoController@index')->name('catalogo');

    // Hub de aplicações
    Route::group(['prefix' => 'hub', 'as' => 'hub.'], function () {
        // Movido para area de visitante
        Route::get('', 'HubController@index')->name('index');

        Route::get('home', 'HubController@index')->name('home');

        Route::get('aplicacao/{idAplicacao}', 'HubController@aplicacao')->name('aplicacao');
    });

});



// Global auth
Route::middleware(['auth'])->group(function () {

    //Notificacao
    Route::get('notificacao/{idNotificacao}/excluir', 'NotificacaoController@excluirNotificacao')->name('notificacao.excluir');

    // Estatisticas aluno
    Route::prefix('estatisticas')->group(function () {
        Route::get('', 'Estatisticas\Alunos\EstatisticasController@index')->name('estatisticas.index');

        Route::get('', 'Estatisticas\Alunos\EstatisticasController@index')->name('estatisticas.index');
    });

    // Ranking
    Route::prefix('ranking')->group(function () {
        Route::get('', 'Ranking\Alunos\RankingController@index')->name('ranking.index');
    });


    // Plano de aulas
    Route::prefix('plano-de-aulas')->group(function () {
        Route::get('/{idPlano}', 'PlanoAulas\Alunos\PlanoAulasController@index')->name('plano.aulas.index');
    });


    // Plano de estudos
    Route::prefix('plano-de-estudos')->group(function () {
        Route::get('/', 'PlanoEstudos\Alunos\PlanoEstudosController@index')->name('plano.estudos.index');
    });


    // lista de favoritos
    Route::prefix('favoritos')->group(function () {
        Route::get('/', 'Favoritos\Alunos\FavoritosController@index')->name('favoritos.index');
        Route::get('/adiciona/{idRef}/{tipo}', 'Favoritos\Alunos\FavoritosController@adiciona')->name('favoritos.adiciona');
        Route::post('/pesquisar', 'Favoritos\Alunos\FavoritosController@search')->name('favoritos.search');
    });


    // historico
    Route::prefix('historico')->group(function () {
        Route::get('/', 'Historico\Alunos\HistoricoController@index')->name('historico.index');
        Route::post('/pesquisar', 'Historico\Alunos\HistoricoController@search')->name('historico.search');
    });

    //Catalogo
    Route::prefix('catalogo')->group(function () {
        Route::get('2', 'Catalogo\Alunos\CatalogoController@index')->name('catalogo');
    });


    //Grade de aula
    Route::prefix('grade-de-aula')->group(function () {
        Route::get('data/{date}/turma/{turma}', 'GradeAula\Alunos\GradeAulaController@index')->name('grade-aula.index');
    });


    //Home, catalogo e curso

    Route::get('/', 'HomeController@index')->name('index');

    Route::get('/home', 'Estatisticas\Alunos\EstatisticasController@index')->name('home');

    // Route::get('/home', 'BibliotecaController@index')->name('home');



    Route::get('/biblioteca', 'BibliotecaController@index')->name('biblioteca');

    // Aplicações
    Route::get('/aplicacao/ultima', 'AplicacaoController@ultimaAplicacao')->name('aplicacao-ultima');

    Route::get('/aplicacao/ultima/play', 'AplicacaoController@playUltimaAplicacao')->name('aplicacao-ultima-play');

    Route::get('/aplicacao/{idAplicacao}', 'AplicacaoController@index')->name('aplicacao');

    Route::get('/aplicacao/{idAplicacao}/play', 'AplicacaoController@playAplicacao')->name('aplicacao-play');

    // Hub de aplicações
    Route::group(['prefix' => 'hub', 'as' => 'hub.'], function () {
        // Movido para area de visitante
        // Route::get('', 'HubController@index')->name('index');

        // Route::get('/home', 'HubController@index')->name('home');

        Route::get('/aplicacao/ultima', 'HubController@ultimaAplicacao')->name('aplicacao-ultima');

        Route::get('/aplicacao/ultima/play', 'HubController@playUltimaAplicacao')->name('aplicacao-ultima-play');

        // Route::get('/aplicacao/{idAplicacao}', 'HubController@aplicacao')->name('aplicacao');

        Route::get('/aplicacao/{idAplicacao}/play', 'HubController@playAplicacao')->name('aplicacao-play');
    });


    // Glossario
    Route::prefix('glossario')->group(function () {

        //Home
        Route::get('', function () {
            return redirect()->route('glossario.palavra', ['word' => 'A']);
        })->name('glossario.index');

        // User
        Route::get('{word}', 'Glossario\Front\GlossarioController@index')->name('glossario.palavra');

        Route::post('busca', 'Glossario\Front\GlossarioController@search')->name('glossario.search');
    });

    // Habilidades
    Route::prefix('habilidades')->group(function () {
        Route::get('/', 'Habilidades\Alunos\HabilidadesController@index')->name('habilidades.listar');
        Route::get('/estatisticas', 'Habilidades\Alunos\HabilidadesController@estatisticas')->name('habilidades.estatisticas.listar');
    });

    // Agenda
    Route::group(['prefix' => 'agenda', 'as' => 'agenda.'], function () {
        Route::get('/', 'Agenda\AgendaController@index')->name('index');
        Route::post('cadastro', 'Agenda\AgendaController@store')->name('cadastro');
        Route::post('atualizar', 'Agenda\AgendaController@update')->name('atualizar');
        Route::post('deletar', 'Agenda\AgendaController@delete')->name('deletar');
        Route::get('filtrar/{idTurma}/mesclar/{mesclar}', 'Agenda\AgendaController@filterCalendar')->name('filtrar');
    });

    // Teste nivelamento
    Route::group(['prefix' => 'teste-nivelamento', 'as' => 'teste.'], function () {
        Route::get('', 'TesteNivelamento\Aluno\TesteNivelamentoController@index')->name('listar');
        Route::get('{idTeste}/exibe', 'TesteNivelamento\Aluno\TesteNivelamentoController@show')->name('exibe');
        Route::get('{idTeste}/questao/{idQuestao}/{resultadoId}/exibe', 'TesteNivelamento\Aluno\TesteNivelamentoController@getQuestao')->name('questao.exibe');
        Route::post('cadastro/questoes', 'TesteNivelamento\Aluno\TesteNivelamentoController@cadastroQuestoes')->name('questao.cadastro');
        Route::get('expira/update/{id}', 'TesteNivelamento\Aluno\TesteNivelamentoController@expiraUpdateAjax')->name('expira.update');
        Route::get('finalizado/{id}', 'TesteNivelamento\Aluno\TesteNivelamentoController@finalizado')->name('finalizado');
    });

    Route::get('/codigo', 'CodigoTransmissaoController@index')->name('codigo-transmissao');

    Route::get('/codigo/{token}', 'CodigoTransmissaoController@token')->name('codigo-transmissao-token');

    // User perfil
    Route::get('perfil-incompleto', 'UserController@perfilIncompleto')->name('perfil-incompleto');

    Route::post('perfil-incompleto/salvar', 'UserController@postPerfilIncompleto')->name('perfil-incompleto-salvar');

    //Player de conteudo
    Route::get('/play/conteudo/{idConteudo}', 'ConteudoController@playConteudo')->name('conteudo.play');

    Route::post('/play/conteudo/{idConteudo}/interacao/enviar', 'ConteudoController@postEnviarInteracaoConteudo')->name('conteudo.play.enviar-interacao-conteudo');

    Route::post('/play/conteudo/{idConteudo}/avaliacao/enviar', 'ConteudoController@postEnviarAvaliacaoConteudo')->name('conteudo.play.enviar-avaliacao-conteudo');

    Route::post('/play/conteudo/{idConteudo}/comentario/enviar', 'ConteudoController@postEnviarComentarioConteudo')->name('conteudo.play.enviar-comentario-conteudo');

    // Route::post('/leitor', 'ConteudoController@postEnviarComentarioConteudo')->name('conteudo.play.enviar-comentario-conteudo');


    //
    // Rotas para leitor de apostila
    //
    // Rotas de anotação e marcador de página
    //

    Route::get('/leitor_apostila/{conteudo_id}', 'ApostilaController@index')->name('leitor-apostila');

    Route::post('/play/conteudo/{conteudo_id}/anotacao/nova', 'Anotacao\AnotacaoController@nova')->name('conteudo.anotacao.nova');

    Route::get('/play/conteudo/{conteudo_id}/anotacao/{anotacao_id}/deletar', 'Anotacao\AnotacaoController@deletar')->name('conteudo.anotacao.deletar');

    Route::get('/play/conteudo/{conteudo_id}/pagina-marcada', 'MarcadorPagina\MarcadorPaginaController@paginaMarcada')->name('conteudo.pagina-marcada');

    Route::get('/play/conteudo/{conteudo_id}/marcar-pagina/{paginaAtual}', 'MarcadorPagina\MarcadorPaginaController@marcarPagina')->name('conteudo.marcar-pagina');

    Route::get('/play/conteudo/{conteudo_id}/marcador/{pagina}/deletar', 'MarcadorPagina\MarcadorPaginaController@deletarMarcador')->name('conteudo.marcador.deletar');


    // Cursos
    Route::get('curso/{idCurso}', 'CursoController@index')->name('curso');

    Route::get('curso/{idCurso}/trancado', 'CursoController@cursoTrancado')->name('curso.trancado');

    Route::post('curso/{idCurso}/trancado/acessar', 'CursoController@postAcessarCursoTrancado')->name('curso.trancado-acessar');

    Route::get('painel/certificado/{idCurso}', 'PainelController@getCertificado')->name('painel.certificado');

    // Forum do curso / Topicos do curso

    Route::get('curso/{curso_id}/topicos', 'TopicoCursoController@index')->name('curso.topicos');

    Route::post('curso/{curso_id}/topico/enviar', 'TopicoCursoController@postNovoTopico')->name('curso.topico-enviar');

    Route::get('curso/{curso_id}/topico/{topico_curso_id}/comentarios', 'TopicoCursoController@topico')->name('curso.topico-respostas');

    Route::post('curso/{curso_id}/topico/{topico_curso_id}/atualizar', 'TopicoCursoController@postAtualizarTopico')->name('curso.topico-atualizar');

    Route::post('curso/{curso_id}/topico/{topico_curso_id}/excluir', 'TopicoCursoController@postExcluirTopico')->name('curso.topico-excluir');

    Route::post('curso/{curso_id}/topico/{topico_curso_id}/comentario/enviar', 'TopicoCursoController@postEnviarComentarioTopico')->name('curso.topico-comentario-enviar');

    Route::post('curso/{curso_id}/topico/{topico_curso_id}/comentario/{idComentario}/excluir', 'TopicoCursoController@postExcluirComentarioTopico')->name('curso.topico-comentario-excluir');

    //Player de curso
    Route::get('/play/{idCurso}', 'CursoController@playCurso')->name('curso.play');

    Route::post('/play/{idCurso}/avalicao/enviar', 'CursoController@postEnviarAvaliacaoCurso')->name('curso.play.enviar-avaliacao-curso');

    Route::post('/play/{idCurso}/professor/avalicao/enviar', 'CursoController@postEnviarAvaliacaoProfessor')->name('curso.play.enviar-avaliacao-professor');

    Route::post('/play/{idCurso}/escola/avaliacao/enviar', 'CursoController@postEnviarAvaliacaoEscola')->name('curso.play.enviar-avaliacao-escola');

    // Route::get('/play/{idCurso}/conteudo/{idAula}/{idConteudo}/arquivo', 'CursoController@playGetArquivo')->name('curso.play.get-arquivo');

    Route::get('/play/{idCurso}/conteudo/{idAula}', 'CursoController@playGetAula')->name('curso.play.get-aula');

    Route::get('/play/{idCurso}/conteudo/{idAula}/{idConteudo}', 'CursoController@playGetConteudo')->name('curso.play.get-conteudo');

    Route::get('/play/{idCurso}/conteudo/{idAula}/{idConteudo}/proximo', 'CursoController@playGetProximoConteudo')->name('curso.play.get-proximo-conteudo');

    Route::post('/play/{idCurso}/{idAula}/{idConteudo}/avaliacao/enviar', 'CursoController@postEnviarAvaliacaoConteudo')->name('curso.play.enviar-avaliacao-conteudo');

    Route::post('/play/{idCurso}/{idAula}/{idConteudo}/comentario/enviar', 'CursoController@postEnviarComentarioConteudo')->name('curso.play.enviar-comentario-conteudo');

    Route::get('/play/{idCurso}/{idAula}/{idConteudo}/mensagens', 'CursoController@getMensagensTransmissao')->name('curso.play.mensagens-transmissao');

    Route::post('/play/{idCurso}/{idAula}/{idConteudo}/mensagem/enviar', 'CursoController@postEnviarMensagemTransmissao')->name('curso.play.enviar-mensagem-transmissao');

    Route::get('/play/{idCurso}/{idAula}/{idConteudo}/comentario/{idComentario}/excluir', 'CursoController@getExcluirComentarioConteudo')->name('curso.play.excluir-comentario-conteudo');

    Route::post('/play/{idCurso}/{idAula}/{idConteudo}/enviar/resposta', 'CursoController@postEnviarResposta')->name('curso.play.enviar-resposta');

    Route::post('/play/{idCurso}/{idAula}/{idConteudo}/enviar/entregavel', 'CursoController@postEnviarEntregavel')->name('curso.play.enviar-entregavel');

    // Matricula do curso
    Route::get('curso/{idCurso}/matricular', 'CursoController@matricular')->name('curso.matricular');

    //Certificado do curso
    Route::get('curso/{idCurso}/certificado', 'CursoController@getCertificado')->name('curso.certificado');

    //Turmas
    Route::get('turmas', 'TurmaController@index')->name('turmas');

    Route::post('turmas/sair', 'TurmaController@postSairTurma')->name('turma-sair');

    Route::get('turma/{idTurma}/mural', 'TurmaController@muralTurma')->name('turma-mural');

    Route::get('turma/{idTurma}/mural/grade', 'TurmaController@gradeAulas')->name('turma-grade-aulas');

    Route::post('turma/{idTurma}/mural/postar', 'TurmaController@postarMuralTurma')->name('turma-mural-postar');

    Route::get('turma/{idTurma}/mural/convite/{idConvite}', 'TurmaController@getConvite')->name('turma-convite');

    Route::get('turma/{idTurma}/mural/postagem/{idPostagem}/arquivo', 'TurmaController@getArquivo')->name('turma-postagem-arquivo');

    Route::post('turma/{idTurma}/mural/postagem/{idPostagem}/excluir', 'TurmaController@postExcluirPostagem')->name('turma-postagem-excluir');

    Route::post('turma/{idTurma}/mural/postagem/{idPostagem}/comentario/enviar', 'TurmaController@postEnviarComentarioPostagem')->name('turma-postagem-comentario-enviar');

    Route::post('turma/{idTurma}/mural/postagem/{idPostagem}/comentario/{idComentario}/excluir', 'TurmaController@postExcluirComentarioPostagem')->name('turma-postagem-comentario-excluir');

    // Mural Escola

    Route::get('escola/{escola_id}/mural', 'EscolaController@muralEscola')->name('escola.mural');

    Route::post('escola/{escola_id}/mural/postar', 'EscolaController@postarMuralEscola')->name('escola.mural-postar');

    Route::get('escola/{escola_id}/mural/postagem/{postagem_id}/arquivo', 'EscolaController@getArquivo')->name('escola.mural-postagem-arquivo');

    Route::post('escola/{escola_id}/mural/postagem/{postagem_id}/excluir', 'EscolaController@postExcluirPostagem')->name('escola.mural-postagem-excluir');

    Route::post('escola/{escola_id}/mural/postagem/{postagem_id}/comentario/enviar', 'EscolaController@postEnviarComentarioPostagem')->name('escola.mural-postagem-comentario-enviar');

    Route::post('escola/{escola_id}/mural/postagem/{postagem_id}/comentario/{idComentario}/excluir', 'EscolaController@postExcluirComentarioPostagem')->name('escola.mural-postagem-comentario-excluir');


    //Canal Professor
    Route::group(['prefix' => 'canal-do-professor', 'as' => 'canal-professor.'], function () {
        Route::get('/{idProfessor}/canal', 'CanalProfessor\CanalProfessorController@index')->name('index');
        Route::get('/{idProfessor}/biblioteca', 'CanalProfessor\CanalProfessorController@biblioteca')->name('biblioteca');
        Route::get('/{idProfessor}/avaliacoes', 'CanalProfessor\CanalProfessorController@avaliacoes')->name('avaliacoes');

        Route::get('/{idProfessor}/duvidas', 'CanalProfessor\CanalProfessorController@duvidas')->name('duvidas');
        Route::get('/{idProfessor}/duvida/{idDuvida}/respostas', 'CanalProfessor\CanalProfessorController@duvida')->name('duvida-respostas');
    });


    //Duvidas com professor
    Route::get('professor/{idProfessor}/duvidas', 'DuvidaController@index')->name('professor.duvidas');

    Route::post('professor/{idProfessor}/duvida/enviar', 'DuvidaController@postNovaDuvida')->name('professor.duvidas-enviar');

    Route::get('professor/{idProfessor}/duvida/{idDuvida}/respostas', 'DuvidaController@duvida')->name('professor.duvida-respostas');

    Route::post('professor/{idProfessor}/duvida/{idDuvida}/atualizar', 'DuvidaController@postAtualizarDuvida')->name('professor.duvida-atualizar');

    Route::post('professor/{idProfessor}/duvida/{idDuvida}/excluir', 'DuvidaController@postExcluirDuvida')->name('professor.duvida-excluir');

    Route::post('professor/{idProfessor}/duvida/{idDuvida}/comentario/enviar', 'DuvidaController@postEnviarComentarioDuvida')->name('professor.duvida-comentario-enviar');

    Route::post('professor/{idProfessor}/duvida/{idDuvida}/comentario/{idComentario}/excluir', 'DuvidaController@postExcluirComentarioDuvida')->name('professor.duvida-comentario-excluir');

    //User infos
    Route::get('painel', 'PainelController@index')->name('painel');

    // Route::get('perfil', 'PainelController@perfil')->name('perfil');
    // Route::get('perfil/medalhas', 'PainelController@badges')->name('perfil.badges');

    // Perfil medalhas / desafios / conquistas
    Route::group(['prefix' => 'perfil', 'as' => 'perfil.'], function () {
        Route::get('/recompensas', 'Badges\Alunos\BadgesController@recompensas')->name('recompensas');
        Route::get('/desafios-concluidos', 'Badges\Alunos\BadgesController@desafios')->name('desafios');
        Route::get('/conquistas', 'Badges\Alunos\BadgesController@conquistas')->name('conquistas');
    });

    //Avaliacoes do professor
    Route::get('professor/{idProfessor}/avaliacoes', 'RelatorioController@avaliacoesProfessor')->name('professor.avaliacoes');

    Route::get('resultados', 'PainelController@resultados')->name('resultados');

    //Certificado do curso painel
    Route::get('painel/certificado/{idCurso}', 'PainelController@getCertificado')->name('painel.certificado');

    //Group Configurações de conta
    Route::group(['prefix' => 'configuracao', 'as' => 'configuracao.'], function () {
        Route::get('/', 'ConfiguracaoController@index')->name('index');

        Route::get('avaliacoes', 'ConfiguracaoController@avaliacoes')->name('avaliacoes');

        Route::post('/usuario/salvar', 'ConfiguracaoController@salvarDados')->name('salvar-dados');

        Route::post('/usuario/trocar-email', 'ConfiguracaoController@trocarEmail')->name('trocar-email');

        Route::post('/usuario/trocar-perfil', 'ConfiguracaoController@trocarFotoPerfil')->name('trocar-foto');

        Route::post('/usuario/trocar-senha', 'ConfiguracaoController@trocarSenha')->name('trocar-senha');

        Route::post('/usuario/notificacoes', 'ConfiguracaoController@notificacoes')->name('notificacoes');
    });

    // Artigos
    Route::group(['prefix' => 'artigos', 'as' => 'artigos.'], function () {
        Route::get('/', 'ArtigosController@index')->name('index');
        Route::get('ler/{artigo_id}-{sluged_title}', 'ArtigosController@lerArtigo')->name('ler');
    });

    // Playlists
    Route::group(['prefix' => 'playlists', 'as' => 'playlists.'], function () {
        Route::get('/', 'Playlist\PlaylistController@index')->name('listar');
        Route::post('/store', 'Playlist\PlaylistController@store')->name('store');
        Route::post('/{idPlaylist}/update', 'Playlist\PlaylistController@update')->name('update');
        Route::post('/{idPlaylist}/excluir', 'Playlist\PlaylistController@destroy')->name('destroy');
    });

    //Grupo de Ajuda / FAQ
    Route::group(['prefix' => 'ajuda', 'as' => 'ajuda.'], function () {

        //Artigos
        Route::get('', 'ArtigoAjudaController@index')->name('index');

        Route::get('artigos', 'ArtigoAjudaController@index')->name('artigos');

        Route::get('artigos/{idArtigo}', 'ArtigoAjudaController@artigo')->name('artigo');

        Route::post('artigos/{idArtigo}/avaliar', 'ArtigoAjudaController@postAvaliarArtigo')->name('artigo-avaliar');

        Route::post('artigos/pesquisar', 'ArtigoAjudaController@postPesquisar')->name('artigos-pesquisar');

    });

    //Grupo de Gestão
    Route::group(['prefix' => 'gestao', 'as' => 'gestao.', 'middleware' => 'gestao'], function () {

        Route::get('', 'GestaoController@index')->name('index');

        Route::get('cursos-professores', 'GestaoController@cursosProfessores')->name('cursos-professores');
        Route::get('ranking-professores', 'GestaoController@rankingProfessores')->name('ranking-professores');

        Route::get('cursos', 'GestaoController@cursos')->name('cursos');

        // Gestão de cursos e conteudo
        Route::get('curso/novo', 'GestaoController@novoCurso')->name('novo-curso');

        Route::post('curso/novo', 'GestaoController@postNovoCurso')->name('novo-curso');

        Route::get('curso/{idCurso}', 'GestaoController@conteudoCurso')->name('curso-conteudo');

        Route::post('curso/{idCurso}/salvar', 'GestaoController@postSalvarCurso')->name('curso-salvar');

        Route::post('curso/{idCurso}/excluir', 'GestaoController@postExcluirCurso')->name('curso-excluir');

        Route::post('curso/{idCurso}/publicar', 'GestaoController@postPublicarCurso')->name('curso-publicar');

        Route::post('curso/{idCurso}/aula/nova', 'GestaoController@postNovaAula')->name('curso.nova-aula');

        Route::get('curso/{idCurso}/aula/{idAula}/editar', 'GestaoController@editarAula')->name('curso.aula-editar');

        Route::get('curso/{idCurso}/exportar', 'Exportacao\CursoController@curso')->name('curso.exportar');
        Route::get('curso/{idCurso}/aula/{idAula}/exportar', 'Exportacao\AulaController@aula')->name('curso.aula-exportar');
        Route::get('curso/{idCurso}/aula/{idAula}/conteudo/{idConteudo}/exportar', 'Exportacao\AulaConteudoController@aulaConteudo')->name('curso.aula-conteudo-exportar');

        Route::post('curso/importar', 'Importacao\CursoController@curso')->name('curso.importar');
        Route::post('curso/{idCurso}/aula/{idAula}/importar', 'Importacao\AulaController@aula')->name('curso.aula-importar');
        Route::post('curso/{idCurso}/aula/{idAula}/conteudo/importar', 'Importacao\AulaConteudoController@aulaConteudo')->name('curso.aula-conteudo-importar');

        Route::get('curso/{idCurso}/aula/{idAula}/reordenar/{index}', 'GestaoController@reordenarAula')->name('curso.aula-reordenar');

        Route::post('curso/{idCurso}/aula/editar', 'GestaoController@postEditarAula')->name('curso.aula-salvar');

        Route::post('curso/{idCurso}/aula/duplicar', 'GestaoController@postDuplicarAula')->name('curso-aula-duplicar');

        Route::post('curso/{idCurso}/aula/excluir', 'GestaoController@postExcluirAula')->name('curso-aula-excluir');

        Route::get('curso/{idCurso}/aula/{idAula}/conteudos', 'GestaoController@aulaConteudos')->name('curso.aula-conteudos');

        Route::post('curso/{idCurso}/aula/conteudos/novo', 'GestaoController@postNovoConteudoCurso')->name('curso.aula-conteudos-novo');

        Route::get('curso/{idCurso}/aula/{idAula}/conteudos/{idConteudo}/editar', 'GestaoController@editarConteudoCurso')->name('curso.aula-conteudos-editar');

        Route::post('curso/{idCurso}/aula/conteudos/salvar', 'GestaoController@postSalvarConteudoCurso')->name('curso.aula-conteudos-salvar');

        Route::get('curso/{idCurso}/aula/{idAula}/conteudo/{idConteudo}/reordenar/{index}', 'GestaoController@reordenarConteudo')->name('curso.conteudo-reordenar');

        Route::post('curso/{idCurso}/conteudo/duplicar', 'GestaoController@postDuplicarConteudoCurso')->name('curso-conteudo-duplicar');

        Route::post('curso/{idCurso}/conteudo/excluir', 'GestaoController@postExcluirConteudoCurso')->name('curso-conteudo-excluir');

        // Entregaveis
        Route::get('entregaveis', 'EntregaveisController@index')->name('entregaveis');

        Route::get('entregaveis/curso/{idCurso}', 'EntregaveisController@getEntregaveisCurso')->name('entregaveis-curso');

        Route::get('entregaveis/arquivo/{idResposta}', 'EntregaveisController@getArquivoEntregavel')->name('entregaveis-arquivo');

        Route::post('entregaveis/curso/{idCurso}/corrigir/{idResposta}', 'EntregaveisController@postCorrigirResposta')->name('entregaveis-resposta-corrigir');

        // Duvidas do professor
        Route::get('professor/{idProfessor}/duvidas', 'DuvidaController@index')->name('professor.duvidas');

        Route::get('professor/{idProfessor}/duvida/{idDuvida}/respostas', 'DuvidaController@duvida')->name('professor.duvida-respostas');

        //  Gestão de Aplicações
        Route::get('aplicacoes', 'AplicacaoController@gestaoAplicacoes')->name('aplicacoes');

        Route::post('aplicacao/enviar', 'AplicacaoController@postCriarAplicacao')->name('aplicacao-nova');

        Route::get('aplicacao/{idAplicacao}/editar', 'AplicacaoController@getAplicacao')->name('aplicacao-editar');

        Route::post('aplicacao/salvar', 'AplicacaoController@postSalvarAplicacao')->name('aplicacao-salvar');

        Route::post('aplicacao/{idAplicacao}/excluir', 'AplicacaoController@postExcluirAplicacao')->name('aplicacao-excluir');

        //Liberação de aplicações por escola
        Route::post('aplicacoes/liberacao/escola/nova', 'LiberacaoController@postLiberarAplicacaoEscola')->name('aplicacoes.liberacao.escola-nova');

        Route::post('aplicacoes/liberacao/escola/{idLiberacao}/excluir', 'LiberacaoController@postExcluirLiberarAplicacaoEscola')->name('aplicacoes.liberacao.escola-excluir');

        //  Categorias
        Route::get('categorias', 'CategoriaController@categorias')->name('categorias');

        Route::post('categorias/nova', 'CategoriaController@postNova')->name('categorias.nova');

        Route::post('categorias/update', 'CategoriaController@postUpdate')->name('categorias.update');

        Route::get('categorias/{idCategoria}', 'CategoriaController@getCategoria')->name('categorias.get');

        Route::get('categorias/{idCategoria}/deletar', 'CategoriaController@deletar')->name('categorias.deletar');


        // Biblioteca de aplicacoes e conteudo
        Route::get('biblioteca', 'GestaoController@biblioteca')->name('biblioteca');

        //Gestão de cursos e conteudo
        Route::post('conteudos/novo', 'GestaoController@postNovoConteudo')->name('conteudo-novo');

        Route::get('conteudos/{idConteudo}/editar', 'GestaoController@editarConteudo')->name('conteudos-editar');

        Route::post('conteudos/salvar', 'GestaoController@postSalvarConteudo')->name('conteudos-salvar');

        Route::post('conteudo/{idConteudo}/excluir', 'GestaoController@postExcluirConteudo')->name('conteudo-excluir');

        //Gestão de turmas
        Route::get('turmas', 'TurmaController@index')->name('turmas');

        Route::post('turmas/nova', 'TurmaController@postNovaTurma')->name('nova-turma');

        Route::post('turmas/excluir', 'TurmaController@postExcluirTurma')->name('turma-excluir');

        Route::get('turma/{idTurma}/mural', 'TurmaController@muralTurma')->name('turma-mural');

        Route::get('turma/{idTurma}/mural/modo', 'TurmaController@modoPostagem')->name('turma-modo-postagem');

        Route::get('turma/{idTurma}/mural/convite/gerar', 'TurmaController@gerarConvite')->name('turma-gerar-convite');

        Route::post('turma/{idTurma}/alunos/convidar', 'TurmaController@postConvidarAlunos')->name('turma-convidar-alunos');

        Route::get('turma/{idTurma}/alunos/{idAluno}/remover', 'TurmaController@removerAluno')->name('turma-remover-aluno');

        Route::post('turma/{idTurma}/aplicacao/liberar', 'AplicacaoController@postLiberacaoAplicacao')->name('aplicacao-liberar');

        Route::post('turma/{idTurma}/transmissao/nova', 'CodigoTransmissaoController@postNovoCodigoTransmissao')->name('transmissao-nova');

        Route::post('transmissao/{idTransmissao}/excluir', 'CodigoTransmissaoController@postExcluirCodigoTransmissao')->name('transmissao-excluir');

        Route::get('transmissao/gerar-token', 'CodigoTransmissaoController@getTokenRandomico')->name('transmissao-token');

        // Mural escola
        Route::get('escola/{escola_id}/mural', 'EscolaController@muralEscola')->name('escola.mural');

        Route::get('escola/{escola_id}/mural/modo', 'EscolaController@modoPostagem')->name('escola.mural-modo-postagem');

        // Mural Gestão da  Escola

        Route::get('escola/{escola_id}/mural-gestao', 'EscolaController@muralGestaoEscola')->name('escola.mural-gestao');

        Route::post('escola/{escola_id}/mural-gestao/postar', 'EscolaController@postarMuralGestaoEscola')->name('escola.mural-gestao-postar');

        Route::get('escola/{escola_id}/mural-gestao/postagem/{postagem_id}/arquivo', 'EscolaController@getArquivoGestao')->name('escola.mural-gestao-postagem-arquivo');

        Route::post('escola/{escola_id}/mural-gestao/postagem/{postagem_id}/excluir', 'EscolaController@postExcluirPostagemGestao')->name('escola.mural-gestao-postagem-excluir');

        Route::post('escola/{escola_id}/mural-gestao/postagem/{postagem_id}/comentario/enviar', 'EscolaController@postEnviarComentarioPostagemGestao')->name('escola.mural-gestao-postagem-comentario-enviar');

        Route::post('escola/{escola_id}/mural-gestao/postagem/{postagem_id}/comentario/{idComentario}/excluir', 'EscolaController@postExcluirComentarioPostagemGestao')->name('escola.mural-gestao-postagem-comentario-excluir');


        //Gestão de turmas - grade aulas
        Route::get('turma/{idTurma}/grade/listar', 'GradeAula\Admin\GradeAulaController@listar')->name('grade-listar');
        Route::post('turma/{idTurma}/grade/nova', 'GradeAula\Admin\GradeAulaController@nova')->name('grade-nova');
        Route::post('turma/grade/atualizar', 'GradeAula\Admin\GradeAulaController@atualizar')->name('grade-atualizar');
        Route::post('turma/grade/deletar', 'GradeAula\Admin\GradeAulaController@deletar')->name('grade-deletar');

        // Glossario
        Route::get('glossario', function () {
            return redirect()->route('gestao.glossario', ['word' => 'A']);
        })->name('glossario.index');

        Route::post('glossario/salvar', 'Glossario\Admin\GlossarioController@store')->name('glossario.salvar');

        Route::post('glossario/excluir', 'Glossario\Admin\GlossarioController@delete')->name('glossario-excluir');

        Route::get('glossario/{word}', 'Glossario\Admin\GlossarioController@create')->name('glossario');

        //Relatorios
        Route::get('relatorios', 'RelatorioController@index')->name('relatorios');

        // Escolas
        Route::get('escolas', 'EscolaController@escolas')->name('escolas');

        Route::get('escola/{idEscola}/painel', 'EscolaController@painelEscola')->name('escola-painel');

        Route::post('escola/enviar', 'EscolaController@postCriarEscola')->name('escola-nova');

        Route::get('escola/{idEscola}/editar', 'EscolaController@getEscola')->name('escola-editar');

        Route::post('escola/salvar', 'EscolaController@postSalvarEscola')->name('escola-salvar');

        Route::post('escola/excluir', 'EscolaController@postExcluirEscola')->name('escola-excluir');


        // Códigos de acesso da escola
        Route::get('escola/codigos', 'CodigoAcessoEscolaController@index')->name('escola.codigos');

        Route::post('escola/{idEscola}/codigos/gerar', 'CodigoAcessoEscolaController@postGerarCodigosAcesso')->name('escola.codigos-gerar');

        Route::post('escola/{idEscola}/codigo/{idCodigo}/excluir', 'CodigoAcessoEscolaController@postExcluirCodigoAcesso')->name('escola.codigo-excluir');

        // Metricas
        Route::get('metricas', 'MetricaController@getMetricas')->name('metricas');

        // Route::get('metrica', 'MetricaController@getMetrica')->name('metrica');

        Route::get('metrica/{titulo}', 'MetricaController@getMetrica')->name('metrica');

        // Badges
        Route::prefix('badges')->group(function () {
            Route::get('/', 'Badges\Admin\BadgesController@index')->name('badges.listar');
            Route::post('/excluir', 'Badges\Admin\BadgesController@delete')->name('badges.excluir');
            Route::post('/cadastrar', 'Badges\Admin\BadgesController@store')->name('badges.cadastrar');
            Route::post('/atualizar/{idBadge}', 'Badges\Admin\BadgesController@update')->name('badges.atualizar');
            Route::post('/atualizar/icone/{idBadge}', 'Badges\Admin\BadgesController@updateIconBadge')->name('badges.atualizar.icone');
        });


        // Desafios
        Route::group(['prefix' => 'desafios', 'as' => 'desafios.'], function () {
            Route::get('/', 'Desafios\Admin\DesafiosController@index')->name('listar');
            Route::post('/cadastrar', 'Desafios\Admin\DesafiosController@store')->name('cadastrar');
            Route::get('/buscar/{idDesafio}', 'Desafios\Admin\DesafiosController@fetch')->name('buscar');
            Route::post('/atualizar/{idDesafio}', 'Desafios\Admin\DesafiosController@update')->name('atualizar');
            Route::post('/excluir/{idDesafio}', 'Desafios\Admin\DesafiosController@delete')->name('excluir');
        });

        // Missoes
        Route::group(['prefix' => 'missoes', 'as' => 'missoes.'], function () {
            Route::get('/', 'Missoes\Admin\MissoesController@index')->name('listar');
            Route::post('/cadastrar', 'Missoes\Admin\MissoesController@store')->name('cadastrar');
            Route::get('/buscar/{idMissao}', 'Missoes\Admin\MissoesController@fetch')->name('buscar');
            Route::post('/atualizar/{idMissao}', 'Missoes\Admin\MissoesController@update')->name('atualizar');
            Route::post('/excluir/{idMissao}', 'Missoes\Admin\MissoesController@delete')->name('excluir');
        });

        // Conquistas
        Route::group(['prefix' => 'conquistas', 'as' => 'conquistas.'], function () {
            Route::get('/', 'Conquistas\Admin\ConquistasController@index')->name('listar');
            Route::post('/cadastrar', 'Conquistas\Admin\ConquistasController@store')->name('cadastrar');
            Route::get('/buscar/{idConquista}', 'Conquistas\Admin\ConquistasController@fetch')->name('buscar');
            Route::post('/atualizar/{idConquista}', 'Conquistas\Admin\ConquistasController@update')->name('atualizar');
            Route::post('/excluir/{idConquista}', 'Conquistas\Admin\ConquistasController@delete')->name('excluir');
        });

        // Recompensas Virtuais
        Route::group(['prefix' => 'recompensas-virtuais', 'as' => 'recompensas-virtuais.'], function () {
            Route::get('/', 'RecompensasVirtuais\Admin\RecompensasVirtuaisController@index')->name('listar');
            Route::post('/cadastrar', 'RecompensasVirtuais\Admin\RecompensasVirtuaisController@store')->name('cadastrar');
            Route::get('/buscar/{idRecompensaVirtual}', 'RecompensasVirtuais\Admin\RecompensasVirtuaisController@fetch')->name('buscar');
            Route::post('/atualizar/{idRecompensaVirtual}', 'RecompensasVirtuais\Admin\RecompensasVirtuaisController@update')->name('atualizar');
            Route::post('/excluir/{idRecompensaVirtual}', 'RecompensasVirtuais\Admin\RecompensasVirtuaisController@delete')->name('excluir');
        });

        // Recompensas Extra-Jogo
        Route::group(['prefix' => 'recompensas-extra-jogo', 'as' => 'recompensas-extra-jogo.'], function () {
            Route::get('/', 'RecompensasExtraJogo\Admin\RecompensasExtraJogoController@index')->name('listar');
            Route::post('/cadastrar', 'RecompensasExtraJogo\Admin\RecompensasExtraJogoController@store')->name('cadastrar');
            Route::get('/buscar/{idRecompensaExtraJogo}', 'RecompensasExtraJogo\Admin\RecompensasExtraJogoController@fetch')->name('buscar');
            Route::post('/atualizar/{idRecompensaExtraJogo}', 'RecompensasExtraJogo\Admin\RecompensasExtraJogoController@update')->name('atualizar');
            Route::post('/excluir/{idRecompensaExtraJogo}', 'RecompensasExtraJogo\Admin\RecompensasExtraJogoController@delete')->name('excluir');
        });

        // Habilidades
        Route::group(['prefix' => 'habilidades', 'as' => 'habilidades.'], function () {
            Route::get('/', 'Habilidades\Admin\HabilidadesController@index')->name('listar');
            Route::post('/excluir', 'Habilidades\Admin\HabilidadesController@delete')->name('excluir');
            Route::post('/cadastrar', 'Habilidades\Admin\HabilidadesController@store')->name('cadastrar');
            Route::post('/atualizar/{idBadge}', 'Habilidades\Admin\HabilidadesController@update')->name('atualizar');
        });


        // Banco de Questões
        Route::group(['prefix' => 'banco-de-questoes', 'as' => 'questoes.'], function () {
            Route::get('/', 'Questoes\Admin\QuestoesController@index')->name('listar');
            Route::get('/ajax', 'Questoes\Admin\QuestoesController@indexAjaxAll')->name('listar.ajaxall');
            // Route::get('/ajax/{id}', 'Questoes\Admin\QuestoesController@indexAjax')->name('listar.ajax');
            Route::post('/excluir', 'Questoes\Admin\QuestoesController@delete')->name('excluir');
            Route::post('/cadastrar', 'Questoes\Admin\QuestoesController@store')->name('cadastrar');
            Route::post('/cadastrar/ajax', 'Questoes\Admin\QuestoesController@storeAjax')->name('cadastrar.ajax');
            Route::post('/atualizar/{idQuestao}', 'Questoes\Admin\QuestoesController@update')->name('atualizar');
        });

        // Teste de nivelamento
        Route::group(['prefix' => 'teste-de-nivelamento', 'as' => 'teste.'], function () {
            Route::get('/', 'TesteNivelamento\Admin\TesteNivelamentoController@index')->name('listar');
            Route::get('/editar/{idTeste}', 'TesteNivelamento\Admin\TesteNivelamentoController@edit')->name('editar');
            Route::post('/excluir', 'TesteNivelamento\Admin\TesteNivelamentoController@delete')->name('excluir');
            Route::post('/cadastrar', 'TesteNivelamento\Admin\TesteNivelamentoController@store')->name('cadastrar');
            Route::post('/atualizar/{idTeste}', 'TesteNivelamento\Admin\TesteNivelamentoController@update')->name('atualizar');
            Route::get('/resultados/{idTeste}', 'TesteNivelamento\Admin\TesteNivelamentoController@listarResultados')->name('resultados');
            Route::get('/resultados/exibe/{idResultado}', 'TesteNivelamento\Admin\TesteNivelamentoController@corrigeResultado')->name('resultado.exibe');
            Route::get('/resultados/correcao/{idRespostaQuestao}/{value}', 'TesteNivelamento\Admin\TesteNivelamentoController@correcaoResultado')->name('resultado.correcao');
        });

        // Plano de aulas
        Route::group(['prefix' => 'plano-de-aulas', 'as' => 'plano-aulas.'], function () {
            Route::get('/', 'PlanoAulas\Admin\PlanoAulasController@index')->name('listar');
            Route::post('/cadastrar', 'PlanoAulas\Admin\PlanoAulasController@store')->name('cadastrar');
            Route::post('/atualizar/{idPlano}', 'PlanoAulas\Admin\PlanoAulasController@update')->name('atualizar');
            Route::post('/excluir', 'PlanoAulas\Admin\PlanoAulasController@delete')->name('excluir');
            Route::get('/getDates/{idGrade}', 'PlanoAulas\Admin\PlanoAulasController@getDaysAjax')->name('ajax');
            Route::post('/filtrar', 'PlanoAulas\Admin\PlanoAulasController@filtrar')->name('filtrar');
            Route::post('/busca', 'PlanoAulas\Admin\PlanoAulasController@busca')->name('busca');
        });

        // Artigos
        Route::group(['prefix' => 'artigos', 'as' => 'artigos.'], function () {
            Route::get('/', 'ArtigosController@gestaoArtigos')->name('index');
            Route::get('/novo', 'ArtigosController@create')->name('novo');
            Route::get('{artigo_id}', 'ArtigosController@getArtigo')->name('get');
            Route::get('ler/{artigo_id}-{sluged_title}', 'ArtigosController@lerArtigo')->name('ler');
            Route::get('{artigo_id}/editar', 'ArtigosController@editarArtigo')->name('editar');
            Route::post('{artigo_id}/excluir', 'ArtigosController@delete')->name('excluir');
            Route::post('/cadastrar', 'ArtigosController@store')->name('cadastrar');
            Route::post('/atualizar', 'ArtigosController@update')->name('atualizar');
        });

        // Banco de imagens
        Route::group(['prefix' => 'banco-imagens', 'as' => 'banco-imagens.'], function () {
            Route::get('/', 'BancoImagensController@index')->name('index');
            Route::get('{imagem_id}', 'BancoImagensController@getImagem')->name('get');
            Route::get('{imagem_id}/visualizar', 'BancoImagensController@getVisualizar')->name('visualizar');
            Route::get('{imagem_id}/arquivo', 'BancoImagensController@getArquivo')->name('baixar');
            Route::post('{imagem_id}/excluir', 'BancoImagensController@delete')->name('excluir');
            Route::post('/cadastrar', 'BancoImagensController@store')->name('cadastrar');
            Route::post('/atualizar', 'BancoImagensController@update')->name('atualizar');
        });

        // Trilhas
        Route::group(['prefix' => 'trilhas', 'as' => 'trilhas.'], function () {
            Route::get('/', 'Trilhas\Admin\TrilhasController@index')->name('listar');
            Route::get('/nova', 'Trilhas\Admin\TrilhasController@create')->name('create');
            Route::post('/store', 'Trilhas\Admin\TrilhasController@store')->name('store');
            Route::get('/{idTrilha}/editar', 'Trilhas\Admin\TrilhasController@edit')->name('edit');
            Route::post('/{idTrilha}/update', 'Trilhas\Admin\TrilhasController@update')->name('update');
            Route::post('/{idTrilha}/excluir', 'Trilhas\Admin\TrilhasController@destroy')->name('destroy');
        });

        // Album
        Route::group(['prefix' => 'albuns', 'as' => 'albuns.'], function () {
            Route::get('/', 'Album\Admin\AlbumController@index')->name('listar');
            Route::get('/nova', 'Album\Admin\AlbumController@create')->name('create');
            Route::post('/store', 'Album\Admin\AlbumController@store')->name('store');
            Route::get('/{idAlbum}/editar', 'Album\Admin\AlbumController@edit')->name('edit');
            Route::post('/{idAlbum}/update', 'Album\Admin\AlbumController@update')->name('update');
            Route::post('/{idAlbum}/excluir', 'Album\Admin\AlbumController@destroy')->name('destroy');
        });

        // Audios
        Route::group(['prefix' => 'audios', 'as' => 'audios.'], function () {
            Route::get('/', 'Audio\Admin\AudioController@index')->name('listar');
            Route::post('/store', 'Audio\Admin\AudioController@store')->name('store');
            Route::post('/{idAudio}/update', 'Audio\Admin\AudioController@update')->name('update');
            Route::post('/{idAudio}/excluir', 'Audio\Admin\AudioController@destroy')->name('destroy');
            Route::get('/{idAudio}/interacoes', 'AudioInteracoes\Admin\AudioInteracoesController@view')->name('interacoes');
        });

        // Roteiros
        Route::group(['prefix' => 'roteiros', 'as' => 'roteiros.'], function () {
            Route::get('/', 'Roteiros\Admin\RoteirosController@index')->name('listar');
            Route::post('/store', 'Roteiros\Admin\RoteirosController@store')->name('store');
            Route::post('/{idRoteiro}/update', 'Roteiros\Admin\RoteirosController@update')->name('update');
            Route::post('/{idRoteiro}/view', 'Roteiros\Admin\RoteirosController@view')->name('view');
            Route::post('/{idRoteiro}/destroy', 'Roteiros\Admin\RoteirosController@destroy')->name('destroy');
            Route::post('/search', 'Roteiros\Admin\RoteirosController@index')->name('search');
            Route::post('/updateStatusTopico', 'Roteiros\Admin\RoteirosController@ajaxUpdateStatusTopico')->name('updateStatusTopico');
        });

        // Playlists
        Route::group(['prefix' => 'playlists', 'as' => 'playlists.'], function () {
            Route::get('/', 'Playlist\PlaylistController@index')->name('listar');
        });

        // Interações de Audios
        Route::group(['prefix' => 'audios-interacoes', 'as' => 'audios-interacoes.'], function () {
            Route::get('/', 'AudioInteracoes\Admin\AudioInteracoesController@index')->name('listar');
            Route::post('/store', 'AudioInteracoes\Admin\AudioInteracoesController@store')->name('store');
            Route::post('/{idAudio}/update', 'AudioInteracoes\Admin\AudioInteracoesController@update')->name('update');
            Route::get('/{idAudio}/view', 'AudioInteracoes\Admin\AudioInteracoesController@view')->name('view');
            Route::post('/{idAudioInteracao}/destroy', 'AudioInteracoes\Admin\AudioInteracoesController@destroy')->name('destroy');
            Route::post('/search', 'AudioInteracoes\Admin\AudioInteracoesController@index')->name('search');
        });

        Route::resource('gamificacao', 'GamificacaoController')->only([
            'index',
            'store',
            //'show',
        ]);

        //Usuarios
        Route::get('usuarios', 'DashboardController@usuarios')->name('usuarios');

        Route::post('usuarios/novo', 'UserController@postNovo')->name('usuarios.novo');

        Route::get('usuarios/{idUsuario}/editar', 'UserController@getUsuario')->name('usuarios.editar');

        Route::post('usuarios/salvar', 'UserController@update')->name('usuarios.salvar');

        Route::get('usuarios/{idUsuario}/deletar', 'UserController@delete')->name('usuarios.deletar');

        //Grupo Ajuda

        Route::group(['prefix' => 'ajuda', 'as' => 'ajuda.'], function () {

            //Artigos
            Route::get('artigos', 'ArtigoAjudaController@getAdmin')->name('artigos');

            Route::get('artigos/{idArtigo}', 'ArtigoAjudaController@getArtigo')->name('artigo');

            Route::post('artigos/novo', 'ArtigoAjudaController@postNovo')->name('artigo-novo');

            Route::post('artigos/atualizar', 'ArtigoAjudaController@postAtualizar')->name('artigo-update');

            Route::get('artigos/{idArtigo}/deletar', 'ArtigoAjudaController@getDeletarArtigo')->name('artigo-deletar');

        });

    });

    //Grupo Dashboard
    Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.', 'middleware' => 'admin'], function () {

        //Financeiro
        Route::get('financeiro', 'FinanceiroController@index')->name('financeiro');

        // Usar apenas se não obtiver linha de comando
        Route::get('/artisan-clearall', function () {
            Artisan::call('config:clear');

            Artisan::call('cache:clear');

            Artisan::call('view:clear');

            return 'Comando artisan executado com sucesso!';
        });

        // Documentação
        Route::prefix('documentacao')->group(function () {
            Route::prefix('api')->group(function () {
                Route::get('/', 'Documentacao\Api\DocumentacaoController@index')->name('doc.api.index');
            });
        });
    });

    //Contato

    Route::get('/contato', 'ContatoController@index')->name('contato');

    Route::post('/contato', 'ContatoController@post')->name('contato.enviar');

    //User image

    Route::get('/usuarios/{idUsuarios}/perfil/image', 'UserController@imagemPerfil')->name('usuario.perfil.image');

    // Logout routes
    Route::get('/sair', function () {
        Session::flush();
        return redirect()->to('/');
    })->name('sair');

    Route::post('/logout', function () {
        Session::flush();
        return redirect()->to('/');
    })->name('logout');


    // Fim global auth middleware
});

//User passwords

Route::get('/esqueci-senha', 'UserController@esqueciSenha')->name('usuario.esqueci-senha');

Route::post('/esqueci-senha', 'UserController@postEsqueciSenha')->name('usuario.esqueci-senha');

Route::get('/resetar-senha/{token}', 'UserController@resetarSenha')->name('usuario.resetar-senha');

Route::post('/resetar-senha', 'UserController@postResetarSenha')->name('usuario.resetar-senha');

// Routes Login/Cadastro

Route::get('/entrar', 'HomeController@entrar')->name('entrar');

Route::get('/logar', 'HomeController@entrar')->name('logar');

Route::get('/registrar', 'HomeController@registrar')->name('registrar');

Route::get('/cadastrar', 'HomeController@registrar')->name('cadastrar');

// Redirecionador temporario

Route::get('/uploads/aplicacoes/{id_aplicacao}/jogo', function ($id_aplicacao) {

    return redirect("/uploads/aplicacoes/$id_aplicacao/");

});

// Api
Route::group([
    'prefix' => 'api/v1',
    'as'     => 'api.v1',
    // 'middleware' => 'cors'
], function () {

    Route::get('/', 'ApiController@index')->name('index');

    // Gamificação
    Route::post('gamificacao/usuario/{idUsuario}/incrementar', 'GamificacaoUsuario\Api\GamificacaoUsuarioController@incrementar')->name('gamificacao.incrementar');

    // Store User
    Route::post('/user/store', 'ApiController@userStore')->name('user.store');

    // Forget User Pass
    Route::post('/user/forget/pass', 'ApiController@userForgetPass')->name('user.forget.pass');


    //Auth
    Route::post('/login', 'ApiController@postLogin')->name('login');

    Route::get('/logout', 'ApiController@logout')->name('logout');


    // Api auth middleware group
    Route::group(['middleware' => 'api.auth'], function () {

        Route::get('/user', 'ApiController@getUser')->name('user');

        Route::post('/user/update', 'ApiController@userUpdate')->name('user.update');
        Route::post('/user/update/image', 'ApiController@userUpdateImage')->name('user.update.image');

        Route::get('/aplicacoes', 'ApiController@getAplicacoes')->name('aplicacoes');

        // Aplicaçao
        Route::get('/aplicacao/{idAplicacao}', 'ApiController@getAplicacao')->name('aplicacao');

        // Play aplicacao
        Route::get('/aplicacao/{idAplicacao}/play', 'ApiController@getAplicacaoPlay')->name('aplicacao-play');


        // User & Instrutor
        Route::prefix('user')->group(function () {
            Route::get('instrutor/{id}', 'User\Api\UserApiController@getInstrutor')->name('user.instrutor.get');
        });


        // Audios
        Route::prefix('audios')->group(function () {
            Route::get('/{filter?}', 'Audio\Api\AudioApiController@listar')->name('audios.listar');
            Route::get('/audio/{idAudio}', 'Audio\Api\AudioApiController@show')->name('audios.show');
        });

        // Instrutores
        Route::prefix('instrutores')->group(function () {
            Route::get('/{filter?}', 'API\InstructorController@index')->name('instructors.listar');
            Route::get('/instrutor/{idInstrutor}', 'API\InstructorController@show')->name('instructors.show');
        });

        // Escolas
        Route::prefix('escolas')->group(function () {
            Route::get('/{filter?}', 'API\EscolaController@index')->name('escolas.listar');
            Route::get('/escola/{idEscola}', 'API\EscolaController@show')->name('escolas.show');
        });

        // Albuns
        Route::prefix('albuns')->group(function () {
            Route::get('/{filter?}', 'Album\Api\AlbumApiController@listar')->name('albuns.listar');
            Route::get('/album/{idAlbum}', 'Album\Api\AlbumApiController@show')->name('albuns.show');
            Route::get('/home/destaques', 'Album\Api\AlbumApiController@destaques')->name('albuns.destaques');
        });

        // Albuns da Escola
        Route::group([
            'prefix' => '{idEscola}'
        ], function () {
            Route::get('/albuns/{filter?}', 'Album\Api\AlbumApiController@listar')->name('albuns.listar');
            Route::get('/albuns/home/destaques', 'Album\Api\AlbumApiController@destaques')->name('albuns.destaques');
        });

        // Playlists
        Route::prefix('playlists')->group(function () {
            Route::get('/', 'Playlist\Api\PlaylistApiController@listar')->name('playlists.listar');
            Route::get('/playlist/{idPlaylist}', 'Playlist\Api\PlaylistApiController@show')->name('playlists.show');
            Route::get('/playlist/destroy/{idPlaylist}', 'Playlist\Api\PlaylistApiController@destroy')->name('playlists.destroy');
            Route::post('/playlist/{idPlaylist}/audio/destroy', 'Playlist\Api\PlaylistApiController@removeOneAudio')->name('playlists.audio.destroy');
            Route::post('/playlist/{idPlaylist}/audio/store', 'Playlist\Api\PlaylistApiController@storeOneAudio')->name('playlists.audio.store');
            Route::post('/criar', 'Playlist\Api\PlaylistApiController@store')->name('playlists.store');
            Route::post('/atualizar/{idPlaylist}', 'Playlist\Api\PlaylistApiController@update')->name('playlists.update');
            Route::post('/audios/atualizar/{idPlaylist}', 'Playlist\Api\PlaylistApiController@updateAudios')->name('playlists.audios.update');
        });

        // Favoritos
        Route::prefix('favoritos')->group(function () {
            Route::get('listar/{field}', 'Favoritos\Api\FavoritosApiController@listar')->name('favoritos.listar');
            Route::post('adicionar', 'Favoritos\Api\FavoritosApiController@store')->name('playlist.store');
            Route::get('/remover/{id}', 'Favoritos\Api\FavoritosApiController@destroy')->name('playlist.destroy');
        });

        // Recentes
        Route::prefix('recentes')->group(function () {
            Route::get('/listar', 'Recentes\Api\RecentesApiController@listar')->name('recentes.listar');
            Route::post('/store', 'Recentes\Api\RecentesApiController@store')->name('recentes.store');
        });

        // Busca
        Route::prefix('busca')->group(function () {
            Route::post('/', 'Busca\Api\BuscaApiController@listar')->name('busca.listar');
        });


        // Badges
        Route::prefix('badges')->group(function () {

            // http://localhost:8000/api/jpiaget/badges/usuario/1/19/desbloquear
            Route::get('usuario/{idUsuario}/{idBadge}/desbloquear', 'Badges\Api\BadgesController@desbloquearUsuarioBadge');

            // http://localhost:8000/api/jpiaget/badges/19/desbloquear
            Route::get('{idBadge}/desbloquear', 'Badges\Api\BadgesController@desbloquearUsuarioAuthBadge');
        });

        // Métricas
        Route::prefix('metricas')->group(function () {

            // http://localhost:8000/api/jpiaget/metricas/nova
            Route::post('nova', 'Metricas\Api\MetricasController@nova');
        });

        // Habilidades
        Route::prefix('habilidades')->group(function () {

            // http://localhost:8000/api/jpiaget/habilidades/usuario/1/2
            Route::post('usuario/{idUsuario}/{idHabilidade}', 'Habilidades\Api\HabilidadesController@UsuarioHabilidade');

            // http://localhost:8000/api/jpiaget/habilidades/2
            Route::post('{idHabilidade}', 'Habilidades\Api\HabilidadesController@UsuarioAuthHabilidade');
        });


        // Gamificação listar xp
        Route::get('gamificacao/usuario/{idUsuario}', 'GamificacaoUsuario\Api\GamificacaoUsuarioController@listar')->name('gamificacao.listar');


        // Api gestão group
        Route::group(['middleware' => 'api.admin'], function () {

            // Gamificação incrementar
            //Route::post('gamificacao/usuario/{idUsuario}/incrementar', 'GamificacaoUsuario\Api\GamificacaoUsuarioController@incrementar')->name('gamificacao.incrementar');
        });
    });


    // Api auth middleware group
    Route::group(['middleware' => 'api.auth'], function () {

        // Retorna usuário logado
        Route::get('/user', 'ApiController@getUser')->name('user');

        Route::get('user/mensagens', 'MensagemController@getMensagens')->name('mensagens');

        Route::get('user/destinatarios', 'MensagemController@getUsuariosConversa')->name('mensagens-destinatarios');

        Route::get('user/mensagens/{idDestinatario}', 'MensagemController@getMensagensTrocadas')->name('mensagens-trocadas');

        Route::post('user/mensagem/enviar', 'MensagemController@postEnviarMensagem')->name('mensagem-enviar');

        // Enviar metrica para usuario logado
        Route::post('/metricas/nova', 'ApiController@postNovaMetrica')->name('metrica-nova');

        // Medalhas
        Route::get('/badges', 'ApiController@getBadges')->name('badges');

        // Medalhas destravadas do usuário logado
        Route::get('/user/badges', 'Api\BadgeController@getUnlockedBadges')->name('badges-destravadas');

        // Destravar medalha - usuário logado
        Route::post('/user/badge/{idBadge}/destravar', 'Api\BadgeController@postUnlockBadge')->name('badge-destravar');

        // Atualiza o progresso do usuário em determinado conteúdo
        Route::post('/user/progresso/{idConteudo}/atualizar', 'ApiController@postProgressoConteudo')->name('progresso-atualizar');

        // Codigo transmissao
        Route::get('/transmissao/{idTransmissao}', 'ApiController@getCodigoTransmissao')->name('codigo-transmissao');

        // Glossario
        Route::get('/glossario/{letra?}', 'ApiController@getGlossario')->name('glossario');

        //Aplicacoes
        Route::get('/aplicacoes', 'ApiController@getAplicacoes')->name('aplicacoes');

        // Aplicaçao
        Route::get('/aplicacao/{idAplicacao}', 'ApiController@getAplicacao')->name('aplicacao');

        // Play aplicacao
        Route::get('/aplicacao/{idAplicacao}/play', 'ApiController@getAplicacaoPlay')->name('aplicacao-play');

        // Conteudos
        Route::get('/conteudos', 'ApiController@getConteudos')->name('conteudos');

        // Conteudo
        Route::get('/conteudo/{idConteudo}', 'ApiController@getConteudo')->name('conteudo');

        // Play Conteudo
        Route::get('/conteudo/{idConteudo}/play', 'ApiController@getConteudoPlay')->name('conteudo-play');

        // Mural turma
        Route::get('/turma/{idTurma}/mural', 'ApiController@getMuralTurma')->name('turma-mural');

        // Mural turma
        Route::post('/turma/{idTurma}/mural/postar', 'ApiController@postMuralTurma')->name('turma-mural-postar');

        // Duvidas professor
        Route::get('professor/{idProfessor}/duvidas', 'ApiController@getDuvidasProfessor')->name('professor-duvidas');


        // Duvida professor
        Route::get('/professor/{idProfessor}/duvida/{idDuvida}', 'ApiController@getDuvidaProfessor')->name('professor-duvida');

        // Avaliacoes professor
        Route::get('/professor/{idProfessor}/avaliacoes', 'ApiController@getAvaliacoesProfessor')->name('professor-avaliacoes');

    });

    // Api admin middleware group
    Route::group(['middleware' => 'api.admin'], function () {

        // Destravar medalha - usuário logado
        Route::post('user/{$idUsuario}/badge/{idBadge}/destravar', 'Api\BadgeController@postUsuarioUnlockBadge')->name('usuario.badge-destravar');

    });

    // Rota de fuga para api nao encontrada
    Route::get('/{page?}', function ($endpoint) {

        return response()->json(["error" => "Endpoint '" . $endpoint . "' não encontrado."]);

    });

    // Rota de fuga para api nao encontrada
    Route::post('/{page?}', function ($endpoint) {

        return response()->json(["error" => "Endpoint '" . $endpoint . "' não encontrado."]);

    });

});
