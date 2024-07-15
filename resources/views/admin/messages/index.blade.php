@extends('layouts.admin')

@section('content')
    <section class="bg-danger h90vh d-flex">
        <div class="col-4 h90vh bg-primary overflow-scroll">
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
                        <span class="badge text-bg-primary rounded-pill">14</span>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="col-8 h90vh bg-light overflow-scroll" id="message-details">
            <header class="h10vh bg-primary">
            </header>
            <div class="h70vh d-flex justify-content-center align-items-center">
                <p>Select a message to view its details.</p>
            </div>
            <footer class="h10vh bg-primary">

            </footer>
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
                            <header class="h10vh bg-danger">
                            </header>

                            <div class="h70vh">
                            <p><strong>Name:</strong> ${data.name}</p>
                            <p><strong>Email:</strong> ${data.email}</p>
                            <p><strong>Message:</strong> ${data.text}</p>
                            <p><strong>Flat:</strong> ${data.flat ? data.flat.title : 'No flat associated'}</p>
                            <p><strong>Created At:</strong> ${data.created_at}</p>
                            <p><strong>Updated At:</strong> ${data.updated_at}</p>
                            </div>

                            <footer class="h10vh bg-primary"></footer>
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
