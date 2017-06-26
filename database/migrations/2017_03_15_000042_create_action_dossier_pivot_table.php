<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActionDossierPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('action_dossier', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('action_id')->unsigned();
            $table->foreign('action_id')->references('id')->on('actions');
            $table->integer('dossier_id')->unsigned();
            $table->foreign('dossier_id')->references('id')->on('dossiers');
            $table->enum('public',['client','debtor','all'])->default('all');
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
        Schema::dropIfExists('action_dossier');
    }
}
