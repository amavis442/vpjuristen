@extends('adminlte::page')

@section('content')
    <?php
    /** Illuminate\Support\Collection  $summary */
    /** \App\Dossier $dossier */
    $dossier = $summary->get('dossier');
    $dossierStatus = $summary->get('dossierStatus');
    $client = $summary->get('client');
    $clientContact = $summary->get('clientContact');

    $debtor = $summary->get('debtor');
    $debtorContact = $summary->get('debtorContact');
    $totalSom = $summary->get('totalSom');
    $receivedSom = $summary->get('receivedSom');
    $paidSom = $summary->get('paidSom');
    $remainingSom = $summary->get('remainingSom');

    $invoiceCollection = $summary->get('invoiceCollection');
    $invoices = $invoiceCollection->get('invoices');
    $invoiceFiles = $invoiceCollection->get('invoiceFiles');

    $actionCollection = $summary->get('actionCollection');
    $actions = $actionCollection->get('actions');
    $actionMeta = $actionCollection->get('meta');
    $recentCollectionDate = $actionCollection->get('recentCollectionDate');
    $recentPaymentDate = $actionCollection->get('recentPaymentDate');
    ?>

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
                                    <strong>{{ $debtor->company }}</strong><br>
                                    {{ $debtor->street }} {{ $debtor->housenr }}<br>
                                    {{ $debtor->city }}, {{ $debtor->postcode }}<br>
                                    <abbr title="Phone">P:</abbr> {{ $debtor->phone }}<br/>
                                    <abbr title="Email">E:</abbr> {{ $debtor->email }}
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
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading"><strong>Summary</strong></div>
                    <div class="panel-body">
                        <ul>
                            <li>Total Som: &euro;{{ $totalSom }}</li>
                            <li>Received:
                                &euro;{{ $receivedSom }} @if(isset($recentCollectionDate)) {{ $recentCollectionDate->format('d-m-Y') }} @endif</li>
                            <li>Paid:
                                &euro;{{ $paidSom }} @if(isset($recentPaymentDate)) {{ $recentPaymentDate->format('d-m-Y') }} @endif</li>
                            <li>Remaining: &euro;{{ $remainingSom }}</li>
                        </ul>
                    </div>
                </div>
            </div>
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
                                <th>files</th>
                                <th>created</th>
                                <th>modified</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($invoices as $invoice)
                                @can('view', $invoice)
                                    <td>{{ $invoice->id }}</td>
                                    <td>{{ $invoice->title }}</td>
                                    <td>{{ $invoice->amount }}</td>
                                    <td>{{ $invoice->due_date }}</td>
                                    <td>{{ $invoice->remarks }}</td>
                                    <td>
                                        @if($invoiceFiles[$invoice->id])
                                            @foreach($invoiceFiles[$invoice->id] as $file)
                                                <a href="{{ $file['url']}}" target="_blank">{{ $file['name'] }}</a><br/>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>{{ $invoice->created_at }}</td>
                                    <td>{{ $invoice->modified_at }}</td>
                                @endcan
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
                                <th>Visible for client</th>
                                <th>Visible for debtor</th>
                                <th>Amount</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($actions as $action)
                                @if(Auth::user()->can('view',$action))
                                    <?php
                                    $meta = $actionMeta->get($action->id);
                                    ?>
                                    <tr>
                                        <td>{{ $action->id }}</td>
                                        <td>{{ $action->title }}</td>
                                        <td>{{ $meta->get('actionStatus') }}</td>
                                        <td>{{ $meta->get('comment','') }}</td>
                                        <td>{{ $action->created_at }}</td>
                                        <td>{{ $action->updated_at }}</td>
                                        <td>{{ $meta->get('clientCanSee') }}</td>
                                        <td>{{ $meta->get('debtorCanSee') }}</td>
                                        <td>{{ $meta->get('amount') }}</td>
                                        <td>
                                            <a href="{{ route('admin.dossier.action.edit', $action->id) }}">Bijwerken</a>
                                        </td>
                                    </tr>
                                @endif
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