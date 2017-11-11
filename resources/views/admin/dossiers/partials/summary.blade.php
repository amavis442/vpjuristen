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