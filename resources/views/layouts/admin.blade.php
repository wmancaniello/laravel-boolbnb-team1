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

        <header>

            <nav class="navbar navbar-expand-lg ms_headernav sticky-top">
                <div class="container-fluid">
                    <router-link class="navbar-brand font" to="/">BoolBnB</router-link>
                    <button class="navbar-toggler font border" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                    <div class="collapse navbar-collapse" id="navbar">
                        <ul class="navbar-nav gap-2 ms-auto mb-lg-0">
                            <li class="">
                                <a class="nav-link ms_hover font {{ Route::currentRouteName() == 'admin.dashboard' ? 'ms_current_link' : '' }}"
                                    href="{{ route('admin.dashboard') }}">
                                    Dashboard
                                </a>
                            </li>
                            @php
                                use App\Models\Flat;
                            @endphp

                            @if (count(Flat::where('user_id', Auth::id())->get()) >= 1)
                                <li class="nav-item">
                                    <a class="nav-link ms_hover font {{ Route::currentRouteName() == 'admin.flats.index' ? 'ms_current_link' : '' }}"
                                        href="{{ route('admin.flats.index') }}">
                                        I tuoi appartamenti
                                    </a>
                                </li>
                            @endif

                            <li class="nav-item">
                                <a class="nav-link ms_hover font {{ Route::currentRouteName() == 'admin.flats.create' ? 'ms_current_link' : '' }}"
                                href="{{ route('admin.flats.create') }}">
                                Nuovo Appartamento
                            </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link ms_hover font {{ Route::currentRouteName() == 'admin.messages.index' ? 'ms_current_link' : '' }}"
                                href="{{ route('admin.messages.index') }}">
                                Notifiche
                            </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link ms_hover font" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                            </li>


                        </ul>

                    </div>
                </div>
            </nav>


        </header>
        <div class="container-fluid h90vh">
            <div class="row h-100">

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
