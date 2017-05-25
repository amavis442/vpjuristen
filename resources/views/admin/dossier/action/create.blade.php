@extends('adminlte::page')

@section('content')
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="{{ back()->getTargetUrl() }}">Home</a></li>

        </ol>
    </div>

    <div class="container">
        {!! Form::open(['route' => 'admin.dossier.action.store', 'class' => 'form-horizontal']) !!}
        <input type="hidden" name="did" value="{{ $dossier_id }}" id="did"/>
        <div class="panel panel-default">
            <div class="panel-heading">
                Action
            </div>
            <div class="panel-body">

                <div class="form-group">
                    <label for="title" class="col-sm-2 control-label">Title</label>
                    <div class="col-sm-10">
                        <input type="text" name="title" id="title" class="form-control "/>
                    </div>
                </div>

                <div class="form-group">
                    <label for="title" class="col-sm-2 control-label">Action</label>
                    <div class="col-sm-10">
                        <select name="listactions_id" id="listactions_id" class="form-control">
                            @foreach ($listActions as $item)
                                <option value="{{ $item->id }}">{{ $item->description }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="title" class="col-sm-2 control-label">Comment</label>
                    <div class="col-sm-10">
                        <textarea name="comment" id="comment" class="form-control"></textarea>
                    </div>
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
    </div>
@endsection