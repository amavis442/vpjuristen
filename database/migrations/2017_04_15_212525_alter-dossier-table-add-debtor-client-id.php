<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterDossierTableAddDebtorClientId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dossiers', function(Blueprint $table){
            $table->integer('debtor_id')->unsigned()->after('title');
            $table->integer('client_id')->unsigned()->after('debtor_id');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dossiers', function(Blueprint $table){
            $table->dropColumn('debtor_id');
            $table->dropColumn('client_id');
        });
    }
}
