<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHabilidadesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('habilidades', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->string('titulo');
			$table->boolean('visibilidade');
			$table->string('categoria')->nullable();
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
		Schema::drop('habilidades');
	}

}
