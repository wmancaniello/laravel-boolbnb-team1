@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row text-center">
            <div class="col-12 my-4">
                <h4>Aggiungi nuovo appartamento</h4>
            </div>

            <form action='admin.flats.store' method="post" class="mb-3">
                @csrf

                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="title" placeholder="Inserisci Titolo"
                                    required value="{{old('title')}}">
                                <label for="title">Inserisci Titolo</label>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" id="max_guests" name="max_guests" placeholder="Numero Ospiti"
                                    required value="{{old('max_guests')}}">
                                <label for="max_guests">Numero Ospiti</label>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" id="rooms" name="rooms" placeholder="Numero Stanze"
                                    min="1" required value="{{old('rooms')}}">
                                <label for="rooms">Numero Stanze</label>
                            </div>
                        </div>


                        <div class="col-12 col-md-6">
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" id="beds" name="beds" placeholder="Numero Letti"
                                    min="1" required value="{{old('beds')}}">
                                <label for="beds">Numero Letti</label>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" id="bathrooms" name="bathrooms" placeholder="Numero Bagni"
                                    min="1" required value="{{old('bathrooms')}}">
                                <label for="bathrooms">Numero Bagni</label>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" id="meters_square" name="meters_square" placeholder="Metri quadrati"
                                    min="5" required value="{{old('meters_square')}}">
                                <label for="meters_square">Metri quadrati</label>
                            </div>
                        </div>
                        
                        <div class="col-12 col-md-6">
                            <div class="form-floating mb-3">
                                <select class="form-select" id="visible" name="visible" aria-label="Visibile">
                                    <option value="si" @selected(old('visible') == 'si')>Si</option>
                                    <option value="no" @selected(old('visible') == 'no')>No</option>
                                </select>
                                <label for="visible">Visibile</label>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="address" name="address" placeholder="Indirizzo"
                                    min="5" required>
                                <label for="address">Indirizzo</label>
                            </div>
                        </div>


                        <div class="col-12">
                            <div class="form-floating mb-3">
                                <textarea class="form-control" placeholder="Inserisci descrizione"  name="description" style="height: 100px"></textarea>
                                <label for="description">Descrizione</label>
                            </div>
                        </div>



                        
                        <div class="col-12">
                            <input type="file" class="form-control mb-3 ms_file" id="image"
                            placeholder="image" name="image" value="{{ old('image') }}">

                            <img id="anteprima-immagine" class="img-fluid d-block w-25 m-auto mb-3"
                            src="">
                        </div>
                        
                    </div>
                    <button type="submit" class="btn btn-success">Aggiungi</button>
            </form>

        </div>
    </div>
@endsection
