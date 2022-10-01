<?php

namespace App\Http\Controllers\ManagePasienBilling;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper as HelperLog;

use App\Models\User;

class ManagePasienBilling extends Controller
{

    public function __construct()
    {
        $this->middleware(['web']);
    }

    public function ShowBillingType(Request $request){ 

        if ($request->ajax()) {
           $data = DB::table('jenispembayaran')
                   ->orderBy('pemid', 'desc')
                   ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '';
                    if ($this->CheckAcc()->can('edit type of billing')) {
                    $actionBtn .= '<button type="button" class="btn btn-sm round btn-info upBil" vall="'.$row->pemnama.'" data-id="'.$row->pemid .'">edit</button>&nbsp;';
                    }else{
                    $actionBtn .= '<button type="button" class="btn btn-sm round btn-info" onclick="return alert(\'You no have access !\')">edit</button>&nbsp;';    
                    }
                    if ($this->CheckAcc()->can('delete type of billing')) {
                    $actionBtn .= '<button type="button" class="btn btn-sm btn-outline-danger round delBil" data-id="'.$row->pemid .'">del</button>';
                    }else{
                    $actionBtn .= '<button type="button" class="btn btn-sm btn-outline-danger round" onclick="return alert(\'You no have access !\')">del</button>';
                    }
                    
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
	    }
        HelperLog::addToLog('Show Data Billing Type', json_encode($request->all()));
        //add bredcum
        $breadcrumbs = [
          ['link' => "/pasien/billing", 'name' => "Billing Type"], ['link' => "/pasien/billing", 'name' => "List Billing Type"], ['name' => "Dashboard Billing Type"],
        ];
	    return view("/pasien/billing", ['breadcrumbs' => $breadcrumbs]);
  	}


  	// ADD PASIEN BILLING
    public function StoreBilling(Request $request){

        if ($request->namebilling == null || empty($request->namebilling)) {
            return redirect()->route('/');
        }

        $cekInsert = DB::table('jenispembayaran')->insertGetId(
            array('pemnama' => strtolower($request->namebilling))
        );
            
        if ($cekInsert) {
          HelperLog::addToLog('Create data Pasien Billing', json_encode($request->all()));
          return response()->json(['code' => '1', 'data' => $request->namebilling]);
        }else{
          return response()->json(['code' => '2']);
        }

    }

    // UPDATE PASIEN BILLING
    public function UpdateBilling(Request $request, $id){

        if ($request->NewUpdateBilling == null || empty($request->NewUpdateBilling)) {
            return redirect()->route('/');
        }

        $cekUpdate =DB::table('jenispembayaran')
                        ->where('pemid', $id)
                        ->update(array('pemnama' => strtolower($request->NewUpdateBilling)));
            
        if ($cekUpdate) {
          HelperLog::addToLog('Update data pasien billing', json_encode($request->all()));
          return response()->json(['code' =>  '1',  'value' => $request->NewUpdateBilling]);
        }else{
          return response()->json(['code' => '2']);
        }

    }

    // DALETE PASIEN BILLING
    public function DelBilling($id){

        $res = HelperLog::addToLog('Delete data pasien billing', json_encode($id));
        DB::table('jenispembayaran')->where('pemid', '=', $id)->delete();
        return response()->json(['code' =>  '1', 'res' => $res]);

    }

    //cek akses
    protected function CheckAcc(){
        $userAcc = User::with('roles')->where('id','=', auth()->user()->id)->first();//get role user
        return $userAcc;
    }
}
