<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">Actions
            @can('create', \App\Action::class)
                <div class="pull-right">
                    <a href="{{ route('admin.dossier.action.create', ['id' => $dossier->id]) }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
                </div>
            @endcan
        </div>
        <div class="panel-body">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>title</th>
                    <th>status</th>
                    <th>comment</th>
                    @can('edit', \App\Action::class)
                        <th>public</th>
                        <th>Amount</th>
                        <th>created</th>
                        <th>modified</th>
                    @endcan
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($actions as $action)
                    @can('view', $action)
                        <?php
                        $meta = $actionMeta->get($action->id);
                        ?>
                        <tr>
                            <td>{{ $action->id }}</td>
                            <td>{{ $action->title }}</td>
                            <td>{{ $meta->get('actionStatus') }}</td>
                            <td>{{ $meta->get('comment','') }}</td>
                            @can('edit',\App\Action::class)
                                <td>{{ $meta->get('public') }}</td>
                                <td>{{ $meta->get('amount') }}</td>
                                <td>{{ $action->created_at->format('d-m-Y') }}</td>
                                <td>{{ $action->updated_at->format('d-m-Y') }}</td>
                            @endcan
                            <td>
                                @can('edit', $action)
                                    <a href="{{ route('admin.dossier.action.edit', $action->id) }}">Bijwerken</a>
                                @endcan
                            </td>
                        </tr>
                    @endcan
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>