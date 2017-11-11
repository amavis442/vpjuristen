<div class="form-group">
    {!! Form::label('Name',null, ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-2">
        {!! Form::text('user[name]', $user->name, [
        'required',
        'class' => 'form-control',
        'placeholder' => 'Name'])
        !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('E-mail Address',null, ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-4">
        {!! Form::text('user[email]', $user->email,
            array('required',
                  'class'=>'form-control',
                  'placeholder'=>'E-mail address')) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('Password',null, ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-4">
        {!! Form::text('user[password]', '',
            array((is_null($user) ? 'required' : 'notrequired'),
                  'class'=>'form-control',
                  'placeholder'=>'Password')) !!}
    </div>
</div>

<div class="col-sm-10">
    <label class="checkbox-inline">
        <select name="user[role]">
            <option></option>
            @foreach($roles as $role)
                <option value="{{ $role }}" @if($user->role == $role) selected @endif>{{ $role }}</option>
            @endforeach
        </select>
    </label>
</div>
