<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class FrontController extends Controller
{
    public function index()
    {
        /** @var Collection[] $products */
        $products = Product::where('status', 1)
            ->orderBy('highlight', 'desc')
            ->orderBy('update_date', 'desc')
            ->limit(config('products.homepage.productsHighlights', 6))
            ->get();

        return view('front.homepage')
            ->with('products', $products);
    }
}
