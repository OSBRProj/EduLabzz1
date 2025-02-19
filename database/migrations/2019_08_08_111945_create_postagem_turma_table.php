<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePostagemTurmaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('postagem_turma', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('turma_id');
			$table->integer('user_id');
			$table->text('conteudo');
			$table->string('arquivo')->nullable();
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
		Schema::drop('postagem_turma');
	}

}
