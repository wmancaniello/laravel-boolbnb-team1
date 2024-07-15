@extends('layouts.admin')

@section('content')

    <div class="container">
        <h1>I TUOI APPARTAMENTI</h1>

        <div>
            <h2>{{ $flat->title }}</h2>
            <img src="{{ asset('storage/' . $flat->main_img) }}" alt="main_img">
        </div>
        {{-- tabella info --}}
        <div>
            <table class="table">
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
                        <th scope="row">3</th>
                        <td colspan="2">Larry the Bird</td>
                        <td>@twitter</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
