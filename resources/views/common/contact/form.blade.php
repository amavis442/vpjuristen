<input type="hidden" name="contact[id]" value="{{ $contact->id }}"/>
<input type="hidden" name="contact[company_id]" value="{{ $company->id }}"/>

<div class="form-group">
    {!! Form::label('Sexe','Sexe', ['class' => 'col-sm-2 control-label']) !!}

    <div class="col-sm-10">
        <label class="radio-inline">
            {!! Form::radio('contact[sexe]', 'M', ($contact->sexe == 'M'?true:false), [
            'required',
            'id' => 'contact_sexe_m'
            ]) !!} Dhr.
        </label>

        <label class="radio-inline">
            {!! Form::radio('contact[sexe]', 'V',($contact->sexe == 'V'?true:false), [
            'required',
            'id' => 'contact_sexe_v'
            ]) !!} Mevr.
        </label>
    </div>

</div>

<div class="form-group">
    {!! Form::label('Firstname',null, ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-2">
        {!! Form::text('contact[firstname]', $contact->firstname, [
        'required',
        'class' => 'form-control',
        'placeholder' => 'Firstname'])
        !!}
    </div>

    {!! Form::label('Middlename',null, ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-2">
        {!! Form::text('contact[middlename]', $contact->middlename,
        ['class'=>'form-control',
        'placeholder'=>'Middlename'])
        !!}
    </div>

    {!! Form::label('Name',null, ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-2">
        {!! Form::text('contact[name]', $contact->name,
        ['required',
        'class'=>'form-control',
        'placeholder'=>'Name'])
        !!}
    </div>
</div>


@if (!$contactShort):
<div class="form-group">
    {!! Form::label('Street',null, ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">{!! Form::text('contact[street]', $contact->street, [
            'required',
            'class' => 'form-control',
            'placeholder' => 'Street'
        ]) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('Housenr',null, ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-4">{!! Form::text('contact[housenr]', $contact->housenr,
            ['required',
            'class'=>'form-control',
            'placeholder'=>'House number'])
        !!}
    </div>

    {!! Form::label('Zipcode',null, ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-4">{!! Form::text('contact[zipcode]', $contact->zipcode,
            ['required',
            'class'=>'form-control',
            'placeholder'=>'Zipcode'])
        !!}</div>
</div>

<div class="form-group">
    {!! Form::label('City',null, ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-4">{!! Form::text('contact[city]', $contact->city,
            ['required',
            'class'=>'form-control',
            'placeholder'=>'City'])
        !!}
    </div>

    {!! Form::label('Country',null, ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-4">{!! Form::text('contact[country]', $contact->country,
            ['required',
            'class'=>'form-control',
            'placeholder'=>'Country'])
        !!}
    </div>
</div>
@endif

<div class="form-group">
    {!! Form::label('Phone number',null, ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-4">{!! Form::text('contact[phone]', $contact->phone,
            ['required',
            'class'=>'form-control',
            'placeholder'=>'Phone number'])
        !!}</div>

    {!! Form::label('Your E-mail Address',null, ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-4">{!! Form::text('contact[email]', $contact->email,
            array('required',
                  'class'=>'form-control',
                  'placeholder'=>'Your e-mail address')) !!}
    </div>
</div>
