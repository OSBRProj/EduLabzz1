<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTesteNivelamentoQuestaoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('teste_nivelamento_questao', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->string('peso');
			$table->integer('questao_id');
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
		Schema::drop('teste_nivelamento_questao');
	}

}
