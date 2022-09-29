@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Laboratorium')
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
<!-- screening list start -->
<section class="screening-list-wrapper">
  <div class="screening-list-table">
    <div class="card">
      <div class="card-body">
        <!-- datatable start -->
        @if (session('error'))
		    <div class="alert alert-danger">
		        {{ session('error') }}
		    </div>
		@endif
        <div class="table-responsive">
          <table id="screening-list-datatable" class="table table-striped table-sm table-hover" width="100%">
            <thead>
             	<tr>
             		<th>No</th>
                	<th>Registration Number</th>
                	<th>NIK</th>
                	<th>Registration Date</th>
                	<th>Patient Name</th>
                	<th>Partner</th>
                	<th>Reference Date</th>
                	<th>Type Of Billing</th>
                	<th>Action</th>
                	<th>Billing</th>
                	<th>Account Receivable</th>
                	<th style="text-align: center;"><i class="bx bx-cog"></i></th>
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

<script type="text/javascript">

</script>

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

$(document).ready(function(){
	var dt = $('#screening-list-datatable').DataTable({
	    processing: true,
	    ordering: true,
	    serverSide: true,
	    ajax: "{{ route('Screening',['id_registration' => $id_pen]) }}",
	    columns: [
	    {data: 'DT_RowIndex', name: 'DT_RowIndex'}, 
        {data: 'penid', name: 'penid'},
        {data: 'pasnik', name: 'pasnik'},
        {data: 'pentgl', name: 'pentgl'},
        {data: 'pasnama', name: 'pasnama'},
        {data: 'pennama', name: 'pennama'},
        {data: 'pentglrujukan', name: 'pentglrujukan'},
        {data: 'pemnama', name: 'pemnama'},
        {data: 'action', name: 'action'},
        {data: 'bayar', name: 'bayar'},
        {data: 'bayar', name: 'bayar'},
        {data: 'bayar', name: 'bayar'},
	    ],
	    createdRow:function(row,data,index){
	    	$('td',row).eq(5).attr("nowrap","nowrap");
	    	$('td',row).eq(5).css("text-align","center");
		}
	});
});

</script>
@endsection
