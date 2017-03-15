<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->unsigned();
            $table->string('name');
            $table->string('surname');
            $table->string('middlename');
            $table->char('sexe',1);
            $table->char('title');
            $table->string('street');
            $table->string('housenr');
            $table->string('place');
            $table->string('zipcode');
            $table->string('country');
            $table->string('phone');
            $table->string('email');
            $table->string('fax');
            $table->string('remarks');
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
        Schema::dropIfExists('contacts');
    }
}
