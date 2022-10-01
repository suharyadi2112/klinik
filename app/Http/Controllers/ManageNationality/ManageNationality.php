<?php

namespace App\Http\Controllers\ManageNationality;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use App\Helpers\Helper as HelperLog;

class ManageNationality extends Controller
{
    public function __construct()
    {
        $this->middleware(['web']);
    }

    public function ShowNationality(Request $request){ 

        if ($request->ajax()) {
           $data = DB::table('F_kwn')
                   ->orderBy('id', 'desc')
                   ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '';
                    if (auth()->user()->can('edit nationality')) {
                        $actionBtn .= '<button type="button" class="btn btn-sm round btn-info upNA" vall="'.$row->kwn.'" data-id="'.$row->id.'">edit</button>&nbsp;';
                    }else{
                        $actionBtn .= '<button type="button" class="btn btn-sm round btn-info" onclick="return alert(\'You no have access !\')">edit</button>&nbsp;';
                    }
                    if (auth()->user()->can('delete nationality')) {
                        $actionBtn .= '<button type="button" class="btn btn-sm btn-outline-danger round delNA" data-id="'.$row->id.'">del</button>';
                    }else{
                        $actionBtn .= '<button type="button" class="btn btn-sm btn-outline-danger round" onclick="return alert(\'You no have access !\')">del</button>';
                    }
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
	    }
        HelperLog::addToLog('Show Data Nationality', json_encode($request->all()));

        $breadcrumbs = [
          ['link' => "/nationality", 'name' => "Nationality"], ['link' => "/nationality", 'name' => "List Nationality"], ['name' => "Dashboard Nationality"],
        ];
	    return view("/pages/nationality/nationality", ['breadcrumbs' => $breadcrumbs]);
  	}


  	public function StoreNationality(Request $request){

        if ($request->nameNationality == null || empty($request->nameNationality)) {
            return redirect()->route('/');
        }

        $cekInsert = DB::table('F_kwn')->insertGetId(
            array('kwn' => strtolower($request->nameNationality))
        );
            
        if ($cekInsert) {
          HelperLog::addToLog('Create Data Nationality', json_encode($request->all()));
          return response()->json(['code' => '1', 'data' => $request->nameNationality]);
        }else{
          return response()->json(['code' => '2']);
        }

    }


    public function PutNationality(Request $request, $id){

        if ($request->NewUpdateNationality == null || empty($request->NewUpdateNationality)) {
            return redirect()->route('/');
        }

        $cekUpdate =DB::table('f_kwn')
                        ->where('id', $id)
                        ->update(array('kwn' => strtolower($request->NewUpdateNationality)));
            
        if ($cekUpdate) {
          HelperLog::addToLog('Update Data Nationality', json_encode($request->all()));
          return response()->json(['code' =>  '1',  'value' => $request->NewUpdateNationality]);
        }else{
          return response()->json(['code' => '2']);
        }

    }


    public function DelNationality($id){

        $res = HelperLog::addToLog('Delete Data Nationality', json_encode($id));
        DB::table('f_kwn')->where('id', '=', $id)->delete();
        return response()->json(['code' =>  '1', 'res' => $res]);

    }
}
