<?php

namespace App\Http\Controllers\Auth\ManageRoles;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use App\Helpers\Helper as HelperLog;

use DB;

class ManagePermissions extends Controller
{
    // construct yang lama
    public function __construct()
    {
        // $this->middleware('guest'); //old middleware
        // akses users untuk super-admin dan admin
        $this->middleware(['web']);
    }

    public function index(){

     
    }

    //update permission
    public function UpdatePermission(Request $request) {   
        // reset cache permission
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $validator = Validator::make($request->all(), [
            // 'permission_id' => 'required',
            'roleid' => 'required'
        ]);

        if ($validator->fails()) {
          return response()->json(['code' => '1', 'fail' => $validator->messages()->first()], 200);
        }else{
                $deleted = DB::table('role_has_permissions')->where('role_id', '=', $request->roleid)->delete();
                if ($request->permission_id) {
                    for ($i=0; $i < count($request->permission_id); $i++) { 
                        $Insert[] =   [
                                    'permission_id' => $request->permission_id[$i],
                                    'role_id' => $request->roleid,
                                    ];
                    }
                    $resInsert = DB::table('role_has_permissions')->insert($Insert);
                    //param pertama subject dan kedua data request
                    HelperLog::addToLog('Update permissions in role', json_encode($request->all())); 
                    return response()->json(['code' => '2'], 200);
                }else{
                    return response()->json(['code' => '2'], 200);
                }
            }
    
    }

    // show modal permissionf
    public function ShowModalPermission(Request $request)
    {   

        HelperLog::addToLog('Show modal permission', json_encode($request->rolesid));
        return response()->json(['code' => '2' , 'modalData' =>  $this->GetModal($request->rolesid)]);

    }

    protected function GetModal($rolesid){

        if (auth()->user()->can('update permission')) { $dis = ''; }else{ $dis = 'disabled';}

        $modal = '';
        $modal .= '<div class="modal-body" >
                    <div class="form-group">
                <div class="table-responsive">
                <table class="table table-sm table-striped" width="100%">
                    <tbody>';

        $GroupPermission = DB::table("permissions")->select('group')->groupBy('group')->orderBy('group','DESC')->get();
        foreach ($GroupPermission as $keyGroup => $allGroup) {
        $allPermission = DB::table("permissions")->where('group','=',$allGroup->group)->orderBy('name','DESC')->get();
            
            $modal .=   '<tr>';
            $modal .=   '<td style="border-style : hidden!important; vertical-align:middle;" nowrap><h5><b>'.strtoupper($allGroup->group).'</b></h5></td>';
            $modal .=   '<td style="border-style : hidden!important; vertical-align:middle; width:1px;" nowrap><h5><b>:</b></h5></td>';
                    foreach ($allPermission as $key => $value) {
                    $CekPunya = DB::table('role_has_permissions')->where([['role_id','=',$rolesid],['permission_id','=',$value->id]])->count();
                    // $resPermission = explode(" ",$value->name);
                        $modal .=   '<td scope="row" style="border-style : hidden!important;" nowrap><fieldset>
                                            <div class="checkbox checkbox-info checkbox-glow" >
                                                <input type="checkbox" '.$dis.' value="'.$value->id.'" name="permission_id[]" id="checkboxGlow1'.$value->id.'" 
                                                '.((0 < $CekPunya)?'checked':"").'
                                                >
                                                <label for="checkboxGlow1'.$value->id.'" style="cursor: pointer;">'.$value->name.'</label>
                                            </div>
                                        </fieldset>
                                    </td>';
                    }
            $modal .=   '</tr>';
        }
            $modal .= '<input type="hidden" name="roleid" value="'.$rolesid.'" required></input>
                    </tbody>
                    </table>
                    </div>
                  </div>
                </div>';
     
        return $modal;
    }

}
