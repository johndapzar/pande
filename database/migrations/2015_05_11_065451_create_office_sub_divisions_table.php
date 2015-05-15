<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfficeSubDivisionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('office_sub_divisions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('chief_engineer_id');
			$table->integer('office_circle_id');
			$table->integer('office_division_id');
			$table->string('name');
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
		Schema::drop('office_sub_divisions');
	}

}
