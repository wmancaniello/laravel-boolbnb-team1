@extends('layouts.admin')

@section('content')
    <section class="h90vh d-flex mt10vh">
        <div class="col-4 h90vh overflow-scroll">
            {{-- Lista messaggi ricevuti --}}
            <ul class="list-group">
                @foreach ($datas as $dataMessage)
                    {{-- Container info/alert --}}
                    <li class="list-group-item d-flex justify-content-between align-items-start message-item {{ $dataMessage->is_read ? '' : 'unread' }}" 
                        data-id="{{ $dataMessage->id }}">
                        <div class="ms-2 me-auto">
                            {{-- Container info --}}
                            <div class="d-flex align-items-center gap-3">
                                {{-- Icon User --}}
                                <span class="ms_icon_user">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-person" viewBox="0 0 16 16">
                                        <path
                                            d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                                    </svg>
                                </span>
                                {{-- /Icon User --}}
                                {{-- Info --}}
                                <div>
                                    <h5>{{ $dataMessage->name }}</h5>
                                    <small class="text-muted"> Ricevuto il:
                                        {{ date('d/m', strtotime($dataMessage->created_at)) }} alle
                                        {{ date('H:i', strtotime($dataMessage->created_at)) }}
                                    </small>
                                </div>
                                {{-- /Info --}}
                            </div>
                            {{-- /Container Info --}}
                            {{-- {{ $dataMessage->email }} --}}
                        </div>
                        <form id="mark-as-read-form-{{ $dataMessage->id }}" action="{{ route('admin.messages.read', $dataMessage->id) }}" method="POST" style="display:none;">
                            @csrf
                            @method('PATCH')
                        </form>
                    </li>
                    {{-- /Container info/alert --}}
                @endforeach
            </ul>
            {{-- /Lista messaggi ricevuti --}}
        </div>
        <div class="col-8 h90vh bg-light overflow-scroll" id="message-details">
            <div class="h90vh img_bg2 d-flex justify-content-center align-items-center">
                <div class="bg-dark_ms w-100 h-100 d-flex align-items-center justify-content-center">
                    <div class="text-center text-white w-75">
                        <h2>logo</h2>
                        <p class="letter-spacing fs-4">
                            Bentornato!<br>
                            Qui potrai vedere le richieste dei tuoi clienti ed eventuali domande riguardanti gli alloggi.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.message-item').on('click', function() {
                // Select Message
                $('.message-item').removeClass('selected');
                $(this).addClass('selected');

                var messageId = $(this).data('id');

                // Mark message as read via AJAX
                $.ajax({
                    url: '/admin/messages/' + messageId + '/read',
                    method: 'PATCH',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function() {
                        // Remove unread class
                        $('.message-item[data-id="' + messageId + '"]').removeClass('unread');
                    },
                    error: function(xhr) {
                        console.log('Error marking message as read.');
                    }
                });

                // Fetch message details via AJAX
                $.ajax({
                    url: '/admin/messages/' + messageId,
                    method: 'GET',
                    success: function(data) {
                        // Formattazione Data
                        const date = new Date(data.created_at);
                        const day = String(date.getDate()).padStart(2, '0');
                        const month = String(date.getMonth() + 1).padStart(2, '0');
                        const year = date.getFullYear();
                        const hours = String(date.getHours()).padStart(2, '0');
                        const minutes = String(date.getMinutes()).padStart(2, '0');
                        const formattedDate =
                            `${day}/${month}/${year} alle ${hours}:${minutes}`;
                        // Formattazione Data

                        $('#message-details').html(`
                            <header class="px-5 h10vh ms_bg_primary">
                                <div class="d-flex justify-content-between align-items-center h-100">
                                    <div class="d-flex align-items-center gap-3">
                                        <span class="ms_icon_user">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                                            </svg>
                                        </span>
                                        <div>
                                            <h5>${data.name}</h5>
                                            <small class="text-muted">Ricevuto il: ${formattedDate}</small>
                                        </div>
                                    </div>
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                                            <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3"/>
                                        </svg>
                                    </div>
                                </div>
                            </header>

                            <div class="h70vh img_bg text-white p-4 d-flex flex-column">
                                <div class="mb-3">
                                    <h4 class="mb-3">Dettagli:</h4>
                                    <p class="mb-2"><strong>Email:</strong> ${data.email}</p>
                                    <p class="mb-2"><strong>Appartamento richiesto:</strong> ${data.flat ? data.flat.title : 'Nessun appartamento associato'}</p>
                                </div>
                                <div class="border-top pt-3 mt-3">
                                    <h5 class="mb-2">Messaggio:</h5>
                                    <div class="message-bubble">
                                        <p>${data.text}</p>
                                    </div>
                                </div>
                            </div>     
                        `);
                    },
                    error: function(xhr) {
                        $('#message-details').html('<p>Error fetching message details.</p>');
                    }
                });
            });
        });
    </script>
@endsection
