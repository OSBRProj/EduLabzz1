<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTesteNivelamentoResultadosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('teste_nivelamento_resultados', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->dateTime('finalizado')->nullable();
			$table->integer('pontuacao')->nullable();
			$table->boolean('status')->nullable();
			$table->integer('teste_id');
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
		Schema::drop('teste_nivelamento_resultados');
	}

}
