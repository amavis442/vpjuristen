<?php
/**
 * Created by PhpStorm.
 * User: patrick
 * Date: 6/30/17
 * Time: 12:40 AM
 */

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\Services\Dossier\DossierService;

class DossierServiceServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('dossierService', function($app)
        {
            return new DossierService(
                $app->make('App\Domain\Repositories\Contracts\DossierRepositoryInterface')
            );
        });
    }
}