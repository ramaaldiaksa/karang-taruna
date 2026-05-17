@props([
    'href' => null,
    'type' => 'button',
    'icon' => 'fas fa-plus-circle',
])

@once
    <style>
        .admin-primary-button {
            align-items: center;
            background: #07569f;
            border: 1px solid #064a88;
            border-radius: 3px;
            color: #ffffff;
            display: inline-flex;
            font-size: 0.95rem;
            font-weight: 800;
            gap: 10px;
            height: 56px;
            justify-content: center;
            min-width: 220px;
            padding: 0 24px;
            text-decoration: none;
            white-space: nowrap;
        }

        .admin-primary-button:hover,
        .admin-primary-button:focus {
            background: #064a88;
            border-color: #053d73;
            color: #ffffff;
        }

        @media (max-width: 991.98px) {
            .admin-primary-button {
                width: 100%;
            }
        }
    </style>
@endonce

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => 'admin-primary-button']) }}>
        @if($icon)<i class="{{ $icon }}"></i>@endif
        <span>{{ $slot }}</span>
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => 'admin-primary-button']) }}>
        @if($icon)<i class="{{ $icon }}"></i>@endif
        <span>{{ $slot }}</span>
    </button>
@endif
