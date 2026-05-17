@props([
    'name',
    'placeholder' => 'Semua Data',
    'options' => [],
    'value' => null,
    'autosubmit' => true,
])

@php
    $selectedValue = $value ?? request($name);
@endphp

<select
    name="{{ $name }}"
    class="form-select admin-control"
    @if($autosubmit) onchange="this.form.submit()" @endif
>
    <option value="">{{ $placeholder }}</option>
    @foreach($options as $optionValue => $optionLabel)
        @php
            $actualValue = is_int($optionValue) ? $optionLabel : $optionValue;
        @endphp
        <option value="{{ $actualValue }}" {{ (string) $selectedValue === (string) $actualValue ? 'selected' : '' }}>
            {{ $optionLabel }}
        </option>
    @endforeach
</select>
