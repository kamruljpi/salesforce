<?php

namespace App\Http\Controllers\ifa;

use App\Http\Controllers\Message\ActionMessage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Auth;
use DB;

class RejectedApplication extends Controller
{
    public function viewRejectedApplication(){
    	return view('ifa.ifa_bulk_upload.bulk_upload_view');
    }
}
