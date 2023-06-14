<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('category_name');
            $table->tinyInteger('parent_cat')->nullable();
            $table->tinyInteger('order_num')->nullable();
            $table->tinyInteger('article_num')->nullable();
            $table->string('template')->nullable();
            $table->string('css')->nullable();
            $table->tinyInteger('view_subcat')->default('0');
            $table->string('redirect')->nullable();
            $table->string('image')->nullable();
            $table->string('sefriendly')->nullable();
            $table->string('article_template')->nullable();
            $table->string('cat_cust_title')->nullable();
            $table->string('cat_cust_keywords')->nullable();
            $table->string('cat_cust_desc')->nullable();
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
        Schema::dropIfExists('categories');
    }
}
