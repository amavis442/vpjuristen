@extends('adminlte::page')

@section('content_header')
    Dossiers
    @endsection

@section('content')
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="{{ back()->getTargetUrl() }}">Home</a></li>
            <li><a href="{{ 'jj'  }}">company</a></li>
            <li class="active">Data</li>
        </ol>
    </div>

    <div class="container">
        @include('common.dossier.list')
    </div>
@endsection