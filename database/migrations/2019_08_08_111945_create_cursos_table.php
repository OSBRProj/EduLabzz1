<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCursosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cursos', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('escola_id');
			$table->integer('user_id');
			$table->string('titulo');
			$table->text('descricao_curta');
			$table->text('descricao');
			$table->string('capa');
			$table->integer('categoria');
			$table->integer('tipo');
			$table->boolean('visibilidade');
			$table->string('senha');
			$table->integer('status');
			$table->float('preco', 10, 0);
			$table->integer('periodo');
			$table->integer('vagas');
			$table->dateTime('data_publicacao')->nullable();
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
		Schema::drop('cursos');
	}

}
