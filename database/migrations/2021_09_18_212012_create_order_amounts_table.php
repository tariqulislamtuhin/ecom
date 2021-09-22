<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderAmountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_amounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('billing_detail_id');
            $table->string('coupon')->nullable();
            $table->integer('subtotal');
            $table->integer('discount');
            $table->integer('shipping');
            $table->integer('total');
            $table->integer('payment_status')->default(2)->comment('1 = Paid, 2 = Unpaid');
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
        Schema::dropIfExists('order_amounts');
    }
}
