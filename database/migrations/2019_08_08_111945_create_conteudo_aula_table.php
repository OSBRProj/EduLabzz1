<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateConteudoAulaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('conteudo_aula', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('ordem');
			$table->integer('conteudo_id');
			$table->integer('curso_id');
			$table->integer('aula_id');
			$table->integer('user_id');
			$table->boolean('obrigatorio');
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
		Schema::drop('conteudo_aula');
	}

}
