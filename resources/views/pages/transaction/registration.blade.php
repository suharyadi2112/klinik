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
        @if (session('error'))
		    <div class="alert alert-danger">
		        {{ session('error') }}
		    </div>
		@endif
        <div class="table-responsive">
        	<a href="{{ route('AddRegistration') }}" title="add registration"><button type="button" class="btn btn-primary round addregistration"><i class="bx bx-plus-circle"></i> Registration</button></a>
        	<a href="{{ route('AddRegistrationWithAction') }}" title="add registration with action"><button type="button" class="btn btn-outline-primary round"><i class="bx bx-plus-circle"></i> Regis With Action</button></a>
        <hr>
          <table id="registration-list-datatable" class="table table-striped table-sm table-hover" width="100%">
            <thead>
             	<tr>
             			<th style="text-align:center;"><i class='bx bx-expand'></i></th>
                	<th>Registration Date</th>
                	<th>Reference Date</th>
                	<th>Patient Name</th>
                	<th>Partner</th>
                	<th>Status</th>
                	<th style="text-align: center;"><i class='bx bx-cloud-upload'></i></th>
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

<script src="{{asset('vendors/js/forms/select/select2.full.min.js')}}"></script>

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

function tablechild(val){
	var table = '<div class="table table-responsive"><table class="table">'+
              '<thead class="thead-dark">'+
                '<tr>'+
                  '<th scope="col">action code</th>'+
                  '<th scope="col">action category</th>'+
                  '<th scope="col">action</th>'+
                  '<th scope="col">description</th>'+
                '</tr>'+
              '</thead>'+
              '<tbody>';
              if (val.data.length) {
              	for (var i = 0; i < val.data.length; i++) {
	table +=   '<tr>'+
	              '<td nowrap>'+val.data[i].tndid+'</td>'+
	              '<td nowrap>'+val.data[i].kattndnama+'</td>'+
	              '<td nowrap>'+val.data[i].tndnama+'</td>'+
	              '<td>'+val.data[i].tndnote+'</td>'+
	            '</tr>';
             	}
             }else{
    table +=   '<tr>'+
	              '<td colspan="10" style="text-align:center;">no have action registration</td>'+
	            '</tr>';
             }
    table += '</tbody>'+
            '</table></div>';

    return table;
}

