<?php

namespace App\Domain\Services\Dossier;

use App\File;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use App\Company;
use App\Invoice;
use App\User;
use App\Dossier;
use App\Listaction;
use App\Role;
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

    public function getDossier($id)
    {
        /** @var Dossier $dossier */
        $dossier = Dossier::findOrFail($id);
        return $dossier;
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
        //$dossier = $company->dossiers()->withTimestamps()->create($data);
        $dossier = Dossier::create($data);

        $dossier->companies()->attach($this->client_id);
        $dossier->companies()->attach($this->debtor_id);


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


    /**
     * @param Dossier $dossier
     * @return Collection
     */
    public function getInvoiceSummary(Dossier $dossier): Collection
    {
        $totalSomInvoices = 0;
        /** @var \App\Invoice[] $invoices */
        $invoices = $dossier->invoices()->get();
        $invoiceFiles = [];
        foreach ($invoices as $invoice) {

            $totalSomInvoices += $invoice->amount;
            /** @var File[] $files */
            $files = $invoice->files()->get()->all();

            if ($files) {
                foreach ($files as $file) {
                    $url = route('admin.dossier.invoice.view', ['id' => $invoice->id, 'fileid' => $file->id]);
                    $invoiceFiles[$invoice->id][] = ['url' => $url, 'name' => $file->filename_org];
                }
            }
        }

        return new Collection([
            'invoices' => $invoices,
            'invoiceFiles' => $invoiceFiles,
            'totalSomInvoices' => $totalSomInvoices
        ]);
    }

    /**
     * @param Dossier $dossier
     * @param int $clientRoleId
     * @param int $debtorRoleId
     * @return Collection
     */
    public function getActionSummary(Dossier $dossier, int $clientRoleId, int $debtorRoleId): Collection
    {
        $receivedSom = 0;
        $paidSom = 0;
        $amount = [];

        $actionMetaCollection = new Collection();
        /** @var \App\Action[] $actions */
        $actions = $dossier->actions()->get();

        foreach ($actions as $action) {
            $actionItemMetaCollection = new Collection();
            $actionStatus = $action->listaction()->first()->description;
            $actionItemMetaCollection->put('actionStatus', $actionStatus);

            $commentObj = $action->comments()->first();
            if ($commentObj) {
                $comment = $action->comments()->first()->comment;
                $actionItemMetaCollection->put('comment', $comment);
            }

            $actionRoles = $action->roles();

            $clientCanSee = !is_null($actionRoles->get(['role_id'])
                ->where('role_id', '=', $clientRoleId)->first()) ? true : false;

            $debtorCanSee = !is_null($actionRoles->get(['role_id'])
                ->where('role_id', '=', $debtorRoleId)->first()) ? true : false;

            $collect = $action->collection()->get()->first();
            if ($collect) {
                $actionItemMetaCollection->put('amount', $collect->amount);
                //$action->amount = $collect->amount;
            } else {
                $actionItemMetaCollection->put('amount', '-');
                $amount[$action->id] = '-';
            }
            $actionItemMetaCollection->put('clientCanSee', $clientCanSee);
            $action->clientCanSee = $clientCanSee;
            $actionItemMetaCollection->put('debtorCanSee', $debtorCanSee);
            $action->debtorCanSee = $debtorCanSee;

            /** @var Listaction $listactionItem */
            $listactionItem = $action->listaction()->get()->first();
            if ($listactionItem->description == 'betaling ontvangen' || $listactionItem->description == 'deelbetaling ontvangen') {
                $receivedSom += $action->collection()->get()->first()->amount;
                //$date = $action->collection()->get()->max('created_at');

            }

            if ($listactionItem->description == 'betaling uitgekeerd' || $listactionItem->description == 'deelbetaling uitgekeerd') {
                $paidSom += $action->collection()->get()->first()->amount;
            }

            $actionMetaCollection->put($action->id, $actionItemMetaCollection);
            unset($actionItemMetaCollection);
        }

        $t1 = Listaction::whereIn('description', ['betaling ontvangen','deelbetaling ontvangen'])->get();
        foreach ($t1 as $listItem){
            $ids[] = $listItem->id;
        }
        $recentCollectionDate = $actions->whereIn('listaction_id',  $ids)->max('created_at');

        unset($ids);
        $t1 = Listaction::whereIn('description', ['betaling uitgekeerd'])->get();
        foreach ($t1 as $listItem){
            $ids[] = $listItem->id;
        }
        $recentPaymentDate = $actions->whereIn('listaction_id',  $ids)->max('created_at');

        return new Collection([
            'actions' => $actions,
            'meta' => $actionMetaCollection,
            'receivedSom' => $receivedSom,
            'paidSom' => $paidSom,
            'recentCollectionDate' => $recentCollectionDate,
            'recentPaymentDate' => $recentPaymentDate,
        ]);
    }

    /**
     * @param int $id
     * @return Collection
     */
    public function getSummary(int $id): Collection
    {
        $receivedSom = 0;
        $paidSom = 0;

        $this->setDossierId($id);
        /** @var Dossier $dossier */
        $dossier = $this->getDossier($id);
        /** @var \App\Dossierstatus $dossierStatus */
        $dossierStatus = $dossier->dossierstatus()->first();

        /** @var Collection $invoiceSummary */
        $invoiceSummaryCollection = $this->getInvoiceSummary($dossier);
        $remaining = $totalSomInvoices = $invoiceSummaryCollection->get('totalSomInvoices');

        /** @var \App\Company $client */
        $client = $dossier->client()->first();
        /** @var \App|Contact $clientContact */
        $clientContact = $client->contacts()->first();

        /** @var \App\Company $debtor */
        $debtor = $dossier->debtor()->first();
        /** @var \App|Contact $debtorContact */
        $debtorContact = $debtor->contacts()->first();

        $clientRoleId = Role::where('name', '=', 'client')->first()->id;
        $debtorRoleId = Role::where('name', '=', 'debtor')->first()->id;

        /** @var \App\Comment[] $comments */
        $comments = $dossier->comments()->get();
        /** @var Collection $actionCollection */
        $actionCollection = $this->getActionSummary($dossier, $clientRoleId, $debtorRoleId);
        $receivedSom = $actionCollection->get('receivedSom', 0);

        $remaining -= $receivedSom;

        return new Collection([
            'dossier' => $dossier,
            'dossierStatus' => $dossierStatus,
            'invoiceCollection' => $invoiceSummaryCollection,
            'client' => $client,
            'clientContact' => $clientContact,
            'debtor' => $debtor,
            'debtorContact' => $debtorContact,
            'comments' => $comments,
            'actionCollection' => $actionCollection,
            'totalSom' => $totalSomInvoices,
            'receivedSom' => $receivedSom,
            'remainingSom' => $remaining
        ]);
    }


    /**
     * @param $id
     * @param $fileid
     * @param Request $request
     * @return Collection
     */
    public function downloadInvoice($id, $fileid, Request $request): Collection
    {
        /** @var Invoice $invoice */
        $invoice = Invoice::findOrFail($id);
        if ($invoice) {
            $user = $invoice->dossier()->first()->companies()->first()->users()->first();
            if ($user->id == Auth::user()->id || Auth::user()->hasRole('admin') || Auth::user()->hasRole('employee')) {
                // Start the download procedure
                /** @var File $file */
                $file = $invoice->files()->get()->first();
                return new Collection(['result' => 200, 'msg' => storage_path('app/' . $file->filename)]);
            }
        }
        return new Collection(['result' => 404, 'msg' => 'The computer says no']);
    }
}