<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'colegio') }}</title>
        <link rel="shortcut icon" href="{{ asset('images/logocisne-nav.png') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- bootstrap css -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
       
    </head>
    <body>
        
        <x-Nav />
        <!-- loading spinner -->
        <div id="loader" class="spinner-div d-flex justify-content-center align-items-center ">
            <div class="spinner-grow  text-light spinner-custom"  role="status">
                <!-- <span class="visually-hidden">Loading...</span> -->
            </div>
        </div>

        <div class="d-flex justify-content-center">
                <!-- aca se inyecta el forma login y register -->
                {{ $slot }}
        </div>
        <footer class="bg-dark text-white footer__style  fixed-bottom pt-5 pb-4 d-flex justify-content-center">
            <div class="container-fluid text-center">
            <p class="text-center  text-md-left">&copy;Todos los derechos reservados. 2024 Softcode.
                <a href="#" style="text-decoration: none;">
                  <strong class="text-warning"></strong>
                </a>
            </p>
            </div>    
        </<footer>    
        @livewireScripts
        <!-- bootstrap js -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>