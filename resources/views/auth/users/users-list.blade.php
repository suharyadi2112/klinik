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
          <table id="users-list-datatable" class="table border-top table-hover" width="100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Status</th>
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
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                      <button type="submit" class="insertus btn btn-primary">Simpan</button>
                 	</div>

                 	</form>
                        {{-- tutup form --}}
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
	            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
	            {data: 'name', name: 'name'},
	            {data: 'username', name: 'username'},
	            {data: 'email', name: 'email'},
	            {data: 'roles', name: 'roles'},
	            {data: 'status', name: 'status', 
	            	render: function(type, row, data){
	            		if(data.status == 1){
	            			return '<span class="badge badge-light-success">active</span>';
	            		}else{
	            			return '<span class="badge badge-secondary">deactive</span>';
	            		}
		            }
		        },
	          
	        ],
	        createdRow:function(row,data,index){$('td',row).eq(4).attr("nowrap","nowrap");}
	    });
	});

</script>

@endsection

{{-- page scripts --}}
@section('page-scripts')
{{-- <script src="{{asset('js/scripts/pages/app-users.js')}}"></script> --}}

<script type="text/javascript">

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
