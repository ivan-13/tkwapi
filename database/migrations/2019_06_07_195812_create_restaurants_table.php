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
            $table->string('branch', 100)->nullable()->default(null);
            $table->string('phone', 20);
            $table->string('email', 100);
            $table->char('logo', 100);
            $table->char('address', 100);
            $table->string('housenumber', 12);
            $table->string('postcode', 12);
            $table->string('city', 60);
            $table->string('latitude', 12);
            $table->string('longitude', 12);
            $table->string('url', 60);
            $table->integer('open');
            $table->integer('bestMatch')->nullable()->default(NULL);
            $table->integer('newestScore')->nullable()->default(null);
            $table->integer('ratingAverage')->nullable()->default(null);
            $table->integer('popularity')->nullable()->default(null);
            $table->string('averageProductPrice', 12)->nullable()->default(null);
            $table->string('deliveryCosts', 12)->nullable()->default(null);
            $table->string('minimumOrderAmount', 12)->nullable()->default(null);
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
