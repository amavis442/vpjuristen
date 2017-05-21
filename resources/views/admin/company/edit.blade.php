@extends('adminlte::page')

@section('content')
    <div class="container">

        @include('common.form.error')

        {!! Form::open(['route' => $routeName, 'class' => 'form-horizontal']) !!}

        <div class="panel panel-default">
            <div class="panel-heading">Company</div>
            <div class="panel-body">
                @include('common.company.form')

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
                @include('common.contact.form')
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