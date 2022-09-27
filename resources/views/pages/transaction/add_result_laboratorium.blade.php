@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Add Result Laboratorium')
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
<!-- add result laboratorium -->
<section class="add_registration-list-wrapper">
  <div class="add_registration-list-table">
    <div class="card ">
      <div class="card-body">
      	
      	{{-- start form --}}
      	<div class="row match-height">
          <div class="col-12">
                  <div class="card-header p-0">
                      <h4 class="card-title">Add Result Laboratorium</h4>
                  </div>
                  <hr>
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
                      <div class="form-body">
                          <div class="row">
                          	<div class="table table-responsive">
                              
                              <table id="TableForLab" class="table table-striped" width="100%">
															  <thead class="thead-dark">
															    <tr>
															      <th scope="col">Action Code</th>
															      <th scope="col">Result</th>
															      <th scope="col">Action</th>
															      <th scope="col">Action Category</th>
															      <th scope="col">Lab</th>
															      <th scope="col">Unit</th>
															      <th scope="col">Normal Value</th>
															    </tr>
															  </thead>
															</table>
														</div>

                              <div class="col-12 d-flex justify-content-end">
                                  <a href="{{ route('ViewLaboratorium') }}"><button type="button" class="btn btn-warning mr-1"><i class='bx bx-arrow-back' ></i> Back</button></a>
                              </div>
                          </div>
                      </div>
	              	</div>
		         	 </div>
		      	{{-- endform --}}
      </div>
    </div>
  </div>
</section>
<!-- add result laboratorium -->

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

$(document).ready(function(){
		var dt = $('#TableForLab').DataTable({
		    processing: true,
		    ordering: false,
		    lengthChange: false,
		    searching: false,
		    serverSide: true,
		    ajax: "{{ route('InputResultLaboratorium',['id_registration' => $id_pen]) }}",
		    columns: [
		    	{data: 'tndklrtndid', name: 'tndklrtndid'},
		        {data: 'action', name: 'action'},
		        {data: 'kattndnama', name: 'kattndnama'},
		        {data: 'tndnama', name: 'tndnama'},
		      	{data: 'katlabnama', name: 'katlabnama'},
		      	{data: 'katlabsat', name: 'katlabsat'},
		      	{data: 'katlabnilai', name: 'katlabnilai'},
		    ],
		    createdRow:function(row,data,index){
		    	$('td',row).eq(1).attr("nowrap","nowrap");
			}
		});
	});

//send request status
$(document).on("click", ".InsertUpdateResult", async function () {
	var data_katlabid = $(this).attr("data_katlabid");
	var data_idresult = $(this).attr("data_idresult");
	const { value: result } = await Swal.fire({
	  title: 'Input Result',
	  input: 'number',
	  inputLabel: 'Result',
	  inputPlaceholder: 'Enter your result',
	})

	if (result) {
	  Pace.track(function(){
			Pace.restart();
			$.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
	  	$.ajax({
	        type: 'POST',
	        url: '{{ route('InsertResultLaboratorium',['id_registration' => $id_pen]) }}',
	       	data: {
					  resultdata : result,
					  kategori_labor : data_katlabid,
					  id_result : data_idresult,
					},
	        beforeSend: function() {},
	        success: function(data) {
				   	switch (data.code) {
			        case "1":
			        	ToastToB.fire({icon: 'error',title: data.fail})
							break;
							case "2":
								ToastToB.fire({icon: 'success',title: 'Success insert result'})
								$('#TableForLab').DataTable().ajax.reload();
							break;
							case "3":
								ToastToB.fire({icon: 'error',title: 'insert result failed'})
							break;
	            default:
	            break;
				      }
		       },
	        complete: function() {
	        	$('.SendRequest').prop('disabled', false);
	        },
	        error: function(data,xhr) {
	        	alert("Failed response")
	        },
	    });
		});
	}

});


</script>
@endsection
