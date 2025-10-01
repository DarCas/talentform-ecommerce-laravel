@php($products = \App\Helpers\LatestView::get())

@if($products->count())
    <div class="card shadow-sm">
        <div class="card-header">
            Prodotti visti di recente
        </div>
        <div class="card-body pb-0">
            @foreach($products as $product)
                <a href="/products/{{ $product->id }}"
                   class="card mb-3"
                   style="text-decoration:none"
                >
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{ $product->imageWithPlaceholder(640, 640, 'Image\nNot Found') }}"
                                 class="img-fluid rounded-start"
                                 alt=""
                                 style="aspect-ratio: 1; width: 100%; object-fit: cover;"
                            >
                        </div>
                        <div class="col-md-8">
                            <div class="card-body d-flex align-items-center" style="height: 100%;">
                                <div>
                                    <div class="twoline-ellipsis">
                                        <strong>{{ $product->category }}</strong>
                                        {{ $product->title }}
                                    </div>
                                    <div class="fw-bold mt-1">
                                        {{ $product->priceVerbose() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endif
