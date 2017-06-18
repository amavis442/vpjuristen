@extends('layouts.app')

@section('content')
    <?php
            $route = 'dashboard.dossier.show';
            $searchUrl = 'dashboard/dossier/search'
            ?>
    <div class="container">

        <div class="panel panel-default">
            <div class="panel-heading">Dossiers</div>
            <div class="panel-body">
                <div class="col-md-12">
                @include('dossier.index')
                </div>
            </div>
        </div>
    </div>
@endsection