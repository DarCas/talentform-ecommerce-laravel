@props(['image', 'title', 'id', 'price'])
<div class="card shadow-sm">
    <div
        class="bd-placeholder-img card-img-top bg-hero"
        style="background-image: url({{ $image }});height: 225px"
    ></div>
    <div class="card-body">
        <p class="card-text" style="height: 74px">{!! $title !!}</p>
        <div class="d-flex justify-content-between align-items-center">
            <div class="btn-group">
                <a href="/products/{{ $id }}"
                   class="btn btn-sm btn-outline-primary">Visualizza</a>
            </div>
            <strong class="text-success">
                {{ $price }}
            </strong>
        </div>
    </div>
</div>
