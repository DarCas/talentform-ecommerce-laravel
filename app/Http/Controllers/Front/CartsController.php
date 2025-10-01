<?php

namespace App\Http\Controllers\Front;

use App\Helpers\CartsHelper;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartsController extends Controller
{
    public function index()
    {
        return view('front.carts')
            ->with('products', CartsHelper::get())
            ->with('count', CartsHelper::count())
            ->with('amountCart', CartsHelper::amountCartVerbose());
    }

    public function add(Product $product, Request $request)
    {
        CartsHelper::add($product->id);

        return redirect($request->query('returnUrl', '/'));
    }

    public function delete(Product $product)
    {
        CartsHelper::remove($product->id);

        return redirect()->back();
    }
}
