<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTopicoCursoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('topico_curso', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('curso_id');
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
		Schema::drop('topico_curso');
	}

}
