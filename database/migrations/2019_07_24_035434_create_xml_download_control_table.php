<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateXmlDownloadControlTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('xml_download_control', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('code', 45)->nullable();
			$table->string('name')->nullable();
			$table->string('path')->nullable();
			$table->smallInteger('status')->unsigned()->nullable()->default(0);
			$table->integer('users_id')->index('fk_xml_download_control_users1_idx');
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
		Schema::drop('xml_download_control');
	}

}
