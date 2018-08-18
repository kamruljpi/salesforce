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
    	$institutions = DB::table('tbl_new_organization')->where('is_active', 1)->get();
    	return view('ifa.ifa_bulk_upload.bulk_upload_view',['institutions' => $institutions]);
    }
}
