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
        {!! Form::open(['route' => 'dashboard.dossier.store', 'class' => 'form-horizontal', 'files' => true ]) !!}

        @include('dossier.partials.form')

        @include('invoice.edit')

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                {!! Form::submit('Apply!',
              array('class'=>'btn btn-primary')) !!}
            </div>
        </div>

        {!! Form::close() !!}
    </div>

@endsection

