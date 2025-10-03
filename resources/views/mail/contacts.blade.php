@if($product)
    <p>Hai ricevuto un messaggio dal sito in merito al seguente prodotto.</p>
    <blockquote>
        <p>{{ $product }}</p>
    </blockquote>
@else
    <p>Hai ricevuto un messaggio dal sito.</p>
@endif
<p>I dati del contatto sono i seguenti:</p>
<ul>
    <li>Nome: <strong>{{ $fullname }}</strong></li>
    <li>E-Mail: <a href="mailto:{{ $email }}">{{ $email }}</a></li>
    @if($telefono)
        <li>Telefono: <a href="tel:{{ $telefono }}">{{ $telefono }}</a></li>
    @endif
</ul>
<p>{{ $messaggio }}</p>
