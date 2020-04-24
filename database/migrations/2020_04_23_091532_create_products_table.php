<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->text('content')->nullable();
            $table->integer('origin_price');
            $table->integer('sale_price');
            $table->integer('user_id');
            $table->integer('category_id');
            $table->integer('status')->default(1);
            $table->integer('quantity');
            $table->integer('sold')->default(0);
            $table->string('slug');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
