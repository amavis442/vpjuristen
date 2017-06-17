@extends('adminlte::page')

<?php
    $searchUrl = 'admin/dossier/search';
    $route = 'admin.dossier.show';
?>
@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                Dossiers
            </div>
            <div class="panel-body">
                <div class="col-md-12">
                @include('dossier._searchform')
                </div>
            </div>
        </div>
    </div>
@endsection