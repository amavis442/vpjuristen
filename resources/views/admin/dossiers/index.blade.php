@extends('adminlte::page')

<?php
    $searchUrl = 'admin/dossiers/search';
    $route = 'admin.dossiers.show';
?>
@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                Dossiers
            </div>
            <div class="panel-body">
                <div class="col-md-12">
                @include('admin.dossiers.partials.searchform')
                </div>
            </div>
        </div>
    </div>
@endsection