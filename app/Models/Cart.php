<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Cart
 *
 * @property string $id
 * @property string $customer_id
 * @property string $product_id
 * @property int $qty
 * @property Carbon $create_date
 * @property Carbon|null $status_date
 * @property Carbon|null $shipping_date
 * @property string|null $tracking
 * @property int $status
 *
 * @property Product $product
 * @property Customer $customer
 *
 * @package App\Models
 */
class Cart extends Model
{
    use HasUuids;

	protected $table = 'carts';
	public $incrementing = false;
	public $timestamps = false;

    protected $keyType = 'string';

	protected $casts = [
		'qty' => 'int',
		'create_date' => 'datetime',
		'status_date' => 'datetime',
		'shipping_date' => 'datetime',
		'status' => 'int'
	];

	protected $fillable = [
		'customer_id',
		'product_id',
		'qty',
		'create_date',
		'status_date',
		'shipping_date',
		'tracking',
		'status'
	];

	public function product()
	{
		return $this->belongsTo(Product::class);
	}

	public function customer()
	{
		return $this->belongsTo(Customer::class);
	}
}
