@props(['placeholder'])
<nav class="navbar navbar-expand bg-body-tertiary shadow">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">{{ config('app.name', 'E-Commerce Laravel') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                @foreach($menu as $item)
                    <li class="nav-item">
                        <a class="nav-link {{ $item['active'] ? 'active' : '' }}"
                           aria-current="page" href="{{ $item['href'] }}">{{ $item['label'] }}</a>
                    </li>
                @endforeach
            </ul>

            <a class="btn btn-outline-primary me-2 {{ !$cartsCount ? ' disabled': '' }}" href="/carts">
                <i class="bi bi-cart4"></i>
                <sup>({{ $cartsCount }})</sup>
            </a>

            <form action="/products" method="get" class="d-flex" role="search">
                <div class="input-group">
                    <input class="form-control" type="search" name="q"
                           placeholder="{{ $placeholder }}"
                           value="{{ $q }}" aria-label="{{ $placeholder }}"
                    />
                    <button class="btn btn-success" type="submit"><i class="bi bi-search"></i></button>
                </div>
            </form>
        </div>
    </div>
</nav>
<script>
    const inputSearch = document.querySelector('input[name="q"]');
    inputSearch.addEventListener('input', () => {
        if (inputSearch.value === '') {
            location.href = '{!! $url !!}';
        }
    })
</script>
