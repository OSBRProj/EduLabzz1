<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAvaliacoesCursoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('avaliacoes_curso', function(Blueprint $table)
		{
			$table->integer('user_id');
			$table->integer('curso_id');
			$table->text('descricao');
			$table->float('avaliacao', 10, 0);
			$table->timestamps();
			$table->primary(['user_id','curso_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('avaliacoes_curso');
	}

}
