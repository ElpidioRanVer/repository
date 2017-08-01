<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Distribution extends Model
{
    //
    protected $table = "distributions";

    protected $fillable = ['specimen_id','latitude','longitude','altitude','site','date','country','region','locality','sub_locality'];

    public function specimen() {
    	return $this->belongsTo('App\Specimen');
    }

}
