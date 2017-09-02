<div id="invoice{{ $index }}">
    <h2>Invoice #{{ $index + 1 }}</h2>
    @if (is_object($invoice) && $invoice->id > 0)
        <input type="hidden" name="invoice[{{  $index }}][id]" value="{{ $invoice->id }}"/>
    @endif

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button onclick="delInvoice({{ $index }});return false;" class="btn btn-defalt" id="delInvoice{{ $index }}">
                Remove invoice # {{ $index + 1 }}
            </button>
        </div>
    </div>

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
            {!! Form::label('Invoice',null, ['class' => 'col-sm-2 control-label']) !!}
            {!! Form::file('invoice_'.$index.'_file') !!}

            @if (!is_null($invoice->files()->first()))
                <a href="{!! route('dashboard.invoice.download.file', ['invoice_id'=>$invoice->id]) !!}" target="_blank">{{ $invoice->files()->first()->filename_org }}</a>
            @endif

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
</div>