<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfiguracoesGamificacaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configuracoes_gamificacao', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id');

            $table->integer('escola_id');

            $table->boolean('login_ativo')->nullable();
            $table->integer('login_xp')->nullable();

            $table->boolean('conclusao_conteudo_ativo')->nullable();
            $table->integer('conclusao_conteudo_xp')->nullable();

            $table->boolean('conclusao_aula_ativo')->nullable();
            $table->integer('conclusao_aula_xp')->nullable();

            $table->boolean('conclusao_curso_ativo')->nullable();
            $table->integer('conclusao_curso_xp')->nullable();

            $table->boolean('conclusao_teste_ativo')->nullable();
            $table->integer('conclusao_teste_xp')->nullable();

            $table->boolean('topico_ativo')->nullable();
			$table->integer('topico_xp')->nullable();

            $table->boolean('comentario_ativo')->nullable();
            $table->integer('comentario_xp')->nullable();

            $table->boolean('level_up_curso_ativo')->nullable();
            $table->integer('level_up_curso')->nullable();

            $table->boolean('level_up_conquista_ativo')->nullable();
            $table->integer('level_up_conquista')->nullable();

            $table->boolean('formula_level_ativo')->nullable();
            $table->string('formula_level')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('configuracoes_gamificacao');
    }
}
