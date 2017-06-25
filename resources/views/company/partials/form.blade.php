
<input type="hidden" name="company[id]" value="{{ $company->id }}"/>

<div class="form-group">
    {!! Form::label('Name',null, ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('company[name]', $company->name,
        ['required',
          'class'=>'form-control',
          'placeholder'=>'Your name']) !!}
    </div>
</div>


<div class="form-group">
    {!! Form::label('Company name',null, ['class' => 'col-sm-2 control-label']) !!}

    <div class="col-sm-10">
        {!! Form::text('company[company]', $company->company,
        ['class'=>'form-control',
              'placeholder'=>'Company'])
        !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('Street',null, ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-6">{!! Form::text('company[street]', $company->street, [
            'required',
            'class' => 'form-control',
            'placeholder' => 'Street'
        ]) !!}
    </div>

    {!! Form::label('Housenr',null, ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-2">{!! Form::text('company[housenr]', $company->housenr,
            ['required',
            'class'=>'form-control',
            'placeholder'=>'House number'])
        !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('Zipcode',null, ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-2">{!! Form::text('company[postcode]', $company->postcode,
            ['required',
            'class'=>'form-control',
            'placeholder'=>'Zipcode'])
        !!}</div>

    {!! Form::label('City',null, ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-6">{!! Form::text('company[city]', $company->city,
            ['required',
            'class'=>'form-control',
            'placeholder'=>'City'])
        !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('Country',null, ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-6">{!! Form::text('company[country]', $company->country,
            ['required',
            'class'=>'form-control',
            'placeholder'=>'Country'])
        !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('Phone number',null, ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-4">{!! Form::text('company[phone]', $company->phone,
            ['required',
            'class'=>'form-control',
            'placeholder'=>'Phone number'])
            !!}
    </div>

    {!! Form::label('Your E-mail Address',null, ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-4">{!! Form::text('company[email]', $company->email,
            array('required',
                  'class'=>'form-control',
                  'placeholder'=>'Your e-mail address'))
                  !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('Website',null, ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">{!! Form::text('company[website]', $company->website,
            ['class'=>'form-control',
            'placeholder'=>'Website',
            'id' => 'Client_website'])
        !!}</div>
</div>

