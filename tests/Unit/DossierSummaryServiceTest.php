<?php

namespace Tests\Unit;

use App\Models\Dossier;
use App\Services\DossierSummaryService;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DossierSummaryServiceTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $dossier = Dossier::find(1);

        $summaryService = new DossierSummaryService($dossier);


        $this->assertTrue(true);
    }


}
