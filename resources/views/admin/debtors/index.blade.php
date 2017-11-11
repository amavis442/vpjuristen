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
                                <th>Active</th>
                                <th>Status</th>
                                <th>Dossiers</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($companies as $company)
                                <?php
                                /** @var \Illuminate\Support\Collection $company */
                                $user = $company->users->first();
                                $contact = $company->contacts->first();
                                $dossiers = isset($company->dossiers) ? $company->dossiers :null;
                                ?>
                                <tr>
                                    <td>
                                        <a href="{{ route('admin.debtors.show', $company)  }}">{{ $company->id }}</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.debtors.show', $company)  }}">{{ $company->name }}</a>
                                    </td>
                                    <td>
                                        {{ $company->phone }}
                                    </td>
                                    <td>
                                        {{ $contact->firstname. ' '.$contact->name }}
                                    </td>
                                    <td>
                                        @if($user->isActive()) On @endif
                                    </td>
                                    <td>
                                        {{ $user->status }}
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.dossiers.show', $company->id) }}">Dossiers
                                            #{{ ( !is_null($dossiers)? $dossiers->count() : 0) }}</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.debtors.edit', $company) }}">edit</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">
                                        No clients found
                                    </td>
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