@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="panel panel-info">
            <div class="panel-body">
                <a href="{{ route('admin.login.client') }}">Login client</a>
            </div>
        </div>

        <div class="panel panel-info">

            <div class="panel-body">
                <a href="{{ route('admin.login.debtor') }}">Login debtor</a>
            </div>

        </div>
    </div>

@endsection