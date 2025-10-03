<?php

namespace App\Http\Controllers\Front;

use App\Helpers\CartsHelper;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CartsController extends Controller
{
    public function index()
    {
        return view('front.carts')
            ->with('products', CartsHelper::get())
            ->with('count', CartsHelper::count())
            ->with('amountCart', CartsHelper::amountCartVerbose());
    }

    public function order()
    {
        return view('front.carts.order');
    }

    public function sendOrder(Request $request)
    {
        $validator = Validator::make($request->post(), [
            'name' => 'required|string|max:255|min:3',
            'surname' => 'required|string|max:255|min:3',
            'taxCode' => 'required|string|size:16',
            'address' => 'required|string|max:255',
            'email' => 'required|email:rfc',
            'telefono' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();

            return redirect()->back()
                ->withErrors($errors);
        }

        try {
            DB::transaction(function () use ($validator) {
                /** @var Customer $customer */
                Customer::upsert(
                    [
                        'name' => $validator->getValue('name'),
                        'surname' => $validator->getValue('surname'),
                        'tax_code' => $validator->getValue('taxCode'),
                        'address' => $validator->getValue('address'),
                        'email' => $validator->getValue('email'),
                        'telefono' => $validator->getValue('telefono'),
                        'note' => $validator->getValue('note'),
                    ],
                    uniqueBy: ['tax_code', 'email'],
                    update: [
                        'address',
                        'telefono',
                        'note',
                    ],
                );

                $customer = Customer::where('tax_code', $validator->getValue('taxCode'))
                    ->first();

                CartsHelper::get()
                    ->map(function (Product $product) use ($customer) {
                        $cart = new Cart();
                        $cart->customer_id = $customer->id;
                        $cart->product_id = $product->id;
                        $cart->qty = 1;
                        $cart->create_date = now();
                        $cart->status = 0;
                        $cart->save();
                    });

                DB::commit();
            });

            CartsHelper::removeAll();

            return redirect('/carts?order=true');
        } catch (\Throwable $e) {
            DB::rollBack();

            dd($e);
        }
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
