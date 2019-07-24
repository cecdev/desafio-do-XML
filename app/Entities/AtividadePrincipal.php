<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 24 Jul 2019 03:55:03 +0000.
 */

namespace App\Entities;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class AtividadePrincipal
 * 
 * @property int $id
 * @property int $empresas_id
 * @property int $atividades_id
 * 
 * @property \App\Entities\Atividade $atividade
 * @property \App\Entities\Empresa $empresa
 *
 * @package App\Entities
 */
class AtividadePrincipal extends Eloquent
{
	protected $connection = 'mysql';
	protected $table = 'atividade_principal';
	public $timestamps = false;

	protected $casts = [
		'empresas_id' => 'int',
		'atividades_id' => 'int'
	];

	protected $fillable = [
		'empresas_id',
		'atividades_id'
	];

	public function atividade()
	{
		return $this->belongsTo(\App\Entities\Atividade::class, 'atividades_id');
	}

	public function empresa()
	{
		return $this->belongsTo(\App\Entities\Empresa::class, 'empresas_id');
	}
}
