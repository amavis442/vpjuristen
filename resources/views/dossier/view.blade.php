@extends('layouts.app')

@section('content')
    <div class="panel">
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
                @foreach($dossiers as $item)
                    <tbody>
                    <li>#{{ $item->id }} {{ $item->client_id }} {{ $item->debtor_id }}<br/>
                        Client: {{ $item->title }} , {{ $item->client()->first()->id }}
                        , {{ $item->client()->first()->company()->first()->name }}<br/>
                        Debtor: {{ $item->debtor()->first()->company()->first()->contacts()->first()->name }}
                    </li>
                    </tbody>
                @endforeach
            </table>
        </div>
    </div>
@endsection