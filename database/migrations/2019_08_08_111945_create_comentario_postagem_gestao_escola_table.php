<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateComentarioPostagemGestaoEscolaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('comentario_postagem_gestao_escola', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('postagem_id');
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
		Schema::drop('comentario_postagem_gestao_escola');
	}

}
