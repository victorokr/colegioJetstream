@props(['value'])

<label class="form-label mb-0">
    {{ $value ?? $slot }}
</label>
