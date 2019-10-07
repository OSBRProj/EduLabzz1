<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePlanoAulaAnexosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('plano_aula_anexos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('conteudo_id');
			$table->timestamps();
			$table->integer('plano_aula_id');
			$table->integer('tipo');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('plano_aula_anexos');
	}

}
