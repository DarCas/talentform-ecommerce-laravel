<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 * 
 * @property string $id
 * @property string $usernm
 * @property string $passwd
 * 
 * @property UsersLog|null $users_log
 *
 * @package App\Models
 */
class User extends Model
{
	protected $table = 'users';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'usernm',
		'passwd'
	];

	public function users_log()
	{
		return $this->hasOne(UsersLog::class);
	}
}
