@extends('layouts.admin')

@section('content')
    <div class="container mt10vh">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-4">
                <div class="card">
    
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __("Benvenuto")}} {{ Auth::user()->name }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
