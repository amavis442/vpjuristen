<div class="col-md-6">
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong>Client info</strong>
            @can('edit', $client)
                <div class="pull-right">
                    <a href="{{ route($routeEditClient, ['company' => $client]) }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                </div>
            @endcan
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
