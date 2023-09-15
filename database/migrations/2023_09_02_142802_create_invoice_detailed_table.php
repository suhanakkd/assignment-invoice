<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_detailed', function (Blueprint $table) {
            $table->id();
            $table->integer('master_id');
            $table->string('product_name');
            $table->integer('quantity')->default(0);
            $table->decimal('amount',8,2)->default(0);
            $table->decimal('total_amount',8,2)->default(0);
            $table->integer('tax_percentage')->default(0);
            $table->decimal('tax_amount',8,2)->default(0);
            $table->decimal('net_amount',8,2)->default(0);
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
        Schema::dropIfExists('invoice_detailed');
    }
};
