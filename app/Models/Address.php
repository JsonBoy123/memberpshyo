<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'user_address';
    protected $guarded = []; 
    public $timestamps = false;


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
