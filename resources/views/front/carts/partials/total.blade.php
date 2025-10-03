@php($products = \App\Helpers\CartsHelper::get())
@php($count = \App\Helpers\CartsHelper::count())
@php($amount = \App\Helpers\CartsHelper::amountCartVerbose())
<div class="card">
    <div class="card-body">
        <h6>Totale ordine ({{ $count }} articoli):</h6>
        <h4 class="fw-bold">{{ $amount }}</h4>
        @foreach ($products as $product)
            <div class="opacity-25">
                <hr>
            </div>

            <div class="row mb-4">
                <div class="col-2">
                    <img src="{{ $product->imageWithPlaceholder(640, 640, 'Image\nNot Found') }}"
                         class="img-thumbnail" alt="" style="width:180px;aspect-ratio: 1; object-fit: cover">
                </div>
                <div class="col-10">
                    <h6>{{ $product->title }}</h6>
                    <div>{!! $product->priceAmazon() !!}</div>
                </div>
            </div>
        @endforeach
    </div>
</div>
