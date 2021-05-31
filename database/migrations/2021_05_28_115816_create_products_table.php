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
            $table->string('sku');
            $table->string('name');
            $table->string('slug');
            $table->decimal('price',15,2);
            $table->decimal('weight',10,2);
            $table->decimal('width',10,2);
            $table->decimal('height',10,2);
            $table->decimal('depth',10,2);
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('admin_id');
            $table->text('text_description');
            $table->text('description');
            $table->integer('status');
            $table->foreign('category_id')->on('categories')->references('id')->onDelete('cascade');
            $table->foreign('admin_id')->on('admins')->references('id');
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
        Schema::dropIfExists('products');
    }
}
