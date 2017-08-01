<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dataset extends Model
{
    protected $table = "datasets";

    protected $fillable = ['project_id'];

    public function project() {
    	return $this->belongsTo('App\Project');
    }

    public function users() {
    	return $this->belongsToMany('App\User')->withPivot('order')->withTimestamps();
    }

    public function specimenes() {
    	return $this->hasMany('App\Specimen');
    }

    public function metrics() {
    	return $this->hasOne('App\Metric');
    }
}
