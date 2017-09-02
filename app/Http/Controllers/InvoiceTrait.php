<?php
/**
 * Created by PhpStorm.
 * User: patrick
 * Date: 4/8/17
 * Time: 1:19 AM
 */

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

trait InvoiceTrait
{
    /**
     * Add a new invoice html view only if the number of current invoices < 5
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function ajaxAdd(Request $request)
    {
        $numInvoices = session('numInvoices', 0);
        if ($numInvoices < 5) {
            $invoice = new Invoice();
            session(['numInvoices' => ++$numInvoices]);
            return view('common.invoice.form', ['add' => true, 'index' => $numInvoices, 'invoice' => $invoice]);
        }
        return '';
    }

    public function ajaxDelete(Request $request)
    {
        $numInvoices = session('numInvoices', 0);
        session(['numInvoices' => --$numInvoices]);
    }

    /**
     * @param \App\Models\Invoice      $invoice
     * @param int                      $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download(Invoice $invoice, $id, Request $request)
    {
        $this->authorize('download', $invoice);

        /** @var \Illuminate\Support\Collection $files */
        $files = $invoice->getMedia('invoices')->keyBy('id');
        $file = $files[$id];
        $pathToFile = $file->getPath();

        return response()->download($pathToFile);
    }
}