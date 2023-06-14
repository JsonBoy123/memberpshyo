<?php

namespace Modules\Category\Entities;

use Illuminate\Database\Eloquent\Model;

class TagsToGroups extends Model
{
    protected $table = 'tags_to_groups';
    protected $guarded = [];

    public function tags(){
    	return $this->hasMany('Modules\Category\Entities\Tags','tag_id');
    }
}
