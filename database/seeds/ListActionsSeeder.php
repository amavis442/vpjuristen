<?php

use Illuminate\Database\Seeder;

class ListActionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('listactions')->insert([
            'description' => 'nieuw',
        ]);

        DB::table('listactions')->insert([
            'description' => 'in behandeling',
        ]);

        DB::table('listactions')->insert([
            'description' => 'afgewezen',
        ]);

        DB::table('listactions')->insert([
            'description' => 'geaccepteerd',
        ]);

        DB::table('listactions')->insert([
            'description' => 'telefonisch contact',
        ]);

        DB::table('listactions')->insert([
            'description' => 'schriftelijk conact',
        ]);

        DB::table('listactions')->insert([
            'description' => '1ste aanmaning',
        ]);

        DB::table('listactions')->insert([
            'description' => '2de aanmaning',
        ]);

        DB::table('listactions')->insert([
            'description' => 'betaalregeling voorstel',
        ]);

        DB::table('listactions')->insert([
            'description' => 'overleg met klant',
        ]);

        DB::table('listactions')->insert([
            'description' => 'betaalregeling acceptatie',
        ]);

        DB::table('listactions')->insert([
            'description' => 'betaling ontvangen',
        ]);

        DB::table('listactions')->insert([
            'description' => 'deelbetaling ontvangen',
        ]);

        DB::table('listactions')->insert([
            'description' => 'deelbetaling uitgekeerd',
        ]);

        DB::table('listactions')->insert([
            'description' => 'betaling uitgekeerd',
        ]);

        DB::table('listactions')->insert([
            'description' => 'dossier review',
        ]);

        DB::table('listactions')->insert([
            'description' => 'dossier afgesloten',
        ]);





    }
}
