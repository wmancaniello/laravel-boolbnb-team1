<!-- resources/views/admin/messages/show.blade.php -->
@extends('layouts.admin')

@section('content')
    <h1></h1>
    <p><strong>Name:</strong> {{ $message->name }}</p>
    <p><strong>Email:</strong> {{ $message->email }}</p>
    <p><strong>Message:</strong> {{ $message->text }}</p>
    <p><strong>Flat:</strong> {{ $message->flat ? $message->flat->title : 'No flat associated' }}</p>
    <p><strong>Created At:</strong> {{ $message->created_at }}</p>
    <p><strong>Updated At:</strong> {{ $message->updated_at }}</p>

    <a href="{{ route('admin.messages.index') }}">Back to Messages</a>
@endsection
