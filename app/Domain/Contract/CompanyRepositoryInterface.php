<?php
/**
 * Created by PhpStorm.
 * User: patrick
 * Date: 5/7/17
 * Time: 5:03 PM
 */

namespace App\Domain\Contract;
use Illuminate\Database\Eloquent\Collection;

interface CompanyRepositoryInterface
{
    public function search(string $query = ""): Collection;
}