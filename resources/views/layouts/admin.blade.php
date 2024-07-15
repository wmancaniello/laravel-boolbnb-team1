<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body>
    <div id="app">

        <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 h10vh">
            <div class="row justify-content-center align-items-center col-3 h-100 font-monospace">
                <a class="navbar-brand col-md-3 col-lg-2 me-0 w-100 text-center fw-bold fs-2"
                    href="/">BOOLBNB</a>
                <button class="navbar-toggler position-absolute d-md-none collapsed" type="button"
                    data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="navbar-nav">
                <div class="nav-item text-nowrap me-5 ">
                    <a class="nav-link" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </header>
        <div class="container-fluid h90vh">
            <div class="row h-100">
                <!-- Definire solo parte del menu di navigazione inizialmente per poi
        aggiungere i link necessari giorno per giorno
        -->
                <nav id="sidebarMenu" class="col-md-3 col-lg-3 d-md-block bg-dark navbar-dark sidebar collapse">
                    <div class="position-sticky py-3">
                        <ul class="nav flex-column">
                            {{-- ----------- DASHBOARD --------------- --}}
                            <li class="nav-item">
                                <a class="nav-link text-white rounded-2 {{ Route::currentRouteName() == 'admin.dashboard' ? 'bg-primary' : '' }}"
                                    href="{{ route('admin.dashboard') }}">
                                     Dashboard
                                </a>
                            </li>
                            @php
                                use App\Models\Flat;
                            @endphp
                            {{-- ----------- LISTA APPARTAMENTI --------------- --}}
                            @if (count(Flat::where('user_id', Auth::id())->get()) >= 1)
                                <li class="nav-item">
                                    <a class="nav-link text-white rounded-2 {{ Route::currentRouteName() == 'admin.flats.index' ? 'bg-primary' : '' }}"
                                        href="{{ route('admin.flats.index') }}">
                                        <i class="fa-solid fa-building"></i> I tuoi appartamenti
                                    </a>
                                </li>
                            @endif
                            {{-- ----------- /LISTA APPARTAMENTI --------------- --}}

                            {{-- ----------- ADD APPARTAMENTO --------------- --}}
                            <li class="nav-item">
                                <a class="nav-link text-white rounded-2 {{ Route::currentRouteName() == 'admin.flats.create' ? 'bg-primary' : '' }}"
                                    href="{{ route('admin.flats.create') }}">
                                    <i class="fa-solid fa-plus"></i> Aggiungi Appartamento
                                </a>
                            </li>
                            {{-- ----------- MESSAGGI --------------- --}}
                            <li class="nav-item">
                                <a class="nav-link text-white rounded-2 {{ Route::currentRouteName() == 'admin.messages.index' ? 'bg-primary' : '' }}"
                                    href="{{ route('admin.messages.index') }}">
                                    <i class="fa-solid fa-bell"></i> Notifiche
                                </a>
                            </li>
                            {{-- ----------- MESSAGGI--------------- --}}
                        </ul>
                    </div>
                </nav>
                <main class="col-md-9 ms-sm-auto col-lg-9 p-0">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
</body>

</html>
