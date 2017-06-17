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
        {!! Form::open(['route' => 'frontend.register.dossier.store', 'class' => 'form-horizontal', 'files' => true ]) !!}

        <div class="panel panel-default">
            <div class="panel-heading">Dossier</div>
            <div class="panel-body">
                @include('dossier._form')
            </div>
        </div>


        <div class="panel panel-default">
            <div class="panel-heading">Invoices</div>
            <div class="panel-body">
                @include('invoice._edit')
            </div>
        </div>


        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                {!! Form::submit('Submit!',
              array('class'=>'btn btn-primary')) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
