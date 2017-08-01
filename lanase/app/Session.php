<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    //
    protected $table = "sessions";

    protected $fillable = ['user_id','last_login','las_ip_login'];

    public function user() {
    	return $this->belongsTo('App\User');
    }
}
