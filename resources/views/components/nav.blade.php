@if (Route::has('login'))
<!-- Navigation. fixed-top mantiene el nav visible en todo momento al hacer scroll -->
<nav class="navbar navbar__custom navbar-expand-lg  bg-body-tertiary">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <a class="navbar-brand js-scroll-trigger" href="#">
                        <img class="img-fluid" width="200" height="200" src="{{ asset('images/logoCol.png') }}" alt="" />
                    </a> 
                    <ul class="navbar-nav ms-auto  mb-2 mb-lg-0">
                        @auth
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{ url('/dashboard') }}">pagina principal</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{ url('/') }}">Home</a>
                            </li>
                            <!-- <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{ route('login') }}">Iniciar Sesión</a>
                            </li> -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Iniciar Sesión
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('login') }}">Docentes</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="{{ url('/acudiente/login') }}">Acudientes</a></li>
                                </ul>
                            </li>
                        @endauth    
                    </ul>
                </div>
            </div>
</nav>
@endif