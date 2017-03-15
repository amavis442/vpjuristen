<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',255);
            $table->string('company',255);
            $table->string('street',255);
            $table->string('housenr',20);
            $table->string('postcode',20);
            $table->string('place',255);
            $table->string('country',30);
            $table->string('phone',30);
            $table->string('email',255);
            $table->string('website',255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
