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
                        <strong>Client</strong>
                        @can('edit', $client)
                            <div class="pull-right">
                                <a href="{{ route('admin.clients.edit', $client) }}">
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                            </div>
                        @endcan
                    </div>
                    <div class="panel-body">
                        @include('company.view',['company' => $client])
                        @include('contact.view',['contact' => $clientContact])
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>Debtor</strong>
                        @can('edit', $debtor)
                            <div class="pull-right">
                                <a href="{{ route('admin.debtors.edit', $debtor) }}">
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                            </div>
                        @endcan
                    </div>
                    <div class="panel-body">
                        @include('company.view', ['company' => $debtor])
                        @include('contact.view', ['contact' => $debtorContact])
                    </div>
                </div>
            </div>
        <!--// Overzicht client met potlood te bewerken. // -->
        </div>

        @include('dossier.partials.summary')

        <div class="row">
            @include('invoice.partials.list')
        </div>

        <div class="row">
            @include('action.partials.list')
        </div>

    </div>
@endsection