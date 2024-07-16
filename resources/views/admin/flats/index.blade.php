@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>I TUOI APPARTAMENTI:</h1>

        <a class="btn btn-primary mt-3 mb-3" href="{{ route('admin.flats.create') }}">Inserisci</a>

        <div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Titolo</th>
                        <th scope="col">Indirizzo</th>
                        <th scope="col">Azioni</th>
                    </tr>
                </thead>

                @foreach ($flats as $flat)
                    <tbody>
                        <tr class="h-100">
                            <td>{{ $flat->title }}</td>
                            <td>{{ $flat->address }}</td>

                            <td class="text-nowrap h-100">
                                <div class="d-flex">
                                    <a class="btn btn-primary"
                                        href="{{ route('admin.flats.show', ['flat' => $flat->slug]) }}">Dettagli</a>
                                    <a href="{{ route('admin.flats.edit', ['flat' => $flat->slug]) }}"
                                        type="button"class="btn btn-outlime-primary p-0 ms-5">
                                        <i class="fa-solid fa-pencil rounded-1 text-primary border border-primary p-2"></i>
                                    </a>
                                    <div>
                                        <button type="button" class="btn p-0 ms-1" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal{{ $flat->slug }}">
                                            <i class="fa-solid fa-trash rounded-1 text-danger border border-danger p-2"></i>
                                        </button>
                                    </div>
                                </div>
                                {{-- Modale conferma --}}
                                @include('admin.partials.modal_delete')
                                {{-- /Modale --}}
                            </td>
                        </tr>
                    </tbody>
                @endforeach
            </table>
        </div>
    </div>
    @include('admin.partials.toast')
@endsection
