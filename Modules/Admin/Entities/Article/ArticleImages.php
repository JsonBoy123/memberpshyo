<?php

namespace Modules\Admin\Entities\Article;

use Illuminate\Database\Eloquent\Model;

class ArticleImages extends Model
{
    protected $table = 'article_images';
    protected $guarded = [];
    public $timestamps = false;
}
