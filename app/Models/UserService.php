<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserService extends Model
{
    protected $table = 'user_services';
    protected $guarded = [];

    public function member(){
    	return $this->belongsTo('Modules\Member\Entities\Member','user_id','user_id');
    }
    public function service(){
    	return $this->belongsTo('App\Models\Service','service_id');
    } 
}
