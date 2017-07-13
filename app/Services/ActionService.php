<?php
namespace App\Services;

use App\Repositories\Contracts\ActionRepositoryInterface;
use Illuminate\Support\Collection;
use App\Models\Listaction;

class ActionService
{
    protected $actionRepository;

    public function __construct(ActionRepositoryInterface $actionRepository)
    {
        $this->actionRepository = $actionRepository;

    }

    public function getActionSummary($dossier_id): Collection
    {
        $receivedSom = 0;
        $paidSom = 0;
        $amount = [];

        $actionMetaCollection = new Collection();

        /** @var \App\Models\Action[] $actions */
        $actions = $this->actionRepository->getActionsByDossierId($dossier_id);

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

            $collect = $action->collection->get()->first();
            if ($collect) {
                $actionItemMetaCollection->put('amount', $collect->amount);
                //$action->amount = $collect->amount;
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
                $paidSom += $action->collection->get()->first()->amount;
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
}