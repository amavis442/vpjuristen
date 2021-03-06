<div id="invoice{{ $invoice->id}}">
    <h2>Invoice #{{ $invoice->title }}</h2>

    <div class="form-group">
        {!! Form::label('Title',null, ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::text('title', $invoice->title,
            ['required',
              'class'=>'form-control',
              'placeholder'=>'Title']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('Amount',null, ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::text('amount', $invoice->amount,
            ['required',
              'class'=>'form-control',
              'placeholder'=>'Amount']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('Due date',null, ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::text('due_date', $invoice->due_date,
            ['required',
              'class'=>'form-control',
              'placeholder'=>'Due date']) !!}
        </div>
    </div>

    <div class="control-group">
        <div class="controls">
            {!! Form::label('Invoice',null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
            {!! Form::file('invoice_file') !!}

            @if (!is_null($invoice->getMedia('invoices')))
                @foreach ($invoice->getMedia('invoices') as $media)
                    <a href="{!! route('file.download', ['invoice' => $invoice,'id' => $media->id]) !!}" target="_blank">{{ $media->file_name }}</a>
                @endforeach
            @endif

            <p class="errors">{!!$errors->first('invoice')!!}</p>
            @if(Session::has('error'))
                <p class="errors">{!! Session::get('error') !!}</p>
            @endif
            </div>
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('Remarks',null, ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::textarea('remarks', $invoice->remarks,
            ['required',
              'class'=>'form-control',
              'placeholder'=>'Remarks']) !!}
        </div>
    </div>
<div class="col-md-10">
            <span class="pull-right">
            <input type="submit" class="btn btn-default" value="Save">
                </span>
    </div>
</div>