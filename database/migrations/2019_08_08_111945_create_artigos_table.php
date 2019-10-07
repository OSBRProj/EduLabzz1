<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArtigosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('artigos', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id');
			$table->integer('escola_id');
			$table->string('titulo');
			$table->string('subtitulo')->nullable();
			$table->text('descricao', 65535)->nullable();
			$table->text('conteudo');
			$table->string('capa');
			$table->boolean('status');
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
		Schema::drop('artigos');
	}

}
