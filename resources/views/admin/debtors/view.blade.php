@extends('adminlte::page')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">Company <strong>{{ $company->name }}</strong>
            @can('edit', $company)
                <div class="pull-right">
                    <a href="{{ route('admin.debtors.edit', $company) }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                </div>
            @endcan
        </div>
        <div class="panel-body">

            <div class="row">
                @include('company.view')

                @include('contact.view')
            </div>
        </div>
    </div>
@endsection