@section('content')
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>

    {!! Form::open(['route' => 'dossier-store', 'class' => 'form-horizontal']) !!}

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            {!! Form::submit('Apply!',
          array('class'=>'btn btn-primary')) !!}
        </div>
    </div>

    {!! Form::close() !!}
@endsection
