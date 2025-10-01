<?php

namespace App\Helpers;

use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

abstract class LatestView
{
    /**
     * Restituisce la lista dei prodotti visualizzati
     *
     * @return Collection
     */
    static function get(): Collection
    {
        $ids = Session::get('latest-view', collect());

        return $ids->map(function ($id) {
            return Product::where('id', $id)
                ->first();
        });
    }

    /**
     * Aggiunge un prodotto alla lista dei prodotti visualizzati
     *
     * @param string $productId
     * @return void
     */
    static function upsert(string $productId): void
    {
        if (!Session::has('latest-view')) {
            Session::put('latest-view', collect());
        }

        /** @var Collection $ids */
        $ids = Session::get('latest-view');

        /**
         * Recupero l'eventuale lista di prodotti visualizzati
         * N.B. I prodotti sono ordinati dall'ultimo visualizzato al primo
         */
        $ids = $ids->filter(fn($id) => $id !== $productId);

        /**
         * Mi assicuro che l'array non superi il valore massimo impostato nel file di configurazione,
         * che è il valore massimo di elementi che vogliamo tracciare.
         */
        if ($ids->count() >= config('products.latestProducts.maxLength')) {
            $ids = $ids->slice(0, config('products.latestProducts.maxLength') - 1);
        }

        /**
         * Aggiungo un nuovo prodotto all'inizio dell'elenco.
         */
        $ids->prepend($productId);

        Session::put('latest-view', $ids);
    }
}
