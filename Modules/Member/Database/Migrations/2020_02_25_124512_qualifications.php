<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Qualifications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qual_catg_mast', function (Blueprint $table) {
            $table->tinyInteger('qual_catg_code');
            $table->string('qual_catg_desc',50)->nullable();
            $table->string('shrt_desc',50)->nullable();

        });

        Schema::create('qual_mast', function (Blueprint $table) {
            $table->tinyInteger('qual_code');
            $table->tinyInteger('qual_catg_code')->nullable();
            $table->string('qual_catg_desc',50)->nullable();
            $table->string('qual_desc',100)->nullable();
            $table->string('shrt_desc',5)->nullable();

        });      

        Schema::create('user_qual', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->tinyInteger('qual_catg_code')->nullable();
            $table->string('qual_catg_desc',50)->nullable();
            $table->tinyInteger('qual_code')->nullable();
            $table->string('qual_desc',3)->nullable();
            $table->tinyInteger('pass_year')->nullable();
            $table->decimal('pass_perc',4,2)->nullable();
            $table->smallInteger('pass_division')->nullable();
        });
        Schema::create('member_qual', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->tinyInteger('qual_catg_code')->nullable();
            $table->string('qual_catg_desc',50)->nullable();
            $table->string('location')->nullable();
            $table->string('board',100)->nullable();
            $table->decimal('pass_marks',4,2)->nullable();
            $table->tinyInteger('pass_year')->nullable();
            $table->string('pass_division',1)->nullable();
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
        Schema::dropIfExists('qual_catg_mast');
        Schema::dropIfExists('qual_mast');
        Schema::dropIfExists('user_qual');
    }
}
