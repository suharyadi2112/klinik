<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

use App\Models\User;
use Spatie\Permission\models\Role;

use App\Helpers\Helper as HelperLog;

class ManageTransaction extends Controller
{

    public function __construct()
    {
        $this->middleware(['web']);
    }
    public function index(){
        
        // //param pertama subject dan kedua data request
        // HelperLog::addToLog('Show data role', json_encode($request->all()));
        // //Pasang Breadcrumbs 
        // $breadcrumbs = [
        //   ['link' => "/users/roles", 'name' => "Roles"], ['link' => "/users/roles", 'name' => "List Roles"], ['name' => "Dashboard Roles"],
        // ];
        // return view("/auth/users/roles",['breadcrumbs' => $breadcrumbs]);
    }
}
