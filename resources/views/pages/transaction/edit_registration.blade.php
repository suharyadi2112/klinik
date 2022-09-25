@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Registration')
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
<!-- edit registration list start -->
<section class="edit_registration-list-wrapper">
  <div class="edit_registration-list-table">
    <div class="card">
      <div class="card-body">
      	
      	{{-- start form --}}
      	<div class="row match-height">
          <div class="col-12">
              <div class="card">
                  <div class="card-header">
                      <h4 class="card-title">Registration</h4>
                  </div>
                  <div class="card-body">
                      <form id="EditRegistrationMain" data-route="{{ route('EditRegistrationMain') }}" role="form" method="POST" accept-charset="utf-8">
                          <div class="form-body">
                              <div class="row">
                              	<input type="hidden" value="{{ $id_enc }}" name="id_pennn" required readonly>
                                  <div class="col-md-6 col-12">
                                  	<label for="registration-date">Registration Date</label>
                                  		<div class="position-relative has-icon-left">
                                          <input type="date" value="{{ $data->pentgl }}" name="date_registration" id="" class="form-control" placeholder="Registration Data" readonly>
                                          <div class="form-control-position">
                                              <i class="bx bx-calendar"></i>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-md-6 mb-1">
                                  	<label for="Patient">Patient</label>
                                      <div class="input-group form-label-group position-relative has-icon-left">
                                      	  <input type="hidden" class="form-control" id="form_pick_patient_id" value="{{ $data->penpasid }}" name="patient" placeholder="pick patient" aria-label="Patient" readonly>
                                      	  <input type="text" class="form-control" id="form_pick_patient"  value="{{ $data->pasnama }}" placeholder="pick patient" aria-label="Patient" readonly>
	                                  	    <div class="form-control-position">
	                                          <i class="bx bx-user"></i>
                                          </div>
                                          <div class="input-group-append">
                                              <button class="btn btn-primary ShowPatient" type="button"><i class="bx bx-search-alt"></i></button>
                                              <button class="btn btn-outline-success" type="button"><i class="bx bx-user-plus"></i></button>
                                          </div>
                                      </div>
                                  </div>

                                  <div class="col-md-6 mb-1">
                                  	<label for="Reference date">Referance Date</label>
                                      <div class="position-relative has-icon-left">
                                      	  <input type="date" class="form-control" id="form_reference_date" value="{{ $data->pentglrujukan }}" name="reference_date" placeholder="pick reference date" aria-label="Reference Date">
	                                  	    <div class="form-control-position">
	                                          <i class='bx bx-calendar'></i>
                                          </div>
                                      </div>
                                  </div>

                                  <div class="col-md-6 mb-1">
                                  	<label for="Partner">Partner</label>
                                      <div class="input-group form-label-group position-relative has-icon-left">
                                      	  <input type="hidden" class="form-control"  value="{{ $data->penpengid }}" id="form_pick_partner_id" name="partner" placeholder="pick patient" aria-label="Partner" readonly>
                                      	  <input type="text" class="form-control" value="{{ $data->pennama }}" id="form_pick_partner" placeholder="pick partner" aria-label="Partner" readonly>
	                                  	    <div class="form-control-position">
	                                          <i class='bx bxs-group'></i>
                                          </div>
                                          <div class="input-group-append">
                                              <button class="btn btn-primary ShowPartner" type="button"><i class="bx bx-search-alt"></i></button>
                                              <button class="btn btn-outline-success" type="button"><i class="bx bx-user-plus"></i></button>
                                          </div>
                                      </div>
                                  </div>

                                  <div class="col-md-6 mb-1">
                                  	<label for="type-of-billing">Type Of Billing</label>
                                    			<select class="billing_of_type form-control" name="billing_of_type">
                                    				<option value="{{ $data->penpemid }}" selected>{{ $data->pemnama }}</option>
                                    			</select>
	                                </div>
                                  
                                  <div class="col-12 d-flex justify-content-end">
                                      <a href="{{ route('IndexRegistration') }}"><button type="button" class="btn btn-warning mr-1"><i class='bx bx-arrow-back' ></i> Back</button></a>
                                      <button type="submit" class="btn btn-outline-primary mr-1 btn_updates_registration"><i class='bx bx-edit' ></i> Update</button>
                                  </div>
                              </div>
                          </div>
                      	</form>
	                  	</div>
	              	</div>
		         	 </div>
		      	</div>
		      	{{-- endform --}}
      </div>
    </div>
  </div>
</section>
<!-- registration list ends -->

{{-- list patient --}}
<div class="modal fade" id="ModalListPatient" data-keyboard="false" data-backdrop="static">  
	<div class="modal-dialog modal-lg">
		<div class="modal-content" id="modal-content">
			<div class="row">
				<div class="col-lg-12">
					<div class="modal-header bg-primary p-1">
						<h5 class="modal-title white" id="staticBackdropLabel">List Patient</h5> 
						<button type="button" class="close btn-sm" data-dismiss="modal" aria-label="Close"> 
							<span aria-hidden="true">&times;</span> 
						</button>
					</div>
						{{-- render modal --}}
						<div id="RenderListPatient"></div>

						<div class="modal-footer">
	              <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
	          </div>
				</div>
			</div>
		</div>
	</div>
</div>


