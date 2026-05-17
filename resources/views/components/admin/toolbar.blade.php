@props([
    'action' => url()->current(),
    'method' => 'GET',
])

@once
    <style>
        .admin-toolbar {
            align-items: center;
            display: grid;
            gap: 16px;
            grid-template-columns: minmax(280px, 1fr) 280px auto;
            margin-bottom: 24px;
        }

        .admin-toolbar--two {
            grid-template-columns: minmax(280px, 1fr) auto;
        }

        @media (max-width: 991.98px) {
            .admin-toolbar,
            .admin-toolbar--two {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endonce

<form {{ $attributes->merge(['class' => 'admin-toolbar']) }} action="{{ $action }}" method="{{ $method }}">
    {{ $slot }}
</form>
