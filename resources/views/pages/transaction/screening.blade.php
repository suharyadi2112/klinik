@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Screening')
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

@if(auth()->user()->can('view screening')/* && $some_other_condition*/)
<!-- add result laboratorium -->
<section class="add_registration-list-wrapper">
  <div class="add_registration-list-table">
    <div class="card ">
      <div class="card-body">
      	<form id="InsertRegistration" data-route="{{ route('InsertRegistration') }}" role="form" method="POST" accept-charset="utf-8">
        {{-- start form --}}
      	<div class="row match-height">
          <div class="col-12">
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
				<div class="form-body">
                  	<h6 class="card-title">Medical check up data</h6>
                      <div class="row">

                      	{{-- Medical Check Up Data --}}

                      	  <div class="col-md-4 col-12">
                          	<label for="registration-date">Date of exam <code>Registration Date</code></label>
                          		<div class="position-relative has-icon-left">
                                  <input type="date" value="{{ $databasic->pentgl }}" name="date_registration" id="" class="form-control" placeholder="Registration Data" readonly>
                                  <div class="form-control-position">
                                      <i class="bx bx-calendar"></i>
                                  </div>
                              </div>
                          </div>
		              	  <div class="col-md-4 mb-1">
                            <label for="certification">Certification</label>
                              <div class="position-relative has-icon-left">
                                  <textarea class="form-control" id="certification" name="certification" placeholder="leave certification" aria-label="certification"></textarea>
                                  <div class="form-control-position">
                                    <i class='bx bx-note'></i>
                                  </div>
                              </div>
                          </div>
                          <div class="col-md-4 mb-1">
                            <label for="certification">Remark exam/medical history</label>
                              <div class="position-relative has-icon-left">
                                  <textarea class="form-control" id="remarkexam" name="remarkexam" placeholder="leave remark exam" aria-label="remark exam"></textarea>
                                  <div class="form-control-position">
                                    <i class='bx bx-note'></i>
                                  </div>
                              </div>
                          </div>

                        </div>

                        <hr>
                        {{-- Then futher examination was conduted --}}
	                    
	                    <h6 class="card-title">Then futher examination was conduted</h6>
	                    <div class="row">
	                  
                      	  <div class="col-md-4 col-12">
                          	<label for="doctor name">Doctor's Name</label>
                          		<div class="position-relative has-icon-left">
                                  <input type="text" value="{{ $users->name }}" name="doctor_name" id="" class="form-control" placeholder="Doctor name" readonly>
                                  <div class="form-control-position">
                                      <i class="bx bx-user"></i>
                                  </div>
                              </div>
                          </div>
		              	  

                      </div>

                      


                  	</div>
              	
              	</div>
		   	</div>
		  {{-- endform --}}
		  <hr>
		  <div class="col-12 d-flex justify-content-end p-0 m-0">
              <a href="{{ route('ViewLaboratorium') }}"><button type="button" class="btn btn-warning mr-1"><i class='bx bx-arrow-back' ></i> Back</button></a>
              <button type="submit" class="btn btn-outline-primary mr-0 btn_insert_registration"><i class='bx bx-plus-circle' ></i> Submit</button>
          </div>
          </form>
      </div>
    </div>
  </div>
</section>
<!-- add result laboratorium -->
@else
<div class="col-xl-7 col-md-8 col-12">
    <div class="card bg-transparent shadow-none">
      <div class="card-body text-center">
        <img src="{{asset('images/pages/not-authorized.png')}}" class="img-fluid" alt="not authorized" width="400">
        <h1 class="my-2 error-title">You are not authorized!</h1>
        <p>
            You do not have permission to view this directory or page using
            the credentials that you supplied.
        </p>
        <a href="{{asset('/')}}" class="btn btn-primary round glow mt-2">BACK TO MAIN DASHBOARD</a>
      </div>
    </div>
</div>
@endif

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
