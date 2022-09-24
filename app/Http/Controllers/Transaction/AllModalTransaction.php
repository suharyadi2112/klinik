<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;

class AllModalTransaction extends Controller
{
    public function __construct()
    {
        $this->middleware(['web']);
    }

    public function ModalPatient(){

        $modal = '';
        $modal .=   '<div class="modal-body p-1">
                        <div class="table-responsive">
                          <table id="patient-list" class="table table-striped table-sm table-hover" width="100%">
                            <thead>
                              <tr>
                                <th>Identity</th>
                                <th>ID Identity</th>
                                <th>Name</th>
                                <th>Date Of Birth</th>
                                <th>Gender</th>
                                <th>Phone</th>
                                <th>#</th>
                              </tr>
                            </thead>
                          </table>
                        </div>
                    </div>';

        return $modal;
    }

    public function ModalPartner(){

        $modal = '';
        $modal .=   '<div class="modal-body p-1">
                        <div class="table-responsive">
                          <table id="partner-list" class="table table-striped table-sm table-hover" width="100%">
                            <thead>
                              <tr>
                                <th>Partner Name</th>
                                <th>Partner Alamat</th>
                                <th>#</th>
                              </tr>
                            </thead>
                          </table>
                        </div>
                    </div>';

        return $modal;
    }

    public function ModalActionCode(){

        $modal = '';
        $modal .=   '<div class="modal-body p-1">
                        <div class="table-responsive">
                          <table id="action-code-list" class="table table-striped table-sm table-hover" width="100%">
                            <thead>
                              <tr>
                                <th>Kode Tindakan</th>
                                <th>Kategori Tindakan</th>
                                <th>Tindakan</th>
                                <th style="text-align: center;"><i class="bx bx-cog"></i></th>
                              </tr>
                            </thead>
                          </table>
                        </div>
                    </div>';

        return $modal;
    }

    public function TabelActionRegistration($id, $restndkel, $type){

        $user = User::with('roles')->where('id','=', auth()->user()->id)->first();//get role user
        
        $table = '';
        $table .=   '<div class="table-responsive">
                      <table class="table table-striped table-sm table-hover" width="100%">
                        <thead>
                          <tr>
                              <th>No</th>
                              <th>Action Code</th>
                              <th>Action Category</th>
                              <th>Action</th>';
                              if ($user->can('view price')) {
          $table .=             '<th>Price</th>
                                <th>Discount (%)</th>
                                <th>Discount Price</th>';
                              }
          $table .=           '<th>Description</th>
                              <th style="text-align: center;"><i class="bx bx-cog"></i></th>
                          </tr>
                        </thead>
                        <tbody>';
                        $no = 1;
                        foreach ($restndkel as $key => $value) {
                     
        $table .=   '     <tr>
                            <td>'.$no.'</td>
                            <td>'.$value->tndklrtndid.'</td>
                            <td>'.$value->kattndnama.'</td>
                            <td>'.$value->tndnama.'</td>';
                            if ($user->can('view price')) {
        $table .=             '<td>'.$value->tndklrharga.'</td>
                              <td>'.$value->tndklrdiskon.'</td>
                              <td>'.$value->tndklrdiskonprice.'</td>';
                            }
                            
        $table .=           '<td>'.$value->tndnote.'</td>
                            <td>

                              <button class="btn btn-xs btn-outline-danger p-0 DelTindakanKeluar" data_id="'.$value->tndklrid.'" data_type="'.$type.'"><i class="bx bx-trash"></i></button>

                            </td>
                          </tr>';

                        $no++;
                        }

        $table .=   '   </tbody>
                      </table>
                    </div>';

        return $table;
    }
}