<div class="card mb-4 shadow-sm">
    <div class="card-header">
        Ordinamento prodotti
    </div>
    <div class="card-body">
        <ul class="list-group list-group-flush">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="@php

                     $queryString = request()->uri()->query()->except('page');
                     $queryString['orderBy'] = 'title';

                     if ($orderBy === 'title') {
                        $queryString['orderDesc'] = $orderDesc === 'DESC' ? '0' : '1';
                    } else {
                        $queryString['orderDesc'] = '0';
                    }

                    echo request()->uri()
                        ->replaceQuery($queryString)
                        ->value()

                @endphp" class="page-link">Titolo</a>

                <span>
                    @if($orderBy === 'title')
                        <i class="bi bi-sort-alpha-{{ $orderDesc === 'DESC' ? 'up' : 'down' }}"></i>
                    @endif
                </span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="@php

                     $queryString = request()->uri()->query()->except('page');
                     $queryString['orderBy'] = 'price';

                     if ($orderBy === 'price') {
                        $queryString['orderDesc'] = $orderDesc === 'DESC' ? '0' : '1';
                    } else {
                        $queryString['orderDesc'] = '0';
                    }

                    echo request()->uri()
                        ->replaceQuery($queryString)
                        ->value()

                @endphp" class="page-link">Prezzo</a>

                <span>
                    @if($orderBy === 'price')
                        <i class="bi bi-sort-alpha-{{ $orderDesc === 'DESC' ? 'up' : 'down' }}"></i>
                    @endif
                </span>
            </li>
        </ul>
    </div>
</div>
