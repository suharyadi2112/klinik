<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

use App\Models\User;
use App\Models\TypeOfBilling;
use App\Models\Action;
use Spatie\Permission\Models\Role;

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

    public function index(Request $request){

        if ($request->ajax()) {
            $data = DB::table('pendaftaran')
            ->join('pasien','pasien.pasid','=','pendaftaran.penpasid')
            ->join('pengirim','pengirim.pengid','=','pendaftaran.penpengid')
            ->join('jenispembayaran','jenispembayaran.pemid','=','pendaftaran.penpemid')
            ->orderBy('penid', 'desc')
            ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '';
                    $actionBtn .= '<a href="'.route('RegistrationAction', ['id_registration' => Crypt::encryptString($row->penid)]) .'"><button type="button" class="btn btn-sm round btn-info" idRegis="'.$row->penid.'" >action</button>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

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

    //list partner
    public function ShowModalPartner(){
        return response()->json(['code' => '1', 'modal' => $this->AllModalTransaction->ModalPartner()]);
    }

    public function GetListPartner(Request $request){
        if ($request->ajax()) {
            $data = DB::table('pengirim')->orderBy('pennama', 'desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '';
                    $actionBtn .= '<button type="button" class="btn btn-sm round btn-info PickPartner" val_id_partner="'.$row->pengid.'" val_name_partner="'.$row->pennama.'" ><i class="bx bxs-check-circle"></i></button>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
    
    //list billing
    public function ListTypeOfBilling(Request $request){
        $data = [];
        if($request->q){
            $search = $request->q;
            $data = TypeOfBilling::select("pemid","pemnama")->where('pemnama','LIKE',"%$search%")->get();
        }else{
            $data = TypeOfBilling::select("pemid","pemnama")->get();
        }
        return response()->json($data);
    }

    //show form action registration 
    public function RegistrationAction($id){

        $dec_penid = Crypt::decryptString($id);//decrypt id

        $data = DB::table('pendaftaran')
            ->join('pasien','pasien.pasid','=','pendaftaran.penpasid')
            ->join('pengirim','pengirim.pengid','=','pendaftaran.penpengid')
            ->join('jenispembayaran','jenispembayaran.pemid','=','pendaftaran.penpemid')
            ->orderBy('penid', 'desc')
            ->where('pendaftaran.penid','=',$dec_penid)
            ->first();

        if ($data) {

            //param pertama subject dan kedua data request
            HelperLog::addToLog('Show action registration', json_encode(auth()->user()->id));
            //Pasang Breadcrumbs 
            $breadcrumbs = [
              ['link' => "/transaction/registration/", 'name' => "registration"], ['link' => "/action/registration/".$id."", 'name' => "action Registration"], ['name' => "action registration"],
            ];
            return view("/pages/transaction/action_registration",['breadcrumbs' => $breadcrumbs, 'dataregistration' => $data, 'id' => $id]);
        }else{
            return redirect()->route('IndexRegistration')->with('error', 'Data Registration Not Found !');
        }

    }

    //list action code
    public function ShowModalActionCode(){
        return response()->json(['code' => '1', 'modal' => $this->AllModalTransaction->ModalActionCode()]);
    }

    //get list action code
    public function GetListActionCode(Request $request){
        if ($request->ajax()) {
            $data = Action::orderBy('tndid','asc')->join('kategoritindakan', 'tindakan.tndkattndid', '=', 'kategoritindakan.kattndid')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '';
                    $actionBtn .= '<button type="button" class="btn btn-sm round btn-info PickActionCode"
                                    data-tndid="'.$row->tndid.'"
                                    data-tndnama="'.$row->tndnama.'"
                                    data-tndkattndid="'.$row->tndkattndid.'"
                                    data-kattndnama="'.$row->kattndnama.'"
                                    data-tndharga="'.$row->tndharga.'"
                                    ><i class="bx bxs-check-circle"></i></button>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    //insert action registration
    public function TableTindakanKeluar(Request $request, $id){

        $dec_penid = Crypt::decryptString($id);

        $restndkel = DB::table('tindakankeluar')
                    ->join('tindakan','tindakan.tndid','=','tindakankeluar.tndklrtndid')
                    ->join('pendaftaran','pendaftaran.penid','=','tindakankeluar.tndklrpenid')
                    ->join('kategoritindakan','kategoritindakan.kattndid','=','tindakan.tndkattndid')
                    ->where('tndklrpenid','=',$dec_penid)->orderBy('tndklrid','DESC')->get();

        if ($request->ajax()) {
            return response()->json(['code' => '1','data' => $restndkel, 'tabel' => $this->AllModalTransaction->TabelActionRegistration($dec_penid, $restndkel)]);
        }

    }

    public function InsertRegistrationAction(Request $request){

        $validator = Validator::make($request->all(), [
            'pendaftaran_id' => 'required|max:50',
            'form_pick_action_code_id' => 'required|max:100',
            'price' => 'required|max:100',
            'discount_price' => 'required|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json(['code' => '1', 'fail' => $validator->messages()->first()], 200);
        }else{
            $res = DB::table('tindakankeluar')->insert([
                        'tndklrtndid' => $request->form_pick_action_code_id,
                        'tndklrpenid' => $request->pendaftaran_id,
                        'tndklrharga' => $request->price,
                        // 'tndklrdiskon' => $request->pendaftaran_id,
                        'tndklrdiskonprice' => $request->discount_price,
                    ]);

            if ($res) {
                //param pertama subject dan kedua data request
                HelperLog::addToLog('Insert action registration', json_encode($request->all()));
                return response()->json(['code' => '2']);
            }else{
                return response()->json(['code' => '3']);
            }
            
        }
    }

}
