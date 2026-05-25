@props([
    'paginator' => null,
])

@once
    <style>
        .admin-table-card {
            background: #ffffff;
            border: 1px solid #d7e0ec;
            border-radius: 3px;
            overflow: hidden;
        }

        .admin-table {
            color: #344154;
            font-size: 0.95rem;
            margin-bottom: 0;
        }

        .admin-table thead th {
            background: #f4f6f8;
            border-bottom: 1px solid #d7e0ec;
            color: #4c5b73;
            font-size: 0.82rem;
            font-weight: 900;
            padding: 24px 30px;
            text-transform: uppercase;
            vertical-align: middle;
        }

        .admin-table tbody td {
            border-bottom: 1px solid #dfe7f0;
            font-weight: 400;
            padding: 22px 30px;
            vertical-align: middle;
        }

        .admin-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .admin-table__code {
            color: #005baa;
            font-weight: 900;
            text-decoration: none;
        }

        .admin-table__muted {
            color: #6b7789;
        }

        .admin-status-pill {
            border-radius: 999px;
            display: inline-flex;
            font-size: 0.82rem;
            font-weight: 400;
            line-height: 1.1;
            padding: 10px 18px;
            white-space: nowrap;
        }

        .admin-status-pill--success {
            font-size: 0.85rem;
            font-weight: 500;
            background: #c9f8df;
            color: #008e5a;
        }

        .admin-status-pill--warning {
            font-size: 0.85rem;
            font-weight: 500;
            background: #fff0bd;
            color: #b37300;
        }

        .admin-status-pill--danger {
            font-size: 0.85rem;
            font-weight: 500;
            background: #ffe1e1;
            color: #d92727;
        }

        .admin-table-empty {
            color: #6b7789;
            padding: 56px 24px;
            text-align: center;
        }
    </style>
@endonce

<div {{ $attributes->merge(['class' => 'admin-table-card']) }}>
    {{ $slot }}

    @if($paginator && $paginator->total() > 0)
        <x-admin.pagination :paginator="$paginator" />
    @endif
</div>
