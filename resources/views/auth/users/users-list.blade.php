@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Users List')
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
{{-- page styles --}}
@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/app-users.css')}}">
@endsection
@section('content')
<!-- users list start -->
<section class="users-list-wrapper">
  <div class="users-list-table">
    <div class="card">
      <div class="card-body">
        <!-- datatable start -->
        <div class="table-responsive">
        <button type="button" class="btn btn-primary round addusers"><i class="bx bx-plus-circle"></i> Create users</button>
        <hr>
          <table id="users-list-datatable" class="table table-striped table-sm table-hover" width="100%">
            <thead>
              <tr>
                <th>Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Status</th>
                <th><i class="bx bx-cog"></i></th>
              </tr>
            </thead>
          </table>
        </div>
        <!-- datatable ends -->
      </div>
    </div>
  </div>
</section>

<!-- users list ends -->
@endsection

{{-- modal insert users --}}
<div class="modal fade" id="ModalInsertUser" data-keyboard="false" data-backdrop="static">  
	<div class="modal-dialog ">
		<div class="modal-content" id="modal-content">
			<div class="row">
				<div class="col-lg-12">
					<div class="modal-header bg-info p-2">
						<h5 class="modal-title white" id="staticBackdropLabel">Insert Users</h5> 
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
							<span aria-hidden="true">&times;</span> 
						</button>
					</div>
					<form id="FormInsertUsers" data-route="{{ route('PostUsers') }}" role="form" method="POST" accept-charset="utf-8">
					<div class="modal-body" >
					    <div class="form-group">
                            <label class="form-label" for="basic-default-name">Name</label>
                            <input type="text" class="form-control" id="basic-default-name" name="name" placeholder="John Doe"/>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="basic-default-username">Username</label>
                            <input type="text" class="form-control" id="basic-default-username" name="username" placeholder="Username" />
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="basic-default-email">Email</label>
                            <input type="text" id="basic-default-email" name="email" class="form-control" placeholder="john.doe@email.com" />
                        </div>
                        <div class="form-group">
                            <label for="select-country">Role</label>
                            <select class="form-control" id="select-roless" name="roless">
                            	<option value="">Select Roles</option>
                                @forelse($roless as $key => $valroles)
                               		<option value="{{ $valroles->name }}">{{ $valroles->name }}</option>
                               	@empty
                               		<option value="">Data not found</option>
                               	@endforelse
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="basic-default-password">Password</label>
                            <input type="password" id="basic-default-password" name="password" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="confirm-password">Confirm Password</label>
                            <input type="password" id="confirm-password" name="password_confirmation" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                        </div>
                        
					</div>
					<div class="modal-footer">
                      <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                      <button type="submit" class="insertus btn btn-primary"><i class='bx bx-upload' ></i> Insert</button>
                 	</div>

                 	</form>
                        {{-- tutup form --}}
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="ModalUpdateUser" data-keyboard="false" data-backdrop="static">  
	<div class="modal-dialog">
		<div class="modal-content" id="modal-content">
			<div class="row">
				<div class="col-lg-12">
					<div class="modal-header bg-primary p-2">
						<h5 class="modal-title white" id="staticBackdropLabel">Update Users</h5> 
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
							<span aria-hidden="true">&times;</span> 
						</button>
					</div>
					<form id="FormUpdateUsers" data-route="{{ route('UpdateUsers') }}" role="form" method="POST" accept-charset="utf-8">		
						{{-- render modal --}}
						<div id="RenderFormUpdateUser"></div>

						<div class="modal-footer">
			              <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
			              <button type="submit" class="updateus btn btn-primary"><i class='bx bx-pencil' ></i> Update</button>
			          </div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

{{-- vendor scripts --}}
@section('vendor-scripts')
<script src="{{asset('vendors/js/tables/datatable/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/buttons.bootstrap4.min.js')}}"></script>

<script src="{{asset('vendors/js/forms/select/select2.full.min.js')}}"></script>
<script src="{{asset('vendors/js/forms/validation/jquery.validate.min.js')}}"></script>

<script type="text/javascript">
	$(document).ready(function(){
	    //datatable
	    var table = $('#users-list-datatable').DataTable({
	        processing: true,
	        ordering: false,
	        serverSide: true,
	        ajax: "{{ route('GetListUsers') }}",
	        columns: [
	            {data: 'name', name: 'name'},
	            {data: 'username', name: 'username'},
	            {data: 'email', name: 'email'},
	            {data: 'roles', name: 'roles'},
	            {data: 'status', name: 'status', 
	            	render: function(type, row, data){
	            		if(data.status == 1){
	            			return '<span class="badge badge-light-success">active</span>';
	            		}else if(data.status == 0){
	            			return '<span class="badge badge-secondary">deactive</span>';
	            		}
		            }
		        },
		        {data: 'action', name: 'action'},
	        ],
	        createdRow:function(row,data,index){
	        	$('td',row).eq(0).attr("nowrap","nowrap");
	        	$('td',row).eq(3).attr("nowrap","nowrap");
	    	}
	    });
	});

