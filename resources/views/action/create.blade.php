@extends('adminlte::page')

@section('adminlte_js')
    <script type="text/javascript" src="{{ asset('js/collections.js') }}"></script>
@endsection

@section('content')
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="{{ back()->getTargetUrl() }}">Home</a></li>

        </ol>
    </div>
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                Action
            </div>
            <div class="panel-body">
                @include('action.partials.form')
            </div>
        </div>

        @if (isset($comments))
            <div class="panel panel-default">
                <div class="panel-heading">
                    Comments
                </div>
                <div class="panel-body">
                    {!! Form::open(['route' => $route, 'class' => 'form-horizontal']) !!}
                    @include('comment.index')
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            {!! Form::submit('Save!',
                          array('class'=>'btn btn-primary')) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        @endif
    </div>
@endsection