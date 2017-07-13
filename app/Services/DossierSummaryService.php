<?php

namespace App\Services;


use App\Models\Dossier;
use App\Models\File as InvoiceFile;
use App\Models\Action;
use App\Models\Comment;
use App\Models\Company;
use App\Models\Dossierstatus;
use App\Models\Listaction;
use Illuminate\Support\Collection;


class DossierSummaryService
{
    protected $dossier;

    /**
     * DossierSummaryService constructor.
     * @param Dossier $dossier
     */
    public function __construct(Dossier $dossier)
    {
        $this->dossier = $dossier;
    }

    /**
     * @return Collection
     */
    public function getInvoiceSummary(): Collection
    {
        $invoices = $this->dossier->invoices();
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

    /**
     * @return Collection
     */
    public function getActionSummary(): Collection
    {
        $receivedSom = 0;
        $paidSom = 0;
        $amount = [];

        $actionMetaCollection = new Collection();

        /** @var \App\Models\Action[] $actions */
        $actions = $this->dossier->actions()->with(['listaction','comments','collection','payment'])->get();

        foreach ($actions as $action) {
            $actionItemMetaCollection = new Collection();
            $actionStatus = $action->listaction->first()->description;
            $actionItemMetaCollection->put('actionStatus', $actionStatus);

            $comment = $action->comments->last();
            if ($comment) {
                $commentTxt = $comment->comment;
                $actionItemMetaCollection->put('comment', $commentTxt);
            }

            $public = $action->pivot->public;
            $collect = !is_null($action->collection) ? $action->collection->get()->first() : null;

            if ($collect) {
                $actionItemMetaCollection->put('amount', $collect->amount);
            } else {
                $actionItemMetaCollection->put('amount', '-');
                $amount[$action->id] = '-';
            }
            $actionItemMetaCollection->put('public', $public);

            /** @var Listaction $listactionItem */
            $listactionItem = $action->listaction->get()->first();
            if ($listactionItem->description == 'betaling ontvangen' || $listactionItem->description == 'deelbetaling ontvangen') {
                $receivedSom += $action->collection->get()->first()->amount;
            }

            if ($listactionItem->description == 'betaling uitgekeerd' || $listactionItem->description == 'deelbetaling uitgekeerd') {
                $paidSom += $action->payment->get()->first()->amount;
            }

            $actionMetaCollection->put($action->id, $actionItemMetaCollection);
            unset($actionItemMetaCollection);
        }

        $t1 = Listaction::whereIn('description', ['betaling ontvangen', 'deelbetaling ontvangen'])->get();
        foreach ($t1 as $listItem) {
            $ids[] = $listItem->id;
        }
        $recentCollectionDate = $actions->whereIn('listaction_id', $ids)->max('created_at');

        unset($ids);
        $t1 = Listaction::whereIn('description', ['betaling uitgekeerd'])->get();
        foreach ($t1 as $listItem) {
            $ids[] = $listItem->id;
        }
        $recentPaymentDate = $actions->whereIn('listaction_id', $ids)->max('created_at');

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
     * @return Company
     */
    public function getClient(): Company
    {
        return $this->dossier->companies()->wherePivot('type', '=', 'client')->with('contacts')->get()->first();
    }

    /**
     * @return Company
     */
    public function getDebtor(): Company
    {
        return $this->dossier->companies()->wherePivot('type', '=', 'debtor')->with('contacts')->get()->first();
    }

    /**
     * @return Collection
     */
    public function getSummary(): Collection
    {
        /** @var \App\Models\Dossierstatus $dossierStatus */
        $dossierStatus = $this->dossier->dossierstatus()->first();

        $clientData = $this->getClient();
        $debtorData = $this->getDebtor();


        /** @var Collection $invoiceSummary */
        $invoiceSummaryCollection = $this->getInvoiceSummary();
        $remaining                = $totalSomInvoices = $invoiceSummaryCollection->get('totalSomInvoices');

        /** @var \App\Models\Company $client */
        $client = $clientData->first();

        /** @var \App|Models\Contact $clientContact */
        $clientContact = $client->contacts->first();

        /** @var \App\Models\Company $debtor */
        $debtor = $debtorData->first();
        /** @var \App|Contact $debtorContact */
        $debtorContact = $debtor->contacts->first();

        /** @var \App\Models\Comment[] $comments */
        $comments = $this->dossier->comments()->get();
        /** @var Collection $actionCollection */
        $actionCollection = $this->getActionSummary();
        $receivedSom      = $actionCollection->get('receivedSom', 0);

        $remaining -= $receivedSom;

        return new Collection([
            'dossier' => $this->dossier,
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
}