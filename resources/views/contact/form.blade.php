@if (!$contactShort):
<ul>
    @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
</ul>

{!! Form::open(['route' => 'client-store', 'class' => 'form-horizontal']) !!}
@endif

<h1>Contact</h1>

<div class="row">
    <div class="form-group">
        {!! Form::label('Sexe',null, ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            <label class="radio-inline">
            {!! Form::radio('contact[sexe]', 'M', [
            'required',
            'class' => 'form-control'
            ]) !!}Dhr.
            </label>
            <label class="radio-inline">
            {!! Form::radio('contact[sexe]', 'V', [
            'required',
            'class' => 'form-control'
            ]) !!} Mevr.
            </label>
        </div>
    </div>
</div>

<div class="row">
    <div class="form-group">
        {!! Form::label('Firstname',null, ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-2">
            {!! Form::text('contact[firstname]', null, [
            'required',
            'class' => 'form-control',
            'placeholder' => 'Firstname'])
            !!}
        </div>

        {!! Form::label('Middlename',null, ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-2">
            {!! Form::text('contact[middlename]', null,
            ['class'=>'form-control',
            'placeholder'=>'Middlename'])
            !!}
        </div>

        {!! Form::label('Name',null, ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-2">
            {!! Form::text('contact[name]', null,
            ['required',
            'class'=>'form-control',
            'placeholder'=>'Name'])
            !!}
        </div>
    </div>
</div>


@if (!$contactShort):
<div class="row">
    <div class="form-group">
        {!! Form::label('Street',null, ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-10">{!! Form::text('contact[street]', null, [
            'required',
            'class' => 'form-control',
            'placeholder' => 'Street'
        ]) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('Housenr',null, ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-4">{!! Form::text('contact[housenr]', null,
            ['required',
            'class'=>'form-control',
            'placeholder'=>'House number'])
        !!}
        </div>

        {!! Form::label('Zipcode',null, ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-4">{!! Form::text('contact[postcode]', null,
            ['required',
            'class'=>'form-control',
            'placeholder'=>'Zipcode'])
        !!}</div>
    </div>
</div>

<div class="row">
    <div class="form-group">
        {!! Form::label('City',null, ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-4">{!! Form::text('contact[city]', null,
            ['required',
            'class'=>'form-control',
            'placeholder'=>'City'])
        !!}
        </div>

        {!! Form::label('Country',null, ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-4">{!! Form::text('contact[country]', null,
            ['required',
            'class'=>'form-control',
            'placeholder'=>'Country'])
        !!}
        </div>
    </div>
</div>
@endif

<div class="row">
    <div class="form-group">
        {!! Form::label('Phone number',null, ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-4">{!! Form::text('contact[phone]', null,
            ['required',
            'class'=>'form-control',
            'placeholder'=>'Phone number'])
        !!}</div>

        {!! Form::label('Your E-mail Address',null, ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-4">{!! Form::text('contact[email]', null,
            array('required',
                  'class'=>'form-control',
                  'placeholder'=>'Your e-mail address')) !!}
        </div>
    </div>
</div>

@if (!$contactShort):
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


<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {!! Form::submit('Apply!',
      array('class'=>'btn btn-primary')) !!}
    </div>
</div>

{!! Form::close() !!}
@endif