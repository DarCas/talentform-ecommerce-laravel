<!DOCTYPE html>
<html lang="it" data-bs-theme="auto">
<head>
    <title>@yield('title', 'E-Commerce Laravel')</title>
    @include('front.@partials.head')
</head>
<body>
<x-nav-bar
    placeholder="Cerca nel nostro catalogo"
/>

<main>
    @yield('content')
</main>

@include('front.@partials.footer')
</body>
</html>
