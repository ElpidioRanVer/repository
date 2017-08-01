<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ncbi_Record extends Model
{
    //
    protected $table = "ncbi_records";

    protected $fillable = ['taxonomy_id','record_name','direct_links','subtree_links'];

    public function taxonomic_classification() {
    	return $this->belongsTo('App\Taxonomic_Classification', 'taxonomy_id');
    }
}
