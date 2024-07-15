@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>I TUOI APPARTAMENTI:</h1>

        <a class="btn btn-primary mt-3 mb-3" href="{{ route('admin.flats.create') }}">Inserisci un nuovo appartamento</a>

        <div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Titolo</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Indirizzo</th>
                    </tr>
                </thead>

                @foreach ($flats as $flat)
                    <tbody>
                        <tr>
                            <th scope="row">{{ $flat->id }}</th>
                            <td>{{ $flat->title }}</td>
                            <td>{{ $flat->slug }}</td>
                            <td>{{ $flat->address }}</td>

                            <td class="text-nowrap d-flex">

                                <a class="btn btn-primary"
                                    href="{{ route('admin.flats.show', ['flat' => $flat->slug]) }}">Dettagli</a>
                                <a href="{{ route('admin.flats.edit', ['flat' => $flat->slug]) }}"
                                    type="button"class="btn btn-outlime-primary p-0 ms-5">
                                    <i class="fa-solid fa-pencil rounded-1 text-primary border border-primary p-2"></i>
                                </a>
                                <form action="{{ route('admin.flats.destroy', ['flat' => $flat->slug]) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn p-0" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">
                                        <i class="fa-solid fa-trash border border-danger text-danger p-2 rounded-1"></i>
                                    </button>

                                </form>


                            </td>
                        </tr>
                    </tbody>
                @endforeach
            </table>
        </div>
    </div>
@endsection
