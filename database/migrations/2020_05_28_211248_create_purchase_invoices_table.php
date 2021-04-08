<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Query\Expression;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_invoices', function (Blueprint $table) {
            $table->id();
            $table->uuid('invoice_id');
            $table->integer('supplier_id')->nullable();
            $table->string('supplier_account')->nullable();
            $table->integer('invoice_num')->nullable();
            // $table->date('invoice_date')->default(now());
            $table->date('invoice_date')->nullable();
            $table->string('truck_num')->nullable();
            $table->integer('warehouse_id')->nullable();
            $table->integer('vat_num')->nullable();
            $table->text('note')->nullable();
            $table->json('items')->nullable();
            $table->float('total')->nullable();
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
        Schema::dropIfExists('purchase_invoices');
    }
}
