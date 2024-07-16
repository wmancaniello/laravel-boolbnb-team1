<div class="modal fade" id="deleteModal{{ $flat->slug }}" tabindex="-1"
    aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Conferma Cancellazione</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ $flat->title }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">Annulla</button>
                <form action="{{ route('admin.flats.destroy', ['flat' => $flat->slug]) }}"
                    method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Cancellare</button>
                </form>
            </div>
        </div>
    </div>
</div>