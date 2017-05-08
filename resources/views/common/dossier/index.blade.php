@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>Dossier</h2>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="container">
                    <form action="{{ url('admin/dossier/search') }}" method="get">
                        <div class="form-group">
                            <input
                                    type="text"
                                    name="q"
                                    class="form-control"
                                    placeholder="Search..."
                                    value="{{ request('q') }}"
                            />
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <table class="table">
                    <thead>
                    <th>ID</th>
                    <th>Description</th>
                    <th>Client</th>
                    <th>Debtor</th>
                    <th>Last Action</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th>Invoices</th>
                    </thead>

                    <tbody>
                    @foreach($dossiers as $item)
                        <tr>
                            <td>#{{ $item->id }}</td>
                            <td>
                                <a href="{{ route('admin.dossier.show',['id' => $item->id]) }}">{{ $item->title }}</a>
                            </td>
                            <td>{{ $item->client()->first()->name  }}</td>
                            <td>{{ $item->debtor()->first()->name  }}</td>
                            <td>{{ ($item->actions()->count() > 0 ? $item->actions()->first()->title: '-')  }}</td>
                            <td>{{ $item->dossierstatus()->first()->description  }}</td>
                            <td> {{ $item->created_at }}</td>
                            <td> {{ $item->updated_at }}</td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
@endsection