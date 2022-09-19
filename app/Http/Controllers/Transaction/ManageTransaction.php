<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

use App\Models\User;
use Spatie\Permission\models\Role;

use App\Helpers\Helper as HelperLog;
use App\Http\Controllers\Transaction\AllModalTransaction;

class ManageTransaction extends Controller
{
    protected $AllModalTransaction;
    public function __construct(AllModalTransaction $AllModalTransaction)
    {
        $this->middleware(['web']);
        $this->AllModalTransaction = $AllModalTransaction;
    }

    public function index(){

        //param pertama subject dan kedua data request
        HelperLog::addToLog('Show data transaction registration', json_encode(auth()->user()->id));
        //Pasang Breadcrumbs 
        $breadcrumbs = [
          ['link' => "/transaction/registration", 'name' => "registration"], ['link' => "/transaction/registration", 'name' => "List Registration"], ['name' => "Dashboard Registration"],
        ];
        return view("/pages/transaction/registration",['breadcrumbs' => $breadcrumbs]);
    }

    //show form registration
    public function AddRegistration(){

         //param pertama subject dan kedua data request
        HelperLog::addToLog('Show add form registration', json_encode(auth()->user()->id));
        //Pasang Breadcrumbs 
        $breadcrumbs = [
          ['link' => "/transaction/registration", 'name' => "Dashboard registration"], ['link' => "/add/registration", 'name' => "Form Registration"], ['name' => "Form Registration"],
        ];
        return view("/pages/transaction/add_registration",['breadcrumbs' => $breadcrumbs]);
    }

    public function ShowModalPatient(){
        return response()->json(['code' => '1', 'modal' => $this->AllModalTransaction->ModalPatient()]);
    }
    
    public function GetListPatient(Request $request){
        if ($request->ajax()) {
            $data = DB::table('pasien')->orderBy('pasnama', 'desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '';
                    $actionBtn .= '<button type="button" class="btn btn-sm round btn-info PickPatient" val_id_patient="'.$row->pasid.'" val_name_patient="'.$row->pasnama.'" ><i class="bx bxs-check-circle"></i></button>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
