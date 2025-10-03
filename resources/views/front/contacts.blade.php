@extends('front')

@section('title', 'Contatti')
@section('main-class', 'bg-body-tertiary')

@section('content')

    <div class="container py-5">
        <div class="row">
            <div class="col-{{ !$product->exists ? 12 : 9 }}">
                <div class="card shadow-sm">
                    <div class="card-body text-body-secondary">
                        <p>Compila il seguente modulo per richiedere informazioni su acquisti e prodotti. I campi
                            contrassegnati da asterisco (*) sono obbligatori.</p>

                        <form action="/contacts/sendmail" method="post" class="row">
                            @csrf

                            @if($product)
                                <input type="hidden" name="product" value="{{ $product->title }}">
                            @endif

                            <div class="col-12">
                                @if(request()->get('success'))
                                    <x-alert
                                        type="success"
                                        content="Il messaggio è stato inviato con successo!"
                                    />
                                @elseif (request()->get('error'))
                                    <x-alert
                                        type="danger"
                                        content="Si è verificato un errore durante l'invio del messaggio."
                                    />
                                @endif
                            </div>

                            <div class="col-12 pb-2">
                                <label for="inputNome" class="form-label">Nome *</label>
                                <input type="text" class="form-control form-control-lg" id="inputNome"
                                       required name="fullname">
                                <div class="form-text text-danger">
                                    {{ $errors->first('fullname') }}
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
                                <label for="inputTelefono" class="form-label">Telefono</label>
                                <input type="tel" class="form-control form-control-lg" id="inputTelefono"
                                       name="telefono">
                                <div class="form-text text-danger">
                                    {{ $errors->first('telefono') }}
                                </div>
                            </div>
                            <div class="col-12 py-2">
                                <label for="inputMessaggio" class="form-label">Messaggio *</label>
                                <textarea class="form-control form-control-lg" id="inputMessaggio"
                                          name="messaggio" rows="4"></textarea>
                                <div class="form-text text-danger">
                                    {{ $errors->first('messaggio') }}
                                </div>
                            </div>

                            <div class="col-4 offset-4">
                                <button type="submit" class="btn btn-lg w-100 block btn-success">
                                    Invia
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            @if ($product->exists)
                <div class="col-3">
                    <x-product
                        :image="$product->imageWithPlaceholder()"
                        :title="$product->title"
                        :id="$product->id"
                        :price="$product->priceVerbose()"
                        :category="$product->category"
                    />
                </div>
            @endif
        </div>
    </div>

@endsection
