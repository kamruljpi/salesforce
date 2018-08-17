<?php

namespace App\Http\Controllers\ifa;

use App\Http\Controllers\Message\UpdateNidAction;
use App\Model\ManagementSetting\ApplicantTraining;
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
		return view('ifa.nid_update.list_upade_page',compact('getList'));
	}
	public function storeNid(Request $request){
		$store = new UpdateNidModel();
		$store->user_id 		= Auth::user()->user_id;
		$store->application_no 	= $request->ifaid;
		$store->old_nid 		= $request->oldnid;
		$store->new_nid 		= $request->newnid;
		$store->status 			= UpdateNidAction::STORE_UPDATE_NID;

		$checkStore = $store->save();

		if($checkStore == true){
			return json_encode($request->all());
		}
		return json_encode('ssssss');
	}

	public function getNidValue(Request $request){
		$data = DB::table('tbl_nid_update')
					->where([
						['application_no',$request->ifaid],
						['old_nid',$request->oldnid],
						['status',-1]
					])
					->get();

		return json_encode($data);
	}

	public function update(Request $request){

		$update = ApplicantTraining::find($request->id);
		$update->national_id_card_no = $request->new_nid;
		$update->update();

		$upadateValue = UpdateNidModel::find($request->nid_id);
		$upadateValue->user_id 		= Auth::user()->user_id;
		$upadateValue->status       = UpdateNidAction::APPROVED;
		$upadateValue->update();

		return redirect()->route('update_nid_list_view');
	}

	public function rejected(Request $request){
		$upadateValue = UpdateNidModel::find($request->nid_id);
		$upadateValue->status = UpdateNidAction::REJECTED;
		$upadateValue->update();
		return redirect()->route('update_nid_list_view');

	}
}