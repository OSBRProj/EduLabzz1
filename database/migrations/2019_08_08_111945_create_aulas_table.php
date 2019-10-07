<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAulasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('aulas', function(Blueprint $table)
		{
			$table->integer('id');
			$table->integer('curso_id');
			$table->integer('user_id');
			$table->string('titulo');
			$table->text('descricao');
			$table->integer('duracao');
			$table->string('requisito');
			$table->integer('requisito_id');
			$table->timestamps();
			$table->primary(['id','curso_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('aulas');
	}

}
