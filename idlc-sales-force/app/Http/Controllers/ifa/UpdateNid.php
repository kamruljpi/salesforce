<?php

namespace App\Http\Controllers\ifa;

use App\Http\Controllers\Message\UpdateNidAction;
use App\Model\IfaManagement\UpdateNidModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Auth;
use DB;

class UpdateNid extends Controller
{
	public function viewupdateNid(){
		$getList = DB::table('tbl_nid_update as tnu')
						->select('tnu.*','tir.*')
						->join('tbl_ifa_registrations as tir','tnu.application_no','tir.application_no')
						->where('status',-1)
						->get();
						// $this->print_me($getList);
		return view('ifa.nid_update.list_upade_page',compact('getList'));
	}
	public function storeNid(Request $request){
		$store = new UpdateNidModel();
		$store->user_id 		= Auth::user()->user_id;
		$store->application_no 	= $request->ifaid;
		$store->old_nid 		= $request->oldnid;
		$store->new_nid 		= $request->oldnid;
		$store->status 			= UpdateNidAction::STORE_UPDATE_NID;

		$checkStore = $store->save();

		if($checkStore == true){
			return json_encode($request->all());
		}
		return json_encode('ssssss');
	}

	public function update(Request $request){
		echo "string";
		die();
		$data = $request->all();

		$this->print_me($data);
	}
}