<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGradeAulasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('grade_aulas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('turma_id');
			$table->string('titulo');
			$table->text('descricao', 65535)->nullable();
			$table->date('data')->nullable();
			$table->dateTime('data_inicial');
			$table->time('hora_inicial')->nullable();
			$table->dateTime('data_final');
			$table->time('hora_final')->nullable();
			$table->boolean('recorrente')->nullable();
			$table->integer('dia')->nullable();
			$table->string('cor', 100)->nullable();
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
		Schema::drop('grade_aulas');
	}

}
