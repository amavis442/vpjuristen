<div class="col-md-6">
    <address>
        <strong>{{ $contact->sexe }} {{ $contact->firstname }} {{ $contact->middlename }} {{ $contact->name }}</strong><br>
        {{ $contact->street }} {{ $contact->housenr }}<br>
        {{ $contact->city }}, {{ $contact->postcode }}<br>
        <abbr title="Phone">P:</abbr> {{ $contact->phone }}<br/>
        <abbr title="Email">E:</abbr> {{ $contact->email }}
    </address>
</div>