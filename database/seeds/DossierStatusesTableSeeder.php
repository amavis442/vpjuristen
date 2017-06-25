<?php

use Illuminate\Database\Seeder;
use App\Dossierstatus;

class DossierStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Dossierstatus::create(['description' => 'Fase 1: aanmaning']);
        Dossierstatus::create(['description' => 'Fase 2: rechtszaak']);

    }
}
