<ul>
    @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
</ul>

<h1>Client</h1>

{!! Form::open(['route' => 'client-store', 'class' => 'form-horizontal']) !!}

<div class="panel panel-default">
    <div class="panel-heading">
        <h3>Client</h3>
    </div>
    <div class="panel-body">
        @include('company.form')
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3>Contact</h3>
    </div>
    <div class="panel-body">
        @include('contact.form')
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {!! Form::submit('Next!',
      array('class'=>'btn btn-primary')) !!}
    </div>
</div>
{!! Form::close() !!}