function format ( d ) {
    return '<div class="slider">'+
				'<div class="card-body pb-0"><div class="row shadow-lg p-1 bg-white rounded">'+
				'<div class="col-sm-4 col-12">'+
          		'<h6><small class="text-muted">NIK</small></h6>'+
          		'<p><b>'+d.pasnik+'</b></p>'+
      			'</div>'+
            '<div class="col-sm-4 col-12">'+
                '<h6><small class="text-muted">Address</small></h6>'+
                '<p><b>'+d.pasalamat+'</b></p>'+
            '</div>'+
            '<div class="col-sm-4 col-12">'+
                '<h6><small class="text-muted">Register by</small></h6>'+
                '<p><b>'+d.name+'</b></p>'+
            '</div>'+
            '<div class="col-sm-4 col-12">'+
                '<h6><small class="text-muted">Type of Billing</small></h6>'+
                '<p><b>'+d.pemnama+'</b></p>'+
            '</div><div class="col-sm-4 col-12">'+
                '<h6><small class="text-muted">Description Send Request</small></h6>'+
                '<p><b>'+d.ket_request+'</b></p>'+
            '</div>'+
            '<div class="table table-responsive">'+tablechild(d.list_tindakankeluar)+'</div>'+
			'</div>'+
      '</div>'+
      '<div class="card-body pb-1"><div class="row shadow-lg p-1 bg-white rounded">'+
        '<div class="table table-responsive"><table class="table">'+
          '<thead class="thead-dark">'+
              '<tr>'+
                '<th scope="col">ket request</th>'+
                '<th scope="col">ket rejected</th>'+
                '<th scope="col">catatan</th>'+
                '<th scope="col">saran</th>'+
              '</tr>'+
          '</thead>'+
          '<tbody>'+
            '<tr><td>'+d.ket_request+'</td><td>'+d.ket_rejected+'</td><td>'+d.catatan+'</td><td>'+d.saran+'</td></tr>'
          '</tbody>'+
          '</table>'+
        '</div>'+
        '</div></div>'+
      '</div>';
}

	$(document).ready(function(){
		var dt = $('#registration-list-datatable').DataTable({
		    processing: true,
		    ordering: false,
		    serverSide: true,
		    ajax: "{{ route('IndexRegistration') }}",
		    columns: [
		    		{
                "class":          "details-control",
                "orderable":      false,
                "defaultContent": "",
            }, 
		        {data: 'pentgl', name: 'pentgl'},
		        {data: 'pentglrujukan', name: 'pentglrujukan'},
		        {data: 'pasnama', name: 'pasnama'},
		        {data: 'pennama', name: 'pennama'},
		        {data: 'status_request', name: 'status_request', 
	            	render: function(type, row, data){
	            		if(data.status_request == "request"){
	            			return '<span class="badge badge-light-warning" data-toggle="tooltip" data-placement="top" title="status is '+data.status_request+'" style="width:100px;">Request</span>';
	            		}else if(data.status_request == "requested"){
	            			return '<span class="badge badge-light-info" data-toggle="tooltip" data-placement="top" title="status is '+data.status_request+'" style="width:100px;">Requested</span>';
	            		}else if(data.status_request == "approved"){
	            			return '<span class="badge badge-light-success" data-toggle="tooltip" data-placement="top" title="status is '+data.status_request+'" style="width:100px;">Approved</span>';
	            		}else if(data.status_request == "rejected"){
	            			return '<span class="badge badge-light-danger" data-toggle="tooltip" data-placement="top" title="status is '+data.status_request+'" style="width:100px;">Rejected</span>';
	            		}else{
	            			return '<span class="badge badge-light-secondary" data-toggle="tooltip" data-placement="top" title="status is '+data.status_request+'" style="width:100px;">null</span>';
	            		}
		            }
		        },
		        {data: 'status_request', name: 'status_request', 
	            	render: function(type, row, data){
	            		if(data.status_request == "request"){
	            			return '<button type="button" class="btn btn-xs btn-icon glow btn-warning mr-1 SendRequest" data-toggle="tooltip" data-placement="top" title="Send Request" data_idpen="'+data.penid+'" status="'+data.status_request+'"><i class="bx bxs-right-arrow-circle"></i></button>';
	            		}else if(data.status_request == "requested"){
	            			return '<button type="button" class="btn btn-xs btn-icon glow btn-info mr-1 SendRequest" data-toggle="tooltip" data-placement="top" title="Approved or Reject this Request" data_idpen="'+data.penid+'" status="'+data.status_request+'"><i class="ficon bx bx-bell-plus bx-tada bx-flip-horizontal"></i></button>';
	            		}else if(data.status_request == "approved"){
	            			return '<button type="button" class="btn btn-xs btn-icon glow btn-success mr-1 SendRequest" data_idpen="'+data.penid+'" status="'+data.status_request+'" data-toggle="tooltip" data-placement="top" title="Approved"><i class="bx bx-check-circle"></i></button>';
	            		}else if(data.status_request == "rejected"){
                    return '<button type="button" class="btn btn-xs btn-icon glow btn-danger mr-0 SendRequest" data_idpen="'+data.penid+'" status="'+data.status_request+'" data-toggle="tooltip" data-placement="top" title="Rejected"><i class="bx bxs-error-circle"></i></button> | <button type="button" class="btn btn-xs btn-icon glow btn-dark mr-1 SendRequestAgain" data_ket_reject="'+data.ket_rejected+'" data_idpen="'+data.penid+'" status="'+data.status_request+'" data-toggle="tooltip" data-placement="top" title="See rejected message"><i class="ficon bx bxs-message-rounded-error bx-tada bx-flip-horizontal" ></i></button>';
	            		}else{
	            			return '<button type="button" class="btn btn-xs btn-icon glow btn-secondary mr-1" data-toggle="tooltip" data-placement="top" title="Status not found"><i class="bx bxs-right-arrow-circle"></i></button>';
	            		}
		            }
		        },
		        {data: 'action', name: 'action'},
		    ],
		    createdRow:function(row,data,index){
		    	$('td',row).eq(1).attr("nowrap","nowrap");
		    	$('td',row).eq(2).attr("nowrap","nowrap");
          $('td',row).eq(6).attr("nowrap","nowrap");
		    	$('td',row).eq(6).css("text-align","center");
			}
		});

		var detailRows = [];
 
      // Add event listener for opening and closing details
    $('#registration-list-datatable tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = dt.row( tr );
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            $('div.slider', row.child()).slideUp( function () {
                row.child.hide();
                tr.removeClass('shown');
            } );
        }
        else {
            // Open this row
            row.child( format(row.data()), 'no-padding' ).show();
            tr.addClass('shown');
 
            $('div.slider', row.child()).slideDown();
        }
    } );
     // On each draw, loop over the `detailRows` array and show any child rows
    dt.on( 'draw', function () {
        $.each( detailRows, function ( i, id ) {
            $('#'+id+' td.details-control').trigger( 'click' );
        } );
    } );
	});

	//send request status
	function UpdateStatuss(Keterangan, idpennnnn, status, statusPilihan){
		$.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
			Pace.track(function(){
					Pace.restart();
			  	$.ajax({
			        type: 'POST',
			        url: '{{ route('SendRequestStatus') }}',
			       	data: {
							  pendaftaran_id : idpennnnn,
							  keterangan : Keterangan,
							  status : status,
							  statusPilihan : statusPilihan,
							},
			        beforeSend: function() {
			       		$('.SendRequest').prop('disabled', true);
			        },
			        success: function(data) {
						   	switch (data.code) {
					        case "1":
					        	Swal.fire({
										  icon: 'error',
										  title: 'Oops...',
										  text: data.fail,
										  footer: '<b>Please fill in the action first, to be able to make a request</b>'
										})
									break;
									case "2":
										ToastToB.fire({icon: 'success',title: 'Success to send request'})
										$('#registration-list-datatable').DataTable().ajax.reload();
									break;
									case "3":
										ToastToB.fire({icon: 'error',title: 'change status Registration Failed'})
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

  $(document).on("click", ".SendRequestAgain", async function () {

      var idpennnnn = $(this).attr("data_idpen");
      var status = $(this).attr("status");
      var data_ket_reject = $(this).attr("data_ket_reject");

      const { value: accept } = await Swal.fire({
        title: 'Rejected message',
        text : data_ket_reject,
        input: 'checkbox',
        inputValue: 1,
        inputPlaceholder:
          'I agree with rejected message ',
        confirmButtonText:
          'Continue <i class="fa fa-arrow-right"></i>',
        inputValidator: (result) => {
          return !result && 'You need to agree with rejected message'
        }
      })

      if (accept) {
        Swal.fire('You agreed with with rejected message :)')
      }
  });


	//send request status
	$(document).on("click", ".SendRequest", async function () {

			var idpennnnn = $(this).attr("data_idpen");
			var status = $(this).attr("status");

			if (status == "requested" || status == "approved" || status == "rejected") {
				/* inputOptions can be an object or Promise */
				const inputOptions = new Promise((resolve) => {
				  setTimeout(() => {
				    resolve({
				      'approved': 'Appoved',
				      'rejected': 'Rejected',
				      'request': 'Request'
				    })
				  }, 1000)
				})
				const { value: statusPilihan } = await Swal.fire({
				  title: 'Confirm Status',
				  input: 'radio',
		      allowOutsideClick: false,
		      showCancelButton: true,
				  inputOptions: inputOptions,
				  inputValidator: (value) => {
				    if (!value) {
				      return 'You need to choose something!'
				    }else{
              if (value == "rejected"){
                  Swal.fire({
                    title: 'leave a description why rejected',
                    input: 'textarea',
                    inputAttributes: {
                      autocapitalize: 'off'
                    },
                    showCancelButton: true,
                    confirmButtonText: 'Send Request',
                    showLoaderOnConfirm: true,
                    allowOutsideClick: false,
                  preConfirm: (Keterangan) => {
                    if (Keterangan == "") {
                      Swal.showValidationMessage('First input missing')
                    } else {
                      UpdateStatuss(Keterangan, idpennnnn, status, value);//proses
                    }
                  },
                })
              }
            }
				  }
				})
      if (statusPilihan) {
				Keterangan = "";
				UpdateStatuss(Keterangan, idpennnnn, status, statusPilihan);//proses
			}
			}else if (status == "request") {
		  	Swal.fire({
				  title: 'leave a description',
				  input: 'textarea',
				  inputAttributes: {
				    autocapitalize: 'off'
				  },
				  showCancelButton: true,
				  confirmButtonText: 'Send Request',
				  showLoaderOnConfirm: true,
		      allowOutsideClick: false,
			  preConfirm: (Keterangan) => {
			   	UpdateStatuss(Keterangan, idpennnnn, status,"");//proses
			  },
			})
	  	}
	});		

	//Delete Registratioin
	$(document).on("click", ".DeleteRegistration", function () {
		var data_idPen = $(this).attr('data_idPendaftar');
		var status_request = $(this).attr('status_request');
		console.log(status_request);
		if (status_request == "rejected" || status_request == "approved") {
			ToastToB.fire({icon: 'error',title: 'Cant delete with status Approved or Rejected'})
		}else{
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
		  			$.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
					Pace.track(function(){
						Pace.restart();
						$.post( '{{ route('DeleteRegistrationMain') }}',  { id: data_idPen, status: status_request }).done(function( data ) {
							switch (data.code) {
							case "1":
								ToastToB.fire({icon: 'error',title: data.fail})
							break;
							case "2":
								ToastToB.fire({icon: 'success',title: 'Delete Success'})
								$('#registration-list-datatable').DataTable().ajax.reload();
							break;
						default:
			            break;
					      }
						});
					});
			  	}
			})
		}
	});
	

</script>

<style>
td.details-control {
    background: url('https://raw.githubusercontent.com/DataTables/DataTables/1.10.7/examples/resources/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('https://raw.githubusercontent.com/DataTables/DataTables/1.10.7/examples/resources/details_close.png') no-repeat center center;
}
div.slider {
    display: none;
}
</style>
@endsection
