<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAtividadesSecundariasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('atividades_secundarias', function(Blueprint $table)
		{
			$table->foreign('atividades_id', 'fk_atividades_secundarias_atividades1')->references('id')->on('atividades')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('empresas_id', 'fk_atividades_secundarias_empresas1')->references('id')->on('empresas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('atividades_secundarias', function(Blueprint $table)
		{
			$table->dropForeign('fk_atividades_secundarias_atividades1');
			$table->dropForeign('fk_atividades_secundarias_empresas1');
		});
	}

}
