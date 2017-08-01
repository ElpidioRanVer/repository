<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Metric extends Model
{
    //
    protected $table = 'metrics';

    protected $fillable = ['dataset_id','datasetkey','count_usages','count_by_rank','count_by_kingdom','count_by_origin','downloaded','created','latest'];

    public function dataset() {
    	return $this->belongsTo('App\Dataset');
    }
}
