<?php

namespace App\Http\Controllers\ManagePartnerCategory;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper as HelperLog;

class ManagePartnerCategory extends Controller
{
    public function __construct()
    {
        $this->middleware(['web']);
    }

    public function ShowPartnerCategory(Request $request){ 

        if ($request->ajax()) {
           $data = DB::table('kategoripengirim')
                   ->orderBy('katpengirimid', 'desc')
                   ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '';
                        $actionBtn .= '<button type="button" class="btn btn-sm round btn-info upPC" vall="'.$row->katpengirimnama.'" data-id="'.$row->katpengirimid .'">edit</button>&nbsp;';
                    
   
                        $actionBtn .= '<button type="button" class="btn btn-sm btn-outline-danger round delPC" data-id="'.$row->katpengirimid .'">del</button>';
                    
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
	    }
        HelperLog::addToLog('Show Data Partner Category', json_encode($request->all()));
        //add bredcum
        $breadcrumbs = [
          ['link' => "/partner/category", 'name' => "Partner Category"], ['link' => "/partner/category", 'name' => "List Partner Category"], ['name' => "Dashboard Partner Category"],
        ];
	    return view("/partner/category", ['breadcrumbs' => $breadcrumbs]);
  	}


    public function StorePC(Request $request){

        if ($request->namepc == null || empty($request->namepc)) {
            return redirect()->route('/');
        }

        $cekInsert = DB::table('kategoripengirim')->insertGetId(
            array('katpengirimnama' => strtolower($request->namepc))
        );
            
        if ($cekInsert) {
          HelperLog::addToLog('Create Data Partner Category', json_encode($request->all()));
          return response()->json(['code' => '1', 'data' => $request->namepc]);
        }else{
          return response()->json(['code' => '2']);
        }

    }

    public function UpdatePC(Request $request, $id){

        if ($request->NewUpdatePC == null || empty($request->NewUpdatePC)) {
            return redirect()->route('/');
        }

        $cekUpdate =DB::table('kategoripengirim')
                        ->where('katpengirimid', $id)
                        ->update(array('katpengirimnama' => strtolower($request->NewUpdatePC)));
            
        if ($cekUpdate) {
          HelperLog::addToLog('Update Data Partner Category', json_encode($request->all()));
          return response()->json(['code' =>  '1',  'value' => $request->NewUpdatePC]);
        }else{
          return response()->json(['code' => '2']);
        }

    }

    public function DelPC($id){

        $res = HelperLog::addToLog('Delete Data Partner Category', json_encode($id));
        DB::table('kategoripengirim')->where('katpengirimid', '=', $id)->delete();
        return response()->json(['code' =>  '1', 'res' => $res]);

    }
}
