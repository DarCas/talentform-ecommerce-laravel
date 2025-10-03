<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UsersLog
 *
 * @property string $user_id
 * @property Carbon $latest_login
 *
 * @property User $user
 *
 * @package App\Models
 */
class UsersLog extends Model
{
	protected $table = 'users_logs';
	protected $primaryKey = 'user_id';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'latest_login' => 'datetime'
	];

	protected $fillable = [
		'latest_login'
	];

    public function latestLoginVerbose(): string
    {
        return $this->latest_login
            ->format('d/m/Y H:i:s');
    }

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
