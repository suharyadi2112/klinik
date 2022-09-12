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
use Spatie\Permission\models\Role;

class ManageRoles extends Controller
{
    // construct yang lama
    public function __construct()
    {
        // $this->middleware('guest'); //old middleware
        // akses users untuk super-admin dan admin
        $this->middleware(['role:super-admin|admin']);
    }

    //dashboard role
    public function ShowRolesUsers(Request $request){

        $roles = Role::all();

        if ($request->ajax()) {
            $data = Role::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<button type="button" class="btn btn-sm round btn-info upRole" vall="'.$row->name.'" data-id="'.$row->id.'">edit</button>
                                <button type="button" class="btn btn-sm btn-outline-danger round delRole" data-id="'.$row->id.'">del</button>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
    }

    return view("/auth/users/roles");
  }

  //insert role baru
  public function StoreRoles(Request $request){

    if ($request->nameroles == null || empty($request->nameroles)) {
        return redirect()->route('/');
    }
        
    $cekInsert = Role::create(['name' => strtolower($request->nameroles)]); //create role baru

    if ($cekInsert) {
      return response()->json(['code' => '1', 'data' => $request->nameroles]);
    }else{
      return response()->json(['code' => '2']);
    }

  }

  //update role
  public function PutRoles(Role $role, Request $request, $id){

    $role = Role::findById($id);

    if ($request->NewUpdateRoles == null || empty($request->NewUpdateRoles)) {
        return redirect()->route('/');
    }
        
    $cekUpdate = $role->update(['name' => strtolower($request->NewUpdateRoles)]); //update role baru

    if ($cekUpdate) {
      return response()->json(['code' =>  '1',  'value' => $request->NewUpdateRoles]);
    }else{
      return response()->json(['code' => '2']);
    }

  }

  //del role
  public function DelRoles(Role $role, $id){

    $role = Role::findById($id); 
    $role->delete();

    return response()->json(['code' =>  '1']);

  }

}
