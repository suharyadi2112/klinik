<?php

namespace App\Http\Controllers\ManageCategory;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class ManageCategory extends Controller
{
    
    public function __construct()
    {
        // $this->middleware('guest'); //old middleware
        // akses users untuk super-admin dan admin
        $this->middleware(['role:super-admin|admin']);
    }

    //dashboard role
    public function ShowCategory(Request $request){

     //    if ($request->ajax()) {
     //        $data = Role::all();
     //        return DataTables::of($data)
     //            ->addIndexColumn()
     //            ->addColumn('action', function($row){
     //                $actionBtn = '<button type="button" class="btn btn-sm round btn-info upRole" vall="'.$row->name.'" data-id="'.$row->id.'">edit</button>
     //                            <button type="button" class="btn btn-sm btn-outline-danger round delRole" data-id="'.$row->id.'">del</button>';
     //                return $actionBtn;
     //            })
     //            ->rawColumns(['action'])
     //            ->make(true);
	    // }

	    return view("/pages/category");
  	}
}
