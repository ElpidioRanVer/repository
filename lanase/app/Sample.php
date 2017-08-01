<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sample extends Model
{
    //
    protected $table = "samples";

    protected $fillable = ['specimen_id','user_id','collect_id','sample_type','observations'];

    public function collect() {
    	return $this->belongsTo('App\Collect');
    }

    public function specimen() {
    	return $this->belongsTo('App\Specimen');
    }

    public function user() {
    	return $this->belongsTo('App\User');
    }
}
