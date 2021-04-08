<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVechilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vechiles', function (Blueprint $table) {
            $table->id();
            $table->uuid('vechile_id');
            $table->string('name')->nullable();
            $table->string('brand')->nullable();
            $table->string('plate_number')->nullable();
            $table->float('capacity')->nullable();
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
        Schema::dropIfExists('vechiles');
    }
}
