<btn_edit {{ $attributes->merge(['class' => 'btn btn-sm']) }}>
    <img src="/images/edit.png" alt="Editar" style="width: 24px; height: 24px;">
    {{ $slot }}
</btn_edit>
