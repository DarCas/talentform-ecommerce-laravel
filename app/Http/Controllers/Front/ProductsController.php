<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        return "Products";
    }

    public function single(Product $product)
    {
        dd($product->toArray());
    }
}
