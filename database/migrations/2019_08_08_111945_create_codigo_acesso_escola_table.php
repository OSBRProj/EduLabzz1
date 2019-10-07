<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCodigoAcessoEscolaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('codigo_acesso_escola', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('escola_id');
			$table->integer('turma_id')->nullable();
			$table->string('codigo');
			$table->integer('aluno_id')->nullable();
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
		Schema::drop('codigo_acesso_escola');
	}

}
