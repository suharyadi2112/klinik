@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Registration')
{{-- vendor styles --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/buttons.bootstrap4.min.css')}}">

{{-- sweetalert2 --}}
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- pace --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pace-js@latest/pace-theme-default.min.css">

@endsection
@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/app-users.css')}}">
@endsection
@section('content')
<!-- registration list start -->
<section class="add_registration-list-wrapper">
  <div class="add_registration-list-table">
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
                      <form class="form">
                          <div class="form-body">
                              <div class="row">
                                  <div class="col-md-6 col-12">
                                  	<label for="registration-date">Registration Date</label>
                                  		<div class="position-relative has-icon-left">
                                          <input type="date" value="{{ date('Y-m-d') }}" name="date_registration" id="" class="form-control" name="fname-icon" placeholder="Registration Data" readonly>
                                          <div class="form-control-position">
                                              <i class="bx bx-calendar"></i>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-md-6 mb-1">
                                  	<label for="Patient">Patient</label>
                                      <div class="input-group form-label-group position-relative has-icon-left">
                                      	  <input type="text" class="form-control" id="form_pick_patient" placeholder="pick patient" aria-label="Patient" readonly>
	                                  	    <div class="form-control-position">
	                                          <i class="bx bx-user"></i>
                                          </div>
                                          <div class="input-group-append">
                                              <button class="btn btn-primary ShowPatient" type="button"><i class="bx bx-search-alt"></i></button>
                                              <button class="btn btn-outline-success" type="button"><i class="bx bx-user-plus"></i></button>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-md-6 col-12">
                                  	<label for="Partner">Partner</label>
                                      <div class="form-label-group">
                                          <input type="text" id="Partner" class="form-control" placeholder="Partner" name="Partner">
                                          <label for="city-column">Partner</label>
                                      </div>
                                  </div>
                                  
                                  <div class="col-12 d-flex justify-content-end">
                                      <button type="submit" class="btn btn-primary mr-1">Submit</button>
                                      <button type="reset" class="btn btn-light-secondary">Reset</button>
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

@endsection

{{-- vendor scripts --}}
@section('vendor-scripts')
<script src="{{asset('vendors/js/tables/datatable/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/buttons.bootstrap4.min.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-scripts')

<script type="text/javascript">

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
						    			$("#form_pick_patient").val(id_patient);
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

	$(document).ready(function(){
	    
	});

</script>
@endsection
