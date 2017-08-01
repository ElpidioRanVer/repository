<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publication_Status extends Model
{
    //
    protected $table = "publication_status";

    protected $fillable = ['specimen_id','pub_status','pub_date'];

    public function specimen() {
    	return $this->belongsTo('App\Specimen');
    }
}
