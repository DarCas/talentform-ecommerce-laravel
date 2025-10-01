@props(['id', 'verbose' => false])
<a href="/carts/{{ $id }}/add?returnUrl={{ urlencode($returnUrl) }}"
   class="btn {{ $verbose ? '' : 'btn-sm' }} {{ $disableCart ? 'disabled' : 'btn-primary' }}">
    <i class="bi bi-cart-plus-fill"></i>

    @if($verbose)
        Aggiungi al carrello
    @endif
</a>
