<?php

namespace App\Model;

use App\Model\Report;
use Illuminate\Database\Eloquent\Model;

class ReportUpload extends Model
{	
	protected $table = 'images';

    protected $fillable = [
    	'report_id',
    	'report_image'
    ];

    public function owner() {
    	return $this->belongsTo('App\Model\Report','report_id');
    }
}
