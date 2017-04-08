@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Total</th>
            </tr>
            </thead>
            <tbody>
            @foreach($dossiers as $dossier)
                <tr>
                    <td><a href="{{ route('dashboard.dossier.edit', ['id' => $dossier->id]) }}">{{ $dossier->id }}</td>
                    </td>
                    <td>{{ $dossier->title }}</td>
                    <td>{{ $dossier->total }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection