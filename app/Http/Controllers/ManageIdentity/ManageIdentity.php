<?php

namespace App\Http\Controllers\ManageIdentity;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use App\Helpers\Helper as HelperLog;

class ManageIdentity extends Controller
{
    public function __construct()
    {
        $this->middleware(['web']);
    }

    public function ShowIdentity(Request $request){ 

        if ($request->ajax()) {
           $data = DB::table('f_identitas')
                   ->orderBy('id', 'desc')
                   ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '';
                    if (auth()->user()->can('edit identity type')) {
                        $actionBtn .= '<button type="button" class="btn btn-sm round btn-info upIT" vall="'.$row->jenis.'" data-id="'.$row->id.'">edit</button>&nbsp;';
                    }else{
                        $actionBtn .= '<button type="button" class="btn btn-sm round btn-info" onclick="return alert(\'You no have access !\')">edit</button>&nbsp;';
                    }
                    if (auth()->user()->can('delete identity type')) {
                        $actionBtn .= '<button type="button" class="btn btn-sm btn-outline-danger round delIT" data-id="'.$row->id.'">del</button>';
                    }else{
                        $actionBtn .= '<button type="button" class="btn btn-sm btn-outline-danger round" onclick="return alert(\'You no have access !\')">del</button>';
                    }
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
	    }
        HelperLog::addToLog('Show Data Identity Type', json_encode($request->all()));

        $breadcrumbs = [
          ['link' => "/identity", 'name' => "Identity Type"], ['link' => "/identity", 'name' => "List Identity Type"], ['name' => "Dashboard Identity Type"],
        ];
	    return view("/pages/identity/identity", ['breadcrumbs' => $breadcrumbs]);
  	}


  	public function StoreIdentityType(Request $request){

        if ($request->nameIT == null || empty($request->nameIT)) {
            return redirect()->route('/');
        }

        $cekInsert = DB::table('f_identitas')->insertGetId(
            array('jenis' => strtolower($request->nameIT))
        );
            
        if ($cekInsert) {
          HelperLog::addToLog('Create Data Identity Type', json_encode($request->all()));
          return response()->json(['code' => '1', 'data' => $request->nameIT]);
        }else{
          return response()->json(['code' => '2']);
        }

    }


    public function PutIdentityType(Request $request, $id){

        if ($request->NewUpdateIT == null || empty($request->NewUpdateIT)) {
            return redirect()->route('/');
        }

        $cekUpdate =DB::table('f_identitas')
                        ->where('id', $id)
                        ->update(array('jenis' => strtolower($request->NewUpdateIT)));
            
        if ($cekUpdate) {
          HelperLog::addToLog('Update Data Identity Type', json_encode($request->all()));
          return response()->json(['code' =>  '1',  'value' => $request->NewUpdateIT]);
        }else{
          return response()->json(['code' => '2']);
        }

    }


    public function DelidentityType($id){

        $res = HelperLog::addToLog('Delete Data identity Type', json_encode($id));
        DB::table('f_identitas')->where('id', '=', $id)->delete();
        return response()->json(['code' =>  '1', 'res' => $res]);

    }
}
