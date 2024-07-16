@extends('layouts.admin')

@section('content')
    <section class="h90vh d-flex mt10vh">
        <div class="col-4 h90vh overflow-scroll">
            <ul class="list-group">
                @foreach ($datas as $dataMessage)
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">
                                <a href="#" class="text-decoration-none message-link" data-id="{{ $dataMessage->id }}">
                                    {{ $dataMessage->name }}
                                </a>
                            </div>
                            {{ $dataMessage->email }}
                        </div>
                        <span class="badge text-bg-primary rounded-pill"> </span>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="col-8 h90vh bg-light overflow-scroll" id="message-details">
            {{-- <header class="h10vh">
            </header> --}}
            <div class="h90vh img_bg2 d-flex justify-content-center align-items-center">
                <div class="bg-dark_ms w-100 h-100 d-flex align-items-center justify-content-center">
                    <div class="text-center text-white w-75">
                        <h2>logo</h2>
                        <p class="letter-spacing fs-4">Bentornato ! <br> qui potrai vedere le richieste dei tuoi clienti ed
                            eventuali domande riguardanti gli alloggi .</p>
                    </div>
                </div>
            </div>
            {{-- <footer class="h10vh 
             ">

            </footer> --}}
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.message-link').on('click', function(e) {
                e.preventDefault();
                var messageId = $(this).data('id');

                $.ajax({
                    url: '/admin/messages/' + messageId,
                    method: 'GET',
                    success: function(data) {
                        $('#message-details').html(`
                            <header class="px-5 h10vh ms_bg_primary">
                                <div class="d-flex justify-content-between align-items-center h-100">
                                    <div class="d-flex align-items-center">
                                        <span class="ms_icon_user">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
  <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
</svg>
                                        </span>
                                        <span class="px-3">${data.name}</span>
                                        
                                    </div>
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
  <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3"/>
</svg>    
                                    </div>
                                </div>
                            </header>

                            <div class="h70vh img_bg text-white">
                            <p><strong>Name:</strong> ${data.name}</p>
                            <p><strong>Email:</strong> ${data.email}</p>
                            <p><strong>Message:</strong> ${data.text}</p>
                            <p><strong>Flat:</strong> ${data.flat ? data.flat.title : 'No flat associated'}</p>
                            <p><strong>Created At:</strong> ${data.created_at}</p>
                            <p><strong>Updated At:</strong> ${data.updated_at}</p>
                            </div>

                            <footer class="h10vh ms_bg_primary"></footer>
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
