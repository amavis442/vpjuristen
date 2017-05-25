@extends('adminlte::page')

@section('content')
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="{{ back()->getTargetUrl() }}">Home</a></li>
            <li><a href="{{ 'jj'  }}">company</a></li>
            <li class="active">Data</li>
        </ol>
    </div>


    <div class="container">
        <div class="header">
            <h2>Dossier
                <small>
                    #{{ $dossier->id }}: {{ $dossier->title }}<br/>
                    {{ $dossierStatus->description }}
                </small>
            </h2>
        </div>

        <div class="row">

            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>Client info</strong>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4">
                                <address>
                                    <strong>{{ $client->company }}</strong><br>
                                    {{ $client->street }} {{ $client->housenr }}<br>
                                    {{ $client->city }}, {{ $client->postcode }}<br>
                                    <abbr title="Phone">P:</abbr> {{ $client->phone }}<br/>
                                    <abbr title="Email">E:</abbr> {{ $client->email }}
                                </address>
                            </div>

                            <div class="col-md-4">
                                <address>
                                    <strong>{{ $clientContact->sexe }} {{ $clientContact->firstname }} {{ $clientContact->middlename }} {{ $clientContact->name }}</strong><br>
                                    {{ $clientContact->street }} {{ $clientContact->housenr }}<br>
                                    {{ $clientContact->city }}, {{ $clientContact->postcode }}<br>
                                    <abbr title="Phone">P:</abbr> {{ $clientContact->phone }}<br/>
                                    <abbr title="Email">E:</abbr> {{ $clientContact->email }}
                                </address>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>Debtor info</strong>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4">
                                <address>
                                    <strong>{{ $client->company }}</strong><br>
                                    {{ $client->street }} {{ $client->housenr }}<br>
                                    {{ $client->city }}, {{ $client->postcode }}<br>
                                    <abbr title="Phone">P:</abbr> {{ $client->phone }}<br/>
                                    <abbr title="Email">E:</abbr> {{ $client->email }}
                                </address>
                            </div>

                            <div class="col-md-4">
                                <address>
                                    <strong>{{ $debtorContact->sexe }} {{ $debtorContact->firstname }} {{ $debtorContact->middlename }} {{ $clientContact->name }}</strong><br>
                                    {{ $debtorContact->street }} {{ $debtorContact->housenr }}<br>
                                    {{ $debtorContact->city }}, {{ $debtorContact->postcode }}<br>
                                    <abbr title="Phone">P:</abbr> {{ $debtorContact->phone }}<br/>
                                    <abbr title="Email">E:</abbr> {{ $debtorContact->email }}
                                </address>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!--// Overzicht client met potlood te bewerken. // -->
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Invoices</div>
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>title</th>
                                <th>amount</th>
                                <th>due_date</th>
                                <th>remarks</th>
                                <th>created</th>
                                <th>modified</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($invoices as $invoice)
                                <td>{{ $invoice->id }}</td>
                                <td>{{ $invoice->title }}</td>
                                <td>{{ $invoice->amount }}</td>
                                <td>{{ $invoice->due_date }}</td>
                                <td>{{ $invoice->remarks }}</td>
                                <td>{{ $invoice->created_at }}</td>
                                <td>{{ $invoice->modified_at }}</td>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Actions
                        <div class="pull-right">
                            <a href="{{ route('admin.dossier.action.create', ['id' => $dossier->id]) }}">
                                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>title</th>
                                <th>status</th>
                                <th>comment</th>
                                <th>created</th>
                                <th>modified</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($actions as $action)

                                <td>{{ $action->id }}</td>
                                <td>{{ $action->title }}</td>
                                <td>{{ $action->listaction()->first()->description }}</td>
                                <td>{{ $action->comments()->first()->comment }}</td>
                                <td>{{ $action->created_at }}</td>
                                <td>{{ $action->modified_at }}</td>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

    </div>
@endsection