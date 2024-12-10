@if ($errors->any())
    <div {{ $attributes }}>
        <div class="text-danger text-center">{{ __('Whoops! algo va mal.') }}</div>

        <ul class="mt-3 text-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
