@props([
    'submitLabel' => 'Simpan',
    'submitIcon' => 'fas fa-save',
    'cancelLabel' => 'Batal',
])

<div {{ $attributes->merge(['class' => 'modal-footer admin-modal__footer']) }}>
    @if($cancelLabel)
        <button type="button" class="btn admin-modal__button admin-modal__button--secondary" data-bs-dismiss="modal">
            {{ $cancelLabel }}
        </button>
    @endif

    <button type="submit" class="btn admin-modal__button admin-modal__button--primary">
        @if($submitIcon)
            <i class="{{ $submitIcon }}"></i>
        @endif
        <span>{{ $submitLabel }}</span>
    </button>
</div>
