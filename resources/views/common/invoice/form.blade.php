<div class="form-group">
    {!! Form::label('Title',null, ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('invoice['.$index.'][title]', $invoice->title,
        ['required',
          'class'=>'form-control',
          'placeholder'=>'Title']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('Amount',null, ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('invoice['.$index.'][amount]', $invoice->amount,
        ['required',
          'class'=>'form-control',
          'placeholder'=>'Amount']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('Due date',null, ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('invoice['.$index.'][due_date]', $invoice->due_date,
        ['required',
          'class'=>'form-control',
          'placeholder'=>'Due date']) !!}
    </div>
</div>

<div class="control-group">
    <div class="controls">
        {!! Form::file('invoice_'.$index.'_file') !!}
        <p class="errors">{!!$errors->first('invoice')!!}</p>
        @if(Session::has('error'))
            <p class="errors">{!! Session::get('error') !!}</p>
        @endif
    </div>
</div>

<div class="form-group">
    {!! Form::label('Remarks',null, ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::textarea('invoice['.$index.'][remarks]', $invoice->remarks,
        ['required',
          'class'=>'form-control',
          'placeholder'=>'Remarks']) !!}
    </div>
</div>