{{-- list partner --}}
<div class="modal fade" id="ModalListPartner" data-keyboard="false" data-backdrop="static">  
	<div class="modal-dialog modal-lg">
		<div class="modal-content" id="modal-content">
			<div class="row">
				<div class="col-lg-12">
					<div class="modal-header bg-primary p-1">
						<h5 class="modal-title white" id="staticBackdropLabel">List Partner</h5> 
						<button type="button" class="close btn-sm" data-dismiss="modal" aria-label="Close"> 
							<span aria-hidden="true">&times;</span> 
						</button>
					</div>
						{{-- render modal --}}
						<div id="RenderListPartner"></div>

						<div class="modal-footer">
	              <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
	          </div>
				</div>
			</div>
		</div>
	</div>
</div>

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

	//list patient
	$(document).on("click", ".ShowPatient", function () {
		$.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
		Pace.track(function(){
			$.post( '{{ route('ShowModalPatient') }}')
			  .done(function( data ) {
				  	switch (data.code) {
		         	case "1":
		         	$("#RenderListPatient").html(data.modal);
		  				$("#ModalListPatient").modal("show");
			  				//datatable
						    var table = $('#patient-list').DataTable({
						        processing: true,
						        ordering: false,
						        serverSide: true,
						        ajax: "{{ route('GetListPatient') }}",
						        columns: [
						            {data: 'pasidentitas', name: 'pasidentitas'},
						            {data: 'pasnik', name: 'pasnik'},
						            {data: 'pasnama', name: 'pasnama'},
						            {data: 'pastgllahir', name: 'pastgllahir'},
						            {data: 'pasjk', name: 'pasjk'},
						            {data: 'pastlp', name: 'pastlp'},
							        	{data: 'action', name: 'action'},
						        ],
						        createdRow:function(row,data,index){
						        	$('td',row).eq(3).attr("nowrap","nowrap");
						    	}
						    });
						    $(document).on("click", ".PickPatient", function () {
						    		var id_patient = $(this).attr('val_id_patient');
						    		var name_patient = $(this).attr('val_name_patient');
						    		if (id_patient && name_patient) {
						    			$("#form_pick_patient_id").val(id_patient);
						    			$("#form_pick_patient").val(name_patient);
						    			$("#ModalListPatient").modal("hide");
						    		}
						    });
						break;
					  default:
	          break;
	        }
			  })
			  .fail(function() { alert( "error" );})
		});
	});

	//list partner 
	$(document).on("click", ".ShowPartner", function () {
		$.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
		Pace.track(function(){
			$.post( '{{ route('ShowModalPartner') }}')
			  .done(function( data ) {
				  	switch (data.code) {
		         	case "1":
		         	$("#RenderListPartner").html(data.modal);
		  				$("#ModalListPartner").modal("show");
			  				//datatable
						    var table = $('#partner-list').DataTable({
						        processing: true,
						        ordering: false,
						        serverSide: true,
						        ajax: "{{ route('GetListPartner') }}",
						        columns: [
						            {data: 'pennama', name: 'pennama'},
						            {data: 'penalamat', name: 'penalamat'},
							        	{data: 'action', name: 'action'},
						        ],
						        createdRow:function(row,data,index){
						        	$('td',row).eq(3).attr("nowrap","nowrap");
						    	}
						    });
						    $(document).on("click", ".PickPartner", function () {
						    		var id_partner = $(this).attr('val_id_partner');
						    		var name_partner = $(this).attr('val_name_partner');
						    		if (id_partner && name_partner) {
						    			$("#form_pick_partner_id").val(id_partner);
						    			$("#form_pick_partner").val(name_partner);
						    			$("#ModalListPartner").modal("hide");
						    		}
						    });
						break;
					  default:
	          break;
	        }
			  })
			  .fail(function() { alert( "error" );})
		});
	});

	// list type of billing
	$('.billing_of_type').select2({
	  placeholder: 'Select billing',
	  ajax: {
	    url: '{{ route('ListTypeOfBilling') }}',
	    dataType: 'json',
	    delay: 250,
	    processResults: function (data) {
	      return {
	        results:  $.map(data, function (item) {
	              return {
	                  text: item.pemnama,
	                  id: item.pemid
	              }
	          	})
		      	};
		   		},
	    	cache: true
	  	}
	});

	/*---------------------post update registration------------------------*/
	$(document).on('submit', '#EditRegistrationMain', function(e) {
	    e.preventDefault();
	    var route = $('#EditRegistrationMain').data('route');
	    var form_data = $(this);
	    $.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
	  	Pace.track(function(){
		  	$.ajax({
		        type: 'POST',
		        url: route,
		        data: form_data.serialize(),
		        beforeSend: function() {
		        	$('.btn_updates_registration').prop('disabled', true);
		        },
		        success: function(data) {
					   	switch (data.code) {
				        case "1":
									ToastToB.fire({icon: 'error',title: data.fail})
								break;
								case "2":
									ToastToB.fire({icon: 'success',title: 'Update Registration Success, page will redirect to Registration Dashboard'})
									setInterval(function () {window.location.href = "{{ route('IndexRegistration')}}";}, 3000);
								break;
								case "3":
									ToastToB.fire({icon: 'error',title: 'Update Registration Failed'})
								break;
		            default:
		            break;
				      }
			       },
		        complete: function() {
		        	$('.btn_updates_registration').prop('disabled', false);
		        },
		        error: function(data,xhr) {
		        	alert("Failed response")
		        },
		    });
		});
	});

</script>
@endsection
