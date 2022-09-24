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
<!-- registration list start -->
<section class="add_registration-list-wrapper">
  <div class="add_registration-list-table">
	{{-- start form --}}
	<div class="row match-height">
    <div class="col-12">
        <div class="card">
            <div class="card-header pt-1 pl-1">
                <h4 class="card-title">Registration</h4>
            </div>
            <hr class="mt-0 mb-0">
            <div class="card-body p-1">
            	<div class="shadow-lg p-1 mb-1 bg-white rounded">
                <form id="InsertRegistrationLead" data-route="{{ route('InsertRegistrationLead') }}" role="form" method="POST" accept-charset="utf-8">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6 col-12">
                            	<label for="registration-date">Registration Date</label>
                            		<div class="position-relative has-icon-left">
                                    <input type="date" value="{{ date('Y-m-d') }}" name="date_registration" class="form-control" placeholder="Registration Data" readonly>
                                    <div class="form-control-position">
                                        <i class="bx bx-calendar"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-1">
                            	<label for="Patient">Patient</label>
                                <div class="input-group form-label-group position-relative has-icon-left">
                                	  <input type="hidden" class="form-control" id="form_pick_patient_id" name="patient" placeholder="pick patient" aria-label="Patient" readonly>
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

                            <div class="col-md-6 mb-1">
                            	<label for="Reference date">Referance Date</label>
                                <div class="position-relative has-icon-left">
                                	  <input type="date" class="form-control" id="form_reference_date" name="reference_date" placeholder="pick reference date" aria-label="Reference Date">
                              	    <div class="form-control-position">
                                      <i class='bx bx-calendar'></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-1">
                            	<label for="Partner">Partner</label>
                                <div class="input-group form-label-group position-relative has-icon-left">
                                	  <input type="hidden" class="form-control" id="form_pick_partner_id" name="partner" placeholder="pick patient" aria-label="Partner" readonly>
                                	  <input type="text" class="form-control" id="form_pick_partner" placeholder="pick partner" aria-label="Partner" readonly>
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
                              			<select class="billing_of_type form-control" name="billing_of_type"></select>
                            </div>
                            
                            {{-- <div class="col-12 d-flex justify-content-end"> --}}
                            <div class="col-12">
                                {{-- <a href="{{ route('IndexRegistration') }}"><button type="button" class="btn btn-warning mr-1"><i class='bx bx-arrow-back' ></i> Back</button></a> --}}
                                <button type="submit" class="btn btn-outline-primary m-0 btn_insert_registration"><i class='bx bx-plus-circle' ></i> Submit</button>
                            </div>
                        </div>
                    </div>
                	</form>
                </div>

                <hr>

                {{-- form action --}}
				      	<div class="shadow-lg p-1 mb-1 bg-white rounded" id="pagar_action">
				      	<div class="row RenderBasicPatient">
			            
				        </div>
				        <hr>
	                 <h4 class="card-title">Action Input Registration</h4>
	                  <form id="InsertRegistrationActionLeads" data-route="{{ route('InsertRegistrationActionLeads') }}" role="form" method="POST" accept-charset="utf-8">
	                      <div class="form-body">
	                          <div class="row">

	                          		<div class="col-md-6 mb-1 mx-auto">
	                              	<label for="action-code">Action Code</label>
	                                  <div class="input-group form-label-group position-relative has-icon-left">
                                  		<input type="text" class="form-control" id="form_pick_action_code_id" placeholder="action code" aria-label="Patient" name="form_pick_action_code_id" readonly>
                                  	    <div class="form-control-position">
                                          <i class='bx bx-plus-medical'></i>
                                      </div>
                                      <div class="input-group-append">
                                          <button class="btn btn-primary ShowActionCode" type="button"><i class="bx bx-search-alt"></i></button>
                                      </div>
                                  </div>
                              	</div>
	                              
	                          </div>
	                      	</div>
                		</form>
                	<hr>
                	<div id="RenderTindakanKeluar">

            			</div>
            			<hr>

          				<div id="InsertFinal">	
          				</div>

	              	</div>
              	</div>
          	</div>
       	 </div>
    	</div>
    	{{-- endform --}}

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

{{-- list action code --}}
<div class="modal fade" id="ModalListActionCode" data-keyboard="false" data-backdrop="static">  
	<div class="modal-dialog modal-lg">
		<div class="modal-content" id="modal-content">
			<div class="row">
				<div class="col-lg-12">
					<div class="modal-header bg-primary p-1">
						<h5 class="modal-title white" id="staticBackdropLabel">List Action Code</h5> 
						<button type="button" class="close btn-sm" data-dismiss="modal" aria-label="Close"> 
							<span aria-hidden="true">&times;</span> 
						</button>
					</div>
						{{-- render modal --}}
						<div id="RenderListActionCode"></div>

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

