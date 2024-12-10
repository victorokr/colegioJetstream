@props(['disabled' => false])

<div >
<input {{ $attributes->merge(['class' => 'form-control', 'placeholder' => $attributes->get('placeholder')]) }} {{ $disabled ? 'disabled' : '' }}>
    {{ $slot }}
</div>
