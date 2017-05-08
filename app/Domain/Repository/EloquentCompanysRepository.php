<?php
/**
 * Created by PhpStorm.
 * User: patrick
 * Date: 5/7/17
 * Time: 5:13 PM
 */

namespace App\Domain\Repository;
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

}