<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTesteNivelamentoDirecionamentoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('teste_nivelamento_direcionamento', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->string('direcionamento')->nullable();
			$table->integer('pontuacao');
			$table->string('regra');
			$table->integer('teste_id')->unsigned();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('teste_nivelamento_direcionamento');
	}

}
