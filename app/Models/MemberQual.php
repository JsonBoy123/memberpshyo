<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class MemberQual extends Model //implements HasMedia
{
	use HasMediaTrait;

    protected $guarded = [];
	// public function registerMediaCollections()
	// {
	// $this->addMediaCollection('files')
	// 	// ->useDisk('do_filestack')
	// ->singleFile();
	// }
	// public function file()
	// {
	 //return $this->media();
	// }
	public function file(){
		return $this->belongsTo('App\Models\Documents','id','model_id')->where('model_type','MemberQual');
	}
}
