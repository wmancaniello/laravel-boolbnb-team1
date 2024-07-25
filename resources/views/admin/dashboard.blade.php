@extends('layouts.admin')
@section('content')
    {{-- Welcome --}}
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-4">
                <div class="text-center">
                    @if (session('status'))
                        <div class="" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h1 class="letter-spacing">
                        @php
                            $username = ucfirst(strtolower(Auth::user()->name));
                        @endphp
                        {{ __('Benvenuto') }} {{ $username }} {{ __('!') }}<br>
                        {{ __('Ecco il tuo pannello di controllo:') }}
                    </h1>
                </div>
            </div>
        </div>
    </div>
    {{-- / Welcome --}}

    {{-- CARD --}}
    <div class="container mt-5">
        <div class="row justify-content-center">
            <!-- Card Appartamenti -->
            @php
                use App\Models\Flat;
            @endphp
            @if (count(Flat::where('user_id', Auth::id())->get()) >= 1)
                <div class="col-12 col-md-6 col-lg-4 mb-4" style="height: 200px; width: 200px">
                    <a href="http://127.0.0.1:8000/admin/flats"
                        class="card text-center h-100 text-decoration-none text-dark">
                        <div
                            class="card-body d-flex flex-column justify-content-center align-items-center ms_color-dashboard hover-effect">
                            <i class="fa-solid fa-house-user fa-2x mb-3"></i>
                            <h5 class="card-title">I tuoi appartamenti</h5>
                        </div>
                    </a>
                </div>
            @endif
            <!-- Card Aggiungi Appartamento -->
            <div class="col-12 col-md-6 col-lg-4 mb-4" style="height: 200px; width: 200px">
                <a href="http://127.0.0.1:8000/admin/flats/create"
                    class="card text-center h-100 text-decoration-none text-dark">
                    <div
                        class="card-body d-flex flex-column justify-content-center align-items-center ms_color-dashboard hover-effect">
                        <i class="fa-solid fa-house-medical fa-2x mb-3"></i>
                        <h5 class="card-title">Aggiungi appartamento</h5>
                    </div>
                </a>
            </div>
            <!-- Card Messaggi -->
            @if (count(Flat::where('user_id', Auth::id())->get()) >= 1)
                <div class="col-12 col-md-6 col-lg-4 mb-4" style="height: 200px; width: 200px">
                    <a href="http://127.0.0.1:8000/admin/messages"
                        class="card text-center h-100 text-decoration-none text-dark">
                        <div
                            class="card-body d-flex flex-column justify-content-center align-items-center ms_color-dashboard hover-effect">
                            <i class="fa-solid fa-envelope fa-2x mb-3"></i>
                            <h5 class="card-title">Messaggi</h5>
                        </div>
                    </a>
                </div>
            @endif
            <!-- Card Logout -->
            <div class="col-12 col-md-6 col-lg-4 mb-4" style="height: 200px; width: 200px">
                <a href="{{ route('logout') }}" class="card text-center h-100 text-decoration-none text-dark"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <div
                        class="card-body d-flex flex-column justify-content-center align-items-center ms_color-dashboard hover-effect">
                        <i class="fa-solid fa-arrow-right-from-bracket fa-2x mb-3"></i>
                        <h5 class="card-title">Logout</h5>
                    </div>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </div>
    {{-- /CARD --}}
@endsection
