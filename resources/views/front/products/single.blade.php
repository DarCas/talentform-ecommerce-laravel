@extends('front')

@section('title', $product->title)
@section('description', $product->description)
@section('og-image', $product->imageWithPlaceholder())

@section('main-class', 'bg-body-tertiary')

@section('content')

    <div
        class="bg-hero shadow-sm"
        style="background-image: url({{ $product->imageWithPlaceholder() }});height: 460px;"
    ></div>

    <div class="container py-5" style="width: 55%">
        <h1 class="mb-4">{{ $product->title }}</h1>
        <p class="mb-4">{{ nl2br($product->description) }}</p>

        <div class="row">
            <div class="col-6">
                <h2>
                    @if($product->qty > 0)
                        Disponibile: {{ $product->qtyVerbose() }}
                    @else
                        <span class="text-danger">Non disponibile</span>
                    @endif
                </h2>
            </div>
            <div class="col-6 text-end">
                <h2>
                    Prezzo: {{ $product->priceVerbose() }}
                </h2>
            </div>

            <div class="col-6 py-4 text-end">
                <a href="/contacts/{{ $product->id }}"
                   class="btn btn-outline-primary">
                    <i class="bi bi-envelope"></i>
                    Richiedi informazioni
                </a>
            </div>
            <div class="col-6 py-4">
                <x-cart-btn
                    :id="$product->id"
                    verbose
                />
            </div>
        </div>
    </div>

@endsection
