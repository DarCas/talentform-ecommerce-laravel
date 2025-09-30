<div
    class="bg-hero"
    style="background-image: url({{ $image }})"
>
    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">{{ $title }}</h1>
                <p class="lead text-body-secondary">{{ $description }}</p>
                <p>
                    <a href="/products/{{ $id }}"
                       class="btn btn-primary my-2">Maggiori informazioni</a>
                </p>
            </div>
        </div>
    </section>
</div>
