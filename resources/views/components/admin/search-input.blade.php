@props([
    'name' => 'q',
    'placeholder' => 'Cari data...',
    'value' => null,
])

@once
    <style>
        .admin-search {
            position: relative;
        }

        .admin-search i {
            color: #9aa4b2;
            font-size: 1rem;
            left: 18px;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            z-index: 2;
        }

        .admin-control {
            border: 1px solid #d7e0ec;
            border-radius: 3px;
            box-shadow: none;
            color: #344154;
            font-size: 0.95rem;
            font-weight: 650;
            height: 56px;
        }

        .admin-search .admin-control {
            padding-left: 52px;
        }

        .admin-control:focus {
            border-color: #9bb7da;
            box-shadow: 0 0 0 0.16rem rgba(0, 75, 150, 0.14);
        }

        .admin-control::placeholder {
            color: #3f4b5d;
            opacity: 1;
        }
    </style>
@endonce

<div class="admin-search">
    <i class="fas fa-search"></i>
    <input
        type="text"
        name="{{ $name }}"
        class="form-control admin-control"
        placeholder="{{ $placeholder }}"
        value="{{ $value ?? request($name) }}"
    >
</div>
