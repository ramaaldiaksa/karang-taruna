@props([
    'paginator',
    'label' => 'entri',
])

@php
    $elements = $paginator->hasPages()
        ? Illuminate\Pagination\UrlWindow::make($paginator)
        : [];
@endphp

@once
    <style>
        .admin-pagination {
            align-items: center;
            background: #ffffff;
            border-top: 1px solid #dce3ec;
            display: flex;
            justify-content: space-between;
            min-height: 86px;
            padding: 20px 28px;
            width: 100%;
        }

        .admin-pagination__info {
            color: #50647f;
            font-size: 0.95rem;
            font-weight: 800;
        }

        .admin-pagination__nav {
            align-items: center;
            display: flex;
            gap: 16px;
            margin: 0;
        }

        .admin-pagination__link,
        .admin-pagination__dots {
            align-items: center;
            border-radius: 4px;
            color: #657084;
            display: inline-flex;
            font-size: 0.95rem;
            font-weight: 800;
            height: 38px;
            justify-content: center;
            min-width: 40px;
            padding: 0 10px;
            text-decoration: none;
        }

        .admin-pagination__link:hover {
            background: #f1f5f9;
            color: #004b96;
        }

        .admin-pagination__link.is-active {
            background: #004b96;
            color: #ffffff;
        }

        .admin-pagination__link.is-disabled {
            color: #9aa4b2;
            cursor: not-allowed;
            pointer-events: none;
        }

        @media (max-width: 767.98px) {
            .admin-pagination {
                align-items: flex-start;
                flex-direction: column;
                gap: 16px;
                padding: 18px;
            }

            .admin-pagination__nav {
                flex-wrap: wrap;
                gap: 8px;
            }
        }
    </style>
@endonce

@if($paginator->total() > 0)
    <div class="admin-pagination">
        <div class="admin-pagination__info">
            Menampilkan {{ $paginator->firstItem() }}-{{ $paginator->lastItem() }} dari {{ $paginator->total() }} {{ $label }}
        </div>

        <nav class="admin-pagination__nav" aria-label="Navigasi halaman">
            @if($paginator->onFirstPage())
                <span class="admin-pagination__link is-disabled" aria-disabled="true">
                    <i class="fas fa-chevron-left"></i>
                </span>
            @else
                <a class="admin-pagination__link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Halaman sebelumnya">
                    <i class="fas fa-chevron-left"></i>
                </a>
            @endif

            @if($paginator->hasPages())
                @foreach($elements as $element)
                    @if(is_string($element))
                        <span class="admin-pagination__dots">{{ $element }}</span>
                    @endif

                    @if(is_array($element))
                        @foreach($element as $page => $url)
                            @if($page == $paginator->currentPage())
                                <span class="admin-pagination__link is-active" aria-current="page">{{ $page }}</span>
                            @else
                                <a class="admin-pagination__link" href="{{ $url }}">{{ $page }}</a>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            @else
                <span class="admin-pagination__link is-active" aria-current="page">1</span>
            @endif

            @if($paginator->hasMorePages())
                <a class="admin-pagination__link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Halaman berikutnya">
                    <i class="fas fa-chevron-right"></i>
                </a>
            @else
                <span class="admin-pagination__link is-disabled" aria-disabled="true">
                    <i class="fas fa-chevron-right"></i>
                </span>
            @endif
        </nav>
    </div>
@endif
