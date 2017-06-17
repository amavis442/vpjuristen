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
            @can('view', $item)
            <tr>
                <td>#{{ $item->id }}</td>
                <td>
                    <a href="{{ route($route, ['id' => $item->id]) }}">{{ $item->title }}</a>
                </td>
                <td>{{ $item->client()->first()->name  }}</td>
                <td>{{ $item->debtor()->first()->name  }}</td>
                <td>{{ ($item->actions()->count() > 0 ? $item->actions()->first()->title: '-')  }}</td>
                <td>{{ $item->dossierstatus()->first()->description  }}</td>
                <td> {{ $item->created_at }}</td>
                <td> {{ $item->updated_at }}</td>
            </tr>
            @endcan
        @endforeach
        </tbody>
    </table>
</div>
