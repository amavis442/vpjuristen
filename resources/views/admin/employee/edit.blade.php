@extends('layouts.app')

@section('content')
    <div class="container">
        {!! Form::open(['route' => 'admin.employee.store', 'class' => 'form-horizontal']) !!}

        <input type="hidden" name="user[id]" value="{{ $user->id }}"/>

        <div class="panel panel-default">
            <div class="panel-heading">
                User data
            </div>
            <div class="panel-body">
                @include('admin.employee.form')
            </div>
        </div>


        <div class="panel panel-default">
            <div class="panel-heading">
                Contact data
            </div>
            <div class="panel-body">
                @include('common.contact.form')
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                @if (!is_null($user))
                    {!! Form::submit('Update!', array('class'=>'btn btn-primary')) !!}
                @else
                    {!! Form::submit('Save!', array('class'=>'btn btn-primary')) !!}
                @endif
            </div>
        </div>
        {!! Form::close() !!}

    </div>
@endsection