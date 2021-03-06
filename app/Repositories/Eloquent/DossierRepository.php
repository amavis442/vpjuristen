<?php
/**
 * Created by PhpStorm.
 * User: patrick
 * Date: 5/7/17
 * Time: 5:17 PM
 */

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\DossierRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Dossier;

class DossierRepository implements DossierRepositoryInterface
{

    public function search(string $term = ""): Collection
    {
        return Dossier::with('companies', 'actions', 'dossierstatus')
                      ->whereHas('companies', function ($query) use ($term) {
                          $query->where('company', 'like', "%{$term}%")->orWhere('name','like', "%{$term}%");
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