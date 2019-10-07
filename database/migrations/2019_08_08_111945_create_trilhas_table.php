<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTrilhasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('trilhas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->string('titulo');
			$table->string('capa')->nullable();
			$table->text('descricao')->nullable();
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
		Schema::drop('trilhas');
	}

}
