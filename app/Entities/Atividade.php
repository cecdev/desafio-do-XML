<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 24 Jul 2019 03:55:03 +0000.
 */

namespace App\Entities;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Atividade
 * 
 * @property int $id
 * @property string $text
 * @property string $code
 * 
 * @property \Illuminate\Database\Eloquent\Collection $atividade_principals
 * @property \Illuminate\Database\Eloquent\Collection $atividades_secundarias
 *
 * @package App\Entities
 */
class Atividade extends Eloquent
{
	protected $connection = 'mysql';
	public $timestamps = false;

	protected $fillable = [
		'text',
		'code'
	];

	public function atividade_principals()
	{
		return $this->hasMany(\App\Entities\AtividadePrincipal::class, 'atividades_id');
	}

	public function atividades_secundarias()
	{
		return $this->hasMany(\App\Entities\AtividadesSecundaria::class, 'atividades_id');
	}
}
