@extends('adminlte::page')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Clients</div>
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Company name</th>
                                <th>Phone</th>
                                <th>Contact</th>
                                <th>Dossiers</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($companies as $company)
                                <?php $contact = $company->contacts()->first(); ?>
                                <tr>
                                    <td>
                                        <a href="{{ route($routeEdit, ['id' => $company->id])  }}">{{ $company->id }}</a>
                                    </td>
                                    <td>
                                        {{ $company->name }}
                                    </td>
                                    <td>
                                        {{ $company->phone }}
                                    </td>
                                    <td>
                                        {{ $contact->firstname. ' '.$contact->name }}
                                    </td>
                                    <td><a href="{{ route('admin.dossier.list', $company->id) }}">Dossiers #{{ $company->dossiers()->count() }}</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection