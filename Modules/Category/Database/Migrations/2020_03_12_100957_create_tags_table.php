<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',50);
            $table->string('sefriendly')->nullable();
            $table->timestamps();
        });

        Schema::create('tags_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('url');
            $table->string('template',100)->nullable();
            $table->string('tag_template',100)->nullable();
            $table->text('metadata')->nullable();
            $table->timestamps();
        });
        Schema::create('tags_to_groups', function (Blueprint $table) {
            $table->unsignedInteger('tags_group_id');
            $table->unsignedInteger('tag_id');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tags');
        Schema::dropIfExists('tags_groups');
        Schema::dropIfExists('tags_to_groups');
    }
}
