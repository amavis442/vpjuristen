@extends('adminlte::page')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ ucfirst($type) }}</div>
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
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($companies as $company)
                                <?php
                                /** @var \Illuminate\Support\Collection $company */

                                //if ($type == 'client') {
                                    $companyUsers = $company->users;
                                    $companyUser = $companyUsers->first();
                                //}
                                $contact = $company->contacts->first();
                                $dossiers = $company->dossiers;
                                ?>
                                <tr>
                                    <td>
                                        <a href="{{ route($route, $company)  }}">{{ $company->id }}</a>
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
                                            {{ $companyUser->active }}
                                        </td>
                                    @endif
                                    <td>
                                        <a href="{{ route('admin.dossiers.show', $company->id) }}">Dossiers
                                            #{{ $dossiers->count() }}</a>
                                    </td>
                                    <td>
                                        @canImpersonate
                                        <a href="{{ route('impersonate', $companyUser->id) }}">Impersonate this user</a>
                                        @endCanImpersonate
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="@if($type == 'client') 7 @else 5 @endif">
                                        No clients found
                                    </td>
                                </tr>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection