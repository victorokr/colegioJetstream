

@props(['disabled' => false])

<div>
    <input  {{ $attributes->merge(['class' => 'form-control form-control-sm', 'placeholder' => $attributes->get('placeholder')]) }} {{ $disabled ? 'disabled' : '' }}>
    {{ $slot }}
</div>
