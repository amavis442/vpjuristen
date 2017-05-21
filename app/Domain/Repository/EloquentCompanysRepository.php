<?php
/**
 * Created by PhpStorm.
 * User: patrick
 * Date: 5/7/17
 * Time: 5:13 PM
 */

namespace App\Domain\Repository;

use App\Dossier;
use App\Role;
use App\User;
use App\Domain\Contract\CompanyRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use App\Company;

class EloquentCompanysRepository implements CompanyRepositoryInterface
{
    public function search(string $query = ""): Collection
    {
        return Company::where('company', 'like', "%{$query}%")
            ->orWhere('name', 'like', "%{$query}%")
            ->get();
    }

    public function getCompany($type = 'client')
    {
        $companies = new Collection();

        if ($type == 'client') {
            $dossiers = Dossier::with('client')->get();
            foreach ($dossiers as $dossier) {
                $companies->add($dossier->client()->get()->first());
            }
        }

        if ($type == 'debtor') {
            $dossiers = Dossier::with('debtor')->get();
            foreach ($dossiers as $dossier) {
                $companies->add($dossier->debtor()->get()->first());
            }
        }

        /* if ($type == 'debtor') {
            $roles = Role::with(['users'])->whereIn('name', ['debtor'])->get();
            foreach ($roles as $role) {
                $user = $role->users()->get()->first();
                if ($user) {
                    $company = $user->companies()->first();
                    $companies->add($company);
                }
            }
        }

        if ($type == 'client' || $type == 'prospect') {
            $roles = Role::with(['users'])->whereIn('name', ['client', 'prospect'])->get();
            foreach ($roles as $role) {
                $user = $role->users()->get()->first();
                if ($user) {
                    $company = $user->companies()->first();
                    $companies->add($company);
                }
            }
        } */

        return $companies;
    }


}