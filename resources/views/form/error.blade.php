@if(Session::has('message'))
    <p class="alert alert-info">{{ Session::get('message') }}</p>
@endif

<ul>
    @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
</ul>