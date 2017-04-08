<?php
/**
 * Created by PhpStorm.
 * User: patrick
 * Date: 4/8/17
 * Time: 1:19 AM
 */

namespace App\Http\Controllers;

use App\Invoice;
use Illuminate\Http\Request;

trait InvoiceAjaxTrait
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

}