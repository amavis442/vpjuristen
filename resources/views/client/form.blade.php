<ul>
    @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
</ul>

{!! Form::open(['route' => 'client-store', 'class' => 'form-horizontal']) !!}


<h1>Client</h1>


<div class="row">
    <div class="form-group">
        {!! Form::label('Your Name',null, ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::text('client[name]', $client->name,
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
            {!! Form::text('client[company]', null,
            ['class'=>'form-control',
                  'placeholder'=>'Company'])
            !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="form-group">
        {!! Form::label('Street',null, ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-10">{!! Form::text('client[street]', null, [
            'required',
            'class' => 'form-control',
            'placeholder' => 'Street'
        ]) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('Housenr',null, ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-4">{!! Form::text('client[housenr]', null,
            ['required',
            'class'=>'form-control',
            'placeholder'=>'House number'])
        !!}
        </div>

        {!! Form::label('Zipcode',null, ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-4">{!! Form::text('client[postcode]', null,
            ['required',
            'class'=>'form-control',
            'placeholder'=>'Zipcode'])
        !!}</div>
    </div>
</div>

<div class="row">
    <div class="form-group">
        {!! Form::label('City',null, ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-4">{!! Form::text('client[city]', null,
            ['required',
            'class'=>'form-control',
            'placeholder'=>'City'])
        !!}
        </div>

        {!! Form::label('Country',null, ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-4">{!! Form::text('client[country]', null,
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
        <div class="col-sm-4">{!! Form::text('client[phone]', null,
            ['required',
            'class'=>'form-control',
            'placeholder'=>'Phone number'])
        !!}</div>

        {!! Form::label('Your E-mail Address',null, ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-4">{!! Form::text('client[email]', null,
            array('required',
                  'class'=>'form-control',
                  'placeholder'=>'Your e-mail address')) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="form-group">
        {!! Form::label('Website',null, ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-10">{!! Form::text('client[website]', null,
            ['class'=>'form-control',
            'placeholder'=>'Website',
            'id' => 'Client_website'])
        !!}</div>
    </div>
</div>

<div class="row">
    <h2>Contact</h2>
</div>


<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {!! Form::submit('Apply!',
      array('class'=>'btn btn-primary')) !!}
    </div>
</div>
{!! Form::close() !!}