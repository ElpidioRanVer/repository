<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    //
    protected $table = "images";

    protected $fillable = ['specimen_id','name'];

    public function image_metadata(){
    	return $this->hasOne('App\Image_Metadata');
    }

    public function specimen(){
    	return $this->belongsTo('App\Specimen');
    }
}
