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
        $this->middleware(['web']);
    }


    //SHOW CATEGORY DATA//
    public function ShowCategory(Request $request){ 

        if ($request->ajax()) {
           $data = DB::table('kategoritindakan')
                   ->orderBy('kattndid', 'desc')
                   ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '';
                    if (auth()->user()->can('edit cat')) {
                        $actionBtn .= '<button type="button" class="btn btn-sm round btn-info upCategory" vall="'.$row->kattndnama.'" data-id="'.$row->kattndid.'">edit</button>&nbsp;';
                    }
                    if (auth()->user()->can('delete cat')) {
                        $actionBtn .= '<button type="button" class="btn btn-sm btn-outline-danger round delCategory" data-id="'.$row->kattndid.'">del</button>';
                    }
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
	    }
        HelperLog::addToLog('Show data Category', json_encode($request->all()));
        //add bredcum
        $breadcrumbs = [
          ['link' => "/category", 'name' => "Category"], ['link' => "/category", 'name' => "List Category"], ['name' => "Dashboard Category"],
        ];
	    return view("/pages/category", ['breadcrumbs' => $breadcrumbs]);
  	}

    // ADD CATEGORY DATA//
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

    // UPDATE CATEGORY DATA//
    public function PutCategory(Request $request, $id){

        if ($request->NewUpdateCategory == null || empty($request->NewUpdateCategory)) {
            return redirect()->route('/');
        }

        $cekUpdate =DB::table('kategoritindakan')
                        ->where('kattndid', $id)
                        ->update(array('kattndnama' => strtolower($request->NewUpdateCategory)));
            
        if ($cekUpdate) {
          HelperLog::addToLog('Update data Category', json_encode($request->all()));
          return response()->json(['code' =>  '1',  'value' => $request->NewUpdateCategory]);
        }else{
          return response()->json(['code' => '2']);
        }

    }

    // DALETE CATEGORY DATA//
    public function DelCategory($id){

        $res = HelperLog::addToLog('Delete data Category', json_encode($id));
        DB::table('kategoritindakan')->where('kattndid', '=', $id)->delete();
        return response()->json(['code' =>  '1', 'res' => $res]);

    }


    // View Category Action//
    public function ShowCategoryAction(Request $request){

        if ($request->ajax()) {
           $data = DB::table('tindakan')
                   ->leftJoin('kategoritindakan', 'tindakan.tndkattndid', '=', 'kategoritindakan.kattndid')
                   ->orderBy('tindakan.tndid', 'desc')
                   ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '';
                    if (auth()->user()->can('edit cataction')) {
                        $actionBtn .= '<button type="button" class="btn btn-sm round btn-info upCa" data-id="'.$row->tndid .'">edit</button>&nbsp;';
                    }
                    if (auth()->user()->can('delete cataction')) {
                        $actionBtn .= '<button type="button" class="btn btn-sm btn-outline-danger round delCa" data-id="'.$row->tndid .'">del</button>';
                    }
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $category = DB::table('kategoritindakan')->get();
        $count    = DB::table('tindakan')->count();

        HelperLog::addToLog('Show data Category Action', json_encode($request->all()));
        $breadcrumbs = [
          ['link' => "/category", 'name' => "Category"], ['link' => "/category", 'name' => "List Category"], ['name' => "Dashboard Category"],
        ];
        return view("/pages/category_action", ['category' => $category, 'count' => $count, 'breadcrumbs' => $breadcrumbs]);
    }

    // ADD TBL TINDAKAN //
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

        HelperLog::addToLog('Delete data Category Action', json_encode($id));

        DB::table('tindakan')->where('tndid', '=', $id)->delete();
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
                          <textarea class="form-control" id="basic-default-note" name="note">'.$ct->tndnote.'</textarea>
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
           $data = DB::table('katlab')
                   ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn =
                                '
                                <button type="button" class="btn btn-sm round btn-info upC" data-id="'.$row->katlabid.'">edit</button>
                                <button type="button" class="btn btn-sm btn-outline-danger round delC" data-id="'.$row->katlabid .'">del</button>
                                '
                                ;
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        //Pasang Breadcrumbs
        $breadcrumbs = [
          ['link' => "/action", 'name' => "Action"], ['link' => "/action", 'name' => "List Action"], ['name' => "Dashboard Action"],
        ];
        
        $tindakan = DB::table('tindakan')->get();  
        return view("/pages/action", ['tindakan' => $tindakan]);
    }

    // ADD TBL KATLAB //
    public function PostC(Request $request){

        $validator = Validator::make($request->all(), [
            'action' => 'required',
            'nama' => 'required|max:255',
            'unit' => 'required',
            'value' => 'required|max:255'
        ]);

        if ($validator->fails()) {
          return response()->json(['code' => '1', 'fail' => $validator->messages()->first()], 200);
        }else{

          DB::table('katlab')->insert([
              'katlabnama' => $request->nama,
              'katlabsat' => $request->unit,
              'katlabnilai' => $request->value,
              'katlabtndid' => $request->action,
          ]);

          HelperLog::addToLog('Create data Action', json_encode($request->all()));
          return response()->json(['code' => '2'], 200);

        }

    }

    //DELETE TABEL KATLAB//
    public function DelC($id){

        HelperLog::addToLog('Delete data action', json_encode($id));

        DB::table('katlab')->where('katlabid', '=', $id)->delete();
        return response()->json(['code' =>  '1']);

    }

    //SHOW MODAL ACTION//
    public function ModalEditC(Request $request){

        $tindakan = DB::table('tindakan')->get();

        $ct     = DB::table('katlab')
                ->where('katlabid', '=', $request->id1)
                ->first();

        $modal = '';
        $modal .= '<div class="modal-body" >
                      
                      <div class="form-group">
                          <label for="select-country">Category Action</label>
                          <select class="form-control" id="action" name="action">
                            <option value="">Select Category</option>';
                            foreach($tindakan as $valca){
                            $modal .= '<option value="'.$valca->tndid.'" '.(($valca->tndid==$ct->katlabtndid)?'selected':"").'>'.$valca->tndnama.'</option>';
                            }
                            $modal .=        
                          '</select>
                      </div>

                      <div class="form-group">
                          <label class="form-label" for="basic-default-name">Name</label>
                          <input type="text" class="form-control" id="basic-default-name" name="nama" value="'.$ct->katlabnama.'" />
                      </div>

                      <input type="hidden" name="id_ac" value="'.$ct->katlabid.'" />

                      <div class="form-group">
                          <label class="form-label" for="basic-default-unit">Unit</label>
                          <input type="text" class="form-control" id="basic-default-unit" name="unit" value="'.$ct->katlabsat.'" />
                      </div>    

                      <div class="form-group">
                          <label class="form-label" for="basic-default-value">Value</label>
                          <input type="text" class="form-control" id="basic-default-value" name="value" value="'.$ct->katlabnilai.'" />
                      </div> 


                    </div>';

          return response()->json(['modalUpdateaction' => $modal], 200);

    }


    //UPDATE TABEL KATLAB//
    public function UpdateC(Request $request){

        $validator = Validator::make($request->all(), [
            'id_ac' => 'required',
            'action' => 'required',
            'nama' => 'required|max:255',
            'unit' => 'required',
            'value' => 'required|max:255'
        ]);

        if ($validator->fails()) {
          return response()->json(['code' => '1', 'fail' => $validator->messages()->first()], 200);
        }else{

        $updateCa = DB::table('katlab')
          ->where('katlabid', $request->id_ac)
          ->update(['katlabnama' => $request->nama,
                    'katlabtndid' => $request->action,
                    'katlabsat' => $request->unit,
                    'katlabnilai' => $request->value]
                   );
        HelperLog::addToLog('Update data Action', json_encode($request->all()));
        return response()->json(['code' => '2'], 200);
        }
    }
    

}