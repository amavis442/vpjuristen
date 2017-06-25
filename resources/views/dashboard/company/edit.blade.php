@extends('layouts.app')

@section('content')
    <div class="container">

        @include('form.error')

        {!! Form::open(['route' => $route, 'class' => 'form-horizontal']) !!}

        <div class="panel panel-default">
            <div class="panel-heading">Company</div>
            <div class="panel-body">
                @include('company.partials.form')

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        {!! Form::submit('Apply!',
                      array('class'=>'btn btn-primary')) !!}
                    </div>
                </div>

            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">User</div>
            <div class="panel-body">
                @include('user.partials.form')

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        {!! Form::submit('Apply!',
                      array('class'=>'btn btn-primary')) !!}
                    </div>
                </div>

            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Contact</div>
            <div class="panel-body">
                @include('contact.partials.form')
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        {!! Form::submit('Apply!',
                      array('class'=>'btn btn-primary')) !!}
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}

    </div>
@endsection