
<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-primary d-inline-flex align-items-center d-flex justify-content-center px-3 py-2 font-weight-semibold']) }}>
    {{ $slot }}
</button>
