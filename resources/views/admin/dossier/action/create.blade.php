@extends('adminlte::page')

@section('content')
    <div class="container">
        {!! Form::open(['route' => 'admin.dossier.action.store', 'class' => 'form-horizontal']) !!}
        <input type="hidden" name="did" value="{{ $dossier_id }}" id="did"/>
        <div class="panel panel-default">
            <div class="panel-heading">
                Action
            </div>
            <div class="panel-body">
                <input type="text" name="title" id="title" class="form-control"/>

                <select name="listactions_id" id="listactions_id">
                    @foreach ($listActions as $item)
                        <option value="{{ $item->id }}">{{ $item->description }}</option>
                    @endforeach
                </select>

                <textarea name="comment" id="comment" class="form-control"></textarea>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                {!! Form::submit('Save!',
              array('class'=>'btn btn-primary')) !!}
            </div>
        </div>
        {!! Form::close() !!}

    </div>
@endsection