<?php

namespace App\Http\Controllers\Front;

use App\Helpers\LatestView;
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

        return view('front.products')
            ->with('pagination', $paginator->links()->toHtml())
            ->with('products', $paginator->items())
            ->with('categories', $this->categories($request))
            ->with('orderBy', $orderBy)
            ->with('orderDesc', $orderDesc);
    }

    public function single(Product $product)
    {
        LatestView::upsert($product->id);

        return view('front.products.single')
            ->with('product', $product);
    }

    /**
     * Elaboro le categorie di prodotto
     *
     * @param Request $request
     * @return array
     */
    protected function categories(Request $request): array
    {
        /**
         * Conto quanti prodotti sono presenti in una categoria
         *
         * @param string $category
         * @return int
         */
        $CountItemsInCategory = function (string $category) use ($request) {
            /** @var Builder $builder */
            $builder = Product::where('status', 1);
            $builder->where('category', $category);

            if ($request->query('q')) {
                $builder->where('title', 'LIKE', "%{$request->query('q')}%")
                    ->orWhere('description', 'LIKE', "%{$request->query('q')}%");
            }

            return $builder->count();
        };

        /** @var Builder $builder */
        $builder = Product::where('status', 1);
        $builder->distinct();
        $builder->orderBy('category');
        $builder->pluck('category');
        return $builder->get()
            ->reduce(function (array $carry, Product $item) use ($CountItemsInCategory) {
                $carry[$item->category] = $CountItemsInCategory($item->category);

                return $carry;
            }, []);
    }
}
