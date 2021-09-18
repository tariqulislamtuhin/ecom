<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billing_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('billing_name');
            $table->string('billing_email');
            $table->string('billing_phone_number');
            $table->string('country');
            $table->string('city');
            $table->string('district')->nullable();
            $table->string('thana')->nullable();
            $table->string('billing_address');
            $table->string('billing_postcode')->nullable();
            $table->string('order_note')->nullable();
            $table->string('payment_method')->comment("Two payment Method Integrated.");
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
        Schema::dropIfExists('billing_details');
    }
}
