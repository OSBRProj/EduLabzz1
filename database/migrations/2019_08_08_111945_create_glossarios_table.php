<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGlossariosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('glossarios', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->text('word', 65535);
			$table->text('description');
			$table->char('key', 1);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('glossarios');
	}

}
