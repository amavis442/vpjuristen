<?php
/**
 * Created by PhpStorm.
 * User: patrick
 * Date: 5/7/17
 * Time: 5:17 PM
 */
namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface DossierRepositoryInterface
{
    public function search(string $query = ""): Collection;
    //public function store(Company $company, Request $request);
}