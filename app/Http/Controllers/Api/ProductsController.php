<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        /**
         * Ordinamento dei risultati
         */
        $orderBy = $request->query('orderBy', 'title');
        $orderDesc = $request->query('orderDesc', false) ? 'DESC' : 'ASC';

        if (!in_array($orderBy, ['title', 'price'])) {
            $orderBy = 'title';
        }

        /** @var Builder $builder */
        $builder = Product::where('status', 1);

        if ($request->query('q')) {
            $builder->where('title', 'LIKE', "%{$request->query('q')}%")
                ->orWhere('description', 'LIKE', "%{$request->query('q')}%");
        }

        if ($request->query('cat')) {
            $builder->where('category', $request->query('cat'));
        }

        $builder->orderBy($orderBy, $orderDesc);

        $paginator = $builder->paginate(
            perPage: config('products.pagination.itemsPerPage', 12),
            page: $request->query('page', 1),
        );

        return response()
            ->json([
                'itemsCount' => $paginator->total(),
                'items' => $paginator->items(),
                'page' => $paginator->currentPage(),
                'pagesCount' => $paginator->lastPage(),
            ]);
    }

    public function single(Product $product)
    {
        return response()
            ->json($product->toArray());
    }
}
