<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Articles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('user_id');
            $table->string('user_domain')->default('vivo@lcoalhost');
            $table->string('author')->nullable();
            $table->string('title')->nullable();
            $table->string('image')->nullable();
            $table->string('slider_image')->nullable();
            $table->string('swl_file')->nullable();
            $table->text('body')->nullable();
            $table->dateTime('last_read')->nullable();
            $table->smallInteger('times_read')->default(0);
            $table->smallInteger('today_read')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->string('sefriendly')->nullable();
            $table->string('sef_title')->nullable();
            $table->string('link')->nullable();
            $table->string('source')->nullable();
            $table->string('source_url')->nullable();
            $table->smallInteger('order_num')->nullable();
            $table->enum('show_poll', ['0', '1'])->default(1);
            $table->enum('show_comment', ['0', '1'])->default(1);
            $table->enum('rss_feed', ['0', '1'])->default(1);
            $table->enum('show_author', ['0', '1'])->default(1);
            $table->enum('show_abstract_image', ['0', '1'])->default(1);
            $table->string('media_id',10);
            $table->enum('media_type', ['0','1','2','3','4'])->default(4);
            $table->string('keywords');
            $table->string('description');
            $table->unsignedInteger('emailed')->default(0);
            $table->unsignedInteger('vote_num')->default(0);
            $table->unsignedInteger('vote_sum')->default(0);
            $table->text('abstract')->nullable();
            $table->string('image_caption')->nullable();
            $table->string('video_attachment')->nullable();
            $table->string('feed_item_id',32)->nullable();
            $table->tinyInteger('member_submition')->default(0);
            $table->string('news_keywords')->nullable();
            $table->string('news_publication_name')->nullable();
            $table->string('news_genres')->nullable();
            $table->string('news_stock')->nullable();
            $table->string('news_publication_language')->nullable();
            $table->string('news_access')->nullable();
            $table->string('news_status',1)->default(1);
            $table->tinyInteger('directory_show')->default(0);
            $table->string('directory_bname')->default(0);
            $table->string('directory_cname')->nullable();
            $table->string('directory_email')->nullable();
            $table->string('directory_address')->nullable();
            $table->string('directory_city')->nullable();
            $table->string('directory_state')->nullable();
            $table->string('directory_zip',12)->nullable();
            $table->string('directory_country')->nullable();
            $table->string('directory_tele')->nullable();
            $table->string('directory_website')->nullable();
            $table->string('directory_start')->nullable();
            $table->string('directory_lat')->nullable();
            $table->string('directory_long')->nullable();
            $table->string('directory_map_show')->nullable();
            $table->tinyInteger('directory_fax')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('articles_revisions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('article_id')->default(0);
            $table->unsignedInteger('version')->default(1);
            $table->string('title')->nullable();
            $table->text('body')->nullable();
            $table->text('abstract')->nullable();
            $table->unsignedInteger('creator_id');
            $table->tinyInteger('type')->default(0);
            $table->timestamps();
        });
        Schema::create('articles_stats', function (Blueprint $table) {
            $table->increments('article_id');
            $table->dateTime('last_read')->nullable();    
            $table->unsignedInteger('times_read')->default(0);    
            $table->unsignedInteger('today_read')->default(0);   
            $table->tinyInteger('updated')->default(0);   
            $table->timestamps(); 
        });
        
        Schema::create('articles_tags', function (Blueprint $table) {
            $table->increments('id');   
            $table->unsignedInteger('tag_id');    
            $table->unsignedInteger('article_id');   
            $table->unsignedInteger('tags_group_id')->default(0);   
            $table->unsignedInteger('user_id');   
        });
        
        Schema::create('article_attachments', function (Blueprint $table) {
            $table->increments('id');  
            $table->unsignedInteger('article_id');  
            $table->string('real_path');   
            $table->string('title')->nullable();   
            $table->text('description')->nullable();   
            $table->unsignedInteger('order_number')->nullable();   
        });

        Schema::create('article_images', function (Blueprint $table) {
            $table->increments('id');  
            $table->unsignedInteger('article_id');  
            $table->string('real_path');   
            $table->string('title')->nullable();   
            $table->text('description')->nullable();   
            $table->unsignedInteger('order_number')->nullable();
        });

        Schema::create('articles_schedule', function (Blueprint $table) {
            $table->increments('id');  
            $table->unsignedInteger('article_id');  
            $table->unsignedBigInteger('minute')->default(0);  
            $table->unsignedBigInteger('hour')->default(0);  
            $table->unsignedBigInteger('dom')->default(0);  
            $table->unsignedBigInteger('month')->default(0);  
            $table->unsignedBigInteger('dow')->default(0);  
            $table->smallInteger('year')->nullable();  
            $table->unsignedInteger('duration')->nullable();  
           
        });






    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
        Schema::dropIfExists('articles_revisions');
        Schema::dropIfExists('articles_stats');
        Schema::dropIfExists('articles_tags');
        Schema::dropIfExists('article_attachments');
        Schema::dropIfExists('article_images');
        Schema::dropIfExists('articles_schedule');
    }
}
