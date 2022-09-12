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

use DB;

class ManagePermissions extends Controller
{
    // construct yang lama
    public function __construct()
    {
        // $this->middleware('guest'); //old middleware
        // akses users untuk super-admin dan admin
        $this->middleware(['role:super-admin|admin']);
    }

    public function index(){

     
    }
    public function GetPermission(Role $role, Request $request){

        $users = User::role('writer')->get();

        $res = DB::table('role_has_permissions')
        ->select(   'role_has_permissions.*',
                    'roles.name as name_roles', 'roles.guard_name as guard_name_roles','roles.id as id_roles',
                    'permissions.name as name_permission','permissions.guard_name as guard_name_permission', 'permissions.id as id_permission')
        ->join('roles', 'role_has_permissions.role_id','=','roles.id')
        ->join('permissions', 'role_has_permissions.permission_id','=','permissions.id')
        ->where('roles.name', '=', 'admin')
        ->get();
        // $users = user::with('permissions')->get();

        dd($res);

    }
}
