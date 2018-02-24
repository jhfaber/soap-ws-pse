@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @include('partials.errors')
                @include('partials.banks')
            </div>
        </div>
    </div>
@endsection
