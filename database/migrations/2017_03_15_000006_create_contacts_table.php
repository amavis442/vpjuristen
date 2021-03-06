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
            $table->string('name');
            $table->string('firstname');
            $table->string('middlename')->nullable();
            $table->char('sexe',1);
            $table->char('title')->nullable();
            $table->string('street')->nullable();
            $table->string('housenumber')->nullable();
            $table->string('postalcode')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('phone');
            $table->string('email');
            $table->string('fax')->nullable();
            $table->text('remarks')->nullable();
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
