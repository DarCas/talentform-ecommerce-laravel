<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 *
 * @property string $id
 * @property string $category
 * @property string $title
 * @property string $description
 * @property string|null $image
 * @property int $qty
 * @property float $price
 * @property bool $highlight
 * @property int $status
 * @property Carbon $update_date
 *
 * @property Collection|Cart[] $carts
 *
 * @package App\Models
 */
class Product extends Model
{
    protected $table = 'products';
    public $incrementing = false;
    public $timestamps = false;

    protected $casts = [
        'qty' => 'int',
        'price' => 'float',
        'highlight' => 'bool',
        'status' => 'int',
        'update_date' => 'datetime'
    ];

    protected $fillable = [
        'category',
        'title',
        'description',
        'image',
        'qty',
        'price',
        'highlight',
        'status',
        'update_date'
    ];

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function imageWithPlaceholder(
        int    $width = 1920,
        int    $height = 1080,
        string $text = 'Image Not Found'
    ): string
    {
        return $this->image ?
            "/storage/products/{$this->image}" :
            "https://placehold.co/{$width}x{$height}.png?text=" . urlencode($text);
    }

    public function priceVerbose(): false|string
    {
        /** @var \NumberFormatter $formatter */
        $formatter = \NumberFormatter::create('it_IT', \NumberFormatter::CURRENCY);
        return $formatter->formatCurrency($this->price, 'EUR');
    }

    public function priceAmazon(): string
    {
        $priceFormatted = $this->priceVerbose();
        $parts = explode(',', $priceFormatted);

        return "{$parts[0]}<sup>{$parts[1]}</sup>";
    }

    public function qtyVerbose(): false|string
    {
        $formatter = \NumberFormatter::create('it_IT', \NumberFormatter::GROUPING_SEPARATOR_SYMBOL);
        return $formatter->format($this->qty);
    }
}
