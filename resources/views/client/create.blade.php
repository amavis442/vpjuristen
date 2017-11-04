@extends('layouts.app')

@section('content')
    <div class="container">
        @if(Session::has('message'))
            <p class="alert alert-info">{{ Session::get('message') }}</p>
        @endif

            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

            <h1>Client</h1>

            {!! Form::open(['route' => 'client-store', 'class' => 'form-horizontal']) !!}
            @include('client._form')
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" class="btn btn-primary" name="btnSubmit" id="btnSubmit" >
                </div>
            </div>
            {!! Form::close() !!}

    </div>
@endsection
