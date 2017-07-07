<?php
/**
 * Created by PhpStorm.
 * User: patrick
 * Date: 5/7/17
 * Time: 5:03 PM
 */

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface ActionRepositoryInterface
{
    /**
     * @param int $id
     * @return Collection
     */
    public function getActionsByDossierId($id): Collection;
}