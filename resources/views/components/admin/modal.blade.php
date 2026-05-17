@props([
    'id',
    'title',
    'icon' => null,
    'size' => null,
])

@php
    $labelId = $id . 'Label';
    $dialogClass = trim('modal-dialog modal-dialog-centered ' . ($size ? 'modal-' . $size : ''));
@endphp

@once
    <style>
        .admin-modal__content {
            border: 0;
            border-radius: 8px;
            box-shadow: 0 18px 48px rgba(20, 35, 55, 0.24);
            overflow: hidden;
        }

        .admin-modal__header {
            background: #07569f;
            border-bottom: 0;
            color: #ffffff;
            min-height: 76px;
            padding: 22px 28px;
        }

        .admin-modal__title {
            align-items: center;
            display: inline-flex;
            font-size: 1.3rem;
            font-weight: 800;
            gap: 10px;
            line-height: 1.2;
            margin: 0;
        }

        .admin-modal__close {
            box-shadow: none;
            opacity: 0.85;
        }

        .admin-modal__close:hover,
        .admin-modal__close:focus {
            opacity: 1;
        }

        .admin-modal__body {
            padding: 28px;
        }

        .admin-modal__footer {
            border-top: 0;
            gap: 10px;
            padding: 0 28px 28px;
        }

        .admin-modal__button {
            align-items: center;
            border-radius: 6px;
            display: inline-flex;
            font-weight: 800;
            gap: 8px;
            justify-content: center;
            min-height: 46px;
            padding: 0 22px;
        }

        .admin-modal__button--primary {
            background: #07569f;
            border: 1px solid #064a88;
            color: #ffffff;
        }

        .admin-modal__button--primary:hover,
        .admin-modal__button--primary:focus {
            background: #064a88;
            border-color: #053d73;
            color: #ffffff;
        }

        .admin-modal__button--secondary {
            background: #f4f6f8;
            border: 1px solid #f4f6f8;
            color: #1f2937;
        }

        .admin-modal__button--secondary:hover,
        .admin-modal__button--secondary:focus {
            background: #e9eef4;
            border-color: #e9eef4;
            color: #1f2937;
        }

        @media (max-width: 575.98px) {
            .admin-modal__header,
            .admin-modal__body,
            .admin-modal__footer {
                padding-left: 20px;
                padding-right: 20px;
            }

            .admin-modal__footer {
                flex-direction: column-reverse;
            }

            .admin-modal__button {
                width: 100%;
            }
        }
    </style>
@endonce

<div
    id="{{ $id }}"
    tabindex="-1"
    aria-labelledby="{{ $labelId }}"
    aria-hidden="true"
    {{ $attributes->merge(['class' => 'modal fade admin-modal']) }}
>
    <div class="{{ $dialogClass }}">
        <div class="modal-content admin-modal__content">
            <div class="modal-header admin-modal__header">
                <h5 class="modal-title admin-modal__title" id="{{ $labelId }}">
                    @if($icon)
                        <i class="{{ $icon }}"></i>
                    @endif
                    <span>{{ $title }}</span>
                </h5>
                <button type="button" class="btn-close btn-close-white admin-modal__close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>

            {{ $slot }}
        </div>
    </div>
</div>
