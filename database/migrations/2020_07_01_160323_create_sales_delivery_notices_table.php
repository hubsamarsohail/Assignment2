<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesDeliveryNoticesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_delivery_notices', function (Blueprint $table) {
            $table->id();
            $table->uuid('invoice_id');
            $table->integer('customer_id')->nullable();
            $table->string('customer_account')->nullable();
            $table->integer('invoice_num')->nullable();
            $table->date('invoice_date')->nullable();
            $table->string('truck_num')->nullable();
            $table->integer('warehouse_id')->nullable();
            $table->integer('vat_num')->nullable();
            $table->text('note')->nullable();
            $table->json('items')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('sales_delivery_notices');
    }
}
