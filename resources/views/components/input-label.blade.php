@props(['value'])

<label {{ $attributes->merge(['for' => '', 'class' => 'form-label']) }}>
    {{ $value ?? $slot }}
</label>
