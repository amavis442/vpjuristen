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
                @include('common.action._form')
            </div>
        </div>

        @if ($comments)
            <div class="panel panel-default">
                <div class="panel-heading">
                    Comments
                </div>
                <div class="panel-body">
                    @include('common.comment.index')
                </div>
            </div>
        @endif
    </div>
@endsection