@extends('adminlte::page')

@section('content')
    <div class="container">
        {!! Form::open(['route' => 'admin.employees.store', 'class' => 'form-horizontal']) !!}

        <div class="panel panel-default">
            <div class="panel-heading">
                User data
            </div>
            <div class="panel-body">
                @include('employees.partials.form')
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                Contact data
            </div>
            <div class="panel-body">
                @include('contact.partials.form')
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                {!! Form::submit('Save!',array('class'=>'btn btn-primary')) !!}
            </div>
        </div>
        {!! Form::close() !!}

    </div>
@endsection