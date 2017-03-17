<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('province_id');
            $table->integer('city_id');
            $table->string('name');
            $table->string('slug');
            $table->string('tagline');
            $table->string('email');
            $table->text('address');
            $table->string('photo')->nullable();
            $table->string('banner')->nullable();
            $table->integer('start_day')->nullable();
            $table->integer('end_day')->nullable();
            $table->time('start_hour')->nullable();
            $table->time('end_hour')->nullable();
            $table->text('note')->nullable();
            $table->tinyInteger('featured')->default(0);
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
        Schema::dropIfExists('shops');
    }
}
