@extends('layouts.contentLayoutMaster')
{{-- page Title --}}
@section('title','Dashboard')
{{-- vendor css --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/charts/apexcharts.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/extensions/swiper.min.css')}}">
@endsection
@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/dashboard-ecommerce.css')}}">
@endsection

@section('content')
<!-- Dashboard Ecommerce Starts -->
<section id="dashboard-ecommerce">
    <!-- Latest Update Starts -->
    <div class="row">
    <div class="col-xl-4 col-md-6 col-6">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center pb-50">
          <h4 class="card-title">Latest Register</h4>
          <div class="dropdown">
            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButtonSec"
              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Year
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButtonSec">
              @forelse ($listTahun as $itemTahun)
                <a class="dropdown-item" href="javascript:;">{{ $itemTahun->year }}</a>
              @empty
                <a class="dropdown-item">Tidak ada data</a>
              @endforelse
            </div>
          </div>
        </div> 
        <div class="card-body p-0 pb-1">
          <ul class="list-group list-group-flush">
            <li
              class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between">
              <div class="list-left d-flex">
                <div class="list-icon mr-1">
                  <div class="avatar bg-rgba-primary m-0">
                    <div class="avatar-content">
                      <i class="bx bxs-zap text-primary font-size-base"></i>
                    </div>
                  </div>
                </div>
                <div class="list-content">
                  <span class="list-title">Total Register</span>
                  <small class="text-muted d-block">50 New Register</small>
                </div>
              </div>
              <span>100</span>
            </li>

            <li
              class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between">
              <div class="list-left d-flex">
                <div class="list-icon mr-1">
                  <div class="avatar bg-rgba-primary m-0">
                    <div class="avatar-content">
                      <i class="bx bxs-check-circle text-success font-size-base"></i>
                    </div>
                  </div>
                </div>
                <div class="list-content">
                  <span class="list-title">Approve Register</span>
                  <small class="text-muted d-block">6 New Approved</small>
                </div>
              </div>
              <span>50</span>
            </li>

            <li
              class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between">
              <div class="list-left d-flex">
                <div class="list-icon mr-1">
                  <div class="avatar bg-rgba-primary m-0">
                    <div class="avatar-content">
                      <i class="bx bxs-arrow-to-right text-warning font-size-base"></i>
                    </div>
                  </div>
                </div>
                <div class="list-content">
                  <span class="list-title">Request Register</span>
                  <small class="text-muted d-block">5 New Request</small>
                </div>
              </div>
              <span>20</span>
            </li>

            <li
              class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between">
              <div class="list-left d-flex">
                <div class="list-icon mr-1">
                  <div class="avatar bg-rgba-info m-0">
                    <div class="avatar-content">
                      <i class="bx bx-arrow-to-right text-info font-size-base"></i>
                    </div>
                  </div>
                </div>
                <div class="list-content">
                  <span class="list-title">Requested Total</span>
                  <small class="text-muted d-block">39 New Requested</small>
                </div>
              </div>
              <span>25</span>
            </li>

            <li
            class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between">
            <div class="list-left d-flex">
              <div class="list-icon mr-1">
                <div class="avatar bg-rgba-primary m-0">
                  <div class="avatar-content">
                    <i class="bx bxs-comment-error text-danger font-size-base"></i>
                  </div>
                </div>
              </div>
              <div class="list-content">
                <span class="list-title">Rejected Register</span>
                <small class="text-muted d-block">2 New Rejected</small>
              </div>
            </div>
            <span>10</span>
          </li>
          
          </ul>
        </div>
      </div>
    </div>
    <!-- Earning Swiper Starts -->
    <!-- Marketing Campaigns Starts -->
    <div class="col-xl-8 col-8">
      <div class="card marketing-campaigns">
        <div class="card-header d-flex justify-content-between align-items-center pb-1">
          <h4 class="card-title">4 Last Recent Transaction</h4>
        </div>
        <div class="table-responsive">
          <!-- table start -->
          <table id="table-marketing-campaigns" class="table table-borderless table-marketing-campaigns mb-0">
            <thead>
              <tr>
                <th>Registration</th>
                <th>Patient</th>
                <th>Partner</th>
              </tr>
            </thead>
            <tbody>
              @forelse($dataTransaction as $itemTransaction)
              <tr>
                <td class="py-1"nowrap>
                  <div class="list-left d-flex">
                    <div class="list-icon mr-1">
                      <div class="avatar bg-rgba-primary m-0">
                        <div class="avatar-content">
                          <i class="bx bxs-time text-primary font-size-base"></i>
                        </div>
                      </div>
                    </div>
                  {{ $itemTransaction->pentgl }}
                  </div>
                </td>
                <td class="py-1">
                  <div class="list-left d-flex">
                    <div class="list-icon mr-1">
                      <div class="avatar bg-rgba-primary m-0">
                        <div class="avatar-content">
                          <i class="bx bxs-user text-info font-size-base"></i>
                        </div>
                      </div>
                    </div>
                  {{ $itemTransaction->pasnama }}
                  </div>
                </td>
                <td>
                  <div class="list-left d-flex">
                    <div class="list-icon mr-1">
                      <div class="avatar bg-rgba-primary m-0">
                        <div class="avatar-content">
                          <i class="bx bxs-send text-warning font-size-base"></i>
                        </div>
                      </div>
                    </div>
                  {{ $itemTransaction->pennama }}
                  </div>
                </td>
              </tr>
              @empty
              <tr>
                <td class="py-1" colspan="10">
                  <center>tidak ada data</center>
                </td>
              </tr>
              @endforelse
            </tbody>
          </table>
          <!-- table ends -->
        </div>
      </div>
    </div>
    </div>
  </div>
</section>
<!-- Dashboard Ecommerce ends -->
@endsection

@section('vendor-scripts')
<script src="{{asset('vendors/js/charts/apexcharts.min.js')}}"></script>
<script src="{{asset('vendors/js/extensions/swiper.min.js')}}"></script>
@endsection

@section('page-scripts')
<script src="{{asset('js/scripts/pages/dashboard-ecommerce.js')}}"></script>
@endsection
