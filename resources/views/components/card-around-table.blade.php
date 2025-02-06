<div class="row  mx-2">
    <div class="col p-0 mb-3">
        <div {{ $attributes->merge(['class' => 'card border-light shadow']) }}>
            <div class="card-header bg-body-secondary">
                {{ $header }}
            </div>
            <div class="card-body">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
