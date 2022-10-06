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
      	{{-- <form id="InsertRegistration" data-route="{{ route('InsertRegistration') }}" role="form" method="POST" accept-charset="utf-8"> --}}
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


              <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link ChangeTab" tujuan="home-tab" id="home-tab" data-toggle="tab" href="#home" aria-controls="home" role="tab" aria-selected="true">
                        <i class='bx bx-band-aid align-middle'></i>
                        <span class="align-middle">Reassessment Health</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link ChangeTab" tujuan="profile-tab" id="profile-tab" data-toggle="tab" href="#profile" aria-controls="profile" role="tab" aria-selected="false">
                        <i class='bx bxs-first-aid align-middle'></i>
                        <span class="align-middle">Health Screening</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link ChangeTab" tujuan="about-tab" id="about-tab" data-toggle="tab" href="#about" aria-controls="about" role="tab" aria-selected="false">
                        <i class='bx bx-first-aid align-middle'></i>
                        <span class="align-middle">Health Screening 2</span>
                    </a>
                </li>
              </ul>
              <div class="tab-content p-0">
                  <div class="tab-pane home-tab" id="home" aria-labelledby="home-tab" role="tabpanel">
                    <form id="UpdateScreeningSatu" data-route="{{ route('UpdateScreeningSatu',['id_regis' => $id_res_encrypt]) }}" role="form" method="POST" accept-charset="utf-8">
                    <div class="form-body">
                    <h6 class="card-title">Medical check up data</h6>
                      <div class="row">

                        {{-- Medical Check Up Data --}}

                          <div class="col-md-4 col-12">
                            <label for="registration-date">Date of exam <code>Registration Date</code></label>
                              <div class="position-relative has-icon-left">
                                  <input type="date" value="{{ $databasic->pentgl }}" name="date_registration" class="form-control" placeholder="Registration Data" readonly>
                                  <div class="form-control-position">
                                      <i class="bx bx-calendar"></i>
                                  </div>
                              </div>
                          </div>
                          <div class="col-md-4 mb-1">
                            <label for="certification">Certification</label>
                              <div class="position-relative has-icon-left">
                                  <textarea class="form-control" id="certification" name="certification" placeholder="leave certification" aria-label="certification">@if($GetScrReassessment){{ $GetScrReassessment->certification }}@endif</textarea>
                                  <div class="form-control-position">
                                    <i class='bx bx-note'></i>
                                  </div>
                              </div>
                          </div>
                          <div class="col-md-4 mb-1">
                            <label for="certification">Remark exam/medical history</label>
                              <div class="position-relative has-icon-left">
                                  <textarea class="form-control" id="remarkexam" name="remarkexam" placeholder="leave remark exam" aria-label="remark exam">@if($GetScrReassessment){{ $GetScrReassessment->remark_exam }}@endif</textarea>
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
                                  <input type="text" value="{{ $users->name }}" name="doctor_name" class="form-control" placeholder="Doctor name" readonly>
                                  <div class="form-control-position">
                                      <i class="bx bx-user"></i>
                                  </div>
                              </div>
                          </div>
                          <div class="col-md-4 col-12">
                            <label for="date of exam">Date of exam <code>Reference Date</code></label>
                              <div class="position-relative has-icon-left">
                                  <input type="date" value="{{ $databasic->pentglrujukan }}" name="date_of_exam" class="form-control" placeholder="Date of exam" readonly>
                                  <div class="form-control-position">
                                      <i class="bx bx-calendar"></i>
                                  </div>
                              </div>
                          </div>
                          <div class="col-md-4 col-12 mb-1">
                            <label for="place of exam">Place of exam</label>
                              <div class="position-relative has-icon-left">
                                  <input type="text" value="Laboratorium Klinik Osmaro" name="place_of_exam" class="form-control" placeholder="Place of exam" readonly>
                                  <div class="form-control-position">
                                      <i class="bx bx-home"></i>
                                  </div>
                              </div>
                          </div>

                          <div class="col-md-4 mb-1">
                            <label for="conclusion/remark">Conclusion/Remark</label>
                              <div class="position-relative has-icon-left">
                                  <textarea class="form-control" name="conclusion_remark" placeholder="leave remark exam" aria-label="remark exam">@if($GetScrReassessment){{ $GetScrReassessment->conclusion_remark }}@endif</textarea>
                                  <div class="form-control-position">
                                    <i class='bx bxs-info-circle'></i>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <hr>

                      {{-- Recertification --}}
                      
                      <h6 class="card-title">Recertification & Advice</h6>
                      <div class="row">
                    
                          <div class="col-md-6 mb-1">
                            <label for="recertification">Recertification</label>
                              <div class="position-relative has-icon-left">
                                  <textarea class="form-control" name="recertification" placeholder="leave recertification" aria-label="recertification">@if($GetScrReassessment){{ $GetScrReassessment->recertification }}@endif</textarea>
                                  <div class="form-control-position">
                                    <i class='bx bxs-certification'></i>
                                  </div>
                              </div>
                          </div>

                          <div class="col-md-6 mb-1">
                            <label for="advice">advice</label>
                              <div class="position-relative has-icon-left">
                                  <textarea class="form-control" name="advice" placeholder="leave advice" aria-label="advice">@if($GetScrReassessment){{ $GetScrReassessment->advice }}@endif</textarea>
                                  <div class="form-control-position">
                                    <i class='bx bxs-smile'></i>
                                  </div>
                              </div>
                          </div>
                      
                      </div>
                    </div>
                    <button type="submit" class="btn btn-info PrintSatu"><i class='bx bx-printer'></i> Update & Print</button>
                  </form>
                  </div>

                  <div class="tab-pane profile-tab" id="profile" aria-labelledby="profile-tab" role="tabpanel">
                      <p>
                          Health Screening 
                      </p>
                  </div>
                  <div class="tab-pane about-tab" id="about" aria-labelledby="about-tab" role="tabpanel">
                      <p>
                          Health Screening 2
                      </p>
                  </div>
              </div>
				     
              </div>
		   	</div>
		  {{-- endform --}}
		  <hr>
      <div class="col-12 d-flex justify-content-end p-0 m-0">
        <div class="shadow-lg p-1 bg-white rounded">
            <a href="{{ route('ViewLaboratorium') }}"><button type="button" class="btn btn-warning mr-1"><i class='bx bx-arrow-back' ></i> Back</button></a>
            <button type="submit" class="btn btn-outline-primary mr-0 btn_insert_registration"><i class='bx bx-printer'></i> Print All Report Screening</button>
        </div>
      </div>
      {{-- </form> --}}
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

