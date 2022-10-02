@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Action Registration')
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

@if(auth()->user()->can('view action registration')/* && $some_other_condition*/)
<!-- action registration list start -->
<section class="action_registration-list-wrapper">
  <div class="action_registration-list-table">
    <div class="card">
      <div class="card-body">
      	{{-- start form --}}
      	<div class="row match-height">
          	<div class="col-12">
          		<div class="card">
          			<h5 class="card-title">Basic details</h5>
			        <div class="row">
			            <div class="col-sm-4 col-12">
			                <h6><small class="text-muted">Registration Date</small></h6>
			                <p><b>{{ $dataregistration->pentgl }}</b></p>
			            </div>
			            <div class="col-sm-4 col-12">
			                <h6><small class="text-muted">Reference Date</small></h6>
			                <p><b>{{ $dataregistration->pentglrujukan }}</b></p>
			            </div>
			            <div class="col-sm-4 col-12">
			                <h6><small class="text-muted">Patient Name</small></h6>
			                <p><b>{{ $dataregistration->pasnama }}</b></p>
			            </div>
			            <div class="col-sm-4 col-12">
			                <h6><small class="text-muted">Partner</small></h6>
			                <p><b>{{ $dataregistration->pennama }}</b></p>
			            </div>
			            <div class="col-sm-4 col-12">
			                <h6><small class="text-muted">Type Of Billing</small></h6>
			                <p><b>{{ $dataregistration->pemnama }}</b></p>
			            </div>
			        </div>

			      <hr>
			      <div class="shadow-lg p-1 mb-1 bg-white rounded">
	                  <h4 class="card-title">Action Input Registration</h4>
	                  <form id="InsertRegistrationAction" data-route="{{ route('InsertRegistrationAction') }}" role="form" method="POST" accept-charset="utf-8">
	                      <div class="form-body">
	                          <div class="row">

	                          		<input type="hidden" class="form-control" id="pendaftaran_id" value="{{ $dataregistration->penid }}" aria-label="Patient" name="pendaftaran_id" readonly>

	                          		<div class="col-md-3 mb-1">
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

	                              	<div class="col-md-3 col-12">
	                              	<label for="action-category">Action Category</label>
	                              		<div class="position-relative has-icon-left">
	                                      <input type="hidden" name="action_category" id="action_category_id" class="form-control" placeholder="action category" readonly>
	                                      <input type="text" id="action_category" class="form-control" placeholder="action category" readonly>
	                                      <div class="form-control-position">
	                                          <i class='bx bxs-search-alt-2'></i>
	                                      </div>
	                                  </div>
	                              	</div>
	                             	
	                              	<div class="col-md-3 col-12">
	                              	<label for="action">Action</label>
	                              		<div class="position-relative has-icon-left">
	                                      <input type="hidden" name="action_id" id="action_id" class="form-control" placeholder="action" readonly>
	                                      <input type="text" name="action" id="action" class="form-control" placeholder="action" readonly>
	                                      <div class="form-control-position">
	                                          <i class='bx bxs-search-alt-2'></i>
	                                      </div>
	                                  </div>
	                              	</div>
                            
	                              	<div class="col-md-3 col-12" @if(auth()->user()->can('view price')) @else style="display:none;" @endif>
	                              	<label for="price">Price</label>
	                              		<div class="position-relative has-icon-left">
	                                      <input type="text" name="price" id="price" class="form-control" placeholder="price" readonly>
	                                      <div class="form-control-position">
	                                          <i class='bx bx-money'></i>
	                                      </div>
	                                  </div>
	                              	</div>

	                              	<div class="col-md-3 col-12" @if(auth()->user()->can('view price')) @else style="display:none;" @endif>
	                              	<label for="discount">Discount (%)</label>
	                              		<div class="position-relative has-icon-left">
	                                      <input type="text" name="discount" id="" class="form-control"  placeholder="discount" readonly>
	                                      <div class="form-control-position">
	                                          <i class='bx bxs-discount'></i>
	                                      </div>
	                                  </div>
	                              	</div>
	                              	
	                              	<div class="col-md-3 col-12" @if(auth()->user()->can('view price')) @else style="display:none;" @endif>
	                              	<label for="discount-price">Discount Price</label>
	                              		<div class="position-relative has-icon-left">
	                                      <input type="text" name="discount_price" id="discount_price" class="form-control" placeholder="discount price" readonly>
	                                      <div class="form-control-position">
	                                          <i class='bx bxs-discount'></i>
	                                      </div>
	                                  </div>
	                              	</div>

	                              	<div class="col-md-3 col-12">
	                              		<label for="discount-price">#</label>
	                              		<div class="position-relative has-icon-left">
	                              			<button type="submit" class="insertact btn btn-outline-primary pl-1 pr-1"><i class='bx bx-chevrons-down'></i></button>
	                              			<button type="button" class="btn btn-warning pl-1 pr-1"><i class='bx bx-reset' ></i></button>
	                              		</div>
	                              	</div>
	                              
	                              
	                          </div>
	                      	</div>
	                  	</form>
	                  	<hr>
	                  	<div id="RenderTindakanKeluar">

	              		</div>
	              	</div>
	         	</div>
		    </div>
      	</div>
    </div>

    <div class="card">
	    <div class="card-body">
	      {{-- main content --}}
	    </div>
	</div>

  </div>
</section>
<!-- action registration list ends -->
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
						    var table = $('#action-code-list').DataTable({
						        processing: true,
						        ordering: false,
						        serverSide: true,
						        ajax: "{{ route('GetListActionCode') }}",
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

						    	$("#form_pick_action_code_id").val(tndid);
						    	$("#action_category_id").val(tndkattndid);
						    	$("#action_category").val(kattndnama);
						    	$("#action").val(tndnama);
						    	$("#price").val(tndharga);
						    	$("#discount_price").val(tndharga);

						    	$("#ModalListActionCode").modal("hide");
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

	function GetTableActionRegister(){
		$.get("{{ route('TableTindakanKeluar',['id_registration' => $id]) }}", function(data, status){
		    $("#RenderTindakanKeluar").html(data.tabel);
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

	/*---------------------post insert action registration------------------------*/
	$(document).on('submit', '#InsertRegistrationAction', function(e) {
	    e.preventDefault();
	    var route = $('#InsertRegistrationAction').data('route');
	    var form_data = $(this);
	    $.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
	  	Pace.track(function(){
		  	$.ajax({
		        type: 'POST',
		        url: route,
		        data: form_data.serialize(),
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

</script>
@endsection
