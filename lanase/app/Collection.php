<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    //
    protected $table = "collections";

    protected $fillable = ['country', 'region', 'locality', 'sample_type'];

    public function specimens() {
    	return $this->hasMany('App\Specimen');
    }
}
