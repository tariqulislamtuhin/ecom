<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtrributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atrributes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id');
            $table->foreignId('color_id');
            $table->foreignId('size_id');
            $table->string('quantity');
            $table->string('regular_price');
            $table->string('sale_price');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('atrributes');
    }
}
