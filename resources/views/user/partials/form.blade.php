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

<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
    <label for="password" class="col-sm-2 control-label">Password</label>

    <div class="col-sm-4">
        <input id="password" type="password" class="form-control" name="user[password]" @if(isset($passwordrequired)) required @endif>

        @if ($errors->has('password'))
            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
        @endif
    </div>

    <label for="password-confirm" class="col-sm-2 control-label">Confirm Password</label>

    <div class="col-sm-4">
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" @if(isset($passwordrequired)) required @endif>
    </div>
</div>


<div class="form-group">
    {!! Form::label('Active','Active', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-4">
        <select name="user[status]">
            <option></option>
            @forelse($statuses as $status)
                <option value="{{ $status }}" @if($user->status == $status) selected @endif>{{ $status }}</option>
            @empty
                <option>No statuses available at the moment</option>
            @endforelse
        </select>
    </div>
</div>

@push('js')
    @if(!isset($passwordrequired))
    <script type="text/javascript">
        $(document).ready(function () {
            $('#password').on('blur',function(){
                if ($('#password').length >0 && $('#password').val() != '') {
                    if (!$('#password-confirm').attr('required')) {
                        $('#password-confirm').attr('required', 'required');
                    }
                } else {
                    if ($('#password-confirm').attr('required')) {
                        $('#password-confirm').removeAttr('required');
                    }
                }
            });
        });

    </script>
    @endif
@endpush
