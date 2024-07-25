<div class="modal fade mt-5" id="galleryModal{{ $flat->slug }}" tabindex="-1" aria-labelledby="galleryModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="galleryModalLabel">Galleria Appartamento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="carousel{{ $flat->slug }}" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach($flat->photos as $index => $photo)
                        <div class="carousel-item @if($index === 0) active @endif">
                            <img src="{{ asset('storage/' . $photo->image) }}" src="{{ $photo }}" class="d-block w-100 fixed-size" alt="Foto dell'appartamento">
                        </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#carousel{{ $flat->slug }}" role="button" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carousel{{ $flat->slug }}" role="button" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

</script>
