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
        @if ($comment->id)
        <tr>
            <td>{{ $comment->id }}</td>
            <td>{{ $comment->comment }}</td>
            <td>{{ $comment->updated_at }}</td>
            <td><a href="{{ route('admin.comment.edit',$comment) }}">bewerken</a></td>
        </tr>
        @endif
    @endforeach
    </tbody>
</table>
