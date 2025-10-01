@extends('front')

@section('title', 'Prodotti')
@section('main-class', 'bg-body-tertiary')

@section('content')

    <div class="container py-5">
        <div class="row">
            <div class="col-8">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    @forelse($products as $product)
                        <div class="col">
                            <x-product
                                :image="$product->imageWithPlaceholder()"
                                :title="$product->title"
                                :id="$product->id"
                                :price="$product->priceVerbose()"
                                :category="$product->category"
                                :withCart="true"
                            />
                        </div>
                    @empty

                    @endforelse
                </div>

                @if ($pagination)
                    <div class="card mt-4 shadow-sm">
                        <div class="card-body">
                            {!! $pagination !!}
                        </div>
                    </div>
                @endif

            </div>
            <div class="col-4">
                @include('front.products.partials.ordinamento', ['orderBy' => $orderBy, 'orderDesc' => $orderDesc])
                @include('front.products.partials.categorie', ['categories' => $categories])
                @include('front.products.partials.latest-view')
            </div>
        </div>
    </div>

@endsection
