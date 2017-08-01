<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Literature extends Model
{
    //
    protected $table = "literatures";

    protected $fillable = ['citation_id','type','remarks'];

    public function citation() {
    	return $this->belongsTo('App\Citation');
    }

    public function specimens() {
    	return $this->hasMany('App\Specimen');
    }
}
