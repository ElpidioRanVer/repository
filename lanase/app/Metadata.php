<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Metadata extends Model
{
    //
    protected $table = "metadatas";

    protected $fillable = ['creator','title','publisher','publication_status_year','subject','contributor','date','language','resource_type','alternate_identifier','related_identifier','size','format','version','rights','description','geolocation', 'input_date'];

    public function specimens() {
    	return $this->hasMany('App\Specimen');
    }
}
