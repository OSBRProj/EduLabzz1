<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLiberacaoAplicacaoEscolaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('liberacao_aplicacao_escola', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('aplicacao_id');
			$table->integer('escola_id');
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
		Schema::drop('liberacao_aplicacao_escola');
	}

}
