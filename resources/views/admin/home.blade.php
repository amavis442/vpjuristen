@extends('adminlte::page')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        @if (Auth::guard('admin')->user()->can('manage-employees'))
                            <a href="{{ route('admin.employee.index') }} " class="btn btn-default">Employees</a>
                        @endif
                        <a href="" class="btn btn-default">Clients</a>
                        <a href="{{ route ('admin.dossier.index') }}" class="btn btn-default">Dossiers</a>
                        <a href="" class="btn btn-default">Actions</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
