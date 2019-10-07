<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQuestoesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('questoes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('alternativas')->nullable();
			$table->timestamps();
			$table->text('descricao', 65535)->nullable();
			$table->string('resposta_correta')->nullable();
			$table->integer('tipo')->nullable();
			$table->string('titulo');
			$table->integer('user_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('questoes');
	}

}
