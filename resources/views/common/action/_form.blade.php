{!! Form::open(['route' => $route, 'class' => 'form-horizontal']) !!}
<input type="hidden" name="dossier[id]" value="{{ $dossier_id }}" id="dossier_id"/>
<input type="hidden" name="action[id]" value="{{ $action->id }}" id="action_id"/>

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

        <input type="text" name="action[title]" id="action_title" class="form-control"
               value="{{ $action->title }}"/>
    </div>
</div>

<div class="form-group" id="collection" style="display:none">
    <label for="title" class="col-sm-2 control-label">Amount</label>
    <div class="col-sm-10">
        <input type="hidden" name="collection[id]" id="collection_id"
               value="@if(isset($collection)) {{ $collection->id }} @endif">
        <input type="text" name="collection[amount]" id="collection_amount" class="form-control"
               value="@if(isset($collection)) {{ $collection->amount  }} @endif"/>
    </div>
</div>


<div class="form-group">
    <label for="title" class="col-sm-2 control-label">Comment</label>
    <div class="col-sm-10">
        <textarea name="comment[comment]" id="comment_comment" class="form-control"></textarea>
    </div>
</div>

<div class="form-group">
    <label for="title" class="col-sm-2 control-label">Visible</label>
    <div class="col-sm-10">
        <label class="checkbox-inline">
            <input type="checkbox" id="role_client" name="role[client]" value="client"
                   @if(isset($checkClient)) checked @endif> Client
        </label>
        <label class="checkbox-inline">
            <input type="checkbox" id="role_debtor" name="role[debtor]" value="debtor"
                   @if(isset($checkDebtor)) checked @endif> Debtor
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