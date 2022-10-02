<?php

namespace App\Http\Controllers\ManageOccupation;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use App\Helpers\Helper as HelperLog;

class ManageOccupation extends Controller
{
    public function __construct()
    {
        $this->middleware(['web']);
    }

    public function ShowOccupation(Request $request){ 

        if ($request->ajax()) {
           $data = DB::table('f_pekerjaan')
                   ->orderBy('id', 'desc')
                   ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '';
                    if (auth()->user()->can('edit occupation')) {
                        $actionBtn .= '<button type="button" class="btn btn-sm round btn-info upOC" vall="'.$row->pekerjaan.'" data-id="'.$row->id.'">edit</button>&nbsp;';
                    }else{
                        $actionBtn .= '<button type="button" class="btn btn-sm round btn-info" onclick="return alert(\'You no have access !\')">edit</button>&nbsp;';
                    }
                    if (auth()->user()->can('delete occupation')) {
                        $actionBtn .= '<button type="button" class="btn btn-sm btn-outline-danger round delOC" data-id="'.$row->id.'">del</button>';
                    }else{
                        $actionBtn .= '<button type="button" class="btn btn-sm btn-outline-danger round" onclick="return alert(\'You no have access !\')">del</button>';
                    }
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
	    }
        HelperLog::addToLog('Show Data Occupation', json_encode($request->all()));

        $breadcrumbs = [
          ['link' => "/occupation", 'name' => "Occupation"], ['link' => "/occupation", 'name' => "List Occupation"], ['name' => "Dashboard Occupation"],
        ];
	    return view("/pages/occupation/occupation", ['breadcrumbs' => $breadcrumbs]);
  	}


  	public function StoreOccupation(Request $request){

        if ($request->nameOccupation == null || empty($request->nameOccupation)) {
            return redirect()->route('/');
        }

        $cekInsert = DB::table('f_pekerjaan')->insertGetId(
            array('pekerjaan' => strtolower($request->nameOccupation))
        );
            
        if ($cekInsert) {
          HelperLog::addToLog('Create Data Occupation', json_encode($request->all()));
          return response()->json(['code' => '1', 'data' => $request->nameOccupation]);
        }else{
          return response()->json(['code' => '2']);
        }

    }


    public function PutOccupation(Request $request, $id){

        if ($request->NewUpdateOccupation == null || empty($request->NewUpdateOccupation)) {
            return redirect()->route('/');
        }

        $cekUpdate =DB::table('f_pekerjaan')
                        ->where('id', $id)
                        ->update(array('pekerjaan' => strtolower($request->NewUpdateOccupation)));
            
        if ($cekUpdate) {
          HelperLog::addToLog('Update Data Occupation', json_encode($request->all()));
          return response()->json(['code' =>  '1',  'value' => $request->NewUpdateOccupation]);
        }else{
          return response()->json(['code' => '2']);
        }

    }


    public function DelOccupation($id){

        $res = HelperLog::addToLog('Delete Data Occupation', json_encode($id));
        DB::table('f_pekerjaan')->where('id', '=', $id)->delete();
        return response()->json(['code' =>  '1', 'res' => $res]);

    }

}
