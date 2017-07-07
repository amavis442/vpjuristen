<?php
namespace App\Repositories\Providers;

use \Illuminate\Support\ServiceProvider;
use \App\Repositories\Contracts\InvoiceRepositoryInterface;
use \App\Repositories\Eloquent\InvoiceRepository;

class InvoiceRepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            InvoiceRepositoryInterface::class,
             InvoiceRepository::class

        );
    }

}