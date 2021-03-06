@can('search')
<div class="row">

        <form action="{{ url($searchUrl) }}" method="get">
            <div class="form-group">
                <input
                        type="text"
                        name="q"
                        class="form-control"
                        placeholder="Search..."
                        value="{{ request('q') }}"
                />
            </div>
        </form>
</div>
@endcan

<div class="row">
    <table class="table">
        <thead>
        <th>ID</th>
        <th>Description</th>
        <th>Client</th>
        <th>Debtor</th>
        <th>Last Action</th>
        <th>Status</th>
        <th>Created</th>
        <th>Invoices</th>
        </thead>

        <tbody>
        @foreach($dossiers as $item)
            <?php
                $companies = $item->companies;
                foreach ($companies as $company) {
                    $type = $company->pivot->type;
                    if ($type =='client') {
                        $client = $company;
                    }
                    if ($type =='debtor') {
                        $debtor = $company;
                    }
                }
            ?>
            <tr>
                <td>#{{ $item->id }}</td>
                <td>
                    <a href="{{ route($route,['id' => $item->id]) }}">{{ $item->title }}</a>
                </td>
                <td>{{ $client->name  }}</td>
                <td>{{ $debtor->name  }}</td>
                <td>{{ ($item->actions->count() > 0 ? $item->actions->last()->title: '-')  }}</td>
                <td>{{ $item->dossierstatus->first()->description  }}</td>
                <td> {{ $item->created_at }}</td>
                <td> {{ $item->updated_at }}</td>
            </tr>
        @endforeach
        </tbody>

    </table>
</div>
