@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Users List')
{{-- vendor styles --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/buttons.bootstrap4.min.css')}}">
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

{{-- vendor scripts --}}
@section('vendor-scripts')
<script src="{{asset('vendors/js/tables/datatable/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/buttons.bootstrap4.min.js')}}"></script>


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

@endsection
