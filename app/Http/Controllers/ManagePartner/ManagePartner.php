<?php

namespace App\Http\Controllers\ManagePartner;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper as HelperLog;

class ManagePartner extends Controller
{
    public function __construct()
    {
        $this->middleware(['web']);
    }

    
    public function ShowPartner(Request $request){

        if ($request->ajax()) {
           $data = DB::table('pengirim')
            	   ->leftJoin('kategoripengirim', 'pengirim.id_kategoripengirim', '=', 'kategoripengirim.katpengirimid')
                   ->orderBy('pengid', 'desc')
                   ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn =
                                '
                                <button type="button" class="btn btn-sm round btn-info upPA" data-id="'.$row->pengid.'">edit</button>
                                <button type="button" class="btn btn-sm btn-outline-danger round delPA" data-id="'.$row->pengid .'">del</button>
                                '
                                ;
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $breadcrumbs = [
          ['link' => "/partner", 'name' => "Partner"], ['link' => "/partner", 'name' => "List Partner"], ['name' => "Dashboard Partner"],
        ];
        
        $kategoripa = DB::table('kategoripengirim')->get();  
        return view("/partner/partner", ['kategoripa' => $kategoripa]);
    }


    public function AddPartner(){

        HelperLog::addToLog('Show form add partner', json_encode(auth()->user()->id));
        $breadcrumbs = [
          ['link' => "/partner/add", 'name' => "Dashboard Partner"], ['link' => "/partner/partner", 'name' => "Form Partner"], ['name' => "Form Partner"],
        ];
        $kategoripa = DB::table('kategoripengirim')->get(); 
        return view("/partner/registrasi",['breadcrumbs' => $breadcrumbs, 'kategoripa' => $kategoripa]);

    }

    public function InsertPartner(Request $request){

        $validator = Validator::make($request->all(), [
            'nama' => 'required|max:255',
            'alamat' => 'required',
            'nohp' => 'required|max:20',
            'cp' => 'required|max:255',
            'cpm' => 'required|max:20',
            'fe' => 'required|max:255',
            'kategori' => 'required',
            'moud' => 'required|date_format:Y-m-d',
            'moudx' => 'required|date_format:Y-m-d',
        ]);

        if ($validator->fails()) {
            HelperLog::addToLog('Fail VALIDATOR Insert data partner', json_encode($request->all())); 
            return response()->json(['code' => '1', 'fail' => $validator->messages()->first()], 200);
        }else{
            $Insert =   DB::table('pengirim')->insert([
                            'pennama' => $request->nama,
                            'penalamat' => $request->alamat,
                            'pentlp' => $request->nohp,
                            'pengcp' => $request->cp,
                            'pengcpno' => $request->cpm,
                            'pengemailsatu' => $request->fe,
                            'id_kategoripengirim' => $request->kategori,
                            'pengmoudate' => $request->moud,
                            'pengmouexdate' => $request->moudx,
                        ]);
            if ($Insert) {
                //param pertama subject dan kedua data request
                HelperLog::addToLog('Insert data partner', json_encode($request->all())); 
                return response()->json(['code' => '2']);
            }else{
                HelperLog::addToLog('Fail Insert data partner', json_encode($request->all())); 
                return response()->json(['code' => '3']);
            }   
        }

    }

    public function delPA($id){

        $res = HelperLog::addToLog('Delete data partner', json_encode($id));
        DB::table('pengirim')->where('pengid', '=', $id)->delete();
        return response()->json(['code' =>  '1', 'res' => $res]);

    }


}
