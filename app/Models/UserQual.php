<?php

namespace Modules\Member\Entities;

use Illuminate\Database\Eloquent\Model;

class UserQual extends Model
{
    protected $table = "user_qual";
    public $timestamps = false;
	protected $guarded = [];
}
