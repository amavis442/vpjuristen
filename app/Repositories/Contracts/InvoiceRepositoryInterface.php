<?php
/**
 * Created by PhpStorm.
 * User: patrick
 * Date: 5/7/17
 * Time: 5:03 PM
 */

namespace App\Repositories\Contracts;
use App\Models\Invoice;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

interface InvoiceRepositoryInterface
{
    /**
     * @param int $id
     * @return Collection
     */
    public function getInvoicesByDossierId($id): Collection;
}