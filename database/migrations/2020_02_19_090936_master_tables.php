<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MasterTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('global_tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',30)->unique();
            $table->string('tag',50)->nullable();
            $table->string('meta')->nullable();
            $table->unsignedTinyInteger('indent');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('specializations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('shrt_desc',10)->nullable();
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
        Schema::dropIfExists('global_tags');
        Schema::dropIfExists('specializations');
    }
}
