<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateConteudosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('conteudos', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id');
			$table->string('titulo');
			$table->text('descricao');
			$table->integer('status');
			$table->integer('tipo');
			$table->text('conteudo');
			$table->float('tempo', 10, 0)->nullable();
			$table->integer('duracao')->nullable();
			$table->text('apoio', 65535)->nullable();
			$table->text('fonte')->nullable();
			$table->text('autores')->nullable();
			$table->integer('categoria_id');
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
		Schema::drop('conteudos');
	}

}
