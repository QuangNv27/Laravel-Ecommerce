@extends('client.layouts.master')
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger mt-5 mb-5">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
@endsection