/*---------------------update reassessment health report------------------------*/
$(document).on('submit', '#UpdateScreeningSatu', function(e) {
    e.preventDefault();
    var route = $('#UpdateScreeningSatu').data('route');
    var form_data = $(this);
    $.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
    Pace.track(function(){
      Pace.restart();
      $.ajax({
          type: 'POST',
          url: route,
          data: form_data.serialize(),
          beforeSend: function() {
            $('.PrintSatu').prop('disabled', true);
          },
          success: function(data) {
            switch (data.code) {
              case "1":
                ToastToB.fire({icon: 'error',title: data.fail})
              break;
              case "2":
                ToastToB.fire({icon: 'success',title: 'Succes update Reassessment Health Report'})
                setInterval(function () {window.location.href = "{{ route('PrintReassessmentHealth',['id_regis' => $id_res_encrypt])}}";}, 3000);
              break;
              case "3":
                ToastToB.fire({icon: 'error',title: 'Insert Registration Failed'})
              break;
              default:
              break;
            }
           },
          complete: function() {
            $('.PrintSatu').prop('disabled', false);
          },
          error: function(data,xhr) {
            alert("Failed response")
          },
      });
  });
});


//--------------- setingan active tab--------------------//
$(document).ready(function() {
  // Get saved data from sessionStorage
  let selectedCollapse = sessionStorage.getItem('selectedCollapse');
  if(selectedCollapse != null) {
    $('.accordion .collapse .nav-link .tab-pane').removeClass('active');
    $("#"+selectedCollapse).addClass('active');
    $("."+selectedCollapse).addClass('active');
  }
  //To set, which one will be opened
  $(document).on("click", ".ChangeTab", function () {
    let target = $(this).attr('tujuan');
    //Save data to sessionStorage
    sessionStorage.setItem('selectedCollapse', target);
  });
});

</script>
@endsection
