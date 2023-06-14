<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Locations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->increments('country_code',4);
            $table->string('country_name',80);
            $table->string('iso2',2)->nullable();
            $table->string('iso3',3)->nullable();
            $table->string('phone_code',10)->nullable();
            $table->string('nationality',25)->nullable();
            $table->string('currency_code',6)->nullable();
            $table->string('currency_name',25)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('states', function (Blueprint $table) {
            $table->increments('state_code',4);
            $table->string('state_name',45);
            $table->tinyInteger('country_code')->unsigned();            
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('cities', function (Blueprint $table) {
            $table->increments('city_code',7);
            $table->string('city_name',45);
            $table->tinyInteger('country_code')->unsigned();
            $table->tinyInteger('state_code')->unsigned(); 
            $table->float('latitude', 5, 2)->nullable();
            $table->float('longitude', 5, 2)->nullable(); 
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
        Schema::dropIfExists('countries');
        Schema::dropIfExists('states');
        Schema::dropIfExists('cities');
    }
}
