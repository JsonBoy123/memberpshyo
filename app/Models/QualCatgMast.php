<?php

namespace Modules\Member\Entities;

use Illuminate\Database\Eloquent\Model;

class QualCatgMast extends Model
{
    protected $table = 'qual_catg_mast';
    public $timestamps = false;
    protected $primaryKey = 'qual_catg_code';
    protected $guarded = [];
}
