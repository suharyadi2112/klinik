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
        
        $tindakan = DB::table('tindakan')->get();  
        return view("/partner/partner", ['tindakan' => $tindakan]);
    }
}
