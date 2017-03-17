<?php

use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Contact::class, 50)->create();
        //->each(function ($u) {
        //    $u->contacts()->save(factory(App\Contact::class)->make());
        //});
    }
}
