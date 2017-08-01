<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Taxonomic_Classification extends Model
{
    //
    protected $table = "taxonomic_classifications";

    protected $fillable = ['id','scientific_name', 'canonic_name','infra_generic','infra_epiteto_specific','rank_marker','modified','specific_epithet','superkingdom','kingdom','phylum','subphylum','superclass','class','subclass','infraclass','superorder','order','suborder','infraorder','parvorder','superfamily','family','subfamily','tribe','genus','subgenus','specie','subspecie'];

    public function vernacular_names(){
        return $this->hasMany('App\Vernacular_Name', 'taxonomy_id');
    }

    public function external_links(){
    	return $this->hasMany('App\External_Link', 'taxonomy_id');
    }

    public function ncbi_records(){
    	return $this->hasMany('App\Ncbi_Record', 'taxonomy_id');
    }

    public function synonyms(){
    	return $this->hasMany('App\Synonym', 'taxonomy_id');
    }

    public function specimens(){
    	return $this->hasMany('App\Specimen', 'taxonomy_id');
    }

    public function species(){
        return $this->hasMany('App\Specie', 'taxonomy_id');
    }

    //Rhaegar
    public function scopeSearch($query, $name){
        return $query->where('scientific_name', 'ILIKE', "%$name%");
    }

    //endRhaegar
}
