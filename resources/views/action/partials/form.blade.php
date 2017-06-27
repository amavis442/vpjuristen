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
        <div class="col-sm-10">
            <select name="action_dossier_public" id="action_dossier_public" class="form-control">
                <option value="none" @if(isset($public) && $public == 'none') {{ 'selected' }} @endif>None</option>
                <option value="client" @if(isset($public) && $public == 'client') {{ 'selected' }} @endif>Client</option>
                <option value="debtor" @if(isset($public) && $public == 'debtor') {{ 'selected' }} @endif>Debtor</option>
                <option value="all" @if(isset($public) && $public == 'all') {{ 'selected' }} @endif>All</option>
            </select>
        </div>
    </div>
</div>