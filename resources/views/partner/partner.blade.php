@extends('layouts.contentLayoutMaster')
{{-- title --}}
@section('title','Partner')

{{-- vendor styles --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/ui/prism.min.css')}}">  
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/responsive.bootstrap4.min.css')}}">

{{-- sweetalert2 --}}
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 

@endsection

@section('content')

@if(auth()->user()->can('view action_main')/* && $some_other_condition*/)
<section id="description" class="card">
    <div class="card-header">
        <h4 class="card-title">Dashboard Partner</h4>
    </div>
    <div class="card-body">
        <div class="card-text">
        {{-- batas table --}}
        <div class="table-responsive">
            <button type="button" class="btn btn-primary round addpa"><i class="bx bx-plus-circle"></i> 
              Create Partner
            </button>
            <table class="table yajra-datatable table-inverse table-hover" width="100%">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Partner Name</th>
                  <th>Partner Address</th>
                  <th>Partner Number</th>
                  <th>Contact Person</th>
                  <th>Contact Person Number</th>
                  <th>First Email</th>
                  <th>Second Email</th>
                  <th>Partner Category</th>
                  <th>MOU Date</th>
                  <th>MOU Expired Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
        </div>
        {{-- batas table --}}
        </div>
    </div>
</section>
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
<!--/ Description -->

<!--/ HTML Markup -->
@endsection

{{-- vendor scripts --}}
@section('vendor-scripts')
<script src="{{asset('vendors/js/ui/prism.min.js')}}"></script> 
<script src="{{asset('vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{asset('vendors/js/tables/datatable/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{asset('vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>

<div class="modal fade" id="ModalInsertPA" data-keyboard="false" data-backdrop="static">  
  <div class="modal-dialog ">
    <div class="modal-content" id="modal-content">
      <div class="row">
        <div class="col-lg-12">
          <div class="modal-header bg-info p-2">
            <h5 class="modal-title white" id="staticBackdropLabel">Insert Partner</h5> 
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
              <span aria-hidden="true">&times;</span> 
            </button>
          </div>
          <form id="FormInsertC" data-route="{{ route('PostC') }}" role="form" method="POST" accept-charset="utf-8">
          <div class="modal-body" >

              <div class="form-group">
                  <label class="form-label" for="basic-default-name">Partner Name</label>
                  <input type="text" class="form-control" id="basic-default-name" name="nama" placeholder="Partner Name" />
              </div>

              <div class="form-group">
                  <label class="form-label" for="basic-default-alamat">Partner Address</label>
                  <textarea class="form-control" id="basic-default-alamat" name="alamat"></textarea>
              </div>

              <div class="form-group">
                  <label class="form-label" for="basic-default-hp">Partner Phone</label>
                  <input type="text" class="form-control" id="basic-default-hp" name="nohp" placeholder="Partner Phone" />
              </div>

              <div class="form-group">
                  <label class="form-label" for="basic-default-cp">Contact Person</label>
                  <input type="text" class="form-control" id="basic-default-cp" name="cp" placeholder="Contact Person" />
              </div>

              <div class="form-group">
                  <label class="form-label" for="basic-default-cpn">Contact Person Number</label>
                  <input type="text" class="form-control" id="basic-default-cpn" name="cpn" placeholder="Contact Person Number" />
              </div>

              <div class="form-group">
                  <label class="form-label" for="basic-default-fe">First Email</label>
                  <input type="text" class="form-control" id="basic-default-fe" name="emailf" placeholder="First Email" />
              </div>

              <div class="form-group">
                  <label class="form-label" for="basic-default-se">Second Email</label>
                  <input type="text" class="form-control" id="basic-default-se" name="emails" placeholder="Second Email" />
              </div>

              <div class="form-group">
                  <label for="select-country">Partner Category</label>
                  <select class="form-control" id="cp" name="cp">
                    <option value="">Select Category</option>
                      @forelse($kategoripa as $key => $valpa)
                        <option value="{{ $valpa->katpengirimid }}">{{ $valpa->katpengirimnama }}</option>
                      @empty
                        <option value="">Data not found</option>
                      @endforelse
                  </select>
              </div>

              <div class="form-group">
                  <label class="form-label" for="basic-default-mou">MOU Date</label>
                  <input type="date" class="form-control" id="basic-default-mou" name="mou" placeholder="MOU Date" />
              </div>
  
              <div class="form-group">
                  <label class="form-label" for="basic-default-moux">MOU Expired Date</label>
                  <input type="date" class="form-control" id="basic-default-moux" name="moux" placeholder="OU Expired Date" />
              </div>   
                        
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
              <button type="submit" class="insertca btn btn-primary"><i class='bx bx-upload' ></i> Insert</button>
          </div>

          </form>
          {{-- tutup form --}}
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="ModalUpdateC" data-keyboard="false" data-backdrop="static">  
  <div class="modal-dialog">
    <div class="modal-content" id="modal-content">
      <div class="row">
        <div class="col-lg-12">
          <div class="modal-header bg-primary p-2">
            <h5 class="modal-title white" id="staticBackdropLabel">Update Partner</h5> 
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
              <span aria-hidden="true">&times;</span> 
            </button>
          </div>
          <form id="FormUpdateC" data-route="{{ route('UpdateC') }}" role="form" method="POST" accept-charset="utf-8">    
            {{-- render modal --}}
            <div id="RenderFormUpdateC"></div>

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

    /*---------------------insert action------------------------*/
  $(document).on("click", ".addpa", function () {
    $("#ModalInsertPA").modal("show");
  });

  $(document).on('submit', '#FormInsertC', function(e) {
    e.preventDefault();
    var route = $('#FormInsertC').data('route');
    var form_data = $(this);
    $.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
    $.ajax({
        type: 'POST',
        url: route,
        data: form_data.serialize(),
        beforeSend: function() {
          $('.insertca').prop('disabled', true);
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
            $('.yajra-datatable').DataTable().ajax.reload();
            $('.insertca').prop('disabled', false);
            $("#ModalInsertPA").modal("hide");
        },
        error: function(data,xhr) {
          alert("Failed response")
        },
    });
  });

  /*---------------------get modal edit action------------------------*/
  $(document).on("click", ".upC", function () {
    var id = $(this).attr('data-id')
    $.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
    Pace.track(function(){
      $.post( '{{ route('ModalEditC') }}', { id1 : id })
        .done(function( data ) {
          $("#RenderFormUpdateC").html(data.modalUpdateaction);
          $("#ModalUpdateC").modal("show");
        })
        .fail(function() { alert( "error" );})
    });
  });

    $(document).on('submit', '#FormUpdateC', function(e) {
      e.preventDefault();
      var route = $('#FormUpdateC').data('route');
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
                $('.yajra-datatable').DataTable().ajax.reload();
                $('.updateus').prop('disabled', false);
                $("#ModalUpdateC").modal("hide");
            },
            error: function(data,xhr) {
              alert("Failed response")
            },
        });
    });
  });

