@extends('front')

@section('title', 'Carrello')
@section('main-class', 'bg-body-tertiary')

@section('content')

    <div class="container py-5">
        <div class="row">
            <div class="col-{{ !$products->count() ? 12 : 9 }}">
                <div class="card">
                    <div class="card-body">
                        <h2>Carrello</h2>
                        @forelse($products as $product)
                            <div class="opacity-25">
                                <hr>
                            </div>

                            <div class="row mb-4">
                                <div class="col-2">
                                    <img src="{{ $product->imageWithPlaceholder(180, 180, 'Image\nNot Found') }}"
                                         class="img-thumbnail" alt=""
                                         style="width:180px;aspect-ratio: 1; object-fit: cover">
                                </div>
                                <div class="col-8">
                                    <h5>{{ $product->title }}</h5>
                                    <div>{{ nl2br($product->description) }}</div>

                                    <div class="mt-2">
                                        <div class="dropdown dropdown-menu-start">
                                            <button
                                                class="btn btn-sm btn-danger"
                                                type="button"
                                                data-bs-toggle="dropdown"
                                                aria-expanded="false"
                                            >
                                                Togli dal carrello
                                            </button>
                                            <ul class="dropdown-menu bg-danger">
                                                <li>
                                                    <a class="dropdown-item text-bg-danger"
                                                       href="/carts/{{ $product->id }}/delete">
                                                        Conferma la cancellazione dal carrello
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col text-end">
                                    <h5 class="fw-bold">
                                        {!! $product->priceAmazon() !!}
                                    </h5>
                                </div>
                            </div>
                        @empty
                            @if($_GET['order'])
                                <div class="alert alert-info">
                                    L'ordine è stato inviato correttamente
                                </div>
                            @else
                                <div class="alert alert-light">
                                    Il carrello è vuoto
                                </div>
                            @endif
                        @endforelse
                    </div>
                </div>
            </div>

            @if (count($products))
                <div class="col-3">
                    <div class="card">
                        <div class="card-body">
                            <h6>Totale provvisorio ({{ $count }} articoli):</h6>
                            <h4 class="fw-bold">
                                {{ $amountCart }}
                            </h4>

                            <div><a href="/carts/order" class="d-block btn btn-warning">Procedi all'ordine</a></div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

@endsection
