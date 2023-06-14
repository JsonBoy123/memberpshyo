<?php

namespace Modules\Category\Entities;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Category extends Model implements HasMedia
{
    use HasMediaTrait;
   	 
    // protected $table = 'categories1';
    protected $guarded = [];


    public function subcategory(){
    	return $this->hasMany('Modules\Category\Entities\Category','parent_cat')->orderBy('order_num','ASC');
    }
    public function parentcategory(){
    	return $this->belongsTo('Modules\Category\Entities\Category','parent_cat','id')->orderBy('order_num','ASC');
    }
    public function articles(){
    	return $this->hasMany('Modules\Admin\Entities\Article\Articles','category_id')->orderBy('order_num','ASC')->limit(1);
    }
}