if (localStorage.getItem('idPendaftar') !== null) {
	SetBasicPatient(localStorage.getItem("idPendaftar"))
}else{
	$("#pagar_action").css("display", "none");
}

function SetBasicPatient(lastinsertidregis){
		var urlgetbasic = '{{route("GetBasicRegistration", ":idpen")}}'.replace(":idpen", lastinsertidregis);
		$.get(urlgetbasic, function(data, status){
				if(data.databasic){
						basic = '<div class="col-sm-4 col-12">'+
		              		'<h6><small class="text-muted">Registration Date</small></h6>'+
		              		'<p><b>'+data.databasic.pentgl+'</b></p>'+
		          			'</div>'+
				            '<div class="col-sm-4 col-12">'+
				                '<h6><small class="text-muted">Reference Date</small></h6>'+
				                '<p><b>'+data.databasic.pentglrujukan+'</b></p>'+
				            '</div>'+
				            '<div class="col-sm-4 col-12">'+
				                '<h6><small class="text-muted">Patient Name</small></h6>'+
				                '<p><b>'+data.databasic.pasnama+'</b></p>'+
				            '</div>'+
				            '<div class="col-sm-4 col-12">'+
				                '<h6><small class="text-muted">Partner</small></h6>'+
				                '<p><b>'+data.databasic.pennama+'</b></p>'+
				            '</div>'+
				            '<div class="col-sm-4 col-12">'+
				                '<h6><small class="text-muted">Type Of Billing</small></h6>'+
				                '<p><b>'+data.databasic.pemnama+'</b></p>'+
				            '</div>';

				    $(".RenderBasicPatient").html(basic);
				    $("#pagar_action").css("display", "block");
				  return basic;
				}else{
					alert("data not found");
					localStorage.removeItem('idPendaftar');//hapus dahulu
					setInterval(function () {window.location.href = "{{ route('IndexRegistration')}}";}, 2000);
				}
		});
}

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

	/*--------------------get tabel tindakan keluar------------------------*/
	$(document).ready(function(){
		GetTableActionRegister();
	});


	$(document).on("click", ".SubmitFinishing", function () {
			$('.SubmitFinishing').prop('disabled', true);
			var data_idpendftr = $(this).attr('data_idpen');
			$.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
				Pace.track(function(){
					$.post( '{{ route('InsertRegisActionFinish') }}',  { id_pendftr: data_idpendftr }).done(function( data ) {
							switch (data.code) {
				      	case "2":
									ToastToB.fire({icon: 'success',title: 'Insert Success'})
									localStorage.removeItem('idPendaftar');//hapus dahulu
									setInterval(function () {window.location.href = "{{ route('IndexRegistration')}}";}, 2000);
								break;
								case "30":
									ToastToB.fire({icon: 'error',title: 'Insert Failed'})
									$('.SubmitFinishing').prop('disabled', false);
								break;
								case "31":
									ToastToB.fire({icon: 'warning',title: 'Insert just Patient success, after this you have to fill in the action'})
									localStorage.removeItem('idPendaftar');//hapus dahulu
									setInterval(function () {window.location.href = "{{ route('IndexRegistration')}}";}, 2000);
								break;
		            default:

									$('.SubmitFinishing').prop('disabled', false);
		            break;
				      }
					});
			});
	});		

	function GetTableActionRegister(){
		var idpennnn = localStorage.getItem('idPendaftar')
		var urll = '{{route("TableTindakanKeluarV2", ":id")}}'.replace(":id", idpennnn);
		$.get(urll, function(data, status){
		    $("#RenderTindakanKeluar").html(data.tabel);

		    //finishing submit
		    var buttonFinal = '<button data_idpen='+idpennnn+' class="btn btn-primary m-0 SubmitFinishing"><i class="bx bx-plus-circle" ></i> Submit Finishing Data</button>'

		    $("#InsertFinal").html(buttonFinal);

		    	//del tindakan keluar
				$(document).on("click", ".DelTindakanKeluar", function () {
					Swal.fire({
					  title: 'Are you sure?',
					  text: "You won't be able to revert this!",
					  icon: 'warning',
					  showCancelButton: true,
					  confirmButtonColor: '#3085d6',
					  cancelButtonColor: '#d33',
					  confirmButtonText: 'Yes, delete it!'
					}).then((result) => {
					  if (result.isConfirmed) {
				  		var data_id = $(this).attr('data_id');
							var data_type = $(this).attr('data_type');
							$.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
							Pace.track(function(){
								$.post( '{{ route('DelTindakanKeluar') }}',  { id: data_id, type: data_type }).done(function( data ) {
										switch (data.code) {
							        case "1":
												ToastToB.fire({icon: 'error',title: data.fail})
											break;
											case "2":
												ToastToB.fire({icon: 'success',title: 'Delete Success'})
												GetTableActionRegister();
											break;
											case "3":
												ToastToB.fire({icon: 'error',title: 'Delete Failed'})
											break;
					            default:
					            break;
							      }
								});
							});
					  }
					})
				});
		});
	}

	//list action code
	$(document).on("click", ".ShowActionCode", function () {
		$.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
		Pace.track(function(){
			$.post( '{{ route('ShowModalActionCode') }}')
			  .done(function( data ) {
				  	switch (data.code) {
		         	case "1":
		         		$("#RenderListActionCode").html(data.modal);
		  					$("#ModalListActionCode").modal("show");
			  				//datatable
			  				var idpennn = localStorage.getItem('idPendaftar')
			  				var urll = '{{route("GetListActionCodeV2", ":id")}}'.replace(":id", idpennn);
						    var table = $('#action-code-list').DataTable({
						        processing: true,
						        ordering: false,
						        serverSide: true,
						        ajax: urll,
						        columns: [
						            {data: 'tndid', name: 'tndid'},
						            {data: 'kattndnama', name: 'kattndnama'},
						            {data: 'tndnama', name: 'tndnama'},
							        	{data: 'action', name: 'action'},
						        ],
						        createdRow:function(row,data,index){
						        	$('td',row).eq(0).attr("nowrap","nowrap");
						        	$('td',row).eq(3).css("text-align","center");
						    	}
						    });
						    $(document).on("click", ".PickActionCode", function () {

					    				var tndid = $(this).attr('data-tndid');
								    	var tndnama = $(this).attr('data-tndnama');
								    	var tndkattndid = $(this).attr('data-tndkattndid');
								    	var kattndnama = $(this).attr('data-kattndnama');
								    	var tndharga = $(this).attr('data-tndharga');
						    	/*---------------------post insert action registration------------------------*/
						    			var idpenn = localStorage.getItem('idPendaftar')
									    $.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
									  	Pace.track(function(){
										  	$.ajax({
										        type: 'POST',
										        url: '{{ route('InsertRegistrationActionLeads') }}',
										       	data: {
																	  pendaftaran_id : idpenn,
										        				form_pick_action_code_id: tndid,
										        				action_category_id: tndkattndid,
										        				action_category: kattndnama,
										        				action: tndnama,
										        				price: tndharga, 
																	},
										        beforeSend: function() {
										        	$('.insertact').prop('disabled', true);
										        },
										        success: function(data) {
													   	switch (data.code) {
												        case "1":
																ToastToB.fire({icon: 'error',title: data.fail})
																break;
																case "2":
																	ToastToB.fire({icon: 'success',title: 'Insert Registration Success'})
																	GetTableActionRegister();
																	$('#action-code-list').DataTable().ajax.reload();
																break;
																case "3":
																	ToastToB.fire({icon: 'error',title: 'Insert Registration Failed'})
																break;
										            default:
										            break;
													      }
											       },
										        complete: function() {
										        	$('.insertact').prop('disabled', false);
										        },
										        error: function(data,xhr) {
										        	alert("Failed response")
										        },
										    });
										});
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

	/*---------------------post insert registration------------------------*/
	$(document).on('submit', '#InsertRegistrationLead', function(e) {
	    e.preventDefault();
	    var route = $('#InsertRegistrationLead').data('route');
	    var form_data = $(this);
	    $.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
	  	Pace.track(function(){
		  	$.ajax({
		        type: 'POST',
		        url: route,
		        data: form_data.serialize(),
		        beforeSend: function() {
		        	$('.btn_insert_registration').prop('disabled', true);
		        },
		        success: function(data) {
					   	switch (data.code) {
				        case "1":
									ToastToB.fire({icon: 'error',title: data.fail})
								break;
								case "2":
									ToastToB.fire({icon: 'success',title: 'Insert Registration Success, check the action form below'})

									localStorage.removeItem('idPendaftar');//hapus dahulu
									localStorage.setItem('idPendaftar', data.LastIdInsertPendaftaran);//set terbaru

									SetBasicPatient(data.LastIdInsertPendaftaran)
									GetTableActionRegister();
								
								break;
								case "3":
									ToastToB.fire({icon: 'error',title: 'Insert Registration Failed'})
								break;
		            default:
		            break;
				      }
			       },
		        complete: function() {
		        	$('.btn_insert_registration').prop('disabled', false);
		        },
		        error: function(data,xhr) {
		        	alert("Failed response")
		        },
		    });
		});
	});

</script>
@endsection
