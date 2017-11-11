<?php

use Illuminate\Database\Seeder;

class ListActionsTableSeeder extends Seeder
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
                                             'created_at'  => \Carbon\Carbon::now(),
                                             'updated_at'  => \Carbon\Carbon::now(),
                                         ]);

        DB::table('listactions')->insert([
                                             'description' => 'in behandeling',
                                             'created_at'  => \Carbon\Carbon::now(),
                                             'updated_at'  => \Carbon\Carbon::now(),
                                         ]);

        DB::table('listactions')->insert([
                                             'description' => 'afgewezen',
                                             'created_at'  => \Carbon\Carbon::now(),
                                             'updated_at'  => \Carbon\Carbon::now(),
                                         ]);

        DB::table('listactions')->insert([
                                             'description' => 'geaccepteerd',
                                             'created_at'  => \Carbon\Carbon::now(),
                                             'updated_at'  => \Carbon\Carbon::now(),
                                         ]);

        DB::table('listactions')->insert([
                                             'description' => 'telefonisch contact',
                                             'created_at'  => \Carbon\Carbon::now(),
                                             'updated_at'  => \Carbon\Carbon::now(),
                                         ]);

        DB::table('listactions')->insert([
                                             'description' => 'schriftelijk conact',
                                             'created_at'  => \Carbon\Carbon::now(),
                                             'updated_at'  => \Carbon\Carbon::now(),
                                         ]);

        DB::table('listactions')->insert([
                                             'description' => '1ste aanmaning',
                                             'created_at'  => \Carbon\Carbon::now(),
                                             'updated_at'  => \Carbon\Carbon::now(),
                                         ]);

        DB::table('listactions')->insert([
                                             'description' => '2de aanmaning',
                                             'created_at'  => \Carbon\Carbon::now(),
                                             'updated_at'  => \Carbon\Carbon::now(),
                                         ]);

        DB::table('listactions')->insert([
                                             'description' => 'betaalregeling voorstel',
                                             'created_at'  => \Carbon\Carbon::now(),
                                             'updated_at'  => \Carbon\Carbon::now(),
                                         ]);

        DB::table('listactions')->insert([
                                             'description' => 'overleg met klant',
                                             'created_at'  => \Carbon\Carbon::now(),
                                             'updated_at'  => \Carbon\Carbon::now(),
                                         ]);

        DB::table('listactions')->insert([
                                             'description' => 'betaalregeling acceptatie',
                                             'created_at'  => \Carbon\Carbon::now(),
                                             'updated_at'  => \Carbon\Carbon::now(),
                                         ]);

        DB::table('listactions')->insert([
                                             'description' => 'betaling ontvangen',
                                             'created_at'  => \Carbon\Carbon::now(),
                                             'updated_at'  => \Carbon\Carbon::now(),
                                         ]);

        DB::table('listactions')->insert([
                                             'description' => 'deelbetaling ontvangen',
                                             'created_at'  => \Carbon\Carbon::now(),
                                             'updated_at'  => \Carbon\Carbon::now(),
                                         ]);

        DB::table('listactions')->insert([
                                             'description' => 'deelbetaling uitgekeerd',
                                             'created_at'  => \Carbon\Carbon::now(),
                                             'updated_at'  => \Carbon\Carbon::now(),
                                         ]);

        DB::table('listactions')->insert([
                                             'description' => 'betaling uitgekeerd',
                                             'created_at'  => \Carbon\Carbon::now(),
                                             'updated_at'  => \Carbon\Carbon::now(),
                                         ]);

        DB::table('listactions')->insert([
                                             'description' => 'dossier review',
                                             'created_at'  => \Carbon\Carbon::now(),
                                             'updated_at'  => \Carbon\Carbon::now(),
                                         ]);

        DB::table('listactions')->insert([
                                             'description' => 'dossier afgesloten',
                                             'created_at'  => \Carbon\Carbon::now(),
                                             'updated_at'  => \Carbon\Carbon::now(),
                                         ]);


    }
}
