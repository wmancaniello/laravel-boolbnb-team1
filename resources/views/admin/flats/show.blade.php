@extends('layouts.admin')

@section('content')

    <div class="container">
        <h1>I TUOI APPARTAMENTI:</h1>

        <div>
            <h2>{{ $flat->title }}</h2>
            <img class="w-25" src="{{ asset('storage/' . $flat->main_img) }}" alt="main_img">
        </div>
        {{-- tabella info --}}
        <div>
            <table class="table mt-3">
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
                        <th scope="row">Metri qudri</th>
                        <td>{{ $flat->meters_square }}</td>
                    </tr>

                    <tr>
                        <th scope="row">Indirizzo</th>
                        <td>{{ $flat->address }}</td>
                    </tr>

                    <tr>
                        <th scope="row">Descrizione</th>
                        <td>{{ $flat->description }}</td>
                    </tr>

                    <tr>
                        <th scope="row">Visibile</th>
                        <td>{{ $flat->visible }}</td>
                    </tr>

                </tbody>
            </table>
        </div>

        <div class="modal-services mb-3">
            <h6>
                Servizi appartamento
            </h6>
            <div class="container">
                <div class="row wrapper-check justify-content-center g-1">
                    @foreach ($flat->services as $service)
                        <div class="col-6 col-lg-3">
                            <input type="checkbox" name="services[]" class="check-service"
                                id="service-{{ $service->id }}" value="{{ $service->id }}" checked disabled>
                            <label for="service-{{ $service->id }}">
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

    @endsection