<?php

namespace App\Http\Controllers\ManageBlood;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use App\Helpers\Helper as HelperLog;

class ManageBlood extends Controller
{
    public function __construct()
    {
        $this->middleware(['web']);
    }

    public function ShowBlood(Request $request){ 

        if ($request->ajax()) {
           $data = DB::table('f_goldar')
                   ->orderBy('id', 'desc')
                   ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '';
                    if (auth()->user()->can('edit blood')) {
                        $actionBtn .= '<button type="button" class="btn btn-sm round btn-info upBL" vall="'.$row->goldar.'" data-id="'.$row->id.'">edit</button>&nbsp;';
                    }else{
                        $actionBtn .= '<button type="button" class="btn btn-sm round btn-info" onclick="return alert(\'You no have access !\')">edit</button>&nbsp;';
                    }
                    if (auth()->user()->can('delete blood')) {
                        $actionBtn .= '<button type="button" class="btn btn-sm btn-outline-danger round delBL" data-id="'.$row->id.'">del</button>';
                    }else{
                        $actionBtn .= '<button type="button" class="btn btn-sm btn-outline-danger round" onclick="return alert(\'You no have access !\')">del</button>';
                    }
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
	    }
        HelperLog::addToLog('Show Data Blood Type', json_encode($request->all()));

        $breadcrumbs = [
          ['link' => "/blood", 'name' => "Blood Type"], ['link' => "/blood", 'name' => "List Blood Type"], ['name' => "Dashboard Blood Type"],
        ];
	    return view("/pages/blood/blood", ['breadcrumbs' => $breadcrumbs]);
  	}


  	public function StoreBlood(Request $request){

        if ($request->nameBlood == null || empty($request->nameBlood)) {
            return redirect()->route('/');
        }

        $cekInsert = DB::table('f_goldar')->insertGetId(
            array('goldar' => strtolower($request->nameBlood))
        );
            
        if ($cekInsert) {
          HelperLog::addToLog('Create Data Blood Type', json_encode($request->all()));
          return response()->json(['code' => '1', 'data' => $request->nameBlood]);
        }else{
          return response()->json(['code' => '2']);
        }

    }


    public function PutBlood(Request $request, $id){

        if ($request->NewUpdateBlood == null || empty($request->NewUpdateBlood)) {
            return redirect()->route('/');
        }

        $cekUpdate =DB::table('f_goldar')
                        ->where('id', $id)
                        ->update(array('goldar' => strtolower($request->NewUpdateBlood)));
            
        if ($cekUpdate) {
          HelperLog::addToLog('Update Data Blood Type', json_encode($request->all()));
          return response()->json(['code' =>  '1',  'value' => $request->NewUpdateBlood]);
        }else{
          return response()->json(['code' => '2']);
        }

    }


    public function DelBlood($id){

        $res = HelperLog::addToLog('Delete Data Blood Type', json_encode($id));
        DB::table('f_goldar')->where('id', '=', $id)->delete();
        return response()->json(['code' =>  '1', 'res' => $res]);

    }
}
