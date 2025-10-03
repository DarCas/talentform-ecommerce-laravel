@extends('front')

@section('title', 'Dati di acquisto ~ Carrello')
@section('main-class', 'bg-body-tertiary')

@section('content')

    <div class="container py-5">
        <div class="row">
            <div class="col-9">
                <div class="card">
                    <div class="card-body">
                        <h2>Dati d'acquisto</h2>
                        <div class="opacity-25">
                            <hr>
                        </div>
                        <form action="/carts/order" method="post" class="row align-items-center">
                            @csrf
                            <div class="col-12">
                                @if (request()->get('success'))
                                    <x-alert
                                        type="success"
                                        content="Il tuo ordine è stato inviato con successo!"
                                    />
                                @elseif(request()->get('error'))
                                    <x-alert
                                        type="danger"
                                        content="Si è verificato un errore durante l'invio dell'ordine."
                                    />
                                @endif
                            </div>

                            <div class="col-6 pb-2">
                                <label for="inputName" class="form-label">Nome *</label>
                                <input type="text" class="form-control form-control-lg" id="inputName"
                                       required name="name">
                                <div class="form-text text-danger">
                                    {{ $errors->first('name') }}
                                </div>
                            </div>
                            <div class="col-6 pb-2">
                                <label for="inputSurname" class="form-label">Cognome *</label>
                                <input type="text" class="form-control form-control-lg" id="inputSurname"
                                       required name="surname">
                                <div class="form-text text-danger">
                                    {{ $errors->first('surname') }}
                                </div>
                            </div>

                            <div class="col-6 pb-2">
                                <label for="inputTaxCode" class="form-label">Codice fiscale *</label>
                                <input type="text" class="form-control form-control-lg" id="inputTaxCode"
                                       maxlength="16" required name="taxCode">
                                <div class="form-text text-danger">
                                    {{ $errors->first('taxCode') }}
                                </div>
                            </div>

                            <div class="col-12 pb-2">
                                <label for="inputAddress" class="form-label">Indirizzo di spedizione *</label>
                                <input type="text" class="form-control form-control-lg" id="inputAddress"
                                       required name="address">
                                <div class="form-text text-danger">
                                    {{ $errors->first('address') }}
                                </div>
                            </div>

                            <div class="col-6">
                                <label for="inputEmail" class="form-label">E-mail *</label>
                                <input type="email" class="form-control form-control-lg" id="inputEmail"
                                       required name="email">
                                <div class="form-text text-danger">
                                    {{ $errors->first('email') }}
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="inputTelefono" class="form-label">Telefono *</label>
                                <input type="tel" class="form-control form-control-lg" id="inputTelefono"
                                       required name="telefono">
                                <div class="form-text text-danger">
                                    {{ $errors->first('telefono') }}
                                </div>
                            </div>
                            <div class="col-12 py-2">
                                <label for="inputNote" class="form-label">Eventuali note</label>
                                <textarea class="form-control form-control-lg" id="inputNote"
                                          name="note" rows="4"></textarea>
                                <div class="form-text text-danger">
                                    {{ $errors->first('note') }}
                                </div>
                            </div>

                            <div class="col-8">
                                <a href="/carts" class="page-link">
                                    <i class="bi bi-arrow-left"></i>
                                    Torna al carrello
                                </a>
                            </div>

                            <div class="col-4 text-end">
                                <button type="submit" class="btn btn-lg w-100 block btn-warning">
                                    Conferma l'ordine
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-3">
                @include('front.carts.partials.total')
            </div>
        </div>
    </div>

@endsection
