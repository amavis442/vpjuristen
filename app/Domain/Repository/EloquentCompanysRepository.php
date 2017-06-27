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
            $companiesData = Company::with(['dossiers','users','contacts'])->whereHas('dossiers',function($query) {
                $query->where('type' ,'=','client');
            })->get();

            foreach ($companiesData as $company) {
                $companyCollection = new Collection();

                /** @var Collection $dossiers */
                $dossiers = $company->dossiers;
                /** @var Collection $contacts */
                $contacts = $company->contacts;
                /** @var Collection $user */
                $users = $company->users;
                $companyCollection->put('company', $company);
                $companyCollection->put('users', $users);
                $companyCollection->put('contacts',$contacts);
                $companyCollection->put('dossiers',$dossiers);


                $companies->add($companyCollection);
            }
        }



        if ($type == 'debtor') {
            $companiesData = Company::with(['dossiers','users','contacts'])->whereHas('dossiers',function($query) {
                $query->where('type' ,'=','debtor');
            })->get();


            foreach ($companiesData as $company) {
                $companyCollection = new Collection();

                /** @var Collection $dossiers */
                $dossiers = $company->dossiers;
                /** @var Collection $contacts */
                $contacts = $company->contacts;
                /** @var Collection $user */
                $users = $company->users;
                $companyCollection->put('company', $company);
                $companyCollection->put('users', $users);
                $companyCollection->put('contacts',$contacts);
                $companyCollection->put('dossiers',$dossiers);


                $companies->add($companyCollection);
            }

        }

        return $companies;
    }


}