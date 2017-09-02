@extends((( auth()->user()->hasRole('admin')) ? 'adminlte::page' : 'layouts.app' ))
@section('content')

    <form action="{{ route('invoice.update', $invoice) }}" method="post" enctype="multipart/form-data" class="form">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
    @include('invoice.partials.form')
    </form>

@endsection