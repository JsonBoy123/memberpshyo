<?php

namespace Modules\Admin\Entities\Article;

use Illuminate\Database\Eloquent\Model;

class ArticlesTags extends Model
{
    protected $table = 'articles_tags';
    protected $guarded = [];
    public $timestamps = false;
}
