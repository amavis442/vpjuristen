<?php
namespace App\Domain\Services\Dossier;

use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Company;
use App\Invoice;
use App\User;
use App\Dossier;
use App\File as InvoiceFile;

/**
 * Created by PhpStorm.
 * User: patrick
 * Date: 4/16/17
 * Time: 10:57 PM
 */
class DossierService
{
    use ValidatesRequests;

    protected $client_id;
    protected $debtor_id;
    protected $dossier_id;
    protected $dossier_status_id;

    /**
     * @return mixed
     */
    public function getClientId()
    {
        return $this->client_id;
    }

    /**
     * @param mixed $client_id
     */
    public function setClientId($client_id)
    {
        $this->client_id = $client_id;
    }

    /**
     * @return mixed
     */
    public function getDebtorId()
    {
        return $this->debtor_id;
    }

    /**
     * @param mixed $debtor_id
     */
    public function setDebtorId($debtor_id)
    {
        $this->debtor_id = $debtor_id;
    }

    /**
     * @return mixed
     */
    public function getDossierId()
    {
        return $this->dossier_id;
    }

    /**
     * @param mixed $dossier_id
     */
    public function setDossierId($dossier_id)
    {
        $this->dossier_id = $dossier_id;
    }

    /**
     * @return mixed
     */
    public function getDossierStatusId()
    {
        return $this->dossier_status_id;
    }

    /**
     * @param mixed $dossier_status_id
     */
    public function setDossierStatusId($dossier_status_id)
    {
        $this->dossier_status_id = $dossier_status_id;
    }


    /**
     * Create a new dossier and invoices. Create relationship between dossier and company of
     * client and company of debtor
     *
     * @param Request $request
     */
    public function create(Request $request)
    {
        $currentTimestamp = date('Y-m-d H:i:s');
        $dossier = $request->get('dossier');

        /** @var Company $company */
        $company = Company::findOrFail($this->client_id);

        $data['client_id'] = $this->client_id;
        $data['debtor_id'] = $this->debtor_id;
        $data['title'] = $dossier['title'];
        $data['dossierstatus_id'] = 1;
        $data['created_at'] = $currentTimestamp;
        $data['updated_at'] = $currentTimestamp;
        /** @var Dossier $dossier */
        $dossier = $company->dossiers()->withTimestamps()->create($data);

        $this->validate($request, [
            'doc' => 'file|mimes:pdf,doc,docx,jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $invoices = $request->get('invoice');
        $numInvoices = count($invoices);
        for ($i = 0; $i < $numInvoices; $i++) {
            $invoice['title'] = $invoices[$i]['title'];
            $invoice['dossier_id'] = $dossier->id;
            $invoice['amount'] = $invoices[$i]['amount'];
            $invoice['due_date'] = $invoices[$i]['due_date'];

            $invoice['remarks'] = $invoices[$i]['remarks'];
            /** @var Invoice $invoice */
            $invoice = Invoice::create($invoice);

            $doc = $request->file('invoice_' . $i . '_file');
            if (!is_null($doc)) {
                $filename = $doc->store('invoices');
                $filename_org = $doc->getClientOriginalName();
                $invoice->files()->withTimestamps()->create(['filename' => $filename, 'filename_org' => $filename_org]);
            }
        }

        return $dossier;
    }

    public function update(Request $request)
    {
        $dossierData = $request->get('dossier');
        $dossier = Dossier::findOrFail($dossierData['id']);
        unset($dossierData['id']);
        $dossier->update($dossierData);

        $invoices = $request->get('invoice');
        foreach ($invoices as $index => $invoiceData) {
            $invoiceData['dossier_id'] = $dossier->id;
            $invoice = Invoice::updateOrCreate($invoiceData);

            $doc = $request->file('invoice_' . $index . '_file');
            if (!is_null($doc)) {

                $filename = $doc->store('invoices');
                $filename_org = $doc->getClientOriginalName();

                /** @var InvoiceFile $invoiceFile */
                $invoiceFile = InvoiceFile::updateOrCreate(['filename' => $filename, 'filename_org' => $filename_org]);
                $invoiceFile->invoices()->attach($invoice->id)->withTimestamps();
            }

        }
    }
}