@extends('front')

@section('title', 'Homepage')

@section('content')

    <x-hero/>

    <div class="album py-5 bg-body-tertiary">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                @forelse($products as $product)
                    <div class="col">
                        <x-product
                            :image="$product->imageWithPlaceholder()"
                            :title="$product->title"
                            :id="$product->id"
                            :price="$product->priceVerbose()"
                        />
                    </div>
                @empty
                    Non ci sono prodotti
                @endforelse
            </div>
        </div>
    </div>

@endsection
