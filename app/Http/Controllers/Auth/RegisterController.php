<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

use App\Models\User;

use Spatie\Permission\models\Role;
use Spatie\Permission\PermissionRegistrar;

use App\Helpers\Helper as HelperLog;

class RegisterController extends Controller
{
  /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

  use RegistersUsers;

  /**
   * Where to redirect users after registration.
   *
   * @var string
   */
  protected $redirectTo = RouteServiceProvider::HOME;

  /**
   * Create a new controller instance.
   *
   * @return void
   */

  // construct yang lama
  public function __construct()
  {
    // $this->middleware('guest'); //old middleware
    // akses users untuk super-admin dan admin
    $this->middleware(['role:super-admin|admin']);
  }


  /**
   * Get a validator for an incoming registration request.
   *
   * @param  array  $data
   * @return \Illuminate\Contracts\Validation\Validator
   */
  protected function validator(array $data)
  {
    return Validator::make($data, [
      'name' => ['required', 'string', 'max:255'],
      'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
      'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);
  }

  /**
   * Create a new user instance after a valid registration.
   *
   * @param  array  $data
   * @return \App\Models\User
   */
  protected function create(array $data)
  {
    return User::create([
      'name' => $data['name'],
      'email' => $data['email'],
      'password' => Hash::make($data['password']),
    ]);
  }

  //change password
  public function ChangePass(Request $request){

    $User = User::find(auth()->user()->id)->makeVisible(['password']);//field yang hidden untuk tampil
 
    $validator = Validator::make($request->all(), [
        'current_password' => 'required|max:50',
        'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
    ]);

    if ($validator->fails()) {
      return response()->json(['code' => '1', 'fail' => $validator->messages()->first()], 200);
    }else{

      if (Hash::check($request->current_password, $User->password)) {

          $SetNewPassword = Hash::make($request->password_confirmation);

          $User->password = $SetNewPassword;
          $User->updated_at = date('Y-m-d H:i:s');
          $Res = $User->save();

          if ($Res) {
            HelperLog::addToLog('Reset Password user', json_encode($request->except(['current_password']))); 
            Auth::logout();//instan logout
            return response()->json(['code' => '2'], 200);
          }

      }else{
          return response()->json(['code' => '3'], 200);
      }
    }
  }

  //reset pass
  public function ResetPass(Request $request){
    $id_users_login = auth()->user()->id;
    $userPass = User::find($request->id_user);

    if ($id_users_login == $userPass->id) {
      return response()->json(['code' => '1'], 200);
    }

    //default pass
    $passDefaultReset = "12345678";
    $HashPassDefault = Hash::make($passDefaultReset);

    $userPass->password = $HashPassDefault;
    $userPass->updated_at = date('Y-m-d H:i:s');
    $Res = $userPass->save();

    if ($Res) {
        //param pertama subject dan kedua data request
        HelperLog::addToLog('Reset Password user', json_encode(['id_user yang me-reset' => $request->id_user, 'yang di reset' => $id_users_login])); 
        return response()->json(['code' => '2'], 200);
    }
  }


  public function ShowUsers(Request $request){

    // 1 aktif 0 deactive 

    if ($request->ajax()) {
      $data = User::with('roles')->orderBy('created_at','DESC')->get();
      return DataTables::of($data)
          ->addIndexColumn()
          ->addColumn('roles', function($row){
              $showr = '';
              foreach ($row->roles as $key => $valueRole) {
                $showr .= $valueRole->name;
              }
              return $showr;
          })
         ->addColumn('action', function($row){
                  $actionBtn = '
                  <div class="dropdown">
                    <span class="bx bx-dots-vertical-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer"
                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu"></span>
                    <div class="dropdown-menu dropdown-menu-right">
                      <a class="dropdown-item UpUsers" data-id="'.$row->id.'" href="javascript:;"><i class="bx bx-edit-alt mr-1"></i> edit</a>
                      <a class="dropdown-item DeleteUser" data-id="'.$row->id.'" href="javascript:;"><i class="bx bx-trash-alt mr-1"></i> delete</a>
                      <a class="dropdown-item Status" data-id="'.$row->id.'" data-status="'.$row->status.'" href="javascript:;"><i class="bx bx-user-check mr-1"></i> status</a>
                      <a class="dropdown-item ResetPassword" data-id="'.$row->id.'" href="javascript:;"><i class="bx bx-reset mr-1"></i> Reset Pass</a>
                    </div>
                  </div>';
                  return $actionBtn;
          })
          ->rawColumns(['action'])
          ->make(true);
    }

    $getRole = Role::all();
    //param pertama subject dan kedua data request
    HelperLog::addToLog('Show data user', json_encode($request->all())); 

    return view('/auth/users/users-list', ["roless" => $getRole]);

  }

  //modal edit user
  public function ModalEdit(Request $request){

    // $user = User::find($request->id_user);
    $user = User::with('roles')->where('id','=', $request->id_user)->first();
    $getRole = Role::all();

    $modal = '';
    $modal .= '<div class="modal-body" >
                <div class="form-group">
                      <label class="form-label" for="basic-default-name">Name</label>
                      <input type="hidden" class="form-control" value="'.$user->id.'" id="basic-default-name" name="id" placeholder="John Doe"/>
                      <input type="text" class="form-control" value="'.$user->name.'" id="basic-default-name" name="name" placeholder="John Doe"/>
                  </div>
                  <div class="form-group">
                      <label class="form-label" for="basic-default-username">Username</label>
                      <input type="text" class="form-control" value="'.$user->username.'" id="basic-default-username" name="username" placeholder="Username" />
                  </div>
                  <div class="form-group">
                      <label class="form-label" for="basic-default-email">Email</label>
                      <input type="text" id="basic-default-email" value="'.$user->email.'" name="email" class="form-control" placeholder="john.doe@email.com" />
                  </div>
                  <div class="form-group">
                      <label for="select-country">Role</label>
                      <select class="form-control" id="select-roless" name="roless">
                        <option value="">Select Roles</option>';
                        foreach($getRole as $valrole){
    $modal .=           '<option value="'.$valrole->name.'" '.(($valrole->name==$user->roles[0]->name)?'selected':"").'>'.$valrole->name.'</option>';
                        }
    $modal .=        '</select>
                  </div>
                </div>';

      return response()->json(['modalUpdate' => $modal], 200);

  }

  public function UpdateUsers(Request $request){

    $validator = Validator::make($request->all(), [
        'name' => 'required|max:255',
        'username' => 'required|string|alpha_dash|max:50|unique:users,username,'.$request->id,
        'email' => 'required|unique:users,email,'.$request->id,
        'roless' => 'required'
    ]);

    if ($validator->fails()) {
      return response()->json(['code' => '1', 'fail' => $validator->messages()->first()], 200);
    }else{

    // reset cache permission
    app()[PermissionRegistrar::class]->forgetCachedPermissions();
    $user = User::find($request->id);
     
    $user->name = $request->name;
    $user->username = $request->username;
    $user->email = $request->email;
    $user->updated_at = date('Y-m-d H:i:s');
    $user->save();
    
    $user->syncRoles($request->roless);

    //param pertama subject dan kedua data request
    HelperLog::addToLog('Update data user', json_encode($request->all())); 

    return response()->json(['code' => '2'], 200);
    }

  }

  public function StatusChange(Request $request){

    $validator = Validator::make($request->all(), [
        'id_user' => 'required',
    ]);
    if ($validator->fails()) {
      return response()->json(['code' => '1', 'fail' => $validator->messages()->first()], 200);
    }else{
      $user = User::find($request->id_user);
      if ($user->status == 1) {
        $user->status = 0; 
      }elseif($user->status == 0){
        $user->status = 1; 
      }
      $user->save();//simpan data
      //param pertama subject dan kedua data request
      HelperLog::addToLog('Change status data user', json_encode($request->all())); 
      return response()->json(['code' => '2'], 200);
    }

  }

  public function DeleteUser(Request $request){

    $validator = Validator::make($request->all(), [
        'id_user' => 'required',
    ]);

    if ($validator->fails()) {
      return response()->json(['code' => '1', 'fail' => $validator->messages()->first()], 200);
    }else{
      $user = User::find($request->id_user);

      if ($user) {
        $user->delete();
        $user->roles()->detach();
        //param pertama subject dan kedua data request
        HelperLog::addToLog('Delete data user', json_encode($request->all())); 
        return response()->json(['code' => '2'], 200);

      }else{
        return response()->json(['code' => '3'], 200);
      }
    }
    
  }

  public function PostUsers(Request $request){

    $validator = Validator::make($request->all(), [
        'name' => 'required|max:255',
        'username' => 'required|string|alpha_dash|max:50|unique:users,username,'.$request->id,
        'email' => 'required|email|unique:users',
        'roless' => 'required',
        'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
        'password_confirmation' => 'min:6'
    ]);


    if ($validator->fails()) {
      return response()->json(['code' => '1', 'fail' => $validator->messages()->first()], 200);
    }else{

      // reset cache permission
      app()[PermissionRegistrar::class]->forgetCachedPermissions();

      $user = User::create([
          'name' => $request->name,
          'username' => $request->username,
          'email' => $request->email,
          'password' => Hash::make($request->password),
          'created_at' => date('Y-m-d H:i:s'),
          'status' => 1,
      ]);
      $user->assignRole($request->roless);
      //param pertama subject dan kedua data request
      HelperLog::addToLog('Created data user', json_encode($request->except(['password', 'password_confirmation']))); 
      return response()->json(['code' => '2'], 200);

    }

  }

  // Register old
  public function showRegistrationForm()
  {
    $pageConfigs = ['bodyCustomClass' => 'bg-full-screen-image blank-page', 'navbarType' => 'hidden'];

    return view('/auth/register', [
      'pageConfigs' => $pageConfigs
    ]);
  }
}
