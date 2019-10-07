<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProgressoConteudoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('progresso_conteudo', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('conteudo_id');
			$table->integer('user_id');
			$table->integer('tipo');
			$table->float('progresso', 10, 0);
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
		Schema::drop('progresso_conteudo');
	}

}
