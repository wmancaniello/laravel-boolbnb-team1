@extends('layouts.admin')

@section('content')
    <div class="container mt10vh">
        <!-- Pulsante Indietro -->
        <a class="btn btn-primary mt-3 mb-3" href="{{ route('admin.flats.index') }}">
            <i class="fa-solid fa-arrow-left"></i> Torna Indietro
        </a>

        <div class="row text-center">
            <div class="col-12 my-4">
                <h4>Aggiungi Nuovo Appartamento</h4>
            </div>

            <form action="{{ route('admin.flats.store') }}" method="post" class="mb-3" enctype="multipart/form-data">
                @csrf

                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Inserisci Titolo" required value="{{ old('title') }}">
                                <label for="title">Inserisci Titolo</label>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control @error('max_guests') is-invalid @enderror" id="max_guests" name="max_guests" placeholder="Numero Ospiti" required value="{{ old('max_guests') }}">
                                <label for="max_guests">Numero Ospiti</label>
                                @error('max_guests')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control @error('rooms') is-invalid @enderror" id="rooms" name="rooms" placeholder="Numero Stanze" min="1" required value="{{ old('rooms') }}">
                                <label for="rooms">Numero Stanze</label>
                                @error('rooms')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control @error('beds') is-invalid @enderror" id="beds" name="beds" placeholder="Numero Letti" min="1" required value="{{ old('beds') }}">
                                <label for="beds">Numero Letti</label>
                                @error('beds')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control @error('bathrooms') is-invalid @enderror" id="bathrooms" name="bathrooms" placeholder="Numero Bagni" min="1" required value="{{ old('bathrooms') }}">
                                <label for="bathrooms">Numero Bagni</label>
                                @error('bathrooms')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control @error('meters_square') is-invalid @enderror" id="meters_square" name="meters_square" placeholder="Metri Quadrati" min="5" required value="{{ old('meters_square') }}">
                                <label for="meters_square">Metri Quadrati</label>
                                @error('meters_square')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-floating mb-3">
                                <select class="form-select @error('visible') is-invalid @enderror" id="visible" name="visible" aria-label="Visibile">
                                    <option value="si" @selected(old('visible') == 'si')>Sì</option>
                                    <option value="no" @selected(old('visible') == 'no')>No</option>
                                </select>
                                <label for="visible">Visibile</label>
                                @error('visible')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Indirizzo -->
                        <div class="col-12">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" placeholder="Indirizzo" required value="{{ old('address') }}">
                                <label for="address">Indirizzo</label>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div id="dropdown" class="dropdown-content"></div>
                            </div>
                        </div>

                        <!-- Descrizione -->
                        <div class="col-12">
                            <div class="form-floating mb-3">
                                <textarea class="form-control @error('description') is-invalid @enderror" placeholder="Inserisci Descrizione" name="description" style="height: 100px">{{ old('description') }}</textarea>
                                <label for="description">Descrizione</label>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Servizi -->
                        <div class="modal-services mb-3">
                            <h6>Seleziona i Servizi</h6>
                            <div class="container">
                                <div class="row wrapper-check justify-content-center g-1">
                                    @foreach ($services as $service)
                                        <div class="col-6 col-lg-3">
                                            <input type="checkbox" name="services[]" class="check-service" id="service-{{ $service->id }}" value="{{ $service->id }}" @checked(in_array($service->id, old('services', []))) >
                                            <label for="service-{{ $service->id }}">
                                                <img src="{{ asset('storage/services/' . $service->icon) }}" alt="Icona {{ $service->name }}">
                                                {{ $service->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Immagine Principale -->
                        <div class="col-12 mb-3">
                            <label for="main_img" class="form-label">Inserisci Foto Principale:</label>
                            <input type="file" class="form-control @error('main_img') is-invalid @enderror" id="main_img" name="main_img" accept=".jpg,.webp,.png,.svg,.bmp,.heic">
                            @error('main_img')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <img id="anteprima-immagine" class="img-fluid d-block w-25 m-auto mt-3" src="">
                        </div>

                        <!-- Galleria Foto -->
                        <div class="col-12 mb-3">
                            <label for="photos" class="form-label">Inserisci Foto Aggiuntive:</label>
                            <input type="file" multiple class="form-control @error('photos') is-invalid @enderror" id="photos" name="photos[]" accept=".jpg,.webp,.png,.svg,.bmp,.heic">
                            @error('photos')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div id="gallery-preview" class="mt-3"></div>
                        </div>

                        <!-- Latitudine e Longitudine -->
                        <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude') }}">
                        <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude') }}">

                        <!-- Pulsante di Invio -->
                        <div class="col-12">
                            <button type="submit" class="btn btn-success">Aggiungi</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Script per anteprima immagini -->
    <script>
        document.getElementById('main_img').addEventListener('change', function(event) {
            const reader = new FileReader();
            reader.onload = function() {
                document.getElementById('anteprima-immagine').src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        });

        document.getElementById('photos').addEventListener('change', function(event) {
            const galleryPreview = document.getElementById('gallery-preview');
            galleryPreview.innerHTML = '';
            Array.from(event.target.files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function() {
                    const img = document.createElement('img');
                    img.src = reader.result;
                    img.classList.add('img-fluid', 'm-2');
                    img.style.maxWidth = '150px';
                    galleryPreview.appendChild(img);
                }
                reader.readAsDataURL(file);
            });
        });
    </script>
@endsection
