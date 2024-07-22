@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1 class=" pt-5">I TUOI APPARTAMENTI:</h1>

        <a class="btn ms_brown_btn mt-3 mb-3" href="{{ route('admin.flats.create') }}">Inserisci</a>

        <style>
            .card-img-top {
                height: 200px; /* Altezza fissa */
                width: 100%; /* Larghezza al 100% */
                object-fit: cover; /* Mantiene le proporzioni e copre l'intero spazio */
            }
        </style>

        <div class="row justify-content-start">
            @foreach ($flats as $flat)
                <div class="col-md-5 mb-4 col-lg-4">
                    <div class="card h-100 ms_card">
                        <!-- Immagine dell'appartamento -->
                        <img src="{{ asset('storage/' . $flat->main_img) }}" class="card-img-top" alt="Immagine di {{ $flat->title }}">

                        <div class="card-body d-flex flex-column ">
                            <h5 class="card-title">{{ $flat->title }}</h5>
                            <p class="card-text">{{ $flat->address }}</p>
                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-center">
                                    <a class="btn ms_brown_btn" href="{{ route('admin.flats.show', ['flat' => $flat->slug]) }}">Dettagli</a>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.flats.edit', ['flat' => $flat->slug]) }}" class="btn btn-outline-primary" title="Modifica">
                                            <i class="fa-solid fa-pencil"></i>
                                        </a>
                                        <button type="button" class="btn btn-outline-danger" title="Elimina" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal{{ $flat->slug }}">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Modale conferma --}}
                @include('admin.partials.modal_delete', ['flat' => $flat])
                {{-- /Modale --}}
            @endforeach
        </div>
    </div>
    @include('admin.partials.toast')
@endsection
