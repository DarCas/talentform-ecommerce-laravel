<?php

namespace App\View\Components;

use App\Helpers\CartsHelper;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NavBar extends Component
{
    public function __construct()
    {
    }

    public function render(): View|Closure|string
    {
        $uri = request()->uri()
            ->replaceQuery(
                request()->uri()
                    ->query()
                    ->except('q')
            );

        return view('components.nav-bar', [
            'cartsCount' => CartsHelper::count(),
            'menu' => [
                [
                    'label' => 'Homepage',
                    'href' => '/',
                    'active' => request()->is('/'),
                ],
                [
                    'label' => 'Prodotti',
                    'href' => '/products',
                    'active' => request()->is('products'),
                ],
                [
                    'label' => 'Contatti',
                    'href' => '/contacts',
                    'active' => request()->is('contacts'),
                ],
            ],
            'q' => request()->get('q', ''),
            'url' => $uri->value(),
        ]);
    }
}
