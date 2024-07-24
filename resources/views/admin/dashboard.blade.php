@extends('layouts.admin')

@section('content')
    {{-- Welcome --}}
    <div class="container mt10vh">
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
    <div class="container mt-4">
        <div class="row justify-content-center">
            <!-- Card 1 -->
            <div class="col-12 col-md-6 col-lg-4 mb-4" style="height: 300px">
                <a href="http://127.0.0.1:8000/admin/flats" class="card text-center h-100 text-decoration-none text-dark">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <i class="fa-solid fa-house-user fa-4x mb-3"></i>
                        <h5 class="card-title">I tuoi appartamenti</h5>
                    </div>
                </a>
            </div>
            <!-- Card 2 -->
            <div class="col-12 col-md-6 col-lg-4 mb-4" style="height: 300px">
                <a href="http://127.0.0.1:8000/admin/messages"
                    class="card text-center h-100 text-decoration-none text-dark">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <i class="fa-solid fa-envelope fa-4x mb-3"></i>
                        <h5 class="card-title">Messaggi</h5>
                    </div>
                </a>
            </div>
            <!-- Card 3 -->
            <div class="col-12 col-md-6 col-lg-4 mb-4" style="height: 300px">
                <a href="http://127.0.0.1:8000/admin/flats/create"
                    class="card text-center h-100 text-decoration-none text-dark">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <i class="fa-solid fa-house-medical fa-4x mb-3"></i>
                        <h5 class="card-title">Aggiungi appartamento</h5>
                    </div>
                </a>
            </div>
        </div>
    </div>
    {{-- /CARD --}}
@endsection
