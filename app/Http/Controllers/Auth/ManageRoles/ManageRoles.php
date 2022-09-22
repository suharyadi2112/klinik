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

use App\Helpers\Helper as HelperLog;

class ManageRoles extends Controller
{
    // construct yang lama
    public function __construct()
    {
        // $this->middleware('guest'); //old middleware
        // akses users untuk super-admin dan admin
        $this->middleware(['web']);
    }

    //dashboard role
    public function ShowRolesUsers(Request $request){

        if ($request->ajax()) {
            $data = Role::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '';
                    if ($row->name == 'super-admin') {
                        $actionBtn = 'this super admin role';
                    }else{
                        $actionBtn = '';
                        if (auth()->user()->can('view permission')) {
                            $actionBtn .= '<button type="button" class="btn btn-sm btn-outline-primary round CekPermission" data-id="'.$row->id.'">permissions</button>&nbsp;';
                        }
                        // <!--button type="button" class="btn btn-sm round btn-info upRole" vall="'.$row->name.'" data-id="'.$row->id.'">edit</button-->
                        if (auth()->user()->can('delete roles')) {
                            $actionBtn .= '<button type="button" class="btn btn-sm btn-outline-danger round delRole" data-id="'.$row->id.'">del</button>';
                        }
                    }
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
    }

    //param pertama subject dan kedua data request
    HelperLog::addToLog('Show data role', json_encode($request->all()));
    //Pasang Breadcrumbs 
    $breadcrumbs = [
      ['link' => "/users/roles", 'name' => "Roles"], ['link' => "/users/roles", 'name' => "List Roles"], ['name' => "Dashboard Roles"],
    ];
    return view("/auth/users/roles",['breadcrumbs' => $breadcrumbs]);
  }

  //insert role baru
  public function StoreRoles(Request $request){

    if ($request->nameroles == null || empty($request->nameroles)) {
        return redirect()->route('/');
    }

    $cekInsert = Role::create(['name' => strtolower($request->nameroles)]); //create role baru

    if ($cekInsert) {
      //param pertama subject dan kedua data request
      HelperLog::addToLog('Store data role', json_encode($request->all()));
      return response()->json(['code' => '1', 'data' => $request->nameroles]);
    }else{
      return response()->json(['code' => '2']);
    }

  }

  // //update role
  // public function PutRoles(Role $role, Request $request, $id){

  //   $role = Role::findById($id);

  //   if ($request->NewUpdateRoles == null || empty($request->NewUpdateRoles)) {
  //       return redirect()->route('/');
  //   }

  //   $cekUpdate = $role->update(['name' => strtolower($request->NewUpdateRoles)]); //update role baru

  //   if ($cekUpdate) {
  //     //param pertama subject dan kedua data request
  //     HelperLog::addToLog('Update data role', json_encode($request->all()));
  //     return response()->json(['code' =>  '1',  'value' => $request->NewUpdateRoles]);
  //   }else{
  //     return response()->json(['code' => '2']);
  //   }

  // }

  //del role
  //test
  public function DelRoles(Role $role, $id){

    $item = Role::withCount('users')->find($id);

    if ($item->users_count > 0) {
       return response()->json(['code' =>  '6', 'data' => $item]);
    }

    $role = Role::findById($id);
    $role->delete();
    //param pertama subject dan kedua data request
    HelperLog::addToLog('Delete data role', json_encode($role, $id)); 
    return response()->json(['code' =>  '1']);

  }

}
