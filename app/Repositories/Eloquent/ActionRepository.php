<?php

namespace App\Repositories\Eloquent;

use App\Models\Action;
use App\Repositories\Contracts\ActionRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ActionRepository implements ActionRepositoryInterface
{
    /**
     * @param $id
     * @return Collection
     */
    public function getActionsByDossierId($id): Collection
    {
        /** @var \App\Models\Action[] $actions */
        $actions = Action::with(['dossiers', 'comments','listaction','collection','payment'])->whereHas('dossiers', function ($query) use ($id) {
            $query->where('dossier_id', $id);
        })->get();

        return $actions;
    }

}