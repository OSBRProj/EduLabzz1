<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDuvidaProfessorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('duvida_professor', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('professor_id');
			$table->integer('user_id');
			$table->string('titulo');
			$table->text('descricao', 65535);
			$table->boolean('status');
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
		Schema::drop('duvida_professor');
	}

}
