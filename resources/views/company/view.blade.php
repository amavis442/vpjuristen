<div class="col-md-6">
    <address>
        <strong>{{ $company->name }}</strong><br>
        {{ $company->street }} {{ $company->housenr }}<br>
        {{ $company->city }}, {{ $company->postcode }}<br>
        <abbr title="Phone">P:</abbr> {{ $company->phone }}<br/>
        <abbr title="Email">E:</abbr> {{ $company->email }}
    </address>
</div>