</script>

@endsection

{{-- page scripts --}}
@section('page-scripts')
{{-- <script src="{{asset('js/scripts/pages/app-users.js')}}"></script> --}}

<script type="text/javascript">

//top end notif
const Toast = Swal.mixin({
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

// 1 aktif 0 deactive 
/*---------------------Change status users------------------------*/
$(document).on("click", ".Status", function () {
	var id = $(this).attr('data-id');
	var status = $(this).attr('data-status');
	if (status == 0) { statuss = 'deactive'; }else if(status == 1){ statuss = 'active'; }else if(status == 2){
		statuss = 'delete';
	}
	$.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
	Pace.track(function(){
		 Swal.fire({
		  title: 'Change status user '+statuss+' ?',
		  showCancelButton: true,
		  confirmButtonText: 'Yes',
		}).then((result) => {
		  if (result.isConfirmed) {
		  	$.post( '{{ route('StatusChange') }}', { id_user : id })
			  .done(function( data ) {
			  	switch (data.code) {
	                case "1":
						Toast.fire({ icon: 'error', title: data.fail})
					break;
					case "2":
						Toast.fire({ icon: 'success', title: 'Change status Success'})
						$('#users-list-datatable').DataTable().ajax.reload();//reload datatable
					break;
	                default:
	                break;
	            }
			  	Toast.fire({ icon: 'success', title: 'Status Change'})
			  })
			  .fail(function() { alert( "error" );})
		  	}
		});
	});
});

/*---------------------get modal edit users------------------------*/
$(document).on("click", ".UpUsers", function () {
	var id = $(this).attr('data-id')
	$.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
	Pace.track(function(){
		$.post( '{{ route('ModalEdit') }}', { id_user : id })
		  .done(function( data ) {
		  	$("#RenderFormUpdateUser").html(data.modalUpdate);
		  	$("#ModalUpdateUser").modal("show");
		  })
		  .fail(function() { alert( "error" );})
	});
});
/*---------------------post modal update users------------------------*/

$(document).on('submit', '#FormUpdateUsers', function(e) {
    e.preventDefault();
    var route = $('#FormUpdateUsers').data('route');
    var form_data = $(this);
    $.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
  	Pace.track(function(){
	  	$.ajax({
	        type: 'POST',
	        url: route,
	        data: form_data.serialize(),
	        beforeSend: function() {
	        	$('.updateus').prop('disabled', true);
	        },
	        success: function(data) {
			   	switch (data.code) {
	                case "1":
						Toast.fire({
							icon: 'error',
							title: data.fail
						})
					break;
					case "2":
						Toast.fire({
							icon: 'success',
							title: 'Update Success'
						})
					break;
	                default:
	                break;
	            }
	        },
	        complete: function() {
	            $('#users-list-datatable').DataTable().ajax.reload();
	            $('.updateus').prop('disabled', false);
	        },
	        error: function(data,xhr) {
	        	alert("Failed response")
	        },
	    });
	});
});

// 1 aktif 0 deactive 

/*-----------------delete arship users--------------------*/
$(document).on("click", ".DeleteUser", function () {
	var id = $(this).attr('data-id')
	Swal.fire({
	  title: 'Delete this user ?',
	  showCancelButton: true,
	  confirmButtonColor: '#dc3741',
	  confirmButtonText: 'Delete',
	}).then((result) => {
	  if (result.isConfirmed) {
	  	$.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
	  	$.post( '{{ route('DeleteUser') }}', { id_user : id })
		  .done(function( data ) {
		  	switch (data.code) {
                case "1":
					Toast.fire({icon: 'error',title: data.fail })
				break;
				case "2":
					Toast.fire({ icon: 'success', title: 'Deleted!'})
				break;
				case "3":
					Toast.fire({ icon: 'warning', title: 'User not found'})
				break;
                default:
                break;
            }
		  })
		  .fail(function() { alert( "error" );})
		  .always(function() {
		  	$('#users-list-datatable').DataTable().ajax.reload();
		  });
	  } 
	})
});



/*---------------------insert users------------------------*/
$(document).on("click", ".addusers", function () {
	$("#ModalInsertUser").modal("show");
});

$(document).on('submit', '#FormInsertUsers', function(e) {
    e.preventDefault();
    var route = $('#FormInsertUsers').data('route');
    var form_data = $(this);
    $.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
  	$.ajax({
        type: 'POST',
        url: route,
        data: form_data.serialize(),
        beforeSend: function() {
        	$('.insertus').prop('disabled', true);
        },
        success: function(data) {
		   	switch (data.code) {
                case "1":
					Toast.fire({
						icon: 'error',
						title: data.fail
					})
				break;
				case "2":
					Toast.fire({
						icon: 'success',
						title: 'Insert Success'
					})
				break;
                default:
                break;
            }
        },
        complete: function() {
            $('#users-list-datatable').DataTable().ajax.reload();
            $('.insertus').prop('disabled', false);
        },
        error: function(data,xhr) {
        	alert("Failed response")
        },
    });
});

</script>
@endsection
