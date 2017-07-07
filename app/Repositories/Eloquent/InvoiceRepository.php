<?php

namespace App\Repositories\Eloquent;

use App\Models\Invoice;
use App\Repositories\Contracts\InvoiceRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class InvoiceRepository implements InvoiceRepositoryInterface
{
    /**
     * @param $id
     * @return Collection
     */
    public function getInvoicesByDossierId($id): Collection
    {
        /** @var \App\Models\Invoice[] $invoices */
        $invoices = Invoice::with('files', 'dossier')->where('dossier_id', $id)->get();

        return $invoices;
    }


}