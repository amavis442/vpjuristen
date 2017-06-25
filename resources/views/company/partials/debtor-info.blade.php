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