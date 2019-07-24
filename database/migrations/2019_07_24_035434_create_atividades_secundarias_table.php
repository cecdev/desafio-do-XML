<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAtividadesSecundariasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('atividades_secundarias', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('empresas_id')->unsigned()->index('fk_atividades_secundarias_empresas1_idx');
			$table->integer('atividades_id')->index('fk_atividades_secundarias_atividades1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('atividades_secundarias');
	}

}
