<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">Actions
            <div class="pull-right">
                <a href="{{ route('admin.dossier.action.create', ['id' => $dossier->id]) }}">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
            </div>
        </div>
        <div class="panel-body">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>title</th>
                    <th>status</th>
                    <th>comment</th>
                    <th>Visible for client</th>
                    <th>Visible for debtor</th>
                    <th>Amount</th>
                    <th>created</th>
                    <th>modified</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($actions as $action)
                    @if(Auth::user()->can('view',$action))
                        <?php
                        $meta = $actionMeta->get($action->id);
                        ?>
                        <tr>
                            <td>{{ $action->id }}</td>
                            <td>{{ $action->title }}</td>
                            <td>{{ $meta->get('actionStatus') }}</td>
                            <td>{{ $meta->get('comment','') }}</td>

                            <td>{{ $meta->get('clientCanSee') }}</td>
                            <td>{{ $meta->get('debtorCanSee') }}</td>
                            <td>{{ $meta->get('amount') }}</td>
                            <td>{{ $action->created_at->format('d-m-Y') }}</td>
                            <td>{{ $action->updated_at->format('d-m-Y') }}</td>
                            <td>
                                <a href="{{ route('admin.dossier.action.edit', $action->id) }}">Bijwerken</a>
                            </td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>