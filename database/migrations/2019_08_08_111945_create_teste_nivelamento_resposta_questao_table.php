<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTesteNivelamentoRespostaQuestaoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('teste_nivelamento_resposta_questao', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('correta')->nullable();
			$table->timestamps();
			$table->integer('questao_id');
			$table->string('resposta');
			$table->integer('teste_nivelamento_resultado_id');
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
		Schema::drop('teste_nivelamento_resposta_questao');
	}

}
