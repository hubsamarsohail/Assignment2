<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSubtotalToSalesItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sales_items', function (Blueprint $table) {
            $table->decimal('sub_total',50,2)->default(0.0);
        });

        Schema::table('purchase_items', function (Blueprint $table) {
            $table->decimal('sub_total',50,2)->default(0.0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('sales_items', function (Blueprint $table) {
            //
            $table->drop('sub_total');
        });

        Schema::table('purchase_items', function (Blueprint $table) {
            //
            $table->drop('sub_total');
        });
        
    }
}
