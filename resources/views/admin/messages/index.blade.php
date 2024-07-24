@extends('layouts.admin')

@section('content')
    <section class="h90vh d-flex">
        <div class="col-4 h90vh overflow-scroll ms_overflow">

            {{-- Lista messaggi ricevuti --}}
            <ul class="list-group">

                {{-- Ordinare messaggi dal più recente --}}
                @php
                    $dataArray = $datas->toArray();
                    $datareverse = array_reverse($dataArray);
                    $dataCollectionReverse = collect($datareverse)->map(function ($item) {
                        return (new \App\Models\Message())->newFromBuilder($item);
                    });
                @endphp
                {{-- /Ordinare messaggi dal più recente --}}

                @if ($dataCollectionReverse->isEmpty())
                    <li class="list-group-item">
                        Nessun messaggio trovato.
                    </li>
                @else
                @foreach ($dataCollectionReverse as $dataMessage)
                {{-- Container info/alert --}}
                <li class="list-group-item d-flex justify-content-between align-items-center message-item {{ $dataMessage->is_read ? 'read' : 'unread' }} alertColor h10vh"
                    data-id="{{ $dataMessage->id }}" style="cursor: pointer">
                    <div class="ms-2 me-auto">
                        {{-- Container info --}}
                        <div class="d-flex align-items-center gap-3">
                            {{-- Icon User --}}
                            <span class="ms_icon_user">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                    <path
                                        d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                                </svg>
                            </span>
                            {{-- /Icon User --}}
                            {{-- Info --}}
                            <div>
                                <p class="name-message">{{ $dataMessage->name }}</p>
                                @php
                                    $dateTime = \Carbon\Carbon::parse($dataMessage->created_at)->setTimezone(
                                        'Europe/Rome',
                                    );
                                    $dateReceived = $dateTime->format('d/m');
                                    $hourReceived = $dateTime->format('H:i');
                                @endphp
                                <small class="text-muted"> Ricevuto il:
                                    {{ $dateReceived }} alle
                                    {{ $hourReceived }}
                                </small>
                            </div>
                            {{-- /Info --}}
                        </div>
                        {{-- /Container Info --}}
                    </div>
            
                    {{-- Notification Dot --}}
                    <span id="notification_dot"
                        class="{{ $dataMessage->is_read ? '' : 'notification-dot' }} dot-color">
                    </span>
                    {{-- Notification Dot --}}
            
                    {{-- Bottone cestino --}}
                    
                    {{-- /Bottone cestino --}}
                </li>
                {{-- /Container info/alert --}}
            
                {{-- Modale conferma cancellazione --}}
                @include('admin.partials.modal_delete_message')
                {{-- /Modale conferma cancellazione --}}
            @endforeach
            
                @endif
            </ul>
            {{-- /Lista messaggi ricevuti --}}
        </div>
        <div class="col-8 h90vh bg-light overflow-scroll ms_overflow" id="message-details">
            <div class="h90vh img_bg2 d-flex justify-content-center align-items-center">
                <div class="bg-dark_ms w-100 h-100 d-flex align-items-center justify-content-center">
                    <div class="text-center text-white w-75">
                        <img src="{{ asset('storage/logo.png') }}" alt="">
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
            $('.message-item').on('click', function(event) {
                event.preventDefault();

                var messageId = $(this).data('id');

                $.ajax({
                    url: '/admin/messages/' + messageId + '/markAsRead',
                    method: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // console.log('Message marked as read');
                    },
                    error: function(xhr) {
                        console.log('Error marking message as read');
                    }
                });

                // Se vuoi anche caricare i dettagli del messaggio
                $.ajax({
                    url: '/admin/messages/' + messageId,
                    method: 'GET',
                    success: function(data) {
                        const date = new Date(data.created_at);
                        const day = String(date.getDate()).padStart(2, '0');
                        const month = String(date.getMonth() + 1).padStart(2, '0');
                        const year = date.getFullYear();
                        const hours = String(date.getHours()).padStart(2, '0');
                        const minutes = String(date.getMinutes()).padStart(2, '0');
                        const formattedDate =
                            `${day}/${month}/${year} alle ${hours}:${minutes}`;

                        $('#message-details').html(`
                    <header class="px-5 h10vh ms_bg_primary w-100 ms_header-message">
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
                            <div class="alessio"> 
                                <button class="btn" data-bs-toggle="modal" data-bs-target="#deleteModal${messageId}">
                                    <i class="fa-regular fa-trash-can"></i>
                                </button>
                            </div>
                        </div>
                    </header>

                    <div class="h80vh img_bg text-dark p-4 d-flex flex-column">
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
