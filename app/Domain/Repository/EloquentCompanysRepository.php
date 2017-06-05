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
                $companyCollection = new Collection();

                $company = $dossier->client()->get()->first();
                $user = $company->users()->get()->first();

                $companyCollection->put('company', $company);
                $companyCollection->put('user', $user);

                $companies->add($companyCollection);
            }
        }

        if ($type == 'debtor') {
            $dossiers = Dossier::with('debtor')->get();
            foreach ($dossiers as $dossier) {
                $companyCollection = new Collection();
                $company = $dossier->debtor()->get()->first();
                $user = new User();

                $companyCollection->put('company', $company);
                $companyCollection->put('user', $user);
                $companies->add($companyCollection);
            }
        }

        return $companies;
    }


}