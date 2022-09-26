@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Add Result Laboratorium')
{{-- vendor styles --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/buttons.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/forms/select/select2.min.css')}}">

{{-- sweetalert2 --}}
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- pace --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pace-js@latest/pace-theme-default.min.css">

@endsection
@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/app-users.css')}}">
@endsection
@section('content')
<!-- add result laboratorium -->
<section class="add_registration-list-wrapper">
  <div class="add_registration-list-table">
    <div class="card ">
      <div class="card-body">
      	
      	{{-- start form --}}
      	<div class="row match-height">
          <div class="col-12">
                  <div class="card-header p-0">
                      <h4 class="card-title">Add Result Laboratorium</h4>
                  </div>
                  <hr>
                   <div class="row">
					            <div class="col-sm-4 col-12">
					                <h6><small class="text-muted">Registration Date</small></h6>
					                <p><b>{{ $databasic->pentgl }}</b></p>
					            </div>
					            <div class="col-sm-4 col-12">
					                <h6><small class="text-muted">Reference Date</small></h6>
					                <p><b>{{ $databasic->pentglrujukan }}</b></p>
					            </div>
					            <div class="col-sm-4 col-12">
					                <h6><small class="text-muted">Patient Name</small></h6>
					                <p><b>{{ $databasic->pasnama }}</b></p>
					            </div>
					            <div class="col-sm-4 col-12">
					                <h6><small class="text-muted">Partner</small></h6>
					                <p><b>{{ $databasic->pennama }}</b></p>
					            </div>
					            <div class="col-sm-4 col-12">
					                <h6><small class="text-muted">Type Of Billing</small></h6>
					                <p><b>{{ $databasic->pemnama }}</b></p>
					            </div>
					        </div>
					        <hr>
                      <form id="InsertResultLaboratorium" data-route="{{ route('InsertResultLaboratorium') }}" role="form" method="POST" accept-charset="utf-8">
                          <div class="form-body">
                              <div class="row">
                              	<div class="table table-responsive">
                                  
                                  <table class="table table-striped table-sm" width="100%">
																	  <thead class="thead-dark">
																	    <tr>
																	      <th scope="col">No</th>
																	      <th scope="col">Action Code</th>
																	      <th scope="col">Result</th>
																	      <th scope="col">Action</th>
																	      <th scope="col">Action Category</th>
																	      <th scope="col">Lab</th>
																	      <th scope="col">Unit</th>
																	      <th scope="col">Normal Value</th>
																	    </tr>
																	  </thead>
																	  <tbody>
																	  	@php $no = 1; @endphp
																	  	@forelse($data as $key => $ValRes)
																	    <tr>
																	      <td>{{ $no + $key}}</td>
																	      <td>{{ $ValRes->tndklrtndid  }}</td>
																	      <td>
																	      		
					                                  <div class="input-group form-label-group position-relative has-icon-left mt-1">
					                                  		<input type="text" class="form-control" id="result" placeholder="result number" aria-label="result" name="result" readonly>
					                                  	    <div class="form-control-position">
					                                          <i class='bx bx-plus-medical'></i>
					                                      </div>
					                                      <div class="input-group-append">
					                                          <button class="btn btn-primary" type="button"><i class="bx bx-upload"></i></button>
					                                      </div>
					                                  </div>

																	      </td>
																	      <td>{{ $ValRes->kattndnama  }}</td>
																	      <td>{{ $ValRes->tndnama  }}</td>
																	      <td>{{ $ValRes->katlabnama }}</td>
																	      <td>{{ $ValRes->katlabsat  }}</td>
																	      <td>{{ $ValRes->katlabnilai }}</td>
																	    </tr>
																	    @empty
																	    <tr>
																	      <th scope="row" colspan="10">Data Not Found</th>
																	    </tr>
																	    @endforelse
																	  </tbody>
																	</table>
																</div>

                                  <div class="col-12 d-flex justify-content-end">
                                      <a href="{{ route('ViewLaboratorium') }}"><button type="button" class="btn btn-warning mr-1"><i class='bx bx-arrow-back' ></i> Back</button></a>
                                  </div>
                              </div>
                          </div>
                      	</form>
	              	</div>
		         	 </div>
		      	{{-- endform --}}
      </div>
    </div>
  </div>
</section>
<!-- registration list ends -->

@endsection

{{-- vendor scripts --}}
@section('vendor-scripts')
<script src="{{asset('vendors/js/tables/datatable/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('vendors/js/forms/select/select2.full.min.js') }}"></script>
@endsection

{{-- page scripts --}}
@section('page-scripts')

<script type="text/javascript">

//top end notif
const ToastToB = Swal.mixin({
	toast: true,
	position: 'top-end',
	showConfirmButton: false,
	timer: 3000,
	timerProgressBar: true,
didOpen: (toast) => {
		toast.addEventListener('mouseenter', Swal.stopTimer)
		toast.addEventListener('mouseleave', Swal.resumeTimer)
	}
})


</script>
@endsection
