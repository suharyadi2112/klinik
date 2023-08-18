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

    protected function GetInfoTindakanKeluar($id_pen){
        $CekDataRindakanLeads = DB::table('tindakankeluar')->where('tindakankeluar.tndklrpenid','=',$id_pen)->get();
        return $CekDataRindakanLeads;
    }
    public function index(Request $request){

        if ($request->ajax()) {

            $cekRoles = DB::table('users')->select('roles.name')->join('model_has_roles','model_id','=','users.id')
            ->join('roles','roles.id','=','model_has_roles.role_id')->where('users.id','=',auth()->user()->id)->first();

            $data = DB::table('pendaftaran')
            ->select('pendaftaran.*','pasien.*','pengirim.*','jenispembayaran.*','users.name')
            ->join('pasien','pasien.pasid','=','pendaftaran.penpasid')
            ->join('pengirim','pengirim.pengid','=','pendaftaran.penpengid')
            ->join('jenispembayaran','jenispembayaran.pemid','=','pendaftaran.penpemid')
            ->join('users','users.id','=','pendaftaran.created_by')
            ->orderBy('penid', 'desc')
            ->when($cekRoles, function ($q, $cekRoles) {
                if ($cekRoles->name != 'super-admin') {
                    return $q->where('pendaftaran.created_by','=',auth()->user()->id);  
                }
            })
            ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '';
                    if($this->GetInfoTindakanKeluar($row->penid)->isEmpty()){
                        $claasss = "btn-warning";
                        $titlee = "need action";
                    }else{
                        $claasss = "btn-info";
                        $titlee = "have action";
                    }
                    $actionBtn .= '<div class="btn-group dropup dropdown-icon-wrapper">
                                        <a href="'.route('RegistrationAction', ['id_registration' => Crypt::encryptString($row->penid)]) .'" type="button" class="btn btn-icon '.$claasss.' glow" data-toggle="tooltip" data-placement="top" title="'.$titlee.'" idRegis="'.$row->penid.'" >
                                            <i class="bx bx-first-aid"></i>
                                        </a>
                                        <button type="button" class="btn btn-primary btn-icon dropdown-toggle glow" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="bx bx-cog dropdown-icon"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a href="'.route('ViewEditRegistrationMain',['idpen' => Crypt::encryptString($row->penid)]).'"><span class="dropdown-item">
                                                <i class="bx bx-edit"></i>
                                            </span></a>
                                            <span class="dropdown-item DeleteRegistration" data_idPendaftar="'.$row->penid.'" status_request="'.$row->status_request.'">
                                                <i class="bx bxs-trash"></i>
                                            </span>
                                        </div>
                                    </div>';
                    return $actionBtn;
                })
                ->addColumn('list_tindakankeluar', function($row){
                    $actionBtnn= $this->getlisttindakankeluarwithrelasi($row->penid);
                    return ['data' => $actionBtnn];
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

    public function AddRegistrationWithAction(){
        //param pertama subject dan kedua data request
        HelperLog::addToLog('Show add form registration and action', json_encode(auth()->user()->id));
        //Pasang Breadcrumbs 
        $breadcrumbs = [
          ['link' => "/transaction/registration", 'name' => "Dashboard registration"], ['link' => "/add/registrationwithaction", 'name' => "Form Registration Action"], ['name' => "Form Registration Action"],
        ];
        return view("/pages/transaction/add_regisandaction",['breadcrumbs' => $breadcrumbs]);
    }

    //get basic registration informasi
    public function GetBasicRegistration($idpen){

        //get data temporary pendaftaran
        $data = DB::table('pendaftaran_leads')
            ->join('pasien','pasien.pasid','=','pendaftaran_leads.penpasid')
            ->join('pengirim','pengirim.pengid','=','pendaftaran_leads.penpengid')
            ->join('jenispembayaran','jenispembayaran.pemid','=','pendaftaran_leads.penpemid')
            ->orderBy('penid', 'desc')
            ->where('pendaftaran_leads.penid','=',$idpen)
            ->first();

        return response()->json(['code' => '1' , 'databasic' => $data]);
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

        $data = $this->GetInfoRegistration($dec_penid);

        if ($data) {
            if ($data->status_request == "request") {//hanya untuk berstatus request
                //param pertama subject dan kedua data request
                HelperLog::addToLog('Show action registration', json_encode(auth()->user()->id));
                //Pasang Breadcrumbs 
                $breadcrumbs = [
                  ['link' => "/transaction/registration/", 'name' => "registration"], ['link' => "/action/registration/".$id."", 'name' => "action Registration"], ['name' => "action registration"],
                ];
                return view("/pages/transaction/action_registration",['breadcrumbs' => $breadcrumbs, 'dataregistration' => $data, 'id' => $id]);
            }else{
                return redirect()->route('IndexRegistration')->with('error', 'Action Registration only for request status !');
            }
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
                                ><i class="bx bxs-check-circle"></i> '.$row->tndklrtndid.'</button>';                    
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
    //get list action code V2 lead(temporary)
    public function GetListActionCodeV2(Request $request, $id){
        if ($request->ajax()) {
            $data = Action::orderBy('tndid','asc')->join('kategoritindakan', 'tindakan.tndkattndid', '=', 'kategoritindakan.kattndid')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row) use ($id){

                    $actionBtn = '';
                    $checkExits = DB::table("tindakankeluar_leads")->where([['tndklrtndid','=',$row->tndid],['tndklrpenid','=',$id]])->count();
                    
                    if ($checkExits > 0) {
                       $actionBtn .= '<button type="button" class="btn btn-sm round btn-secondary"><i class="bx bxs-check-circle"></i></button>';
                    }else{
                        $actionBtn .= '<button type="button" class="btn btn-sm round btn-info PickActionCode"
                                    data-tndid="'.$row->tndid.'"
                                    data-tndnama="'.$row->tndnama.'"
                                    data-tndkattndid="'.$row->tndkattndid.'"
                                    data-kattndnama="'.$row->kattndnama.'"
                                    data-tndharga="'.$row->tndharga.'"
                                    ><i class="bx bxs-check-circle"></i> '.$row->tndklrtndid.'</button>';
                    }
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    protected function getlisttindakankeluarwithrelasi($id_pen){
        $restndkel = DB::table('tindakankeluar')
                    ->join('tindakan','tindakan.tndid','=','tindakankeluar.tndklrtndid')
                    ->join('pendaftaran','pendaftaran.penid','=','tindakankeluar.tndklrpenid')
                    ->join('kategoritindakan','kategoritindakan.kattndid','=','tindakan.tndkattndid')
                    ->where('tndklrpenid','=',$id_pen)->orderBy('tndklrid','DESC')->get();
        return $restndkel;
    }

    //get list table action registration
    public function TableTindakanKeluar(Request $request, $id){

        $dec_penid = Crypt::decryptString($id);
        $restndkel = $this->getlisttindakankeluarwithrelasi($dec_penid);
        if ($request->ajax()) {
            return response()->json(['code' => '1','data' => $restndkel, 'tabel' => $this->AllModalTransaction->TabelActionRegistration($dec_penid, $restndkel, "ori")]);
        }

    }

    //get list table action registration code V2 lead(temporary)
    public function TableTindakanKeluarV2(Request $request, $id){
    
        $restndkel = DB::table('tindakankeluar_leads')
                    ->join('tindakan','tindakan.tndid','=','tindakankeluar_leads.tndklrtndid')
                    ->join('pendaftaran_leads','pendaftaran_leads.penid','=','tindakankeluar_leads.tndklrpenid')
                    ->join('kategoritindakan','kategoritindakan.kattndid','=','tindakan.tndkattndid')
                    ->where('tndklrpenid','=',$id)->orderBy('tndklrid','DESC')->get();

        if ($request->ajax()) {
            return response()->json(['code' => '1','data' => $restndkel, 'tabel' => $this->AllModalTransaction->TabelActionRegistration($id, $restndkel, "leads")]);
        }
    }

    //view edit registration
    public function ViewEditRegistrationMain($id_pen){
        $decid = Crypt::decryptString($id_pen);
        $data = $this->GetInfoRegistration($decid);
        //edit hanya untuk status request(belum requested atau selebihnya)
        if ($data->status_request == "request") {
            if ($this->CheckAcc()->can('edit registration')) {
                $breadcrumbs = [
                      ['link' => "/transaction/registration/", 'name' => "registration"], ['link' => "/view/edit/registration/".$id_pen."", 'name' => "edit registration"], ['name' => "edit registration"],
                ];
                return view("/pages/transaction/edit_registration",['breadcrumbs' => $breadcrumbs,  'id_pen' => $decid, 'id_enc' => $id_pen, 'data' => $data]);
            }else{
                return redirect()->route('IndexRegistration')->with('error', 'Sorry, you no have access !');
            }
        }else{
            return redirect()->route('IndexRegistration')->with('error', 'Action Registration only for request status !');
        }
    }

    //--------------------------LABORATORIUM----------------------------//
    public function ViewLaboratorium(Request $request){

        if ($request->ajax()) {
            $data = DB::table('pendaftaran')
            ->join('pasien','pasien.pasid','=','pendaftaran.penpasid')
            ->join('pengirim','pengirim.pengid','=','pendaftaran.penpengid')
            ->join('jenispembayaran','jenispembayaran.pemid','=','pendaftaran.penpemid')
            ->where('pendaftaran.status_request','=','approved')
            ->orderBy('penid', 'desc')
            ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    if ($this->CheckAcc()->can('print laboratorium')) {  
                        $linkk = 'href="'.route('ReportPDFResult',['id_registration' => Crypt::encryptString($row->penid)]).'" target="_blank"';
                    }else{
                        $linkk = 'onclick="return alert(\'You no have access !\')" target="_blank"';
                    }
                    $actionBtn = '';
                    $actionBtn .=   '<div class="btn-group dropup dropdown-icon-wrapper">
                                        <a href="'.route('InputResultLaboratorium',['id_registration' => Crypt::encryptString($row->penid)]).'"><button type="button" class="btn btn-xs btn-icon glow btn-primary" data-toggle="tooltip" data-placement="top" title="Input Result"><i class="bx bx-book-add"></i></button></a>
                                    </div>
                                    <a '.$linkk.' target="_blank">
                                    <div class="btn-group dropup dropdown-icon-wrapper">
                                        <button type="button" class="btn btn-xs btn-icon glow btn-info" data-toggle="tooltip" data-placement="top" title="Report Result"><i class="bx bxs-file-pdf" ></i></button>
                                    </div>
                                    </a>
                                    <a href="'.route('Billing').'">
                                    <div class="btn-group dropup dropdown-icon-wrapper">
                                        <button type="button" class="btn btn-xs btn-icon glow btn-success" data-toggle="tooltip" data-placement="top" title="Billing"><i class="bx bxs-file-find" ></i></button>
                                    </div></a>
                                    <a href="'.route('ReportScreening',['id_regis' => Crypt::encryptString($row->penid)]).'">
                                    <div class="btn-group dropup dropdown-icon-wrapper">
                                        <button type="button" class="btn btn-xs btn-icon glow btn-warning" data-toggle="tooltip" data-placement="top" title="Screening"><i class="bx bxs-check-shield"></i></button>
                                    </div></a>';
                    return $actionBtn;
                })
                ->addColumn('list_tindakankeluar', function($row){
                    $actionBtnn= $this->getlisttindakankeluarwithrelasi($row->penid);
                    return ['data' => $actionBtnn];
                })
                ->addColumn('statresult', function($row){

                  $tndkKlrResult = $this->TndkKlr($row->penid)->count();//cek total result lab
                  $totResult = $this->TotalResult($row->penid)->count();//cek total result  number lab

                  if ($totResult < $tndkKlrResult) {
                    return '<span class="badge badge-light-warning" style="width:120px;">Not Yet ('.$totResult.'/'.$tndkKlrResult.')</span>';
                  }else{
                    return '<span class="badge badge-light-success" style="width:120px;">Done ('.$totResult.'/'.$tndkKlrResult.')</span>';
                  }


                })
                ->addColumn('statscreening', function($row){

                  $scren = $this->GetScrReassessment($row->penid);//get screening data

                  $tble = '';
                  $tble .= '<table>
                              <thead>
                                <tr>
                                  <th>Page 1</th>
                                  <th>Page 2</th>
                                  <th>Page 3</th>
                                </tr>
                              </thead>
                              <tbody>';
                  if ($scren) {
                    if ($scren->status_page_one == '1' || $scren->status_page_two == '1' || $scren->status_page_three == '1') {
                      $tble .=  '<tr>';

                                if ($scren->status_page_one == '1') {
                      $tble .=  '<td title="Reassesment health" style="text-align:center;"><i class="bx bx-check-circle"></i></td>';
                                }else{
                      $tble .=  '<td title="Reassesment health" style="text-align:center;"><i class="bx bxs-error-circle"></i></td>';
                                }
                                if ($scren->status_page_two == '1') {
                      $tble .= '<td title="Health Screening" style="text-align:center;"><i class="bx bx-check-circle"></i></td>';
                                }else{
                      $tble .= '<td title="Health Screening" style="text-align:center;"><i class="bx bxs-error-circle"></i></td>';
                                }
                                if ($scren->status_page_three == '1') {
                      $tble .=   '<td title="Health Screening 2" style="text-align:center;"><i class="bx bx-check-circle"></i></td>';
                                }else{
                      $tble .=  '<td title="Health Screening 2" style="text-align:center;"><i class="bx bxs-error-circle"></i></td>';
                                }

                      $tble .=  '</tr>';
                    }
                  }else{
                    $tble .=  '<tr><td colspan="3">Not Yet</td></tr>';

                  }
                    $tble .=    '</tbody>
                              </table>';

                  return $tble;
                })
                ->rawColumns(['action','statresult','statscreening'])
                ->make(true);
        }

        $breadcrumbs = [
              ['link' => "/view/laboratorium", 'name' => "laboratorium"], ['link' => "/view/laboratorium", 'name' => "laboratorium"], ['name' => "view laboratorium"],
        ];
        return view("/pages/transaction/laboratorium",['breadcrumbs' => $breadcrumbs]);
    }

    public function InputResultLaboratorium(Request $request, $id_pen){
        $dec_penid = Crypt::decryptString($id_pen);//decrypt id

        $ResBasic = $this->GetInfoRegistration($dec_penid);
        $Res = $this->GetInfoLaboratorium($dec_penid);

        if ($request->ajax()) {
            return DataTables::of($Res)->addIndexColumn()
            ->addColumn('action', function($row){

              $ress = DB::table('result')->where([['resultkatlabid','=',$row->katlabid],['resultpenid','=',$row->penid]])->first();
              if ($ress) {
                if ($this->CheckAcc()->can('edit result laboratorium')) {
                    return ''.$ress->result.' - <button type="button" data_idresult="'.$ress->resultid.'" data_katlabid="'.$row->katlabid.'" class="btn btn-info btn-sm mt-0 pt-0 btn-icon glow InsertUpdateResult" aria-haspopup="true" aria-expanded="false"><i class="bx bx-sync"></i></button>';
                }else{
                    return ''.$ress->result.' - <button type="button" class="btn btn-info btn-sm mt-0 pt-0 btn-icon glow" aria-haspopup="true" aria-expanded="false" onclick="return alert(\'You no have access !\')"><i class="bx bx-sync"></i></button>';
                }
              }else{
                if ($this->CheckAcc()->can('create result laboratorium')) {
                    return '<button type="button" data_idresult="kosong" data_katlabid="'.$row->katlabid.'" class="btn btn-primary btn-sm mt-0 pt-0 btn-icon glow InsertUpdateResult" aria-haspopup="true" aria-expanded="false"><i class="bx bxs-plus-circle"></i></button>';
                }else{
                    return '<button type="button" class="btn btn-primary btn-sm mt-0 pt-0 btn-icon glow" aria-haspopup="true" aria-expanded="false" onclick="return alert(\'You no have access !\')"><i class="bx bxs-plus-circle"></i></button>';
                }
              }
                
            })
            ->rawColumns(['action'])->make(true);
        }

        $breadcrumbs = [
              ['link' => "/view/laboratorium", 'name' => "laboratorium"], ['link' => "/insert/result/laboratorium/".$id_pen."", 'name' => "insert result laboratorium"], ['name' => "view result laboratorium"],
        ];
        return view("/pages/transaction/add_result_laboratorium",['breadcrumbs' => $breadcrumbs, 'id_penDec' => $dec_penid ,'id_pen' => $id_pen, 'databasic' => $ResBasic]);
    }


    //--------------------------------Billing-------------------------------------//
    public function Billing(Request $request){

        $Res = DB::table('pendaftaran')
            ->select('pendaftaran.*','pasien.*','pengirim.*','jenispembayaran.*')
            ->join('pasien','pasien.pasid','=','pendaftaran.penpasid')
            ->join('pengirim','pengirim.pengid','=','pendaftaran.penpengid')
            ->join('jenispembayaran','jenispembayaran.pemid','=','pendaftaran.penpemid')
            ->where('pendaftaran.status_request','=','approved')
            ->orderBy('penid', 'desc')
            ->get();

        if ($request->ajax()) {
            return DataTables::of($Res)->addIndexColumn()
            ->addColumn('action', function($row){

                return $this->TndkKlr($row->penid)->count();

            })
            ->addColumn('billing', function($row){

              $reees = $this->TndkKlr($row->penid)->selectRaw('tindakankeluar.tndklrpenid, sum(tndklrdiskonprice) as TotTndKlr')->groupBy('tindakankeluar.tndklrpenid')->first();
              if ($reees) {
                return HelperLog::FormatRupiah($reees->TotTndKlr);
              }else{
                return "-";
              }

            })
            ->addColumn('bayar', function($row){

                return '-';
                
            })
            ->rawColumns(['bayar'])->make(true);
        }

        $breadcrumbs = [
              ['link' => "/view/laboratorium", 'name' => "laboratorium"], ['link' => "/billing/", 'name' => "billing"], ['name' => "view billing"],
        ];
        return view("/pages/transaction/billing",['breadcrumbs' => $breadcrumbs]);

    }

    // --------------------Report Screening-----------------//
    public function ReportScreening($id_regis){

        $dec_penid = Crypt::decryptString($id_regis);//decrypt id
        $ResBasic = $this->GetInfoRegistration($dec_penid);
        $Users = DB::table('users')->select('name')->where('users.id','=',$ResBasic->created_by)->first();
        $MedHis = DB::table('medical_history')->select('*')->orderBy('name_medical_history','ASC')->get();
        $LabTest = DB::table('laboratory_test')->select('*')->orderBy('name_laboratory_test','ASC')->get();
        $PhysExam = DB::table('physical_examination')->select('*')->orderBy('name_physical','ASC')->get();

        $GetScrReassessment = $this->GetScrReassessment($dec_penid);
        if($GetScrReassessment){
            $hsrt =  json_decode($GetScrReassessment->health_screening_report_one, true);//data page 2
            $hsrt_two =  json_decode($GetScrReassessment->health_screening_report_two, true);//data page 3
        }else{
            $hsrt = null;
            $hsrt_two = null;
        }

        // dd(array_keys($hsrt_two['describe_abnormalities']));
        // dd($hsrt_two['describe_abnormalities']['19']);

        $breadcrumbs = [
              ['link' => "/view/laboratorium", 'name' => "laboratorium"], ['link' => "/screening/".$id_regis."", 'name' => "screening"], ['name' => "view screening"],
        ];
        return view("/pages/transaction/screening",['breadcrumbs' => $breadcrumbs, 'id_registration' => $dec_penid, 'id_res_encrypt' => $id_regis, 'databasic' => $ResBasic, 'users' => $Users, 'GetScrReassessment' => $GetScrReassessment, 'MedHis' => $MedHis, 'LabTest' => $LabTest, 'DataPageTwo' => $hsrt, 'DataPageThree' => $hsrt_two,'PhysExam' => $PhysExam]);

    }


    //cek tindkan keluar
    protected function TndkKlr($penid){
      $resAction = DB::table('tindakankeluar')
                  ->join('tindakan','tindakan.tndid','=','tindakankeluar.tndklrtndid')
                  ->join('pendaftaran','pendaftaran.penid','=','tindakankeluar.tndklrpenid')
                  ->join('kategoritindakan','kategoritindakan.kattndid','=','tindakan.tndkattndid')
                  ->where('tndklrpenid','=',$penid);
      return $resAction;
    }

    //cek akses
    protected function CheckAcc(){
        $userAcc = User::with('roles')->where('id','=', auth()->user()->id)->first();//get role user
        return $userAcc;
    }

    protected function GetInfoRegistration($id_pen){
        $data = DB::table('pendaftaran')
            ->join('pasien','pasien.pasid','=','pendaftaran.penpasid')
            ->join('pengirim','pengirim.pengid','=','pendaftaran.penpengid')
            ->join('jenispembayaran','jenispembayaran.pemid','=','pendaftaran.penpemid')
            ->orderBy('penid', 'desc')
            ->where('pendaftaran.penid','=',$id_pen)
            ->first();
        return $data;
    }

    protected function GetInfoLaboratorium($id_pen){
        $data = DB::table('pendaftaran')
            ->join('pasien','pasien.pasid','=','pendaftaran.penpasid')
            ->join('pengirim','pengirim.pengid','=','pendaftaran.penpengid')
            ->join('jenispembayaran','jenispembayaran.pemid','=','pendaftaran.penpemid')
            ->join('tindakankeluar','tindakankeluar.tndklrpenid','=','pendaftaran.penid')
            ->join('tindakan','tindakan.tndid','=','tindakankeluar.tndklrtndid')
            ->join('kategoritindakan','kategoritindakan.kattndid','=','tindakan.tndkattndid')
            ->join('katlab', 'katlab.katlabtndid','=','tindakankeluar.tndklrtndid')
            ->orderBy('penid', 'desc')
            ->where('pendaftaran.penid','=',$id_pen)
            ->get();
        return $data;
    }

    protected function GetScrReassessment($id_regis){
        $res = DB::table('screening')->select('*')->where('id_pendaftaran','=',$id_regis)->limit(1)->orderBy('id_print_screening','DESC')->first();
        if ($res) {
            return $res;
        }else{
            return "";
        }

    }

    protected function TotalResult($idPen){

      $ress = DB::table('result')->where('resultpenid','=',$idPen)->get();
      return $ress;

    }

}
