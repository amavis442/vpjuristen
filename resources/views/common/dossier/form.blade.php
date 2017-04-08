@if (is_object($dossier) && $dossier->id > 0)
    <input type="hidden" name="dossier[id]" value="{{ $dossier->id }}" />
@endif
<div class="form-group">
    {!! Form::label('Title',null, ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('dossier[name]', $dossier->title,
        ['required',
          'class'=>'form-control',
          'placeholder'=>'Title']) !!}
    </div>
</div>

