<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateColecoesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('colecoes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->string('titulo');
			$table->text('descricao', 65535);
			$table->integer('status');
			$table->integer('categoria_id');
			$table->text('marcadores')->nullable();
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
		Schema::drop('colecoes');
	}

}
