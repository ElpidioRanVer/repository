<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vernacular_Name extends Model
{
    protected $table = "vernacular_name";

    protected $fillable = ['taxonomy_id','name','language','preferred','sex','life_stage','area','country','plural'];


    public function taxonomic_classification() {
    	return $this->belongsTo('App\Taxonomic_Classification', 'taxonomy_id');
    }

}
