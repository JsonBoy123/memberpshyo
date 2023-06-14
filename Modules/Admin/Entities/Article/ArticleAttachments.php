<?php

namespace Modules\Admin\Entities\Article;

use Illuminate\Database\Eloquent\Model;

class ArticleAttachments extends Model
{
    protected $table = 'article_attachments';
    protected $guarded = [];
    public $timestamps = false;
}
