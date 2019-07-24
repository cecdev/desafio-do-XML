<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 24 Jul 2019 03:55:03 +0000.
 */

namespace App\Entities;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class XmlDownloadControl
 * 
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string $path
 * @property int $status
 * @property int $users_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Entities\User $user
 *
 * @package App\Entities
 */
class XmlDownloadControl extends Eloquent
{
	protected $connection = 'mysql';
	protected $table = 'xml_download_control';

	protected $casts = [
		'status' => 'int',
		'users_id' => 'int'
	];

	protected $fillable = [
		'code',
		'name',
		'path',
		'status',
		'users_id'
	];

	public function user()
	{
		return $this->belongsTo(\App\Entities\User::class, 'users_id');
	}
}
