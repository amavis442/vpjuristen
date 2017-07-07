<?php
/**
 * Created by PhpStorm.
 * User: patrick
 * Date: 5/7/17
 * Time: 5:03 PM
 */

namespace App\Repositories\Contracts;

use App\Models\Company;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

interface CompanyRepositoryInterface
{
    public function getCompany($type = 'client'): Collection;
    public function search(string $query = ""): Collection;
    public function store(Company $company, Request $request);
}