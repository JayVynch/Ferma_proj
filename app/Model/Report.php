<?php

namespace App\Model;

use App\Model\ReportUpload;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table = 'reports';
    
    protected $fillable = [
    	'firstName',
    	'lastName',
    	'email',
    	'contact',
    	'city',
    	'state',
    	'descibeType',
    	'badSpotLocation',
    	'description',
        'fermaUpload'
    ];

    public function reportImages(){
       return $this->hasMany('App\Model\ReportUpload','report_id');
    }
}
