<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('actions',function(Blueprint $table){
            $table->string('title')->after('id');
            $table->string('listactions_id')->after('id')->default(1);
            $table->string('status')->after('listactions_id')->default('pending');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('actions',function(Blueprint $table){
            $table->dropColumn('title');
            $table->dropColumn('listactions_id');
            $table->dropColumn('status');

        });
    }
}
