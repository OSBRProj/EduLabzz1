<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTesteNivelamentosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('teste_nivelamentos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->text('descricao', 65535)->nullable();
			$table->text('recomendacoes')->nullable();
			$table->float('tempo', 10, 0)->nullable();
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
		Schema::drop('teste_nivelamentos');
	}

}
