<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestaurantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100);
            $table->string('branch', 100)->nullable();
            $table->string('phone', 20);
            $table->string('email', 100);
            $table->char('logo', 100);
            $table->char('address', 100);
            $table->string('housenumber', 6);
            $table->string('postcode', 12);
            $table->string('city', 12);
            $table->float('latitude', 11, 7);
            $table->float('longitude', 11, 7);
            $table->string('url', 60);
            $table->integer('open');
            $table->integer('bestMatch')->nullable();
            $table->integer('newestScore')->nullable();
            $table->integer('ratingAverage')->nullable();
            $table->integer('popularity')->nullable();
            $table->float('averageProductPrice', 6, 2)->nullable();
            $table->float('deliveryCosts', 5, 2)->nullable();
            $table->float('minimumOrderAmount', 5, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restaurants');
    }
}
