<?php
/**
 * Created by PhpStorm.
 * User: patrick
 * Date: 7/2/17
 * Time: 3:34 PM
 */

namespace App\Services;


use App\Models\File;
use App\Repositories\Contracts\InvoiceRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class InvoiceService
{
    protected $invoiceRepository;

    public function __construct(InvoiceRepositoryInterface $invoiceRepository)
    {
        $this->invoiceRepository =$invoiceRepository;

    }

    public function getInvoiceSummary($dossier_id): Collection
    {
        $totalSomInvoices = 0;

        /** @var \App\Models\Invoice[] $invoices */
        $invoices = $this->invoiceRepository->getInvoicesByDossierId($dossier_id);

        $invoiceFiles = [];
        foreach ($invoices as $invoice) {

            $totalSomInvoices += $invoice->amount;
            /** @var File[] $files */
            $files = $invoice->files->all();

            if ($files) {
                foreach ($files as $file) {
                    $invoiceFiles[$invoice->id][] = [
                        'file' => $file,
                        'invoiceid' => $invoice->id,
                        'fileid' => $file->id,
                        'name' => $file->filename_org
                    ];
                }
            }
        }

        return new Collection([
                                  'invoices' => $invoices,
                                  'invoiceFiles' => $invoiceFiles,
                                  'totalSomInvoices' => $totalSomInvoices
                              ]);
    }

}