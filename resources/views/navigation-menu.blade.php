
<nav class="navbar navbar__custom navbar-expand-lg shadow-sm  mb-0 bg-body-tertiary rounded fixed-top ">
    <div class="container-fluid nav-auth__container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <a class="navbar-brand js-scroll-trigger" href="{{ url('/dashboard') }}">
            <img class="img-fluid" width="65" height="65" src="{{ asset('images/logocisne-nav.png') }}" alt="" />
        </a>

        <!-- Botón del sidebar -->
        <button class="btn btn-outline-info btn-sm" id="sidebarToggle" type="button">
            Menu
        </button>



        <div class="collapse navbar-collapse  nav-auth__collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto nav-auth__ul mb-2 mb-lg-0">
                <div class="form-check form-switch mx-4">
                    <input class="form-check-input" type="checkbox" role="switch" id="themeSwitch">
                    <label class="form-check-label" for="themeSwitch">Modo Oscuro</label>
                </div>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ url('/dashboard') }}">Página Principal</a>
                </li>
                <li class="nav-item dropdown ">
                    <a class="nav-link dropdown-toggle p-0" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <!-- Manejo de perfil -->
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <button class="btn btn-link p-0 border-0">
                                <img class="rounded-circle" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->nombres }}" width="62" height="62">
                            </button>
                        @else
                            <button type="button" class="btn btn-outline-secondary dropdown-toggle">
                                {{ Auth::user()->name }}
                            </button>
                        @endif
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end ">
                        <li><a class="dropdown-item" href="{{ route('profile.show') }}">Perfil</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <form method="POST" action="{{ route('logout') }}" x-data>
                            @csrf
                            <li><a class="dropdown-item" @click.prevent="$root.submit();" href="{{ route('logout') }}">Cerrar Sesión</a></li>
                        </form>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
        <div id="customSidebar" class="sidebar">
            <button class="close-btn " id="closeSidebar">&times;</button>
            <ul class="sidebar-links">
                <li class="d-flex flex-row"><span class="material-symbols-outlined mx-2 fs-5 d-flex align-items-center">group</span><a href="/lista/docentes">Docentes</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </div>
    </div>
</nav>


