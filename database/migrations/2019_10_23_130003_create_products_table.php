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
            $table->bigIncrements('id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('provider_id');
            $table->string('name');
            $table->integer('quantity');
            $table->double('price');
            $table->boolean('status')->default(false);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('category_id')
                ->references('id')->on('categories')
                ->onDelete('cascade');
            $table->foreign('provider_id')
                ->references('id')->on('providers')
                ->onDelete('cascade');
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
