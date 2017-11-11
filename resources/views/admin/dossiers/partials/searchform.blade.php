<div class="row">
    <form action="{{ route('admin.dossiers.search') }}" method="get">
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
        @foreach($data as $item)
            <?php
            /** @var \App\Models\Dossier $dossier */
            $dossier = $item->get('dossier');
            /** @var \App\Models\Company $client */
            $client = $item->get('client');
            /** @var  \App\Models\Company $debtor */
            $debtor = $item->get('debtor');
            /** @var \App\Models\Action $actions */
            $actions = $item->get('actions');
            /** @var \App\Models\Dossierstatus $dossierstatus */
            $dossierstatus = $item->get('dossierstatus');
            ?>
            @can('view', $dossier)
                <tr>
                    <td>#{{ $dossier->id }}</td>
                    <td>
                        <a href="{{ route('admin.dossiers.show', $dossier) }}">{{ $dossier->title }}</a>
                    </td>
                    <td>{{ $client->name  }}</td>
                    <td>{{ $debtor->name  }}</td>
                    <td>{{ ($actions->count() > 0 ? $actions->first()->title: '-')  }}</td>
                    <td>{{ $dossierstatus->description  }}</td>
                    <td> {{ $dossier->created_at }}</td>
                    <td> {{ $dossier->invoices()->count() }}</td>
                </tr>
            @endcan
        @endforeach
        </tbody>
    </table>
</div>
