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

        {!! Form::open(['route' => 'dashboard.user.store', 'class' => 'form-horizontal']) !!}


        <div class="panel panel-default">
            <div class="panel-heading">Client</div>
            <div class="panel-body">
                @include('company.partials.form')
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Contact</div>
            <div class="panel-body">
                @include('contact.partials.form')


                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        {!! Form::submit('Save!',
                      array('class'=>'btn btn-primary')) !!}
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
