@if(Session::has('message'))
    <p class="alert alert-info">{{ Session::get('message') }}</p>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif