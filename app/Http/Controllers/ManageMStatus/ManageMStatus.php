<?php

namespace App\Http\Controllers\ManageMStatus;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use App\Helpers\Helper as HelperLog;

class ManageMStatus extends Controller
{
    public function __construct()
    {
        $this->middleware(['web']);
    }


    public function ShowMStatus(Request $request){ 

        if ($request->ajax()) {
           $data = DB::table('f_statuskawin')
                   ->orderBy('id', 'desc')
                   ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '';
                    if (auth()->user()->can('edit cat')) {
                        $actionBtn .= '<button type="button" class="btn btn-sm round btn-info upMA" vall="'.$row->status.'" data-id="'.$row->id.'">edit</button>&nbsp;';
                    }
                    if (auth()->user()->can('delete cat')) {
                        $actionBtn .= '<button type="button" class="btn btn-sm btn-outline-danger round delMA" data-id="'.$row->id.'">del</button>';
                    }
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
	    }
        HelperLog::addToLog('Show Data Marital Status', json_encode($request->all()));

        $breadcrumbs = [
          ['link' => "/marital_status", 'name' => "Marital Status"], ['link' => "/marital_status", 'name' => "List Marital Status"], ['name' => "Dashboard Marital Status"],
        ];
	    return view("/pages/status/marital", ['breadcrumbs' => $breadcrumbs]);
  	}


  	public function StoreMStatus(Request $request){

        if ($request->nameMStatus == null || empty($request->nameMStatus)) {
            return redirect()->route('/');
        }

        $cekInsert = DB::table('f_statuskawin')->insertGetId(
            array('status' => strtolower($request->nameMStatus))
        );
            
        if ($cekInsert) {
          HelperLog::addToLog('Create Data Marital Status', json_encode($request->all()));
          return response()->json(['code' => '1', 'data' => $request->nameMStatus]);
        }else{
          return response()->json(['code' => '2']);
        }

    }


    public function PutMStatus(Request $request, $id){

        if ($request->NewUpdateMStatus == null || empty($request->NewUpdateMStatus)) {
            return redirect()->route('/');
        }

        $cekUpdate =DB::table('f_statuskawin')
                        ->where('id', $id)
                        ->update(array('status' => strtolower($request->NewUpdateMStatus)));
            
        if ($cekUpdate) {
          HelperLog::addToLog('Update Data Marital Status', json_encode($request->all()));
          return response()->json(['code' =>  '1',  'value' => $request->NewUpdateMStatus]);
        }else{
          return response()->json(['code' => '2']);
        }

    }


    public function DelMStatus($id){

        $res = HelperLog::addToLog('Delete Data Marital Status', json_encode($id));
        DB::table('f_statuskawin')->where('id', '=', $id)->delete();
        return response()->json(['code' =>  '1', 'res' => $res]);

    }
}
