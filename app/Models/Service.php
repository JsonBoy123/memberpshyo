<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $guarded = [];

    public function member(){
    	return $this->belongsTo('App\Role','member_type');
    }
}
