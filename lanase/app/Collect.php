<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collect extends Model
{
    //
    protected $table = "collects";

    protected $fillable = ['date', 'no_samples'];

    public function samples() {
    	return $this->hasMany('App\Sample');
    }
}
