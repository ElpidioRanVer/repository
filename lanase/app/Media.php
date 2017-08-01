<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    //
    protected $table = "medias";

    protected $fillable = ['citation_id','type','format','identifier','references','title','description','audience','created','creator','contributor','publisher','license','rights_holder'];

    public function citation() {
    	return $this->belongsTo('App\Citation');
    }

    public function specimens() {
    	return $this->hasMany('App\Specimen');
    }

}
