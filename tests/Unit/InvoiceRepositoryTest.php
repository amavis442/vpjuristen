<?php

namespace Tests\Unit;

use App\Repositories\Eloquent\InvoiceRepository;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class InvoiceRepositoryTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $invoiceRepository = new InvoiceRepository();

        $invoices = $invoiceRepository->getInvoicesByDossierId(1);
        foreach ($invoices as $invoice) {
            $this->assertInstanceOf('App\Models\File',$invoice->files->first());
        }
    }
}
