<?php

namespace App\Http\Controllers\ManageCategory;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class ManageCategory extends Controller
{
    
    public function __construct()
    {
        // $this->middleware('guest'); //old middleware
        // akses users untuk super-admin dan admin
        $this->middleware(['role:super-admin|admin']);
    }

    public function ShowCategory(Request $request){

        if ($request->ajax()) {
            // $data = Role::all();
           $data = DB::table('kategoritindakan')
                   ->orderBy('kattndid', 'desc')
                   ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<button type="button" class="btn btn-sm round btn-info upCategory" vall="'.$row->kattndnama.'" data-id="'.$row->kattndid.'">edit</button>
                                <button type="button" class="btn btn-sm btn-outline-danger round delCategory" data-id="'.$row->kattndid.'">del</button>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
	    }
        
	    return view("/pages/category");
  	}

    public function StoreCategory(Request $request){

        if ($request->namecategory == null || empty($request->namecategory)) {
            return redirect()->route('/');
        }

        $cekInsert = DB::table('kategoritindakan')->insertGetId(
            array('kattndnama' => strtolower($request->namecategory))
        );
            
        if ($cekInsert) {
          return response()->json(['code' => '1', 'data' => $request->namecategory]);
        }else{
          return response()->json(['code' => '2']);
        }

    }

    public function PutCategory(Request $request, $id){

        if ($request->NewUpdateCategory == null || empty($request->NewUpdateCategory)) {
            return redirect()->route('/');
        }

        $cekUpdate =DB::table('kategoritindakan')
                        ->where('kattndid', $id)
                        ->update(array('kattndnama' => strtolower($request->NewUpdateCategory)));
            
        //$cekUpdate = $role->update(['name' => strtolower($request->NewUpdateCategory)]); //update role baru

        if ($cekUpdate) {
          return response()->json(['code' =>  '1',  'value' => $request->NewUpdateCategory]);
        }else{
          return response()->json(['code' => '2']);
        }

    }

    public function DelCategory($id){

        DB::table('kategoritindakan')->where('kattndid', '=', $id)->delete();

        return response()->json(['code' =>  '1']);

    }


    // View Category Action//
    public function ShowCategoryAction(Request $request){

        if ($request->ajax()) {
            // $data = Role::all();
           $data = DB::table('tindakan')
                   ->leftJoin('kategoritindakan', 'tindakan.tndkattndid', '=', 'kategoritindakan.kattndid')
                   ->orderBy('tindakan.tndid', 'desc')
                   ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = ''
                                // '
                                // <button type="button" class="btn btn-sm round btn-info upCategory" vall="'.$row->tndnama.'" data-id="'.$row->tndid .'">edit</button>
                                // <button type="button" class="btn btn-sm btn-outline-danger round delCategory" data-id="'.$row->tndid .'">del</button>
                                // '
                                ;
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        
        return view("/pages/category_action");
    }

    //View Action//
    public function ShowAction(Request $request){

        if ($request->ajax()) {
            // $data = Role::all();
           $data = DB::table('katlab')
                   ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = ''
                                // '
                                // <button type="button" class="btn btn-sm round btn-info upCategory" vall="'.$row->tndnama.'" data-id="'.$row->tndid .'">edit</button>
                                // <button type="button" class="btn btn-sm btn-outline-danger round delCategory" data-id="'.$row->tndid .'">del</button>
                                // '
                                ;
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        
        return view("/pages/action");
    }

}
