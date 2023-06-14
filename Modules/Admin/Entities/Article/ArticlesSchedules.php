<?php

namespace Modules\Admin\Entities\Article;

use Illuminate\Database\Eloquent\Model;

class ArticlesSchedules extends Model
{
    protected $table = 'articles_schedule';
    protected $guarded = [];
    public $timestamps = false;
}
