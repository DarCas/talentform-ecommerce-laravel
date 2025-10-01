<div class="card mb-4 shadow-sm">
    <div class="card-header">
        Categorie prodotti
    </div>
    <div class="card-body">
        <ul class="list-group list-group-flush">
            @if(request()->has('cat'))
                <li class="list-group-item text-end">
                    <a class="page-link" href="@php

                        $queryString = request()->uri()->query()->except('cat', 'id');

                        echo request()->uri()
                            ->replaceQuery($queryString)
                            ->value()

                    @endphp"><small>Disattiva filtro</small></a>
                </li>
            @endif

            @foreach($categories as $category => $count)

                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a class="page-link
                    @if(request()->query('cat') === $category)
                        disabled fw-bolder
                    @elseif(!$count)
                        disabled
                    @endif
                    " href="@php

                    $queryString = request()->uri()->query()->except('page');
                    $queryString['cat'] = $category;

                    echo request()->uri()
                        ->replaceQuery($queryString)
                        ->value()

                @endphp">{{ $category }}</a>
                    <span class="badge text-bg-primary rounded-pill">{{ $count }}</span>
                </li>
            @endforeach
        </ul>
    </div>
</div>
