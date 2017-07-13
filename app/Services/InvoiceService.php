<?php

namespace App\Services;

use App\Models\Invoice;
use App\Models\File as InvoiceFile;
use App\Repositories\Contracts\InvoiceRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class InvoiceService
{
    protected $invoiceRepository;

    public function __construct(InvoiceRepositoryInterface $invoiceRepository)
    {
        $this->invoiceRepository = $invoiceRepository;

    }


    public function getInvoiceSummary(Collection $invoices): Collection
    {
        $totalSomInvoices = 0;

        /** @var \App\Models\Invoice[] $invoices */
        $invoiceFiles = [];
        foreach ($invoices as $invoice) {

            $totalSomInvoices += $invoice->amount;
            /** @var InvoiceFile[] $files */
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