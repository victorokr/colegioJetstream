<div class="card-group card-group__login ">
    <div class="row login__row d-flex justify-content-center mx-2">
        <div class="col  col-sm-6 col-md-6 col-lg-6 col-xl-6 p-0 mb-3">
            <div class="card border-light">
                <div class="card-header d-flex justify-content-center">
                    {{ $logo }}
                    
                </div>
                <div class="card-body">
                    <h5 class="card-title text-center pt-3 pb-2">
                        @if (request()->is('acudiente/login'))
                            Acudientes
                        @else
                            Docentes
                        @endif
                    </h5>
                    {{ $slot }}
                </div>
            </div>
        </div>
        <div class="col col-sm-6 col-md-6 col-lg-6 col-xl-6 p-0 ">
            <div class="card border-light ">
                <img src="{{ asset('images/logo-cisne.jpg') }}" class="card-img-top" alt="...">
                <div class="card-body login__card-body">
                    <p class="card-text login__card-text">Sistema de Gestion de Notas.</p>
                </div>
                <div class="card-footer text-body-secondary">
                    <p class="card-text login__card-text">Colegio Antonio Reyes.</p>
                </div>
            </div>
        </div>
        
    </div>
</div>
    






