<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMarcadorPaginaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('marcador_pagina', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('conteudo_id');
			$table->integer('user_id');
			$table->integer('pagina');
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
		Schema::drop('marcador_pagina');
	}

}
