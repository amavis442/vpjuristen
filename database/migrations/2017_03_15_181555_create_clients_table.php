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
         Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',255);
            $table->string('company',255)->nullable();
            $table->string('kvk',255)->nullable();
            $table->string('street',255);
            $table->string('housenr',20);
            $table->string('postcode',20);
            $table->string('city',255);
            $table->string('country',255)->nullable();
            $table->string('phone',30);
            $table->string('email',255);
            $table->string('website',255)->nullable();
            $table->string('iban',255)->nullable();
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
