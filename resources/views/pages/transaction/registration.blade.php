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
{{-- page styles --}}
@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/app-users.css')}}">
@endsection
@section('content')
<!-- registration list start -->
<section class="registration-list-wrapper">
  <div class="registration-list-table">
    <div class="card">
      <div class="card-body">
        <!-- datatable start -->
        <div class="table-responsive">
        	<a href="{{ route('AddRegistration') }}" title="add registration"><button type="button" class="btn btn-primary round addregistration"><i class="bx bx-plus-circle"></i> Registration</button></a>
        <hr>
          <table id="registration-list-datatable" class="table table-striped table-sm table-hover" width="100%">
            <thead>
             	<tr>
                	<th>No</th>
                	<th>Registration Date</th>
                	<th>Reference Date</th>
                	<th>Patient Name</th>
                	<th>NIK</th>
                	<th>Partner</th>
                	<th>Type Of Billing</th>
                	<th><th><i class="bx bx-cog"></i></th></th>
            	</tr>
            </thead>
          </table>
        </div>
        <!-- datatable ends -->
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

<script src="{{asset('vendors/js/forms/select/select2.full.min.js')}}"></script>

<script type="text/javascript">

</script>

@endsection

{{-- page scripts --}}
@section('page-scripts')

<script type="text/javascript">
	$(document).ready(function(){
		var table = $('#registration-list-datatable').DataTable({
		    processing: true,
		    ordering: false,
		    // serverSide: true,
		    ajax: "{{ route('IndexRegistration') }}",
		    columns: [
		    	{data: 'DT_RowIndex', name: 'DT_RowIndex'},
		        {data: 'pentgl', name: 'pentgl'},
		        {data: 'pentglrujukan', name: 'pentglrujukan'},
		        {data: 'pentglrujukan', name: 'pentglrujukan'},
		        {data: 'pasnama', name: 'pasnama'},
		        {data: 'pasnik', name: 'pasnik'},
		        {data: 'pennama', name: 'pennama'},
		        {data: 'pemnama', name: 'pemnama'},
		        {data: 'action', name: 'action'},
		    ],
		    createdRow:function(row,data,index){
		    	$('td',row).eq(3).attr("nowrap","nowrap");
			}
		});
	});

</script>
@endsection
