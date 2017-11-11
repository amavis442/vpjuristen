@extends('adminlte::page')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Employees</div>

                    <div class="panel-body">
                        <a href="{{ route('admin.employees.create') }}" class="btn btn-default">Add Employee</a>

                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Active</th>
                                <th>Roles</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>
                                        <a href="{{ route('admin.employees.edit', ['id' => $user->id])  }}">{{ $user->id }}</a>
                                    </td>
                                    <td>
                                        {{ $user->name }}
                                    </td>
                                    <td>
                                        {{ $user->active }}
                                    </td>
                                    <td>
                                        {{ $user->role }}
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="...">
                                            <a href="{{ route('admin.employees.edit', ['id' => $user->id]) }}"
                                               class="btn btn-info">Edit <span
                                                        class="glyphicon glyphicon-edit"></span></a>

                                            @include('utils.delete',array( 'url' => route('admin.employees.destroy', $user),'text' => '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> delete me'))
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection