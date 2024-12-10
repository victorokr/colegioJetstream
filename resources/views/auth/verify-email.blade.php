<x-app-layout>
  <div class="container-fluid ">
    <div class="row d-flex justify-content-center">
        <div class="col col-sm-4 col-md-4 col-lg-4 col-xl-3 p-0">
            <div class="card border-light   shadow p-3 mb-5 bg-body-tertiary rounded">
                <img src="{{ asset('images/check-email.jpg') }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <div class="mb-4 text-muted">
                        {{ __('Antes de continuar ¿podría verificar su dirección de correo electrónico haciendo clic en el boton? ') }}
                    </div>

                    @if (session('status') == 'verification-link-sent')
                        <div class="mb-4 fw-medium text-success">
                            {{ __('Se ha enviado un nuevo enlace de verificación a la dirección de correo electrónico que proporcionaste en la configuración de tu perfil.') }}
                        </div>
                    @endif
                </div> 
                <ul class="list-group list-group-flush">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary">
                            {{ __('Enviar Verificación de correo') }}
                        </button>
                    </form>
                </ul>
                <div class="card-body">
                    <a href="{{ route('profile.show') }}" class="card-link text-decoration-underline text-muted hover-text-dark">
                        {{ __('Editar Perfil') }}
                    </a>

                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="card-link btn btn-link text-decoration-underline text-muted ms-2">
                            {{ __('Cerrar Sesión') }}
                        </button>
                    </form>
                </div>       
            </div>
        </div>
    </div>    
  </div>
</x-app-layout>
