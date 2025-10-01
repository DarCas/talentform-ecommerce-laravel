<?php

namespace App\View\Components;

use App\Helpers\CartsHelper;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CartBtn extends Component
{
    private int $qty = -1;

    /**
     * Create a new component instance.
     */
    public function __construct(protected ?string $id)
    {
        $product = \App\Models\Product::find($id);

        if (!is_null($product)) {
            $this->qty = $product->qty;
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.cart-btn')
            ->with('id', $this->id)
            ->with('disableCart', ($this->qty <= 0) ||
                ($this->id && CartsHelper::inCart($this->id))
            )
            ->with('returnUrl', request()->getRequestUri());
    }
}
