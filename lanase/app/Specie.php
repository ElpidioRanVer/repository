<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specie extends Model
{
    //
    protected $table = "species";

    protected $fillable = ['taxonomy_id','marine','terrestrial','extinct','hybrid','living_period','age_in_days','size_in_mm','mass_in_gram','name','habitat','freshwater'];

    public function taxonomic_classification() {
    	return $this->belongsTo('App\Taxonomic_Classification', 'taxonomy_id');
    }

}
