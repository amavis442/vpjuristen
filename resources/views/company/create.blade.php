@extends('layouts.app')

@section('content')
    <?php
    $route = 'client-store';
    ?>

    <div class="container">
        @if(Session::has('message'))
            <p class="alert alert-info">{{ Session::get('message') }}</p>
        @endif

        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <h1>Company</h1>

        {!! Form::open(['route' => $route, 'class' => 'form-horizontal']) !!}
        @include('company.partials.form')
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                {!! Form::submit('Next!',
              array('class'=>'btn btn-primary')) !!}
            </div>
        </div>
        {!! Form::close() !!}

    </div>
@endsection


