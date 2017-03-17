<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->integer('shop_id');
            $table->integer('category_id');
            $table->integer('subcategory_id');
            $table->string('name');
            $table->string('slug');
            $table->string('author');
            $table->decimal('price', 10, 2);
            $table->string('condition');
            $table->integer('weight');
            $table->text('synopsis');
            $table->text('notes');
            $table->integer('featured');
            $table->integer('status');
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
        Schema::dropIfExists('products');
    }
}
