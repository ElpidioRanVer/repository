<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Synonym extends Model
{
    //
    protected $table = "synonyms";

    protected $fillable = ['taxonomy_id','synonym'];

    public function taxonomic_classification() {
    	return $this->belongsTo('App\Taxonomic_Classification', 'taxonomy_id');
    }
}
