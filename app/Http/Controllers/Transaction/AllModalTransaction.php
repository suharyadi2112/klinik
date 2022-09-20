<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
}
