<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
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
    use HasUuids;

	protected $table = 'users';
	public $incrementing = false;
	public $timestamps = false;

    protected $keyType = 'string';

	protected $fillable = [
		'usernm',
		'passwd'
	];

	public function users_log()
	{
		return $this->hasOne(UsersLog::class);
	}
}
