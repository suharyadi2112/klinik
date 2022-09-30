<?php

namespace App\Http\Controllers\ManageGender;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use App\Helpers\Helper as HelperLog;

class ManageGender extends Controller
{
    public function __construct()
    {
        $this->middleware(['web']);
    }


    public function ShowGender(Request $request){ 

        if ($request->ajax()) {
           $data = DB::table('f_gender')
                   ->orderBy('id', 'desc')
                   ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '';
                    if (auth()->user()->can('edit cat')) {
                        $actionBtn .= '<button type="button" class="btn btn-sm round btn-info upGE" vall="'.$row->gender.'" data-id="'.$row->id.'">edit</button>&nbsp;';
                    }
                    if (auth()->user()->can('delete cat')) {
                        $actionBtn .= '<button type="button" class="btn btn-sm btn-outline-danger round delGE" data-id="'.$row->id.'">del</button>';
                    }
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
	    }
        HelperLog::addToLog('Show Data Gender', json_encode($request->all()));

        $breadcrumbs = [
          ['link' => "/gender", 'name' => "Gender"], ['link' => "/gender", 'name' => "List Gender"], ['name' => "Dashboard Gender"],
        ];
	    return view("/pages/gender/gender", ['breadcrumbs' => $breadcrumbs]);
  	}


  	public function StoreGender(Request $request){

        if ($request->nameGender == null || empty($request->nameGender)) {
            return redirect()->route('/');
        }

        $cekInsert = DB::table('f_gender')->insertGetId(
            array('gender' => strtolower($request->nameGender))
        );
            
        if ($cekInsert) {
          HelperLog::addToLog('Create Data Gender', json_encode($request->all()));
          return response()->json(['code' => '1', 'data' => $request->nameGender]);
        }else{
          return response()->json(['code' => '2']);
        }

    }


    public function PutGender(Request $request, $id){

        if ($request->NewUpdateGender == null || empty($request->NewUpdateGender)) {
            return redirect()->route('/');
        }

        $cekUpdate =DB::table('f_gender')
                        ->where('id', $id)
                        ->update(array('Gender' => strtolower($request->NewUpdateGender)));
            
        if ($cekUpdate) {
          HelperLog::addToLog('Update Data Gender', json_encode($request->all()));
          return response()->json(['code' =>  '1',  'value' => $request->NewUpdateGender]);
        }else{
          return response()->json(['code' => '2']);
        }

    }


    public function DelGender($id){

        $res = HelperLog::addToLog('Delete Data Gender', json_encode($id));
        DB::table('f_gender')->where('id', '=', $id)->delete();
        return response()->json(['code' =>  '1', 'res' => $res]);

    }
}
