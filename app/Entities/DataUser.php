<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 24 Jul 2019 03:55:03 +0000.
 */

namespace App\Entities;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class DataUser
 * 
 * @property int $id
 * @property int $user_id
 * @property string $nome
 * @property string $sobrenome
 * @property string $doc
 * @property string $skype
 * @property string $whatsapp
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Entities\User $user
 *
 * @package App\Entities
 */
class DataUser extends Eloquent
{
	protected $connection = 'mysql';

	protected $casts = [
		'user_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'nome',
		'sobrenome',
		'doc',
		'skype',
		'whatsapp'
	];

	public function user()
	{
		return $this->belongsTo(\App\Entities\User::class);
	}
}
