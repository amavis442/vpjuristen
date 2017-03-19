<ul>
    @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
</ul>

{!! Form::open(['route' => 'debtor-store', 'class' => 'form-horizontal']) !!}


<h1>Debtor</h1>


<div class="row">
    <div class="form-group">
        {!! Form::label('Debtor',null, ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::text('debtor[name]', $debtor->name,
            ['required',
              'class'=>'form-control',
              'placeholder'=>'Your name']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="form-group">
        {!! Form::label('Company',null, ['class' => 'col-sm-2 control-label']) !!}

        <div class="col-sm-10">
            {!! Form::text('debtor[company]', null,
            ['class'=>'form-control',
                  'placeholder'=>'Company'])
            !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="form-group">
        {!! Form::label('Street',null, ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-6">{!! Form::text('debtor[street]', null, [
            'required',
            'class' => 'form-control',
            'placeholder' => 'Street'
        ]) !!}
        </div>

        {!! Form::label('Housenr',null, ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-2">{!! Form::text('debtor[housenr]', null,
            ['required',
            'class'=>'form-control',
            'placeholder'=>'House number'])
        !!}
        </div>
    </div>
</div>


<div class="row">
    <div class="form-group">
        {!! Form::label('Zipcode',null, ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-2">{!! Form::text('debtor[postcode]', null,
            ['required',
            'class'=>'form-control',
            'placeholder'=>'Zipcode'])
        !!}</div>

        {!! Form::label('City',null, ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-6">{!! Form::text('debtor[city]', null,
            ['required',
            'class'=>'form-control',
            'placeholder'=>'City'])
        !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="form-group">
        {!! Form::label('Country',null, ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-6">{!! Form::text('debtor[country]', null,
            ['required',
            'class'=>'form-control',
            'placeholder'=>'Country'])
        !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="form-group">
        {!! Form::label('Phone number',null, ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-4">{!! Form::text('debtor[phone]', null,
            ['required',
            'class'=>'form-control',
            'placeholder'=>'Phone number'])
            !!}
        </div>

        {!! Form::label('Your E-mail Address',null, ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-4">{!! Form::text('debtor[email]', null,
            array('required',
                  'class'=>'form-control',
                  'placeholder'=>'Your e-mail address'))
                  !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="form-group">
        {!! Form::label('Website',null, ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-10">{!! Form::text('debtor[website]', null,
            ['class'=>'form-control',
            'placeholder'=>'Website',
            'id' => 'Client_website'])
        !!}</div>
    </div>
</div>

@include('contact.form')

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {!! Form::submit('Next!',
      array('class'=>'btn btn-primary')) !!}
    </div>
</div>
{!! Form::close() !!}