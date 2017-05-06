@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>Dossier</h2>
        </div>
        <div class="panel-body">
            <table class="table">
                <thead>
                <th>ID</th>
                <th>Description</th>
                <th>Debtor</th>
                <th>Created</th>
                <th>Invoices</th>
                </thead>

                <tbody>
                @foreach($dossiers as $item)
                    <tr>
                        <td>#{{ $item->id }}</td>
                        <td><a href="{{ route('admin.dossier.show',['id' => $item->id]) }}">{{ $item->title }}</a></td>
                        <td>{{ $item->debtor()->first()->name  }}</td>
                        <td> {{ $item->created_at }}</td>
                        <td> {{ $item->updated_at }}</td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>
    </div>
@endsection