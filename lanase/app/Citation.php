<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Citation extends Model
{
    //
    protected $table= "citations";

    protected $fillable = ['citation','link','identifier'];

    public function medias() {
    	return $this->hasMany('App\Media');
    }

    public function literatures() {
    	return $this->hasMany('App\Literature');
    }

}
