@isset($breadcrumbs)
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            @foreach ($breadcrumbs as $item)
                <li class="breadcrumb-item {{ $loop->last ? 'active' : '' }}">
                    @if ($loop->last)
                        {{ $item['name'] }}
                    @else
                        <a href="{{ $item['link'] }}">{{ $item['name'] }}</a>
                    @endif
                </li>
            @endforeach
        </ol>
    </nav>
@endisset
