@extends('adminlte::page')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        @if (Auth::guard()->user()->can('manage-employees'))
                            <a href="{{ route('admin.employees.index') }} " class="btn btn-default">Employees</a>
                        @endif
                        <a href="{{ route('admin.dossiers.index') }}" class="btn btn-default">Dossiers</a>
                        <a href="{{ route('admin.client.index',['type'=>'client']) }}" class="btn btn-default">Clients</a>
                        <a href="{{ route('admin.debtor.index',['type'=>'debtor']) }}" class="btn btn-default">Debtors</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
