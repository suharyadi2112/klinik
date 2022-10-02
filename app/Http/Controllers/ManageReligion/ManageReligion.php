<?php

namespace App\Http\Controllers\ManageReligion;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use App\Helpers\Helper as HelperLog;

class ManageReligion extends Controller
{
    public function __construct()
    {
        $this->middleware(['web']);
    }


    public function ShowReligion(Request $request){ 

        if ($request->ajax()) {
           $data = DB::table('f_agama')
                   ->orderBy('id', 'desc')
                   ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '';
                    if (auth()->user()->can('edit religion')) {
                        $actionBtn .= '<button type="button" class="btn btn-sm round btn-info upReligion" vall="'.$row->agama.'" data-id="'.$row->id.'">edit</button>&nbsp;';
                    }else{
                        $actionBtn .= '<button type="button" class="btn btn-sm round btn-info" onclick="return alert(\'You no have access !\')">edit</button>&nbsp;';
                    }
                    if (auth()->user()->can('delete religion')) {
                        $actionBtn .= '<button type="button" class="btn btn-sm btn-outline-danger round delReligion" data-id="'.$row->id.'">del</button>';
                    }else{
                        $actionBtn .= '<button type="button" class="btn btn-sm btn-outline-danger round" onclick="return alert(\'You no have access !\')">del</button>';
                    }
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
	    }
        HelperLog::addToLog('Show Data Religion', json_encode($request->all()));

        $breadcrumbs = [
          ['link' => "/religion", 'name' => "Religion"], ['link' => "/religion", 'name' => "List Religion"], ['name' => "Dashboard Religion"],
        ];
	    return view("/pages/religion/religion", ['breadcrumbs' => $breadcrumbs]);
  	}


  	public function StoreReligion(Request $request){

        if ($request->nameReligion == null || empty($request->nameReligion)) {
            return redirect()->route('/');
        }

        $cekInsert = DB::table('f_agama')->insertGetId(
            array('agama' => strtolower($request->nameReligion))
        );
            
        if ($cekInsert) {
          HelperLog::addToLog('Create Data Identity Type', json_encode($request->all()));
          return response()->json(['code' => '1', 'data' => $request->nameReligion]);
        }else{
          return response()->json(['code' => '2']);
        }

    }


    public function PutIReligion(Request $request, $id){

        if ($request->NewUpdateReligion == null || empty($request->NewUpdateReligion)) {
            return redirect()->route('/');
        }

        $cekUpdate =DB::table('f_agama')
                        ->where('id', $id)
                        ->update(array('agama' => strtolower($request->NewUpdateReligion)));
            
        if ($cekUpdate) {
          HelperLog::addToLog('Update Data Religion', json_encode($request->all()));
          return response()->json(['code' =>  '1',  'value' => $request->NewUpdateReligion]);
        }else{
          return response()->json(['code' => '2']);
        }

    }


    public function DelReligion($id){

        $res = HelperLog::addToLog('Delete Data Religion', json_encode($id));
        DB::table('f_agama')->where('id', '=', $id)->delete();
        return response()->json(['code' =>  '1', 'res' => $res]);

    }
}