</script>

<script type="text/javascript">

 $(function () {  
    //datatable
    var table = $('.yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('ShowPartner') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'pennama', name: 'pennama'},
            {data: 'penalamat', name: 'penalamat'},
            {data: 'pentlp', name: 'pentlp'},
            {data: 'pengcp', name: 'pengcp'},
            {data: 'pengcpno', name: 'pengcpno'},
            {data: 'pengemailsatu', name: 'pengemailsatu'},
            {data: 'pengemaildua', name: 'pengemaildua'},
            {data: 'katpengirimnama', name: 'katpengirimnama'},
            {data: 'pengmoudate', name: 'pengmoudate'},
            {data: 'pengmouexdate', name: 'pengmouexdate'},
            {
              data: 'action', 
              name: 'action' 
              // orderable: true, 
              // searchable: true
            },
        ]
    });


    // delete action
    $(document).on('click', '.delC', function () {
        var id = $(this).attr('data-id')
        Swal.fire({
          title: 'Are you sure delete this data ?',
          showCancelButton: true,
          confirmButtonText: 'Yes',
        }).then((result) => {
          if (result.isConfirmed) {
              if (id) {
                return fetch('{{route("DelC", ":id")}}'.replace(":id", id),{
                    method: 'DELETE',
                    headers: {
                      'Content-Type': 'application/json',
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                }).then(response => {
                    $('.yajra-datatable').DataTable().ajax.reload();
                    Swal.fire('Success!', '', 'success')
                    return response.json()
                }).catch(error => {
                    Swal.fire('Server Error', '', 'error')
                    console.log(error)
                })
            } else {
                Swal.fire('Server Error', '', 'error')
            }
          }
        })
    });
      
});
</script>
@endsection
