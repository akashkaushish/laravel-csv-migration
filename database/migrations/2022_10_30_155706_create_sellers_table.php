<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sellers', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->integer('seller_id')->default(0);
            $table->string('seller_firstname')->nullable();
            $table->string('seller_lastname')->nullable();
            $table->date('date_joined')->nullable();
            $table->string('country')->nullable();
            $table->string('contact_region')->nullable();
            $table->date('contact_date')->nullable();
            $table->string('contact_customer_fullname')->nullable();
            $table->string('contact_type')->nullable();
            $table->integer('contact_product_type_offered_id')->nullable();
            $table->string('contact_product_type_offered')->nullable();
            $table->float('sale_net_amount')->nullable();
            $table->float('sale_gross_amount')->nullable();
            $table->float('sale_tax_rate')->nullable();
            $table->float('sale_product_total_cost')->nullable();

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
        Schema::dropIfExists('sellers');
    }
}
