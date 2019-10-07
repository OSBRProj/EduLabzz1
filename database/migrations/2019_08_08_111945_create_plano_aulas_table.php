<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePlanoAulasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('plano_aulas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->integer('user_id');
			$table->integer('grade_aula_id');
			$table->string('assunto');
			$table->text('tarefa_classe', 65535);
			$table->text('tarefa_casa', 65535)->nullable();
			$table->date('data')->nullable();
			$table->text('objetivos', 65535)->nullable();
			$table->text('topicos_conhecimento', 65535)->nullable();
			$table->string('habilidades_competencias');
			$table->text('etapas_atividades', 65535)->nullable();
			$table->text('recursos_necessarios', 65535)->nullable();
			$table->text('avaliacao', 65535)->nullable();
			$table->text('metodologia', 65535)->nullable();
			$table->text('tema', 65535)->nullable();
			$table->string('nivel_ensino');
			$table->string('ano_serie')->nullable();
			$table->string('materia');
			$table->integer('quantidade_aulas');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('plano_aulas');
	}

}
