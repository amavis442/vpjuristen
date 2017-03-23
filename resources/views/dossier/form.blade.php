<ul>
    @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
</ul>

{!! Form::open(['route' => 'dossier-store', 'class' => 'form-horizontal', 'files' => true ]) !!}

<div class="row">
    <div class="form-group">
        {!! Form::label('Title',null, ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::text('dossier[name]', $dossier->title,
            ['required',
              'class'=>'form-control',
              'placeholder'=>'Title']) !!}
        </div>
    </div>
</div>

@include('invoice.form')

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {!! Form::submit('Apply!',
      array('class'=>'btn btn-primary')) !!}
    </div>
</div>

{!! Form::close() !!}

