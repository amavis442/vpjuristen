@section('adminlte_js')
    <script type="text/javascript" src="{{ asset('js/collections.js') }}"></script>
@endsection

@section('content')
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="{{ back()->getTargetUrl() }}">Home</a></li>

        </ol>
    </div>
    <div class="container">
        {!! Form::open(['route' => 'admin.dossier.action.store', 'class' => 'form-horizontal']) !!}
        <input type="hidden" name="dossier[id]" value="{{ $dossier_id }}" id="dossier_id"/>
        <input type="hidden" name="action[id]" value="{{ $action->id }}" id="action_id"/>

        <div class="panel panel-default">
            <div class="panel-heading">
                Action
            </div>
            <div class="panel-body">

                <div class="form-group">
                    <label for="title" class="col-sm-2 control-label">Action</label>
                    <div class="col-sm-10">
                        <select name="action[listaction_id]" id="action_listaction_id" class="form-control">
                            @foreach ($listActions as $item)
                                <option value="{{ $item->id }}"
                                        data-content="{{ $item->description  }}"
                                    @if(isset($action) && $action->listaction_id == $item->id)
                                        selected="selected"
                                        @endif
                                >{{ $item->description }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="title" class="col-sm-2 control-label">Title</label>
                    <div class="col-sm-10">

                        <input type="text" name="action[title]" id="action_title" class="form-control" value="{{ $action->title }}"/>
                    </div>
                </div>

                <div class="form-group" id="collection" style="display:none">
                    <label for="title" class="col-sm-2 control-label">Amount</label>
                    <div class="col-sm-10">
                        <input type="hidden" name="collection[id]" id="collection_id" value="@if($collection) {{ $collection->id }} @endif">
                        <input type="text" name="collection[amount]" id="collection_amount" class="form-control" value="@if($collection) {{ $collection->amount  }} @endif"/>
                    </div>
                </div>


                <div class="form-group">
                    <label for="title" class="col-sm-2 control-label">Comment</label>
                    <div class="col-sm-10">
                        <textarea name="comment[comment]" id="comment_comment" class="form-control"></textarea>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="title" class="col-sm-2 control-label">Visible</label>
                <div class="col-sm-10">
                    <label class="checkbox-inline">
                        <input type="checkbox" id="role_client" name="role[client]" value="client" @if($checkClient) checked @endif> Client
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" id="role_debtor" name="role[debtor]" value="debtor" @if($checkDebtor) checked @endif> Debtor
                    </label>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    {!! Form::submit('Save!',
                  array('class'=>'btn btn-primary')) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>

        @if ($comments)
            <div class="panel panel-default">
                <div class="panel-heading">
                    Comments
                </div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Comment</th>
                                <th>Date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($comments as $comment)
                                <tr>
                                    <td>{{ $comment->id }}</td>
                                    <td>{{ $comment->comment }}</td>
                                    <td>{{ $comment->updated_at }}</td>
                                    <td><a href="#{{ $comment->id }}">bewerken</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        @endif
    </div>
@endsection