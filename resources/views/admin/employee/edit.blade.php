@extends('adminlte::page')

@section('content')
    <div class="container">
        {!! Form::open(['route' => 'admin.employee.store', 'class' => 'form-horizontal']) !!}

        <input type="hidden" name="user[id]" value="{{ $user->id }}"/>

        <div class="panel panel-default">
            <div class="panel-heading">
                User data
            </div>
            <div class="panel-body">
                @include('employee._form')
            </div>
        </div>


        <div class="panel panel-default">
            <div class="panel-heading">
                Contact data
            </div>
            <div class="panel-body">
                @include('contact._form')


                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        @if (!is_null($user))
                            {!! Form::submit('Update!', array('class'=>'btn btn-primary')) !!}
                        @else
                            {!! Form::submit('Save!', array('class'=>'btn btn-primary')) !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}

    </div>
@endsection