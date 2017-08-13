@extends('adminlte::page')

@section('content')
    <div class="container">
        {!! Form::open(['url' => route('admin.employees.update', $user), 'class' => 'form-horizontal']) !!}
        {{ method_field('PUT') }}
        <input type="hidden" name="user[id]" value="{{ $user->id }}"/>

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


                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        {!! Form::submit('Save!', array('class'=>'btn btn-primary')) !!}
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}

    </div>
@endsection