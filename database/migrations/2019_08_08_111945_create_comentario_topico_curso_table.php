<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateComentarioTopicoCursoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('comentario_topico_curso', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('topico_curso_id');
			$table->integer('user_id');
			$table->text('conteudo', 65535);
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
		Schema::drop('comentario_topico_curso');
	}

}
