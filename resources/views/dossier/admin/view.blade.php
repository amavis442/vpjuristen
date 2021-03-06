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

        @include('company.partials.client-info')

        @include('company.partials.debtor-info')
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