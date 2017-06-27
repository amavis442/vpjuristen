<div class="panel panel-default">
    <div class="panel-heading">
        <h2>Dossier</h2>
    </div>
    <div class="panel-body">
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
                @foreach($dossiers as $dossierCol)
                    <?php
                    $actions = $dossierCol->get('actions');
                    $dossier = $dossierCol->get('dossier');
                    $debtors = $dossierCol->get('companies');
                    $dossierstatus = $dossierCol->get('dossierstatus');
                    ?>
                    <tr>
                        <td>#{{ $dossier->id }}</td>
                        <td>
                            <a href="{{ route('admin.dossier.show',['id' => $dossier->id]) }}">{{ $dossier->title }}</a>
                        </td>
                        <td>{{ $company->name  }}</td>
                        <td>{{ $debtors->first()->name  }}</td>
                        <td>{{ ($actions->count() > 0 ? $actions->first()->title: '-')  }}</td>
                        <td>{{  $dossierstatus->description  }}</td>
                        <td> {{ $dossier->created_at }}</td>
                        <td> {{ $dossier->updated_at }}</td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>
