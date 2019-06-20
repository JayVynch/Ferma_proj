<?php

namespace App\Http\Controllers;

use Image;
use App\Model\Report;
use App\Model\ReportUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{
    protected $pathToProfileImage;

    public function __construct(){
        
        $this->pathToProfileImage =  public_path(). DIRECTORY_SEPARATOR.'images'. DIRECTORY_SEPARATOR.'reports';
    }

    public function store(Request $request){
        // dd($request->all());
    	$cleanInput = $this->validate($request, [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required','numeric'],
            'state' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'reportOptions' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'fermaUpload.*' => ['required','image']
        ]);

        //persist all text to database
        $report = new Report();
        $saveUpload = new ReportUpload();

        $report->firstName          = request('firstname');
        $report->lastName           = request('lastname');
        $report->email              = request('email');
        $report->contact            = request('phone');
        $report->city               = request('city');
        $report->state              = request('state');
        $report->descibeType        = request('reportOptions');
        $report->badSpotLocation    = request('location');
        $report->description        = request('description');
        // dd('all ok');
        $report->save();
        //check if the request has an actual image file
        if($request->hasFile('fermaUpload')){
            foreach ($request->fermaUpload as $upload) {
                // dd($upload);
                //get the image name without the extension
                $imageName = pathinfo($upload
                            ->getClientOriginalName(),PATHINFO_FILENAME);

                //Image name with extension 
                $imageWithExtension = $upload->getClientOriginalExtension();

                // file name to store in database
                // the name is saved with timestamp so our image name is unique
                $imageStore = time()."-".$imageName.".".$imageWithExtension;
                // dd($imageStore);
                // resize original size of image and save to folder and database
                $store = Image::make($upload)->resize(944,709.33)
                        ->save($this->pathToProfileImage.'/'.$imageStore);

                $saveUpload->report_image = $imageStore;
                $saveUpload->report_id = $report->id;
                
                $saveUpload->save();
            }
            // dd($report->reportImages);
        }        

    }
}
