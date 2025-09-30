<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Customer
 * 
 * @property string $id
 * @property string $name
 * @property string $surname
 * @property string $tax_code
 * @property string $address
 * @property string $email
 * @property string $telefono
 * @property string|null $note
 * 
 * @property Collection|Cart[] $carts
 *
 * @package App\Models
 */
class Customer extends Model
{
	protected $table = 'customers';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'name',
		'surname',
		'tax_code',
		'address',
		'email',
		'telefono',
		'note'
	];

	public function carts()
	{
		return $this->hasMany(Cart::class);
	}
}
