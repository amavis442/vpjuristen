<?php
/**
 * Created by PhpStorm.
 * User: patrick
 * Date: 7/2/17
 * Time: 3:34 PM
 */

namespace App\Services;


use App\Models\Company;
use App\Repositories\Contracts\CompanyRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class CompanyService
{
    protected $companyRepository;

    public function __construct(CompanyRepositoryInterface $companyRepository)
    {
        $this->companyRepository =$companyRepository;

    }
}