@extends('layouts.admin')

@section('content')
    <div class="container">

        {{-- indietro --}}
        <a class="btn btn-primary mt-3 mb-3" href="{{ route('admin.flats.index', ['flat' => $flat->slug]) }}"
            type="button"class="btn btn-outlime-primary p-0 ms-5">
            <i class="fa-solid fa-arrow-left"></i>
        </a>

        <div class="row text-center">
            <div class="col-12 my-4">
                <h4>Modifica appartamento</h4>
            </div>

            <form action="{{ route('admin.flats.update', $flat->slug) }}" method="post" class="mb-3" id="form-flats"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')   

                <div class="container">
                    <div class="row">
                        {{-- title --}}
                        <div class="col-12">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    id="title" name="title" placeholder="Inserisci Titolo" 
                                    value="{{ old('title', $flat->title) }}">
                                <label for="title">Modifica il titolo *
                                    @error('title')
                                        - {{ $errors->get('title')[0] }}
                                    @enderror
                                </label>
                            </div>
                        </div>

                        {{-- max_guests --}}
                        <div class="col-12 col-md-6">
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control @error('max_guests') is-invalid @enderror"
                                    id="max_guests" name="max_guests" placeholder="Numero Ospiti" 
                                    value="{{ old('max_guests', $flat->max_guests) }}">
                                <label for="max_guests">Numero Ospiti *
                                    @error('max_guests')
                                        - {{ $errors->get('max_guests')[0] }}
                                    @enderror
                                </label>
                            </div>
                        </div>

                        {{-- rooms --}}
                        <div class="col-12 col-md-6">
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control @error('rooms') is-invalid @enderror"
                                    id="rooms" name="rooms" placeholder="Numero Stanze" 
                                    value="{{ old('rooms', $flat->rooms) }}">
                                <label for="rooms">Numero Stanze *
                                    @error('rooms')
                                        - {{ $errors->get('rooms')[0] }}
                                    @enderror
                                </label>
                            </div>
                        </div>

                        {{-- beds --}}
                        <div class="col-12 col-md-6">
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control @error('beds') is-invalid @enderror"
                                    id="beds" name="beds" placeholder="Numero Letti" 
                                    value="{{ old('beds', $flat->beds) }}">
                                <label for="beds">Numero Letti *
                                    @error('beds')
                                        - {{ $errors->get('beds')[0] }}
                                    @enderror
                                </label>
                            </div>
                        </div>

                        {{-- bathrooms --}}
                        <div class="col-12 col-md-6">
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control @error('bathrooms') is-invalid @enderror"
                                    id="bathrooms" name="bathrooms" placeholder="Numero Bagni" 
                                    value="{{ old('bathrooms', $flat->bathrooms) }}">
                                <label for="bathrooms">Numero Bagni *
                                    @error('bathrooms')
                                        - {{ $errors->get('bathrooms')[0] }}
                                    @enderror
                                </label>
                            </div>
                        </div>

                        {{-- meters_square --}}
                        <div class="col-12 col-md-6">
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control @error('meters_square') is-invalid @enderror"
                                    id="meters_square" name="meters_square" placeholder="Metri quadrati"
                                     value="{{ old('meters_square', $flat->meters_square) }}">
                                <label for="meters_square">Metri quadrati *
                                    @error('meters_square')
                                        - {{ $errors->get('meters_square')[0] }}
                                    @enderror
                                </label>
                            </div>
                        </div>

                        {{-- visible --}}
                        <div class="col-12 col-md-6">
                            <div class="form-floating mb-3">
                                <select class="form-select @error('visible') is-invalid @enderror" id="visible"
                                    name="visible" aria-label="Visibile">
                                    <option value="si" @selected(old('visible', $flat->visible) == 'si')>Si</option>
                                    <option value="no" @selected(old('visible', $flat->visible) == 'no')>No</option>
                                </select>
                                <label for="visible">Visibile *
                                    @error('visible')
                                        - {{ $errors->get('visible')[0] }}
                                    @enderror
                                </label>
                            </div>
                        </div>

                        {{-- address --}}
                        <div class="col-12">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control @error('address') is-invalid @enderror"
                                    id="address" name="address" placeholder="Indirizzo" 
                                    value="{{ old('address', $flat->address) }}">
                                <label for="address">Indirizzo *
                                    @error('address')
                                        - {{ $errors->get('address')[0] }}
                                    @enderror
                                </label>
                                <div id="dropdown" class="dropdown-content"></div>
                            </div>
                        </div>

                        {{-- description --}}
                        <div class="col-12">
                            <div class="form-floating mb-3">
                                <textarea class="form-control @error('description') is-invalid @enderror" placeholder="Inserisci descrizione"
                                    name="description" style="height: 100px">{{ old('description', $flat->description) }}</textarea>
                                <label for="description">Descrizione *
                                    @error('description')
                                        - {{ $errors->get('description')[0] }}
                                    @enderror
                                </label>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="modal-services ms_border mb-3">
                                <h6 id="title-service">
                                    Seleziona i servizi
                                </h6>
                                <div class="container">
                                    <div class="row wrapper-check justify-content-center g-1">
                                        @foreach ($services as $service)
                                            <div class="col-6 col-lg-3">
                                                <input type="checkbox" name="services[]" class="check-service"
                                                    id="service-{{ $service->id }}" value="{{ $service->id }}" @checked($flat->services->contains($service) || in_array($service->id, old('services', []) ) )>
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

                        {{-- main_img --}}
                        <div class="col-12 mb-3">
                            <div class="ms_border" id="box-main-img">
                                <label for="main_img" class="mb-1">Inserisci foto principale: *</label>
                                <input type="file" class="form-control mb-3 ms_file @error('main_img') is-invalid @enderror"
                                    id="main_img-edit" placeholder="inserici immagine" name="main_img"
                                    value="{{ old('main_img', $flat->main_img) }}" accept=".jpg,.webp,.png,.svg,.bmp,.heic">
    
                                @error('main_img')
                                    <div class="alert alert-danger">
                                        {{ $errors->get('main_img')[0] }}
                                    </div>
                                @enderror
    
                                @if ($flat->main_img)
                                    <img id="anteprima-immagine" class="img-fluid d-block w-25 m-auto mb-3"
                                        src="{{ asset('storage/' . $flat->main_img) }}">
                                @else
                                    <img id="anteprima-immagine" class="img-fluid d-block w-25 m-auto mb-3" src="">
                                @endif
                            </div>
                        </div>

                        {{-- gallery photo --}}
                        <div class="col-12 mb-3">
                            <div class="ms_border" id="box-photos-img">
                                <label for="photos" class="mb-1">Inserisci foto aggiuntive:</label>
                                <input type="file" multiple class="form-control mb-3 ms_file @error('photos') is-invalid @enderror"
                                    id="photos" placeholder="inserici immagine" name="photos[]" accept=".jpg,.webp,.png,.svg,.bmp,.heic"
                                    value="{{ old('photos') }}" accept=".jpg,.webp,.png,.svg,.bmp,.heic">
    
                                @error('photos')
                                    <div class="alert alert-danger">
                                        {{ $errors->get('photos')[0] }}
                                    </div>
                                @enderror
    
                                <div id="gallery-preview" class="mb-3">
                                    @foreach ($photos as $photo)
                                        <img src="{{asset('storage/'.$photo->image)}}" alt="" class="gallery-image w-25 m-2">
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </div>
                    <input type="text" name="latitude" id="latitude" class="d-none"
                        value="{{ old('latitude', $flat->latitude) }}">
                    <input type="text" name="longitude" id="longitude" class="d-none"
                        value="{{ old('longitude', $flat->longitude) }}">
                    <button type="submit" class="btn btn-success">Aggiorna</button>
                </div>
            </form>
        </div>
    </div>
@endsection
