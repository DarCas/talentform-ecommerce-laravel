<?php

namespace App\View\Components;

use App\Models\Product;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Hero extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $product = Product::where('status', 1)
            ->where('highlight', 1)
            ->inRandomOrder()
            ->first();

        return view('components.hero')
            ->with('description', $product->description)
            ->with('id', $product->id)
            ->with('image', $product->imageWithPlaceholder())
            ->with('title', $product->title);
    }
}
