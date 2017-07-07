<?php

namespace App\Services;

use App\Repositories\Eloquent\ActionRepository;
use App\Repositories\Eloquent\InvoiceRepository;
use Illuminate\Support\Collection;
use App\Models\Dossier;


class DossierService
{

    public function getInvoiceSummary($dossier_id): Collection
    {
        $invoiceService = new InvoiceService(new InvoiceRepository());
        $data = $invoiceService->getInvoiceSummary($dossier_id);

        return $data;
    }

    public function getActionSummary($dossier_id): Collection
    {
        $actionService = new ActionService(new ActionRepository());

        /** @var Collection $data */
        $data = $actionService->getActionSummary($dossier_id);

        return $data;
    }

    /**
     * @param int $id
     * @return Collection
     */
    public function getSummary(int $id): Collection
    {
        $dossier = Dossier::findOrFail($id);

        /** @var \App\Models\Dossierstatus $dossierStatus */
        $dossierStatus = $dossier->dossierstatus()->first();

        $clientData = $dossier->companies()->wherePivot('type', '=', 'client')->with('contacts')->get();
        $debtorData = $dossier->companies()->wherePivot('type', '=', 'debtor')->with('contacts')->get();


        /** @var Collection $invoiceSummary */
        $invoiceSummaryCollection = $this->getInvoiceSummary($dossier);
        $remaining = $totalSomInvoices = $invoiceSummaryCollection->get('totalSomInvoices');

        /** @var \App\Models\Company $client */
        $client = $clientData->first();
        /** @var \App|Models\Contact $clientContact */
        $clientContact = $client->contacts->first();

        /** @var \App\Models\Company $debtor */
        $debtor = $debtorData->first();
        /** @var \App|Contact $debtorContact */
        $debtorContact = $debtor->contacts->first();

        /** @var \App\Models\Comment[] $comments */
        $comments = $dossier->comments()->get();
        /** @var Collection $actionCollection */
        $actionCollection = $this->getActionSummary($dossier);
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

}