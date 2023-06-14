<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Member\Entities\Member;

class Invoice extends Model
{
    protected $table = 'invc_mast';
    protected $primaryKey = 'invc_numb';
    protected $guarded = [];



    public function member(){
      return $this->belongsTo('Modules\Member\Entities\Member','user_id','user_id');
    }
}
