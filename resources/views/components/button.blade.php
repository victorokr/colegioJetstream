
<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-sm btn-primary d-inline-flex align-items-center d-flex justify-content-center px-3 font-weight-semibold']) }}>
    {{ $slot }}
</button>
