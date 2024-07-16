<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{-- {{ config('app.name', 'Laravel') }} --}}BoolBnB</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body class="ms_bg_primary">
    <div id="app">

        <header class=" position-fixed top-0 btnColor h10vh mt5vh">
            <div class="ms_cell5">
                <div class="d-flex justify-content-center align-items-center h-100 letter-spacing">
                    <a class="text-white {{ Route::currentRouteName() == 'admin.dashboard' ? 'text-primary' : '' }}"
                        href="{{ route('admin.dashboard') }}">
                        Dashboard
                    </a>
                </div>
                @php
                    use App\Models\Flat;
                @endphp
            </div>
            <div class="ms_cell5">
                @if (count(Flat::where('user_id', Auth::id())->get()) >= 1)
                    <div class="d-flex justify-content-center align-items-center h-100 letter-spacing">
                        <a class="text-white {{ Route::currentRouteName() == 'admin.flats.index' ? 'text-primary' : '' }}"
                            href="{{ route('admin.flats.index') }}">
                            I tuoi appartamenti
                        </a>
                    </div>
                @endif
            </div>
            <div class="ms_cell5">
                <div class="d-flex justify-content-center align-items-center h-100 letter-spacing">
                    <a class="text-white {{ Route::currentRouteName() == 'admin.flats.create' ? 'text-primary' : '' }}"
                        href="{{ route('admin.flats.create') }}">
                        Nuovo Appartamento
                    </a>
                </div>
            </div>
            <div class="ms_cell5">
                <div class="letter-spacing d-flex justify-content-center align-items-center h-100">
                    <a class="text-white {{ Route::currentRouteName() == 'admin.messages.index' ? 'text-secondary' : '' }}"
                        href="{{ route('admin.messages.index') }}">
                        Notifiche
                    </a>
                </div>
            </div>
            <div class="ms_cell5">
                <div class="letter-spacing d-flex text-white justify-content-center align-items-center h-100">
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

            {{-- <div class="navbar-nav">
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
            </div> --}}
        </header>
        <div class="container-fluid h90vh">
            <div class="row h-100">
                <!-- Definire solo parte del menu di navigazione inizialmente per poi
        aggiungere i link necessari giorno per giorno
        -->
                {{-- <nav id="sidebarMenu" class="col-md-3 col-lg-3 d-md-block bg-dark navbar-dark sidebar collapse">
                    <div class="position-sticky py-3">
                        <ul class="nav flex-column">


                            <li class="nav-item">
                                <a class="nav-link text-white rounded-2 {{ Route::currentRouteName() == 'admin.dashboard' ? 'bg-primary' : '' }}"
                                    href="{{ route('admin.dashboard') }}">
                                    Dashboard
                                </a>
                            </li>
                            @php
                                use App\Models\Flat;
                            @endphp








                            @if (count(Flat::where('user_id', Auth::id())->get()) >= 1)
                                <li class="nav-item">
                                    <a class="nav-link text-white rounded-2 {{ Route::currentRouteName() == 'admin.flats.index' ? 'bg-primary' : '' }}"
                                        href="{{ route('admin.flats.index') }}">
                                        <i class="fa-solid fa-building"></i> I tuoi appartamenti
                                    </a>
                                </li>
                            @endif











                            <li class="nav-item">
                                <a class="nav-link text-white rounded-2 {{ Route::currentRouteName() == 'admin.flats.create' ? 'bg-primary' : '' }}"
                                    href="{{ route('admin.flats.create') }}">
                                    <i class="fa-solid fa-plus"></i> Aggiungi Appartamento
                                </a>
                            </li>








                            <li class="nav-item">
                                <a class="nav-link text-white rounded-2 {{ Route::currentRouteName() == 'admin.messages.index' ? 'bg-primary' : '' }}"
                                    href="{{ route('admin.messages.index') }}">
                                    <i class="fa-solid fa-bell"></i> Notifiche
                                </a>
                            </li>


                        </ul>
                    </div>
                </nav> --}}
                <main class="p-0">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>

</html>
