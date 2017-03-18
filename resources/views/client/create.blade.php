@extends('layouts.app')

@section('content')


    <div class="container">
        @if(Session::has('message'))
            <p class="alert alert-info">{{ Session::get('message') }}</p>
        @endif

        @include('client.form')
    </div>
@endsection
