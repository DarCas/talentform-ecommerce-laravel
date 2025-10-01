@props([
    'image',
    'title',
    'id',
    'price',
    'category' => null,
    'withCart' => false,
    ])
<div class="card shadow-sm">
    <div
        class="bd-placeholder-img card-img-top bg-hero"
        style="background-image: url({{ $image }});height: 225px"
    ></div>

    <div class="card-body">
        <p class="card-text {{ $category ? 'threeline-ellipsis' : '' }}" style="height: 74px">
            @if ($category)
                <strong>{{ $category }}</strong><br>
            @endif

            {!! $title !!}
        </p>
        <div class="d-flex justify-content-between align-items-center">
            @if ($withCart)

                <x-cart-btn
                    :id="$id"
                />

            @endif

            <a href="/products/{{ $id }}"
               class="btn btn-sm btn-outline-primary">Visualizza</a>

            <strong class="text-success">
                {{ $price }}
            </strong>
        </div>
    </div>
</div>
