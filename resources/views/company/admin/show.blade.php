@extends('adminlte::page')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">Company <strong>{{ $company->name }}</strong>
            @can('edit', $company)
                <div class="pull-right">
                    <a href="{{ route($route, $company) }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                </div>
            @endcan
        </div>
        <div class="panel-body">

            <div class="row">
                <div class="col-md-6">
                    <address>
                        <strong>{{ $company->name }}</strong><br>
                        {{ $company->street }} {{ $company->housenr }}<br>
                        {{ $company->city }}, {{ $company->postcode }}<br>
                        <abbr title="Phone">P:</abbr> {{ $company->phone }}<br/>
                        <abbr title="Email">E:</abbr> {{ $company->email }}
                    </address>
                </div>

                <div class="col-md-6">
                    <address>
                        <strong>{{ $contact->sexe }} {{ $contact->firstname }} {{ $contact->middlename }} {{ $contact->name }}</strong><br>
                        {{ $contact->street }} {{ $contact->housenr }}<br>
                        {{ $contact->city }}, {{ $contact->postcode }}<br>
                        <abbr title="Phone">P:</abbr> {{ $contact->phone }}<br/>
                        <abbr title="Email">E:</abbr> {{ $contact->email }}
                    </address>
                </div>
            </div>
        </div>
    </div>
@endsection