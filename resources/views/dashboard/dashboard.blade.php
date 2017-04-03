@extends('layouts.app')

@section('content')
    <div class="container">

        @if (Auth::user()->hasRole('client'))
            Zoeken naar dossier
            <a href="{{ route('dashboard.dossier.list') }}" class="btn btn-primary btn-lg btn-block" id="dossier-list">Dossiers bekijken</a>
            <button type="button" class="btn btn-default btn-lg btn-block" id="dossier-create">Nieuw Dossier aanmaken</button>

            <a href="{{ route('dashboard.user.edit') }}"  class="btn btn-default btn-lg btn-block" id="profiel-edit">Profiel bewerken</a>

            <button type="button" class="btn btn-default btn-lg btn-block" id="debtor-list">Debiteuren bekijken</button>
            <button type="button" class="btn btn-default btn-lg btn-block" id="check">Voortgang</button>
        @endif
    </div>
@endsection
