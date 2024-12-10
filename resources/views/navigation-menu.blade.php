<nav class="navbar navbar__custom navbar-expand-lg   shadow-sm p-3 mb-0 bg-body-tertiary rounded">
    <div class="container-fluid nav-auth__container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse nav-auth__collapse" id="navbarSupportedContent">
                    <a class="navbar-brand js-scroll-trigger" href="{{ url('/dashboard') }}">
                        <img class="img-fluid" width="65" height="65" src="{{ asset('images/logocisne-nav.png') }}" alt="" />
                    </a> 
                <ul class="navbar-nav ms-auto nav-auth__ul  mb-2 mb-lg-0">
                        
                   

                    <li class="nav-item">
                          <a class="nav-link" aria-current="page" href="{{ url('/dashboard') }}">pagina principal</a>
                    </li>
                        
                            
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
                        <ul class="dropdown-menu">
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
    </div>
</nav>
