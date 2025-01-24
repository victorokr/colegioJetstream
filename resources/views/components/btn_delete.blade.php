<btn_delete {{ $attributes->merge(['class' => 'btn btn-sm']) }}>
    <img src="/images/basura1.png" alt="Eliminar" style="width: 24px; height: 24px;">
    {{ $slot }}
</btn_delete>
