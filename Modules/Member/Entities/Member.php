<?php

namespace Modules\Member\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\City;
use App\Models\State;

class Member extends Model
{
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function college(){
    	return $this->belongsTo('App\Models\CollegeMast','college_code');
    }
    public function applied_services(){
    	return $this->hasMany('App\Models\UserService','user_id','user_id');
    }
    public function cities(){
        return $this->belongsTo('App\Models\City','p_city','city_code');
    }
    public function states(){
        return $this->belongsTo('App\Models\State','p_state','state_code');
    }
    public function ccities(){
        return $this->belongsTo('App\Models\City','c_city','city_code');
    }
    public function cstates(){
        return $this->belongsTo('App\Models\State','c_state','state_code');
    }
}
