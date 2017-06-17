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
                                @if ($type == 'client')
                                    <th>Active</th>
                                    <th>Status</th>
                                @endif
                                <th>Dossiers</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($companies as $companyCollection)
                                <?php
                                $company = $companyCollection->get('company');
                                if ($type == 'client') {
                                    $companyUser = $companyCollection->get('user');
                                }
                                $contact = $company->contacts()->first(); ?>
                                <tr>
                                    <td>
                                        <a href="{{ route($route, ['id' => $company->id])  }}">{{ $company->id }}</a>
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
                                    @if($type == 'client')
                                        <td>
                                            @if($companyUser->active) On @endif
                                        </td>
                                        <td>
                                            {{ $companyUser->status }}
                                        </td>
                                    @endif
                                    <td><a href="{{ route('admin.dossier.list', $company->id) }}">Dossiers
                                            #{{ $company->dossiers()->count() }}</a></td>
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