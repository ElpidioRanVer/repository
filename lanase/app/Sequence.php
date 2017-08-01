<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sequence extends Model
{
    //
    protected $table = "sequences";

    protected $fillable = ['specimen_id', 'path', 'desc'];

    public function specimen() {
    	return $this->belongsTo('App\Specimen');
    }
}
