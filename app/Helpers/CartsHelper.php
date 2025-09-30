<?php

namespace App\Helpers;

use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

abstract class CartsHelper
{
    /**
     * Restituisce il nostro carrello
     *
     * @return Collection
     */
    static function get(): Collection
    {
        $ids = Session::get('cart', collect());

        return $ids->map(function ($id) {
            return Product::where('id', $id)
                ->first();
        });
    }

    /**
     * Restituisce il numero di prodotti nel nostro carrello
     *
     * @return int
     */
    static function count(): int
    {
        return self::get()->count();
    }

    /**
     * Il valore totale del nostro carrello
     *
     * @return \Closure|float
     */
    static function amountCart(): \Closure|float
    {
        return self::get()
            ->reduce(function ($somma, $item) {
                $somma += $item['price'];

                return $somma;
            }, 0);
    }

    /**
     * Verifichiamo se un prodotto è nel nostro carrello
     *
     * @param string $productId
     * @return bool
     */
    static function inCart(string $productId): bool
    {
        return self::get()->has($productId);
    }

    /**
     * Aggiungiamo un prodotto al nostro carrello
     *
     * @param string $productId
     * @return bool
     */
    static function add(string $productId): bool
    {
        if (self::inCart($productId)) {
            return false;
        }

        $ids = Session::get('cart', collect());
        $ids->push($productId);

        Session::put('cart', $ids);

        return true;
    }

    /**
     * Rimuoviamo un prodotto dal nostro carrello
     *
     * @param string $productId
     * @return void
     */
    static function remove(string $productId): void
    {
        if (self::inCart($productId)) {
            $ids = Session::get('cart', collect());
            $ids = $ids->filter(fn($id) => $id !== $productId);

            Session::put('cart', $ids);
        }
    }

    /**
     * Svuoto il carrello
     *
     * @return void
     */
    static function removeAll(): void
    {
        Session::forget('cart');
    }
}
