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

    ##################################################################Rhaegar

    public function scopeSearchadv($query, $sname, $specie, $family, $genus, $superkingdom, $kingdom){
        if($sname && $specie && $family && $genus && $superkingdom && $kingdom){
            return $query->where('scientific_name', 'ILIKE', "%$sname%")
                         ->where('specie', 'ILIKE', "%$specie%")
                         ->where('family', 'ILIKE', "%$family%")
                         ->where('genus', 'ILIKE', "%$genus%")
                         ->where('superkingdom', 'ILIKE', "%$superkingdom%")
                         ->where('kingdom', 'ILIKE', "%$kingdom%");
        }
        if($sname && $specie && $family && $genus && $superkingdom){
            return $query->where('scientific_name', 'ILIKE', "%$sname%")
                         ->where('specie', 'ILIKE', "%$specie%")
                         ->where('family', 'ILIKE', "%$family%")
                         ->where('genus', 'ILIKE', "%$genus%")
                         ->where('superkingdom', 'ILIKE', "%$superkingdom%");
        }
        if($sname && $specie && $family && $genus && $kingdom){
            return $query->where('scientific_name', 'ILIKE', "%$sname%")
                         ->where('specie', 'ILIKE', "%$specie%")
                         ->where('family', 'ILIKE', "%$family%")
                         ->where('genus', 'ILIKE', "%$genus%")
                         ->where('kingdom', 'ILIKE', "%$kingdom%");
        }
        if($sname && $specie && $family && $genus){
            return $query->where('scientific_name', 'ILIKE', "%$sname%")
                         ->where('specie', 'ILIKE', "%$specie%")
                         ->where('family', 'ILIKE', "%$family%")
                         ->where('genus', 'ILIKE', "%$genus%");
        }
        if($sname && $specie && $family && $superkingdom && $kingdom){
            return $query->where('scientific_name', 'ILIKE', "%$sname%")
                         ->where('specie', 'ILIKE', "%$specie%")
                         ->where('family', 'ILIKE', "%$family%")
                         ->where('superkingdom', 'ILIKE', "%$superkingdom%")
                         ->where('kingdom', 'ILIKE', "%$kingdom%");
        }
        if($sname && $specie && $family && $superkingdom){
            return $query->where('scientific_name', 'ILIKE', "%$sname%")
                         ->where('specie', 'ILIKE', "%$specie%")
                         ->where('family', 'ILIKE', "%$family%")
                         ->where('superkingdom', 'ILIKE', "%$superkingdom%");
        }
        if($sname && $specie && $family && $kingdom){
            return $query->where('scientific_name', 'ILIKE', "%$sname%")
                         ->where('specie', 'ILIKE', "%$specie%")
                         ->where('family', 'ILIKE', "%$family%")
                         ->where('kingdom', 'ILIKE', "%$kingdom%");
        }
        if($sname && $specie && $family){
            return $query->where('scientific_name', 'ILIKE', "%$sname%")
                         ->where('specie', 'ILIKE', "%$specie%")
                         ->where('family', 'ILIKE', "%$family%");
        }
        if($sname && $specie && $genus && $superkingdom && $kingdom){
            return $query->where('scientific_name', 'ILIKE', "%$sname%")
                         ->where('specie', 'ILIKE', "%$specie%")
                         ->where('genus', 'ILIKE', "%$genus%")
                         ->where('superkingdom', 'ILIKE', "%$superkingdom%")
                         ->where('kingdom', 'ILIKE', "%$kingdom%");
        }
        if($sname && $specie && $genus && $superkingdom){
            return $query->where('scientific_name', 'ILIKE', "%$sname%")
                         ->where('specie', 'ILIKE', "%$specie%")
                         ->where('genus', 'ILIKE', "%$genus%")
                         ->where('superkingdom', 'ILIKE', "%$superkingdom%");
        }
        if($sname && $specie && $genus  && $kingdom){
            return $query->where('scientific_name', 'ILIKE', "%$sname%")
                         ->where('specie', 'ILIKE', "%$specie%")
                         ->where('genus', 'ILIKE', "%$genus%")
                         ->where('kingdom', 'ILIKE', "%$kingdom%");
        }
        if($sname && $specie && $genus){
            return $query->where('scientific_name', 'ILIKE', "%$sname%")
                         ->where('specie', 'ILIKE', "%$specie%")
                         ->where('genus', 'ILIKE', "%$genus%");
        }
        if($sname && $specie && $superkingdom && $kingdom){
            return $query->where('scientific_name', 'ILIKE', "%$sname%")
                         ->where('specie', 'ILIKE', "%$specie%")
                         ->where('superkingdom', 'ILIKE', "%$superkingdom%")
                         ->where('kingdom', 'ILIKE', "%$kingdom%");
        }
        if($sname && $specie && $superkingdom){
            return $query->where('scientific_name', 'ILIKE', "%$sname%")
                         ->where('specie', 'ILIKE', "%$specie%")                                
                         ->where('superkingdom', 'ILIKE', "%$superkingdom%");
        }
        if($sname && $specie && $kingdom){
            return $query->where('scientific_name', 'ILIKE', "%$sname%")
                         ->where('specie', 'ILIKE', "%$specie%")
                         ->where('kingdom', 'ILIKE', "%$kingdom%");
        }
        if($sname && $specie){
            return $query->where('scientific_name', 'ILIKE', "%$sname%")
                         ->where('specie', 'ILIKE', "%$specie%");
        }
        if($sname && $family && $genus && $superkingdom && $kingdom){
            return $query->where('scientific_name', 'ILIKE', "%$sname%")
                         ->where('family', 'ILIKE', "%$family%")
                         ->where('genus', 'ILIKE', "%$genus%")
                         ->where('superkingdom', 'ILIKE', "%$superkingdom%")
                         ->where('kingdom', 'ILIKE', "%$kingdom%");
        }
        if($sname && $family && $genus && $superkingdom){
            return $query->where('scientific_name', 'ILIKE', "%$sname%")
                         ->where('family', 'ILIKE', "%$family%")
                         ->where('genus', 'ILIKE', "%$genus%")
                         ->where('superkingdom', 'ILIKE', "%$superkingdom%");
        }
        if($sname && $family && $genus && $kingdom){
            return $query->where('scientific_name', 'ILIKE', "%$sname%")
                         ->where('family', 'ILIKE', "%$family%")
                         ->where('genus', 'ILIKE', "%$genus%")
                         ->where('kingdom', 'ILIKE', "%$kingdom%");
        }
        if($sname && $family && $genus){
            return $query->where('scientific_name', 'ILIKE', "%$sname%")
                         ->where('family', 'ILIKE', "%$family%")
                         ->where('genus', 'ILIKE', "%$genus%");
        }
        if($sname && $family && $superkingdom && $kingdom){
            return $query->where('scientific_name', 'ILIKE', "%$sname%")
                         ->where('family', 'ILIKE', "%$family%")
                         ->where('superkingdom', 'ILIKE', "%$superkingdom%")
                         ->where('kingdom', 'ILIKE', "%$kingdom%");
        }
        if($sname && $family && $superkingdom){
            return $query->where('scientific_name', 'ILIKE', "%$sname%")
                         ->where('family', 'ILIKE', "%$family%")
                         ->where('superkingdom', 'ILIKE', "%$superkingdom%");
        }
        if($sname && $family && $kingdom){
            return $query->where('scientific_name', 'ILIKE', "%$sname%")
                         ->where('family', 'ILIKE', "%$family%")
                         ->where('kingdom', 'ILIKE', "%$kingdom%");
        }
        if($sname && $family){
            return $query->where('scientific_name', 'ILIKE', "%$sname%")
                         ->where('family', 'ILIKE', "%$family%");
        }
        if($sname && $genus && $superkingdom && $kingdom){
            return $query->where('scientific_name', 'ILIKE', "%$sname%")
                         ->where('specie', 'ILIKE', "%$specie%")
                         ->where('family', 'ILIKE', "%$family%")
                         ->where('genus', 'ILIKE', "%$genus%")
                         ->where('superkingdom', 'ILIKE', "%$superkingdom%")
                         ->where('kingdom', 'ILIKE', "%$kingdom%");
        }
        if($sname && $genus && $superkingdom){
            return $query->where('scientific_name', 'ILIKE', "%$sname%")
                         ->where('genus', 'ILIKE', "%$genus%")
                         ->where('superkingdom', 'ILIKE', "%$superkingdom%");
        }
        if($sname && $genus && $kingdom){
            return $query->where('scientific_name', 'ILIKE', "%$sname%")
                         ->where('genus', 'ILIKE', "%$genus%")
                         ->where('kingdom', 'ILIKE', "%$kingdom%");
        }
        if($sname && $genus){
            return $query->where('scientific_name', 'ILIKE', "%$sname%")
                         ->where('genus', 'ILIKE', "%$genus%");
        }
        if($sname && $superkingdom && $kingdom){
            return $query->where('scientific_name', 'ILIKE', "%$sname%")
                         ->where('superkingdom', 'ILIKE', "%$superkingdom%")
                         ->where('kingdom', 'ILIKE', "%$kingdom%");
        }
        if($sname && $superkingdom){
            return $query->where('scientific_name', 'ILIKE', "%$sname%")
                                ->where('superkingdom', 'ILIKE', "%$superkingdom%");
        }
        if($sname && $kingdom){
            return $query->where('scientific_name', 'ILIKE', "%$sname%")
                         ->where('kingdom', 'ILIKE', "%$kingdom%");
        }
        if($sname){
            return $query->where('scientific_name', 'ILIKE', "%$sname%");
        }
        if($specie && $family && $genus && $superkingdom && $kingdom){
            return $query->where('specie', 'ILIKE', "%$specie%")
                         ->where('family', 'ILIKE', "%$family%")
                         ->where('genus', 'ILIKE', "%$genus%")
                         ->where('superkingdom', 'ILIKE', "%$superkingdom%")
                         ->where('kingdom', 'ILIKE', "%$kingdom%");
        }
        if($specie && $family && $genus && $superkingdom){
            return $query->where('specie', 'ILIKE', "%$specie%")
                         ->where('family', 'ILIKE', "%$family%")
                         ->where('genus', 'ILIKE', "%$genus%")
                         ->where('superkingdom', 'ILIKE', "%$superkingdom%");
        }
        if($specie && $family && $genus && $kingdom){
            return $query->where('specie', 'ILIKE', "%$specie%")
                         ->where('family', 'ILIKE', "%$family%")
                         ->where('genus', 'ILIKE', "%$genus%")
                         ->where('kingdom', 'ILIKE', "%$kingdom%");
        }
        if($specie && $family && $genus){
            return $query->where('specie', 'ILIKE', "%$specie%")
                         ->where('family', 'ILIKE', "%$family%")
                         ->where('genus', 'ILIKE', "%$genus%");
        }
        if($specie && $family && $superkingdom && $kingdom){
            return $query->where('specie', 'ILIKE', "%$specie%")
                         ->where('family', 'ILIKE', "%$family%")
                         ->where('superkingdom', 'ILIKE', "%$superkingdom%")
                         ->where('kingdom', 'ILIKE', "%$kingdom%");
        }
        if($specie && $family && $superkingdom){
            return $query->where('specie', 'ILIKE', "%$specie%")
                         ->where('family', 'ILIKE', "%$family%")
                         ->where('superkingdom', 'ILIKE', "%$superkingdom%");
        }
        if($specie && $family && $kingdom){
            return $query->where('specie', 'ILIKE', "%$specie%")
                         ->where('family', 'ILIKE', "%$family%")
                         ->where('kingdom', 'ILIKE', "%$kingdom%");
        }
        if($specie && $family){
            return $query->where('specie', 'ILIKE', "%$specie%")
                         ->where('family', 'ILIKE', "%$family%");
        }
        if($specie && $genus && $superkingdom && $kingdom){
            return $query->where('specie', 'ILIKE', "%$specie%")
                         ->where('genus', 'ILIKE', "%$genus%")
                         ->where('superkingdom', 'ILIKE', "%$superkingdom%")
                         ->where('kingdom', 'ILIKE', "%$kingdom%");
        }
        if($specie && $genus && $superkingdom){
            return $query->where('specie', 'ILIKE', "%$specie%")
                         ->where('genus', 'ILIKE', "%$genus%")
                         ->where('superkingdom', 'ILIKE', "%$superkingdom%");
        }
        if($specie && $genus && $kingdom){
            return $query->where('specie', 'ILIKE', "%$specie%")
                         ->where('genus', 'ILIKE', "%$genus%")
                         ->where('kingdom', 'ILIKE', "%$kingdom%");
        }
        if($specie && $genus){
            return $query->where('specie', 'ILIKE', "%$specie%")
                         ->where('genus', 'ILIKE', "%$genus%");
        }
        if($specie && $superkingdom && $kingdom){
            return $query->where('specie', 'ILIKE', "%$specie%")
                         ->where('superkingdom', 'ILIKE', "%$superkingdom%")
                         ->where('kingdom', 'ILIKE', "%$kingdom%");
        }
        if($specie && $superkingdom){
            return $query->where('specie', 'ILIKE', "%$specie%")
                         ->where('superkingdom', 'ILIKE', "%$superkingdom%");
        }
        if($specie && $kingdom){
            return $query->where('specie', 'ILIKE', "%$specie%")
                         ->where('kingdom', 'ILIKE', "%$kingdom%");
        }
        if($specie){
            return $query->where('specie', 'ILIKE', "%$specie%");
        }
        if($family && $genus && $superkingdom && $kingdom){
            return $query->where('family', 'ILIKE', "%$family%")
                         ->where('genus', 'ILIKE', "%$genus%")
                         ->where('superkingdom', 'ILIKE', "%$superkingdom%")
                         ->where('kingdom', 'ILIKE', "%$kingdom%");
        }
        if($family && $genus && $superkingdom){
            return $query->where('family', 'ILIKE', "%$family%")
                         ->where('genus', 'ILIKE', "%$genus%")
                         ->where('superkingdom', 'ILIKE', "%$superkingdom%");
        }
        if($family && $genus && $kingdom){
            return $query->where('family', 'ILIKE', "%$family%")
                         ->where('genus', 'ILIKE', "%$genus%")
                         ->where('kingdom', 'ILIKE', "%$kingdom%");
        }
        if($family && $genus){
            return $query->where('family', 'ILIKE', "%$family%")
                         ->where('genus', 'ILIKE', "%$genus%");
        }
        if($family && $superkingdom && $kingdom){
            return $query->where('family', 'ILIKE', "%$family%")
                         ->where('superkingdom', 'ILIKE', "%$superkingdom%")
                         ->where('kingdom', 'ILIKE', "%$kingdom%");
        }
        if($family && $superkingdom){
            return $query->where('family', 'ILIKE', "%$family%")
                         ->where('superkingdom', 'ILIKE', "%$superkingdom%");
        }
        if($family && $kingdom){
            return $query->where('family', 'ILIKE', "%$family%")
                         ->where('kingdom', 'ILIKE', "%$kingdom%");
        }
        if($family){
            return $query->where('family', 'ILIKE', "%$family%");
        }
        if($genus && $superkingdom && $kingdom){
            return $query->where('genus', 'ILIKE', "%$genus%")
                         ->where('superkingdom', 'ILIKE', "%$superkingdom%")
                         ->where('kingdom', 'ILIKE', "%$kingdom%");
        }
        if($genus && $superkingdom){
            return $query->where('genus', 'ILIKE', "%$genus%")
                         ->where('superkingdom', 'ILIKE', "%$superkingdom%");
        }
        if($genus && $kingdom){
            return $query->where('genus', 'ILIKE', "%$genus%")
                         ->where('kingdom', 'ILIKE', "%$kingdom%");
        }
        if($genus){
            return $query->where('genus', 'ILIKE', "%$genus%");
        }
        if($superkingdom && $kingdom){
            return $query->where('superkingdom', 'ILIKE', "%$superkingdom%")
                         ->where('kingdom', 'ILIKE', "%$kingdom%");
        }
        if($superkingdom){
            return $query->where('superkingdom', 'ILIKE', "%$superkingdom%");
        }
        if($kingdom){
            return $query->where('kingdom', 'ILIKE', "%$kingdom%");
        }
    }

    public function scopeSearch($query, $name){

        return $query->where('scientific_name', 'ILIKE', "%$name%")
                         ->orwhere('specie', 'ILIKE', "%$name%")
                         ->orwhere('family', 'ILIKE', "%$name%")
                         ->orwhere('genus', 'ILIKE', "%$name%")
                         ->orwhere('superkingdom', 'ILIKE', "%$name%")
                         ->orwhere('kingdom', 'ILIKE', "%$name%")
                         ->orwhere('phylum', 'ILIKE', "%$name%")
                         ->orwhere('subphylum', 'ILIKE', "%$name%")
                         ->orwhere('order', 'ILIKE', "%$name%")
                         ->orwhere('tribe', 'ILIKE', "%$name%");
    }
/*
    public function scopeSname($query, $sname){

        return $query->where('scientific_name', 'ILIKE', "%$sname%");
    }

    public function scopeSpecie($query, $specie){

        return $query->where('specie', 'ILIKE', "%$specie%");
    }

    public function scopeFamily($query, $family){

        return $query->where('family', 'ILIKE', "%$family%");
    }

    public function scopeGenus($query, $genus){

        return $query->where('genus', 'ILIKE', "%$genus%");
    }

    public function scopeSuperk($query, $superkingdom){

        return $query->where('superkingdom', 'ILIKE', "%$superkingdom%");
    }

    public function scopeKingdom($query, $kingdom){

        return $query->where('kingdom', 'ILIKE', "%$kingdom%");
    }
    */
    ######################################################################endRhaegar
}
