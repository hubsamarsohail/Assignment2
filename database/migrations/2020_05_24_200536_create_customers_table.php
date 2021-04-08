<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('customer_name_english')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('account_number')->nullable();
            $table->integer('credit_facilities')->nullable();
            // $table->integer('credit_facilities')->default(30);
            $table->integer('vat_number')->nullable();
            $table->enum('blacklist', ['true', 'false'])->default('false');
            $table->string('customer_name_arabic')->nullable();
            $table->string('contact_number')->nullable();
            // $table->timestamp('join_date')->default(now());
            $table->timestamp('join_date')->nullable();
            $table->text('detailed_address')->nullable();
            $table->float('credit_limit')->nullable();
            $table->integer('discount_category')->nullable(0);
            $table->unsignedInteger('sales_man')->nullable();
            $table->string('profile_pics')->nullable();
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
        Schema::dropIfExists('customers');
    }
}
