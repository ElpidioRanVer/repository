<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image_Metadata extends Model
{
    //
    protected $table = "image_metadatas";

    protected $fillable = ['image_id','resolution_units','width','heigth','latitude','longitude','device_name','date','size','compress_scheme','is_color'];

    public function image(){
    	return $this->belongsTo('App\Image');
    }
}
