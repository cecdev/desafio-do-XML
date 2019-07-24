<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToXmlDownloadControlTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('xml_download_control', function(Blueprint $table)
		{
			$table->foreign('users_id', 'fk_xml_download_control_users1')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('xml_download_control', function(Blueprint $table)
		{
			$table->dropForeign('fk_xml_download_control_users1');
		});
	}

}
