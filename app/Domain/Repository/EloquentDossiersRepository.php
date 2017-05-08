<?php
/**
 * Created by PhpStorm.
 * User: patrick
 * Date: 5/7/17
 * Time: 5:17 PM
 */

namespace App\Domain\Repository;

use App\Domain\Contract\DossierRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use App\Dossier;

class EloquentDossiersRepository implements DossierRepositoryInterface
{
    public function search(string $term = ""): Collection
    {
        return Dossier::whereHas('client', function ($query) use ($term) {
            $query->where('company', 'like', "%{$term}%");
        })
            ->orWhereHas('debtor', function ($query) use ($term) {
                $query->where('company', 'like', "%{$term}%");
            })
            ->orWhereHas('debtor', function ($query) use ($term) {
                $query->where('company', 'like', "%{$term}%");
            })
            ->orWhereHas('actions', function ($query) use ($term) {
                $query->where('title', 'like', "%{$term}%");
            })
            ->orWhereHas('dossierstatus', function ($query) use ($term) {
                $query->where('description', 'like', "%{$term}%");
            })
            ->orWhere('title', 'like', "%{$term}%")
            ->get();
    }
}