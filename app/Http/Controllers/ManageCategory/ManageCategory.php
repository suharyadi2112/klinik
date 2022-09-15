<?php

namespace App\Http\Controllers\ManageCategory;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use App\Helpers\Helper as HelperLog;

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
        HelperLog::addToLog('Show data Category', json_encode($request->all()));
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
          HelperLog::addToLog('Create data Category', json_encode($request->all()));
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
          HelperLog::addToLog('Update data Category', json_encode($request->all()));
          return response()->json(['code' =>  '1',  'value' => $request->NewUpdateCategory]);
        }else{
          return response()->json(['code' => '2']);
        }

    }

    public function DelCategory($id){

        DB::table('kategoritindakan')->where('kattndid', '=', $id)->delete();
        // HelperLog::addToLog('Delete data Category', json_encode($request->$id));
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
                    $actionBtn =
                                '
                                <button type="button" class="btn btn-sm round btn-info upCa" data-id="'.$row->tndid .'">edit</button>
                                <button type="button" class="btn btn-sm btn-outline-danger round delCa" data-id="'.$row->tndid .'">del</button>
                                '
                                ;
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $category = DB::table('kategoritindakan')->get();
        $count    = DB::table('tindakan')->count();

        HelperLog::addToLog('Show data Category Action', json_encode($request->all()));
        return view("/pages/category_action", ['category' => $category, 'count' => $count]);
    }

    // INSERT TBL TINDAKAN //
    public function PostCa(Request $request){

        $validator = Validator::make($request->all(), [
            'category' => 'required',
            'id_cat' => 'required',
            'nama' => 'required|max:255',
            'harga' => 'required',
            'note' => 'required|max:255'
        ]);

        if ($validator->fails()) {
          return response()->json(['code' => '1', 'fail' => $validator->messages()->first()], 200);
        }else{

          DB::table('tindakan')->insert([
              'tndid' => $request->id_cat,
              'tndnama' => $request->nama,
              'tndkattndid' => $request->category,
              'tndharga' => $request->harga,
              'tndnote' => $request->note,
          ]);

          HelperLog::addToLog('Create data Category Action', json_encode($request->all()));
          return response()->json(['code' => '2'], 200);

        }

    }

    //DELETE TABEL TINDAKAN//
    public function DelCa($id){

        DB::table('tindakan')->where('tndid', '=', $id)->delete();
        // HelperLog::addToLog('Dlete data Category Action', json_encode($request->all()));
        return response()->json(['code' =>  '1']);

    }

    //SHOW MODAL TINDAKAN//
    public function ModalEditCa(Request $request){

        $category = DB::table('kategoritindakan')->get();

        $ct     = DB::table('tindakan')
                ->where('tndid', '=', $request->id1)
                ->first();

        $modal = '';
        $modal .= '<div class="modal-body" >
                      
                      <div class="form-group">
                          <label for="select-country">Category</label>
                          <select class="form-control" id="select-category" name="category">
                            <option value="">Select Category</option>';
                            foreach($category as $valc){
                            $modal .= '<option value="'.$valc->kattndid.'" '.(($valc->kattndid==$ct->tndkattndid)?'selected':"").'>'.$valc->kattndnama.'</option>';
                            }
                            $modal .=        
                          '</select>
                      </div>

                      <div class="form-group">
                          <label class="form-label" for="basic-default-id">ID</label>
                          <input type="text" class="form-control" id="basic-default-id" value="'.$ct->tndid.'" name="id_cat" readonly/>
                      </div>

                      <div class="form-group">
                          <label class="form-label" for="basic-default-name">Name</label>
                          <input type="text" class="form-control" id="basic-default-name" name="nama" value="'.$ct->tndnama.'" />
                      </div>

                      <div class="form-group">
                          <label class="form-label" for="basic-default-price">Price</label>
                          <input type="number" class="form-control" id="basic-default-price" name="harga" value="'.$ct->tndharga.'" />
                      </div>    

                      <div class="form-group">
                          <label class="form-label" for="basic-default-note">Note</label>
                          <input type="text" class="form-control" id="basic-default-note" name="note" value="'.$ct->tndnote.'" />
                      </div> 


                    </div>';

          return response()->json(['modalUpdate' => $modal], 200);

    }

    //UPDATE TABEL TINDAKAN//
    public function UpdateCa(Request $request){

        $validator = Validator::make($request->all(), [
            'category' => 'required',
            'id_cat' => 'required',
            'nama' => 'required|max:255',
            'harga' => 'required',
            'note' => 'required|max:255'
        ]);

        if ($validator->fails()) {
          return response()->json(['code' => '1', 'fail' => $validator->messages()->first()], 200);
        }else{

        $updateCa = DB::table('tindakan')
          ->where('tndid', $request->id_cat)
          ->update(['tndnama' => $request->nama,
                    'tndkattndid' => $request->category,
                    'tndharga' => $request->harga,
                    'tndnote' => $request->note]
                   );
        HelperLog::addToLog('Update data Category Action', json_encode($request->all()));
        return response()->json(['code' => '2'], 200);
        }

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