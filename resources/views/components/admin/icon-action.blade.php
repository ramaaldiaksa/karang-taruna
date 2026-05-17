@props([
    'href' => null,
    'type' => 'button',
    'variant' => 'edit',
    'icon' => null,
    'title' => null,
])

@php
    $iconClass = $icon ?? ($variant === 'delete' ? 'fas fa-trash-alt' : 'fas fa-pencil-alt');
@endphp

@once
    <style>
        .admin-icon-action {
            align-items: center;
            background: transparent;
            border: 0;
            border-radius: 4px;
            display: inline-flex;
            height: 32px;
            justify-content: center;
            text-decoration: none;
            width: 32px;
        }

        .admin-icon-action:hover {
            background: #eef3f8;
        }

        .admin-icon-action--edit {
            color: #0b64b4;
        }

        .admin-icon-action--delete {
            color: #ff1d25;
        }

        .admin-icon-action--view {
            color: #07569f;
        }
    </style>
@endonce

@if($href)
    <a
        href="{{ $href }}"
        title="{{ $title }}"
        aria-label="{{ $title }}"
        {{ $attributes->merge(['class' => 'admin-icon-action admin-icon-action--' . $variant]) }}
    >
        <i class="{{ $iconClass }}"></i>
    </a>
@else
    <button
        type="{{ $type }}"
        title="{{ $title }}"
        aria-label="{{ $title }}"
        {{ $attributes->merge(['class' => 'admin-icon-action admin-icon-action--' . $variant]) }}
    >
        <i class="{{ $iconClass }}"></i>
    </button>
@endif
