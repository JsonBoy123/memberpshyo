<?php

namespace Modules\Admin\Entities\Article;

use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
    protected $guarded = [];

    public function tags(){
    	return $this->hasMany('Modules\Admin\Entities\Article\ArticlesTags','article_id');
    }
    public function category(){
    	return $this->belongsTo('Modules\Category\Entities\Category','category_id');
    }
}
