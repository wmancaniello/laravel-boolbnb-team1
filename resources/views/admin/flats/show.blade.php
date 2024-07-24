@extends('layouts.admin')

@section('content')
    <div class="container">

        <div class="d-flex mt-5 pt-3 justify-content-between">
            {{-- Pulsante Indietro --}}
            <a class="btn ms_brown_btn mb-3" href="{{ route('admin.flats.index') }}">
                <i class="fa-solid fa-arrow-left"></i> Torna indietro
            </a>

            {{-- Pulsanti Azione --}}
            <div class="">
                {{-- Sponsor --}}
                <button type="button" class="btn ms_brown_btn2 me-2" onclick="showSidebar()" id="sponsor-btn">
                    <i class="fa-solid fa-plane"></i> Sponsor
                </button>

                {{-- Modifica --}}
                <a class="btn ms_brown_btn2 me-2" href="{{ route('admin.flats.edit', ['flat' => $flat->slug]) }}">
                    <i class="fa-solid fa-pencil"></i> Modifica
                </a>

                {{-- Cancella --}}
                <button type="button" class="btn ms_brown_btn2" data-bs-toggle="modal"
                    data-bs-target="#deleteModal{{ $flat->slug }}">
                    <i class="fa-solid fa-trash"></i> Cancella
                </button>

                {{-- Modale conferma cancellazione --}}
                @include('admin.partials.modal_delete', ['flat' => $flat])
                {{-- Sidebar conferma sponsorizzazione --}}
                @include('admin.partials.sidebar_sponsor', ['flat' => $flat])
            </div>

        </div>


        <h1 class="mb-4">Dettagli Appartamento</h1>
        <div class="card mb-4">
            <div class="row g-0">
                <div class="col-md-4">
                    <img class="img-fluid rounded-start" src="{{ asset('storage/' . $flat->main_img) }}"
                        alt="Immagine di {{ $flat->title }}" style="height: 100%; object-fit: cover;">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h2 class="card-title">{{ $flat->title }}</h2>
                        <p class="card-text"><strong>Indirizzo:</strong> {{ $flat->address }}</p>
                        <p class="card-text"><strong>Descrizione:</strong> {{ $flat->description }}</p>
                        <div>
                            <button type="button" class="btn ms_brown_btn2" data-bs-toggle="modal"
                                data-bs-target="#galleryModal{{ $flat->slug }}">
                                <i class="fa-solid fa-images"></i> Galleria
                            </button>
                            {{-- Modale galleria --}}
                            @include('admin.partials.modal_gallery', ['flat' => $flat])
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tabella Informazioni --}}
        <div class="table-responsive mb-4">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th scope="row">Numero massimo di ospiti</th>
                        <td>{{ $flat->max_guests }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Numero di camere</th>
                        <td>{{ $flat->rooms }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Posti letto</th>
                        <td>{{ $flat->beds }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Bagni</th>
                        <td>{{ $flat->bathrooms }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Metri quadri</th>
                        <td>{{ $flat->meters_square }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Visibile</th>
                        <td>{{ $flat->visible ? 'Sì' : 'No' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="col-12">
            <div class="modal-services ms_border mb-3">
                <h6 id="title-service">
                    Servizi appartamento
                </h6>

                <div class="row wrapper-check justify-content-center g-1">
                    @foreach ($flat->services as $service)
                        <div class="col-6 col-lg-3">
                            <input type="checkbox" name="services[]" class="check-service" id="service-{{ $service->id }}"
                                value="{{ $service->id }}" checked disabled>
                            <label class="w-100" for="service-{{ $service->id }}">
                                <img src="{{ asset('storage/services/' . $service->icon) }}"
                                    alt="Icona {{ $service->name }}">
                                {{ $service->name }}
                            </label>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>

    </div>

    @include('admin.partials.toast')
    
@endsection
