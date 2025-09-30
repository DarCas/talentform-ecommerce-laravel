<?php

namespace App\View\Components;

use App\Helpers\CartsHelper;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class NavBar extends Component
{
    public function __construct()
    {
    }

    public function render(): View|Closure|string
    {
        $url = request()->fullUrlWithQuery(request()->except('q'));

        if (Str::endsWith($url, '?')) {
            $url = Str::replaceLast('?', '', $url);
        }

        return view('components.nav-bar', [
            'cartsCount' => CartsHelper::count(),
            'menu' => $this->menu(),
            'q' => request()->get('q') ?? '',
            'url' => $url,
        ]);
    }

    protected function menu(): array
    {
        return [
            [
                'label' => 'Homepage',
                'href' => '/',
                'active' => request()->routeIs('/'),
            ],
            [
                'label' => 'Prodotti',
                'href' => '/products',
                'active' => request()->routeIs('/products'),
            ],
            [
                'label' => 'Contatti',
                'href' => '/contacts',
                'active' => request()->routeIs('/contacts'),
            ],
        ];
    }
}
