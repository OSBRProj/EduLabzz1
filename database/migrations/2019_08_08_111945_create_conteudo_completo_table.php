<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateConteudoCompletoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('conteudo_completo', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('curso_id');
			$table->integer('aula_id');
			$table->integer('conteudo_id');
			$table->integer('user_id');
			$table->text('resposta', 65535)->nullable();
			$table->text('correta', 65535)->nullable();
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
		Schema::drop('conteudo_completo');
	}

}
