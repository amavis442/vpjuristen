<input type="hidden" name="id" value="@if(isset($comment))  {{ $comment->id }} @endif" id="id"/>

<div class="form-group">
    <label for="title" class="col-sm-2 control-label">Comment</label>
    <div class="col-sm-10">
        <textarea name="comment" id="comment_comment" class="form-control">@if(isset($comment)) {{ $comment->comment  }} @endif</textarea>
    </div>
</div>
