<div class="form-group">
    {!! Form::label('Title',null, ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('dossier[name]', $dossier->title,
        ['required',
          'class'=>'form-control',
          'placeholder'=>'Title']) !!}
    </div>
</div>

