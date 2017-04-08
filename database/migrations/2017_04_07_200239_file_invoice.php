<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FileInvoice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_invoice', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('file_id')->unsigned();
            $table->integer('invoice_id')->unsigned();
            $table->timestamps();


        });

        Schema::table('file_invoice', function (Blueprint $table) {
            $table->foreign('file_id')->references('id')->on('files')->onDelete('cascade');
            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('file_invoice', function (Blueprint $table) {
            $table->dropForeign('file_invoice_file_id_foreign');
            $table->dropForeign('file_invoice_invoice_id_foreign');
        });

        Schema::dropIfExists('file_invoice');
    }
}
