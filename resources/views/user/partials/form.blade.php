<input type="hidden" name="user[id]" value="{{ $user->id }}"/>

<div class="form-group">
    {!! Form::label('Username',null, ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-4">
        {!! Form::text('user[name]', $user->name, [
        'class' => 'form-control',
        'placeholder' => 'Username'])
        !!}
    </div>

    {!! Form::label('Email',null, ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-4">
        {!! Form::text('user[email]', $user->email,
        ['class'=>'form-control',
        'placeholder'=>'Email'])
        !!}
    </div>
</div>


<div class="form-group">
    {!! Form::label('Active','Active', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-4">
        <label class="radio-inline">
            {!! Form::radio('user[active]', '1', ($user->active ? true:false), [
            'id' => 'user_active_yes'
            ]) !!} Yes
        </label>

        <label class="radio-inline">
            {!! Form::radio('user[active]', '0',($user->active == false ? true:false), [
            'id' => 'user_active_false'
            ]) !!} No
        </label>
    </div>
</div>