<?php
namespace App\Repositories\Providers;

use \Illuminate\Support\ServiceProvider;
use \App\Repositories\Contracts\CompanyRepositoryInterface;
use \App\Repositories\Eloquent\CompanyRepository;

class CompanyRepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            CompanyRepositoryInterface::class,
             CompanyRepository::class

        );
    }

}