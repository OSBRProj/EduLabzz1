<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAnotacoesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('anotacoes', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id');
			$table->integer('conteudo_id');
			$table->integer('pagina');
			$table->text('trecho');
			$table->text('anotacao');
			$table->string('pos_y', 20);
			$table->string('pos_x', 20);
			$table->integer('start');
			$table->integer('end');
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
		Schema::drop('anotacoes');
	}

}
